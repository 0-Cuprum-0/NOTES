<?php
function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = '',
    $dbname = 'notes'
) {
    $link = mysqli_connect($host, $user, $pass) or die('connection error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link, "set names 'utf8mb4'");
    return $link;
    echo $link;
}
function register($name, $pass, $email)
{
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    if ($name == "" || $pass == "" || $email == "") {
        echo "<h3><span style='color: red;'>Fill All Required Fields</span></h3>";
        return false;
    }
    if (
        strlen($name) < 3 || strlen($name) > 30 ||
        strlen($pass) < 3  || strlen($name) > 30
    ) {
        echo "<h3><span style='color: red;'>Values length error</span></h3>";
        return false;
    }
    $ins = 'INSERT INTO users (login, pass, email, roleid)
            VALUES ("' . $name . '","' . md5($pass) . '","' . $email . '", 2)';
    $link = connect();
    mysqli_query($link, $ins);
    $err = mysqli_errno($link);
    if ($err) {
        if ($err == 1062) {
            echo "<h3><span style='color: red;'>User is already exists!</span></h3>";
        } else {
            echo "<h3><span style='color: red;'>Error code: " . $err . "!</span></h3>";
        }
        return false;
    }
    return true;
}
function login($name, $pass)
{
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    if ($name == "" || $pass == "") {
        echo "<h3><span style='color:red;'>Fill All Required Fields</span></h3>";
        return false;
    }
    if (
        strlen($name) < 5 || strlen($name) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<h3><span style='color:red;'>Value Must Be Between 5 and 15!</span></h3>";
        return false;
    }
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>