<?php

require_once '../load_model.php';
$prod = new BeanProducts();

if(isset($_POST['prod_id']))
{
 $prod->update_one($_POST["prod_id"],'prod_id',$_POST['field'],$_POST['val']);
 //echo 'modification reussie';
}
?>
