<?php
@session_start();
require_once '../load_model.php';

$pl=new BeanPlace();
$pl->update_one($_POST['place_id'],'place_id',$_POST['field'],$_POST['val']);
//echo $_POST['prod_id'].'-'.$_POST['val'];
?>
