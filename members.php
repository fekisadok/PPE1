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
        $req = $db->query("SELECT id FROM USERS WHERE active='0'");

        $nbre_total_users = $req->rowCount();

        $nbre_users_par_page = 2;

        $nbre_pages_max_gauche_et_droite = 4;

        $last_page = ceil($nbre_total_users / $nbre_users_par_page);

        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page_num = $_GET['page'];
        } else {
            $page_num = 1;
        }

        if($page_num < 1){
            $page_num = 1;
        } else if($page_num > $last_page) {
            $page_num = $last_page;
        }

        $limit = 'LIMIT '.($page_num - 1) * $nbre_users_par_page. ',' . $nbre_users_par_page;


        $q=$db->query ("SELECT id, pseudo, email, avatar FROM users WHERE active='0' ORDER BY pseudo $limit");
        $users = $q->fetchAll(PDO::FETCH_OBJ);

        $pagination = '<nav class="text-center"><ul class="pagination">';

        if($last_page != 1){
            if($page_num > 1){
                $previous = $page_num - 1;
                $pagination .= '<li><a href="members.php?page='.$previous.'">Précédent</a></li>';

                for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){
                    if($i > 0){
                        $pagination .= '<li><a href="members.php?page='.$i.'">'.$i.'</a></li>';
                    }
                }
            }

            $pagination .= '<li class="active"><a href="#">'.$page_num.'</a></li>';

            for($i = $page_num+1; $i <= $last_page; $i++){
                $pagination .= '<li><a href="members.php?page='.$i.'">'.$i.'</a></li>';

                if($i >= $page_num + $nbre_pages_max_gauche_et_droite){
                    break;
                }
            }

            if($page_num != $last_page){
                $next = $page_num + 1;
                $pagination .= '<li><a href="members.php?page='.$next.'">Suivant</a></li>';
            }
        }
        $pagination .='</ul></nav>';
    }

} else {
    redirect('index.auth.php?id='.get_session('user_id'));
}



include ("views/members.view.php");
?>