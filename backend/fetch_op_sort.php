<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$pers = new BeanPersonne();
$sort= new BeanSortieMatp();

$op->select($_POST['op_id']);
$_SESSION['op_id']=$_POST['op_id'];
$sort->select($_POST['op_id']);
//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
$nb_op=$op->select_num('Production');
$_SESSION['sort_num']=$sort->getNumSort();

$output = array();
$output["motif"]=$sort->getMotif();
$output["type_sort"]=$sort->getTypeSort();
$output["date_sort"]=$op->getCreateDate();
$output["op_id"]=$_POST['op_id'];

$pers->select($op->getPartyCode());
$output["dest_pos"]=$pers->getNomComplet();

echo json_encode($output);
?>
