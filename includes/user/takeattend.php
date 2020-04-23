<?php
    if(isset($_POST["Save"])){
        if(!isset($_POST["present"])){
            echo '<script>confirm("Everyone is Absent")</script>';
        }
        else{
            $classsub = $_POST["classsub"];
            $query = "UPDATE ".$classsub." SET `".date("d")."-".date("M")."`= 1 WHERE RNO IN(".implode(",",$_POST["present"]).")";
            if($conn -> query($query)){
                echo '<script>alert("Done")</script>';
            }
            else{
                echo '<script>alert("'.$conn->error.'")</script>';
            }
        }
    }
    echo '<div class="block">';
     $query = "SELECT DISTINCT CLASS FROM SUB_ALLOC WHERE FACULTY = '{$_SESSION["user"]}'";
    $result = $conn->query($query);

    if($result -> num_rows > 0){
        echo '<form method="post" class="selectionbox generic">';
        echo '<select name="class" onchange="this.form.submit()">';
        echo '<option value="NULL">--SELECT CLASS--</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row["CLASS"].'"';
            if (isset($_POST["class"]) && $_POST["class"]==$row["CLASS"]){echo 'selected ';} 
            echo '>'.$row["CLASS"].'</option>';
        }
        echo '</select>';
    }
    else{
        echo "<span class='greetings'>You're not allocated any subject.<br><center>Please contact Administrator</center></span>";
    }
    if(isset($_POST["class"])){
        $class = $_POST["class"];
        $query = "SELECT SUBCODE,SUBJECT FROM SUB_ALLOC WHERE FACULTY ='{$_SESSION["user"]}' AND CLASS = '{$_POST["class"]}'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            echo '<select name="subject">';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row["SUBCODE"].'">'.$row["SUBJECT"].'</option>';
            }
            echo '</select>';
        }
        echo '</select>';
        echo '<input type="submit" name="take" value="Take">';
    }
    echo '</form>';
    if(isset($_POST["take"])){
        $classsub = "`".$_POST["subject"]." ".date("M-Y")."`";
        $query = "CREATE TABLE IF NOT EXISTS ".$classsub." AS SELECT * FROM `MAINDB ".$_POST["class"]." ".date("Y")."`";
        if(!$conn -> query($query)){
            echo '<script>alert("'.$conn->error.'")</script>';
        }
    
        $query = "ALTER TABLE ".$classsub." ADD `".date("d")."-".date("M")."` BOOLEAN NOT NULL DEFAULT FALSE";
        if (!$conn -> query($query)){
            echo '<script>alert("You already took attendence")</script>';
            echo '<script>alert("'.$conn->error.'")</script>';
        }

        echo '<form method="post" class="sheet">';
        echo '<input type="hidden" name="classsub" value="'.$classsub.'">';
        $query = "SELECT * FROM ".$classsub;
        $result = $conn -> query($query);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo '<label class="rollbox">'.$row["RNO"];
                echo '<div class="nm">'.$row["NAME"].'</div>';
                echo '<input type="checkbox" name="present[]" value="'.$row["RNO"].'">';
                echo '<span class="newcheck"></span>';
                echo '</label>';
            }
        }
        echo '<input type="submit" name="Save" value="Save">';
        echo '</form>';
    }
    echo '</div>';