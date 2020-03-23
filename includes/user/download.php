<?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=".str_replace("_"," ",$_GET["clstab"])." Report.xls");
    include_once("../common/dbconnect.php");
    $classsub = $_GET["clstab"];
    $query = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "piedpiper" AND TABLE_NAME = "'.$classsub.'"';
    if($result = $conn -> query($query)){
        echo "<table class='finalop'><tr align='center'>";
        $total = $result -> num_rows - 2;
        while($row = $result -> fetch_row()){
            echo "<th>".$row[0]."</th>";
        }
        echo "<th>Present</th><th>Total</th><th>Percentage</th>";
        echo "</tr>";
    }
    else{
        echo $conn -> error;
    }
    $query = "SELECT * FROM ".$classsub; 
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