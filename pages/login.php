<?php
// echo $_SESSION['reg'], $_SESSION['ruser'];
$link = connect();

if (!isset($_POST['logbtn'])) {
?>
    <form action="index.php?page=2" method="POST">
        <div class="form-group">
            <label class="form-label" for="login">Login:</label>
            <input type="text" class="form-control" name="login">
        </div>
        <div class="form-group">
            <label class="form-label" for="pass">Password:</label>
            <input type="password" class="form-control" name="pass">
        </div>


        <button type="submit" class="btn btn-outline-info" name="logbtn">Login</button>
        <a href="index.php?page=1">I am not registered!</a>

    </form>
<?php
} else {
    $link = connect();
    if (login($_POST['login'], $_POST['pass'])) {
        $_SESSION['reg'] = 1;

        header('Location: index.php');
        exit();
    }
    // if (login($_POST['login'], $_POST['pass'])) {
    //     $_SESSION['reg'] = 1;
    //     echo $_SESSION['reg'], $_SESSION['ruser'];

    //     echo "<h3><span style='color: green;'>Logged in sucsessfully!</span></h3>";
    //     header('Location: index.php'); // <--- Переход на главную
    //     exit();
    // }
} ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>