<?php include 'header.php'; ?>

<?php 

$username = $password = '';
$usernameErr = $passwordErr = '';
$incorrectPw = $unrecognizedUser = '';

if(isset($_POST['submit'])) {
  
  if(empty($_POST['username'])) {
    $usernameErr = 'Username is required';
  } else {
    $username = filter_input(
      INPUT_POST,
      'username',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if(empty($_POST['password'])) {
    $passwordErr = 'Password is required';
  } else {
    //$password = password_hash($password, PASSWORD_DEFAULT);
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $password = $_POST["password"];
  }

  if (empty($usernameErr) && empty($passwordErr)) {
    // search db
    $sql = "SELECT password FROM accounts WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_assoc($result);
          $hashedPasswordFromDb = $row['password'];
  
          // Verify the entered password with the hashed password from the database
          if (password_verify($password, $hashedPasswordFromDb)) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: shop_index.php');
          } else {
            $incorrectPw = 'Incorrect Username or Password';
          }

      } else {
        $unrecognizedUser = 'User does not exist';
      }
    } else {
      echo 'Error: ' . mysqli_error($conn);
    }
    
  }

}

?>

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
                  <input type="text" class="form-control w-75 <?php echo !$unrecognizedUser ?:
                  'is-invalid'; ?>" name="username" placeholder="Enter your username">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control w-75 <?php echo !$incorrectPw ?:
                  'is-invalid'; ?>" name="password" placeholder="Enter your password">
                </div>
                <div class="mb-3">
                  <input type="submit" name="submit" value="Login" class="btn btn-dark w-25">
                </div>
              </form>

              <div class="container p-2 pb-1">
                <a href="forgot_password.php">Forgot Password</a>
              </div>

              <div class="container p-2 pt-1">
                <a href="signup.php">Create an Account</a>
              </div>
            </div>
          </div>
        </div> 
      </div> 
    </div>
  </section>

<?php include 'footer_template.php'; ?>