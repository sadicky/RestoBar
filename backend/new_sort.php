<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$sort = new BeanSortieMatp();
$acc_sup=new BeanAccounts();
$det =new BeanDetailsOperation();

$sess='0';
$op->setOpType('2');
$op->setPartyType('2');
$op->setJourId($sess);
$op->setCreateDate($_POST['date_sort']);
$op->setState(true);
$op->setPartyCode('-');
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_POST['pos']);


$max_op=$op->select_last('Sortie',$_SESSION['perso_id']);
$_SESSION['op_sortie_mp_id']=$max_op['last_id_perso'];

//$is_new=$op->select_last2($acc_sup->getPersonneId(),$_SESSION['perso_id']);



if($det->nb_op($_SESSION['op_sortie_mp_id'])!=0 or empty($_SESSION['op_sortie_mp_id']))
{

$op->insert();
$max_op=$op->select_last('Sortie',$_SESSION['perso_id']);
$_SESSION['op_sortie_mp_id']=$max_op['last_id_perso'];
$op->select($_SESSION['op_sortie_mp_id']);

$last_sort=$sort->select_last_num();
$last_num=($last_sort['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));
$_SESSION['sort_num']=$last_num;

//echo $is_new;
$sort->setAmount('0');
$sort->setNumSort($last_num);
$sort->setOpId($_SESSION['op_sortie_mp_id']);
$sort->setIsPaid(false);
$sort->setMotif($_POST['motif']);
$sort->setTypeSort($_POST['type_sort']);
$sort->insert();

//echo 'new sortie';
$op->update_one($_SESSION['op_sortie_mp_id'],'op_id','id_per',$_SESSION['periode']);
}
else
{

if(!empty($_POST['op_an_id']))
{
$_SESSION['op_sortie_mp_id']=$_POST['op_an_id'];
}

$op->setOpId($_SESSION['op_sortie_mp_id']);
$op->setOpType('2');
$op->setJourId($sess);
$op->setCreateDate($_POST['date_sort']);
$op->setState(true);
$op->setPartyCode('-');
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($_POST['pos']);
$op->updateCurrent();

$sort->update_one($_SESSION['op_sortie_mp_id'],'op_id','motif',$_POST['motif']);
$sort->update_one($_SESSION['op_sortie_mp_id'],'op_id','type_sort',$_POST['type_sort']);

$sort->select($_SESSION['op_sortie_mp_id']);
$_SESSION['sort_num']=$sort->getNumSort();

//echo 'encien sortie';
}


$nb_op=$op->select_num('Sortie');
//$_SESSION['sup_id']=$acc_sup->getPersonneId();
//echo $_SESSION['type_stock'];
?>
