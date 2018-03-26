<?php
$q = $db->prepare("SELECT U.id , U.pseudo, U.email, U.avatar
                                   
                                        
                              FROM users U, friends_relationships F 
                              WHERE (F.user_id2 = U.id OR F.user_id1 = U.id)                              
                              AND
                              CASE
                                        WHEN F.user_id1 = :user_id
                                        THEN F.user_id2 = U.id
                                            
                                        WHEN F.user_id2 = :user_id
                                        THEN F.user_id1 = U.id
                                    END
                              AND status = '1' ");

$q->execute([
    'user_id' => $_GET['id']
]);

$friends = $q->fetchAll(PDO::FETCH_OBJ);