<?php
@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$acc=new BeanAccounts();
$op = new BeanOperation();
$track=new BeanPayTrack();
$vente=new BeanVente();

if(isset($_POST["trans_id"]))
{

 $trans->update_one($_POST["trans_id"],'transaction_id','canceled',false);
 $paie->update_one($_POST["trans_id"],'transaction_id','canceled',false);

 echo 'Transaction annulée';

 $trans->select($_POST["trans_id"]);

 if($trans->getTransactionType()=='Fourniture')
 {
  $acc->select($trans->getPartyCode());
  $bal=$acc->getBalPaid() - $trans->getAmount();
  $acc->setBalPaid($bal);
  $acc->update_paid($trans->getPartyCode());

  $op->update_one($trans->getOpId(),'op_id','is_paid',false);
  $track->update_one($trans->getOpId(),'op_id','is_paid',false);
 }
 
 if($trans->getTransactionType()=='Vente')
 {
  $acc->select($trans->getPartyCode());
  $bal=$acc->getBalPaid() - $trans->getAmount();
  $acc->setBalPaid($bal);
  $acc->update_paid($trans->getPartyCode());

  $op->update_one($trans->getOpId(),'op_id','is_paid',false);
  $vente->update_one($trans->getOpId(),'op_id','is_paid',false);
 }
}



?>
