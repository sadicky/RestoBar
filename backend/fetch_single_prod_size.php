<?php

require_once '../load_model.php';
$size= new BeanProdSize();
$size->select($_POST["size_id"]);

$output = array();
if(isset($_POST["size_id"]))
{
  $output["prod_size_name"] = $size->getProdSizeName();
 }
$output['id'] = $_POST["size_id"];

echo json_encode($output);


?>
