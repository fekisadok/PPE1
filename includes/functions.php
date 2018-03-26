<?php

//Echaper les entrées utilisateurs
if (!function_exists('e')){
    function e($string){
        if ($string){
            return htmlspecialchars($string);
        }
    }
}
//Echaper les entrées utilisateurs
if (!function_exists('get_notif_msg')){
    function get_notif_msg($user_id){
        global $db;
//        $time_now=date('Y-m-d H:i:s');
//        $time_session=120;
//        $diff=$time_now- $time_session;
        $q= $db->prepare('SELECT id FROM messages WHERE (created_at > NOW()- INTERVAL 1 MINUTE) AND id_receiver = :id_receiver');
        $q->execute([
//            'created_at'=>$diff,
            'id_receiver'=>$user_id
        ]);
//        return $q;
        $count = $q->rowCount();
//        return $q->fetchAll(PDO::FETCH_OBJ);
//        $q->closeCursor();
        return $count;
//            $data=$q->fetch(PDO::FETCH_OBJ);
//            return $q->fetch();
//            return intval($data->nbr_notif);
    }
}
//Echaper les entrées utilisateurs
if (!function_exists('get_img')){
    function get_img($user_id){
        global $db;
        $q= $db->prepare('SELECT lien FROM photos WHERE user_id= :id');
        $q->execute([
            'user_id'=> $user_id
        ]);

        return $q->fetchAll(PDO::FETCH_OBJ);
    }
}

//recupere nombre de like d'une publication
if (!function_exists('get_like_count')){
    function get_like_count($micropost_id){
        global $db;
        $q= $db->prepare('SELECT like_count FROM microposts WHERE id= :id');
        $q->execute(['id'=> $micropost_id]);

        $data=$q->fetch(PDO::FETCH_OBJ);
        return intval($data->like_count);
    }
}
//recupere les 3 premiers likers
if (!function_exists('get_likers')){
    function get_likers($micropost_id){
        global $db;
        $q= $db->prepare('SELECT users.id, users.pseudo FROM users
                                    LEFT JOIN micropost_like
                                    ON users.id=micropost_like.user_id
                                    WHERE micropost_id= :micropost_id
                                    LIMIT 3');
        $q->execute(['micropost_id'=> $micropost_id]);

        return $q->fetchAll(PDO::FETCH_OBJ);

    }
}
//recupere nom des likers, nombre des likers restant et affiche texte correspondant
if (!function_exists('display_likers')){
    function display_likers($micropost_id){
        $like_count= get_like_count($micropost_id);
        $likers= get_likers($micropost_id);


        $output = '';

        if ($like_count >0) {
            $remaining_like_count = $like_count - 3;
            $itself_like= user_like_micropost($micropost_id);
            foreach ($likers as $liker) {
                if (get_session('user_id') !== $liker->id) {
                    $output .= '<a href="profil.php?id=' . $liker->id . '">' . e($liker->pseudo) . '</a>, ';
                }
            }
            $output = $itself_like ? 'Vous, '.$output : $output;


            if (($like_count ==2 || $like_count ==3) && $output != ""){
                $output = trim ($output, ', ');
                $arr=explode(',', $output);
                $lastItem = array_pop($arr);
                $output = implode(', ', $arr);
                $output .= ' et ' .$lastItem;

            }
            $output = trim ($output, ', ');




            switch ( $like_count){
                case 1:
                    $output.= $itself_like ? ' aimez cette publication.' : ' aime cette publication.';
                break;
                case 2:
                case 3:
                $output.= $itself_like ? ' aimez cette publication.' : ' aiment cette publication.';
                break;
                case 4:
                    $output.= $itself_like
                        ? ' et une autre personne aimez cette publication.'
                        : ' et une autre personne aiment cette publication.';
                break;
                default:
                    $output.= $itself_like
                        ? ' et '.$remaining_like_count.' autres personnes aimez cette publication.'
                        : ' et '.$remaining_like_count.' autres personnes aiment cette publication.';
            }

        }
        return $output;
    }
}

//enregistre un like suivant le likers
if (!function_exists('like_micropost')){
    function like_micropost($micropost_id){
        global $db;
        $q = $db->prepare('INSERT INTO micropost_like (user_id, micropost_id)
                                 VALUES (:user_id, :micropost_id)');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);
        $q = $db->prepare('UPDATE microposts SET like_count = like_count + 1  
                                 WHERE id = :micropost_id');
        $q->execute([
            'micropost_id'=> $micropost_id
        ]);
    }
}
// supprime un like suivant le likers
if (!function_exists('unlike_micropost')){
    function unlike_micropost($micropost_id){
        global $db;
        $q = $db->prepare('DELETE FROM micropost_like 
                                    WHERE user_id = :user_id
                                    AND micropost_id = :micropost_id');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);
        $q = $db->prepare('UPDATE microposts SET like_count = like_count - 1  
                                 WHERE id = :micropost_id');
        $q->execute([
            'micropost_id'=> $micropost_id
        ]);
    }
}
if (!function_exists('user_like_micropost')){
    function user_like_micropost($micropost_id){
        global $db;
        $q = $db->prepare('SELECT id FROM micropost_like
                                 WHERE user_id= :user_id AND micropost_id= :micropost_id');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropost_id
        ]);

        return (bool) $q->rowCount();
    }
}
//envoi de demande d'ami
if (!function_exists('friend_request_sent')){
    function friend_request_sent($id1, $id2){
        global $db;

        $q=$db->prepare("SELECT status FROM friends_relationships 
                                   WHERE (user_id1= :user_id1 AND user_id2= :user_id2)
                                  OR (user_id1= :user_id2 AND user_id2= :user_id1)");
        $q-> execute ([
            'user_id1' => $id1,
            'user_id2' => $id2
        ]);

        $count = $q->rowCount();

        $q->closeCursor();

        return (bool) $count;
    }
}
//compte le nombre d'ami
if (!function_exists('friends_count')){
    function friends_count(){
        global $db;

        $q=$db->prepare("SELECT status FROM friends_relationships 
                                   WHERE (user_id1 = :user OR user_id2 = :user)
                                   AND status='1' ");
        $q-> execute ([
            'user' => $_GET['id']
        ]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
    }
}
//change bouton d'ajout selon situation: ajouter/annuler/refuser
if (!function_exists('relation_link')){
    function relation_link($id){
      global $db;

      $q= $db->prepare('SELECT user_id1, user_id2, status FROM friends_relationships
                                  WHERE (user_id1= :user_id1 AND user_id2= :user_id2)
                                  OR (user_id1= :user_id2 AND user_id2= :user_id1)');
      $q->execute([
          'user_id1' => get_session('user_id'),
          'user_id2' => $id
      ]);
      $data = $q->fetch();

      if ($data['user_id1'] == $id && $data['status'] == '0'){
          return "accept_reject_link";
      }elseif($data['user_id1'] == get_session('user_id') && $data['status'] == '0'){
          return "cancel_link";
      }elseif (($data['user_id1'] == get_session('user_id') or $data['user_id1'] == $id) AND $data['status'] == '1'){
          return "delete_link";
      }else {
          return "add_link";
      }

      $q->closeCursor();
    }
}
//lien dans publication clickable
if (!function_exists('replace_links')){
    function replace_links($texte){
        $regex_url = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
        return preg_replace($regex_url, "<a href =\"$0\"target=\"_blank\">$0</a>", $texte);
    }
}
if (!function_exists('cell_count')){
    function cell_count($table, $field_name, $field_value){
        global  $db;

        $q=$db->prepare ("SELECT * FROM $table WHERE $field_name= ?");
        $q-> execute ([$field_value]);

        return $q->rowCount();
    }
}
//se souvenir de moi
if (!function_exists('remember_me')){
    function remember_me($user_id){
      global $db;

      $token= openssl_random_pseudo_bytes(24);

      do{
          $selector = openssl_random_pseudo_bytes(9);
      }while (cell_count('auth_tokens', 'selector', $selector)>0);

      $q=$db ->prepare ("INSERT INTO auth_tokens (selector, expires, user_id, token)
                                   VALUES (:selector , ADDDATE(NOW(), 30), :user_id , :token)");
//        $token_hash=hash('sha256', $token); DATE_ADD (NOW(), INTERVAL 30 DAY)
      $q->execute([
          'selector' => $selector,
          'user_id' => $user_id,
          'token' => hash('sha256', $token)
      ]);

        setcookie('auth', base64_encode($selector).':'.base64_encode($token),
            time()+3600*24*30, null, null, false, true);
    }
}
//connexion automatique de l'utilisateur
if (!function_exists('auto_login')){
    function auto_login(){
        global $db;

        if(!empty($_COOKIE['auth'])){
            $split = explode(':', $_COOKIE['auth']);
            if (count($split) != 2){
                return false;
            }

            list($selector, $token)=$split;

            $q=$db->prepare ("SELECT auth_tokens.id, auth_tokens.token, auth_tokens.user_id,
                                               users.id, users.pseudo, users.avatar, users.email 
                                        FROM auth_tokens
                                        LEFT JOIN users
                                        ON auth_tokens.user_id = users.id
                                        WHERE selector = ? AND expires >= CURDATE()");
            $q-> execute ([base64_decode($selector)]);

            $data = $db->fetch(PDO::FETCH_OBJ);

            if($data){
                if (hash_equals($data->token, hash('sha256', base64_decode(token)))){

                    session_regenerate_id(true);

                    $_SESSION['user_id']= $data->user_id;
                    $_SESSION['pseudo']= $data->pseudo;
                    $_SESSION['avatar']= $data->avatar;
                    $_SESSION['email']= $data->email;

                    return true;
                }
            }
        }
        return false;
    }
}

//recupere session
if (!function_exists('get_session')){
    function get_session($key){
        if ($key){
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}
//verifie si utilisateur connecter
if (!function_exists('is_logged_in')){
    function is_logged_in(){
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}
//recuperation avatar si vide
if (!function_exists('get_avatar_url')){
    function get_avatar_url(){
//    function get_avatar_url($email, $size=25){
        return "\2eme_Annee\bootstrap-social-network-template-master\bootstrap-social-network-template-master\img\user1.png";
//        return "https://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size.'&d=mm';
    }
}
//reupere l'utilisateur selon son id
if (!function_exists('find_user_by_id')){
    function find_user_by_id($id){
        global $db;

        $q= $db->prepare ("SELECT pseudo, email, nom, prenom, civilite, date_naissance, ville, pays, avatar FROM users WHERE id = ?");
        $q-> execute ([$id]);

        $data= current($q->fetchAll(PDO::FETCH_OBJ));
        $q-> closeCursor();
        return $data;
    }
}
if (!function_exists('not_empty')){
    function not_empty($fields=[]){
        if (count($fields) != 0){
            foreach ($fields as $field){
                if (empty($_POST[$field]) || trim($_POST[$field]) == ""){
                    return false;
                }
            }
            return true;
        }
    }

}
//verifie si utilisateur existe
if (!function_exists('is_already_in_use')){
    function is_already_in_use($field, $value, $table){
        global $db;

        $q=$db->prepare("SELECT id FROM $table WHERE $field =?");
        $q-> execute ([$value]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
    }
}
//verifie si mdp identique
if (!function_exists('same_password')){
    function same_password($id){
        global $db;

        $q=$db->prepare("SELECT password FROM users WHERE id = :id");
        $q-> execute (['id'=> $id]);

        $result=$q->fetch();

        $q->closeCursor();

        return $result['password'];
    }
}
//affichage des message flash
if (!function_exists('set_flash')){
    function set_flash($message, $type = 'info'){
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;

    }
}
//redirection
if(!function_exists('redirect')){
    function redirect($page){
        header('location:'.$page);
        exit();
    }
}
//enregistrement des données saisie
if(!function_exists('save_data')) {
    function save_data()
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'password') === false) {
                $_SESSION['input'][$key] = $value;
            }
        }
    }
}
//recuperation des données saisie
if(!function_exists('get_data')) {
    function get_data($key)
    {
        if(!empty($_SESSION['input'][$key])){
        return e($_SESSION['input'][$key]);
        }else{
            return null;
        }
    }
}
//suppression des données saisie
if(!function_exists('clear_data')) {
    function clear_data()
    {
        if(isset($_SESSION['input'])){
            $_SESSION['input'] = [];
        }
    }
}
//verifie page active
if(!function_exists('set_active')) {
    function set_active($path){
        $page= array_pop(explode('/',$_SERVER['SCRIPT_NAME']));
        if ($page == $path.'.php'){
            return "active";
        }else {
            return "";
        }
    }
}
//formatage de la date de naissance
if(!function_exists('formater')) {
    function formater($date_naissance, $vers_mysql){
        if ($vers_mysql){
            $pattern = "([0-9]{2})/([0-9]{2})/([0-9]{4})";
            $replacement = "$3-$2-$1";
        }else {
            $pattern = "([0-9]{4})-([0-9]{2})-([0-9]{2})";
            $replacement = "$3/$2/$1";
        }
        return preg_replace($pattern, $replacement, $date_naissance);
    }
}