<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$op->select($_POST['op_id']);

$status=false; $msg='Opération validée ';
if(isset($_POST["op_id"]))
{
  $op->update_one($_POST["op_id"],'op_id','is_valid',$_SESSION['perso_id']);
  echo $msg;
}
unset($_SESSION['op_vente_id']);
?>
