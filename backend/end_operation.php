<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$op->select($_POST['op_id']);


$status=false; $msg='Opération terminé ';

if($op->getState()=='0')
{
$status=true; $msg='Opération retablie';
}


if(isset($_POST["op_id"]))
{

 if($op->update_one($_POST["op_id"],'op_id','state',$status))
 {
  echo $msg;
  unset($_SESSION['op_ent_id']);
  unset($_SESSION['op_sort_id']);
  unset($_SESSION['op_vente_id']);
  unset($_SESSION['op_vente_num']);
  unset($_SESSION['ent_num']);
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
