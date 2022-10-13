<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$loc=new BeanLocation();
$chamb=new BeanCHambre();

if(isset($_POST["op_id"]))
{
 $op->update_one($_POST["op_id"],'op_id','state',false);
 $op->update_one($_POST["op_id"],'op_id','is_send',true);

 $chamb->update_one($_POST['chamb_id'],'chamb_id','chamb_etat','1');
 $loc->update_one($_POST['op_id'],'op_id','loc_etat','0');
}
else
{
echo " pas Id";
}
unset($_SESSION['op_loc_id']);
?>


