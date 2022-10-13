<?php

session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$trans_alim=new BeanTransactions();
$acc = new BeanAccounts();
$acc_alim = new BeanAccounts();

$acc->select($_POST['acc_num_ret']);
$acc_alim->select($_POST['acc_num_alim']);

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $bal_pre=$acc->getBalCash();
  $bal_post=$acc->getBalCash() - $_POST['mont_trans'];

  $bal_pre_alim=$acc_alim->getBalCash();
  $bal_post_alim=$acc_alim->getBalCash()+$_POST['mont_trans'];

  if($bal_post<0)
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$acc->getBalCash();
  }
  else
  {
  $trans->setAccId($acc->getAccId());
  $trans->setAccResId("2");
  $trans->setCreateDate(date('Y-m-d', strtotime($_POST['date_trans'])));
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('5');
  $trans->setReference('-');
  $trans->setPartyCode($acc_alim->getAccId());
  $trans->setPartyType("Transfert");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');

  $trans_alim->setAccId($acc_alim->getAccId());
  $trans_alim->setAccResId("3");
  $trans_alim->setCreateDate(date('Y-m-d', strtotime($_POST['date_trans'])));
  $trans_alim->setAmount($_POST['mont_trans']);
  $trans_alim->setTransactionType('5');
  $trans_alim->setReference('-');
  $trans_alim->setPartyCode($acc->getAccId());
  $trans_alim->setPartyType("Transfert");
  $trans_alim->setPreBal($bal_pre_alim);
  $trans_alim->setBalAfter($bal_post_alim);
  $trans_alim->setStatus('1');

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($acc->getAccId());
  $acc->setBalCash($bal_post);

  $acc_alim->setLastUpdate(date('Y/m/d h:i'));
  $acc_alim->setUpdatedBy($_SESSION['perso_id']);
  $acc_alim->setBalCash($bal_post_alim);


  if($trans->insert())
  {
     echo ' Enregistrement reussi ';
     $trans_alim->insert();
     $acc->update_bal($acc->getaccId());
     $acc_alim->update_bal($acc_alim->getaccId());

     $trans->update_one($trans_id,'transaction_id','mode_paie',$_POST['mode_paie']);
     $trans_alim->update_one($trans_id,'transaction_id','mode_paie',$_POST['mode_paie']);

  }
  else
  {
   echo 'Echec Enregistrement';
  }
}
 }

 /*if($_POST["operation"] == "Edit")
 {

  $bal_post=$acc->getBalCash() - ($_POST['mont_trans']-$_POST['hidden_mont']);
  $bal_pre=$acc->getBalCash();

  $bal_post_alim=$acc_alim->getBalCash() + ($_POST['mont_trans']-$_POST['hidden_mont']);

  if($bal_post<0)
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$acc->getBalCash();
  }
  else
  {
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setAccId($acc->getAccId());
  $trans->setAccResId("5");
  $trans->setCreateDate(date('Y-m-d', strtotime($_POST['date_trans'])));
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType("5");
  $trans->setReference("-");
  $trans->setPartyCode($acc_alim->getAccId());
  $trans->setPartyType("Transfert");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');


  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);

  $acc_alim->setLastUpdate(date('Y/m/d h:i'));
  $acc_alim->setUpdatedBy($_SESSION['perso_id']);
  $acc_alim->setBalCash($bal_post_alim);


  if($trans->updateCurrent())
  {
   echo 'Modification reussie ';
   $acc->update_bal($acc->getaccId());
   $acc_alim->update_bal($acc_alim->getaccId());
  }
  else
  {
    echo 'Echec Modification ';
  }

 }
}*/
}
else
{
echo "operation existe pas";
}

?>
