<?php
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
        $query = "SELECT SUBCODE,SUBJECT FROM SUB_ALLOC WHERE FACULTY ='{$_SESSION["user"]}' AND CLASS = '{$_POST["class"]}'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            echo '<select name="subject">';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row["SUBCODE"].'"';
                if (isset($_POST["subject"]) && $_POST["subject"]==$row["SUBJECT"]){echo 'selected ';} 
                echo '>'.$row["SUBJECT"].'</option>';
            }
            echo '</select>';
        }
        echo '</select>';
        echo '<select name="month">';
        for ($i=1; $i < 13 ; $i++) {
            $mnt = DateTime::createFromFormat('!m', $i) -> format('M');
            echo '<option value="'.$mnt.'"';
            if ((isset($_POST["month"]) && $_POST["month"]==$mnt) || (!isset($_POST["month"]) && date("M")==$mnt)){echo 'selected ';} 
            echo '>'.$mnt.'</option>';
        }
        echo '</select>';
        echo '<select name="year">';
        for ($i=2020; $i <= date('Y') ; $i++) {
            echo '<option value="'.($i).'"';
            if ((isset($_POST["year"]) && $_POST["year"]==$i) || (!isset($_POST["month"]) && date('Y') == $i)){echo 'selected ';} 
            echo '>'.($i).'</option>';
        }
        echo '</select>';
        echo '<input type="submit" name="view" value="View">';
    }
    echo '</form>';
    if(isset($_POST["view"])){
        $classsub = $_POST["subject"]." ".$_POST["month"]."-".$_POST["year"];
        $query = 'SELECT COUNT(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "piedpiper" AND TABLE_NAME = "'.$classsub.'"';
        if($result = $conn -> query($query)){
            $row = $result -> fetch_row();
            if($row[0] > 0){
                $query = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "piedpiper" AND TABLE_NAME = "'.$classsub.'"';
                $result = $conn -> query($query);
                echo "<table class='finalop'><tr align='center'>";
                $total = $result -> num_rows - 2;
                while($row = $result -> fetch_row()){
                    echo "<th>".$row[0]."</th>";
                }
                echo "<th>Present</th><th>Total</th><th>Percentage</th>";
                echo "</tr>";
            }
            else{
                echo "<center><strong>No data available</strong></center>";
            }
        }
        else{
            echo $conn -> error;
        }
        $query = "SELECT * FROM `".$classsub."`"; 

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
            echo "</table>";
            echo '<a class="downloadlink" href="./includes/user/download.php?clstab='.$classsub.'">Download .xls</a>';
        }
    }
    echo '</div>';