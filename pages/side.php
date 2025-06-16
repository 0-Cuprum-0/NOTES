<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side</title>
</head>

<body>
    <script>
        let params = new URL(document.location.toString()).searchParams;
        let name = params.get("note_id");
        console.log(name)
    </script>

    <?php
    $_SESSION['temp_note_id'] = $_GET['note_id'];
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    $note_id = $_SESSION['temp_note_id'];
    if (isset($_POST['choosetagbtn'])) {
        $note_id = $_GET['note_id'];
        if (!empty($_POST['color'])) {
            $note_id = $_SESSION['temp_note_id'];
            $tagText = $_POST['color'];
            $req = 'UPDATE pages SET tag = "' . $tagText . '" WHERE  id ="' . $note_id . '"';
            $rel = mysqli_query($link, $req);
            header("Location: index.php?page=$page&note_id=$note_id");
            exit();
        } else {
            // echo "NOOOOOOOOOOOOOOOOOOOO";

    ?>
            <script>
                console.log("YOU WONT PASS!!")

                Swal.fire({
                    title: 'Tag is missing',
                    text: 'Choose tag before submitting!',
                    icon: 'error',
                    theme: 'dark',
                    confirmButtonText: 'Cancel'
                })
            </script>
    <?php
        }
    }

    ?>
    <div class="top_menu m-0 d-flex" style=" align-items:center;padding-top:27px;">
        <form method="POST" class=" side_form" style="width: 100%;height:60%;" action="index.php?page=<?= $page ?>&note_id=<?= $_GET['note_id'] ?>">

            <select style="width: 70%;" name=" color">

                <option value="">Tag</option>
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


            <button type="submit" style="width: 30%;" name="choosetagbtn" class="button">Tag</button>
            <?php

            // echo $l;

            unset($_SESSION['temp_note_id']);




            ?>

        </form>

        <form method="POST" action="index.php?page=<?= $page ?>&note_id=<?= $_SESSION['last_note'] ?>">
            <div class="form-group">
                <input type="hidden" name="delnote" value="1">
                <button type="submit" style="height:44px;" class="button">Delete</button>
            </div>
        </form>
        <?php

        $link = connect();
        $l = 'SELECT id FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
        $resullt = mysqli_query($link, $l);
        $indexes = [];
        while ($row = mysqli_fetch_array($resullt, MYSQLI_NUM)) {
            array_push($indexes, $row[0]);
        };
        // print_r($indexes);
        $needed = end($indexes);
        if ($needed == $_GET['note_id']) {
            $needed = prev($indexes);
        }
        // print_r($needed);
        // http: //localhost/bitnami/NOTES/index.php?page=4?note_id=208
        // http: //localhost/bitnami/NOTES/index.php?page=4&note_id=208


        if (isset($_POST['delnote'])) {
            $reqquest = 'DELETE FROM pages WHERE id ="' . $_GET['note_id'] . '"';
            $rell = mysqli_query($link, $reqquest);
            print_r("AAAAAAAAAAPAPPAAPPA");
            header("Location: index.php?page=4&note_id=" . $needed);
            exit();
        }
        // $last_note = $_GET['note_id'] - 1;

        ?>
    </div>

</body>

</html>