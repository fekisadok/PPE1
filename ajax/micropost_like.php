<?php
session_start();
require '../config/database.php';
require '../includes/functions.php';
extract($_POST);

if ($action == 'like'){
    if (!user_like_micropost($micropost_id)) {
        like_micropost($micropost_id);
    }
}else{
    if (user_like_micropost($micropost_id)) {

        unlike_micropost($micropost_id);
    }
}

echo display_likers($micropost_id);