<?php
session_start();
require '../config/database.php';
require '../includes/functions.php';


$id= $_SESSION['id'];
$user = $_SESSION['user'];

$q = $db-> prepare ("SELECT * FROM messages 
                                WHERE (id_sender= :id_sender AND id_receiver= :id_receiver)
                                OR (id_receiver= :id_sender AND id_sender= :id_receiver)
                                ORDER BY created_at ");
$q->execute([
    'id_sender' => $id,
    'id_receiver' => $user,
]);
$msgs=array();
while ($rows = $q->fetchObject()){
    $msgs[] = $rows;
}
//$msgs = $q->fetchAll(PDO::FETCH_OBJ);

foreach ($msgs as $msg){
    if ($msg->id_sender == $id){
        ?>
        <ul class="list-unstyled">

        <li class="left clearfix admin_chat">
                     <span class="chat-img1 pull-right">
                     <img src="<?=  find_user_by_id($msg->id_sender)->avatar ?>" alt="User Avatar" class="img-circle">
                     </span>
            <div class="chat-body1 clearfix">
                <p><?= $msg->message ?></p>
                <div class="chat_time pull-left"><?=$msg->created_at ?></div>
            </div>
        </li>
        <?php
    }else { ?>

        <li class="left clearfix">
                     <span class="chat-img1 pull-left">
                     <img src="<?=  find_user_by_id($msg->id_sender)->avatar ?>" alt="User Avatar" class="img-circle">
                     </span>
            <div class="chat-body1 clearfix">
                <p><?= $msg->message ?></p>
                <div class="chat_time pull-right"><?=$msg->created_at ?></div>
            </div>
        </li>
        </ul>
        <?php
    }
}