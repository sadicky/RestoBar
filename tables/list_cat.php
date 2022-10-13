<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();

if(empty($_POST['keyword'])){$keyword='-*';}else{$keyword=$_POST['keyword'];}

$list=$cat->select_all_srch_cat($keyword);

foreach ($list as $rs) {
	$cat->select($rs['category_parent']);
	if($rs['category_parent']>0)
	{
  $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['category_name']);
   echo '<li class="choose_cat"  id="'.$rs['category_id'].'" data-id="'.$rs['category_name'].'">'.$name.' ('.$cat->getCategoryName().')</li>';
	}
}
?>
