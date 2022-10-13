<?php
@session_start();
require_once '../load_model.php';
$prod = new BeanProducts();
$cat = new BeanCategory();

if(isset($_POST["prod"]))
{
 if($_POST["operation"] == "Add")
 {

  $cat_id=$_POST['cat_id'];
  if(!empty($_POST['content_lib_cat']) and empty($cat_id))
  {
  $cat->setCategoryName($_POST['content_lib_cat']);
  $cat->setCategoryParent('0');
  $cat->setIsSale('Oui');
  $cat->setCoeff('0');
  $cat_id=$cat->insert();
  }

  $prod->setCategoryId($cat_id);
  $prod->setProdName($_POST['prod']);
  $prod->setProdCode($_POST['prod_code']);
  $prod->setNbEl($_POST['nb_el']);
  $prod->setProdPrice($_POST['prod_price']);
  $prod->setIsStock($_POST['is_stock']);
  $prod->setProdEquiv($_POST['prod_equiv']);
  $prod->setUntMes($_POST['unt_mes']);
  $prod->setIsTva($_POST['is_tva']);
  $prod->insert();

  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $prod->setCategoryId($_POST['cat_id']);
  $prod->setProdName($_POST['prod']);
  $prod->setProdCode($_POST['prod_code']);
  $prod->setProdPrice($_POST['prod_price']);
  $prod->setProdEquiv($_POST['prod_equiv']);
  $prod->setNbEl($_POST['nb_el']);
  $prod->setUntMes($_POST['unt_mes']);
  $prod->setIsStock($_POST['is_stock']);
  $prod->setProdId($_POST['mod_id']);
  $prod->setIsTva($_POST['is_tva']);

  $prod->updateCurrent();

  echo 'Modification reussie avec succès';
  $prod->update_one($_POST["mod_id"],'prod_id','last_update',date('Y-m-d h:i:s'));
}

}
else
{
echo "operation existe pas";
}

?>
