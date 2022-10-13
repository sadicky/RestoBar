<?php
require_once '../load_model.php';
$user = new BeanUsers();
$nb=$user->select_exist_mp($_POST['mp']);
echo $nb;
?>
