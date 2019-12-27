<?php
	include_once("./includes/header.php");
	session_start();
	include_once("./includes/checklogin.php");
?>
 <div class="loginbox">
	<h3>Login to Portal</h3>
	<form class="login" method="POST">
		<input type="text" name="user" autocomplete="off" autocorrect="off" autocapitalize="off" placeholder="Username" required autofocus><br>
		<input type="password" name="pwd" autocomplete="off" autocorrect="off" autocapitalize="off" placeholder="Password" required><br>
		<input type="submit" name="submit" value="Login">
	</form>
</div>
<?php include_once("./includes/footer.php");?>