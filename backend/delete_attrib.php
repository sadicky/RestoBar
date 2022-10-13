<?php

require_once '../load_model.php';
$attrib = new BeanAttributionMenu();

if(isset($_POST["attrib_id"]))
{
  $attrib->delete($_POST['attrib_id']);
}
else
{
echo " pas Id";
}

?>
