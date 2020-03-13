<?php 
    include_once("./includes/common/header.php");
    include_once("./includes/common/login.php");
?>
    <form method="post" class="generic">
    <h4>Login to portal</h4>
    <input type="text" name="username" placeholder="Username" required autocomplete="off" autofocus="on">
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login" name="submit">
    </form>
<?php include_once("./includes/common/footer.php");?>