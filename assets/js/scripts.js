// Add to Cart functionality
function addToCart(productId) {
    // AJAX request to add product to cart
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/local_store/process/add_to_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Product added to cart successfully!');
            // Update cart count or other UI elements if needed
        } else {
            alert('Error adding product to cart.');
        }
    };

    xhr.send('product_id=' + productId);
}

// Placeholder function for cart count update (can be implemented later)
function updateCartCount() {
    // Logic to update cart count on UI
}