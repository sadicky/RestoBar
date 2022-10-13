<?php

@session_start();
require_once '../load_model.php';
$pers = new BeanPersonne();
$cust = new BeanCustomer();


  $pers->setRole('4');
  $pers->setNomComplet($_POST['nom']);
  $pers->setContact($_POST['tel']);
  $pers->setEmail('-');
  $pers->setGenre('-');
  $last=$pers->insert();
  
  $cust->update_one($last,'personne_id','customer_code',$_POST['cust_code']);
  $cust->update_one($last,'personne_id','customer_num',$_POST['cust_num']);
  $cust->update_one($last,'personne_id','customer_adr',$_POST['cust_adr']);

  echo 'Enregistrement reussi avec succès ';
  $_SESSION['cust_id']=$last;
    
?>
