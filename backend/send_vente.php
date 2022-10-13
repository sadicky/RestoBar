<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();

if(isset($_POST["operation_id"]))
{
 $op->update_one($_POST["operation_id"],'op_id','is_send',true);
}
else
{
echo " pas Id";
}
unset($_SESSION['op_vente_id']);
?>
