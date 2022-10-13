<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();

$op->select($_SESSION['op_inv_id']);
$det->select($_POST["det_id"]);

$posId=$op->getPosId();
$prodId=$det->getProdId();

if(isset($_POST["det_id"]))
{

  $stock->select($prodId,$posId);
  $qt=$stock->getQuantity() - ($det->getQuantity());

  if($qt<0)
  {
    echo 'Quantité insuffisante en stock ! Qt='.$qt;
  }
  elseif($det->delete($_POST["det_id"]))
  {
    $stock->update_qt($stock->getStockId(),$qt);    
    echo 'Détail appro annulé';
  }
  else
  {
    echo 'Echec opération ';
  }
}
else
{
  echo " pas Id";
}

?>
