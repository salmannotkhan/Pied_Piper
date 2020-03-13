<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>College Attendence</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php
        include_once("./includes/common/dbconnect.php");
    ?>
    <nav>
    <li><div class="logo"><a href="./">Pied Piper</a></div></li>
    <?php
    if(isset($_SESSION["user"])){
        if($_SESSION["user"] == "admin"){
            echo '
            <li><a href="?section=manstaff">Manage Staff</a></li>
            <li><a href="?section=manstud">Manage Student</a></li>
            <li><a href="?section=suballoc">Subject Allocation</a></li>
            <li><a href="./includes/common/logout.php">Logout</a></li>';
        }
        else{
            echo '<li><a href="?section=takeattend">Take Attendence</a></li>
            <li><a href="?section=viewattend">View Attendence</a></li>
            <li><a href="?section=editattend">Edit Attendence</a></li>
            <li><a href="./includes/common/logout.php">Logout</a></li>';
        }
    }
    ?>
    </nav>
<container>