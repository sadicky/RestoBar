<?php
@session_start();
require_once '../load_model.php';

$op=new BeanOperation();
$op->update_one($_SESSION["op_vente_id"],'op_id','party_code',$_POST['client']);

?>
