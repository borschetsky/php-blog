<?php
    session_start();
?>
<?php 
    include('config/db.php');
?>
<?php
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $sql = "SELECT posts.id as post_id, username, avatar, title, body 
        FROM posts LEFT JOIN profile on profile.id = posts.author_id 
        LEFT JOIN users ON profile.id = users.id
        WHERE posts.id = '$post_id'";

        $result = mysqli_query($conn, $sql) or die();
        if(mysqli_num_rows($result) > 0){
            $array_result= [];
            while($row = mysqli_fetch_assoc($result)){
                $postId = $row['post_id'];
                $username = $row['username'];
                $avatar = $row['avatar'];
                $title = $row['title'];
                $body = $row['body'];
                $array_item = array(
                    'username' => $username,
                    'avatar' => $avatar,
                    'title' => $title,
                    'body' => $body,
                );
                $array_result[$postId][] = $array_item;
                
            }
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
    <hr>
    <div class="row">
        <div class="col-lg-6">

            <h1><?php echo $title?></h1>
        </div>
        <div class="col-lg-6">
            <div class="row align-items-center">
                <img src=<?php echo $avatar;?> alt="" class="author-small-image">
                <h4><?php echo $username;?></h4>
            </div>
        </div>
    </div>
    <hr>
    <p><?php echo $body?></p>
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