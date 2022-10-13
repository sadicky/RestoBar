<?php
@session_start();
require_once '../load_model.php';

$trans = new BeanTransactions();
$acc = new BeanAccounts();
$paie = new BeanPaiement();
$achat = new BeanAchats();
$op = new BeanOperation();


$acc->select_acc_perso($_SESSION['perso_id']);
$trans->select($_POST["trans_id"]);

$bal_pre=$acc->getBalCash();
$bal_post=$acc->getBalCash() + $trans->getAmount();
$mont=$trans->getAmount();
$msg='Paiement annulé ';



if(isset($_POST["trans_id"]))
{
  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);

 if($trans->delete($_POST["trans_id"]))
 {
  echo $msg;
  $acc->update_bal($acc->getaccId());
  $paie->setAmount($mont);
  $paie->update($_POST['trans_id']);

     $achat->select($_SESSION['op_id']);
     $amount=$paie->select_sum_op($_SESSION['op_id']);
     $op->update_one($_SESSION['op_id'],'op_id','is_paid',false);
 }
 else
 {
 	echo 'Echec annulation ';
 }
}



?>
