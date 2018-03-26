
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php
        echo isset($title)
            ? $title .'- StudGood'
            : "StudGood - Au coeur de l'événement";

        ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="librairies/uploadify/uploadify.css" rel="stylesheet">
    <link href="librairies/alertifyjs/css/alertify.css" rel="stylesheet">
    <link href="librairies/alertifyjs/css/themes/bootstrap.css" rel="stylesheet">
    <link href="libraries/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">


</head>
<body>

<header>
    <div class="container">
        <img src="img/logo.png" class="logo" alt="">
        <form class="form-inline" action="logout.php" >
            <input type="submit" class="btn btn-default" name="logout" value="Déconnexion"/><br>
            </div>

        </form>
    </div>
</header>

<?php include ('partials/_menu.php'); ?>
<?php include ('partials/_flash.php'); ?>