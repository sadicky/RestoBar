<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();

$acc=new BeanAccounts();
$vente=new BeanVente();

$msg="xxxxx";



$vente->select($_SESSION['op_vente_id']);
$m_vente=0;
$det_an->select($_POST['det_id']);

$prod->select($det_an->getProdId());
$price=$det_an->getAmount();
$stk=$det_an->getDet();

$stock->select($det_an->getProdId(),$_SESSION['pos']);

  $qt_stk=$_POST['prod_qt'];
  $det->setProdId($det_an->getProdId());
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($price);
  
  $stock->select($det_an->getProdId(),$_SESSION['pos']);

  $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();
  if($_POST['prod_qt']>$det_an->getQuantity())
  {
   $qt=$stock->getQuantity() - ($qty_r*$prod->getNbEl());
  }
  else
  {
    $qt=$stock->getQuantity() + (-$qty_r*$prod->getNbEl());
  }

if($det->update_opb($_POST['det_id']))
{

  $m_vente=$price*$qty_r;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

  $stock->update_qt($stock->getStockId(),$qt); 

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }

echo $msg;
?>
