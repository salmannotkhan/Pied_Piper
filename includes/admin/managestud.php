<?php
    if(isset($_POST["upload"])){
        $dbtable = $_POST["dbtable"];
        $query = "SELECT * FROM ".$dbtable;
        if($conn->query($query)){
            echo "<script>alert('Database Already exists, First Delete Old Database to Upload new one');</script>";
        }
        else{
            $target = $_SERVER["DOCUMENT_ROOT"] . "backup/";
            $targetfile = $target . $_POST["class"] . date("Y") . ".csv";
            if (move_uploaded_file($_FILES["csv"]["tmp_name"], $targetfile)){
                echo "<script>alert('Uploaded')</script>";
                $query = "CREATE TABLE ".$dbtable."( RNO INT(3) PRIMARY KEY , NAME VARCHAR(255) NOT NULL) ENGINE = InnoDB";
                if($conn->query($query)){
                    echo "<script>alert('Created Successfully')</script>";
                }
                else{
                    echo "<script>alert('".$conn->error."')</script>";  
                }
                $query = "LOAD DATA LOCAL INFILE '".$targetfile."' INTO TABLE ".$dbtable." FIELDS TERMINATED BY ','";
                if($conn->query($query)){
                    echo "<script>alert('Inserted Successfully')</script>";
                }
                else{
                    echo "<script>alert('".$conn->error."')</script>";  
                }
            }
            else{
                echo $targetfile;
            }
        }
        unset($_POST["upload"]);
    }
    if($_POST["delete"]){
        $query = "DROP TABLE {$_POST["dbtable"]}";
        if($conn->query($query)){
            echo "<script>alert('Successful')</script>";  
        }
        else{
            echo "<script>alert('".$conn->error."')</script>";  
        }
    }
    $query = "SELECT DISTINCT CLASS FROM SUB_ALLOC";
    if ($result = $conn -> query($query)){
        echo    '<div class="block">
                <form method="post" class="generic" enctype="multipart/form-data">
                <select name="class" onchange="this.form.submit()">
                <option value="NULL">SELECT CLASS</option>';
        while($row = $result -> fetch_assoc()){ 
            echo '<option ' ;
            if (isset($_POST["class"]) && $_POST["class"]==$row["CLASS"]){echo 'selected ';} 
            echo 'value="'.$row["CLASS"].'">'.$row["CLASS"].'</option>';
        }
        echo '</select>';
    }
    if (isset($_POST["class"])){
        $dbtable = "MAINDB_".$_POST["class"]."_".date("Y");
        echo    '<input type="hidden" name="dbtable" value="'.$dbtable.'">
                <input type="file" name="csv">
                <input type="submit" name="upload" value="Upload">';
        $query = "SELECT * FROM .$dbtable";
        if($result = $conn->query($query)){
            echo '<input type="submit" name="delete" value="Delete">';
        }
    } 
    echo '</form>';
    if (isset($_POST["class"])){
        $query = "SELECT * FROM .$dbtable";
        if($result = $conn->query($query)){
            echo    '<h4>Existing Student List:</h4><br>
                    <table class="finalop">';
            while($row = $result->fetch_row()){
                echo '<tr>
                    <td>'.$row[0].'</td>
                    <td>'.$row[1].'</td>
                    </tr>';
            }
            echo '</table>';
        }
        echo '</div>';
    }