<?php
if ($_SESSION['reg'] == true) {
    $sel = 'SELECT name FROM users WHERE id = ' . $_SESSION['usr_id'];
    $rel = mysqli_query($link, $sel);
    echo '<div class="user"> <p>' . $rel . '<p></div>';
} else {
};
