<?php
require "config/database.php";
$id = $_GET["id"];
$sql = "DELETE FROM blogs WHERE blogid = $id";
$result = mysqli_query($conn, $sql);

header("Location:blogs.php");
