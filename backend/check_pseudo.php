<?php
require_once '../load_model.php';
$user = new BeanUsers();
$nb=$user->select_exist_pseudo($_POST['pseudo']);
echo $nb;
?>
