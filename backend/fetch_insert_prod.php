<?php

require_once '../load_model.php';
$prod = new BeanProducts();
$prod->select_code($_POST["rech"]);

$output = array();
if(isset($_POST["rech"]))
{
  $output["prod_id"] = $prod->getProdId();
}

echo json_encode($output);


?>
