
<li class="left clearfix">
    <a href="inbox.php?id=<?= get_session('user_id') ?>&user=<?= $message->id ?>">
        <span class="chat-img pull-left">
            <img src="<?=  $message->avatar ?>" alt="<?= e($message->pseudo) ?>" class="img-circle">
        </span>
        <div class="chat-body clearfix">
            <div class="header_sec">
                <strong class="primary-font"><?=  $message->pseudo ?></strong> <strong class="pull-right"></strong>
            </div>
            <div class="contact_sec">
                <strong class="primary-font"><i class="fa fa-clock-o"></i>  <time class="timeago" datetime="<?= $message->created_at ?>">
                        <?= $message->created_at ?></time></strong> <span class="badge pull-right">3</span>
            </div>
        </div>
    </a>
</li>
