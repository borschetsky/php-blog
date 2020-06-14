<?php include('inc/header.php');?>
<style>
<?php include('assets/css/main.css');
?>
</style>
<?php
    include("config/db.php");
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($username != '' && $password != '' && $password != ''){
            $pwd_hash = sha1($password);
            $sql = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$pwd_hash')";
            $query = $conn->query($sql);
            if($query){
                header('Location:login.php');
            }
            else{
                $error = 'Failed to Register User!';
                echo "Failure" . mysqli_error($conn);
            }
        }
        else {
            $error = 'Please fill all the fields.';
        }

    }
?>
<div class="container custom-container">
    <div class="row">
        <div class="col-lg-5">
            <legend>Register User</legend>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">

                </div>
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
                <div class="form-group">

                    <input type="submit" name="register" class="btn btn-primary">
                    <button type="reset" class="btn btn-light">Reset</button>
                </div>

                <div class="form-group">
                    <?php if(isset($_POST['register'])):?>
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