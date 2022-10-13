<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$ent = new BeanEntreProdf();
$acc_sup=new BeanAccounts();
$det =new BeanDetailsOperation();

//$op->select($_POST['op_id']);
//$_SESSION['op_sort_id']=$_POST['op_id'];

//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
//$nb_op=$op->select_num('Approvisionnement');
//$_SESSION['op_num']=$_SESSION['op_id'].'/'.date("my", strtotime($op->getCreateDate()));

$op->setOpType('3');
$op->setCreateDate($_POST['date_ent']);
$op->setState(true);
$op->setPartyCode("-");
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);

$data_prod=$op->select_production_data($_POST['op_id'],'Production');
$_SESSION['op_ent_id']=$data_prod['op_id'];

//$is_new=$op->select_last2($acc_sup->getPersonneId(),$_SESSION['perso_id']);



if($op->select_production($_POST['op_id'],'Production')==0)
{
$op->insert();
$data_prod=$op->select_production_data($_POST['op_id'],'Production');
$_SESSION['op_ent_id']=$data_prod['op_id'];

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
/*$op->setOpId($_SESSION['op_ent_id']);
$op->setOpType('3');
$op->setCreateDate(date('Y-m-d'));
$op->setState(true);
$op->setPartyCode($_POST['op_id']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->updateCurrent();
*/
$ent->select($_SESSION['op_ent_id']);
$_SESSION['ent_num']=$ent->getNumEnt();
}


/*$nb_op=$op->select_num('Production');*/
//$_SESSION['sup_id']=$acc_sup->getPersonneId();


?>
