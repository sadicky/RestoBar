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

if(isset($_SESSION['type_stock']))
{
$stk=$_SESSION['type_stock'];
}
else
{
$stk='1';
}

$vente->select($_SESSION['op_vente_id']);
$m_vente=0;
$det_an->select($_POST['det_id']);

$prod->select($det_an->getProdId());
$price=0;

  if($stk=='0')
  {
    $price=$prod->getProdPriceGros();
  }
  else
  {
    $price=$prod->getProdPrice();
  }

$stock->select($det_an->getProdId(),$_SESSION['pos'],$stk);

  $det->setProdId($det_an->getProdId());
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($price);
  if($stk=='1')
  {
  $det->setDet(true);
  }
  else
  {
  $det->setDet(false);
  }

  $stock->select($det_an->getProdId(),$_SESSION['pos'],$stk);

  $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();
  if($_POST['prod_qt']>$det_an->getQuantity())
  {
  $qt=$stock->getQuantity() - $qty_r;
  }
  else
  {
   $qt=$stock->getQuantity() + (-$qty_r);
  }

  if($qt<0)
  {
    $msg= 'Quantité insuffisante en stock';

  }
  elseif($det->update_op($det_an->getProdId(),$_SESSION['op_vente_id'],$stk))
  {

  $m_vente=$price*$qty_r;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

  $stock->setOpId($_SESSION['op_vente_id']);
  $stock->setQuantity($qt);
  $stock->setUpdateDate(date('Y-m-d h:i'));

  $stock->update($det_an->getProdId(),$_SESSION['pos'],$stk);

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }

echo $msg;
?>
