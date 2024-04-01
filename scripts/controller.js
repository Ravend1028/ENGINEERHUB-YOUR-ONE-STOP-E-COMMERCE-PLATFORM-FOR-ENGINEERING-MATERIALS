document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("search_button").addEventListener("click", function() {
    var searchText = document.getElementById("search_input").value;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax.php?search=" + searchText, true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
  
        document.getElementById("products-container").innerHTML = xhr.responseText;
        document.getElementById("search_input").value = "";
        document.getElementById("search_input").focus();

      }
    };
    
    xhr.send();
  });
});




