<?php include 'header.php'; ?>

<section class="p-5">
  <div class="container-sm">
    <div class="row d-sm-flex flex-sm-column justify-content-sm-center align-items-sm-center">
      <div class="col w-50 d-flex flex-column justify-content-center align-items-center">
        <div class="card w-100">
          <div class="card-body text-center">
            <div class="mb-4">
             <h2>
              Login
             </h2>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="mb-3 d-flex flex-column align-items-center">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control w-75" id="name"  name="name" placeholder="Enter your username">
              </div>

              <div class="mb-3 d-flex flex-column align-items-center">
                <label for="password" class="form-label">Password</label>
                <input type="email" class="form-control w-75" id="email" name="email" placeholder="Enter your password">
              </div>
              <div class="mb-3">
                <input type="submit" name="submit" value="Login" class="btn btn-dark w-25">
              </div>
            </form>

            <div class="container p-3">
              <a href="">Create an account</a>
            </div>
          </div>
        </div>
      </div> 
    </div> 
  </div>
</section>

<?php include 'footer_template.php'; ?>