<?php
    //@session_start();
    require_once("session.php");
    require_once("load_model.php");
    $auth_user = new BeanUsers();
    $personne = new BeanPersonne();
    $op = new BeanOperation();
    $pos = new BeanPersonne();
    $acc = new BeanAccounts();
    $mn= new BeanMenu();
    $jour=new BeanJournal();
    $menu=$mn->select_all_menu_type("");

    $user_id = $_SESSION['user_session'];
    $auth_user->select($user_id);
    $personne->select($auth_user->getPersonneId());
    $_SESSION['nom']=$personne->getNomComplet();
    $_SESSION['photo']=$personne->getPhoto();
    $_SESSION['perso_id']=$personne->getPersonneId();


    $acc->select_acc_perso($_SESSION['perso_id']);
    //$auth_user->select_cash($_SESSION['pos'],'1');
    $_SESSION['cash']=$_SESSION['perso_id'];

    if(isset($_GET['jour']))
    {
        if($_GET['jour']=='new')
        {
            $jour->setPersonneId($_SESSION['perso_id']);
            $jour->setStartDate(date('Y-m-d h:i:s'));

            if(!$jour->exist_current_state('1'))
            {
            $_SESSION['jour']=$jour->insert();
            }
        }
        else if($_GET['jour']=='end')
        {
            if($op->exist_open_op())
            {
                echo '<script>alert("Fermer d\'abord toutes les opérarions encours")</script>';
                $jour->select_by_state('1');
                $_SESSION['jour']=$jour->getJourId();
            }
            else
            {
            $jour->setJourState(false);
            $jour->setEndDate(date('Y-m-d h:i:s'));
            $jour->update($_SESSION['perso_id'],'1');
            unset($_SESSION['jour']);
            }
        }
    }
    else
    {
        $jour->select_by_state('1');
        $_SESSION['jour']=$jour->getJourId();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Gestion de Carrière</title>
<?php include('include/header_script.php');?>


</head>

<body class="animsition">
    <div class="page-wrapper">


        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block bg-light">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar" style="padding:10px;" >
                    <input type="hidden" id="sess_name" name="sess_name" value="<?php echo $_SESSION['nom'];?>">
                        <aside class="profile-nav alt">
                            <section class="card">
   <div class="card-header user-header alt bg-dark">
    <div class="media">
       <a href="#">
        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/icon/COCO.png">
        </a>
           <div class="media-body">
                <h2 class="text-light display-6">Easy Pos</h2>
                <p></p>
            </div>
    </div>
    </div>

        <?php
        if(isset($_SESSION['jour']))
        {
        include('include/menu.php');
        }
        ?>

    </section>
</aside>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h3>Pos : <?php $pos->select($_SESSION
                    ['pos']); echo $pos->getNomComplet();?></h3>
                    <span class="card p-2 m-2 bg-primary text-white">
                            <?php
                    if(!isset($_SESSION['jour']))
                    {
                            ?>
                    <small>Nouveau Journal :
                        <a href="?jour=new" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a></small>
                    <?php
                        }
                        else
                        {

                          ?>
                        <small>Journal courant Depuis : <?php echo $jour->getStartDate(); ?>
                        <a href="?jour=end" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></small>
                    <?php
                        }
                    ?>
                    </span>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <a class="btn btn-danger" href="logout.php?logout=true"><i class="zmdi zmdi-power"></i></a>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content bg-light pl-0">
                <div class="card bg-dark">
                <div class="row ml-2 bg-dark p-2" id="main_menu">

                </div>
                </div>
                <hr>
                <div class="section__content section__content--p30 bg-white p-0">
                    <div class="container-fluid bg-white p-0">
                        <div id="page-content" class="bg-white p-0">

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

<?php include('include/footer_script.php');?>

    <script src="assets/js/script_config.js"></script>
    <script src="assets/js/script_appro.js"></script>
    <script src="assets/js/script_sort_mp.js"></script>
    <!-- <script src="assets/js/script_sort.js"></script> -->
    <script src="assets/js/script_entre.js"></script>
    <script src="assets/js/script_trans.js"></script>
    <script src="assets/js/script_vente.js"></script>
    <script src="assets/js/script_rapport.js"></script>
</body>

</html>
<!-- end document-->
