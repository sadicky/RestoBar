<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$sort=new BeanSortie();

$op->select($_SESSION['op_sort_id']);
$sort->select($_SESSION['op_sort_id']);
$m_sort=0;

$det->select($_POST["det_id"]);

$posId=$op->getPosId();
$prodId=$det->getProdId();
$dateExp=$det->getDateExp();

if(isset($_POST["det_id"]))
{

  $stock->select($prodId,$posId);
  $qt=$stock->getQuantity() + $det->getQuantity();
  $m_sort=$det->getQuantity()*$det->getAmount();

  if($det->delete($_POST["det_id"]))
  {
    $stock->update_qt($stock->getStockId(),$qt);    
    echo 'Détail sort annulé';

  $m_sort = $sort->getAmount() - $m_sort;
  $sort->setAmount($m_sort);
  $sort->update_2($_SESSION['op_sort_id']);
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
