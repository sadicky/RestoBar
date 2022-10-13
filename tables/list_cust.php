<?php
@session_start();
require_once '../load_model.php';
$perso= new BeanPersonne();

if(empty($_POST['keyword'])){ $keyword='-*';}
else{$keyword=$_POST['keyword'];}

$list=$perso->select_all_role_srch('Customer',$keyword);

foreach ($list as $rs) {

  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['nom_complet']);
   echo '<li class="choose_cust"  id="'.$rs['personne_id'].'" data-id="'.$rs['nom_complet'].'">'.$name.'</li>';
}
?>
