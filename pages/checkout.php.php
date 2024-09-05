<?php
session_start();
include('../db/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to proceed to checkout.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch items in the cart for the logged-in user
$sql = "SELECT c.id, p.name, p.price, c.quantity, (p.price * c.quantity) AS total
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = $user_id";

$result = $conn->query($sql);
$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Checkout</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<form action='../process/process_order.php' method='POST'>";
        echo "<table>";
        echo "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>$" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>$" . $row['total'] . "</td>";
            $total_amount += $row['total'];
            echo "</tr>";
        }
        echo "</table>";
        echo "<p>Total Amount: $" . $total_amount . "</p>";
        echo "<input type='hidden' name='total_amount' value='$total_amount'>";
        echo "<label for='shipping_address'>Shipping Address:</label>";
        echo "<textarea name='shipping_address' required></textarea>";
        echo "<input type='submit' value='Place Order'>";
        echo "</form>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

</body>
</html>

<?php $conn->close(); ?>