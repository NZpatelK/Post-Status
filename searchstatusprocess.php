<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Display Status</title>
</head>

<body>
    <div class="content">

    <h1>Status Information</h1>

        <?php

        if(!empty($_GET['Search']))
        {
            GetDataFromDatabase($_GET['Search']);
        }

        function GetDataFromDatabase($userInput)
        {
            $conn = @mysqli_connect("server name", "username", "password", "database name" or  die("<h3>Unable to connect to the database server.</h3>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>");

            $result = mysqli_query($conn, "SELECT * from diary where StatusCode like '%{$userInput}%' or Status like '%{$userInput}%'") or die("<h1> Unable to query to the Database server. </h1> <p> Error: " . mysqli_error($conn) . "</p>");

            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_row($result))
                {
                    echo "<div class='displayStatus'>

                    <h3 class='title'>Status Code:  </h3>
                    <p class='post'>" .$row[0]. "</p>
                    <br>
                    
            
                    <h3 class='title'>Date: </h3>
                    <p class='post'>" .$row[3]. "</p>
                    <br>                    
            
                    <h3 class='title'>Share: </h3>
                    <p class='post'>" .$row[2]. "</p>
                    <br>
            
                    <h3 class='title'>Permission: </h3>
                    <p class='post'>" .$row[4]. "</p>
                    <br>
            
                    <h3 class='status'>Status: </h3>
                    <p class='post'>" .$row[1]. "</p>
                    <br>

                    <div class='button'>
                    <a href='searchstatusform.html' class='links'> Search for another status </a>
                    <a href='index.html' class='links'>Return to Home Page </a>
                    </div>
            
                    </div>";

                }
            }
            else
            {
                echo "no result found
                <div class='button'>
                <a href='searchstatusform.html' class='links'> Search for another status </a>
                <a href='index.html' class='links'>Return to Home Page </a>
                </div>";
            }


            mysqli_close($conn);
        }

        ?>

       
    </div>
</body>

</html>