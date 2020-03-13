<?php
    if(isset($_POST["upload"])){
        $query = "SELECT * FROM  MAINDB_".$_POST["class"]."_".date("Y");
        if($conn->query($query)){
            echo "<script>alert('Database Already exists')</script>";
        }
        else{
            $target = 'backup/';
            $targetfile = $target.$_POST["class"].date("Y").".csv";
            if (move_uploaded_file($_FILES["csv"]["tmp_name"], $targetfile)){
                echo "<script>alert('Uploaded')</script>";
                $query = "CREATE TABLE MAINDB_".$_POST["class"]."_".date("Y")." ( rno INT(3) PRIMARY KEY , name VARCHAR(255) NOT NULL) ENGINE = InnoDB";
                if($conn->query($query)){
                    echo "<script>alert('Created Successfully')</script>";
                }
                else{
                    echo "<script>alert('".$conn->error."')</script>";  
                }
                $query = "LOAD DATA LOCAL INFILE '".$targetfile."' INTO TABLE MAINDB_".$_POST["class"]."_".date("Y")." FIELDS TERMINATED BY ','";
                if($conn->query($query)){
                    echo "<script>alert('Inserted Successfully')</script>";
                }
                else{
                    echo "<script>alert('".$conn->error."')</script>";  
                }
            }
        }
        unset($_POST["upload"]);
    }
?>

<form method="post" class="generic" enctype="multipart/form-data">
    <?php
        $query = "SELECT DISTINCT CLASS FROM SUB_ALLOC";
        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            echo '<select name="class" onchange="this.form.submit()">';
            echo '<option value="NULL">SELECT CLASS</option>';
            while($row = $result -> fetch_assoc()){ 
                echo '<option ' ;
                if (isset($_POST["class"]) && $_POST["class"]==$row["CLASS"]){echo 'selected ';} 
                echo 'value="'.$row["CLASS"].'">'.$row["CLASS"].'</option>';
            }
            echo '</select>';
        }
        if (isset($_POST["class"])){
            echo '<input type="file" name="csv">';
            echo '<input type="submit" name="upload" value="Upload">';
        }
    ?>
</form>