<?php

require_once '../load_model.php';
$table = new BeanTabl();
$table->select($_POST["table_id"]);

$output = array();
if(isset($_POST["table_id"]))
{
  $output["table_num"] = $table->getTableNum();
  $output["table_parent"] = $table->getTableParent();
 }
$output['id'] = $_POST["table_id"];

echo json_encode($output);


?>
