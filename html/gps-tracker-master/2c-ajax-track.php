<?php
// INIT
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-track.php";
$trackLib = new Track();

// HANDLE REQUESTS
// !! You might want to restrict access
// !! Implement your own user sessions and security checks
ob_start();
session_start();
require_once '../dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
switch ($_POST['req']) {
  // INVALID REQUEST
  default:
    echo json_encode([
      "status" => 0,
      "message" => "Invalid request"
    ]);
    break;

  // UPDATE RIDER LOCATION
  case "update":
    $pass = $trackLib->update($_POST['rider_id'], $_POST['lng'], $_POST['lat']);
    echo json_encode([
      "status" => $pass ? 1 : 0,
      "message" => $pass ? "OK" : $trackLib->error
    ]);
    break;

  // GET RIDER LOCATION
  case "get":
    $location = $trackLib->get($_POST['rider_id']);
    echo json_encode([
      "status" => is_array($location) ? 1 : 0,
      "message" => $location
    ]);
    break;

  // GET ALL RIDER LOCATIONS
  case "getAll":
    $location = $trackLib->getAll();
    echo json_encode([
      "status" => is_array($location) ? 1 : 0,
      "message" => $location
    ]);
    break;
}