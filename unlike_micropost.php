<?php
session_start();

require("includes/init.php");
include('filter/user_filter.php');


if(!empty($_GET['id'])){


    if (user_like_micropost($_GET['id'])) {

        unlike_micropost($_GET['id']);
    }
}

redirect('index.auth.php?id='.get_session('user_id').'#micropost'.$_GET['id']);