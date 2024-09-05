<?php
session_start();
include('../db/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to place an order.";
    exit;
}

$user_id = $_SESSION['user_id'];
$shipping_address = $_POST['shipping_address'];
$total_amount = $_POST['total_amount'];

// Start transaction
$conn->begin_transaction();

try {
    // Insert order
    $sql = "INSERT INTO orders (user_id, shipping_address, total_amount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $user_id, $shipping_address, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare