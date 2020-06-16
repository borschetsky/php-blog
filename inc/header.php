<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Blog INFM95545</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="styleshit" href="assets/css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">PHP Blog F95545</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION['username'])):?>
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <?php endif;?>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="feed.php">Feed <span class="sr-only">(current)</span></a>
                    </li>
                   
                   
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <?php if(isset($_SESSION['username'])):?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="createpost.php">Write new post</a>

                            <a class="dropdown-item" href="profile.php">Update profile</a>
                            <hr>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(!isset($_SESSION['username'])):?>
                    
                        <a class="btn btn-primary" href="login.php">Login <span class="sr-only">(current)</span></a>
                    
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>
    <!-- <?php echo $login_url = 'http://'.$_SERVER['SERVER_NAME'];?>

    <?php echo $_SESSION['id']?>
    <?php echo $_SESSION['username']?> -->
