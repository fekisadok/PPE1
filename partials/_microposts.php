<div class="publication">
<div class="panel panel-default post" id="micropost<?=$micropost->id ?>" >
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <a href="profile.html" class="post-avatar thumbnail">
                    <img src="<?=  $user->avatar ? $user->avatar : get_avatar_url($micropost->email, 100) ?>"
                         alt="<?= e($user->pseudo) ?>" ><div class="text-center"><?= $user->pseudo?></div></a>
                <div class="likes text-center">
                    <div id="likers_<?= $micropost->id?>">
                        <?=display_likers($micropost->id)?>

                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="bubble">
                    <div class="pointer">
                        <p> <i class="fa fa-clock-o"></i>  <time class="timeago" datetime="<?= $micropost->created_at ?>">
                                <?= $micropost->created_at ?></time>
<!--                            data-confirm="Voulez-vous vraiment supprimer cette publication ?"-->
                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?');"

                               href="delete_micropost.php?id=<?= $micropost->id ?>"><i class="fa fa-trash"></i> Supprimer</a>
                            <br> <?= nl2br(replace_links(e($micropost-> contenu))); ?></p>
                    </div>
                    <div class="pointer-border"></div>
                </div>
<!--                <p class="post-actions"><a href="#">Commenter</a> --->
                    <?php if(user_like_micropost($micropost->id)):?>
                        <a id="unlike<?= $micropost->id ?>" class="like" data-action="unlike"  href="unlike_micropost.php?id=<?= $micropost->id ?>">Je n'aime plus</a>
                    <?php else :?>
                        <a id="like<?= $micropost->id ?>" class="like" data-action="like"  href="like_micropost.php?id=<?= $micropost->id ?>">J'aime</a>
                    <?php endif;?>
<!--                    - <a href="#">Suivre</a> - <a href="#">Partager</a></p>-->
                <div class="comment-form">
                    <form class="form-inline" action="commentaire.php?id=<?= $micropost->id ?>&user=<?= $micropost->user_id ?>" method="post">
                        <div class="form-group" >
                            <input type="text" class="form-control" style="width:91%;" placeholder="Laisser un commentaire ..." name="commentaire">
                        </div>
                        <button type="submit" class="btn btn-default" style="margin-left:-45px;" name="comment">Commenter</button>
                    </form>
                </div>
                <div class="clearfix"></div>

                <div class="comments">

                    <?php
                    $q = $db->prepare("SELECT commentaire, C.user_id, C.created_at, U.avatar, U.id, U.email
                                         FROM comment C, users U
                                         WHERE C.user_id = U.id
                                         AND micropost_id = :micropost_id
                                         ORDER BY C.created_at DESC");

                    $q->execute([
                        'micropost_id' => $micropost->id
                    ]);

                    $comments = $q->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php if(count($comments) !=0): ?>
                        <?php foreach ( $comments as $comment): ?>
                            <div class="comment">
                                <a href="profil.php?id=<?= $comment->id?>" class="comment-avatar pull-left"><img src="<?=  $comment->avatar ?>" alt=""></a>
                                <div class="comment-text">
                                    <p><?= nl2br(replace_links(e($comment-> commentaire))); ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Aucun commentaire pour le moment ...</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>