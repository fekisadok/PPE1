<?php
$q = $db->prepare("SELECT M.id_sender , M.id_receiver, M.message,U.peudo, U.email, U.avatar
                                   
                                        
                              FROM users U, messages M
                              WHERE (M.id_sender = :id_sender AND M.id_receiver = :id_receiver)                              
                              ORDER BY M.created_at");

$q->execute([
    'id_sender' => get_session('user_id'),
    'id_receiver' => $_GET['user']
]);

$msgs_receivers = $q->fetchAll(PDO::FETCH_OBJ);