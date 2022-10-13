<?php
@session_start();
require_once '../load_model.php';
$perso= new BeanPersonne();
$user=new BeanUsers();
if(empty($_POST['keyword'])){ $keyword='-*';}
else{$keyword=$_POST['keyword'];}

$list=$perso->select_all_role_srch('Users',$keyword);

foreach ($list as $rs) {
$user->select_2($rs['personne_id']);
if($user->getTypeUser()=='Serveur')
{
  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['nom_complet']);
   echo '<li class="choose_serv"  id="'.$rs['personne_id'].'" data-id="'.$rs['personne_id'].'">'.$name.'</li>';
}
}
?>
