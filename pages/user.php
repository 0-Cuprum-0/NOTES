<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php

    // print_r($_SESSION);
    $link = connect();



    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <div class="row w-100 justify-content-center align-items-center" style="height:100px;">
        <div class="col-sm-4 px-4 justify-content-center align-items-center"><img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/user--v1.png" alt="user--v1" /></div>
        <div class="col-sm-6 p-0 justify-content-center align-items-center">
            <!-- <input class="noaccount" type="submit" name="noaccount" value="No account" style="border:0; background: transparent;"> -->
            <?php if (!isset($_SESSION['reg']) || $_SESSION['reg'] == 0) {
                echo '<a href="index.php?page=1" style="color:white;text-decoration: none;">No account</a>';
            } else {
                echo $_SESSION['ruser'];
            }
            ?>
        </div>
    </div>



</body>

</html>