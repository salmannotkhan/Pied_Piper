<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pied Piper</title>
    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <nav class="main">
        <a><p>Pied Piper</p>
        </a>
    <?php 
        include_once("./includes/dbconnect.php");
        if(isset($_SESSION["user"])){
            // echo <<<'nav'
            // <a href="">lorem</a>
            // <a href="">lorem</a>
            // <a href="">lorem</a>
            // nav;
            if($_SESSION["user"] == "admin"){
                echo <<<'adnav'
                <a href="?s=stud">Manage Students</a>
                <a href="?s=staf">Manage Staff</a>
                <a href="?logout">Logout</a>
                </nav>
                adnav;
            }
        }
        else{
            echo "</nav>";
        }
    ?>
    <container>