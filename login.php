<?php
//session_start();
//include ('filter/guest_filter.php');
//require ('includes/init.php');
//require ('config/database.php');
//require ('includes/functions.php');

//require ('includes/constants.php');



if (isset($_POST['login'])) {
   if (not_empty(['identifiant','password'])) {

        extract($_POST);

        $q = $db -> prepare ("SELECT id, avatar, pseudo, email FROM users 
                                        WHERE (pseudo = :identifiant OR email = :identifiant)
                                        AND password = :password ");

        $q->execute([
            'identifiant' => $identifiant,
            'password' => sha1($password)
        ]);

        $userHasBeenFound = $q->rowCount();

        if($userHasBeenFound){
            $user = $q -> fetch(PDO::FETCH_OBJ);


                $_SESSION ['user_id']= $user -> id;
                $_SESSION ['pseudo']= $user -> pseudo;
                $_SESSION ['avatar']= $user -> avatar;
                $_SESSION ['email']= $user -> email;


                //Si remember me
                if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on'){
                    remember_me($user->id);
                }
        redirect('index.auth.php?id='.$user->id);
        }else{
            set_flash('Combinaison Identifiant/Mot de passe incorrecte!', 'danger');
            save_data();
        }

}}else {
    clear_data();
}



?>
<?php //echo 'Connexion réussi !';  ?>