<?php
@session_start();
require_once '../load_model.php';
$jour = new BeanJournal();
$trans=new BeanTransactions();
$pers=new BeanPersonne();

$jour->select($_POST['jour_id']);


$status=true; $msg='Journal validé';

if($jour->getValid()=='1')
{
$status=false; $msg='Validation annulée';
}

if(isset($_POST["jour_id"]))
{

 if($jour->update_one($_POST["jour_id"],'jour_id','valid',$status))
 {
  echo $msg;
  if($jour->getValid()=='0')
	{
  $pers->select($jour->getPersonneId());
  $trans->setJourId($_SESSION['jour']);
  $trans->setOpId('-');
  $trans->setAmount($jour->getFinalBal());
  $trans->setTransactionType('1');
  $trans->setPersonneId($_SESSION['perso_id']);
  $trans->setPartyCode($jour->getJourId());
  $trans->setDescript('Versement après cloture du Vendeur : '.$pers->getNomComplet());
  $trans->setCreateDate($jour->getEndDate());
  $trans->setPreBal('0');
  $trans->setBalAfter('0');
  $trans->setStatus('1');
  $last=$trans->insert_2();

  $jour->update_one($_POST["jour_id"],'jour_id','parent_id',$last);
	}
	else
	{
		$trans->update_one($jour->getParentId(),'transaction_id','canceled',false);
	}
 }
 else
 {
 	echo 'Echec validation';
 }
}
else
{
echo " pas Id";
}

?>
