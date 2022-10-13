<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$vente=new BeanVente();

$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$m_vente=0;

$det->select($_POST["det_id"]);

$posId=$op->getPosId();
$prodId=$det->getProdId();

if(isset($_POST["det_id"]))
{

  $stock->select($prodId,$posId);
  $qt=$stock->getQuantity() + $det->getQuantity();
  $m_vente=$det->getQuantity()*$det->getAmount();

  if($det->delete($_POST["det_id"]))
  {
    $stock->update_qt($stock->getStockId(),$qt);    
    echo 'Détail vente annulé';

  $m_vente = $vente->getAmount() - $m_vente;
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);
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
