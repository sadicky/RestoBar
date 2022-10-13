<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$detTo = new BeanDetailsOperation();
$stockTo = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$opTo=new BeanOperation();


$op->select($_SESSION['op_chg_id']);
$opTo->select($op->getPartyCode());

$det->select($_POST['det_id']);


$posId=$op->getPosId();
$tarId=$op->getTarId();
$prodId=$det->getProdId();
$dateExp=$det->getDateExp();

$detTo->select_op($opTo->getOpId(),$prodId);
$tarIdTo=$opTo->getTarId();
$posIdTo=$opTo->getPosId();

if(isset($_POST["det_id"]))
{

  $stock->select($prodId,$posId,$tarId);
  $qt=$stock->getQuantity() + $det->getQuantity();

  $stockTo->select($prodId,$posIdTo,$tarIdTo);
  $qtTo=$stockTo->getQuantity() - $detTo->getQuantity();

  if($det->delete($_POST['det_id']) and $detTo->delete_op($opTo->getOpId(),$prodId))
  {
    $stock->update_qt($stock->getStockId(),$qt); 
    $stockTo->update_qt($stockTo->getStockId(),$qtTo);  

    echo 'Détail sort annulé '.$stockTo->getStockId().'-'.$qtTo;
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
