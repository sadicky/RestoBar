<?php
@session_start();
require_once '../load_model.php';

$trans = new BeanTransactions();
$paie = new BeanPaiement();
$op = new BeanOperation();
$coup=new BeanCoupon();

$trans->select($_POST["trans_id"]);

$balance=$trans->select_balance($trans->getIdBq());
$bal_post=$balance;

$msg='Annulation réussie avec succes ';

if($bal_post<0)
{
  $msg ='Suppression impossible il y a pas assez de provision, Balance :'.$balance;
}
else
{ 

  $trans->delete($_POST["trans_id"]);
  $op->update_one($trans->getOpId(),'op_id','is_paid','0');
  $op->update_one($trans->getOpId(),'op_id','is_send','0');
}
$coup->update_one($trans->getOpId(),'op_id','is_paid','0');
echo $msg;
?>
