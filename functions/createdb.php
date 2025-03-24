<?php
include_once('functions.php');
$link = connect();





$ct1 = 'CREATE TABLE IF NOT EXISTS users (
    id int not null auto_increment primary key,
    login varchar(32) unique,
    pass varchar(128),
    email varchar(128),
    avatar mediumblob
    ) default charset="utf8mb4"';
$ct2 = 'CREATE TABLE IF NOT EXISTS pages(
    id int not null auto_increment primary key,
    page_name varchar (200),
    info text,
    modules text,
    crdate datetime,
    tag varchar(30),
    user_id int,
    pstats text,
    foreign key (user_id) references users(id) on delete cascade) default charset="utf8mb4"';


mysqli_query($link, $ct1);
$err = mysqli_errno($link);
if ($err) {
    echo 'Error code for users:' . $err . '<br>';
    exit();
}

mysqli_query($link, $ct2);
$err = mysqli_errno($link);
if ($err) {
    echo 'Error code for pages:' . $err . '<br>';
    exit();
}



?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>