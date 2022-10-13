<?php
session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$op = new BeanOperation();
$track=new BeanPayTrack();
$coup=new BeanCoupon();
$chamb=new BeanPlace();
$loc=new BeanLocation();

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
    $trans->setTransactionType('7');
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
     
     $datas2=$loc->select_all($_POST['op_id']);
      foreach ($datas2 as $un2) {
     $chamb->update_one($un2['chamb_id'],'place_id','status','1');
      }

     $to_day=date('Y-m-d');
     $loc->update_one($_POST['op_id'],'op_id','loc_etat','0');
     //$loc->update_one($_POST['op_id'],'op_id','to_d',$to_day);
    }
    
    $op->update_one($_POST['op_id'],'op_id','personne_id',$_SESSION['perso_id']);
    $op->update_one($_POST['op_id'],'op_id','jour_id',$_SESSION['jour']);

    echo 'Paiement Effectué avec succès ';

    if($_POST["mont_du"] == $_POST['mont_trans'])
     {
     
      }
    
  }
?>
