<?php

require_once '../load_model.php';
$prod = new Beanproducts();

if(isset($_POST['prod_id']))
{
  $prod->delete($_POST['prod_id']);
  echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id ";
}

?>
