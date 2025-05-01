<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>
<div class=" w-100">
    <form method="POST" class="input-group mx-auto mt-3 mb-5" style="height: 20px;">

        <input type="text" class="form-control" name="search">
        <button type="submit" class="btn btn-outline-secondary" type="button">🔍</button>
    </form>


    <a class="btn btn-outline-secondary" href="index.php?page=<?= $page ?>&page_menu=1" style="color:white;text-decoration: none;">+</a>

    <?php
    // ПРОВЕРКА PAGE И PAGE_MENU
    // if (isset($_GET['page'])) {
    //     echo $_GET['page'];
    // } else {
    //     echo "no page";
    // }
    // if (isset($_GET['page_menu'])) {
    //     echo $_GET['page_menu'];
    // } else {
    //     echo "no page_menu";
    // }
    if (isset($_GET['page_menu'])) {
        $page_menu = $_GET['page_menu'];
        if ($page_menu == 1) {
            include_once("pages/creation_form.php");
        }
    }
    ?>

    <div class="d-flex align-items-start ">
        <!-- сборка заметки -->

    </div>
</div>