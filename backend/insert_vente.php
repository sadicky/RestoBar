<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$prod = new BeanProducts();
$cat = new BeanCategory();
$op=new BeanOperation();
$perso=new BeanPersonne();

$vente=new BeanVente();

$msg="xxxxx";

$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$m_vente=0;
$op->select($_POST['op_vente_id']);

$price=$_POST['prod_prix'];
$nb=$prod->select_exist_name($_POST['prod']);

$prod_id=$_POST['prod_id'];
$prod->select($prod_id);

if(empty($_POST['cust_id']))
{
  $perso->setRole('4');
  $perso->setNomComplet($_POST['cli_name']);
  $perso->setContact($_POST['tel_cli']);
  $perso->setEmail($_POST['email_cli']);
  $cli_id=$perso->insert();
}
else
{
  $cli_id=$_POST['cust_id'];
}

$op->select($_POST['op_vente_id']);

  $prod->select($prod_id);
  
 
  $det->setProdId($prod_id);
  $det->setOpId($_SESSION['op_vente_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($price);
  $det->setDet(true);
  $det->setLot($_POST['lot']);
  $det->setDateExp('-');
//lot


if(empty($prod_id))
{
    $msg='Selectionnez un produit';
}
else
{
  $last=$det->insert();
     
  $msg=' Enregistrement reussi';
  $m_vente=$price*$_POST['prod_qt'];

  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

$op->update_one($_SESSION["op_vente_id"],'op_id','party_code',$cli_id);
$op->update_one($_SESSION["op_vente_id"],'op_id','create_date',$_POST['date_v']);
$_SESSION['cli_id']=$cli_id;

   
}

echo $msg;

?>
