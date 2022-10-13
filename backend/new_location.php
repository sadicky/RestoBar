<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$loc = new BeanLocation();
$vente=new BeanVente();
$chamb=new BeanPlace();

$dest='0';
$sess='0';
$chamb->select_2($_POST['chamb_id']);
$output = array();

if($_POST['from_d']>$_POST['to_d'])
{
$output["msg"] ='Dates de location invalides';
}
elseif($loc->exist_loc($_POST['chamb_id'],$_POST['from_d']))
{
 $output["msg"] ='La chambre est en réservation';
}
elseif($loc->exist_loc($_POST['chamb_id'],$_POST['to_d']))
{
 $output["msg"] ='La chambre est en réservation';
}
else
{

/*$loc->select_op_cli($_POST['personne_id'],'1');
$_SESSION['op_loc_id']=$loc->getOpId();*/

if(empty($_POST['op_loc']))
{
$op->setOpType('8');
$op->setPartyType('2');
$op->setJourId($sess);
$op->setState(true);
$op->setPartyCode($_POST['party_code']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($dest);
$op->setCreateDate(date('Y-m-d'));
$last_ins_op=$op->insert();
$_SESSION['op_loc_id']=$last_ins_op;
}
else
{
$_SESSION['op_loc_id']=$_POST['op_loc'];	
}

$op->select($_SESSION['op_loc_id']);
$last_vente=$vente->select_last_num($_POST['from_d'],'Location');
$last_num=($last_vente['num']) .'/'.date("d.m", strtotime($op->getCreateDate()));

$loc->setFromD($_POST['from_d']);
$loc->setToD($_POST['to_d']);
$loc->setLocPrice($chamb->getPlacePrice());
$loc->setOpId($_SESSION['op_loc_id']);
$loc->setChambId($_POST['chamb_id']);
$last=$loc->insert();

/*$fact->setLocNum($last_num);
$fact->setOpId($_SESSION['op_loc_id']);
$fact->insert();*/

  $vente->setAmount('0');
  $vente->setNumVente($last_num);
  $vente->setOpId($_SESSION['op_loc_id']);
  $vente->setIsPaid('0');
  $vente->setAssId('0');
  $v=$vente->insert();

  $vente->update_one($v,'idvente','place',$chamb->getPlaceNum());

if($_POST['from_d']<=date('Y-m-d'))
{
$chamb->update_one($_POST['chamb_id'],'place_id','status','0');
$output["msg"] ='Location réussie avec succès';
}

if($_POST['from_d']>date('Y-m-d'))
{
$loc->update_one($last,'loc_id','loc_type','2');
$output["msg"] ='Réservation réussie avec succès';
}

$output["op_id"] =$_SESSION['op_loc_id'];
}
echo json_encode($output);
?>
