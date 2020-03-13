<?php
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$query = "SELECT * FROM USER_DETAILS WHERE UNAME = '$username'";

		if($conn->query($query)){
			$query = "SELECT * FROM USER_DETAILS WHERE UNAME = '$username' AND PWD = '$password'";
			$result = $conn -> query($query);
			if($result -> num_rows > 0){
				$_SESSION["user"] = $username;
				header("Location:./");
			}
			else{
				echo "<script>alert(\"Check your login details\");</script>";
			}
		}
		else{
			echo "<script>alert(\"User not found\");</script>";
		}
	}