<?php
require "config/database.php";

if (count($_COOKIE) > 0) {
    header("Location:index.php");
}

if (isset($_POST['btnRegister'])) {
    $first_name = $_POST["txtFirstName"];
    $last_name = $_POST["txtLastName"];
    $email = $_POST["txtEmailAddress"];
    $password = password_hash($_POST["txtPassword"], CRYPT_BLOWFISH);

    $sql = "INSERT INTO users (firstName, lastName, email, passwordText) VALUES ('$first_name', '$last_name', '$email', '$password')";

    $result = mysqli_query($conn, $sql);
    header("Location:login.php");
}

?>

<?php include "inc/header.php"; ?>

<!-- Form for register -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">First Name</span>
        <input type="text" class="form-control" placeholder="First name" aria-label="firstName" aria-describedby="basic-addon1" name="txtFirstName" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Last Name</span>
        <input type="text" class="form-control" placeholder="Last name" aria-label="lastName" aria-describedby="basic-addon1" name="txtLastName" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Email Address</span>
        <input type="email" class="form-control" placeholder="Email address" aria-label="emailAddress" aria-describedby="basic-addon1" name="txtEmailAddress" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Password</span>
        <input type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" name="txtPassword" required>
    </div>
    <div>
        <input type="submit" class="btn btn-primary" value="Register" name="btnRegister" />
    </div>
</form>

<?php include "inc/footer.php"; ?>