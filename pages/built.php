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
?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="height:30px;"><?php $element ?></h5>

        </div>
    </div>

<?php

}


#
// echo $count;                                      #                     
                                    #
// echo $aa;                                         #
// echo '</pre>';    



#
// while ($row = mysqli_fetch_assoc($aa)) {  #<------#ПРОВЕРКА ВЫВОДОВ БД
//     echo "<pre>";
//     print_r($row);
//     echo "</pre><hr>";
// }


// for ($i = $_SESSION['num']; $i > 0; $i++) {
//     echo $all[$i]['page_name'];
// }
