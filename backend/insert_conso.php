<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();


$prod->select($_POST['prod_id']);
$idPer=$_SESSION['periode'];
$posId=$_SESSION['pos'];

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_loc_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet('0');
    $det->setLot('-');
    $det->setDateExp('-');

    /*$stock->select($prodId,$posId);
    $qt_stk=$stock->getQuantity() - $qt;

    if($qt_stk<0 and $prod->getIsStock()=='Oui')
    {
    echo 'Quantité insuffisante en stock ';
    }
    else
    {*/
    $det->insert(); 

    /*$stock->select($prodId,$posId);
    $qt_stk=$stock->getQuantity() - $qt;
    $stock->update_qt($stock->getStockId(),$qt_stk);*/
    echo ' Enregistrement reussi ';
    //}

  }
  if($_POST["operation"] == "Edit")
  {
    $det_an->select($_POST["det_id"]);
    
    $det->setProdId($prodId);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDateExp('-');

    /*$stock->select($prodId,$posId);

    $qty_r=$qt - $det_an->getQuantity();

    if($qt>$det_an->getQuantity())
    {
      $qt_stk=$stock->getQuantity() - $qty_r;
    }
    else
    {
      $qt_stk=$stock->getQuantity() + (-$qty_r);
    }

    if($qt_stk<0)
    {
      echo 'Quantité insuffisante en stock !';
    }
    else*/if($det->update($_POST["det_id"]))
    {
      
      //$stock->update_qt($stock->getStockId(),$qt_stk);
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
