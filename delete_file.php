<?php
session_start();
require 'config/database.php';
require 'includes/functions.php';

if(!empty($_GET['id']) && !empty($_GET['avatar'])) {

    $filename = substr(strrchr($_GET['avatar'], "/"), 1);
    $id= $_GET['id'];
    settype($id, "string");
    $filename= 'uploads/'.$id.'/'.$filename;
    echo $filename;
    unlink($filename);

    if ($_SESSION['avatar'] == $_GET['avatar']) {

        $img_default = "/2eme_Annee/bootstrap-social-network-template-master\bootstrap-social-network-template-master/img/user1.png";

        $q = $db->prepare("UPDATE users SET avatar = :avatar WHERE id= :id");
        $q->execute([
            'avatar' => $img_default,
            'id' => $_GET['id']
        ]);
        $_SESSION['avatar']= $img_default;
    }
    $q = $db->prepare("DELETE FROM photos WHERE lien = :avatar AND user_id= :id");
    $q->execute([
        'avatar' => $_GET['avatar'],
        'id' => $_GET['id']
    ]);
    set_flash("Votre photo a été supprimée !");
}else{
    set_flash("Une erreur s'est produite.. Veuillez réessayer");

}
redirect('photos.php?id='.get_session('user_id'));
?>