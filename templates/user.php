<?php
echo "HELLLO USER";
if ($_SESSION['reg'] == true) {
    $sel = 'SELECT name FROM users WHERE id = ' . $_SESSION['usr_id']; #IT MUST BE SET DURING REGISTRATION!!!;####ЭТО ДОЛЖНО РАБОТАТЬ
    $rel = mysqli_query($link, $sel);                                 ###AND DB MUST NOT BE EMPTY
    echo $rel;
    echo '<div class="user"> <p>' . $rel . '<p></div>';
} else {
    #echo 'AGAIN?';

};
