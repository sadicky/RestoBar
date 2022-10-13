<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();

$entre=new BeanEntreProdf();
$entre->select($_SESSION['op_entre_pf_id']);
$det->select($_POST["det_id"]);
$prod->select($det->getProdId());

$m_entre=0;

if(isset($_POST["det_id"]))
{

 if($det->delete($_POST["det_id"]))
 {
 	  $stock->select($det->getProdId(),$_SESSION['pos']);
    $qt=$stock->getQuantity() - $det->getQuantity();


    $m_entre=$det->getAmount()*$det->getQuantity();


  $m_entre = $entre->getAmount() - $m_entre;
  $entre->setAmount($m_entre);
  $entre->update($_SESSION['op_entre_pf_id']);

        $stock->setOpId($_SESSION['op_entre_pf_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($det->getProdId(),$_SESSION['pos']);

  echo 'Détail Sortie annulé';
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
