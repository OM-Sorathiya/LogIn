<?php
$login = false;
$showError = false;
if (isset($_POST['submit'])) {
  include 'partials/dbconnect.php';
  $username = $_POST['uname'];
  $password = $_POST['password'];

  //$sql="SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
  $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
      } else {
        $showError = "Invalid Credentials.";
      }
    }
  } else {
    $showError = "Invalid Credentials.";
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <title>Log In</title>

</head>

<body>
  <?php require "partials/_nav.php" ?>
  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Account successfully Logged In!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showError . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  ?>
  <div class="container col-md-6 my-4">
    <h1 class="text-center">Log In to our Website</h1>
    <form action="/Log_In/login.php" method="post">
      <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input type="text" id="uname" name="uname" maxlength="25" class="form-control">
      </div>
      <div class="mb-3">
        <div class="col-auto">
          <label for="password" class="col-form-label">Password</label>
        </div>
        <div class="col-auto">
          <input type="password" id="password" name="password" maxlength="12" class="form-control" aria-labelledby="passwordHelpInline">
        </div>
        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            Must be 8-20 characters long.
          </span>
        </div>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">LogIn</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>