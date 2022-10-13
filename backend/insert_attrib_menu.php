<?php

session_start();
require_once '../load_model.php';
$attrib = new BeanAttributionMenu();



if(isset($_POST["perso_id"]))
{
  $attrib->setPersonneId($_POST['perso_id']);
  $attrib->setMenuId($_POST['menu_id']);
  $attrib->setPermission('-');
  $attrib->insert();
  echo 'menu ajouté';
}
else
{
echo "operation existe pas";
}

?>
