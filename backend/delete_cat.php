<?php

require_once '../load_model.php';
$cat = new BeanCategory();

if(isset($_POST['category_id']))
{
  
  $cat->delete($_POST['category_id']);
  echo 'Suppression reussie avec succès';
  
}
else
{
echo " pas Id ";
}

?>
