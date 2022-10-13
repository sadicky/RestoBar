<?php

require_once '../load_model.php';

$op=new BeanOperation();
$op->select($_POST['op_id']);

$output = array();

$output["date_op"] = $op->getCreateDate();
$output["op_type"] = $op->getOpType();

echo json_encode($output);

?>
