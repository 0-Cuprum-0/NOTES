<?php
header('Access-Control-Allow-Origin: Content-Type');
$link = connect();

// $firstElement = $all[$count - 1];
// $firstName = $firstElement[1];
// $firstdescription = $firstElement[2];
if (isset($_GET['note_id'])) {
    $note_id = $_GET['note_id'];
    $rec = 'SELECT * FROM pages WHERE id = ' . $note_id;
    $rel = mysqli_query($link, $rec);
    $note_info = mysqli_fetch_array($rel);
    $pageName = $note_info[1];
    $pageDescription = $note_info[2];
    $pageContent = $note_info[3];
}


?>
<div class="w-100  p-0  d-flex m-0" style="height:100px;">

    <div class="my-auto">
        <h1 id="Title" contenteditable="true">
            <?php
            if (isset($note_id)) {
                if (isset($pageName)) {
                    echo $pageName;
                }
            }
            ?>
        </h1>
    </div>
</div>
<div class="container p-0" contenteditable="true">
    <p id="Description">
        <?php
        if (isset($note_id)) {
            if (isset($pageDescription)) {
                echo $pageDescription;
            }
        }

        ?>
    </p>
    <p id="Content">
        <?php
        if (isset($note_id)) {
            if (isset($pageContent)) {
                echo $pageContent;
            }
        }
        ?>
    </p>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {




        setInterval(() => AutoSave(), 3000);


        async function AutoSave() {
            var title = document.querySelector("#Title");
            var description = document.querySelector("#Description");
            var content = document.querySelector("#Content");
            const resp = {
                "title": title.textContent,
                "description": description.textContent,
                "content": content.textContent
            }
            // console.log(resp)
            // console.log("AUTOSAAVE")
            //         foreach ($toppings as $topping) {
            // echo $topping, "\n";
            // }
            // console.log(block.textContent)
            const response = await fetch("pages/autosave.php", {
                method: "POST",
                body: JSON.stringify({
                    "title": title.textContent,
                    "description": description.textContent,
                    "content": content.textContent
                }),
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"

                },

            }).then(response => response.json());
            console.log(response)





        };
    })
</script>

<!-- <?php
        include_once("pages/autosave.php");
        ?> -->