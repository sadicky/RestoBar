<?php
    //@session_start();
    require_once("session.php");
    require_once("load_model.php");
    $auth_user = new BeanUsers();
    $personne = new BeanPersonne();
    $pos = new BeanPersonne();
    $acc = new BeanAccounts();

    $user_id = $_SESSION['user_session'];
    $auth_user->select($user_id);
    $personne->select($auth_user->getPersonneId());
    $_SESSION['nom']=$personne->getNomComplet();
    $_SESSION['photo']=$personne->getPhoto();
    $_SESSION['perso_id']=$personne->getPersonneId();


    $acc->select_acc_perso($_SESSION['perso_id']);
    $auth_user->select_cash($_SESSION['pos'],'1');
    $_SESSION['cash']=$_SESSION['perso_id'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Material Admin by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <?php
    include('include/header_script.php');
    ?>
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Easy</span><strong>RestoBar</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                <!-- Notifications-->
                <!-- <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item">
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                  </ul>
                </li> -->


                <!-- Logout    -->
                <li class="nav-item"><a href="logout.php?logout=true" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <?php include('include/main_menu.php'); ?>

        <div class="content-inner bg-white">
          <!-- Page Header-->
         <!--  <header class="page-header">
            <div class="container-fluid"> -->
              <!-- <h2 class="no-margin-bottom">Dashboard</h2> -->
              <?php /*$pos->select($_SESSION['pos']);*/ ?>
              <h2><!-- Point de vente :  --><?php /*echo $pos->getNomComplet();*/ ?></h2>
            <!-- </div>
          </header> -->
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts bg-white">
            <div id="entete_rap" style="display: none;"></div>

            <div class="container-fluid bg-white" id="page-content">

            </div>
          </section>

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Your company &copy; 2017-2019</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p><?php include("include/footer_page.php");?></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <?php include('include/footer_script.php'); ?>
    <script src="assets/js/script_config.js"></script>
    <script src="assets/js/script_appro.js"></script>
    <script src="assets/js/script_sort.js"></script>
    <script src="assets/js/script_entre.js"></script>
    <script src="assets/js/script_trans.js"></script>
    <script src="assets/js/script_vente.js"></script>
    <script src="assets/js/script_rapport.js"></script>
  </body>
</html>
