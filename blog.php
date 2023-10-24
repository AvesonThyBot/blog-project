<?php
if (count($_COOKIE) == 0) {
    header("Location:index.php");
}

?>

<?php
require "config/database.php";

$id = "";
$title = "";
$content = "";

// At page load
if ($_GET["id"] == "-1") { // ADD LOGIC
    $id = "-1";
} else { // EDIT LOGIC
    $id = $_GET["id"];
    $sql = "SELECT * FROM blogs WHERE blogid = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row["blogTitle"];
        $content = $row["blogContent"];
    }
}

// Post the blog into the server
if (isset($_POST["btnSave"])) {

    $blog_title = $_POST["blogTitle"];
    $blog_content = $_POST["blogContent"];
    $user_id = 1;
    $release_date = date("Y/m/d");
    $target_dir = "img/";
    $image_link = NULL;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            $image_link = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }



    // gets info of the blog
    if ($_GET["id"] == "-1") { // Add Blog logic
        $sql = "INSERT INTO blogs(blogTitle, blogContent, releaseDate, blogImage,userid) VALUES ('$blog_title', '$blog_content','$release_date','$image_link',$user_id)";
        $result = mysqli_query($conn, $sql);
        header("Location:blogs.php");
    } else { // Edit Blog logic
        $sql = "UPDATE blogs
            SET blogTitle = '$blog_title',
                blogContent = '$blog_content',
                blogImage = '$image_link'
            WHERE blogid = $id";
        $result = mysqli_query($conn, $sql);
        header("Location:blogs.php");
    }
}
?>


<!-- Header -->
<?php include "inc/header.php"; ?>

<!-- Blog form -->
<form action="" method="POST" enctype="multipart/form-data">
    <!-- Blog ID-->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Blog ID</span>
        <input type="text" class="form-control" placeholder="Blog ID" aria-label="blogid" aria-describedby="basic-addon1" name="blogid" value="<?php echo $id ?>" required disabled>
    </div>
    <!-- Blog Title-->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Blog Title</span>
        <input type="text" class="form-control" placeholder="Blog Title" aria-label="blogTitle" aria-describedby="basic-addon1" name="blogTitle" value="<?php echo $title ?>" required>
    </div>
    <!-- Blog Content-->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1" style="display: inline-block;vertical-align: top;">Blog Content</span>
        <textarea class="form-control" placeholder="Blog Content here..." id="textarea" style="height: 300px; width:100%" name="blogContent"><?php echo $content ?></textarea>
    </div>
    <!-- Blog Image -->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Image</span>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
    </div>

    <!-- Save Button -->
    <div>
        <input type="submit" class="btn btn-primary" value="Save" name="btnSave" />
    </div>
</form>
<!-- tinymce -->
<script src="https://cdn.tiny.cloud/1/m2hsmoxsjsf71320gq3hzau86phus8d6epu256bowvv0obrw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</script>
<script>
    tinymce.init({
        selector: 'textarea',

    })
</script>




<!-- Footer -->
<?php include "inc/footer.php"; ?>