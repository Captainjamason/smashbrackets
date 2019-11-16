<?php
header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->uname = $data->uname;
$user->pass = $data->pass;
$user->money = $data->money;

if(
	!empty($user->uname) &&
	!empty($user->pass) &&
	!empty($user->money) &&
	$user->create()
) {
	http_response_code(200);
	echo json_encode(array("message" => "User was created"));
} else {
	http_response_code(400);
	echo json_encode(array("message" => "User could not be created"));
}
?>
