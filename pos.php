<?php
    require_once("session.php");
    require_once("load_model.php");
    $auth_user = new BeanUsers();
    $personne = new BeanPersonne();
    $op = new BeanOperation();
    $pos = new BeanPersonne();
    $stock = new BeanStock();
    $acc = new BeanAccounts();
    $trans=new BeanTransactions();
    $track=new BeanPayTrack();
    $mn= new BeanMenu();
    //$check=new BeanCheckExp();
    $jour=new BeanJournal();
    $paie=new BeanPaiement();
    $menu=$mn->select_all_menu_type("");
    $per=new BeanPeriode();
    $ray=new BeanPos();

    //$ray->select_actif('1');

    $per->select_crt('1');
    $_SESSION['periode']=$per->getIdPer();
    $user_id = $_SESSION['user_session'];
    $auth_user->select($user_id);
    $personne->select($auth_user->getPersonneId());
    $_SESSION['nom']=$personne->getNomComplet();
    $_SESSION['photo']=$personne->getPhoto();
    $_SESSION['perso_id']=$personne->getPersonneId();
    $_SESSION['cash']=$_SESSION['perso_id'];
    
    //$_SESSION['pos']=$ray->getPersonneId();


    $jour->select_by_state('1',$_SESSION['pos'],$_SESSION['perso_id']);

    $_SESSION['jour']=$jour->getJourId();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Soft Manager 2.0</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('include/header_info.php');?>
  <style type="text/css">
    h1,h2,h3,h4,h5{ font-size: 14px; }
  </style>
</head>
<body>

<div class="jumbotron row pt-0 pb-0 bg-axel  text-dark" style="margin-bottom:0">
  <div class="col-md-2">
  <img src="img/logo.png" class="m-2" width="150">
  </div>
  <div class="col-md-10">
  <h1 id="soft_title" style="font-size: 30px; font-weight: bold; color:#0c5285;" class="text-center"><i>Gestion Hôtellière</i></h1><hr>
  <div class="row">
    <div class="col-md-4 m-2 p-2 text-dark bg-box-axel">
                    <p>Utilisateur : <span id="sess_name"><?php echo $personne->getNomComplet(); ?></span></p>
                    <p>Fonction : <?php echo $auth_user->getTypeUser(); ?> / Poste de travail : <?php $personne->select($_SESSION['pos']); echo $personne->getNomComplet(); ?></p>  


                    </p>
  </div>
  <div class="col-md-7 m-2 p-2 bg-box-axel">
      <span id="display_journal">
                  <p><?php
                    if(!isset($_SESSION['jour'])){
                            ?>
                            Veuillez Ouvrir un Journal
                    <?php
                        }
                        else { ?> Journal ouvert Depuis : <?php echo $jour->getStartDate(); ?>
                        <?php
                        }
                    ?></p>
      </span>
                     <span class="badge badge-primary show_ma_balance" style="cursor:pointer" id="0"><i class="fa fa-plus"></i></span> 

                      Balance :<span id="ma_balance"><?php
            $m_paie=$paie->select_sum_op_bq($_SESSION['jour']);

            $balance=$trans->select_bal_jour_admin($_SESSION['jour']);
            $balance_bq=$trans->select_bal_jour_admin_bq($_SESSION['jour']);

            //$cash=$balance-$m_paie;
            echo number_format($balance+$balance_bq,0,'.',',').' BIF (Cash :'.number_format($balance,0,'.',',').'BIF /Banque : '.number_format($balance_bq,0,'.',',').' BIF)';
             ?></span>
                    
    </div>
    
</div>
</div>
</div>

  <input type="hidden" name="current_jour" id="current_jour" value="<?php if(isset($_SESSION['jour'])) { echo $_SESSION['jour'];}?>" >

<nav class="navbar navbar-expand-lg navbar-dark bg-top-menu border border-success">
  <a class="navbar-brand" href="logout.php?logout=true"><i class="fa fa-power-off"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="main_menu">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->

    </ul>
    <form class="form-inline my-2 my-lg-0" id="frm_search_mat" action="javascript:void(0)" method="POST">
      <button type="button" class="btn btn-sm btn-light mr-2"  id="param_con" data-id="<?php echo $_SESSION['perso_id']; ?>">
          <i class="fa fa-user"></i> <span class="badge badge-light"></span>
      </button>
      <button type="button" class="btn btn-sm btn-light mr-2" id="pay_under_min">
          <i class="fa fa-dollar"></i> <span class="badge badge-light"> <?php echo $track->select_nb_under_min(); ?></span>
      </button>

      <button type="button" class="btn btn-sm btn-light mr-2" id="stk_under_min">
           <i class="fa fa-battery-quarter text-warning" aria-hidden="true"></i> <span class="badge badge-light"><?php
           
            echo $stock->select_nb_under_min($_SESSION['pos']); ?></span>
      </button>

      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Matricule" aria-label="Search" name="search_mat" id="search_mat">
      <button class="btn btn-warning my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
      <a href="javascript:void(0)" id="nvpolice" class="btn btn-success m-1">
                                    <i class="zmdi zmdi-plus"></i></a> -->
    </form>
  </div>
</nav>
<div class="container-fluid row" style="margin-top:0px;" >
<!-- <div class="col-md-1 bg-right-menu text-white" id="left_menu">
  <?php
        //if(isset($_SESSION['jour']))
        //{
        //include('include/menu.php');
        //}
  ?>

</div> -->
<div class="col-md-12 mt-2" id="page-content" style="font-size: 13px;">

</div>
</div>

<div class="jumbotron text-center bg-footer text-white" style="margin-bottom:0">
  <p>Copyright 2019 <b>Mulfam<span class="text-danger">Company</span></b> /Developped by Yaredi M. Tél: (+257) 79 756 874</p>

</div>
<?php include('include/footer_info.php');?>
    <script src="assets/js/script_config.js"></script>
    <script src="assets/js/script_appro.js"></script>
    <script src="assets/js/script_sort_mp.js"></script>
    <script src="assets/js/script_location.js"></script>
    <!-- <script src="assets/js/script_sort.js"></script> -->
    <script src="assets/js/script_entre.js"></script>
    <script src="assets/js/script_trans.js"></script>
    <script src="assets/js/script_vente.js"></script>
    <script src="assets/js/script_rapport.js"></script>
    <script src="assets/js/script_statistic.js"></script>
    <script src="assets/js/script_shortcutkey.js"></script>

    <!-- correct -->
    <script src="assets/js/js_article.js"></script>
</body>
</html>
