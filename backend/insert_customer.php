<?php

@session_start();
require_once '../load_model.php';
$pers = new BeanPersonne();
$cust = new BeanCustomer();
$op = new BeanOperation();

if(isset($_POST['operation']))
{
if($_POST['operation']=="Add")
 {
  if($cust->exist_code($_POST['cust_code']))
  {
    echo 'Le code exist déjà';
  }
 else
 {
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
    }
 }
else if($_POST["operation"] == "Edit")
 {
  $cust->select($_POST['personne_id']);

  if($cust->exist_code($_POST['cust_code']) and $_POST['cust_code']!=$cust->getCustomerCode())
  {
    echo 'Le code exist déjà';
  }
  else
  {
  $pers->setRole('4');
  $pers->setNomComplet($_POST['nom']);
  $pers->setContact($_POST['tel']);
  $pers->setGenre("-");
  $pers->setemail('-');
  $pers->setPersonneId($_POST['personne_id']);
  $pers->updateCurrent();

  echo 'Modification reussie avec succès';
  $cust->update_one($_POST['personne_id'],'personne_id','customer_code',$_POST['cust_code']);
  $cust->update_one($_POST['personne_id'],'personne_id','customer_num',$_POST['cust_num']);
  $cust->update_one($_POST['personne_id'],'personne_id','customer_adr',$_POST['cust_adr']);
  }
}
else if($_POST["operation"] == "Edit_loc")
 {
  $op->update_one($_SESSION['op_loc_id'],'op_id','party_code',$_POST['personne_id']);
  echo 'Mise à jour ok ';
 }
}
else
{
echo "operation existe pas";
}

?>
