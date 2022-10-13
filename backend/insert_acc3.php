<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$acc =new BeanAcc();

$det->select($_POST['det_id']);
$val=$_POST['acc_name'];
$det->update_one($_POST['det_id'],'details_id','date_exp',$val);

/*if(!empty($val))
{
$dr = explode('+', $val);

for ($i=0; $i < count($dr); $i++) { 

if($acc->select_nb_acc($dr[$i])==0 and !empty($dr[$i]))
{
	$acc->setAccName($dr[$i]);
	$acc->insert();
}
}
}*/
?>
