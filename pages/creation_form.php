<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
include_once('pages/functions.php');
?>
<div class="d-flex align-items-start h-100 ">
    <!-- форма создания -->
    <form action="index.php?page=<?= $page ?>&page_menu=1" method="POST" class="input-group mx-auto mt-3 mb-5" style="height: 20px;">
        <div class="form-group m-0 w-100">
            <textarea type="text" class="form-control my-1" name="title" placeholder="Name" style="height:25px;"></textarea>
            <textarea type="text" class="form-control my-1" name="descr" placeholder="Description"></textarea>
        </div>

        <button type="submit" class="btn btn-outline-info" name="createbtn">Create</button>
    </form>
</div>

<?php

if (isset($_POST['createbtn'])) {
    $note = new Note($_POST['title']); #может сразу инициализировать с параметрами из пост?
    $note->set_title($_POST['title']);
    print_r($note);
    // echo "fdjlkevnmjlkfevnjlkfem";
}
?>