<?php
if (isset($_POST['logout'])) {
?><script>
        console.log("SUBMITTEDDDDD")
    </script>
<?php

    $_SESSION['reg'] = 0;
    unset($_SESSION['ruser']);
    header('Location: index.php');
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
                                    ?> as <?php echo $_SESSION['ruser'] ?> that means that you have<?php ?> notes to create left</p><?php
                                                                                                                                } ?>

<p class="p-0 m-0 mt-3">If you want to change your info, please enter your password here:</p>

<?php
$link = connect();


if (!isset($_POST['newbtn'])) {
?>
    <form action="index.php?page=3" class="p-0 m-0" method="POST" style="height:200px;">
        <div class="form-group">
            <input type="text" class="form-control my-3 w-50" name="pass">
        </div>


        <div class="row m-0">
            <div class="col-sm-4 d-flex flex-column  justify-content-center p-0 me-5 ">

                <div class="form-group">
                    <label class="form-label" for="login">New login:</label>
                    <input type="text" class="form-control" name="newlog">

                </div>


            </div>

            <div class="col-sm-4 d-flex flex-column  justify-content-center p-0  ">

                <div class="form-group">
                    <label class="form-label" for="login">New password:</label>
                    <input type="text" class="form-control" name="newpass">

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-outline-light w-50" name="newbtn">Confirm changes</button>
        </div>

    </form>


<?php
} else {
    if (isset($_POST['pass']) and isset($_POST['newlog'])) {
        if (newlogin($_POST['pass'], $_POST['newlog'])) {
            echo "<h3><span style='color: green;'>You've changed your login!</span></h3>";
            header('Location: index.php');
            exit();
        }
    }
    if (isset($_POST['pass']) and isset($_POST['newpass'])) {
        if (newpassword($_POST['pass'], $_POST['newpass'])) {
            echo "<h3><span style='color: green;'>You've changed your password!</span></h3>";
            header('Location: index.php');
            exit();
        }
    }
    if (isset($_POST['pass']) and isset($_POST['newpass']) and isset($_POST['newlog'])) {
        header('Location: index.php');
        exit();
        echo "You cant change them both at one time";
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
                confirmButtonColor: '#7E5A9B',
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
            <button onclick="confirmm(event)" type="button" class="btn btn-outline-light mt-3">Log out</button>
        </div>



    <?php

}



    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

    <?php
