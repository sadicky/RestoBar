<?php
require_once 'load_model.php';
@session_start();
$pos = new BeanPersonne();
$pers = new BeanPersonne();

$pos->select($_SESSION['pos']);
$pers->select($_SESSION['current_user']);

echo '<h3>Stock : '.$pos->getNomComplet().'/ User : '.$pers->getNomComplet().'</h3>';
?>
