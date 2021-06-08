<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Status Post Processing</title>
</head>

<body>
    <div class="content">

        <div class="displayStatus">

            <?php

            if (isset($_POST['statusCode'])) {
                $formDetail = array(
                    "statusCode" => $_POST["statusCode"],
                    "status" => $_POST["status"],
                    "shareOpt" => $_POST["shareOpt"],
                    "date" => $_POST["Date"],
                    "permission" => $_POST["permission"]
                );

                checkValidInput($formDetail);
            } else {
                echo "submit failed";
            }



            function checkValidInput($formDetail)
            {
                foreach ($formDetail as $key => $value) {
                    switch ($key) {
                        case 'statusCode':
                            $pattern = '/[S][0-9]{4}/i';
                            $valid = checkPatternValid($value, $pattern);
                            break;

                        case 'status':
                            $pattern = "/^[a-zA-Z0-9\s!?.,]+$/";
                            $valid = checkPatternValid($value, $pattern);
                            break;

                        case 'date':
                            $valid = checkDateValid($value);
                            break;

                        default:
                            #code
                            break;
                    }

                    if (!$valid) {
                        outputErrorMessage($key);
                        break;
                    }
                }
                if ($valid) {
                    postIntoDatabase($formDetail);
                }
            }

            function checkPatternValid($userInput, $pattern)
            {

                if (preg_match($pattern, $userInput)) {

                    return true;
                }

                return false;
            }

            function checkDateValid($date)
            {
                if (strtotime($date) === false) {
                    return false;
                }

                list($year, $month, $day) = explode("-", $date);

                return checkdate($month, $day, $year);
            }

            function outputErrorMessage($key)
            {
                switch ($key) {
                    case 'statusCode':

                        echo '<h1>Status Code Error</h1>
                    <p>The status code is not match the required of 5 characters in length or start with an uppercase letter “S” followed by 4 numbers</p>';

                        break;

                    case 'status':

                        echo '<h1>Status Error</h1>
                    <p>The status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters or symbols are not allowed.</p>';

                        break;

                    case 'date':
                        echo '<h1>Date Error</h1>
                    <p>Date input is correct date. Please input correct date.</p>';

                        break;

                    case 'duplicate':
                        echo '<h1>Status Code Duplicate</h1>
                    <p>The Status Code is already taken.</p>';

                        break;

                    default:
                        #code
                        break;
                }



                return false;
            }

            function postIntoDatabase($formDetail)
            {
                $conn = @mysqli_connect("server name", "username", "password", "database name") or  die("<h3>Unable to connect to the database server.</h3>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>");


                $duplicateStatusCode = mysqli_query($conn, "SELECT * from diary where StatusCode='$formDetail[statusCode]'");


                if (mysqli_num_rows($duplicateStatusCode) > 0) {
                    outputErrorMessage("duplicate");
                } else {


                    $permissionString = implode(" - ", $formDetail["permission"]);
                    
                    $query =  "INSERT INTO diary (StatusCode, Status, Share, Date, Permission)
                        VALUES ('$formDetail[statusCode]', '$formDetail[status]', '$formDetail[shareOpt]','$formDetail[date]', '$permissionString')";


                    if (mysqli_query($conn, $query)) {
                        echo '<h1> Status is Successful Post.</h1>';
                    } else {
                        echo "<h1> Status is Unsuccessful Post. </h1>";
                        echo "<p> Error: " . mysqli_error($conn) . "</p>";
                    }
                }

                mysqli_close($conn);
            }

            ?>

            <div class="button">
                <a href="index.html" class="links"> Return to Home Page</a>
                <a href="poststatusform.php" class="links">Post Status Page</a>
            </div>

        </div>

    </div>
</body>

</html>