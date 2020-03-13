<?php
    if(isset($_POST["Save"])){
        if(!isset($_POST["present"])){
            echo '<script>confirm("Everyone is Absent")</script>';
        }
        else{
            $query = "UPDATE `table 5` SET day".date("d")." = '1' WHERE `table 5`.`COL 1` IN(".implode(",",$_POST["present"]).")";
            if($conn -> query($query)){
                echo '<script>alert("Done")</script>';
            }
            else{
                echo '<script>alert("'.$conn->error.'")</script>';
            }
        }
    }
    echo '<form method="post" class="selectionbox">';
    $query = "SELECT CLASS FROM SUB_ALLOC WHERE FACULTY = '{$_SESSION["user"]}'";
    $result = $conn->query($query);

    if($result -> num_rows > 0){
        echo '<select name="class" onchange="this.form.submit()">';
        echo '<option value="NULL">--SELECT CLASS--</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row["CLASS"].'"';
            if (isset($_POST["class"]) && $_POST["class"]==$row["CLASS"]){echo 'selected ';} 
            echo '>'.$row["CLASS"].'</option>';
        }
        echo '</select>';
    }
    if(isset($_POST["class"])){
        $query = "SELECT SUBJECT FROM SUB_ALLOC WHERE FACULTY ='{$_SESSION["user"]}' AND CLASS = '{$_POST["class"]}'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            echo '<select name="subject">';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row["SUBJECT"].'">'.$row["SUBJECT"].'</option>';
            }
            echo '</select>';
        }
        echo '</select>';
        echo '<input type="submit" name="take" value="Take">';
    }
    echo '</form>';
    if(isset($_POST["take"])){
        $query = "ALTER TABLE `table 5` ADD day".date("d")." BOOLEAN NOT NULL DEFAULT FALSE";
        if (!$conn -> query($query)){
            echo '<script>alert("You already took attendence")</script>';
        }

        echo '<form method="post" class="sheet">';
        $query = "SELECT * FROM `table 5`";
        $result = $conn -> query($query);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo '<label class="rollbox">'.$row["COL 1"];
                echo '<div class="nm">'.$row["COL 2"].'</div>';
                echo '<input type="checkbox" name="present[]" value="'.$row["COL 1"].'">';
                echo '<span class="newcheck"></span>';
                echo '</label>';
            }
        }
        echo '<input type="submit" name="Save" value="Save">';
        echo '</form>';
    }