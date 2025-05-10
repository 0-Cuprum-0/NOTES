<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, xyz");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
switch (json_last_error()) {
    case JSON_ERROR_NONE:
        echo ' - No errors';
        break;
    case JSON_ERROR_DEPTH:
        echo ' - Maximum stack depth exceeded';
        break;
    case JSON_ERROR_STATE_MISMATCH:
        echo ' - Underflow or the modes mismatch';
        break;
    case JSON_ERROR_CTRL_CHAR:
        echo ' - Unexpected control character found';
        break;
    case JSON_ERROR_SYNTAX:
        echo ' - Syntax error, malformed JSON';
        break;
    case JSON_ERROR_UTF8:
        echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
    default:
        echo ' - Unknown error';
        break;
}



// Ответ клиенту
// echo json_encode([
//     "status" => "ok",
//     "received" => $data
// ]);
// exit;
print_r($data);
echo $data['title'];
$note_title = $_SESSION['note_title'] = $data['title'];
$note_description = $_SESSION['note_description'] = $data['description'];
$note_content = $_SESSION['note_content'] = $data['content'];
$rec = ''
