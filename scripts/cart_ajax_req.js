document.addEventListener("DOMContentLoaded", function() {
    const cartContainer = document.getElementById('cart-container');
    
    // Add event listener for 'click' event on cart container
    cartContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-to-cart')) {
            // Get the product ID from the clicked card element
            const prodId = event.target.closest('.card').getAttribute('data-prod-id');
            // Get the card element itself
            const cardElement = event.target.closest('.col');
            // Send product ID to AJAX script
            removeToCart(prodId, cardElement); // Pass the card element to remove
        }
    });
  
    // Function to send product ID via AJAX
    function removeToCart(prodId, cardElement) {
      // Create new XMLHttpRequest object
      const xhr = new XMLHttpRequest();
  
      // Configure the request
      xhr.open("POST", "out_to_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
      // Define what happens on successful data submission
      xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
              // Handle successful response
              alert(xhr.responseText); // Display response message
              // Remove the card from the UI
              if (cardElement) {
                cardElement.remove();
              }
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
      xhr.send("prod_id=" + encodeURIComponent(prodId));
    }
  });
  