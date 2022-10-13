<?php
@session_start();
require_once '../load_model.php';
$acc= new BeanAcc();

if(empty($_POST['keyword'])){$keyword='-*';}else{$keyword=$_POST['keyword'];}

$list=$acc->select_all_srch_acc($keyword);

foreach ($list as $rs) {

  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['acc_name']);
   echo '<li class="choose_acc"  id="'.$_POST['det_id'].'" data-id="'.$rs['acc_name'].'">'.$rs['acc_name'].'</li>';
	
}
?>
