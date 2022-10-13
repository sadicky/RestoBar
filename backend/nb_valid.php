<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
echo $op->select_count_valid();
?>
