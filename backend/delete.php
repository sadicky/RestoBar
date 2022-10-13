<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();

if(isset($_POST['op_id']))
{
  $op->select($_POST['op_id']);

  if($op->getOpType()=='Transfert')
  {
  	$op->delete($op->getPartyCode());
  }

  $op->delete($_POST['op_id']);
  echo 'Suppression reussie avec succès ';
}
else
{
echo " pas Id ";
}

?>
