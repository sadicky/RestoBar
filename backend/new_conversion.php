<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$entre = new BeanEntreProdf();
$op=new BeanOperation();
$det =new BeanDetailsOperation();
//$_SESSION['pos']=$_POST['destpos'];
//$op->select($_POST['party_']);
$sess='0';

$op->setOpType('6');
$op->setPartyType('1');
$op->setJourId($sess);
$op->setState(true);
$op->setPartyCode($_POST['party_code']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);
$op->setCreateDate(date('Y-m-d'));

$max_op=$op->select_last('Conversion',$_SESSION['perso_id']);
$_SESSION['op_conv_id']=$max_op['last_id_perso'];

if($det->nb_op($_SESSION['op_conv_id'])!=0 or empty($_SESSION['op_conv_id']))
{
$op->insert();
$max_op=$op->select_last('Conversion',$_SESSION['perso_id']);
$_SESSION['op_conv_id']=$max_op['last_id_perso'];
$op->select($_SESSION['op_conv_id']);

$last_entre=$entre->select_last_num();
$last_num=($last_entre['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));
$_SESSION['op_num']=$last_num;

//echo $is_new;
$entre->setAmount('0');
$entre->setNumEnt($last_num);
$entre->setOpId($_SESSION['op_conv_id']);
$entre->setIsPaid(false);
$entre->insert();

$op->update_one($_SESSION['op_conv_id'],'op_id','id_per',$_SESSION['periode']);
}
else
{
$op->setOpId($_SESSION['op_conv_id']);
$op->setOpType('6');
$op->setJourId($sess);
$op->setState(true);
$op->setPartyCode($_POST['party_code']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);
$op->setCreateDate(date('Y-m-d'));
$op->updateCurrent();

$entre->select($_SESSION['op_conv_id']);
$_SESSION['op_num']=$entre->getNumEnt();
}


$nb_op=$op->select_num('Conversion');
//$_SESSION['sup_id']=$acc_sup->getPersonneId();


?>
