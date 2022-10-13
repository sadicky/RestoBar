<?php
@session_start();
require_once '../load_model.php';
$jour = new BeanJournal();
$trans=new BeanTransactions();
$pers=new BeanPersonne();

$jour->select($_POST['jour_id']);


$status=true;
$state1=false;
$state2=true;


$msg='Journal Ouvert';

if($jour->getJourState()=='1')
{
$status=false; $msg='Journal fermé';
}

$jour = new BeanJournal();

$jour->select($_POST["jour_id"]);

 
 $jour->update_state($state1,$state2,$jour->getPersonneId());
 $jour->update_one($_POST["jour_id"],'jour_id','jour_state',$status);
 
 echo $msg;
 

?>
