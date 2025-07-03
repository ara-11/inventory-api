<?php
//add.php
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->name) && isset($data->quantity) && isset($data->price)) {
  $stmt = $conn->prepare("INSERT INTO products (name, quantity, price) VALUES (?, ?, ?)");
  $stmt->execute([$data->name, $data->quantity, $data->price]);

  echo json_encode(["message" => "Product added successfully"]);
} else {
  echo json_encode(["message" => "Invalid data"]);
}*/
?>


<?php
// add.php
header("Access-Control-Allow-Origin: https://ara-11.github.io");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->name) && isset($data->quantity) && isset($data->price)) {
  try {
    $stmt = $conn->prepare("INSERT INTO products (name, quantity, price) VALUES ($1, $2, $3)");
    $stmt->execute([$data->name, $data->quantity, $data->price]);

    echo json_encode(["message" => "Product added successfully"]);
  } catch (PDOException $e) {
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
  }
} else {
  echo json_encode(["message" => "Invalid data"]);
}
?>


