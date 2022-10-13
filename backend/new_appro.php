<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$achat = new BeanAchats();
$det =new BeanDetailsOperation();
$track=new BeanPayTrack();
$pos=new BeanPos();

//$pos->select_actif('0');
//$dest=$pos->getPersonneId();
$dest=$_POST['pos'];
$sess='0';
$op->setOpType('1');
$op->setPartyType('1');
$op->setJourId($sess);
$op->setState(true);
$op->setPartyCode($_POST['sup_id']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($dest);
$op->setCreateDate($_POST['date_ap']);

$max_op=$op->select_last('Approvisionnement');
$_SESSION['op_appro_id']=$max_op['last_id_perso'];

if($det->nb_op($_SESSION['op_appro_id'])!=0 or empty($_SESSION['op_appro_id']))
{
$last_ins_op=$op->insert();
//pay track
$track->setDatePay($_POST['date_pay']);
$track->setModePaie($_POST['mode_paie']);
$track->setOpId($last_ins_op);
$track->insert();

$_SESSION['op_appro_id']=$last_ins_op;
$op->select($_SESSION['op_appro_id']);

$last_achat=$achat->select_last_num();
$last_num=($last_achat['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));
$_SESSION['op_num']=$last_num;

//echo $is_new;
$achat->setAmount('0');
$achat->setNumAchat($last_num);
$achat->setOpId($_SESSION['op_appro_id']);
$achat->setIsPaid(false);
$achat->insert();

$op->update_one($_SESSION['op_appro_id'],'op_id','id_per',$_SESSION['periode']);
}
else
{
$op->setOpId($_SESSION['op_appro_id']);
$op->setOpType('1');
$op->setJourId($sess);
$op->setCreateDate($_POST['date_ap']);
$op->setState(true);
$op->setPartyCode($_POST['sup_id']);
$op->setIsPaid(false);
$op->setPersonneId($_SESSION['perso_id']);
$op->setPosId($dest);
$op->updateCurrent();

$track->setDatePay($_POST['date_pay']);
$track->setModePaie($_POST['mode_paie']);
$track->update($_SESSION['op_appro_id'],'0');

$achat->select($_SESSION['op_appro_id']);
$_SESSION['op_num']=$achat->getNumAchat();
}


$nb_op=$op->select_num('Approvisionnement');
$_SESSION['sup_id']=$_POST['sup_id'];


?>
