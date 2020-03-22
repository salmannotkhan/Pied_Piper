<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>College Attendence</title>
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="./includes/logo.png" type="image/icon type">
</head>
<body>
    <?php
        include_once("./includes/common/dbconnect.php");
    ?>
    <nav>
    <a class="logo"><p>Pied Piper</p></a>
    <?php
    if(isset($_SESSION["user"])){
        if($_SESSION["user"] == "admin"){
            echo '
            <a href="?section=manstaff"';
            if($_GET["section"]=="manstaff"){
                echo ' class="selected" ';
            }
            echo '>Manage Staff</a>
            <a href="?section=manstud"';
            if($_GET["section"]=="manstud"){
                echo ' class="selected" ';
            }
            echo '>Manage Student</a>
            <a href="?section=suballoc"';
            if($_GET["section"]=="suballoc"){
                echo ' class="selected" ';
            }
            echo '>Subject Allocation</a>
            <a href="./includes/common/logout.php">Logout</a>';
        }
        else{
            echo '<a href="?section=takeattend"';
            if($_GET["section"]=="takeattend"){
                echo ' class="selected" ';
            }
            echo '>Take Attendence</a>
            <a href="?section=viewattend"';
            if($_GET["section"]=="viewattend"){
                echo ' class="selected" ';
            }
            echo '>View Attendence</a>
            <a href="?section=editattend"';
            if($_GET["section"]=="editattend"){
                echo ' class="selected" ';
            }
            echo '>Edit Attendence</a>
            <a href="./includes/common/logout.php">Logout</a>';
        }
    }
    ?>
    </nav>
<container>