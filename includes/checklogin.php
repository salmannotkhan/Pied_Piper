<?php
    if(isset($_POST["submit"])){
        $query = "SELECT * FROM USER_DETAILS WHERE UNAME = '{$_POST["user"]}'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $query = "SELECT name FROM USER_DETAILS WHERE UNAME = '{$_POST["user"]}' AND PWD = '{$_POST["pwd"]}'";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                $_SESSION["user"]=$_POST["user"];
                $value=mysqli_fetch_object($result);
                $_SESSION["name"]=$value->name;
                header("Location: ./");
            }
            else{
                echo "<script>alert(\"Check your login details.\");</script>";
            }
        }
        else{
            echo "<script>alert(\"User doesn't exist!!\");</script>";
        }
    }