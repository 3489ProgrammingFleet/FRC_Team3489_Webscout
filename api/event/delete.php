<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/event.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare team object
$event = new Event($db);
 
// get product id
$data = json_decode(file_get_contents("php://input"));
 
// set team number to be deleted
$event->event_id = $data->id;
 
// delete the team
if($event->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Event has been deleted."));
}
 
// if unable to delete the team
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete event."));
}
?>