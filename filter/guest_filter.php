<?php
require ('includes/functions.php');
if (isset($_SESSION['user_id']) || isset($_SESSION['pseudo'])){
    redirect('index.auth.php');
}
?>