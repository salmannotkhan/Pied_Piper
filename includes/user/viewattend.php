<form method="post" class="selectionbox">
    <?php
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
            echo '<select name="month">';
            for ($i=1; $i < 13 ; $i++) { 
               echo '<option value="'.$i.'">'.$i.'</option>';
            }
            echo '</select>';
            echo '<input type="submit" name="view" value="View">';
        }
    ?>
</form>
<?php
    if(isset($_POST["view"])){
        $query = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "piedpiper" AND TABLE_NAME = "table 5"';
        if($result = $conn -> query($query)){
            echo "<table class='finalop'><tr align='center'>";
            $total = $result -> num_rows - 2;
            while($row = $result -> fetch_row()){
                echo "<td>".$row[0]."</td>";
            }
            echo "<td>Present</td><td>Total</td><td>Percentage</td>";
            echo "</tr>";
        }
        else{
            echo $conn -> error;
        }
        $query = "SELECT * FROM `table 5`"; 
        if($result = $conn -> query($query)){
            echo "<tr align='center'>";
            while($row = $result -> fetch_row()){
                $i = 0;
                $present = 0;
                while($i < $total + 2){
                    echo "<td>";
                    if($row[$i] && $i>1){
                        echo "P";
                        $present++;
                    }else if($i>1){
                        echo "A";
                    }else{
                        echo $row[$i];
                    }
                        echo "</td>";
                    $i++;
                }
                echo "<td>".$present."</td><td>".$total."</td><td>".round($present*100 / $total)."%</td></tr><tr align='center'>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>