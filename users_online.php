<?php
session_start();
require ('includes/init.php');


$time_session = 15;
$time_now = date ('U');
$user_ip = $_SERVER['REMOTE_ADDR'];

$q = $db-> prepare ('SELECT * FROM online 
                                WHERE user_id = :user_id');

$q->execute([
    'user_id'=> get_session('user_id')
//    'user_id'=> $friend->id
]);

$online= $q->rowCount();

if ($online ==0){
    $q = $db -> prepare ('INSERT INTO online (user_id, time, user_ip)
                                    VALUES (:user_id, :time, :user_ip)');
    $q-> execute([
        'user_id' => get_session('user_id'),
        'time' => $time_now,
        'user_ip' => $user_ip
    ]);
}else {
    $q=$db->prepare('UPDATE online SET time = :time WHERE user_id = :user_id');
    $q->execute([
        'time' => $time_now,
        'user_id'=> get_session('user_id')
    ]);
}

$delete_time= $time_now - $time_session;

$q=$db->prepare('DELETE FROM online WHERE time < :time');
$q->execute([
    'time'=>$delete_time
]);

$q=$db->prepare('SELECT O.user_id, U.pseudo, U.email, U.avatar, U.id, U.nom, U.prenom FROM users U, online O WHERE O.user_id = U.id AND O.user_id NOT IN (SELECT user_id FROM online WHERE user_id= :user_id)');
$q->execute([
    'user_id' => get_session('user_id')
]);
$members_onlines= $q->fetchAll(PDO::FETCH_OBJ);

if (count($members_onlines) >0) {
    foreach ($members_onlines as $member_online) {
        ?>

        <div class="display-box-user" id="new_chat" onclick="new_chat('<?= $member_online->id ?>');">
            <a href="index.auth.php?id=<?= get_session('user_id') ?>&user=<?= $member_online->id ?>">
                <img src="<?= $member_online->avatar ? $member_online->avatar : get_avatar_url($member_online->email, 25) ?>"
                     alt="<?= e($member_online->pseudo) ?>"
                     class="img-circle" width="25">&nbsp;
                <?= e($member_online->nom) ?>&nbsp;<?= e($member_online->prenom) ?>
            </a>
        </div>

        <?php
    }
}else{
    echo '<div class="display-box-user">Aucun utilisateur trouvé. </div>';
}
?>

