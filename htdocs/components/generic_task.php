<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<div class="container">
    <div style="margin-left: auto; margin-right: auto; position: relative; text-align: center; margin-top: 50px;">
        <h1>The convenient & affordable way to get your task done!</h1>
        <h2>Create a generic task here</h2>
    </div>
</div>

<div class="container">
    <div style="margin-left: auto; margin-right: auto; position: relative; text-align: center; margin-top: 30px; padding-bottom: 50px">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3">
                <form action="" method="post">
                    <input type="hidden" name="title" value="Help Moving">
                    <input type="hidden" name="description" value="Need help with moving!">
                    <button class="btn btn-small btn-outline-success" type="submit" name="moving">Help Moving</button>
                </form>
            </div>
            <div class="col-3">
                <form action="" method="post">
                    <input type="hidden" name="title" value="Mounting & Installation">
                    <input type="hidden" name="description" value="Need help with mounting and installation!">
                    <button class="btn btn-small btn-outline-success" type="submit" name="mounting">Mounting & Installation</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <?php
    if (isset($_POST['moving'])) {
        $task_title = $_POST['title'];
        $description = $_POST['description'];

        echo "
            <form action=\"\" method=\"post\">
                <input type=\"hidden\" name=\"form_type\" value=\"moving\">
                <input type=\"hidden\" name=\"task_title\" value=\"$task_title\">
                <input type=\"hidden\" name=\"generic_description\" value=\"$description\">
                <input type=\"hidden\" name=\"title\" value=\"Mounting & Installation\">
                <div class=\"form-group row\">
                    <label for=\"from\" class=\"col-sm-2 col-form-label\">From:</label>
                    <div class=\"col-sm-10\">
                        <input name=\"from\" type=\"text\" class=\"form-control\" id=\"from\" placeholder=\"Meet me at...\" required>
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"to\" class=\"col-sm-2 col-form-label\">To:</label>
                    <div class=\"col-sm-10\">
                        <input name=\"to\" type=\"text\" class=\"form-control\" id=\"to\" placeholder=\"Moving to...\" required>
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"items\" class=\"col-sm-3 col-form-label\">Number of bulky items</label>
                    <div class=\"col-sm-9\">
                        <input name=\"items\" type=\"text\" class=\"form-control\" id=\"items\" placeholder=\"3\" required>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"description\">Additional Description</label>
                    <textarea name=\"description\" class=\"form-control\" id=\"description\" rows=\"3\"></textarea>
                </div>
                <div class=\"form-group row\">
                    <label for=\"example-date-input\" class=\"col-2 col-form-label\">Date</label>
                    <div class=\"col-10\">
                        <input name=\"date\" class=\"form-control\" type=\"date\" value=\"2018-10-19\" id=\"example-date-input\">
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"start_time\" class=\"col-2 col-form-label\">Start Time</label>
                    <div class=\"col-10\">
                        <input name=\"start_time\" class=\"form-control\" type=\"time\" value=\"13:45:00\" id=\"start_time\">
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"end_time\" class=\"col-2 col-form-label\">End Time</label>
                    <div class=\"col-10\">
                        <input name=\"end_time\" class=\"form-control\" type=\"time\" value=\"13:45:00\" id=\"end_time\">
                    </div>
                </div>
                <div class=\"form-group\"><input name=\"create-task\" class=\"btn btn-success\" type=\"submit\" value=\" Submit task \"></div>
            </form>
    ";
    }



    if (isset($_POST['mounting'])) {
        $task_title = $_POST['title'];
        $description = $_POST['description'];

        echo "
            <form action=\"\" method=\"post\">
                <input type=\"hidden\" name=\"form_type\" value=\"mounting\">
                <input type=\"hidden\" name=\"task_title\" value=\"$task_title\">
                <input type=\"hidden\" name=\"generic_description\" value=\"$description\">
                <input type=\"hidden\" name=\"title\" value=\"Mounting & Installation\">
            
                <div class=\"form-group row\">
                    <label for=\"items\" class=\"col-sm-4 col-form-label\">Number of items to be mounted</label>
                    <div class=\"col-sm-8\">
                        <input name=\"items\" type=\"text\" class=\"form-control\" id=\"items\" placeholder=\"3\" required>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"description\">Item Description</label>
                    <textarea name=\"description\" class=\"form-control\" id=\"description\" rows=\"3\" placeholder=\"Item model & special requests\"></textarea>
                </div>
                <div class=\"form-group row\">
                    <label for=\"example-date-input\" class=\"col-2 col-form-label\">Date</label>
                    <div class=\"col-10\">
                        <input name=\"date\" class=\"form-control\" type=\"date\" value=\"2018-10-19\" id=\"example-date-input\">
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"start_time\" class=\"col-2 col-form-label\">Start Time</label>
                    <div class=\"col-10\">
                        <input name=\"start_time\" class=\"form-control\" type=\"time\" value=\"13:45:00\" id=\"start_time\">
                    </div>
                </div>
                <div class=\"form-group row\">
                    <label for=\"end_time\" class=\"col-2 col-form-label\">End Time</label>
                    <div class=\"col-10\">
                        <input name=\"end_time\" class=\"form-control\" type=\"time\" value=\"13:45:00\" id=\"end_time\">
                    </div>
                </div>
                <div class=\"form-group\"><input name=\"create-task\" class=\"btn btn-success\" type=\"submit\" value=\" Submit task \"></div>
            </form>
        ";
    }

    if (isset($_POST['create-task'])) {
        $task_title = $_POST['task_title'];
        $description = "";

        if ($_POST['form_type'] == 'moving') {
            $description = $_POST['generic_description'].' Moving from '.$_POST['from'].' to '.$_POST['to'].'. Number of bulky items: '.$_POST['items'].'. Additional comments: '.$_POST['description'];
        } elseif ($_POST['form_type'] == 'mounting') {
            $description = $_POST['generic_description']. ' Number of items to be mounted: '.$_POST['items'].'. Item model and additional comments: '.$_POST['description'];
        }

        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $user_id = $_SESSION['login_user'];


        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");

        // SQL query to fetch information of registerd users and finds user match.
        $query = pg_query($connection, "INSERT INTO task_managed_by (task_title, user_id, date, start_time, end_time, description) VALUES ('$task_title', '$user_id', '$date', '$start_time', '$end_time', '$description')");
        if ($query) {
            echo "
                <div style=\"margin-left: auto; margin-right: auto; position: relative; text-align: center;\">
                    <h3>Task created successfully!</h3>
                </div>
            ";
            header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = $end_time;
            echo "
                <div style=\"margin-left: auto; margin-right: auto; position: relative; text-align: center;\">
                    <h3>Creating failed!</h3>
                </div>
            ";
        }
        pg_close($connection); // Closing Connection
    }

    ?>
</div>

</body>
</html>

