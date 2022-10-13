<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det->update_one($_POST["det_id"],'details_id','date_exp',$_POST['acc']);
?>
