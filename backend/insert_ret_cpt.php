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


  $bal_pre=$trans->getBalAfter();
  $bal_post=$bal_pre - $_POST['mont_trans'];

  if($_POST['mode_paie']=='Cash')
  {
  $balance=$trans->select_bal_jour_admin($_SESSION['jour']);
  }
  else
  {
   $balance=$trans->select_bal_jour_admin_bq($_SESSION['jour']); 
  }
  
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
  $trans->setPartyCode($_POST['party']);
  $trans->setDescript($_POST['comment_trans']);
  //$trans->setCreateDate($_POST['date_trans'].' '.date('h:i:s'));
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('2');

  $trans_id=$trans->insert();
  $trans->update_one($trans_id,'transaction_id','mode_paie',$_POST['mode_paie']);

  echo ' Enregistrement reussi ';

  }
 }
 elseif($_POST["operation"] == "Edit")
 {

  $bal_pre=$trans->getBalAfter(); 
  $bal_post=$bal_pre - ($_POST['mont_trans']-$_POST['hidden_mont']);



  
    $balance=$trans->select_bal_jour_admin($_SESSION['jour']);
  
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
  $trans->setPartyCode($_POST['party']);
  $trans->setDescript($_POST['comment_trans']);
  $trans->setPreBal($bal_pre);
  $trans->setBalAfter($bal_post);
  $trans->setStatus('0');


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
