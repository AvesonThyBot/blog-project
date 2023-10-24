<!-- Header -->
<?php include "inc/header.php"; ?>

<?php
require 'config/database.php';
$page = 1;
$start = 0;
if (isset($_GET['page'])); {
    $page = $_GET['page'];
    $start = ($page - 1) * 10;
}

$sql = "SELECT * FROM blogs ORDER BY releaseDate DESC LIMIT 10 offset $start";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
    echo "<br><br>";
}
?>



<!-- Footer -->
<?php include "inc/footer.php"; ?>