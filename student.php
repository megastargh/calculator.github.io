<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "mygrading";

// Connecting to database
$connection = new mysqli($hostname, $username, $password, $database);


$firstname = "";
$surname = "";
$gender = "";
$age    = "";

$errorMessage = "";
$success =  "";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname = mysql_real_escape_string($_POST["firstname"]);
    $surname = mysql_real_escape_string($_POST["surname"]);
    $gender = mysql_real_escape_string($_POST["gender"]);
    $age    = mysql_real_escape_string($_POST["age"]);

    do
    {
        if(empty($firstname) || empty($surname) || empty($gender) || empty($age))
        {
            $errorMessage = "You must enter data into all fields";
            break;
        }

        $sql = $connection->prepare("INSERT INTO `students` (`firstname`, `surname`, `gender`,`age`) VALUE(?, ?, ?, ?)");
        $sql->bind_param("sssi", $firstname, $surname, $gender, $age);

        $result = $sql->execute();

        if(!$result)
        {
            die("Invalid query: ".$connection->connect_error);
        }

        $firstname = "";
        $surname = "";
        $gender = "";
        $age    = "";


        $success = "New student have been added";

        header("location: student.php");
        exit;

    }while(false);
}


?>

<!DOCTYPE HTML5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="all" />
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/themify-icons/themify-icons.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/fabochart.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/chocolat.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/bars.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/atlas.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/clndr.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/icon-font.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/vroom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/jqvmap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/popuo-box.css" media="all" />
    <script src="js/bootstrap.min.js" type="text/css"></script>
</head>
    <body>
        <div class="container-page">
            <div class="row">
            <?php require_once("include/header.php");?>
                <div class="row-cols-1 col-2-2">

                    <div class="group-page w-100">
                    <?php require_once("include/sidebar.php");?>
                        <div width="100%" height="max-content" style="position: absolute; left: 30%;">
                            <div width="70%" height="20px" style="">
                                <h2 style="text-align: center; font-size: 2.5em;">Add New Student</h2>
                                <form action="" method="post">
                                    <?php
                                    if(!empty($errorMessage))
                                    {
                                        echo $errorMessage;
                                    }
                                    ?>
                                    <label for="firstname">First Name:
                                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                                    </label>
                                    <br>
                                    <label for="surname">Sur Name:
                                        <input type="text" name="surname" id="surname" class="form-control" required>
                                    </label>
                                    <legend >Gender:
                                        <label for="male">
                                            Male<input type="radio"  name="gender" id="male" value="m" required>
                                        </label>
                                        <label for="female">
                                            Female<input type="radio" name="gender" id="female" value="f" required>
                                        </label>
                                    </legend>
                                    <label for="age">Age:
                                        <input type="text" name="age" id="age" class="form-control" required>
                                    </label>
                                    <?php

                                        if(!empty($success))
                                        {
                                            echo $success;
                                        }
                                    ?>
                                    <br>
                                    <button type="submit" class="btn btn-primary" style="cursor: default;">Add Student</button>
                                </form>
                           </div>
                           <br>
                           <div width="30%">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Sur Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Added At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        $sql = "SELECT `id`, `firstname`, `surname`, `gender`, `age`, `create_at`  FROM  `students`";


                                        $result = $connection->query($sql);

                                        if(!$result)
                                        {
                                            die("Invalid Query: ".$connection->connect_error);
                                            break;
                                        }

                                        while($row = $result->fetch_assoc())
                                        {
                                            echo "
                                            <tr>
                                                <td>$row[id]</td>
                                                <td>$row[firstname]</td>
                                                <td>$row[surname]</td>
                                                <td>$row[gender]</td>
                                                <td>$row[age]</td>
                                                <td>$row[create_at]</td>
                                            </tr>
                                            ";
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
                <?php require_once("include/footer.php"); ?>
            </div>
        </div>
    </body>
</html>