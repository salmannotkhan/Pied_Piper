<?php
    if(isset($_POST["alloc"])){
        $query = "UPDATE SUB_ALLOC SET FACULTY = '{$_POST["faculty"]}' WHERE CLASS = '{$_POST["class"]}' AND SUBJECT = '{$_POST["subject"]}'";
        if($conn->query($query)){
            echo '<script>alert("Subject Allocated")</script>';
        }
        else{
            echo '<script>alert("'.$query.'")</script>';
        }
    }
?>
<form method="post" id="alloc" class="generic">
    <?php
        $query = "SELECT DISTINCT CLASS FROM SUB_ALLOC";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            echo '<select name="class" onchange="this.form.submit()">';
            echo '<option value="NULL">SELECT CLASS</option>';
            while ($row = $result->fetch_assoc()) {
                echo '<option ' ;
                if (isset($_POST["class"]) && $_POST["class"]==$row["CLASS"]){echo 'selected ';} 
                echo 'value="'.$row["CLASS"].'">'.$row["CLASS"].'</option>';
            }
            echo '</select>';
        }
        if(isset($_POST["class"])){
            echo '<select name="subject">';
            $query = "SELECT SUBJECT FROM SUB_ALLOC WHERE CLASS = '{$_POST["class"]}'";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row["SUBJECT"].'">'.$row["SUBJECT"].'</option>';
                }
            }
            echo '</select>';
            echo '<select name="faculty">';
            $query = "SELECT * FROM USER_DETAILS WHERE UNAME != 'admin'";
            $result = $conn->query($query);

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row["UNAME"].'">'.$row["UNAME"].'</option>';
                }
            }
            echo '</select>';
        }
    ?>
    <input type="submit" name="alloc" value="Allocate">
</form>