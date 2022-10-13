<?php

require_once '../load_model.php';
$mn = new BeanMenu();

if(isset($_POST['menu_id']))
{
 $mn->update_one($_POST["menu_id"],'menu_id','menu_order',$_POST['val']);
}
?>
