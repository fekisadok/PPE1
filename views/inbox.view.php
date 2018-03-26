
<?php $title="Messages"; ?>
<?php include ('partials/_header_auth.php'); ?>

<script src="https://use.fontawesome.com/45e03a14ce.js"></script>
<div class="main_section">
    <div class="container">
        <div class="chat_container">
            <div class="col-sm-3 chat_sidebar">
                <div class="row">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="  search-query form-control" placeholder="Conversation" />
                            <button class="btn btn-danger" type="button">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown all_conversation">
                        <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-weixin" aria-hidden="true"></i>
                            All Conversations
                            <span class="caret pull-right"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="#"> All Conversation </a>  <ul class="sub_menu_ list-unstyled">
                                    <li><a href="#"> All Conversation </a> </li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <div class="member_list">
                        <ul class="list-unstyled">
                            <?php if(count($messages) !=0): ?>
                                <?php foreach ($messages as $message): ?>
                                    <?php include('partials/_list_messages.php') ?>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Cet utilisateur n'a rien publié pour le moment...</p>
                            <?php endif; ?>

                        </ul>
                    </div></div>
            </div>
            <!--chat_sidebar-->


            <div class="col-sm-9 message_section">
                <div class="row">
                    <div class="new_message_head">
                        <div class="pull-left"><button><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Message</button></div><div class="pull-right"><div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>  Setting
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </div></div>
                    </div>
                    <!--new_message_head-->
                    <?php if (!empty($_GET['user'])) {
                        $_SESSION['user'] = $_GET['user'];
                        $_SESSION['id'] = $_GET['id'];
                        $q = $db->prepare('SELECT pseudo, avatar, nom, prenom FROM users
                                    WHERE id= :user_id');
                        $q->execute([
                            'user_id' => $_GET['user']
                        ]);

                        $users_tchats = $q->fetchAll(PDO::FETCH_OBJ);
                        //              echo $_SESSION['id'];
                    }
                    ?>
                    <div class="chat_area">
                    </div><!--chat_area-->
                    <div class="message_write">
                        <textarea class="form-control" placeholder="Votre message..." id="btn-input"></textarea>
                        <div class="clearfix"></div>
                        <div class="chat_bottom"><a href="#" class="pull-left upload_btn"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                Add Files</a>
                            <button class="pull-right btn btn-success" id="btn-chat" data-id_sender="<?=get_session('user_id') ?>" data-id_receiver="<?=$_GET['user'] ?>">
                                Envoyer</button></div>
                    </div>
                </div>
            </div> <!--message_section-->
        </div>
    </div>
</div>

<?php include ('partials/_footer.php') ?>
