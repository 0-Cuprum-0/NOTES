<h1 class="p-0 m-0">Settings</h1>
<br class="p-0 m-0">
<h3 class="p-0 m-0 mt-3">Account</h3>
<p class="p-0 m-0 mt-3"> You are <?php
                                    if ($_SESSION['reg'] == 0) {
                                        echo "not";
                                    } else {
                                        echo "";
                                    }
                                    ?> registered as <?php echo $_SESSION['ruser'] ?> that means that you have<?php ?> notes to create left</p>

<p class="p-0 m-0 mt-3">If you want to change your info, please enter your password here:</p>

<?php
$link = connect();

if (!isset($_POST['newbtn'])) {
?>
    <form action="index.php?page=3" method="POST">
        <div class="form-group">
            <input type="text" class="form-control mt-3 w-50" name="pass">
        </div>


        <div class="row h-100">
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
            <button type="submit" class="btn btn-outline-light mt-3" name=" newbtn">Confirm changes</button>

    </form>



<?php
} else {
    if (newlogin($_POST['pass'], $_POST['newlog'])) {
        echo "<h3><span style='color: green;'>You've changed your login!</span></h3>";
    }
}
// echo $_POST['pass']; 
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

<?php
// echo $_SESSION['reg'], $_SESSION['ruser'];
