<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="w-100  p-0  d-flex m-0" style="height:100px;">
        <h1 class="p-0 my-auto">Log into your account</h1>
    </div>
    <?php
    $_SESSION['title'] = 'Log in';

    // echo $_SESSION['reg'], $_SESSION['ruser'];
    $link = connect();

    if (!isset($_POST['logbtn'])) {
    ?>
        <form action="index.php?page=2" method="POST">
            <div class="form-group">
                <label for="login" style="margin-right:28px">Login:</label>
                <input type="text" class="form-input" class="form-input" name="login" style="height: 39px; width: 170px; margin:10px">
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" name="pass" class="form-input" style="height: 39px;width: 170px; margin:10px">
            </div>


            <button type="submit" class="button" name="logbtn" style="width: 65;">Login</button>
            <a href="index.php?page=1" class="button">I am not registered!</a>

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

</body>

</html>