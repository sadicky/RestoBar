<?php

session_start();
require_once '../load_model.php';
$pers = new BeanPersonne();
$cust = new BeanCustomer();
$op=new BeanOperation();

$custId=$_POST['cust_id'];

/*if(!empty($_POST['content_lib_cust']) and empty($custId))
{
  $custCode=$pers->select_code('Customer');
  $pers->setRole('4');
  $pers->setNomComplet($_POST['content_lib_cust']);
  $pers->setContact($_POST['tel']);
  $pers->setEmail('-');
  $pers->setGenre('-');
  $last=$pers->insert();
  
  $cust->update_one($last,'personne_id','customer_code',$custCode);
  $cust->update_one($last,'personne_id','customer_num',$_POST['cust_num']);
  $cust->update_one($last,'personne_id','customer_adr',$_POST['cust_adr']);

  $op->update_one($_POST['op_id'],'op_id','party_code',$last);

  echo 'Yes';
}
else
{*/
  /*$cust->select($_POST['cust_id']);

  if($cust->exist_code($_POST['cust_code']) and $_POST['cust_code']!=$cust->getCustomerCode())
  {
    echo 'Le code exist déjà';
  }
  else
  {
  $pers->setRole('4');
  $pers->setNomComplet($_POST['content_lib_cust']);
  $pers->setContact($_POST['tel']);
  $pers->setGenre("-");
  $pers->setemail("-");
  $pers->setPersonneId($_POST['personne_id']);
  $pers->updateCurrent();

  //echo 'Modification reussie avec succès';
  $cust->update_one($_POST['personne_id'],'personne_id','customer_code',$_POST['cust_code']);
  $cust->update_one($_POST['personne_id'],'personne_id','customer_num',$_POST['cust_num']);
  $cust->update_one($_POST['personne_id'],'personne_id','customer_adr',$_POST['cust_adr']);
*/
  $op->update_one($_POST['op_id'],'op_id','party_code',$_POST['cust_id']);
  echo $_POST['cust_id'].'-'.$_POST['op_id'];

  /*echo $_POST['op_id'];
  }*/
//}
?>
