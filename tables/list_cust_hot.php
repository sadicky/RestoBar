<?php
@session_start();
require_once '../load_model.php';
$perso= new BeanPersonne();

if(empty($_POST['keyword'])){ $keyword='-*';}
else{$keyword=$_POST['keyword'];}

$list=$perso->select_all_role_srch_hot('Customer',$keyword);

foreach ($list as $rs) {

  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['nom_complet'].' (CNI:'.$rs['customer_num'].')');
  $name_d = $rs['nom_complet'].' (CNI:'.$rs['customer_num'].')';
   echo '<li class="choose_cust_hot"  id="'.$rs['personne_id'].'" data-id="'.$name_d.'">'.$name.'</li>';
}
?>
