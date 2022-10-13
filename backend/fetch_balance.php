<?php
@session_start();
require_once '../load_model.php';
$trans=new BeanTransactions();
$output = array();
$output["balance"] =$trans->select_balance($_POST['id_bq']); 
echo json_encode($output);
?>
