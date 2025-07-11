<?php
// read.php
header("Access-Control-Allow-Origin: https://ara-11.github.io");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
header("X-Content-Type-Options: nosniff");

/**include 'db.php';

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($products); */


include 'db.php';

try {
  $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
  $stmt->execute();

  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($products);
} catch (PDOException $e) {
  echo json_encode(["error" => "Failed to fetch products: " . $e->getMessage()]);
}
?>
