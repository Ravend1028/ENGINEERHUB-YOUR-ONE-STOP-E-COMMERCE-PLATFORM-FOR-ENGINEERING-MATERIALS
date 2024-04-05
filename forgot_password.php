<?php include 'header.php'; ?>


<?php 

$username = $password = $repassword = $hashedPassword =  '';
$usernameErr = $passwordErr = $repasswordErr =  $mismatchPw = '';

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
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  }

  if(empty($_POST['repassword'])) {
    $passwordErr = 'Password is required';
  } else {
    //$password = $_POST["password"];
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $repassword = password_hash('repassword', PASSWORD_DEFAULT);
    
  }

  if (empty($usernameErr) && empty($passwordErr) && empty($repasswordErr)) {
    // update database
    if($_POST['password'] == $_POST['repassword']) {
      $sql = "UPDATE accounts SET password = '$hashedPassword' WHERE username = '$username'";
      if (mysqli_query($conn, $sql)) {
        // success
        //header('Location: login.php');
        echo "<script>alert('Password Changed Successfully'); window.location='login.php';</script>";
      } else {
        // error
        echo 'Error: ' . mysqli_error($conn);
      }
    } else {
      $mismatchPw = 'The passwords do not match. Please try again.';
    }

  }

}

?>

<section class="p-5">
    <div class="container">
      <div class="row d-sm-flex flex-sm-column justify-content-sm-center align-items-sm-center">
        <div class="col w-50 d-flex flex-column justify-content-center align-items-center">
          <div class="card w-100">
            <div class="card-body text-center">
              <div class="mb-4">
              <h2>
                Forgot Password 
              </h2>
              </div>

              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control w-75 <?php echo !$usernameErr ?:
                  'is-invalid'; ?>" name="username" placeholder="Enter your username">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" class="form-control w-75 <?php echo !$passwordErr ?:
                  'is-invalid'; ?>" name="password" placeholder="Create a new password">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">Retype Password</label>
                  <input type="password" class="form-control w-75 <?php echo !$passwordErr ?:
                  'is-invalid'; ?>" name="repassword" placeholder="Retype new password">
                  <span class="text-danger m-2"><?php echo $mismatchPw; ?></span>
                </div>

                <div class="mb-3">
                  <input type="submit" name="submit" value="Confirm" class="btn btn-dark w-25">
                </div>
              </form>

              <div class="container p-3">
                <a href="login.php">Login</a>
              </div>
            </div>
          </div>
        </div> 
      </div> 
    </div>
  </section>

<?php include 'footer_template.php'; ?>