<select name="class">
    <?php
        $sql = "SELECT DISTINCT class FROM CLASS_SUB";
        $result = $conn->query($sql);
        echo '<option value="null">--SELECT CLASS--</option>';            
        if ($result->num_rows > 0) {    
            while($row = $result->fetch_assoc()){
                echo '<option value="'.$row["class"].'"';
                echo '>'.$row["class"].'</option>';
            }
        }
    ?>
</select>