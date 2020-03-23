<?php
	if(isset($_POST["submit"])){
		$query = "SELECT * FROM USER_DETAILS WHERE UNAME = '".$_POST["username"]."'";

		if($conn->query($query)){
			$query = "SELECT * FROM USER_DETAILS WHERE UNAME = '{$_POST["username"]}' AND PWD = '{$_POST["password"]}'";
			$result = $conn -> query($query);
			if($result -> num_rows > 0){
				$row = $result->fetch_assoc();
				$_SESSION["user"] = $row["UNAME"];
				$_SESSION["name"] = $row["NAME"];
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