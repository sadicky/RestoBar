<?php
@session_start();
require_once '../load_model.php';

$trans = new BeanTransactions();
$acc = new BeanAccounts();
$op = new BeanOperation();



$trans->select($_POST["trans_id"]);
$acc->select($trans->getAccId());

$bal_pre=$acc->getBalCash();
$bal_post=$acc->getBalCash() + $trans->getAmount();
$mont=$trans->getAmount();
$msg='Paiement annulé ';

if($bal_post<0)
{
  $msg ='Suppression impossible il y a pas assez de provision ';
}
elseif(isset($_POST["trans_id"]))
{
  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);

 if($trans->delete($_POST["trans_id"]))
 {

  $acc->update_bal($acc->getaccId());
 }
 else
 {
  $msg='Echec annulation ';
 }
}
echo $msg;


?>
