<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "mygrading";

// Connecting to database
$connection = new mysqli($hostname, $username, $password, $database);

// Checking if connection is successfully
if($connection->connect_error)
{
    die("Connection to the database has failed: ".$connection->connect_error);
}

session_start();

if(isset($_POST['login']))
{
    $username = mysql_real_escape_string($_POST["username"]);
    $password = mysql_real_escape_string($_POST["password"]);
    
    $sql = $connection->prepare("SELECT * FROM  `users` WHERE `username`= ?");
    $sql->bind_param("s", $username);
   $sql->execute();
   $result = $sql->get_result();
   if($result->num_rows > 0)
   {
        while($row = $result->fetch_assoc())
        {
            if($row["password"] === $password)
            {
                header("location: dashboard.php");
                exit;
            }
            else
            {
                echo "<script>alert('Invalid username or password!');</script>";
            }
        }
   }
   else
   {
    echo "<script>alert('You must enter valid informations!');</script>";
   }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 id="logi">Login Form</h2>
            <div class="form">
                <form action="" method="post">
                    <label for="username" style="margin-left: 20px; color: white;">UserName:
                        <input type="text" name="username" id="username" class="form-cont" maxlength="20" minlength="5" required>
                    </label>
                    <label for="password" style="margin-left: 20px; color: white;">Password:
                        <input type="password" name="password" id="password" class="form-cont" maxlength="20" minlength="6">
                    </label>
                    <br>
                    <button type="submit" class="btn" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>