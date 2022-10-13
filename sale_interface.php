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
    $jour=new BeanJournal();
    $paie=new BeanPaiement();
    $menu=$mn->select_all_menu_type("");
    $per=new BeanPeriode();
    $pos=new BeanPos();

    $pos->select_status('Oui');

    $per->select_crt('1');
    $_SESSION['periode']=$per->getIdPer();

    $user_id = $_SESSION['user_session'];
    $auth_user->select($user_id);
    $personne->select($auth_user->getPersonneId());

    $_SESSION['nom']=$personne->getNomComplet();
    $_SESSION['photo']=$personne->getPhoto();
    $_SESSION['serveur']=$personne->getPersonneId();
    
    $_SESSION['pos']=$pos->getPosId();

   
     $jour->select_open();
     if(!empty($jour->getJourId()))
     {
     $_SESSION['jour']=$jour->getJourId();
      }
     $_SESSION['perso_id']=$jour->getPersonneId();
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>RahisiSoft Manager 2.0</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include('include/header_info.php');?>
  <style type="text/css">
    h1,h2,h3,h4,h5{ font-size: 14px; }
  </style>
</head>
<body>

<div class="jumbotron pt-0 pb-0  text-dark" style="margin-bottom:0">
  <div class="row">
  <div class="col-md-12">
  <h1 id="soft_title" style="font-size: 20px; font-weight: bold; color:#ffa500; letter-spacing: 10px;" class="text-center"><i>WHITEWOODS APARTEMENTS</i></h1>
  <p style="letter-spacing: 5px; font-style: italic; text-align: center; font-weight: bold; font-size: 20px;">
     <a class="navbar-brand" href="logout.php?logout=true"><i class="fa fa-power-off"></i></a>
     Serveur : <?php echo $personne->getNomComplet(); ?>
  </p>
  <hr style="border: 5px double #ffa500;">
  <input type="hidden" name="current_jour" id="current_jour" value="<?php if(isset($_SESSION['jour'])) { echo $_SESSION['jour'];}?>" >
  <input type="hidden" name="crtServ" id="crtServ" value="<?php if(isset($_SESSION['serveur'])) { echo $_SESSION['serveur'];}?>" >
</div>
</div>
</div>

<div class="container-fluid row" style="margin-top:0px;" >
<div class="col-md-12 mt-2" id="page-content" style="font-size: 13px;">

</div>
</div>

<div class="jumbotron text-center text-white" style="margin-bottom:0; background-color:orange; ">
  <div class="row">
  <div class="col-md-5"><p>Copyright 2019 <b><span>Mulfam</span><span>Company</span></b> /Developped by Yaredi M. Tél: (+257) 79 756 874</p></div>
  <div class="col-md-5">
    
    <p>Utilisateur : <span id="sess_name"><?php echo $personne->getNomComplet(); ?></span></p>
          <p>Fonction : <?php echo $auth_user->getTypeUser(); ?> / Poste de travail : <?php $pos->select($_SESSION['pos']); echo $pos->getPosName(); ?></p>
   
  </div>
</div>
</div>
<?php include('include/footer_info.php');?>
<script>
$(function() {
load_frm_new_sale();
})
</script>
    <script src="assets/js/script_config.js"></script>
    <script src="assets/js/script_rapport.js"></script>
    <script src="assets/js/script_statistic.js"></script>
    <script src="assets/js/script_shortcutkey.js"></script>
    <!-- correct -->
    <script src="assets/js/js_article.js"></script>
    <script src="assets/js/js_stock.js"></script>
    <script src="assets/js/js_treso.js"></script>
    <script src="assets/js/js_vente.js"></script>
    <script src="assets/js/js_config.js"></script>
    <script src="assets/js/js_location.js"></script>
    
</body>
</html>
