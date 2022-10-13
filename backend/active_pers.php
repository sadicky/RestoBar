<?php
@session_start();
require_once '../load_model.php';
$user = new BeanUsers();
$user->select($_POST['user_id']);

if($user->getActif()=='0')
{
$msg='Utilisateur Restauré! ';
}
else
{
$msg='Utilisateur Suspendu! ';
}


 $user->update_one($_POST["user_id"],'user_id','actif',$_POST['etat']);
 echo $msg;

?>
