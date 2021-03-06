<?php
    session_start();
?>
<?php 
    include('config/db.php');
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM profile WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query) or die('error');
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $avatar = $row['avatar'];
        }
    }

    $posts_query = "SELECT * FROM posts WHERE author_id = '$user_id'";
    $posts_result = mysqli_query($conn, $posts_query) or die('error');
    $posts_array = [];
    if(mysqli_num_rows($posts_result) > 0){
        
        while($row = mysqli_fetch_assoc($posts_result)){
            $postId = $row['id'];
            $title = $row['title'];
            $body = $row['body'];
            $post_item_array = array(
                'title' => $title,
                'body' => $body
            );
            $posts_array[$postId] = $post_item_array;
        }
    }

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
    <h1 class="text-center">Welcome <?php echo $_SESSION['username'];?></h1>
    <div class="row">
        <div class="col-lg-12 text-center avatar">
            <img src=<?php if(isset($avatar)){ echo $avatar; } else { echo 'img/default.png';}?> alt=""
                class="img-thumbnail">

        </div>
    </div>
    <hr>
    <h3 class="text-center">My Posts</h3>
    <hr>
    <div class="row">
        <div class="col-lg-10 offset-1">
            <?php foreach($posts_array as $key => $value ):?>
            <div class="card margin-bottom">
                <div class="card-body" >
                    <h5 class="card-title"><?php echo $posts_array[$key]['title'];?></h5>
                    <p class="card-text custom-card"><?php echo $posts_array[$key]['body'];?></p>
                    <a href=<?php echo "postdetails.php?post_id=".$key;?> class="btn btn-primary">Read more.</a>
                    <a href=<?php echo "deletepost.php?post_id=".$key;?> class="btn btn-danger">Delete</a>

                </div>
            </div>

            <?php endforeach;?>
            <?php if(count($posts_array) < 1):?>
                <p class="text-center">You have no posts!</p>
            <?php endif;?>

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