<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$paie=new BeanPaiement();
$vente=new BeanVente();

$output = array();

//$_SESSION['op_id_paie']=$_POST['op_id'];
//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
$output["op_id"]=$_POST['op_id'];
$amount=$paie->select_sum_op($_POST['op_id']);
$vente->select($_POST['op_id']);
$output["mont_du"] = $vente->getAmount() - $amount['paie']-$vente->getRed();
$output["num_vente"] = $vente->getNumVente();
echo json_encode($output);

?>
