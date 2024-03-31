document.getElementById('search_button').addEventListener('click', () => {
  let searchQuery = document.getElementById('search_input').value; // Trim whitespace

  let xhr = new XMLHttpRequest();
  let url = 'shop_index.php'; // Initial URL

  // Modify URL if search query is provided
  if (searchQuery !== '') {
    url += '?search=' + encodeURIComponent(searchQuery);
  }

  xhr.open('GET', url, true);

  xhr.onload = () => {
    if (xhr.status == 200) {
      let products = JSON.parse(xhr.responseText);
      console.log(products);
    }
  };

  xhr.send();
});




