<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
</head>

<body>
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



    <body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <div class=" w-100 d-flex flex-column">


            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            if (!isset($_GET['page'])) {
                $page = 3;
            }

            // echo $_SESSION['rem'];

            if (isset($_POST['createbtn'])) {
                if (isset($_POST['title'])) { #######################################################
                    if ($_SESSION['rem'] > 0) {
                        $note = new Note($_POST['title']);
                        $note->create_note($_POST['title'], $_POST['descr']);
                        header("Location: index.php?page=4");
                    } else {
                        // echo "NOOOOOOOOOOOOOOOOOOOO";

            ?>
                        <script>
                            console.log("YOU WONT PASS!!")

                            Swal.fire({
                                title: 'Error!',
                                text: 'You have reached your limit for notes!',
                                icon: 'error',
                                confirmButtonText: 'Cancel'
                            })
                        </script>
            <?php
                    }
                } else {
                    echo "<h3>SET NAME!</h3>";
                }
            }



            ?>

            <form method="POST" class="container input-group w-100 p-0" style="border-radius: 3px;">

                <input type="text" class="form-input w-75 " name="search">
                <button type="submit" class="p-0 w-25" name="searchbtn" type="button"><img class="m-0 p-0" width="40" height="40" src="images/glass_pixel.png" alt="search button" /></button>
            </form>
            <div class="overflow-y-scroll" style="height: 350px;">
                <?php
                if (isset($_POST['searchbtn'])) {
                    if (isset($_POST['search'])) {
                        include_once('pages/search.php');
                    }
                } else {

                    include_once('pages/built.php');
                }

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
                <form action="index.php?page=<?= $page ?>" method="POST" class="input-group mx-auto">
                    <div class="form-group m-0 w-100">
                        <textarea type="text" class="form-input my-1 w-100" name="title" placeholder="Name" maxlength="25" style="height:35px;"></textarea>
                        <textarea type="text" class="form-input my-1 w-100" name="descr" placeholder="Description" maxlength="100"></textarea>
                    </div>

                    <button type="submit" class="button" name="createbtn">Create</button>
                </form>
                <?php
                // include_once('pages/built.php')
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
            </div>
            <div class="align-items-start ">
            </div>

            <div class="w-100 p-0 fixed-bottom" style="height: 70px;">
                <a href="index.php?page=3" style="text-decoration: none;">
                    <img class="m-0 p-0" width="55" height="55" src="images/sett_pixel.png" alt="settings button" />
                </a>
                <!-- <a class="btn btn-outline-secondary" id="btn_slide" style="color:white;text-decoration: none;">+</a> -->

            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
        <!-- <script>
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
    </script> -->
    </body>
    <style>

    </style>

    </html>

</body>

</html>