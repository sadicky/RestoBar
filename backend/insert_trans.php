<?php
@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$trans2 = new BeanTransactions();

//$src=$_POST['bank'];

$jour=0;
if(isset($_SESSION['jour'])){$jour=$_SESSION['jour'];}

if(isset($_POST["operation"]))
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
  $trans->setTransactionType('5');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode('-');
  $trans->setDescript('Transfert Sortant');
  $trans->setIdPer($_SESSION['periode']);
  $trans->setStatus('2');
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setIdBq($_POST['id_bq']);
  $trans->setModePaie($_POST['mode_paie']);

  $last_id=$trans->insert();

  $trans->setJourId($jour);
  $trans->setOpId('0');
  $trans->setAmount($_POST['mont_trans']);
  $trans->setTransactionType('5');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode($last_id);
  $trans->setDescript('Transfert Entrant');
  $trans->setIdPer($_SESSION['periode']);
  $trans->setStatus('1');
  $trans->setCreateDate($_POST['date_trans']);
  $trans->setIdBq($_POST['id_bq2']);
  $trans->setModePaie($_POST['mode_paie']);

  $trans_id=$trans->insert();

  $trans->update_one($last_id,'transaction_id','party_code',$trans_id);

  echo 'Enregistrement reussi avec succès';
  }
}
else
{
echo "operation existe pas";
}
?>
