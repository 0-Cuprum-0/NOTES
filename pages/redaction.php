<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php
    header('Access-Control-Allow-Origin: Content-Type');
    $link = connect();
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }


    // $firstElement = $all[$count - 1];
    // $firstName = $firstElement[1];
    // $firstdescription = $firstElement[2];
    if (isset($_GET['note_id'])) {

        $note_id = $_GET['note_id'];
        $rec = 'SELECT * FROM pages WHERE id = ' . $note_id;
        $rel = mysqli_query($link, $rec);
        $note_info = mysqli_fetch_array($rel);
        if ($note_info) {
            $pageName = $note_info[1];
            $pageDescription = $note_info[2];
            $pageContent = $note_info[3];
        }
    }


    ?>
    <div class="w-100  p-0  d-flex m-0" style="height:100px;">

        <div class="w-100 d-flex h-100">
            <h1 id="Title" contenteditable="true" class="musthover w-100 h-100" maxlength="25" style="padding-top: 27px;">
                <?php
                if (isset($note_id)) {
                    if (isset($pageName)) {
                        echo $pageName;
                    } else {
                        echo '<br>';
                    }
                }
                ?>
            </h1>
            <? $res = mysqli_query($link, "SELECT * FROM tags");
            ?>
            <form action="index.php?page=<?= $page ?>" method="POST" class="input-group mx-auto">
                <div class="top_menu p-0 m-0" style="width: 100px;height:100px; ">
                    <select name="color">

                        <option value="0">Tag</option>
                        <?php
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo '<option value="' . $row[0] . '"  >  "' . $row[0] . '" </option>';
                        }
                        mysqli_free_result($res);
                        ?>
                    </select>
                    <button type="submit" name="choosetagbtn">Tag it!</button>
                    <?php
                    // if (isset($_POST['choosetagbtn'])) {
                    //     if (isset($_POST['color'])) {
                    //     }
                    // }
                    ?>

                </div>
            </form>
        </div>
    </div>
    <div class="container p-0" contenteditable="true">
        <p id="Description" class="musthover my-auto w-100 " style="height: 100px;" maxlength="100">
            <?php
            if (isset($note_id)) {
                if (isset($pageDescription)) {
                    echo $pageDescription;
                }
            } ?>
        </p>
        <p id="Content" class="musthover my-auto w-100 " style="height: 556px;">
            <?php
            if (isset($note_id)) {
                if (isset($pageContent)) {
                    echo $pageContent;
                }
            }
            ?></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log("LOADED")


            setTimeout(() => {
                console.log("Waited 3 seconds!");
            }, 3000);




            setInterval(() => {
                if (autosaveEnabled) {
                    AutoSave();
                }
            }, 7000);


            async function AutoSave() {
                let params = new URL(document.location.toString()).searchParams;
                let name = params.get("note_id");
                console.log(name)
                var title = document.querySelector("#Title");
                var description = document.querySelector("#Description");
                var content = document.querySelector("#Content");
                if (!title.textContent.trim() && !description.textContent.trim() && !content.textContent.trim()) {
                    console.log("Skipping autosave due to empty content");
                    return;
                }

                // const resp = {
                //     "title": title.textContent,
                //     "description": description.textContent,
                //     "content": content.textContent,

                // }
                // console.log(resp)
                // console.log("AUTOSAAVE")
                //         foreach ($toppings as $topping) {
                // echo $topping, "\n";
                // }
                // console.log(block.textContent)
                let response = await fetch("pages/autosave.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "title": title.textContent.trim(),
                        "description": description.textContent.trim(),
                        "content": content.textContent.trim(),
                        "id": name
                    }),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"

                    },

                }).then(response => response.json());
                // console.log(response)





            };
        })
    </script>

    <!-- <?php
            include_once("pages/autosave.php");
            ?> -->

    <?php
    // $link = connect();
    // $rec = 'UPDATE pages 
    //             SET page_name = "NAAAMEEE", description = "' . $note_description . '",info = "' . $note_content . '"
    //             WHERE id="' . $_GET['note_id'] . '"';
    // $res = mysqli_query($link, $rec);

    ?>

    <style>

    </style>

</body>

</html>