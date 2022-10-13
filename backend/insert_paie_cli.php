<?php

@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$vente = new BeanVente();
$op = new BeanOperation();
$det=new BeanDetailsOperation();
$acc=new BeanAccounts();
$sell=$det->select_sum_op($_POST['op_id']);

/*if(isset($_POST["opera"]))
{
*/
  $trans->select_last_jour($_SESSION['jour']);
  $trans->select($trans->getTransactionId());

  $op->select($_POST['op_id']);

  /*if($_POST["opera"]=='Add')
  {*/
  $bal_pre=$trans->getBalAfter();
  $bal_post=$bal_pre + $_POST['mont_trans'];

  if($_POST["mont_du"] < $_POST['mont_trans'])
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {
  $trans->setJourId($_SESSION['jour']);
  $trans->setOpId($_POST['op_id']);
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('3');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode($op->getPartyCode());
  $trans->setDescript("Paiement du client");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');

  $trans_id=$trans->insert();
  $trans->update_one($trans_id,'transaction_id','mode_paie',$_POST['mode_paie']);

  $acc->select($op->getPartyCode());
  $bal=$acc->getBalPaid() + $_POST['mont_trans'];
  $acc->setBalPaid($bal);
  $acc->update_paid($op->getPartyCode());

     $paie->setOpId($_POST['op_id']);
     $paie->setTransactionId($trans_id);
     $paie->setAmount($_POST['mont_trans']);
     $paie->setModePaie($_POST['mode_paie']);
     $paie->setCheque($_POST['cheque']);

     $paie->insert();

     $vente->select($_POST['op_id']);
     
     $mont=$sell-$vente->getRed();
     $amount=$paie->select_sum_op($_POST['op_id']);

     if($mont==$amount['paie'])
     {
      $op->update_one($_POST['op_id'],'op_id','is_paid',true);
      $vente->update_one($_POST['op_id'],'op_id','is_paid',true);
     }

     $op->update_one($_POST['op_id'],'op_id','state',false);
     $op->update_one($_POST['op_id'],'op_id','is_send',true);
     $op->update_one($_POST['op_id'],'op_id','jour_id',$_SESSION['jour']);
     echo ' Paiement effectué ';
     unset($_SESSION['op_vente_id']);


  }

/* }*/

 /*if($_POST["opera"] == "Edit")
 {


  $bal_pre=$trans->getBalAfter();
  $bal_post=$bal_pre - ($_POST['mont_trans']-$_POST['hidden_mont']);

  if($_POST["mont_du"] < ($_POST['mont_trans']-$_POST['hidden_mont']))
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setJourId($_SESSION['jour']);
  $trans->setOpId($_POST['op_id']);
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('3');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode($op->getPartyCode());
  $trans->setDescript("Paiement du client");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);

  if($trans->updateCurrent())
  {
   echo 'Modification reussie ';
     $paie->setAmount($_POST['mont_trans']);
     $paie->update($_POST['trans_id']);

     $vente->select($_POST['op_id']);
     $amount=$paie->select_sum_op($_POST['op_id']);

     $mont=$vente->getAmount()- $vente->getRed();
     if($mont==$amount['paie'])
     {
      $op->update_one($_POST['op_id'],'op_id','is_paid',true);
     }
     else
     {
      $op->update_one($_POST['op_id'],'op_id','is_paid',false);
     }
  }
  else
  {
    echo 'Echec Modification ';
  }
 }
}*/
/*}
else
{
echo "operation existe pas";
}*/

?>
