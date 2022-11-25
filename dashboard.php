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
                        <div width="50px" height="50px" style="position: absolute; left: 40%; top: 25%;">
                           <p style="font-size: 4em; text-transform: uppercase;">You are welcome to our school Grading System dashboard.</p>
                        </div>
                    </div>
                </div>
                <?php require_once("include/footer.php"); ?>
            </div>
        </div>
    </body>
</html>