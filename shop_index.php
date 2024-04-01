<?php 
include 'header.php'; 

// Define initial SQL query to fetch all products
$sql = 'SELECT * FROM products';

// Check if a search query parameter is provided
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Append the search condition to the SQL query
    $sql .= " WHERE prod_name LIKE '%$search%'";
}

// Execute the SQL query
$result = mysqli_query($conn, $sql);
// Fetch all products based on the query result
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="bg-warning text-dark p-3">
  <div class="container">
    <div class="d-md-flex justify-content-between align-items-center">
      <div class="input-group news-input">
        <input id="search_input" type="text" class="form-control" placeholder="Browse for materials" />
        <button id="search_button" class="btn btn-dark btn-md" type="button">Search</button>
      </div>

      <div class="h1 mb-3">
        <a href="cart.php">
          <i class="bi bi-cart4"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<div id="products-container" class="container">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
    <?php
    // Function to display products
    function displayProducts($products) {
      foreach ($products as $product):
    ?>

    <div class="col">
      <div class="card my-3" style="height: 100%;">
        <?php
          // Check if product image is available
          if (!empty($product['prod_img'])) {
            // Convert BLOB data to base64 format
            $imgData = base64_encode($product['prod_img']);
            // Format the image source
            $imgSrc = 'data:image/jpeg;base64,'.$imgData; // Change 'jpeg' based on your image type
          } else {
            // If no image is available, use a placeholder
            $imgSrc = 'placeholder.jpg'; // Change to your placeholder image path
          }
        ?>
        <img src="<?php echo $imgSrc; ?>" class="card-img-top" style="height: 200px;" alt="">
        <div class="card-body text-center">
          <?php echo $product['prod_name']; ?>
          <div class="text-secondary mt-2">Price: <?php echo $product['prod_price']; ?></div>
          <button class="btn btn-dark mt-2 addToCart">Add to Cart</button>
        </div>
      </div>
    </div>

    <?php
      endforeach;
    }
    // Display products
    displayProducts($products);
    ?>
  </div>
</div>

<?php include 'footer_template.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("search_button").addEventListener("click", function() {
    var searchText = document.getElementById("search_input").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "?search=" + searchText, true); // Using the same PHP file
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Update products container with the received data
        document.getElementById("products-container").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  });
});
</script>
