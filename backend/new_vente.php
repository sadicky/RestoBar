<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$vente = new BeanVente();
$det =new BeanDetailsOperation();
$perso=new BeanPersonne();


if(isset($_POST['date_v']))
{
	$date_v=$_POST['date_v'];
	$cust_id=$_POST['cust_id'];
}
else
{
	$date_v=date('Y-m-d');;
	$cust_id='0';
}

if(!isset($_SESSION['op_vente_id']))
{
$max_op=$op->select_last('Vente');
$_SESSION['op_vente_id']=$max_op['last_id_perso'];
$perso->select($_SESSION['perso_id']);
if($det->nb_op($_SESSION['op_vente_id'])!=0 or empty($_SESSION['op_vente_id']))
{
$op->setOpType('4');
$op->setPartyType('2');
$op->setJourId($_SESSION['jour']);
$op->setCreateDate($date_v);
$op->setState('1');
$op->setPartyCode('0');
$op->setIsPaid('0');
$op->setPersonneId('1');
$op->setPosId('2');
//$op->insert();

$_SESSION['op_vente_id']=$op->insert();
$datefact=$date_v;
$last_vente=$vente->select_last_num($datefact);

$last_num=($last_vente['last_num'] +1).'-'.date("dy", strtotime($op->getCreateDate()));

$_SESSION['op_vente_num']=$last_num;

$vente->setAmount('0');
$vente->setNumVente($last_num);
$vente->setOpId($_SESSION['op_vente_id']);
$vente->setAssId('0');
$vente->setIsPaid('0');
$vente->insert();
$op->update_one($_SESSION['op_vente_id'],'op_id','id_per',$_SESSION['periode']);
echo 'Enregistrement réussi';
 }
}
?>
