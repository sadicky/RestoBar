<?php
@session_start();
require_once '../load_model.php';

$prod=new BeanProducts();
$prod->update_one($_POST['prod_id'],'prod_id',$_POST['field'],$_POST['val']);
//echo $_POST['prod_id'].'-'.$_POST['val'];
?>
