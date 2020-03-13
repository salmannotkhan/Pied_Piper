<?php
    if(isset($_POST["submit"])){
        switch ($_POST["submit"]) {
            case 'Add User':
                $query = "SELECT * FROM LOGIN_DETAILS WHERE UNAME = {$_POST["username"]}";
                if($conn->query($query)){
                    echo '<script>alert("User already exist")</script>';
                }
                else{
                    $query = "INSERT INTO LOGIN_DETAILS VALUES ('" . $_POST["username"] . "','" . $_POST["password"] . "')";
                    if($conn->query($query)){
                        echo '<script>alert("User added successfully")</script>';
                    }
                    else{
                        echo '<script>alert("Something went wrong")</script>';
                    }
                }
                break;
            case 'Remove User':
                $query = "DELETE FROM LOGIN_DETAILS WHERE UNAME = '{$_POST["username"]}'";
                if($conn->query($query)){
                    echo '<script>alert("User Deleted Successfully!")</script>';
                }
                else{
                    echo '<script>alert("'.$query.'")</script>';
                }
                break;
            case 'Change Password':
                $query = "UPDATE LOGIN_DETAILS SET PWD = '{$_POST["password"]}' WHERE UNAME = '{$_POST["username"]}'";
                if($conn->query($query)){
                    echo '<script>alert("Password Changed")</script>';
                }
                else{
                    echo '<script>alert("Something went wrong")</script>';
                }
            default:
                
                break;
        }
    }
?>
<form method="post" class="generic">
    <h4>Add New User</h4>
    <input type="text" name="username" placeholder="Username" autocomplete="off" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <input type="submit" name="submit" value="Add User">
</form>

<form method="post" class="generic">
    <h4>Remove Users</h4>
    <?php
        $query = "SELECT * FROM LOGIN_DETAILS WHERE UNAME != 'admin'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            echo '<select name="username">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["uname"].'">'.$row["uname"].'</option>';
                    }
            echo "</select>";
            echo '<input type="submit" name="submit" value="Remove User">';

        }
        else{
            echo "No user found!!";
        }
    ?>
</form>


<form method="post" class="generic">
    <h4>Change Password</h4>
    <?php
        $query = "SELECT * FROM LOGIN_DETAILS WHERE UNAME != 'admin'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            echo '<select name="username">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["uname"].'">'.$row["uname"].'</option>';
                    }
            echo "</select>";
            echo '<input type="password" name="password" placeholder="Enter Password" required>';
            echo '<input type="submit" name="submit" value="Change Password">';
        }
    ?>
</form>