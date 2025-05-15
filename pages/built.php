<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet">
    <title>Document</title>
</head>
<script>
    var colors = [];
</script>

<body>
    <?php
    $link = connect();
    $rel = 'SELECT * FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ORDER BY crdate';
    $res = mysqli_query($link, $rel); #тут все норм  
    $another = 'SELECT COUNT(*) FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
    $aa = mysqli_query($link, $another);   #
    $all = [];
    $s = mysqli_fetch_array($aa);

    $count = $s[0];
    for ($i = $count; $i > 0; $i--) {                                         #
        if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {    #
            array_push($all, $row);                           #
        }
    }
    $count = $s[0];
    for ($i = $count - 1; $i >= 0; $i--) {
        $tagId = $all[$i][6];

        $req = 'SELECT name FROM tags WHERE id = "' . $tagId . '"';
        $res = mysqli_query($link, $req);
        $tag_name = mysqli_fetch_array($res);
        $req3 = 'SELECT color FROM tags WHERE id = "' . $tagId . '"';
        $res3 = mysqli_query($link, $req3);

        if ($res3 && mysqli_num_rows($res3) > 0) {
            $row = mysqli_fetch_assoc($res3);
            $tag_color = $row['color'];
        }


        // print_r($tag_color);


        $element = $all[$i][1];
        $description = $all[$i][2];
        $cut = substr($description, 0, 20);
        $id = $all[$i][0];









        #-----------------------TAGS-----------------------------#
        $color = isset($tag_color) ? $tag_color : 'rgb(59, 59, 59)';
        // echo $color;


    ?>
        <script>
            colors["<? echo $i ?>"] = "<? echo $color ?>";
            console.log(colors["<? echo $i ?>"])
        </script>


        <style>
            :root {
                --color: rgb(255, 0, 0);

            }



            .tag_text {
                color: var(--color);
            }
        </style>

        <div class="my_card">
            <div class="card-body" style="h-100 w-100" data-number="<?= $id ?>"><!--onclick="loadNote(this)" убрано -->
                <h5 class="card-title" style="height:30px;"><?php echo $element; ?></h5>
                <p class="card-text" style="height:15px;"><?php echo $cut;
                                                            // echo "...";
                                                            // echo $id; 
                                                            ?></p>
                <p class="tag_text" style="height:10px;"><?php if ($tag_name !== null) { // the record was found and can be worked with
                                                                echo $tag_name['name'];
                                                            };

                                                            ?></p>


            </div>
        </div>

    <?php

    }
    ?>
    <script>
        let autosaveEnabled = true;
        // document.querySelectorAll(".card-body") //ИЗМЕНЕНО!

        document.querySelectorAll('.card-body').forEach(card => {
            card.addEventListener('click', () => {
                autosaveEnabled = false;
                console.log("CLICKED JS");
                const cardNumber = card.dataset.number;
                window.location.href = 'index.php?page=4&note_id=' + cardNumber;
            });
        });



        // function loadNote(element) {


        //     console.log("CLICKEDDDDDD ")
        //     console.log("aaaaaaaaaaaaa ")
        //     console.log(element.dataset.number)
        //     var cardNumber = element.dataset.number
        //     window.location.href = 'index.php?page=4&note_id=' + cardNumber


        // }
    </script>
    <style>
        .my_card {
            background-color: #121212;
            color: #D8D8D8 !important;
            transition: background-color 1s, box-shadow 1s;
            height: 100px;
        }

        .my_card:hover {
            background-color: rgb(11, 11, 11);
            box-shadow: inset 0 2px 4px rgba(90, 100, 110, 0.4),
                inset 0 -2px 4px rgba(90, 100, 110, 0.3),
                inset 2px 0 4px rgba(90, 100, 110, 0.2),
                inset -2px 0 4px rgba(90, 100, 110, 0.1);

        }
    </style>

</body>

</html>