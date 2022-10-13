<?php
session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$op = new BeanOperation();
$track=new BeanPayTrack();
$coup=new BeanCoupon();

$op->select($_POST['op_id']);

$jour=0;
if(isset($_SESSION['jour'])){$jour=$_SESSION['jour'];}

$balance=$trans->select_balance($_POST['id_bq']);
$du=$_POST["mont_du"]+$_POST['autref'];
      

  if($du<$_POST['mont_trans'])
  {
    echo 'Paiement impossible! Montant payé supérieur au montant dû';
  }
  else
  {

    $trans->setJourId($jour);
    $trans->setOpId($_POST['op_id']);
    $trans->setAmount($_POST['mont_trans']);
    $trans->setTransactionType('3');
    $trans->setPersonneId($_SESSION['perso_id']);
    $trans->setPartyCode($op->getPartyCode());
    $trans->setDescript('Paiement du client');
    $trans->setModePaie($_POST['mode_paie']);
    $trans->setIdBq($_POST['id_bq']);
    $trans->setIdPer($_SESSION['periode']);
    $trans->setCreateDate($_POST['date_trans']);
    $trans->setStatus('1');

    $trans_id=$trans->insert();
    
    
    $paie->setOpId($_POST['op_id']);
    $paie->setTransactionId($trans_id);
    $paie->setAmount($_POST['mont_trans']);
    $paie->setModePaie($_POST['mode_paie']);
    $paie->setAutref($_POST['autref']);

    $paie->insert();

    $amount=$paie->select_sum_op($_POST['op_id']);

    if($du == $_POST['mont_trans'])
    {
      $op->update_one($_POST['op_id'],'op_id','is_paid','1');
      $op->update_one($_POST['op_id'],'op_id','is_send','1');
      //$track->update_one($_POST["op_id"],'op_id','is_paid','1');
    }
    $op->update_one($_POST['op_id'],'op_id','personne_id',$_SESSION['perso_id']);
    $op->update_one($_POST['op_id'],'op_id','jour_id',$_SESSION['jour']);

  
    echo 'Paiement Effectué avec succès ';
    if(isset($_SESSION['list_det'])) {
      foreach ($_SESSION['list_det'] as $key => $value) {
        $coup->update_one($value,'coupon_id','is_paid','1');
      }
    }
  }
?>
