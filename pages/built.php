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
    $element = $all[$i][1];
    $description = $all[$i][2];
    $cut = substr($description, 0, 20);
    $id = $all[$i][0];
?>
    <div class="card">
        <div class="card-body" data-number="<?= $id ?>" onclick="loadNote(this)">
            <h5 class="card-title" style="height:30px;"><?php echo $element; ?></h5>
            <p class="card-text" style="height:15px;"><?php echo $cut;
                                                        echo "...";
                                                        // echo $id; 
                                                        ?>




            </p>


        </div>
    </div>

<?php

}
?>
<script>
    document.querySelectorAll(".card")


    function loadNote(element) {

        console.log("CLICKEDDDDDD ")
        console.log(element.dataset.number)
        var cardNumber = element.dataset.number
        window.location.href = 'index.php?page=4&note_id=' + cardNumber


    }
</script>