<?php include 'header.php'; ?>

  <section id="search_section" class="bg-warning text-dark p-3">
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

<?php include 'ajax.php'; ?> 

<?php include 'footer_template.php'; ?>

