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

    $link = connect();
    $rel = 'SELECT COUNT(*) FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
    $number = mysqli_query($link, $rel);
    $s = mysqli_fetch_array($number);
    $count = $s[0];
    $_SESSION['rem'] = $remaining =  $_SESSION['num'] - $count;
    // echo $_SESSION['rem'];

    if (isset($_POST['logout'])) {
    ?><script>
            console.log("SUBMITTEDDDDD")
        </script>
    <?php

        $_SESSION['reg'] = 0;
        unset($_SESSION['ruser']);
        unset($_SESSION['id']);
        header('Location: index.php?page=3');
        exit();
    }
    $_SESSION['title'] = 'Settings';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="w-100  p-0  d-flex m-0" style="height:100px;">
        <h1 class="p-0 my-auto">Settings</h1>
    </div>
    <br class="p-0 m-0">
    <h3 class="p-0 m-0">Account</h3>
    <p class="p-0 m-0 mt-3"> You are <?php
                                        if ($_SESSION['reg'] == 0) {
                                            echo "not registered";
                                        } else {
                                            echo "registered";
                                        ?> as <?php echo $_SESSION['ruser'] ?> that means that you have <?php

                                                                                                        echo $_SESSION['rem'];
                                                                                                        ?> out of <?php echo $_SESSION['num']; ?> notes to create left</p><?php
                                                                                                                                                                        } ?>

<p class="p-0 m-0 mt-3">If you want to change your info, please enter your password here:</p>

<?php
$link = connect();


if (!isset($_POST['newbtn'])) {
?>
    <form action="index.php?page=3" class="p-0 m-0" method="POST" style="height:200px;">
        <div class="form-group">
            <input type="text" class="form-input my-3 w-50" name="pass">
        </div>


        <div class="row m-0">
            <div class="col-sm-4 d-flex flex-column  justify-content-center p-0 me-5 ">

                <div class="form-group">
                    <label class="form-label" for="login">New login:</label>
                    <input type="text" class="form-input" name="newlog">

                </div>


            </div>

            <div class="col-sm-4 d-flex flex-column  justify-content-center p-0  ">

                <div class="form-group">
                    <label class="form-label" for="login">New password:</label>
                    <input type="text" class="form-input" name="newpass">

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="button w-50" name="newbtn">Confirm changes</button>
        </div>

    </form>


    <?php
}
if (isset($_POST['newbtn'])) {

    // echo $_POST;

    if (!empty($_POST['pass']) && !empty($_POST['newlog']) && empty($_POST['newpass'])) {

        if (newlogin($_POST['pass'], $_POST['newlog'])) {
    ?>
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your login has been updated",
                    theme: 'dark',
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(() => {
                    window.location.href = "index.php?page=3";
                }, 1500);
            </script>
        <?php

            // header('Location: index.php?page=3');
            exit();
        }
    }
    if (!empty($_POST['pass']) && !empty($_POST['newpass']) && empty($_POST['newlog'])) {
        if (newpassword($_POST['pass'], $_POST['newpass'])) {

        ?>
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your password has been updated",
                    theme: 'dark',
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(() => {
                    window.location.href = "index.php?page=3";
                }, 1500);
            </script>
        <?php

            // header('Location: index.php?page=3');
            exit();
        }
    }
    if (empty($_POST['pass']) && empty($_POST['newpass']) && empty($_POST['newlog'])) {


        ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Fill the form!",
                theme: 'dark',
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(() => {
                window.location.href = "index.php?page=3";
            }, 1500);
        </script>
    <?php

        // header('Location: index.php?page=3');
        exit();
    }
    if (!empty($_POST['pass']) && !empty($_POST['newpass']) && !empty($_POST['newlog'])) {


    ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "You cant change them all in one time!",
                theme: 'dark',
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(() => {
                window.location.href = "index.php?page=3";
            }, 1500);
        </script>
<?php

        // header('Location: index.php?page=3');
        exit();
    }
} ?>

<?php
if (!isset($_POST['logout'])) {
?>
    <script>
        function confirmm(event) {
            event.preventDefault();


            const Toast = Swal.mixin({
                toast: true,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "Log out",
                confirmButtonColor: '#A54441',
                background: "#fff url(/images/pixil-frame-0.png)",

            });

            Toast.fire({
                icon: "warning",
                title: "Are you sure you want to log out?"
            }).then((result) => {
                if (result.isConfirmed) {

                    console.log("Logging out...");

                    document.getElementById("myForm").submit();
                }
            });
        }
    </script>
    <form action="index.php?page=3" class="p-0" id="myForm" method="POST">
        <div class="form-group">
            <input type="hidden" name="logout" value="1">
            <button onclick="confirmm(event)" type="button" class="button mt-3">Log out</button>
        </div>
    </form>



<?php
    // echo $_SESSION['id'];
}
include_once("pages/tags_form.php");



?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>


<style>

</style>
</body>

</html>