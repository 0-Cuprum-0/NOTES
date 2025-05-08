<?php
$link = connect();

// $firstElement = $all[$count - 1];
// $firstName = $firstElement[1];
// $firstdescription = $firstElement[2];

?>
<div class="w-100  p-0  d-flex m-0" style="height:100px;">
    <form action="index.php?page=4" method="POST">
        <div class="my-auto">
            <h1 id="editableParagraph" contenteditable="true">
                <?php
                // echo $firstName;
                ?>
            </h1>
        </div>
</div>
<div class="container p-0" contenteditable="true">
    <p id="descr">
        <?php
        // echo $firstdescription;
        ?>
    </p>
    <p id="info">
        info
    </p>
</div>
</form>
<?php ?>