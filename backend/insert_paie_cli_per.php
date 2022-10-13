<?php

session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$acc = new BeanAccounts();
$acc_dest = new BeanAccounts();
$vente = new BeanVente();
$op = new BeanOperation();

$acc->select_acc_perso($_SESSION['cash']);
$acc_dest->select($_POST['party_code']);
//$acc_dest->select_acc_perso($acc->getPersonneId());

if(isset($_POST["operation"]))
{
  if($_POST["operation"]=='Add')
{
  $bal_pre=$acc->getBalCash();
  //$bal_pre_dest=$acc_dest->getBalCash();

  //$bal_post_dest=$acc_dest->getBalCash() + $_POST['mont_trans'];
  $bal_post=$acc->getBalCash() + $_POST['mont_trans'];


  if(empty($acc->getAccId()))
  {
    echo 'vous n\'avez de compte courante';
  }
  elseif($_POST["mont_du"] < $_POST['mont_trans'])
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {
  $trans->setAccId($acc->getAccId());
  $trans->setAccResId("1");
  $trans->setCreateDate(date('Y-m-d', strtotime($_POST['date_trans'])));
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('3');
  $trans->setReference("");
  $trans->setPartyCode($acc_dest->getAccId());
  $trans->setPartyType("Paiement client");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);

  /*$acc_dest->setLastUpdate(date('Y/m/d h:i'));
  $acc_dest->setUpdatedBy($_SESSION['perso_id']);
  $acc_dest->setBalCash($bal_post_dest);*/



  if($trans->insert())
  {


     $acc->update_bal($acc->getaccId());
     //$acc_dest->update_bal($acc_dest->getaccId());

     $trans->select_last_acc($acc->getaccId());

     $paie->setOpId($_POST['op_id']);
     $paie->setTransactionId($trans->getTransactionId());
     $paie->setAmount($_POST['mont_trans']);
     $paie->setModePaie($_POST['mode_paie']);
     $paie->setCheque($_POST['cheque']);

     $paie->insert();

     $vente->select($_POST['op_id']);
     $amount=$paie->select_sum_op($_POST['op_id']);

     $mont=$vente->getAmount()- $vente->getRed();
     /*$tva=0;

     if($vente->getTva()=='1')
     {
      $tva=($vente->getAmount()+$vente->getRed())*0.18;
     }

     $mont +=round($tva);
*/

     if($mont==$amount['paie'])
     {
      $op->update_one($_POST['op_id'],'op_id','is_paid',true);
      $vente->update_one($_POST['op_id'],'op_id','is_paid',true);
     }

     echo ' Enregistrement reussi ';

  }
  else
  {
   echo 'Echec Enregistrement';
  }
  }

 }

 if($_POST["operation"] == "Edit")
 {
  $image = '';
  /*if($_FILES["trans_image"]["name"] != '')
  {
   $image = $trans->upload_image();
  }
  else
  {
   $image = $_POST["hidden_ref"];
  }*/

  $bal_post=$acc->getBalCash() - ($_POST['mont_trans']-$_POST['hidden_mont']);
  $bal_pre=$acc->getBalCash();
  //$bal_dest=$acc->getBalCash() - ($_POST['mont_trans']-$_POST['hidden_mont']);

  if($_POST["mont_du"] < ($_POST['mont_trans']-$_POST['hidden_mont']))
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setAccId($acc->getAccId());
  $trans->setAccResId("1");
  $trans->setCreateDate(date('Y-m-d', strtotime($_POST['date_trans'])));
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('3');
  $trans->setReference("");
  $trans->setPartyCode($acc_dest->getAccId());
  $trans->setPartyType("Paiement Client");
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('1');

  /*$acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_dest);*/

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['perso_id']);
  $acc->setBalCash($bal_post);

  if($trans->updateCurrent())
  {
   echo 'Modification reussie ';
   $acc->update_bal($acc->getaccId());
   /*$acc_res->update_bal($acc_res->getaccId());*/


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
}
}
else
{
echo "operation existe pas";
}

?>
