<?php
$showAlert = false;
$showError = false;
if (isset($_POST['submit'])) {
    include 'partials/dbconnect.php';
    $email = $_POST['email'];
    $username = $_POST['uname'];
    $password = $_POST['password'];
    $cpassword = $_POST["cpassword"];
    //$exists=false;

    //Check whether this username Exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        //$exists = true;
        $showError = "Username already Exists.";
    } else {
        //$exists = false;       
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`username`, `password`, `email`, `dt`) VALUES ('$username','$hash','$email',current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match.";
        }
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

    <title>Sign Up</title>

</head>

<body>
    <?php require "partials/_nav.php" ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Account successfully created!</strong> Now you can <a href="/Log_In/login.php">Log-In.</a> 
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
        <h1 class="text-center">Sign Up to our Website</h1>
        <form action="/Log_In/signup.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="30" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We will never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" id="uname" name="uname" maxlength="25" class="form-control" required>
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
            <div class="mb-3">
                <div class="col-auto">
                    <label for="cpassword" class="col-form-label">Confirm Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="cpassword" name="cpassword" maxlength="12" class="form-control" aria-labelledby="passwordHelpInline">
                </div>
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters long.
                    </span>
                </div>
            </div>
            <div id="emailHelp" class="form-text">Make sure to type same password as above.</div><br>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Terms and conditions*</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>