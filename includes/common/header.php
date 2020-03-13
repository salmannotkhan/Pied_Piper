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
    <a class="logo"><p>Pied Piper</p></a>
    <?php
    if(isset($_SESSION["user"])){
        if($_SESSION["user"] == "admin"){
            echo '
            <a href="?section=manstaff">Manage Staff</a>
            <a href="?section=manstud">Manage Student</a>
            <a href="?section=suballoc">Subject Allocation</a>
            <a href="./includes/common/logout.php">Logout</a>';
        }
        else{
            echo '<a href="?section=takeattend">Take Attendence</a>
            <a href="?section=viewattend">View Attendence</a>
            <a href="?section=editattend">Edit Attendence</a>
            <a href="./includes/common/logout.php">Logout</a>';
        }
    }
    ?>
    </nav>
<container>