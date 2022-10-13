<?php

@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie = new BeanPaiement();
$vente = new BeanVente();
$op = new BeanOperation();
$det=new BeanDetailsOperation();
$bq=new BeanBanque();

$date_v=date('Y-m-d');
$jour=0;
$bq->select_status('Oui');

if(isset($_SESSION['jour'])){$jour=$_SESSION['jour'];}

if(isset($_SESSION['sum_fact']))
{
foreach ($_SESSION['op_id'] as $key => $value) {
$sell=$det->select_sum_op($value);
$op->select($value);
$vente->select($value);
$amount=$paie->select_sum_op($value);
$dif=$sell-$amount['paie'];
if($dif>0)
{
$trans->setJourId($jour);
$trans->setOpId($value);
$trans->setAmount($dif);
$trans->setTransactionType('3');
$trans->setPersonneId($_SESSION['perso_id']);
$trans->setPartyCode($op->getPartyCode());
$trans->setDescript("Paiement du client");
$trans->setModePaie('Espèce');
$trans->setIdBq($bq->getIdBq());
$trans->setIdPer($_SESSION['periode']);
$trans->setCreateDate($date_v);
$trans->setStatus('1');

$trans_id=$trans->insert();

$paie->setOpId($value);
$paie->setTransactionId($trans_id);
$paie->setAmount($dif);
$paie->setModePaie('Espèce');
$paie->setAutref('0');

$paie->insert();
//$op->update_one($value,'op_id','is_paid',true);
//$vente->update_one($value,'op_id','is_paid',true);

$op->update_one($value,'op_id','is_paid','1');
$op->update_one($value,'op_id','is_send','1');
$op->update_one($value,'op_id','personne_id',$_SESSION['perso_id']);
}
}
echo ' Paiement effectué ';
unset($_SESSION['op_vente_id']);
unset($_SESSION['op_id']);
unset($_SESSION['sum_fact']);
}
else
{
  echo 'Veuillez selectionner les factures';
}



?>