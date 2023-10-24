<?php
if (count($_COOKIE) == 0) {
    header("Location:index.php");
}
?>


<!-- Header -->
<?php include "inc/header.php"; ?>

<!-- Blogs -->
<div class="blogs">
    <!-- row for blog -->
    <div class="row">
        <div class="col-12">
            <a href="blog.php?id=-1">Add Blog</a>
        </div>
    </div>
    <!-- row for blog -->
    <div class="row">
        <div class="col-2">Author</div>
        <div class="col-8">Title</div>
        <div class="col-2"></div>
    </div>
    <?php
    require "config/database.php";
    $sql = "SELECT * FROM blogs ORDER BY releaseDate DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class = 'row'>
                    <div class='col-2'>"
                . $row["userid"] .
                "</div>
                    <div class='col-8'>"
                . $row["blogTitle"] . "
                    </div>
                    <div class='col-2'>
                        <a href = 'blog.php?id=" . $row['blogid'] . "'>Update</a>
                        <a href = 'deleteblog.php?id=" . $row['blogid'] . "'>Delete</a>
                    </div>
            </div>
            ";
        }
    }
    ?>
</div>

<!-- Footer -->
<?php include "inc/footer.php"; ?>