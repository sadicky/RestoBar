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
  
  $trans->setJourId($jour);
  $trans->setOpId('0');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('1');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode('-');
  $trans->setDescript($_POST['comment_trans']);
  $trans->setIdPer($_SESSION['periode']);
  $trans->setStatus('1');
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setIdBq($_POST['id_bq']);
  $trans->setModePaie($_POST['mode_paie']);

  $trans->insert();
  
  echo ' Enregistrement reussi ';
 }
 elseif($_POST["operation"] == "Edit")
 {
  
  $trans->setTransactionId($_POST['trans_id']);
  $trans->setJourId($jour);
  $trans->setOpId('0');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('1');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode('-');
  $trans->setDescript($_POST['comment_trans']);
  $trans->setIdPer($_SESSION['periode']);
  $trans->setStatus('1');
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setIdBq($_POST['id_bq']);
  $trans->setModePaie($_POST['mode_paie']);

  $trans->updateCurrent();
  echo ' Modification reussie ';
}
}
else
{
echo "operation existe pas";
}
?>
