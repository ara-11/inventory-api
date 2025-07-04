<?php
// delete.php

header("Access-Control-Allow-Origin: https://ara-11.github.io");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$id = isset($data->id) ? intval($data->id) : null;

error_log("🗑️ DELETE REQUEST: " . print_r($data, true));

if ($id) {
  try {
    // PostgreSQL-style parameterized query
    $stmt = $conn->prepare("DELETE FROM products WHERE id = $1");
    $stmt->execute([$id]);
    error_log("🧾 Executed delete on ID: " . $id . ", Rows affected: " . $stmt->rowCount());

    if ($stmt->rowCount() > 0) {
      echo json_encode(["message" => "Product deleted successfully"]);
    } else {
      echo json_encode(["error" => "No product found with that ID"]);
    }
  } catch (PDOException $e) {
    error_log("❌ DB Error: " . $e->getMessage());
    echo json_encode(["error" => "Deletion failed: " . $e->getMessage()]);
  }
} else {
  echo json_encode(["error" => "Invalid ID"]);
}
?>
