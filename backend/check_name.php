<?php
require_once '../load_model.php';
$prod = new BeanProducts();
$nb=$prod->select_exist_name($_POST['code']);
echo $nb;
?>
