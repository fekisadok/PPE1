<?php
session_start();
require 'config/database.php';
require 'includes/functions.php';

if(!empty($_GET['id']) && !empty($_GET['avatar'])) {

    $q = $db->prepare("UPDATE users SET avatar = :avatar WHERE id= :id");
    $q->execute([
        'avatar' => $_GET['avatar'],
        'id' => $_GET['id']
    ]);
    $_SESSION['avatar']= $_GET['avatar'];
    set_flash("Votre avatar a été mis à jour !");
}else{
    set_flash("Une erreur s'est produite.. Veuillez réessayer");

}
redirect('photos.php?id='.get_session('user_id'));
?>