<?php
@session_start();
require_once '../load_model.php';

$vente=new BeanVente();
$vente->update_one($_SESSION["op_vente_id"],'op_id','ass_id',$_POST['serv_id']);
?>
