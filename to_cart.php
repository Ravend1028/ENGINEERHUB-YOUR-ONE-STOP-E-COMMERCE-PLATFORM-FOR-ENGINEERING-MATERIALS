<?php
// Create connection
$conn = new mysqli('localhost', 'raven', '123456', 'engineerhub');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if product ID is provided
if (isset($_POST['id'])) {
    // Get product ID from AJAX request
    $productId = $_POST['id'];

    // Insert product into cart database or perform other operations with the product ID as needed
    // Example: You can directly insert the product into the cart table if you have one, or perform other operations like updating the cart.
    
    // Example of inserting product into cart (You might need to modify this based on your database schema)
    $sql = "INSERT INTO cart (prod_id) VALUES ('$productId')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
