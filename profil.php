<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');


if(!empty ($_GET['id'])){
        $user = find_user_by_id ($_GET['id']);
//
//    var_dump($user);
//    die();

    if (!$user){
        redirect('index.php');
    }else {
        $q=$db -> prepare ('SELECT id, contenu, created_at, like_count FROM microposts WHERE user_id= :user_id ORDER BY created_at DESC');
        $q ->execute([
//            'user_id'=> get_session('user_id')
            'user_id'=> $_GET['id']
        ]);
        $microposts = $q-> fetchAll(PDO::FETCH_OBJ);


    }
}else{
    redirect('profil.php?id='.get_session('user_id'));
}

if (isset ($_POST['update'])){
    $errors = [];
    extract($_POST);
    if (not_empty(['new_pseudo'])){
//        $errors = [];
//        extract($_POST);


        if (mb_strlen($new_pseudo) < 3) {
            $errors[] = "Pseudo trop court ! (Minimum 3 caractères)";
        }else if (is_already_in_use('pseudo', $new_pseudo, 'users')) {
            $errors[] = "Pseudo déjà utilisé !";
        }else{
            $updatepseudo=$db->prepare("UPDATE users SET pseudo = ? WHERE id = ?");
            $updatepseudo->execute(array($new_pseudo, get_session('user_id')));
//            redirect ('profil.php?id='.get_session('user_id'));
        }
    }
    if (not_empty(['new_email','confirm_new_email'])){
//        $errors = [];
//        extract($_POST);

        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide !";
        }else if ($new_email != $confirm_new_email){
            $errors[] = "Les deux adresses email ne concordent pas !";
        }else if (is_already_in_use('email', $new_email, 'users')) {
            $errors[] = "Adresse email déjà utilisée !";
        }else {
                $updatemail=$db->prepare("UPDATE users SET email = ? WHERE id = ?");
                $updatemail->execute(array($new_email, get_session('user_id')));
//                redirect ('profil.php?id='.get_session('user_id'));
            }
        }
    if (not_empty(['old_password','new_password','confirm_new_password'])){
//        $errors = [];
//        extract($_POST);
        if (sha1($old_password) !=  same_password(get_session('user_id'))){
            $errors[] = "Ancien mot de passe incorrect !";
        }else if (mb_strlen($new_password) < 6) {
            $errors[] = "Mot de passe trop court ! (Minimum 6 caractères)";
        } else if ($new_password != $confirm_new_password) {
            $errors[] = "Les deux mots de passe ne concordent pas !";
        }else {
            $new_password = sha1($new_password);
            $updatepassword = $db ->prepare("UPDATE users SET password =? WHERE id =?");
            $updatepassword->execute(array($new_password, get_session('user_id')));
//            redirect ('profil.php?id='.get_session('user_id'));
        }
    }
    if (not_empty(['new_ville'])){
//        $errors = [];
//        extract($_POST);

            $updateville = $db ->prepare("UPDATE users SET ville =? WHERE id =?");
            $updateville->execute(array($new_ville, get_session('user_id')));
//            redirect ('profil.php?id='.get_session('user_id'));
        }
    if (not_empty(['new_pays'])){
//        $errors = [];
//        extract($_POST);

        $updatepays = $db ->prepare("UPDATE users SET pays =? WHERE id =?");
        $updatepays->execute(array($new_pays, get_session('user_id')));
//        redirect ('profil.php?id='.get_session('user_id'));
    }
    if (count($errors)==0){
        redirect ('profil.php?id='.get_session('user_id'));
    }

}
//redirect ('profil.php?id='.get_session('user_id'));
//die();
include 'views/profil.view.php';

?>