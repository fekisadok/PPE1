<?php $title="Inscription"; ?>
<?php include ('partials/_header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Devenez dès à présent membre !</h3>
                    </div>

                    <div class="panel-body">
                        <?php include ('partials/_errors.php'); ?>
                        <form method="post" autocomplete="off" action="" >
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="pseudo">Pseudo</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= get_data('pseudo') ?>" placeholder="Pseudo">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sr-only" for="pseudo">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= get_data('nom') ?>" placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sr-only" for="pseudo">Prenom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= get_data('prenom') ?>" placeholder="Prenom">
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= get_data('email') ?>" placeholder="Email">
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="confirm_email">Confirm Email address</label>
                                <input type="email" class="form-control" id="confirm_email" value="<?= get_data('confirm_email') ?>" name="confirm_email" placeholder="Confirmation email">
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmation mot de passe">
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="date" >Date de naissance</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?= get_data('date_naissance') ?>" placeholder="aaaa-mm-jj">
                            </div>
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio">
                                    <input id="radio1" name="civilite" type="radio" class="custom-control-input" value="H">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Homme</span>
                                </label>
                            </div>
                                    <div class="col-md-3">
                                        <label class="custom-control custom-radio">
                                    <input id="radio2" name="civilite" type="radio" class="custom-control-input" value="F">
                                            <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Femme</span>
                                </label>
                            </div>

<!--                            <button type="submit" class="btn btn-default">S'inscrire</button>-->
                            <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="S'inscrire" name="inscription">
                            </div>
                        </form>

                    </div>
                </div>



            </div>
<!--            <div class="col-md-4">-->
<!--                <div class="panel panel-default friends">-->
<!--                    <div class="panel-heading">-->
<!--                        <h3 class="panel-title">Mes Amis</h3>-->
<!--                    </div>-->
<!--                    <div class="panel-body">-->
<!--                        <ul>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                            <li><a href="profile.html" class="thumbnail"><img src="img/user.png" alt=""></a></li>-->
<!--                        </ul>-->
<!--                        <div class="clearfix"></div>-->
<!--                        <a class="btn btn-primary" href="#">Tous mes Amis</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                -->
<!--            </div>-->
        </div>
    </div>
</section>

<?php include ('partials/_footer.php') ?>
