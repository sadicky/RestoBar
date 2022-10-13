<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$prod = new BeanProducts();

$acc=new BeanAccounts();
$vente=new BeanVente();

$msg="xxxxx";

$vente->select($_SESSION['op_vente_id']);
$m_vente=0;
$det_an->select($_POST['det_id']);

$prod->select($det_an->getProdId());
$price=$_POST['price'];
$stk=$det_an->getDet();

  $det->setProdId($det_an->getProdId());
  $det->setQuantity($det_an->getQuantity());
  $det->setAmount($price);
  $det->setDet(true);


  $price_r=$_POST['price'] - $det_an->getAmount();
  if($_POST['price']>$det_an->getAmount())
  {
  $new_price=$det_an->getAmount() - $price_r;
  }
  else
  {
   $new_price=$det_an->getAmount() + (-$price_r);
  }

  if($det->update_op($_POST['det_id']))
  {
  $m_vente=$price_r*$det_an->getQuantity();
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }

echo $msg;
?>
