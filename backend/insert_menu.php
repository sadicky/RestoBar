<?php
@session_start();
require_once '../load_model.php';
$mn = new BeanMenu();



if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $mn->setMenuText($_POST['menu_txt']);
  $mn->setMenuIdText($_POST['menu_id_txt']);
  $mn->setMenuDataId("");
  $mn->setMenuParent($_POST['menu_parent']);
  $mn->setMenuGroup($_POST['menu_group']);
  $mn->setMenuOrder($_POST['menu_order']);
  //$mn->setModId($_POST['mod_id']);
  $mn->insert();

  echo 'Enregistrement reussi avec succès';

 }
else if($_POST["operation"] == "Edit")
 {

  $mn->setMenuText($_POST['menu_txt']);
  $mn->setMenuIdText($_POST['menu_id_txt']);
  $mn->setMenuDataId("");
  if(isset($_POST['menu_parent']))
  {
  $mn->setMenuParent($_POST['menu_parent']);
  }
  else
  {
  $mn->setMenuParent("");
  }
  if(isset($_POST['menu_group']))
  {
  $mn->setMenuGroup($_POST['menu_group']);
  }
  else
  {
  $mn->setMenuGroup("");
  }
  //$mn->setModId($_POST['mod_id']);
  $mn->setMenuOrder($_POST['menu_order']);
  $mn->setMenuId($_POST['menu_id']);
  $mn->updateCurrent();

  echo 'Modification reussie avec succès';


}

}
else
{
echo "operation existe pas";
}

?>
