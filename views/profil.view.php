<?php $title="Profil"; ?>
<?php include ('partials/_header_auth.php'); ?>


<style>
    #newpays, #update{
        display: none;
    }
</style>
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="profile">

                    <h1 class="page-header">Profil de <?= e($user->nom)." ".e($user->prenom)?> ( <?= friends_count() ?> ami<?= friends_count() == 1 ? '' : 's' ?> )</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= $user->avatar ?>"
                                 class="avatar-md" alt="Image de profil de <?= e($user->pseudo) ?>">
                        </div>
                        <div class="col-md-4">
                            <li>
                                <li><strong>Pseudo : </strong><?= e($user->pseudo) ?><br></li>
                                <li><strong>Email : </strong><?= e($user->email)?></li>
                                <li><strong>Ville : </strong><?php if (empty(e($user->ville))){ echo 'Non défini actuellement !';} else { echo e($user->ville);}?></li>
                                <li><strong>Pays : </strong><?php if (empty(e($user->pays))){ echo 'Non défini actuellement ! ';} else { echo e($user->pays);} ?></li>
                                <li><strong>Civilité : </strong><?php if(e($user->civilite)=='H'){ echo 'Homme';
                                    }else{
                                    echo 'Femme';
                                    }  ?></li>
                                <li><strong>Date de naissance : </strong><?= e($user->date_naissance)?></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <?php if (!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')): ?>
                                <?php include ('partials/_relation_link.php'); ?>
                            <?php endif; ?>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (!empty ($_GET['id']) &&  $_GET['id'] === get_session('user_id')){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Poster une publication</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="microposts.php" method="post" >
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Publication ...." name="contenu" required="required"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-default" name="publier" value="Publier">
<!--                                        <div class="pull-right">-->
<!--                                            <div class="btn-toolbar">-->
<!--                                                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i>Text</button>-->
<!--                                                <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i>Image</button>-->
<!--                                                <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i>Video</button>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(count($microposts) !=0): ?>
                                    <?php foreach ($microposts as $micropost): ?>
                                    <?php include('partials/_microposts.php') ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                <p>Cet utilisateur n'a rien publier pour le moment...</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php if (!empty ($_GET['id']) &&  $_GET['id'] === get_session('user_id')){ ?>
                <div class="panel panel-default friends">

                    <div class="panel-heading">
                        <h3 class="panel-title">Modifier mon profil : </h3>
                    </div>

                    <div class="panel-body">
                        <?php include ('partials/_errors.php'); ?>
                        <form method="post" autocomplete="off" action="" >
                            <div class="col-md-12">
                                <div class="form-group">
<!--                                    <label for="pseudo">Modifier votre pseudo : </label>-->
                                    <label class="sr-only" for="new_pseudo">Pseudo</label>
                                    <input type="text" class="form-control" id="new_pseudo" name="new_pseudo"  placeholder="Pseudo">
                                </div>
                            </div>

<!--                            <label for="Ville"> Modifier la ville et/ ou le pays : </label>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sr-only" for="Ville">Ville</label>
                                    <input type="text" class="form-control" id="new_ville" name="new_ville"  placeholder="Ville">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sr-only" for="pays">pays</label>
                                    <input type="text" class="form-control" id="new_pays" name="new_pays"   placeholder="Pays">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Changer mon avatar : </label>
                                    <label class="sr-only" for="email">Avatar</label>
                                    <input type="file" name="avatar" id="avatar" />
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Modifier l'adresse email : </label>
                                <label class="sr-only" for="email">Email address</label>
                                <input type="email" class="form-control" id="new_email" name="new_email"  placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="confirm_email">Confirm Email address</label>
                                <input type="email" class="form-control" id="confirm_new_email"  name="confirm_new_email" placeholder="Confirmation email">
                            </div>
                        </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Modifier le mot de passe : </label>
                                    <label class="sr-only" for="password">Ancien mot de passe</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Ancien mot de passe">
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="new_password">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nouveau mot de passe">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="confirm_new_password">Confirmation mot de passe</label>
                                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Confirmation mot de passe">
                            </div>
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-md-6">
                        <input type="submit" class="btn btn-primary" name="update" value="Mettre à jour !">
                        </div>
                    </div>
                    </form>
                </div>

                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mes Amis</h3>
                    </div>
                    <div class="panel-body">
                            <ul>
                                <?php  include ('friends_list.php') ?>
                                <?php if(count($friends) !=0): ?>
                                    <?php foreach ($friends as $friend): ?>
                                        <li>
                                            <a href="profil.php?id=<?=$friend->id ?>" class="thumbnail">
                                                <img src="<?=  $friend->avatar ? $friend->avatar : get_avatar_url($friend->email, 100) ?>" height="100" alt="<?= $friend->pseudo ?>">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Vous n'avez encore aucun ami...</p>
                                <?php endif; ?>

                            </ul>
                        <div class="clearfix"></div>
<!--                        <a class="btn btn-primary" href="#">Tous mes Amis</a>-->
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php include ('partials/_footer.php') ?>
