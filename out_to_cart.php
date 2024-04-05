<?php
// Create connection
$conn = new mysqli('localhost', 'raven', '123456', 'engineerhub');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if product ID is provided
if (isset($_POST['prod_id'])) {
  // Get product ID from AJAX request
  $productId = $_POST['prod_id'];
  
  $sql = "DELETE FROM cart WHERE prod_id = '$productId'"; 
  if ($conn->query($sql) === TRUE) {
      echo "Product remove to cart successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close the connection
$conn->close();
?>

