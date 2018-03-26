
<?php $title="Accueil"; ?>
<?php include ('partials/_header_auth.php'); ?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Fil d'actualité</h3>
              </div>
              <div class="panel-body">
                <form action="microposts_index.php" method="post" >
                  <div class="form-group">
                      <textarea class="form-control" placeholder="Publication ...." name="contenu" required="required"></textarea>
                  </div>
                    <input type="submit" class="btn btn-default" name="publier" value="Publier">
<!--                  <div class="pull-right">-->
<!--                    <div class="btn-toolbar">-->
<!--                      <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i>Text</button>-->
<!--                      <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i>Image</button>-->
<!--                      <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i>Video</button>-->
<!--                    </div>-->
<!--                  </div>-->
                </form>
              </div>
            </div>
              <?php if(count($microposts) !=0): ?>
                  <?php foreach ($microposts as $micropost): ?>
                      <?php include('partials/_microposts_wall.php') ?>
                  <?php endforeach; ?>
              <?php else : ?>
                  <p>Cet utilisateur n'a rien publié pour le moment...</p>
              <?php endif; ?>

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
<!--                <a class="btn btn-primary" href="#">Tous mes Amis</a>-->
              </div>
            </div>
<!--            <div class="panel panel-default groups">-->
<!--              <div class="panel-heading">-->
<!--                <h3 class="panel-title">Latest Groups</h3>-->
<!--              </div>-->
<!--              <div class="panel-body">-->
<!--                <div class="group-item">-->
<!--                  <img src="img/group.png" alt="">-->
<!--                  <h4><a href="#" class="">Sample Group One</a></h4>-->
<!---->
<!--                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
<!--                <div class="group-item">-->
<!--                  <img src="img/group.png" alt="">-->
<!--                  <h4><a href="#" class="">Sample Group Two</a></h4>-->
<!--                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
<!--                <div class="group-item">-->
<!--                  <img src="img/group.png" alt="">-->
<!--                  <h4><a href="#" class="">Sample Group Three</a></h4>-->
<!--                  <p>This is a paragraph of intro text, or whatever I want to call it.</p>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
<!--                <a href="#" class="btn btn-primary">View All Groups</a>-->
<!--              </div>-->
<!--            </div>-->
          </div>
        </div>  <?php if (!empty($_GET['user'])){
              $_SESSION['user']= $_GET['user'];
              $_SESSION['id']= $_GET['id'];
              $q= $db->prepare('SELECT pseudo, avatar, nom, prenom FROM users
                                    WHERE id= :user_id');
              $q->execute([
                      'user_id'=> $_GET['user']
              ]);

              $users_tchats= $q->fetchAll(PDO::FETCH_OBJ);
//              echo $_SESSION['id'];
           ?>
          <div id="chat" style="position:fixed;">
              <?php foreach ($users_tchats as $user_tchat) { ?>
          <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left: 850px;" >

              <div class="col-xs-12 col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-heading top-bar">
                          <div class="col-md-8 col-xs-8">
                              <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span><?= ' '.$user_tchat->nom.' '.$user_tchat->prenom ?></h3>
                          </div>
                          <div class="col-md-4 col-xs-4" style="text-align: right;">
                              <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                              <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                          </div>
                      </div>
                      <div class="panel-body msg_container_base" id="content_msg" onfocus="blnScroll=false;" onblur="blnScroll=true;" >
                          <i class="fa fa-spinner fa-pulse fa-5x fa-fw" style="margin-top:40px; margin-left:70px;"></i>
                          <h4 style="text-align: center;">Chargement en cours...</h4>
                          <span class="sr-only">Loading...</span>
                      </div>
                      <div class="panel-footer">
                          <div class="input-group">
                              <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Votre message ..." />
                              <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" data-id_sender="<?=get_session('user_id') ?>" data-id_receiver="<?=$_GET['user'] ?>" >Envoyer</button>
                        </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
              <?php }} ?>
          </div>
          <div class="btn-group dropup">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span style="color:green; font-weight:bold;"><i class="fa fa-users" aria-hidden="true"></i>Amis en ligne</span>
                  <span class="sr-only">Amis en ligne</span>
              </button>
              <ul class="dropdown-menu" role="menu">
<!--                  <li><a href="#" id="new_chat"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>-->
<!--                  <li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>-->
<!--                  <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>-->
<!--                  <li class="divider"></li>-->
                  <li>
                      <div id="online">

                      </div>
                  </li>
              </ul>
          </div>
      </div>
    </section>

<?php include ('partials/_footer.php') ?>


