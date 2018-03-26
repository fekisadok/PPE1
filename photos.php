<?php
session_start();
require ('includes/init.php');
include ('filter/user_filter.php');


if(!empty($_GET['id'])){
    //Recuperer les infos sur l'user en bdd en utilisant son id
    $user = find_user_by_id($_GET['id']);

    if(!$user){
        redirect('index.php');
    } else {
        $q= $db->prepare('SELECT lien, user_id FROM photos WHERE user_id= :user_id');
        $q->execute([
            'user_id'=> $_GET['id']
        ]);

        $photos = $q->fetchAll(PDO::FETCH_OBJ);


    }

} else {
    redirect('photos.php?id='.get_session('user_id'));
}


include('views/photos.view.php');

?>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
</html> -->
