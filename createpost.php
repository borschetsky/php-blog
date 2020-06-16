<?php
    session_start();
    $author_id = $_SESSION['id'];
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
<?php
    if(isset($_POST['createpost'])){
        $title = $_POST['title'];
        $isValid = 1;
        if($title == ''){
            $error = "Title can not be epty";
            $isValid = 0;
        }
        $body = $_POST['body'];
        if($body == '' && $isValid != 0){
            $error = "Body can not be epty";
            $isValid = 0;
        }
        if($isValid == 1){
            $sql = "INSERT INTO posts(author_id, title, body) VALUES('$author_id', '$title', '$body')";
            $query = $conn->query($sql);
            if($query){
                header('Location:dashboard.php');
            } else{
                echo "Error".mysqli_error($conn);
                $error = "Failed to add post.";
            }
        }
    } else {
        
    }
?>
<div class="container">
    <h1 class="text-center">Write new post...</h1>
    <hr>
    <form action="createpost.php" method="post">
        <div class="row">
            <div class="col-lg-6 offset-3">
                <div class="form-group">
                    <?php if(isset($_POST['createpost'])):?>
                    <div class="alert alert-warning" role="alert">

                        <?php echo $error ?>
                    </div>
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Give a title to the post">
                </div>
                <div class="form-group">
                    <label for="body">Your post</label>
                    <textarea class="form-control" id="body" rows="8" name="body"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="createpost" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
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