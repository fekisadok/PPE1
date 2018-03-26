<?php if (relation_link($_GET['id'])== "cancel_link"): ?>
    <a class="btn btn-primary pull-right" href="delete_friend.php?id=<?= $_GET['id'] ?>">Annuler la demande</a>

<?php elseif (relation_link($_GET['id'])== "accept_reject_link"): ?>
    <a class="btn btn-danger pull-right" href="delete_friend.php?id=<?= $_GET['id'] ?>">Décliner</a>
    <a class="btn btn-success pull-right" href="accept_friend.php?id=<?= $_GET['id'] ?>">Accepter</a>

<?php elseif (relation_link($_GET['id'])== "delete_link"): ?>
    <a class="btn btn-primary pull-right" href="delete_friend.php?id=<?= $_GET['id'] ?>">Retirer de ma liste d'amis</a>

<?php elseif (relation_link($_GET['id'])== "add_link"): ?>
    <a href="add_friend.php?id=<?=$_GET['id']?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ajouter comme ami</a>

<?php endif; ?>