<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$op->select($_POST['op_id']);


$status=false; $msg='Opération terminée ';
unset($_SESSION['op_id']);
if($op->getState()=='0')
{
$status=true; $msg='Opération retablie';
}


if(isset($_POST["op_id"]))
{

 if($op->update_one($_POST["op_id"],'op_id','state',$status))
 {
  echo $msg;
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
