<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tags form</title>
</head>

<body>
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
        <h3 class="p-0 my-auto">Your tags</h3>

        <?php


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
        }

        $req = 'SELECT * FROM tags WHERE user_id="' . $_SESSION['id'] . '"';
        $res = mysqli_query($link, $req);
        echo '<table class="table" style = "width:50%;backround-color:#121212 !important">';
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '</tr>';
        }
        echo '</table>';



        ?>
    </div>
</body>

</html>