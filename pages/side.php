<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ?>
    <form action="index.php?page=<?= $page ?>" method="POST" class="input-group">
        <div class="top_menu p-0 m-0" style="width: 100px;height:100px; ">
            <select name="color">

                <option value="0">Tag</option>
                <?php
                $res = mysqli_query($link, 'SELECT * FROM tags WHERE user_id="' . $_SESSION['id'] . '"');
                // if (mysqli_num_rows($res) == 0) {
                //     echo "<p>Нет тегов для этого пользователя</p>";
                // }
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                mysqli_free_result($res);
                ?>
            </select>

            <button type="submit" name="choosetagbtn">Tag it!</button>
            <?php
            // echo $l;
            // if (isset($_POST['choosetagbtn'])) {
            //     if (isset($_POST['color'])) {
            //     }
            // }
            ?>

        </div>
    </form>

</body>

</html>