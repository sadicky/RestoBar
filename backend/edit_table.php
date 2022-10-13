<?php
@session_start();
require_once '../load_model.php';

$vente=new BeanVente();
$vente->update_one($_SESSION["op_vente_id"],'op_id','place',$_POST['place']);

?>
