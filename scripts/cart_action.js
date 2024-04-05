document.addEventListener("DOMContentLoaded", function() {
  const productsContainer = document.getElementById('products-container');
  
  // Add event listener for 'click' event on products container
  productsContainer.addEventListener('click', function(event) {
      if (event.target.classList.contains('add-to-cart')) {
          // Get the product ID from the clicked card element
          const productId = event.target.closest('.card').getAttribute('data-product-id');
          
          // Send product ID to AJAX script
          addToCart(productId);
      }
  });

  // Function to send product ID via AJAX
  function addToCart(productId) {
      // Create new XMLHttpRequest object
      const xhr = new XMLHttpRequest();

      // Configure the request
      xhr.open("POST", "to_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      // Define what happens on successful data submission
      xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
              // Handle successful response
              alert(xhr.responseText); // Display response message
          } else {
              // Handle error
              console.error('Request failed with status:', xhr.status);
          }
      };

      // Define what happens in case of an error
      xhr.onerror = function() {
          console.error('Request failed');
      };

      // Send the request with the product ID
      xhr.send("id=" + encodeURIComponent(productId));
  }

});