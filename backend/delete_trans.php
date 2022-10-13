<?php
@session_start();
require_once '../load_model.php';

$trans = new BeanTransactions();
$op = new BeanOperation();

$trans->select($_POST["trans_id"]);

$balance=$trans->select_balance($trans->getIdBq());
$bal_post=$balance - $trans->getAmount();

$msg='Annulation réussie avec succes ';

if($bal_post<0)
{
  $msg ='Suppression impossible il y a pas assez de provision, Balance :'.$balance;
}
elseif(isset($_POST["trans_id"]))
{ 
 $trans->delete($_POST["trans_id"]);
  if($trans->getTransactionType()=='Transfert')
  {
       $trans->delete($trans->getPartyCode());
  }
}

echo $msg;

?>
