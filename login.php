<?php
session_start();
    include('config/db.php');
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email != '' && $password != ''){
            $pwd_enc = sha1($password);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pwd_enc'";
            $result = mysqli_query($conn, $sql) or die('error');
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $email = $row['email'];

                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['email'] = $email;
                    header('Location:dashboard.php');
                }
            }
            else {
                $error = "Username or password is incorrect.";
            }
        }
        else{
            $error = 'Please pass user details!';
        }
    }
?>
<?php if(isset($_SESSION['username'])):?>
    <?php header('Location:dashboard.php');?>

<?php else:?>

<?php include('inc/header.php');?>
<style>
<?php include('assets/css/main.css');
?>
</style>

<div class="container custom-container">
    <div class="row">
        <div class="col-lg-5">
            <legend>Login User</legend>
            <hr>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="row align-items-baseline">
                    <div class="col-lg-6">

                        <div class="form-group">

                            <input type="submit" name="login" class="btn btn-primary">
                            <button type="reset" class="btn btn-light">Reset</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <a href="index.php">Sign Up!</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php if(isset($_POST['login'])):?>
                    <div class="alert alert-warning" role="alert">

                        <?php echo $error ?>
                    </div>
                    <?php endif;?>
                </div>

            </form>
        </div>
    </div>
</div>
<?php include('config/db.php'); ?>
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