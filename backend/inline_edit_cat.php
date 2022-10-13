<?php

require_once '../load_model.php';
$cat = new BeanCategory();

if(isset($_POST['id']))
{
 $cat->update_one($_POST["id"],'category_id','category_name',$_POST['cat']);
}
?>
