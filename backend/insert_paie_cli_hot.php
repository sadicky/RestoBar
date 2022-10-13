<?php

@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$loc = new BeanLocation();
$fact = new BeanLocationFact();
$chamb=new BeanChambre();
$op = new BeanOperation();
$det=new BeanDetailsOperation();
$acc=new BeanAccounts();


if(isset($_POST["opera"]))
{

  $trans->select_last_jour($_SESSION['jour']);
  $trans->select($trans->getTransactionId());

  $op->select($_POST['op_id']);
  $fact->select($_POST['op_id']);

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
  $trans->setTransactionType('7');
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

     if($_POST["mont_du"] == $_POST['mont_trans'])
     {
      $op->update_one($_POST['op_id'],'op_id','is_paid',true);

    $datas2=$loc->select_all($_POST['op_id']);
    foreach ($datas2 as $un2) {
     $chamb->update_one($un2['chamb_id'],'chamb_id','chamb_etat','1');
      }
     $to_day=date('Y-m-d');
     $loc->update_one($_POST['op_id'],'op_id','loc_etat','0');
     $loc->update_one($_POST['op_id'],'op_id','to_d',$to_day);
     $op->update_one($_POST['op_id'],'op_id','state',false);
     $op->update_one($_POST['op_id'],'op_id','is_send',true);
      }

     echo ' Paiement effectué ';
     unset($_SESSION['op_vente_id']);
  }

}
else
{
echo "operation existe pas";
}

?>
