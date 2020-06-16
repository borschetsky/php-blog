<?php
    session_start();
?>
<?php include('inc/header.php');?>
<?php 
    include('config/db.php');
    
    $posts_query = "SELECT posts.id as post_id, title, body, users.username as author FROM posts LEFT JOIN users ON posts.author_id = users.id";
    $posts_result = mysqli_query($conn, $posts_query) or die('error');
    $posts_array = [];
    if(mysqli_num_rows($posts_result) > 0){
        
        while($row = mysqli_fetch_assoc($posts_result)){
            $postId = $row['post_id'];
            $title = $row['title'];
            $body = $row['body'];
            $author = $row['author'];
            $post_item_array = array(
                'title' => $title,
                'body' => $body,
                'author' => $author
            );
            $posts_array[$postId] = $post_item_array;
        }
    }

?>
<style>
<?php include('assets/css/main.css');
?>
</style>
<div class="container">
    <hr>
    <h1 class="text-center">Posts</h1>
    <hr>
    <div class="row">
        <div class="col-lg-10 offset-1">
            <?php foreach($posts_array as $key => $value ):?>
            <div class="card margin-bottom">
                <div class="card-body" >
                    <h5 class="card-title"><?php echo $posts_array[$key]['title'];?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts_array[$key]['author'];?></h6>
                    <p class="card-text custom-card"><?php echo $posts_array[$key]['body'];?></p>
                    <a href=<?php echo "postdetails.php?post_id=".$key;?> class="btn btn-primary">Read more.</a>

                </div>
            </div>

            <?php endforeach;?>
            <?php if(count($posts_array) < 1):?>
                <p class="text-center">There are no posts!</p>
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