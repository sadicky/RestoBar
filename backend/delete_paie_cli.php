<?php
@session_start();
require_once '../load_model.php';

$trans = new BeanTransactions();
$acc = new BeanAccounts();
$vente = new BeanVente();
$op = new BeanOperation();
$paie=new BeanPaiement();

$acc->select_acc_perso($_SESSION['cash']);
$trans->select($_POST["trans_id"]);

$bal_pre=$acc->getBalCash();
$bal_post=$acc->getBalCash() - $trans->getAmount();
$mont=$trans->getAmount();
$msg='Paiement annulé ';

if($bal_post<0)
{
  $msg ='Suppression impossible il y a pas assez de provision ';
}
elseif(isset($_POST["trans_id"]))
{


  if($bal_post<0)
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$acc->getBalCash();
  }
  else
  {
  $trans->setAccId($acc->getAccId());
  $trans->setAccResId("4");
  $trans->setCreateDate(date('Y-m-d'));
  $trans->setAmount($trans->getAmount());
  $trans->setTransactionType('4');
  $trans->setReference('-');
  $trans->setPartyCode('-');
  $trans->setPartyType("Annulation Paiement");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);


  if($trans->insert())
  {
     //echo ' Enregistrement reussi ';
     $acc->update_bal($acc->getaccId());
     $paie->delete($_POST["trans_id"]);
     $op->update_one($_POST['op_id'],'op_id','is_paid',false);
     $vente->update_one($_POST['op_id'],'op_id','is_paid',false);


  }
  else
  {
   echo 'Echec Enregistrement';
  }
}
 /*if($trans->delete($_POST["trans_id"]))
 {*/
  //$acc->update_bal($acc->getaccId());

 /*}
 else
 {
  $msg='Echec annulation ';
 }*/

}
echo $msg;


?>
