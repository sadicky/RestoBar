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
    $_SESSION['perso_id']=$personne->getPersonneId();
    
    $_SESSION['pos']=$pos->getPosId();
    $jour->select_open();
    if(!empty($jour->getJourId()))
     $_SESSION['jour']=$jour->getJourId(); 
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
  <div class="col-md-2">
  <img src="img/logo.png" class="m-2" width="70%">
  </div>
  <div class="col-md-10">
  <h1 id="soft_title" style="font-size: 50px; font-weight: bold; color:#ffa500; letter-spacing: 10px;" class="text-center"><i>WHITEWOODS APARTEMENTS</i></h1>
  <p style="letter-spacing: 5px; font-style: italic; text-align: center; font-weight: bold; font-size: 20px;">Hotel ~ Bar ~ Restaurant</p>
  <hr style="border: 5px double #ffa500;">


  <input type="hidden" name="current_jour" id="current_jour" value="<?php if(isset($_SESSION['jour'])) { echo $_SESSION['jour'];}?>" >
  <input type="hidden" name="current_jour" id="crtServ" value="">
</div>
</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
  <a class="navbar-brand" href="logout.php?logout=true"><i class="fa fa-power-off"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php
  if(!isset($_SESSION['jour']))
  {
    ?>
<form class="form-inline" id="frm_open_day">
  <input type="date" name="open_date" id="open_date" value="<?php echo date('Y-m-d'); ?>">
  <button type="submit" class="btn btn-primary btn-sm">Ouvrir</button>
</form>
    <?php
  }
  else
  echo '<span style="font-weight:bold; color:white;">Caissier : '.$personne->getNomComplet().'</span>'; 
  ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="main_menu">
      
    </ul>
  </div>
</nav>
<div class="container-fluid row" style="margin-top:0px;" >
<div class="col-md-12 mt-2" id="page-content" style="font-size: 13px;">

<center><img src="img/brand.jpg" align="center" width="40%" class="rounded"> </center>
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
