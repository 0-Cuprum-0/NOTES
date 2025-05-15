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
        <h1 class="p-0 my-auto">Registration</h1>
    </div>
    <?php


    $link = connect();

    if (!isset($_POST['regbtn'])) {
    ?>
        <form action="index.php?page=1" method="POST">
            <div class="form-group">
                <label class="form-label" for="login" style="margin-right:28px">Login:</label>
                <input type="text" class="form-input" name="login" style="height: 39px; width: 170px; margin:10px">
            </div>
            <div class="form-group">
                <label class="form-label" for="pass1">Password:</label>
                <input type="password" class="form-input" name="pass1" style="height: 39px; width: 170px; margin:10px">
            </div>
            <div class="form-group">
                <label class="form-label" for="pass2" style="margin-right:10px">Confirm:</label>
                <input type="password" class="form-input" name="pass2" style="height: 39px; width: 170px; margin:10px">
            </div>
            <div class="form-group" style="height:59px; width:1309px;">
                <label class="form-label" for="email" style="margin-right:20px">E-mail:</label>
                <input type="email" class="form-input" name="email" style="height: 39px; width: 170px; margin:10px">
            </div>
            <button type="submit" class="button" name="regbtn">Register</button>
            <a href="index.php?page=2" class="button">I already have one!</a>

        </form>
    <?php
    } else {
        if (register($_POST['login'], $_POST['pass1'], $_POST['email'])) {
            echo "<h3><span style='color: green;'>New user Added!</span></h3>";
        }
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

</body>

</html>