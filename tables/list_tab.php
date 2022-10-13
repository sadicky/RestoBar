<?php
@session_start();
require_once '../load_model.php';
$tab= new BeanTabl();
$vente=new BeanVente();

if(empty($_POST['keyword'])){$keyword='-*';}else{$keyword=$_POST['keyword'];}

$list=$tab->select_all_srch_tab($keyword);

foreach ($list as $rs) {

  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['table_num']);
  if($vente->exist_table($rs['table_num'])==0)	
   echo '<li class="choose_tab"  id="'.$rs['table_num'].'" data-id="'.$_POST['serv'].'">'.$name.'</li>';
}
?>
