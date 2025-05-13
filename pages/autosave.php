<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, xyz");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
// switch (json_last_error()) {
//     case JSON_ERROR_NONE:
//         echo ' - No errors';
//         break;
//     case JSON_ERROR_DEPTH:
//         echo ' - Maximum stack depth exceeded';
//         break;
//     case JSON_ERROR_STATE_MISMATCH:
//         echo ' - Underflow or the modes mismatch';
//         break;
//     case JSON_ERROR_CTRL_CHAR:
//         echo ' - Unexpected control character found';
//         break;
//     case JSON_ERROR_SYNTAX:
//         echo ' - Syntax error, malformed JSON';
//         break;
//     case JSON_ERROR_UTF8:
//         echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
//         break;
//     default:
//         echo ' - Unknown error';
//         break;
// }



// Ответ клиенту
echo json_encode([
    "status" => "ok",
    "received" => $data
]);
// exit;

// echo "Data that was sent: ";
// print_r($data);
// echo "Separate part of it: ";
// echo $data['title'];
$note_title = $_SESSION['note_title'] = $data['title'];
$note_description = $_SESSION['note_description'] = $data['description'];
$note_content = $_SESSION['note_content'] = $data['content'];
// echo "Seperate part but variable";
// echo strval($note_title);
include_once("/opt/lampp/apache2/htdocs/NOTES/pages/functions.php");


$link = connect();
// if ($link) {
//     echo "Connected to db";
// } else {
//     echo "Couldnt connect to db because: " . mysqli_connect_error();
// }
$note_id = $data['id'];
// if ($note_id) {
//     echo "note id is:", $note_id;
// } else {
//     echo "problems with note_id";
// }

$rec = 'UPDATE pages 
            SET page_name = "' . $note_title . '", description = "' . $note_description . '",info = "' . $note_content . '"
            WHERE id="' . $note_id . '"';
$res = mysqli_query($link, $rec);
exit;
// if ($res) {
//     echo "Query sent succsessfully";
// } else {
//     echo "Something went wrong with query";
// }
