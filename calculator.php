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

$errorMessage = "";
$num1 = "";
$num2 = "";
$answer = "";

if(isset($_POST['calculate']))
{
   $num1 = $_POST["num1"];
   $operator = $_POST["operator"];
   $num2 = $_POST["num2"];

   if(is_numeric($num1) && is_numeric($num2))
   {
        switch($operator)
        {
            case "addition" : $answer = $num1 + $num2;
                break;
            case "substruction" : $answer = $num1 - $num2;
                break;
            case "multiplication" : $answer = $num1 * $num2;
                break;
            case "division" : $answer = $num1 / $num2;
                break;
        }

        $sql = $connection->prepare("INSERT INTO `calculator`(`num1`, `operator`, `num2`, `answer`) VALUE(?, ?, ?, ?)");
        $sql->bind_param("isii", $num1, $operator, $num2, $answer);
        $result = $sql->execute();

        if(!$result)
        {
            die("Invalid Query:".$connection->connect_error);
        }
   }
   else
   {
     $errorMessage = "You must enter a number";
   }
     
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="conta">
       <center>
            <form action="" method="post">
                
                <input type="text" value="<?php echo $answer;?>" class="screen">
                <div class="fi-box"><input type="text" name="num1" size="3" id="box" value="<?php echo $num1; ?>" required ></div>
                <?php
                    echo "<div style='color: red;'><script>document.write('$errorMessage');</script></div>";
                 ?>
                <div class="option">
                    <select name="operator" id="list">
                        <option value="addition">+</option>
                        <option value="substruction">-</option>
                        <option value="multiplication">*</option>
                        <option value="division">/</option>
                    </select>
                </div>

               <div  class="se-box"><input type="text" name="num2" size="3" id="box-s"  value="<?php echo $num2; ?>" required></div>
                <button type="submit" name="calculate" class="bnt-calculate">Calculate</button>
            </form>
       </center>
    </div>
</body>
</html>