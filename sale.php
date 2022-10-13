<?php
    //@session_start();
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
    $jour=new BeanJournal();
    $menu=$mn->select_all_menu_type("");

    $user_id = $_SESSION['user_session'];
    $auth_user->select($user_id);
    $personne->select($auth_user->getPersonneId());
    $_SESSION['nom']=$personne->getNomComplet();
    $_SESSION['photo']=$personne->getPhoto();
    $_SESSION['perso_id']=$personne->getPersonneId();
    $_SESSION['cash']=$_SESSION['perso_id'];


    $jour->select_by_state('1',$_SESSION['pos'],$_SESSION['perso_id']);

    $_SESSION['jour']=$jour->getJourId();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Faster Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('include/header_info.php');?>
  <style type="text/css">
    h1,h2,h3,h4,h5{ font-size: 14px; }
  </style>
</head>
<body>

<div class="jumbotron row pt-0 pb-0" style="margin-bottom:0">
  <div class="col-md-2">
  <img src="img/logo.png" class="m-2 img-thumbnail" width="80">
 </div>
  <div class="col-md-5">
  <h1 id="soft_title">BOUCHERIE CHARCUTERIE MODERNE</h1>

  <input type="hidden" name="current_jour" id="current_jour" value="<?php if(isset($_SESSION['jour'])) { echo $_SESSION['jour'];}?>" >
  </div>
  <div class="col-md-3">
    <p >
                    <small><b>Utilisateur : <a href="javascript:void(0)" id="param_con" data-id="<?php echo $_SESSION['perso_id']; ?>"><span id="sess_name"><?php echo $personne->getNomComplet(); ?></span></a></b></small><br/>
                   <small><b>Fonction : <?php echo $auth_user->getTypeUser(); ?></b></small> /
                    <small><b>POS : <?php $personne->select($_SESSION['pos']); echo $personne->getNomComplet(); ?></b></small><br/>
      <!-- <small><span class="badge badge-primary show_ma_balance" style="cursor:pointer" id="0"><i class="fa fa-plus"></i></span> <b>Balance : </i> <span id="ma_balance"><?php
            /*if($_SESSION['level']=='3')
            {
            $balance=$trans->select_bal_jour_admin($_SESSION['jour']);
            }
            else
            {
              $balance=$trans->select_bal_jour($_SESSION['jour']);
            }
            echo number_format($balance,0,'.',',').' BIF';*/
             ?></span></b></small> -->
  </p>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="logout.php?logout=true"><i class="fa fa-power-off"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="main_menu_2">
      <?php include('include/sous-menu_2.php'); ?>
    </ul>

  </div>
</nav>
<div class="container-fluid row" style="margin-top:0px;" >
<!-- <div class="col-md-1 bg-dark text-white" id="left_menu_">
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

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>
<?php include('include/footer_info.php');?>

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
