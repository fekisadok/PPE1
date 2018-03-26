
<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
              <?php if(is_logged_in()): ?>
              <li >
                  <input type="search" placeholder="Rechercher un utilisateur"
                         id="searchbox" class="form-control">

                  <div id="display-results">

                  </div>
              </li>
              <?php endif;?>
          </ul>
            <ul class="nav navbar-nav navbar-right">
<!--            <li class="--><?//= set_active('index') ?><!--"><a href="members.php?id=--><?//= get_session('user_id')?><!--">Membres</a></li>-->
<!--            <li class="--><?//= set_active('index') ?><!--"><a href="contact.php">Contact</a></li>-->
<!--            <li class="--><?//= set_active('index') ?><!--"><a href="groups.php">Groupes</a></li>-->

              <?php if(is_logged_in()): ?>

              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <img src="<?= get_session('avatar')?>"
                           alt="Image de profil de <?= get_session('pseudo') ?>" class="avatar-xs"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li class="<?= set_active('index') ?>"><a href="index.php?id=<?= get_session('user_id') ?>">Accueil</a></li>
                      <li class="<?= set_active('index') ?>"><a href="profil.php?id=<?= get_session('user_id') ?>">Profil</a></li>
                      <li class="<?= set_active('index') ?>"><a href="photos.php?id=<?= get_session('user_id') ?>">Photos</a></li>
<!--                      <li><a href="#">Something else here</a></li>-->
<!--                      <li role="separator" class="divider"></li>-->
<!--                      <li class="dropdown-header">Nav header</li>-->
<!--                      <li><a href="#">Separated link</a></li>-->
<!--                      <li><a href="#">One more separated link</a></li>-->
                  </ul>
              </li>
                  <li class="<?= $notifications_count > 0 ? 'have_notifs' : '' ?>">
                      <a href="notifications.php?id=<?= get_session('user_id') ?>"><i class="fa fa-bell"></i>
                          <?= $notifications_count > 0 ? "($notifications_count)" : ''; ?>
                      </a>
                  </li>
                  <li  class="<?= $notifications_count > 0 ? 'have_notifs' : '' ?>">
                      <a href="inbox.php?id=<?= get_session('user_id') ?>">
                          <i class="fa fa-comments" aria-hidden="true"></i>
                      </a>
                  </li>
              <?php endif;?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
