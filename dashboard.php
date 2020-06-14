<?php
    session_start();
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
    echo $full_path;
?>
    <h1 class="text-center">Welcome <?php echo $_SESSION['username'];?></h1>
    <div class="row">
        <div class="col-lg-12 text-center avatar">
        <img src="img/default.png" alt="" class="img-thumbnail">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <form>
                <div class="form-group">
                    <label for="profession">Your profession</label>
                    <input class="form-control" type="text" id="profession">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Upload your profile picture</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
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