<?php
$link = connect();
$rel = 'SELECT * FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ORDER BY crdate';
$res = mysqli_query($link, $rel); #тут все норм       #
$all = [];
for ($i = $_SESSION['num']; $i > 0; $i++) {                                         #
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {    #
        array_push($all, $row);                           #
    }
}                                                  #
// echo '<pre>';                                      #                     
print_r($all);                                     #
// echo $res;                                         #
// echo '</pre>';                                     #
// while ($row = mysqli_fetch_assoc($res)) {  #<------#
//     echo "<pre>";
//     print_r($row);
//     echo "</pre><hr>";
// }

// for ($i = $_SESSION['num']; $i > 0; $i++) {
//     echo $all[$i]['page_name'];
// }
