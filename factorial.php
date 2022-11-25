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
    
    $factorial = "";
    $number = "";

    if(isset($_POST['process']))
    {
        $number = $_POST["number"];

       if(is_numeric($number))
       {
            $a = 1;
            $factorial = 1;
            while($a <= $number)
            {
                $factorial = $factorial * $a;
                $a++;
            }
            $sql = $connection->prepare("INSERT INTO `factorial`(`number`, `factorial`) VALUE(?, ?)");
            $sql->bind_param("ii", $number, $factorial);
            $result = $sql->execute();
            
            if(!$result)
            {
                die("Invalid Query:".$connection->connect_error);
            }
       }
       else
       {
            echo "You must enter a number!";
       }
    }
    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    <div>
        <h2>Find Foctorial of every number by using this system.</h2>
        <form action="" method="post">
            <label for="number">Enter the number:
                <input type="text" name="number" id="number" value="<?php  echo "$number"; ?>"><br>
            </label>

            <input type="text" value="<?php  echo "$factorial"; ?>"><br>
            <input type="submit" name="process" value="Process">
        </form>
    </div>
</body>
</html>