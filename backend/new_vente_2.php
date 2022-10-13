<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$vente = new BeanVente();
$det =new BeanDetailsOperation();
$perso=new BeanPersonne();
$perso2=new BeanPersonne();
$cmd=new BeanCoupon();


$perso2->select_nom($_POST['cust_id']);

$date_v=$_POST['date_v'].' '.date('h:i');
if(isset($_SESSION['op_vente_id']) and $_POST['operation_fact']=='Edit')
{
$op->setOpId($_SESSION['op_vente_id']);
$op->setJourId($_SESSION['jour']);
$op->setOpType('4');
$op->setCreateDate($date_v);
$op->setState(true);
$op->setPartyCode($perso2->getPersonneId());
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);
$op->updateCurrent();

$vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id',$_POST['serv_id']);
$vente->update_one($_SESSION['op_vente_id'],'op_id','place',$_POST['place']);

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

$max_op=$op->select_last('Vente',$_SESSION['perso_id']);
$_SESSION['op_vente_id']=$max_op['last_id_perso'];
//echo 'Enregistrement réussi x';

if($det->nb_op($_SESSION['op_vente_id'])!=0 or empty($_SESSION['op_vente_id']))
{
$op->setOpType('4');
$op->setPartyType('2');
$op->setJourId($_SESSION['jour']);
$op->setCreateDate($date_v);
$op->setState(true);
$op->setPartyCode($perso2->getPersonneId());
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);

//echo $op->getCreateDate();
$op->insert();
$max_op=$op->select_last('Vente',$_SESSION['perso_id']);
$_SESSION['op_vente_id']=$max_op['last_id_perso'];

$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();

$op->select($_SESSION['op_vente_id']);

$datefact=date("m", strtotime($date_v));
$last_vente=$vente->select_last_num($datefact);
$perso->select($op->getPersonneId());
$last_num=($last_vente['last_num'] +1) .'.'.date("m.y", strtotime($op->getCreateDate()));

$_SESSION['op_vente_num']=$last_num;

$vente->setAmount('0');
$vente->setNumVente($last_num);
$vente->setOpId($_SESSION['op_vente_id']);
$vente->setAssId($_POST['serv_id']);
$vente->setIsPaid(false);
$vente->insert();

$vente->update_one($_SESSION['op_vente_id'],'op_id','place',$_POST['place']);
$op->update_one($_SESSION['op_vente_id'],'op_id','id_per',$_SESSION['periode']);
}
else
{
$op->setOpId($_SESSION['op_vente_id']);
$op->setOpType('4');
$op->setJourId($_SESSION['jour']);
$op->setCreateDate($date_v);
$op->setState(true);
$op->setPartyCode($perso2->getPersonneId());
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_SESSION['pos']);
$op->updateCurrent();

if($cmd->select_exist_op($_SESSION['op_vente_id']))
{
$_SESSION['cmd']=$cmd->select_last_cmd($_SESSION['op_vente_id']);
}
else
{
$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();
}

$datefact=date("m", strtotime($date_v));
$last_vente=$vente->select_last_num($datefact);
$op->select($_SESSION['op_vente_id']);
$perso->select($op->getPersonneId());
$last_num=($last_vente['last_num']) .'.'.date("m.y", strtotime($op->getCreateDate()));

$vente->update_one($_SESSION['op_vente_id'],'op_id','num_vente',$last_num);

$vente->select($_SESSION['op_vente_id']);
$_SESSION['op_vente_num']=$vente->getNumVente();

$vente->update_one($_SESSION['op_vente_id'],'op_id','ass_id',$_POST['serv_id']);
$vente->update_one($_SESSION['op_vente_id'],'op_id','place',$_POST['place']);
$op->update_one($_SESSION['op_vente_id'],'op_id','id_per',$_SESSION['periode']);

}

}
$_SESSION['cust_id']=$perso2->getPersonneId();

echo 'Enregistrement réussi';

?>
