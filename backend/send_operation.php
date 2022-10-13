<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$op->select($_POST['op_id']);

$status=true;
if($op->getIsSend()=='1')
{
$status=false;
}

if(isset($_POST["op_id"]))
{
 $op->update_one($_POST["op_id"],'op_id','is_send',$status);
}

?>
