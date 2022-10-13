<?php

require_once '../load_model.php';
$category = new BeanCategory();
$category->select($_POST["category_id"]);

$output = array();
if(isset($_POST["category_id"]))
{
  $output["category_name"] = $category->getCategoryName();
  $output["category_type"] = $category->getCategoryType();
  $output["is_sale"] = $category->getIsSale();
 }
$output['id'] = $_POST["category_id"];

echo json_encode($output);


?>
