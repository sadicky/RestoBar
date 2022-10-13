<?php

require_once '../load_model.php';
$cat = new BeanCategory();

/*if(isset($_POST['cat_id']))
{*/
 $cat->update_one($_POST['cat_id'],'category_id',$_POST['field'],$_POST['val']);
 //echo 'modification reussie';
//}
?>
