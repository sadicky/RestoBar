<?php

@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$store=new BeanPos();

$op->select($_SESSION['op_inv_id']);
$posId=$op->getPosId();
$prodId=$_POST['prod_id'];

$prod->select($_POST['prod_id']);
$qt=$_POST['qt'];
$price=$_POST['price'];

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {

    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_inv_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet(true);
    $det->setLot("-");
    $det->setDateExp('-');

    $det->insert(); 
    
    if(!$stock->existstock($prodId,$posId))
    {
      $stock->setProdId($prodId);
      $stock->setQuantity($qt);
      $stock->setPosId($posId);
      $stock->insert();

    }
    else
    {
      $stock->select($prodId,$posId);
      $qt_stk=$stock->getQuantity() + $qt;
      $stock->update_qt($stock->getStockId(),$qt_stk);
    }

    echo ' Enregistrement reussi ';

  }
  if($_POST["operation"] == "Edit")
  {

    $det->setProdId($prodId);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDateExp('-');


    $stock->select($prodId,$posId);
    $det_an->select($_POST["det_id"]);

    $qty_r=$qt - $det_an->getQuantity();
    $qt_stk=$stock->getQuantity() + $qty_r;

    if($qt_stk<0)
    {
      echo 'Quantité insuffisante en stock !';
    }
    elseif($det->update($_POST["det_id"]))
    {
      $stock->update_qt($stock->getStockId(),$qt_stk);
      echo ' Modification reussie ';
    }
    else
    {
      echo 'Echec Modification';
    }
  }
}
else
{
  echo "operation existe pas";
}

?>
