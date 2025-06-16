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
        echo "<p><span style='color: red;'>Fill All Required Fields</span></p>";
        return false;
    }
    if (
        strlen($name) < 3 || strlen($name) > 30 ||
        strlen($pass) < 3  || strlen($name) > 30
    ) {
        echo "<p><span style='color: red;'>Values length error</span></p>";
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
            echo "<p><span style='color: red;'></span></p>"; #??????????????????
        } else {
            echo "<p><span style='color: red;'>Error code: " . $errno . "!</span></p>";
        }
    }

    $err = mysqli_errno($link);
    if ($err) {
        if ($err == 1062) {
            echo "<p><span style='color: red;'>User already exists!</span></p>";
        } else {
            echo "<p><span style='color: red;'>Error code: " . $err . "!</span></p>";
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
        echo "<p><span style='color:red;'>Fill All Required Fields</span></p>";
        return false;
    }
    if (
        strlen($name) < 5 || strlen($name) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<p><span style='color:red;'>Value Must Be Between 5 and 15!</span></p>";
        return false;
    }
    $sel = 'SELECT * FROM users 
            WHERE login="' . $name . '" and pass="' . md5($pass) . '"';
    $res = mysqli_query($link, $sel);

    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        $id = $row['0'];
        $_SESSION['ruser'] = $name;
        // $_SESSION['reg'] = 1;
        unset($_SESSION['id']);
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = $id;
        }


        return true;
    } else {
        echo "<p><span style='color: red;'>No Such User!</span></p>";
        return false;
    }
}
function newlogin($oldpass, $newlogin)
{
    // echo "HELLO";
    $link = connect();
    $newname = trim(htmlspecialchars($newlogin));
    $pass = trim(htmlspecialchars($oldpass));
    if ($newname == "" || $pass == "") {
        echo "<p><span style='color:red;'>Fill All Required Fields</span></p>";
        return false;
    }
    if (
        strlen($newname) < 5 || strlen($newname) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<p><span style='color:red;'>Value Must Be Between 5 and 15!</span></p>";
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
    $_SESSION['ruser'] = $newname;



    return true;



    // } else {
    //     echo "<p><span style='color: red;'>No Such User!</span></p>";
    //     return false;
    // }
}
function newpassword($pass, $newpass)
{
    $link = connect();
    $newname = trim(htmlspecialchars($newpass));
    $pass = trim(htmlspecialchars($pass));
    if ($newname == "" || $pass == "") {
        echo "<p><span style='color:red;'>Fill All Required Fields</span></p>";
        return false;
    }
    if (
        strlen($newname) < 5 || strlen($newname) > 15 ||
        strlen($pass) < 5 || strlen($pass) > 15
    ) {
        echo "<p><span style='color:red;'>Value Must Be Between 5 and 15!</span></p>";
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
    public $descr;


    function create_note($name, $information)
    {


        $link = connect();
        $this->title  = $name;
        $this->descr  = $information;

        $res = 'INSERT INTO pages (page_name,description)
        VALUES ("' . $this->title . '","' . $this->descr . '")';
        mysqli_query($link, $res);


        $link = connect();
        $rel = 'SELECT COUNT(*) FROM pages WHERE user_id ="' . $_SESSION['id'] . '" ';
        $number = mysqli_query($link, $rel);
        $s = mysqli_fetch_array($number);
        $count = $s[0];
        $_SESSION['rem'] = $remaining =  $_SESSION['num'] - $count;



        if (isset($_SESSION['id'])) {
            $sel = 'UPDATE pages 
            SET user_id = "' . $_SESSION['id'] . '"
            WHERE page_name="' . $this->title . '"';
            $res = mysqli_query($link, $sel);
        }
        $link = connect();
        $rel = 'SELECT id FROM pages WHERE page_name="' . $this->title . '"';
        $smth = mysqli_query($link, $rel);
        if ($row = mysqli_fetch_assoc($smth)) {
            $new_id = $row["id"];
            print_r($new_id);
        }
        header("Location: index.php?page=4&note_id=" . $new_id);
    }
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>