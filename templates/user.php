<?php
#echo "HELLLO USER";
if ($_SESSION['reg'] == true) {
    $sel = 'SELECT name FROM users WHERE id = ' . $_SESSION['usr_id']; #IT MUST BE SET DURING REGISTRATION!!!;####ЭТО ДОЛЖНО РАБОТАТЬ
    $rel = mysqli_query($link, $sel);                                 ###AND DB MUST NOT BE EMPTY
    echo $rel;
    echo '<div class="user"> <p>' . $rel . '<p></div>';
} else {
    echo 'AGAIN?';
    $sel = 'SELECT avatar FROM users WHERE id = 1 ';



    echo 'aaaaaaaaa';
    $res = mysqli_query($link, $sel);

    while ($row = $res->fetch_assoc()) {
        $imageData = base64_encode($row['avatar']);
        echo $imageData;
        echo '<img src="data:image/png;base64,' . $imageData . '" alt="Avatar">';
    };


    // if ($res->num_rows > 0) {
    //     $img = $res->fetch_assoc();
    //     echo $img['image'];
    // } else {
    //     echo 'Image not found...';
    // };

};
