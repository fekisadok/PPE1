<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');

if(!empty($_GET['id'])){
    //Recuperer les infos sur l'user en bdd en utilisant son id
    $user = find_user_by_id($_GET['id']);

    if(!$user){
        redirect('index.php');
    } else {
        $q = $db->prepare("SELECT M.id, M.id_sender, M.id_receiver, M.message, M.created_at, U.id, U.pseudo,U.nom, U.prenom, U.avatar
                                         FROM users U, messages M
                                        WHERE (M.id_sender= :user_id OR M.id_receiver= :user_id)
                                         AND
                                         CASE
                                             WHEN M.id_sender = :user_id
                                             THEN M.id_receiver = U.id
                                            
                                             WHEN M.id_receiver = :user_id
                                             THEN M.id_sender = U.id
                                         END
                                         GROUP BY U.id
                                         ORDER BY M.created_at DESC");

        $q->execute([
            'user_id' => $_GET['id']
        ]);

        $messages = $q->fetchAll(PDO::FETCH_OBJ);


    }

} else {
    redirect('inbox.php?id='.get_session('user_id'));
}
//if(!empty($_GET['user'])){
    //Recuperer les infos sur l'user en bdd en utilisant son id
//    $user = find_user_by_id($_GET['id']);
//
//    if(!$user){
//        redirect('index.php');
//    } else {
//        $q = $db-> prepare ("SELECT * FROM messages
//                                WHERE (id_sender= :id_sender AND id_receiver= :id_receiver)
//                                OR (id_receiver= :id_sender AND id_sender= :id_receiver)
//                                ORDER BY created_at ");
//        $q->execute([
//            'id_sender' => $id,
//            'id_receiver' => $user,
//        ]);
//        $msgs=array();
//        while ($rows = $q->fetchObject()){
//            $msgs[] = $rows;
//        }
//
//
//    }
//
//} else {
//    redirect('inbox.php?id='.get_session('user_id'));
//}

include('views/inbox.view.php');

?>