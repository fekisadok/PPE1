<?php
session_start();
require '../config/database.php';
require '../includes/functions.php';

extract($_POST);
        $q = $db->prepare("INSERT INTO messages (id_sender, id_receiver, message) 
                                    VALUES (:id_sender, :id_receiver, :message)");

        $q->execute([
            'id_sender' => $id_sender,
            'id_receiver' => $id_receiver,
            'message' => $message
        ]);

?>