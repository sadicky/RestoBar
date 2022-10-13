<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$ent = new BeanEntreProdf();
$acc_sup=new BeanAccounts();
$det =new BeanDetailsOperation();

//$acc_sup->select($_POST['acc_id']);
$op->setOpType('3');
$op->setCreateDate($_POST['date_ent']);
$op->setState(true);
$op->setPartyCode('-');
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);

$max_op=$op->select_last('Production',$_SESSION['perso_id']);
$_SESSION['op_ent_id']=$max_op['last_id_perso'];

//$is_new=$op->select_last2($acc_sup->getPersonneId(),$_SESSION['perso_id']);



if($det->nb_op($_SESSION['op_ent_id'])!=0 or empty($_SESSION['op_ent_id']))
{
$op->insert();
$max_op=$op->select_last('Production',$_SESSION['perso_id']);
$_SESSION['op_ent_id']=$max_op['last_id_perso'];
$op->select($_SESSION['op_ent_id']);

$last_ent=$ent->select_last_num();
$last_num=($last_ent['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));
$_SESSION['ent_num']=$last_num;

//echo $is_new;
$ent->setAmount('0');
$ent->setNumEnt($last_num);
$ent->setOpId($_SESSION['op_ent_id']);
$ent->setIsPaid(false);
$ent->insert();
}
else
{
$op->setOpId($_SESSION['op_ent_id']);
$op->setOpType('3');
$op->setCreateDate($_POST['date_ent']);
$op->setState(true);
$op->setPartyCode('-');
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);
$op->updateCurrent();

$ent->select($_SESSION['op_ent_id']);
$_SESSION['ent_num']=$ent->getNumEnt();
}


$nb_op=$op->select_num('Production');
//$_SESSION['sup_id']=$acc_sup->getPersonneId();


?>
