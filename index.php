<?php
ob_start();

session_start();
include_once("pages/functions.php");
// $_SESSION['debug'] = 'this is debug!';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['reg'])) {
    $_SESSION['reg'] = 0;
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = null;
}
if (!isset($_SESSION['ruser'])) {
    $_SESSION['ruser'] = null;
}
if (!isset($_SESSION['num'])) {
    $_SESSION['num'] = 3;
}
if ($_SESSION['reg'] == 1) {
    $_SESSION['num'] = 25;
}

$link = connect();
$rel = 'SELECT COUNT(*) FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
$number = mysqli_query($link, $rel);
$s = mysqli_fetch_array($number);

$count = $s[0];
$_SESSION['rem'] = $remaining =  $_SESSION['num'] - $count;
// echo $_SESSION['rem'];
// if (!isset($_SESSION['title'])) {
// //     $_SESSION['title'] = 'Notes';
// // }

// $_SESSION['reg'] = 0;
// if (!isset($_SESSION['reg'])) { IT DOESNT WORK
//     $_SESSION['reg'] = 0;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>notes</title>
    <meta charset="UTF-8">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="shortcut icon" type="image/png" href="images/flavicon_pixel.png" />

</head>

<body>


    <div class="container-fluid h-100">

        <div class="row h-100">
            <div class="col-sm-2 d-flex flex-column align-items-start py-2" style="position:fixed;width:267px">


                <?php include_once('pages/user.php'); ?>
                <?php include_once('pages/menu.php'); ?>




            </div>
            <div class="col-sm-10 d-flex pt-10 align-items-center justify-content-center " style="margin-left: 267px;">
                <div class="row w-100 h-100 m-20">


                    <div class="container p-0" style="overflow-x: scroll;">
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            if ($page == 1)
                                include_once("pages/register.php");
                            if ($page == 2)
                                include_once("pages/login.php");
                            if ($page == 3)
                                include_once("pages/settings.php");
                            if ($page == 4)
                                include_once("pages/redaction.php");
                        }
                        ?>
                        <!-- <div>4</div> -->
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

            <style>

            </style>




</html>