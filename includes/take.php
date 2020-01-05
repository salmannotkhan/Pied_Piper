<form method="post">
    <?php
        $query = "SELECT * FROM CLASS_SUB";
        $result = $conn -> query($query);
        if($result -> num_rows > 0){
            while($row=$result->fetch_assoc()){
                echo "<h6>".$row["class"]."</h6>";
            }
        }
        else{
            echo "You're Useless";
        }
    ?>
</form>