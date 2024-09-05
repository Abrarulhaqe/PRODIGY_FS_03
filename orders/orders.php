<?php
include('../includes/header.php');
include('../db/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = $user_id";
$result = $conn->query($sql);
?>
<main>
    <h2>Your Orders</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($order = $result->fetch_assoc()) {
            echo "<div class='order'>";
            echo "<p>Order ID: " . $order['id'] . "</p>";
            echo "<p>Total Amount: $" . $order['total_amount'] . "</p>";
            echo "<p>Shipping Address: " . $order['shipping_address'] . "</p>";
            echo "<p>Order Date: " . $order['created_at'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>You have no orders.</p>";
    }

    $conn->close();
    ?>
</main>
<?php include('../includes/footer.php'); ?>