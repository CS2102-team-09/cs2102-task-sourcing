<?php
include('login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    header("location: profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <style>
        .modal-header, h5, .close {
            background-color: #5cb85c;
            color: white !important;
            text-align: center;
            font-size: 30px;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">TaskSource</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bid Tasks <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage Tasks <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help <span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal"
                    data-target="#loginModel">Login
            </button>
            <button class="btn btn-success my-2 my-sm-0" type="button" data-toggle="modal"
                    data-target="#signupModel">Signup
            </button>
        </div>
    </nav>

<!-- Modal -->
<div class="modal fade" id="loginModel">
    <div class="modal-dialog modal-dialog-centered role="document"">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:30px 40px;">
                <h5><span class="fa fa-lock"></span> Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body" style="padding:30px 40px;">
                <form action="" method="post" name="submit">
                    <div class="form-group">
                        <label for="username"><span class="fa fa-user"></span> Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter email" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="fa fa-eye"></span> Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                    </div>
                    <input name="submit" type="submit" class="btn btn-success btn-block" value=" login ">
                    <span><?php echo $error; ?></span>
                </form>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signupModel">
    <div class="modal-dialog modal-dialog-centered role="document"">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" style="padding:30px 40px;">
            <h5>Signup</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div class="modal-body" style="padding:30px 40px;">
            <form action="" method="post" name="signup">
                <div class="form-group">
                    <label for="username"><span class="fa fa-user"></span> Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter email" name="username">
                </div>
                <div class="form-group">
                    <label for="password"><span class="fa fa-eye"></span> Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value="" checked>Remember me</label>
                </div>
                <input name="signup" type="submit" class="btn btn-success btn-block" value="signup">
                <span><?php echo $error; ?></span>
            </form>
        </div>

    </div>

</div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>