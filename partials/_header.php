
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

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="libraries/sweetalert/sweetalert.css">


  </head>
 <body>

  <header>
    <div class="container">
      <img src="img/logo.png" class="logo" alt="">
      <form class="form-inline"  method="post">
        <div class="form-group">
          <label class="sr-only" for="identifiant">Email address</label>
          <input type="text" class="form-control" id="identifiant" value="<?= get_data('identifiant') ?>" name="identifiant" placeholder="Enter email or pseudo">
        </div>
        <div class="form-group">
          <label class="sr-only" for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <input type="submit" class="btn btn-default" name="login" value="Connexion"/><br>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me"> Se souvenir de moi
</label>
        </div>
		
      </form>
    </div>
  </header>

 <?php include ('partials/_menu.php'); ?>
 <?php include ('partials/_flash.php'); ?>