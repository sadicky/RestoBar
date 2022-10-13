<?php
session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();

$jour=0;
if(isset($_SESSION['jour'])){$jour=$_SESSION['jour'];}

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  
  $balance=$trans->select_balance($_POST['id_bq']);
  
  if($balance<$_POST['mont_trans'])
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$balance;
  }
  else
  {
  $trans->setJourId($jour);
  $trans->setOpId('0');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('4');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode($_POST['id_typ']);
  $trans->setDescript($_POST['comment_trans']);
  $trans->setIdPer($_SESSION['periode']);
  $trans->setStatus('2');
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setIdBq($_POST['id_bq']);
  $trans->setModePaie($_POST['mode_paie']);

  $trans->insert();
  
  echo ' Enregistrement reussi ';
  }
 }
 elseif($_POST["operation"] == "Edit")
 {
  
  $balance=$trans->select_balance($_POST['id_bq'])-($_POST['mont_trans']-$_POST['hidden_mont']);
  
  if($balance<=0)
  {
    echo 'Vous n\'assez de provision, votre balance Cash vaut '.$balance;
  }
  else
  {
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setAmount($_POST['mont_trans']);
  $trans->setPartyCode($_POST['id_typ']);
  $trans->setDescript($_POST['comment_trans']);
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setModePaie($_POST['mode_paie']);
  $trans->setIdBq($_POST['id_bq']);

  $trans->updateCurrent();
  echo ' Modification reussie ';
  }
}
}
else
{
echo "operation existe pas";
}
?>
