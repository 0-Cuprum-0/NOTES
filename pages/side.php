<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        let params = new URL(document.location.toString()).searchParams;
        let name = params.get("note_id");
        console.log(name)
    </script>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ?>
    <form action="index.php?page=<?= $page ?>&note_id=<?= $_GET['note_id'] ?>" method="POST" class="input-group">
        <div class="top_menu p-0 m-0" style="width: 100px;height:100px; ">
            <select name="color">

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

            <button type="submit" class="my-3" name="choosetagbtn">Tag it!</button>
            <?php

            // echo $l;
            $note_id = $_GET['note_id'];
            if (isset($_POST['choosetagbtn'])) {
                if (isset($_POST['color'])) {
                    $tagText = $_POST['color'];
                    $req = 'UPDATE pages SET tag = "' . $tagText . '" WHERE  id ="' . $note_id . '"';
                    $rel = mysqli_query($link, $req);
                    header("Location: index.php?page=$page&note_id=$note_id");
                    exit();
                }
                if ($_POST['color'] == "") {
                    // echo "NOOOOOOOOOOOOOOOOOOOO";

            ?>
                    <script>
                        console.log("YOU WONT PASS!!")

                        Swal.fire({
                            title: 'Tag is missing',
                            text: 'Choose tag before submitting!',
                            icon: 'error',
                            confirmButtonText: 'Cancel'
                        })
                    </script>
            <?php
                }
            }
            ?>

        </div>
    </form>

</body>

</html>