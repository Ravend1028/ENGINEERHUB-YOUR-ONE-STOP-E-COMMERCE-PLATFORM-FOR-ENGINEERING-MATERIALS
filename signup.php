<?php include 'header.php'; ?>

<?php 

$username = $password = $email = $fullname = $hashedPassword = '';
$usernameErr = $passwordErr = $emailErr = $fullnameErr = '';

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
    //hashing - $password = password_hash('password', PASSWORD_DEFAULT);

    /*$password = filter_input(
      INPUT_POST,
      'password',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ); */
    
  }

  if(empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  if(empty($_POST['fullname'])) {
    $fullnameErr = 'Fullname is required';
  } else {
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($usernameErr) && empty($passwordErr) && empty($emailErr) && empty($fullnameErr)) {
    // add to database
    $sql = "INSERT INTO accounts VALUES ('$username', '$hashedPassword', '$email', '$fullname')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: login.php');
    } else {
      // error
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
                Sign up
              </h2>
              </div>

              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control w-75 <?php echo !$usernameErr ?:
                  'is-invalid'; ?>" name="username" placeholder="Create a username">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control w-75 <?php echo !$passwordErr ?:
                  'is-invalid'; ?>" name="password" placeholder="Create a password">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">Email</label>
                  <input type="email" class="form-control w-75 <?php echo !$emailErr ?:
                  'is-invalid'; ?>"  name="email" placeholder="Enter your email address">
                </div>

                <div class="mb-3 d-flex flex-column align-items-center">
                  <label for="password" class="form-label">Fullname</label>
                  <input type="text" class="form-control w-75 <?php echo !$fullnameErr ?:
                  'is-invalid'; ?>" name="fullname" placeholder="Enter your fullname">
                </div>

                <div class="mb-3">
                  <input type="submit" name="submit" value="Sign up" class="btn btn-dark w-25">
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

<?php include 'footer.php'; ?>