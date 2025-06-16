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
    if (isset($_GET['note_id']) && $_GET['note_id'] != null) {

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
    <div class="w-100  p-0  d-flex m-0" id="sticky_top" style="height:100px;position: sticky;
top: 0;background: linear-gradient(#121212, rgba(0, 0, 0, 0));">


        <h1 id="Title" contenteditable="true" maxlength="25" style="height:100%;padding-top: 27px; width: 75%;">
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
        <?php
        include_once("pages/side.php")
        ?>
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
        <p id="Content" spellcheck="false" class="musthover my-auto w-100 " style="height: 100%;overflow-wrap: break-word;">
            <?php
            if (isset($note_id)) {
                if (isset($pageContent)) {
                    echo $pageContent;
                }
            }
            ?></p>
    </div>
    <script>
        // REMOVE FORMATTING------------------------------------------------
        document.querySelector('div[contenteditable="true"]').addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });
        // -----------------------------------------------------------------------
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