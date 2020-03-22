<?php
    if(isset($_POST["Save"])){
        if(!isset($_POST["present"])){
            echo '<script>alert("Everyone is Absent")</script>';
        }
        else{
            $classsub = $_POST["classsub"];
            $date = date_create($_POST["date"]);
            $query = "UPDATE ".$classsub." SET `".$date->format("d-M")."`= 1 WHERE RNO IN(".implode(",",$_POST["present"]).")";
            if($conn -> query($query)){
                echo '<script>alert("Done")</script>';
            }
            else{
                echo '<script>alert("'.$conn->error.'")</script>';
            }
        }
    }
    echo '<div class="block">';
    echo '<form method="post" class="selectionbox generic">';
    $query = "SELECT DISTINCT CLASS FROM SUB_ALLOC WHERE FACULTY = '{$_SESSION["user"]}'";
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
        echo '<input type="date" name="date" value="';
        if(isset($_POST["date"])){echo $_POST["date"];}
        echo '">';
        
        echo '<input type="submit" name="edit" value="Edit">';
    }
    echo '</form>';
    if(isset($_POST["edit"])){
        $date = date_create($_POST["date"]);
        $classsub = $_POST["class"]."_".str_replace(' ', '_', $_POST["subject"])."_".$date->format("M_Y");
        echo '<form method="post" class="sheet">';
        echo '<input type="hidden" name="classsub" value="'.$classsub.'">';
        echo '<input type="hidden" name="date" value="'.$_POST["date"].'">';

        $query = "SELECT RNO,NAME,`".$date->format("d-M")."` FROM ".$classsub;
        $result = $conn -> query($query);
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo '<label class="rollbox">'.$row["RNO"];
                echo '<div class="nm">'.$row["NAME"].'</div>';
                echo '<input type="checkbox" ';
                if($row[$date->format("d-M")]){
                    echo 'checked="checked"';
                }
                echo 'name="present[]" value="'.$row["RNO"].'">';
                echo '<span class="newcheck"></span>';
                echo '</label>';
            }
        }
        else{
            echo $conn->error;
        }
        echo '<input type="submit" name="Save" value="Save">';
        echo '</form>';
    }
    echo '</div>';