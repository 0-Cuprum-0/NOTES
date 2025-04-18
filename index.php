<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTES</title>
</head>

<body>
    <?php
    session_start();
    $link = connect();
    $_SESSION['reg'] = true;
    include_once('templates/user.php');
    include_once('templates/menu.php');


    $sel = 'SELECT * FROM users
        WHERE id=1 ';
    $res = mysqli_query($link, $sel);
    echo '<table >';
    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        echo '<tr>';

        $img = base64_encode("avatar");
        echo '<td><img height="100px" src="data:image/jpeg; base64,' . $img . '"></td>';
    }
    mysqli_free_result($res);
    echo '</table>';




    #echo "HELLOWORLD!!"
    #

    ?>

</body>

</html>