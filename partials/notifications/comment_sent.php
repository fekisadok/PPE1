
<a href="profil.php?id=<?= $notification->user_id ?>">
    <img src="<?= $notification->avatar ? $notification->avatar : get_avatar_url($notification->email, 40) ?>"
         alt="Image de profil de <?= e($notification->pseudo) ?>" class="avatar-xs"><?= e($notification->pseudo) ?>
</a>
a commenté votre publication <span class="timeago" title="<?= $notification->created_at ?>"><?= $notification->created_at ?></span>.