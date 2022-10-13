<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$det = new BeanDetailsOperation();
$pers=new BeanPersonne();
$per=new BeanPeriode();
$op=new BeanOperation();

$per->select($_POST['id_per']);

if($_SESSION['periode']==$_POST['id_per'])
{
  
  
  $crt_op=$op->select_one_per($_POST['id_per']);;
  $_SESSION['op_inv_id']=$op->select_last('Inventaire',$_POST['id_per'],$_POST['pos_id']);

  if($crt_op==0)
  {
    $op->setOpType('7');
    $op->setPartyType('1');
    $op->setJourId($_SESSION['jour']);
    $op->setPartyCode('0');
    $op->setIdPer($_POST['id_per']);
    $op->setPersonneId($_SESSION['perso_id']);
    $op->setPosId($_POST['pos_id']);
    $op->setCreateDate($per->getDebut());

    $_SESSION['op_inv_id']=$op->insert();
  }
echo $crt_op;
}

?>