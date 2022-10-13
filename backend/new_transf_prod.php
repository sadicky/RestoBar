<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$sort = new BeanSortieMatp();
$acc_sup=new BeanAccounts();
$det =new BeanDetailsOperation();
$store=new BeanPos();

//$acc_sup->select($_POST['acc_id']);

//$store->select($_POST['dest_pos']);

$source=$_POST['from_pos'];	


$dest_pos=
$pos=
$sess="0";
$_SESSION['dest_pos']=$_POST['dest_pos'];
$_SESSION['source_pos']=$source;

$op->setOpType('5');
$op->setPartyType('2');
$op->setJourId($sess);
$op->setCreateDate($_POST['date_sort']);
$op->setState(true);
$op->setPartyCode($_POST['dest_pos']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($source);

$max_op=$op->select_last('Transfert produit',$_SESSION['perso_id']);

$_SESSION['op_transf_prod_id']=$max_op['last_id_perso'];

//$is_new=$op->select_last2($acc_sup->getPersonneId(),$_SESSION['perso_id']);



if($det->nb_op($_SESSION['op_transf_prod_id'])!=0 or empty($_SESSION['op_transf_prod_id']))
{

$op->insert();
$max_op=$op->select_last('Transfert produit',$_SESSION['perso_id']);
$_SESSION['op_transf_prod_id']=$max_op['last_id_perso'];
$op->select($_SESSION['op_transf_prod_id']);

$last_sort=$sort->select_last_num();
$last_num=($last_sort['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));
$_SESSION['transf_prod_num']=$last_num;

//echo $is_new;
$sort->setAmount('0');
$sort->setNumSort($last_num);
$sort->setOpId($_SESSION['op_transf_prod_id']);
$sort->setIsPaid(false);
$sort->setMotif('Transfert des produits');
$sort->setTypeSort('Vente');
$sort->insert();

//echo 'new sortie';
$op->update_one($_SESSION['op_transf_prod_id'],'op_id','id_per',$_SESSION['periode']);
}
else
{

if(!empty($_POST['op_an_id']))
{
$_SESSION['op_transf_prod_id']=$_POST['op_an_id'];
}

$op->setOpId($_SESSION['op_transf_prod_id']);
$op->setOpType('5');
$op->setJourId($sess);
$op->setCreateDate($_POST['date_sort']);
$op->setState(true);
$op->setPartyCode($_POST['dest_pos']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($source);
$op->updateCurrent();

//$sort->update_one($_SESSION['op_transf_prod_id'],'op_id','motif',$_POST['motif']);

$sort->select($_SESSION['op_transf_prod_id']);
$_SESSION['transf_prod_num']=$sort->getNumSort();
}


$nb_op=$op->select_num('Transfert produit');
//$_SESSION['sup_id']=$acc_sup->getPersonneId();

$_SESSION['type_stock']='0';
?>
