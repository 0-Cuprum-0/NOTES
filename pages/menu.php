<?php
$link = connect();
$rel = 'SELECT COUNT(*) FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
$number = mysqli_query($link, $rel);
$s = mysqli_fetch_array($number);
$count = $s[0];
$_SESSION['rem'] = $remaining =  $_SESSION['num'] - $count;
// echo $_SESSION['rem'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <title>menu</title>
</head>

<body>

    <div class="w-100 d-flex flex-column">


        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (!isset($_GET['page'])) {
            $page = 3;
        }
        ?>

        <form method="POST" class="input-group">

            <input type="text" class="form-control" name="search">
            <button type="submit" class="btn btn-outline-secondary" type="button">🔍</button>
        </form>
        <div class="overflow-y-scroll" style="height: 350px;">
            <!-- сдесь будут заметки -->
            <?php
            include_once('pages/built.php')
            ?>
        </div>





        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        include_once('pages/functions.php');
        ?>
        <div class="d-flex flex-column mt-2">

            <!-- форма создания -->
            <form action="index.php" method="POST" class="input-group mx-auto" id="create_div">
                <div class="form-group m-0 w-100">
                    <textarea type="text" class="form-control my-1" name="title" placeholder="Name" style="height:25px;"></textarea>
                    <textarea type="text" class="form-control my-1" name="descr" placeholder="Description"></textarea>
                </div>

                <button type="submit" class="btn btn-outline-info" name="createbtn">Create</button>
            </form>
            <?php
            // include_once('pages/built.php')
            ?>
        </div>

        <?php

        if (isset($_POST['createbtn'])) {
            if (isset($_POST['title'])) { #######################################################
                $note = new Note($_POST['title']);
                $note->create_note($_POST['title']);
            } else {
                echo "<h3>SET NAME!</h3>";
            }
        }
        ?>

        <?php
        // ПРОВЕРКА PAGE И PAGE_MENU
        // if (isset($_GET['page'])) {
        //     echo $_GET['page'];
        // } else {
        //     echo "no page";
        // }
        // if (isset($_GET['page_menu'])) {
        //     echo $_GET['page_menu'];
        // } else {
        //     echo "no page_menu";
        // }
        // if (isset($_GET['page_menu'])) {
        //     $page_menu = $_GET['page_menu'];
        //     if ($page_menu == 1) {
        //         include_once("pages/creation_form.php");
        //     }
        // }
        ?>

        <div class="align-items-start ">
            <?php
            // include_once('pages/built.php');
            ?>
            <!-- сборка заметки -->

        </div>

        <div class="w-100 p-0 fixed-bottom" style="height: 70px;">
            <a href="index.php?page=3" style="text-decoration: none;">
                <img class="m-0 p-0" width="55" height="55" src="images/settings.png" alt="settings button" />
            </a>
            <a class="btn btn-outline-secondary" id="btn_slide" style="color:white;text-decoration: none;">+</a>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const button = document.getElementById('btn_slide');
            const createDiv = document.getElementById('create_div');

            let open = false;
            button.addEventListener("click", () => {
                open = !open;
                if (open) {
                    createDiv.classList.add('slide');
                    console.log("OPENED")
                } else {
                    createDiv.classList.remove('slide');
                }
            });
        });
    </script>
</body>

</html>