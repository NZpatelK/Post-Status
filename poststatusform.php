<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Status Posting System</title>
</head>

<body>
    <div class="displayStatus">
        <h1>Status Posting System</h1>

        <form action="poststatusprocess.php" method="POST">

            <p> Status Code (required): <input type="text" name="statusCode" maxlength='5' value="S" pattern="[S][0-9]{4}" title="It must start with an uppercase letter “S” followed by 4 numbers." required> </p>
            <p>Status (required) <input type="text" name="status"   pattern="^[a-zA-Z0-9\s!?.,]+$" title="The status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters or symbols are not allowed." required></p>


            <p>
                <span> Share: </span>
                <input type="radio" name="shareOpt" value="Public">
                <label for="Public">Public</label>

                <input type="radio" name="shareOpt" value="Friends">
                <label for="Friends">Friends</label>

                <input type="radio" name="shareOpt" value="OnlyMe">
                <label for="OnlyMe">Only Me</label>
                </label>
            </p>

            <p> Date: <input type="date" name="Date" value="<?php echo date('Y-m-d'); ?>" required> </p>

            <p>
                <span> Permission: </span>
                <input type="checkbox" name="permission[]" value="Allow Like">
                <label for="AllowLike">Allow Like</label>

                <input type="checkbox" name="permission[]" value="Allow Comment">
                <label for="AllowComment">Allow Comment</label>

                <input type="checkbox" name="permission[]" value="Allow Share">
                <label for="AllowShare">Allow Share</label>
            </p>

            <input type="submit" value="submit" class="postFormButton">
            <input type="reset" value="reset" class="postFormButton">

            <br>

            <a href="index.html" class="links">Return to Home Page</a>

        </form>
    </div>
</body>

</html>