<?php
    session_start();
?>
<?php 
    include('config/db.php');
?>
<?php if(!$_SESSION['username']):?>
<?php header('Location:login.php')?>
<?php else:?>

<?php include('inc/header.php');?>
<style>
<?php include('assets/css/main.css');
?>
</style>
<div class="container">
    <?php 
    $url = $_SERVER['PHP_SELF'];
    $seg = explode('/', $url);
    $path = $_SERVER['SERVER_NAME'].$seg[0].'/'.$seg[1];
    $full_path = $path.'/'.'img'.'/'.'default.png';
    // echo $full_path;
?>

    <?php
    if(isset($_POST['submit'])){
        $target_dir = "uploads/";
        $uploadOk = 1;
        $temp = explode(".", $_FILES["avatar"]["name"]);
        $new_file_name = sha1($_FILES["avatar"]["name"]);
        $target_file = $target_dir . $new_file_name . '.' .$temp[1];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if($check !== false) {
              
              $uploadOk = 1;
            } else {
              $error =  "File is not an image.";
              $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $error =  "Sorry, file already exists.";
        $uploadOk = 0;
        }

        if ($_FILES["avatar"]["size"] > 500000) {
            $error =  "Sorry, your file is too large.";
            $uploadOk = 0;
          }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $error =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $error =  "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $user_id = $_SESSION['id'];
                $sql = "INSERT INTO profile(id, avatar) VALUES('$user_id', '$target_file')";
                $query = $conn->query($sql);
                if($query){
                    header('Location:dashboard.php');
                }else {
                    $error = "Failed to Upload Avatar";
                }
            } else {
                $error =  "Sorry, there was an error uploading your file.";
            }
        }
    }
?>

    <?php
        $user_id_avatar = $_SESSION['id'];
        $query_user = "SELECT * FROM profile WHERE id = '$user_id_avatar'";
        $result_avatar = mysqli_query($conn, $query_user) or die('error');
        if(mysqli_num_rows($result_avatar) > 0){
            while($row = mysqli_fetch_assoc($result_avatar)){
                $avatar = $row['avatar'];
            }
        }
    ?>
    <h1 class="text-center"> <?php echo $_SESSION['username'];?> Profile</h1>
    <div class="row">
        <div class="col-lg-12 text-center avatar">
            <img src=<?php if(isset($avatar)){ echo $avatar; } else { echo 'img/default.png';}?> alt="" class="img-thumbnail">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-4 offset-1">
            <form action="profile.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Upload your profile picture</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="avatar">
                </div>
                <div class="form-group">
                    <input type="submit" value="Upload Image" class="btn btn-primary" name="submit">
                </div>
                <div class="form-group">
                    <?php if(isset($_POST['submit'])):?>
                    <div class="alert alert-warning" role="alert">

                        <?php echo $error ?>
                    </div>
                    <?php endif;?>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<?php
    include('inc/footer.php');
?>
<?php endif;?>