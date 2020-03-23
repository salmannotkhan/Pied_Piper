<?php
    include_once("./includes/common/header.php");
    if(!isset($_SESSION["user"])){
        header("Location:login.php");
    }
    if($_SESSION["user"] == "admin"){
        if(isset($_GET["section"])){
            switch ($_GET["section"]) {
                case 'manstaff':
                    include_once("./includes/admin/managestaff.php");
                    break;
                case 'suballoc':
                    include_once("./includes/admin/suballoc.php");
                    break;
                case 'manstud':
                    include_once("./includes/admin/managestud.php");
                    break;
                default:
                    # Nothing
                    break;
            }
        }
        else{
            echo '<span class="greetings">Welcome '.$_SESSION['name'].'</span>';
        }
    }
    else{
        if(isset($_GET["section"])){
            switch ($_GET["section"]) {
                case 'takeattend':
                    include_once("./includes/user/takeattend.php");
                    break;
                case 'viewattend':
                    include_once("./includes/user/viewattend.php");
                    break;
                case 'editattend':
                    include_once("./includes/user/editattend.php");
                    break;
                default:
                    # Nothing
                    break;
            }
        }
        else{
            echo '<span class="greetings">Welcome '.$_SESSION['name'].'</span>';
        }
    }
    include_once("./includes/common/footer.php");