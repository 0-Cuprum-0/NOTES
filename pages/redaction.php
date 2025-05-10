<?php
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
    <form action="index.php?page=4" method="POST">
        <div class="my-auto">
            <h1 id="editableParagraph" contenteditable="true">
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
    <p id="descr">
        <?php
        if (isset($note_id)) {
            if (isset($pageDescription)) {
                echo $pageDescription;
            }
        }

        ?>
    </p>
    <p id="info">
        <?php
        if (isset($note_id)) {
            if (isset($pageContent)) {
                echo $pageContent;
            }
        }
        ?>
    </p>
</div>
</form>
<?php ?>