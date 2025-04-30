<div class="w-100  p-0  d-flex m-0" style="height:100px;">
    <h1 class="p-0 my-auto">Registration</h1>
</div>
<?php


$link = connect();

if (!isset($_POST['regbtn'])) {
?>
    <form action="index.php?page=1" method="POST">
        <div class="form-group">
            <label class="form-label" for="login">Login:</label>
            <input type="text" class="form-control" name="login">
        </div>
        <div class="form-group">
            <label class="form-label" for="pass1">Password:</label>
            <input type="password" class="form-control" name="pass1">
        </div>
        <div class="form-group">
            <label class="form-label" for="pass2">Confirm password:</label>
            <input type="password" class="form-control" name="pass2">
        </div>
        <div class="form-group">
            <label class="form-label" for="email">E-mail address:</label>
            <input type="email" class="form-control" name="email">
        </div>
        <button type="submit" class="btn btn-outline-info" name="regbtn">Register</button>
        <a href="index.php?page=2">I already have one!</a>

    </form>
<?php
} else {
    if (register($_POST['login'], $_POST['pass1'], $_POST['email'])) {
        echo "<h3><span style='color: green;'>New user Added!</span></h3>";
    }
} ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>