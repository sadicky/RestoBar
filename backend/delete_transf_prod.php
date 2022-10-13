<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$stock_dest = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();

$sort=new BeanSortieMatp();
$sort->select($_SESSION['op_transf_prod_id']);
$op->select($_SESSION['op_transf_prod_id']);
$det->select($_POST["det_id"]);
$prod->select($det->getProdId());

$m_sort=0;


if(isset($_POST["det_id"]))
{

 if($det->delete($_POST["det_id"]))
 {
 	  $stock->select($det->getProdId(),$op->getPosId());
    $qt=$stock->getQuantity() + $det->getQuantity();

    $stock_dest->select($det->getProdId(),$op->getPartyCode());
    $qt_dest=$stock_dest->getQuantity() - $det->getQuantity();
    $m_sort=$det->getAmount()*$det->getQuantity();

  $m_sort = $sort->getAmount() - $m_sort;
  $sort->setAmount($m_sort);
  $sort->update($_SESSION['op_transf_prod_id']);

        $stock->setOpId($_SESSION['op_transf_prod_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($det->getProdId(),$op->getPosId());

        $stock_dest->setOpId($_SESSION['op_transf_prod_id']);
        $stock_dest->setQuantity($qt_dest);
        $stock_dest->setUpdateDate(date('Y-m-d h:i'));

        $stock_dest->update($det->getProdId(),$op->getPartyCode());

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
