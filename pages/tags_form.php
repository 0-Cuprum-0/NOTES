<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tags form</title>
</head>

<body>

    <?php
    $link = connect();

    $another = 'SELECT COUNT(*) FROM tags WHERE user_id ="' . $_SESSION['id'] . '" ';
    $aa = mysqli_query($link, $another);   #


    $s = mysqli_fetch_array($aa);
    $_SESSION['tag_count'] = $s[0];
    $_SESSION['tag_left'] = 5 - $_SESSION['tag_count'];
    // echo $_SESSION['tag_left'];
    if ($_SESSION['tag_left'] > 0) {

    ?>


        <div class="container p-0" style="margin-top: 30px;">
            <h3 class="p-0 my-auto">Tags</h3>
            <form action="index.php?page=3" class="p-0" id="myForm" method="POST">
                <div class="form-group p-0">
                    <p class="mt-2">Name new tag:</p>
                    <input type="text" class="form-input  w-25" name="tag_name">
                    <div class="form-check  p-0 my-3">
                        <div class="radio_block">
                            <input type="radio" name="color" id="radio_red" value="#A54441" style="accent-color: #A54441;" checked />
                            <label for="radio_red">Red</label>
                        </div>
                        <div class="radio_block">
                            <input type="radio" name="color" id="radio_pink" value="#BF8E8D" style="accent-color: #BF8E8D;" />
                            <label for="radio_pink">Pink</label>
                        </div>
                        <div class="radio_block">
                            <input type="radio" name="color" id="radio_orange" value="#AE9064" style="accent-color: #AE9064;" />
                            <label for="radio_orange">Orange</label>
                        </div>
                        <div class="radio_block">
                            <input type="radio" name="color" id="radio_light_blue" value="#7CAFC2" style="accent-color: #7CAFC2;" />
                            <label for="radio_light_blue">Light-blue</label>
                        </div>
                        <div class="radio_block">
                            <input type="radio" name="color" id="radio_mint" value="#1ABB9B" style="accent-color: #1ABB9B;" />
                            <label for="radio_mint">Mint</label>
                        </div>
                    </div>
                    <button type="submit" class="button" name="tagbtn">Create</button>
                </div>
            </form>
            <h3 class="p-0 my-1">Your tags</h3>

        <?php
    } else {
        echo '<h4 class="p-0 m-0">You have reached your limit for tags</h4>';
    }






    $link = connect();

    // $colors = array("#A54441", "#BF8E8D", "#AE9064", "#7CAFC2", "#1ABB9B");
    $color = "";
    if (isset($_POST['tagbtn'])) {
        if (isset($_POST)) {
            $color = $_POST['color'];
            $req = 'INSERT INTO tags (name,user_id,color)
                VALUES ("' . $_POST['tag_name'] . '","' . $_SESSION['id'] . '","' . $color . '")';
            $res = mysqli_query($link, $req);
        } else {
            echo '<h1>Dont forget to name your tag!<h1>';
        }
    } ?>
        <p>You cant have more than 5 tags.</p>
        <p>You have <?php echo 5 - $_SESSION['tag_count']; ?> tags left</p>
        <?php

        $req = 'SELECT * FROM tags WHERE user_id="' . $_SESSION['id'] . '"';
        $res = mysqli_query($link, $req);
        while ($row = mysqli_fetch_array($res, MYSQLI_BOTH)) {
            $colors[] = $row['color'];
        }
        // echo $colors;
        $first = isset($colors[0]) ? $colors[0] : 'rgba(0, 0, 0, 0)';
        $second = isset($colors[1]) ? $colors[1] : 'rgba(0, 0, 0, 0)';
        $third = isset($colors[2]) ? $colors[2] : 'rgba(0, 0, 0, 0)';
        $forth = isset($colors[3]) ? $colors[3] : 'rgba(0, 0, 0, 0)';
        $fifth = isset($colors[4]) ? $colors[4] : 'rgba(0, 0, 0, 0)';


        ?>
        <script>
            let firstcolor = "<?php echo $first ?>"
            let secondcolor = "<?php echo $second ?>"
            let thirdcolor = "<?php echo $third ?>"
            let forthcolor = "<?php echo $forth ?>"
            let fifthcolor = "<?php echo $fifth ?>"
        </script>

        <style>
            td:hover {
                background-color: rgba(177, 177, 177, 0.08);
            }

            :root {
                --first: rgba(0, 0, 0, 0);
                --second: rgba(0, 0, 0, 0);
                --third: rgba(0, 0, 0, 0);
                --forth: rgba(0, 0, 0, 0);
                --fifth: rgba(0, 0, 0, 0);
            }



            tr:nth-child(1) td {
                background-color: var(--first);
            }

            tr:nth-child(2) td {
                background-color: var(--second);
            }

            tr:nth-child(3) td {
                background-color: var(--third);
            }

            tr:nth-child(4) td {
                background-color: var(--forth);
            }

            tr:nth-child(5) td {
                background-color: var(--fifth);
            }
        </style>
        <script>
            const root = document.querySelector(':root');
            root.style.setProperty('--first', firstcolor);
            root.style.setProperty('--second', secondcolor);
            root.style.setProperty('--third', thirdcolor);
            root.style.setProperty('--forth', forthcolor);
            root.style.setProperty('--fifth', fifthcolor);
        </script>

        <?php
        $req = 'SELECT * FROM tags WHERE user_id="' . $_SESSION['id'] . '"';
        $res2 = mysqli_query($link, $req);
        echo '<form action="index.php?page=3" method="POST">';
        echo '<table style = "width:30%">';
        while ($row = mysqli_fetch_array($res2, MYSQLI_NUM)) {

            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td><input type="checkbox" name="cb' . $row[1] . '"></td>';

            echo '</tr>';
        }
        echo '</table>';
        echo '<button type="submit" name="delcountry" value="Delete" class="p-0 my-3"> Delete chosen tags!</button>';

        echo '</form>';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        if (isset($_POST['delcountry'])) {
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == 'cb') {
                    $idc = substr($k, 2);
                    $del = 'DELETE FROM tags 
                        WHERE id=' . $idc;
                    mysqli_query($link, $del);
                }
            }
            header("Location:index.php?page=3");
        }



        ?>
        </div>

</body>

</html>