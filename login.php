<?php
require "config/database.php";

if (count($_COOKIE) > 0) {
    header("Location:index.php");
}

// Login
if (isset($_POST['btnLogin'])) {
    $email = $_POST['txtEmailAddress'];
    $pass = $_POST['txtPassword'];
    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_assoc($result)) {


        $passHash = $row['passwordText'];
        if (password_verify($pass, $passHash)) {

            setcookie('email', $email, time() + (86400 * 30), "/"); // 1 day, email
            setcookie('is_logged_in', true, time() + (86400 * 30), "/"); // 1 day, logged in

            header("Location:index.php");
        } else {
            echo "Incorrect Password";
        }
    }
}
?>

<!-- Header -->
<?php include "inc/header.php"; ?>

<!-- form for login -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Email Address</span>
        <input type="email" class="form-control" placeholder="Email address" aria-label="emailAddress" aria-describedby="basic-addon1" name="txtEmailAddress" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Password</span>
        <input type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" name="txtPassword" required>
    </div>
    <!-- Submit button -->
    <div>
        <input type="submit" class="btn btn-primary" value="Login" name="btnLogin" />
    </div>
</form>


<!-- Footer -->
<?php include "inc/footer.php"; ?>