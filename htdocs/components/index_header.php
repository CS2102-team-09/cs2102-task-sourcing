<?php
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");
$query = pg_query($connection, "SELECT test.task_id, test_next.owner, test_next.task_title, test_next.description, test_next.status, test_next.date, test_next.start_time, test_next.end_time, test_next.bidder, test_next.amount
FROM (SELECT test.task_id, MAX(test.amount) AS amount
FROM(SELECT b.task_id, b.user_id AS owner, b.task_title, b.description, b.status, b.date, b.start_time, b.end_time, t.user_id AS bidder, CASE WHEN t.amount IS NULL THEN 0 ELSE t.amount END
FROM task_bid_by t RIGHT OUTER JOIN task_managed_by b ON t.task_id = b.task_id
ORDER BY b.task_id, t.amount DESC) AS test
GROUP BY test.task_id) AS test, (SELECT b.task_id, b.user_id AS owner, b.task_title, b.description, b.status, b.date, b.start_time, b.end_time, t.user_id AS bidder, CASE WHEN t.amount IS NULL THEN 0 ELSE t.amount END
FROM task_bid_by t RIGHT OUTER JOIN task_managed_by b ON t.task_id = b.task_id
ORDER BY b.task_id, t.amount DESC) AS test_next
WHERE test.amount = test_next.amount
AND test.task_id = test_next.task_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


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
    <div class="modal-dialog modal-dialog-centered" role="document">

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
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                               name="password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                    </div>
                    <input name="submit" type="submit" class="btn btn-success btn-block" value="Login">
                    <span><?php echo $error; ?></span>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signupModel">
    <div class="modal-dialog modal-dialog-centered" role="document">

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
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                               name="password">
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


<div class="container">
    <div style="margin-left: auto; margin-right: auto; position: relative; text-align: center; margin-top: 50px;">
        <h1>The convenient & affordable way to get your task done!</h1>
        <h2>Login or Signup to proceed</h2>
    </div>
</div>



<?php
$i = 0;
while ($row = pg_fetch_array($query)) {
    if ($i > 3) {
        break;
    }

    $i++;
    $task_owner = $row['owner'];
    $task_title = $row["task_title"];
    $task_status = $row["status"];
    $task_date = $row["date"];
    $start_time = $row["start_time"];
    $end_time = $row["end_time"];
    $task_description = $row["description"];
    $task_id = $row["task_id"];
    $amount = $row["amount"];

    echo "
        <div class='container' style='padding-top: 30px'>
            <form action='' method='post'>
                <div class='list-group-item list-group-item-action list-group-item-primary'>
                    <div class=\"form - group row\">
                    <label for=\"task_title\" class=\"col-sm-2 col-form-label\">Task Title:</label>
                    <div class=\"col-sm-10\">
                        <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_title\" name=\"task_title\" value=\"$task_title\">
                    </div>
                </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
            <label for=\"task_description\" class=\"col-sm-2 col-form-label\">Description: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_description\" name=\"task_description\" value=\"$task_description\">
            </div>
        </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form - group row\">
            <label for=\"task_status\" class=\"col-sm-2 col-form-label\">Status: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_status\" name=\"task_status\" value=\"$task_status\">
            </div>
        </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
            <label for=\"task_date\" class=\"col-sm-2 col-form-label\">Date: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_date\" name=\"task_date\" value=\"$task_date\">
            </div>
        </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
            <label for=\"start_time\" class=\"col-sm-2 col-form-label\">Start Time: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"start_time\" name=\"start_time\" value=\"$start_time\">
            </div>
        </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
            <label for=\"end_time\" class=\"col-sm-2 col-form-label\">End Time: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"end_time\" name=\"end_time\" value=\"$end_time\">
            </div>
        </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
            <label for=\"task_owner\" class=\"col-sm-2 col-form-label\">Task Owner: </label>
            <div class=\"col-sm-10\">
                <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_owner\" name=\"task_owner\" value=\"$task_owner\">
            </div>
        </div>
        </div>
        
        
        
        
        </div>
        </form>
        </div>
";
}


?>


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