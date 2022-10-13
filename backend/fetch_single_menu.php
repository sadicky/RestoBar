<?php

require_once '../load_model.php';
$mn = new BeanMenu();
$mn->select($_POST["menu_id"]);

$output = array();
if(isset($_POST["menu_id"]))
{
  $output["menu_text"] = $mn->getMenuText();
  $output["menu_id_text"] = $mn->getMenuIdText();
  $output["menu_parent"] = $mn->getMenuParent();
  $output["menu_group"] = $mn->getMenuGroup();
  $output["menu_order"] = $mn->getMenuOrder();
}
$output['id'] = $_POST["menu_id"];

echo json_encode($output);


?>
