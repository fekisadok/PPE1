<?php
session_start();
session_decode();


require ('config/database.php');
$q=$db->prepare('DELETE FROM auth_tokens WHERE user_id = ?');
$q-> execute ([$_SESSION['user_id']]);


$_SESSION= [];

setcookie('auth', '', time()-3600);



header('Location: index.php');

?>