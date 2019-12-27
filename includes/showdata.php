<?php
    $user = "root";
    $pwd = "tony3212";
    $db = "clgattendence";
    $conn = new mysqli("localhost",$user,$pwd,$db);

    $query = "SELECT DISTINCT STUDENT_DATABASE.*, coalesce(ELECTIVE2.2DEC, ELECTIVE1.2DEC) as '2DEC' 
    FROM STUDENT_DATABASE,ELECTIVE2,ELECTIVE1 
    WHERE 
    STUDENT_DATABASE.RNO = ELECTIVE1.RNO 
    OR
    STUDENT_DATABASE.RNO = ELECTIVE2.RNO
    ";
    $result = $conn -> query($query);
    echo $conn->error;

    if($result -> num_rows > 0){
        echo "<table><tr align=\"center\"><td>Roll no</td><td>Student Name</td><td>Absent/Present</td></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr align=\"center\"><td>{$row["RNO"]}</td><td>{$row["NAME"]}</td><td>{$row["2DEC"]}</td></tr>";
        }
        echo "</table>";
    }