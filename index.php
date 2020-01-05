<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location:login.php");
    }
    else{
        include_once("./includes/header.php");
        if(isset($_GET["s"])){
            if($_GET["s"] == "stud"){
                include_once("./includes/studentmanagement.php");
            }
            elseif($_GET["s"] == "staf"){
                include_once("./includes/staffmanagement.php");
                switch ($_GET["u"]) {
                    case "incharge":
                        include_once("./includes/classincharge.php");
                        break;
                    case "setup":
                        include_once("./includes/setup.php");
                        break;
                    case "manage":
                        include_once("./includes/manageuser.php");
                        break;
                    default:
                        break;
                }
            }
            elseif(isset($_GET["logout"])){
                include_once("./includes/out.php");
            }
            switch ($_GET["action"]) {
                case 'take':
                    include_once("./includes/take.php");
                    break;
                case 'edit':
                    include_once("./includes/edit.php");
                    break;
                case 'generate':
                    include_once("./incldues/generate.php");
                    break;
                default:
                    
                    break;
            }
        }
        else{
            echo "<div class=\"greeting\">Welcome ". $_SESSION["name"]." !</div>";
        }
        include_once("./includes/footer.php");
    }
    ?>