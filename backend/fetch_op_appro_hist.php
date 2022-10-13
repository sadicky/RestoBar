<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$achat =new BeanAchats();

$op->select($_POST['op_id']);
$_SESSION['op_appro_hist_id']=$_POST['op_id'];
$achat->select($_POST['op_id']);
//$nb_op=$op->select_num('Approvisionnement');
$_SESSION['op_appro_hist_num']=$achat->getNumAchat();
?>
