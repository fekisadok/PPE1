<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');


if (isset($_POST['comment'])){

    if (!empty($_POST['commentaire'])){
        extract($_POST);

        $q =$db -> prepare ('INSERT INTO comment(commentaire, user_id, micropost_id) VALUE (:commentaire, :user_id, :micropost_id)');
        $q ->execute( [
            'commentaire' => $commentaire,
            'user_id' => get_session('user_id'),
            'micropost_id' => $_GET['id']
        ]);
        $q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id)
                                     VALUES(:subject_id, :name, :user_id)');
        $q->execute([
            'subject_id' =>$_GET['user'],
            'name' => 'comment_sent',
            'user_id' => get_session('user_id'),
        ]);
        set_flash('Votre commentaire a bien été publié ! ');
    }
}

redirect('index.auth.php?id='.get_session('user_id'));