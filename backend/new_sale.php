<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$vente = new BeanVente();
$det =new BeanDetailsOperation();
$pers=new BeanPersonne();
$cust=new BeanCustomer();
$cmd=new BeanCoupon();
$jr=new BeanJournal();

$jr->select($_SESSION['jour']);
$idPer=$_SESSION['periode'];
$posId=$_SESSION['pos'];
$cust->select_code('1');
$cust_id=$cust->getPersonneId();
//$date_v=date('Y-m-d',strtotime($jr->getStartDate()));
$date_v=date('Y-m-d');
$vente->select_by_table_av($_POST['tab_id']);

$opId=$op->select_last_num('Vente');


if($det->nb_op($opId)==0 and !empty($opId))
{
$_SESSION['op_vente_id']=$opId;
$op->select($_SESSION['op_vente_id']);

$op->update_one($_SESSION['op_vente_id'],'op_id','jour_id',$_SESSION['jour']); 
$op->update_one($_SESSION['op_vente_id'],'op_id','create_date',$date_v);
$vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id','0');
$vente->update_one($_SESSION['op_vente_id'],'op_id','place',$_POST['tab_id']);
$vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id',$_POST['serv']);

$last_vente=$vente->select_last_num($date_v,'Vente');
$last_num=$last_vente['num'] .'/'.date("d.m", strtotime($op->getCreateDate()));
$vente->update_one($_SESSION['op_vente_id'],'op_id','num_vente',$last_num);

if($cmd->select_exist_op($_SESSION['op_vente_id']))
{
$_SESSION['cmd']=$cmd->select_last_cmd($_SESSION['op_vente_id']);
}
else
{
$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();
}

}
else
{
  $op->setOpType('4');
  $op->setPartyType('2');
  $op->setJourId($_SESSION['jour']);
  $op->setPartyCode($cust_id);
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($date_v);

  $_SESSION['op_vente_id']=$op->insert();

  $op->select($_SESSION['op_vente_id']);
  $last_vente=$vente->select_last_num($date_v,'Vente');
  $last_num=($last_vente['num']) .'/'.date("d.m", strtotime($op->getCreateDate()));

  $vente->setAmount('0');
  $vente->setNumVente($last_num);
  $vente->setOpId($_SESSION['op_vente_id']);
  $vente->setIsPaid('0');
  $vente->setAssId('0');
  $vente->insert();

  //$vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id',$_POST['serv_id']);
  $vente->update_one($_SESSION['op_vente_id'],'op_id','place',$_POST['tab_id']);
  $vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id',$_POST['serv']);

if($cmd->select_exist_op($_SESSION['op_vente_id']))
{
$_SESSION['cmd']=$cmd->select_last_cmd($_SESSION['op_vente_id']);
}
else
{
$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();
}

}
/*else
{

 $op->update_one($_SESSION['op_vente_id'],'op_id','jour_id',$_SESSION['jour']); 
 $op->update_one($_SESSION['op_vente_id'],'op_id','create_date',date('Y-m-d')); 
 
}*/
echo 'Enregistrement réussi xx'.$last_num;

?>
