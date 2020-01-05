<?php
    if(isset($_POST["submit"])){
        if($_POST["submit"] == "Add user"){
        $query = "SELECT * FROM USER_DETAILS WHERE UNAME = '{$_POST["username"]}'";
        $result = $conn -> query($query);
            if($result -> num_rows > 0){
                echo "<script>alert(\"Username already exists\");</script>";
            }
            else{
                $query = "INSERT INTO USER_DETAILS VALUES('{$_POST["username"]}','{$_POST["password"]}','{$_POST["name"]}')";
                if($conn -> query($query)){
                    echo "<script>alert(\"User Added Successfully\");</script>";
                }
                else{
                    echo "<span class=\"error\">.$conn->error. </span>";
                }
            }
        }
        elseif($_POST["submit"] == "Remove user"){
            $query = "SELECT * FROM USER_DETAILS WHERE UNAME = 'admin' AND PWD = '{$_POST["adpassword"]}'" ;
            $result = $conn -> query($query);
            if($result -> num_rows > 0){
                $query = "DELETE FROM USER_DETAILS WHERE UNAME = '{$_POST["username"]}'";
                if($conn -> query($query)){
                    echo "<script>alert(\"Done\");</script>;";
                }
            }
            else{
                echo "<script>alert(\"Wrong Password Please enter your password\");</script>;";
            }
        }
        elseif($_POST["submit"] == "Change"){
            $query = "SELECT * FROM USER_DETAILS WHERE UNAME = 'admin' AND PWD = '{$_POST["adpassword"]}'" ;
            $result = $conn -> query($query);
            if($result -> num_rows > 0){
                $query = "UPDATE USER_DETAILS SET PWD = '{$_POST["password"]}' WHERE UNAME = '{$_POST["username"]}'";
                if($conn -> query($query)){
                    echo "<script>alert(\"Password Changed Successfully\");</script>;";
                }
            }
            else{
                echo "<script>alert(\"Wrong Password Please enter your password\");</script>;";
            }
        }
    }
    
?>
<form method="post">
    <h3>Add User</h3>
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="submit" value="Add user">
</form>
<form method="post">
    <h3>Remove User</h3>
        <?php
            $query = "SELECT * FROM USER_DETAILS WHERE UNAME != 'admin'";
            $result = $conn -> query($query);
            if($result -> num_rows > 0){
                echo "<select name=\"username\">";
                while($row = $result -> fetch_assoc()){
                        echo "<option value={$row["uname"]}>{$row["name"]}</option>";
                }
                echo "</select>";
                echo '<input type="password" name="adpassword" placeholder="Admin Password">
                <input type="submit" name="submit" value="Remove user">';
            }
            else{
                echo "<h4><center>No User available</center></h4>";
            }
        ?>
</form>
<form method="POST">
    <h3>Change Password</h3>
    <?php
            $query = "SELECT * FROM USER_DETAILS WHERE UNAME != 'admin'";
            $result = $conn -> query($query);
            if($result -> num_rows > 0){
                echo "<select name=\"username\">";
                while($row = $result -> fetch_assoc()){
                        echo "<option value={$row["uname"]}>{$row["name"]}</option>";
                }
                echo "</select>";
                echo '<input type="password" name="password" placeholder="Enter New Password">
                <input type="password" name="adpassword" placeholder="Admin Password">
                <input type="submit" name="submit" value="Change">';
            }
            else{
                echo "<h4><center>No User available</center></h4>";
            }
        ?>
    
</form>