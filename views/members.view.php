<?php $title="Membres"; ?>
<?php include ('partials/_header_auth.php'); ?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="members">
              <h1 class="page-header">Members</h1>
                <?php foreach ($users as $user): ?>
              <div class="row member-row">

                <div class="col-md-3">
                    <img src="<?=$user->avatar ? $user->avatar : get_avatar_url($user->email, 70)?>" alt="Image de profil de <?=e($user->pseudo)?>" class="avatar-md">


                        <div class="text-center">
                   <?=e($user->pseudo)?>

                  </div>
                </div>

                <div class="col-md-3">
                  <p><a href="#" class="btn btn-success btn-block"><i class="fa fa-users"></i> Ajouter en ami</a></p>
                </div>
                <div class="col-md-3">
                  <p><a href="index.auth.php?id=<?= get_session('user_id') ?>&user=<?= $user->id ?>" class="btn btn-default btn-block"><i class="fa fa-envelope"></i> Envoyer un message </a></p>
                </div>
                <div class="col-md-3">
                  <p><a href="profil.php?id=<?= $user->id ?>" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Voir profil</a></p>
                </div>
              </div>
                <?php endforeach; ?>
                <div id="pagination"><?=$pagination ?></div>

            </div>
          </div>
          <div class="col-md-4">
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
                                          <img src="<?=  $friend->avatar ?>" height="100" alt="<?= $friend->pseudo ?>">
                                      </a>
                                  </li>
                              <?php endforeach; ?>
                          <?php else : ?>
                              <p>Vous n'avez encore aucun ami...</p>
                          <?php endif; ?>

                      </ul>
                      <div class="clearfix"></div>
                      <a class="btn btn-primary" href="#">Tous mes Amis</a>
                  </div>
              </div>
            <div class="panel panel-default groups">
              <div class="panel-heading">
                <h3 class="panel-title">Latest Groups</h3>
              </div>
              <div class="panel-body">
                <div class="group-item">
                  <img src="../img/group.png" alt="">
                  <h4><a href="#" class="">Sample Group One</a></h4>
                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                </div>
                <div class="clearfix"></div>
                <div class="group-item">
                  <img src="../img/group.png" alt="">
                  <h4><a href="#" class="">Sample Group Two</a></h4>
                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                </div>
                <div class="clearfix"></div>
                <div class="group-item">
                  <img src="../img/group.png" alt="">
                  <h4><a href="#" class="">Sample Group Three</a></h4>
                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                </div>
                <div class="clearfix"></div>
                <a href="#" class="btn btn-primary">View All Groups</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <p>Dobble Copyright &copy, 2015</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>
