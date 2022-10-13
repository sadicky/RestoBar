<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$achat=new BeanAchats();

$op->select($_SESSION['op_appro_id']);
$achat->select($_SESSION['op_appro_id']);
$m_achat=0;

$det->select($_POST["det_id"]);

$posId=$op->getPosId();
$prodId=$det->getProdId();

if(isset($_POST["det_id"]))
{

  $stock->select($prodId,$posId);
  $qt=$stock->getQuantity() - $det->getQuantity();
  $m_achat=$det->getQuantity()*$det->getAmount();

  if($qt<0)
  {
    echo 'Quantité insuffisante en stock !';
  }
  elseif($det->delete($_POST["det_id"]))
  {
    $stock->update_qt($stock->getStockId(),$qt);    
    echo 'Détail appro annulé';


  $m_achat = $achat->getAmount() - $m_achat;
  $achat->setAmount($m_achat);
  $achat->update($_SESSION['op_appro_id']);
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
