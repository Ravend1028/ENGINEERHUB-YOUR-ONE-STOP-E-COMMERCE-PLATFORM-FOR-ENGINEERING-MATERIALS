<?php include 'header.php'; ?>

  <section class="bg-warning text-dark p-3">
    <div class="container">
      <div class="d-md-flex justify-content-between align-items-center">
          <h5 class="mx-2 text-primary">
            <a href="to_received.php">
              To Received
            </a>
          </h5>

          <div class="h1 mb-3">
            <a href="shop_index.php">
              <i class="bi bi-back"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
  $sql = 'SELECT p.prod_name, p.prod_price, p.prod_img, c.stamp, c.prod_id
  FROM products p
  JOIN cart c ON p.id = c.prod_id;
  ';
  $result = mysqli_query($conn, $sql);
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

  <div id="cart-container" class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4">

      <?php
      // Function to display products
      function displayProducts($products) {
        foreach ($products as $product):
      ?>

      <div class="col">
        <div class="card my-3" style="height: 95%;" data-prod-id="<?php echo $product['prod_id']; ?>">
          <div class="text-secondary text-center mt-2">Added on: <?php echo date_format(
          date_create($product['stamp']),
          'F j\, Y \| l \| g:ia  '
          ); ?></div>
          <?php
            // Check if product image is availables
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
            <button class="btn btn-dark mt-2">Check Out</button>
            <button class="remove-to-cart btn btn-dark mt-2">Remove to Cart</button>
          </div>
        </div>
      </div>

      <?php
        endforeach;
      }
      displayProducts($products);
      ?>

    </div>
  </div>

<?php include 'js_footer.php'; ?>

