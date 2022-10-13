<?php

session_start();
require_once '../load_model.php';
$cat = new BeanCategory();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $cat->setCategoryName($_POST['cat_name']);
  $cat->setCategoryParent($_POST['cat_parent']);
  $cat->setIsSale($_POST['is_sale']);
  $cat->setCoeff($_POST['coeff']);
  $cat->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $cat->setCategoryName($_POST['cat_name']);
  $cat->setCategoryId($_POST['cat_id']);
  $cat->setCategoryParent($_POST['cat_parent']);
  $cat->setIsSale($_POST['is_sale']);
  $cat->setCoeff($_POST['coeff']);
  $cat->updateCurrent();
  $cat->update_one($_POST["cat_id"],'category_id','last_update',date('Y-m-d h:i:s'));
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
