<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$paie=new BeanPaiement();
$achat=new BeanAchats();

$output = array();

//$_SESSION['op_id_paie']=$_POST['op_id'];
//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
$output["op_id"]=$_POST['op_id'];
$amount=$paie->select_sum_op($_POST['op_id']);
$achat->select($_POST['op_id']);
$output["mont_du"] = $achat->getAmount() - $amount['paie'];

echo json_encode($output);

?>
