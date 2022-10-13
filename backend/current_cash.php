<?php
@session_start();
require_once '../load_model.php';
$user = new BeanUsers();
$user->select($_POST['user_id']);

$msg='Caissier encours validée ';

if(isset($_POST["user_id"]))
{
 $user->update_one('2','type_user','cash',false);
 $user->update_one($_POST["user_id"],'user_id','cash',true);
 echo $msg;
}
else
{
echo " pas Id";
}



?>
