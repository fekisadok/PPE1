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
    <div class="row msg_container base_sent">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent">
                <p><?= $msg->message ?></p>
                <time datetime="2009-11-13T20:00"><?=$msg->created_at ?></time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar">
            <img src="<?=  find_user_by_id($msg->id_sender)->avatar ? find_user_by_id($msg->id_sender)->avatar : get_avatar_url(find_user_by_id($msg->id_sender)->email, 100) ?>"
                 class="img-responsive"  >

        </div>
    </div>
        <?php
}else { ?>
        <div class="row msg_container base_receive">
        <div class="col-md-2 col-xs-2 avatar">
            <img src="<?=  find_user_by_id($msg->id_sender)->avatar ? find_user_by_id($msg->id_sender)->avatar : get_avatar_url(find_user_by_id($msg->id_sender)->email, 100) ?>" class=" img-responsive ">
        </div>
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_receive">
                <p><?= $msg->message ?></p>
                <time datetime="2009-11-13T20:00"><?=$msg->created_at ?></time>
            </div>
        </div>
        </div>

<?php
    }
}