<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');


if (isset($_POST['publier'])){

    if (!empty($_POST['contenu'])){
        extract($_POST);

        $q =$db -> prepare ('INSERT INTO microposts(contenu, user_id) VALUE (:contenu, :user_id)');
        $q ->execute( [
            'contenu' => $contenu,
            'user_id' => get_session('user_id')
        ]);

        set_flash('Votre publication a été envoyée ! ');
    }
}

redirect('index.auth.php?id='.get_session('user_id'));