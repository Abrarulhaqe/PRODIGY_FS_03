<?php
session_start();
include('../db/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to add items to your cart.";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Check if the item is already in the cart
$sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Update quantity if product already in cart
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
} else {
    // Add new product to cart
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
}

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>