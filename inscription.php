<?php
//session_start();
//require ('filter/guest_filter.php');

//require ('includes/constants.php');



if (isset($_POST['inscription'])) {
//    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['confirm_email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
    if (not_empty(['pseudo','nom','prenom','email','confirm_email','password','confirm_password','date_naissance'])) {

        $errors = [];
        extract($_POST);
        if (mb_strlen($pseudo) < 3) {
            $errors[] = "Pseudo trop court ! (Minimum 3 caractères)";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide !";
        } else {
            if ($email != $confirm_email) {
                $errors[] = "Les deux adresses email ne concordent pas !";
            }
        }
        if (mb_strlen($password) < 6) {
            $errors[] = "Mot de passe trop court ! (Minimum 6 caractères)";
        } else {
            if ($password != $confirm_password) {
                $errors[] = "Les deux mots de passe ne concordent pas !";
            }
        }
        if (is_already_in_use('pseudo', $pseudo, 'users')) {
            $errors[] = "Pseudo déjà utilisé !";
        }
        if (is_already_in_use('email', $email, 'users')) {
            $errors[] = "Adresse email déjà utilisée !";
        }
        if (count($errors) == 0) {
            //Envoyer mail d'activation
            $to = $email;
            $subject = WEBSITE_NAME . " - ACTIVATION DE COMPTE";
            $password = sha1($password);
            $token = sha1($pseudo . $email . $password);
            //inclure fichier sans l'afficher
            ob_start();
            require('templates/emails/activation.view.php');
            $content = ob_get_clean();

            $headers = 'NIME-Version:1.0' . "\r\n";
            $headers = 'Content-type: text/html; charset = iso-8859-1' . "\r\n";

            mail($to, $subject, $content, $headers);

            // Informer utilisateur de regarder boite reception
            set_flash("Mail d'activation envoyé !", 'success');
            $img_default = "/2eme_Annee/bootstrap-social-network-template-master\bootstrap-social-network-template-master/img/user1.png";
            $q = $db-> prepare('INSERT INTO users (pseudo, email, password, nom, prenom, civilite , date_naissance, avatar)
                                VALUES (:pseudo, :email, :password, :nom, :prenom, :civilite, :date_naissance, :avatar)');
            $q-> execute ([
                'pseudo'=> $pseudo,
                'email' => $email,
                'password' => $password,
                'nom' => $nom,
                'prenom' => $prenom,
                'civilite' => $civilite,
//                'date_naissance' => formater($date_naissance,true)
                'date_naissance' => $date_naissance,
                'avatar' => $img_default
//                'date_naissance' => date("Y-m-d", strtotime($date_naissance))
            ]);

            $q = $db-> prepare ('CREATE TRIGGER insert BEFORE INSERT ON users
                                            FOR EACH ROW
                                            BEGIN
                                            UPDATE stats SET date= NOW() AND nbr_users= nbr_users+1');

            redirect('index.php');
            //Redirection vers le profil
        }else{
            save_data();
        }
    } else {
        $errors[] = "Veuillez remplir tous les champs !";
        save_data();
    }
}else {
    clear_data();
}



?>

<?php require ('views/inscription.view.php');   ?>