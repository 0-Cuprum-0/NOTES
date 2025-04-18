<?php
$link = connect();
session_start();
#echo "HELLLO USER";
if ($_SESSION['reg'] == true) {
    echo "QQQQ";
    $sel = 'SELECT name FROM users WHERE id = ' . $_SESSION['usr_id']; #IT MUST BE SET DURING REGISTRATION!!!;####
    $rel = mysqli_query($link, $sel);                                 ###AND DB MUST NOT BE EMPTY
    echo $rel;
    echo '<div class="user"> <p>' . $rel . '<p></div>';
} else {
    echo 'AGAIN?';
    $sel = 'SELECT * FROM users  ';
    $res = mysqli_query($link, $sel);
    echo $res;
    if (mysqli_num_rows($res) > 0) {
        while ($row = $res->fetch_assoc()) {
            $sel = 'SELECT * FROM users ';
            $rel = mysqli_query($link, $sel);
            $imageData = base64_encode($row['avatar']);
            echo $imageData;
            echo '<img src="data:image/png;base64,' . base64_encode($row['avatar']) . '" alt="Avatar">';
        };
    } else {
        echo "111";
    }



    // if ($res->num_rows > 0) {
    //     $img = $res->fetch_assoc();
    //     echo $img['image'];
    // } else {
    //     echo 'Image not found...';
    // };

};
