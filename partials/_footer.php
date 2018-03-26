<footer>
    <div class="container">
    </div>
</footer>
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="librairies/uploadify/jquery.uploadify.min.js"></script>
<script src="librairies/alertifyjs/alertify.min.js"></script>

<script src="js/bootstrap.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script src="libraries/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".timeago").livequery(function () {
            jQuery(this).timeago();

            $("a.like").on("click", function(e){
                e.preventDefault();

                var id = $(this).attr("id");
                var url = 'ajax/micropost_like.php';
                var action = $(this).data('action');
                var micropost_id = id.split("like")[1];
                var data = 'micropost-id='+ micropost_id + '&action=' +action;

                $.ajax({
                    type:'POST',
                    url:url,
                    data : {
                        micropost_id : micropost_id,
                        action: action
                    },
                    success: function(likers){
                        $("#likers_" + micropost_id).html(likers);
                        if (action == 'like'){
                            $("#" +id).html("Je n'aime plus").data('action', 'unlike');
                        }else{
                            $("#" +id).html("J'aime").data('action', 'like');
                        }
                    }
                });
            });
        });
    });
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#avatar').uploadify({
            'fileObjName' : 'avatar',
            'fileTypeDesc' : 'Images Files',
            'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
            'buttonText' : 'Parcourir...',
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                'user_id'   : "<?= get_session('user_id') ?>",
                '<?php echo session_name();?>' : '<?php echo session_id();?>'
            },
        'swf'      : 'librairies/uploadify/uploadify.swf',
        'uploader' : 'librairies/uploadify/uploadify.php',
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alertify.error('Erreur lors du téléchargement du fichier, veuillez réessayer.');
            },
            'onUploadSuccess' : function(file, data, response) {
                alertify.success('Votre avatar a été uploader avec succes !');
                window.location = '/2eme_Annee/bootstrap-social-network-template-master/bootstrap-social-network-template-master/profil.php';
//                window.location = '/test/profil.php';
            }


            // Put your options here
        });
    });
</script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#photos').uploadify({
            'fileObjName' : 'photos',
            'fileTypeDesc' : 'Images Files',
            'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
            'buttonText' : ' Ajouter ...',
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                'user_id'   : "<?= get_session('user_id') ?>",
                '<?php echo session_name();?>' : '<?php echo session_id();?>'
            },
            'swf'      : 'librairies/uploadify/uploadify.swf',
            'uploader' : 'librairies/uploadify/uploadify.photos.php',
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alertify.error('Erreur lors du téléchargement du fichier, veuillez réessayer.');
            },
            'onUploadSuccess' : function(file, data, response) {
                alertify.success('Votre avatar a été uploader avec succes !');
                window.location = '/2eme_Annee/bootstrap-social-network-template-master/bootstrap-social-network-template-master/photos.php';
//                window.location = '/test/photos.php';
            }


            // Put your options here
        });
    });
</script>
<script>
    setInterval('users_online()', 500);
    function users_online(){
        $('#online').load('users_online.php');
    }
</script>

<script>

</script>
<script src="js/ekko-lightbox.js"></script>
<script>
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
    $(function () {
        $('[data-hover="tooltip"]').tooltip()
    })
</script>


</body>
</html>
