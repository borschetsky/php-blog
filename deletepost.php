<?php
    session_start();
?>
<?php 
    include('config/db.php');
?>
<?php if(!$_SESSION['username']){
    header('Location:dashboard.php')  ;  
}
?>
<?php
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $author_id = $_SESSION['id'];
        if(isset($_SESSION['id'])){
            $sql_check = "SELECT * FROM posts WHERE id = '$post_id' AND author_id = '$author_id'";
            $result_check = mysqli_query($conn, $sql_check) or die();
            if(mysqli_num_rows($result_check) > 0){
                $sql = "DELETE FROM posts WHERE id = '$post_id'";
                if(mysqli_query($conn, $sql)){
                    echo "Success!";
                    header('Location:dashboard.php');
                }
                else {
        header('Location:dashboard.php');
                    
                }
            }
        }
        else {
            header('Location:dashboard.php');

        }
    } 
    else {
        header('Location:dashboard.php');
    }
?>