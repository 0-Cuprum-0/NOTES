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
    $ins = 'INSERT INTO users (login, pass, email)
            VALUES ("' . $name . '","' . md5($pass) . '","' . $email . '")';
    $_SESSION['reg'] = 1;
    $link = connect();
    try {
        mysqli_query($link, $ins);
    } catch (mysqli_sql_exception $e) {
        $errno = $e->getCode();

        if ($errno == 1062) {
            echo "<h3><span style='color: red;'></span></h3>"; #??????????????????
        } else {
            echo "<h3><span style='color: red;'>Error code: " . $errno . "!</span></h3>";
        }
    }

    $err = mysqli_errno($link);
    if ($err) {
        if ($err == 1062) {
            echo "<h3><span style='color: red;'>User already exists!</span></h3>";
        } else {
            echo "<h3><span style='color: red;'>Error code: " . $err . "!</span></h3>";
        }
        return false;
    }
    return true;
}
function login($name, $pass)
{
    $link = connect();
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
    $sel = 'SELECT * FROM users 
            WHERE login="' . $name . '" and pass="' . md5($pass) . '"';
    $res = mysqli_query($link, $sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        $_SESSION['ruser'] = $name;
        // $_SESSION['reg'] = 1;


        return true;
    } else {
        echo "<h3><span style='color: red;'>No Such User!</span></h3>";
        return false;
    }
}
function newlogin($pass, $newlogin)
{
    $link = connect();
    $newname = trim(htmlspecialchars($newlogin));
    $pass = trim(htmlspecialchars($pass));
    if ($newname == "" || $pass == "") {
        echo "<h3><span style='color:red;'>Fill All Required Fields</span></h3>";
        return false;
    }
    if (
        strlen($newname) < 5 || strlen($newname) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<h3><span style='color:red;'>Value Must Be Between 5 and 15!</span></h3>";
        return false;
    }
    $sel = 'SELECT * FROM users 
            WHERE login="' . $newname . '"';
    $res = mysqli_query($link, $sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        if ($row[1] == $newname) {
            echo "There is already login like this one in use)";
            return false;
        }
    }
    $sel = 'SELECT * FROM users 
            WHERE login="' . $_SESSION['ruser'] . '"';
    $res = mysqli_query($link, $sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        if ($row[2] != md5($pass)) {
            echo "Not this password";
            return false;
        }
    }



    $sel = 'UPDATE users 
            SET login = "' . $newname . '"
            WHERE login="' . $_SESSION['ruser'] . '" and pass="' . md5($pass) . '"';
    $res = mysqli_query($link, $sel);
    // echo $res, $_SESSION['ruser'];
    // echo "can be changed ";
    $_SESSION['ruser'] = $newname;
    return true;



    // } else {
    //     echo "<h3><span style='color: red;'>No Such User!</span></h3>";
    //     return false;
    // }
}
function newpassword($pass, $newpass)
{
    $link = connect();
    $newname = trim(htmlspecialchars($newpass));
    $pass = trim(htmlspecialchars($pass));
    if ($newname == "" || $pass == "") {
        echo "<h3><span style='color:red;'>Fill All Required Fields</span></h3>";
        return false;
    }
    if (
        strlen($newname) < 5 || strlen($newname) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<h3><span style='color:red;'>Value Must Be Between 5 and 15!</span></h3>";
        return false;
    }

    $sel = 'SELECT * FROM users 
            WHERE login="' . $_SESSION['ruser'] . '"';
    $res = mysqli_query($link, $sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        if ($row[2] != md5($pass)) {
            echo "Not this password";
            return false;
        }
    }



    $sel = 'UPDATE users 
            SET pass = "' . md5($newname) . '"
            WHERE login="' . $_SESSION['ruser'] . '" and pass="' . md5($pass) . '"';
    $res = mysqli_query($link, $sel);
    // echo $res, $_SESSION['ruser'];
    // echo "can be changed ";

    return true;
}
class Note

{
    public $title;
    function set_title($name)
    {
        $link = connect();
        $this->title  = $name;
        $res = 'INSERT INTO pages (page_name)
            VALUES ("' . $name . '")';
        $rel = mysqli_query($link, $res);
    }
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>