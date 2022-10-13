<?php
session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$op = new BeanOperation();
$track=new BeanPayTrack();

$op->select($_POST['op_id']);
$jour=0;
if(isset($_SESSION['jour'])){$jour=$_SESSION['jour'];}

$balance=$trans->select_balance($_POST['id_bq']);

$du=$_POST["mont_du"];
      

  if($balance<$_POST['mont_trans'])
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$balance;
  }
  elseif($du<$_POST['mont_trans'])
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {

    $trans->setJourId($jour);
    $trans->setOpId($_POST['op_id']);
    $trans->setAmount($_POST['mont_trans']);
    $trans->setTransactionType('2');
    $trans->setPersonneId($_SESSION['perso_id']);
    $trans->setPartyCode($op->getPartyCode());
    $trans->setDescript('Paiement du fournisseur');
    $trans->setModePaie($_POST['mode_paie']);
    $trans->setIdBq($_POST['id_bq']);
    $trans->setIdPer($_SESSION['periode']);
    $trans->setCreateDate($_POST['date_trans']);
    $trans->setStatus('2');

    $trans_id=$trans->insert();
    echo 'Paiement Effectué avec succès';
    
    $paie->setOpId($_POST['op_id']);
    $paie->setTransactionId($trans_id);
    $paie->setAmount($_POST['mont_trans']);
    $paie->setModePaie($_POST['mode_paie']);
    $paie->setAutref('0');

    $paie->insert();

    $amount=$paie->select_sum_op($_POST['op_id']);

    if($amount['paie'] == $_POST['mont_du'])
    {
      $op->update_one($_POST['op_id'],'op_id','is_paid','1');
      //$track->update_one($_POST["op_id"],'op_id','is_paid','1');
    }

    /*$track->setOpId($_POST['op_id']);
    $track->setDatePay($_POST['date_next']);
    $track->update_one($_POST["op_id"],'op_id','is_paid','1');
    $track->insert();*/
  }
?>
