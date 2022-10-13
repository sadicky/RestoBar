<?php

@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();

if(isset($_POST["operation"]))
{
  $trans->select_last_jour($_SESSION['jour']);
  $trans->select($trans->getTransactionId());
 if($_POST["operation"] == "Add")
 {

  $balance=$trans->select_balance($_POST['mode_paie']);
  
  if($balance<$_POST['mont_trans'])
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$balance;
  }
  else
  {
  $trans->setJourId($_SESSION['jour']);
  $trans->setOpId('-');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('4');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode('0');
  $trans->setDescript($_POST['motif']);
  //$trans->setCreateDate($_POST['date_trans'].' '.date('h:i:s'));
  $trans->setPreBal('0');
  $trans->setBalAfter('0');
  $trans->setStatus('2');

  $trans_id=$trans->insert();
  $trans->update_one($trans_id,'transaction_id','mode_paie',$_POST['mode_paie']);
  $trans->update_one($trans_id,'transaction_id','create_date',$_POST['date_trans']);

  echo ' Enregistrement reussi ';

  }
 }
 elseif($_POST["operation"] == "Edit")
 {

  $balance=$trans->select_balance($_POST['mode_paie'])-($_POST['mont_trans']-$_POST['hidden_mont']);
  
  if($balance<0)
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$balance;
  }
  else
  {
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setJourId($_SESSION['jour']);
  $trans->setOpId('-');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('4');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode('0');
  $trans->setDescript($_POST['motif']);
  $trans->setPreBal('0');
  $trans->setBalAfter('0');
  $trans->setStatus('0');


  $trans->updateCurrent();
  echo ' Modification reussie ';
  $trans->update_one($_POST['trans_id'],'transaction_id','mode_paie',$_POST['mode_paie']);
  $trans->update_one($_POST['trans_id'],'transaction_id','create_date',$_POST['date_trans']);
 }
}
}
else
{
echo "operation existe pas";
}

?>
