<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
//$stock= new BeanStock();

//$pers->select($_SESSION['pos']);

if(empty($_POST['keyword']))
{
$keyword='-*';
}
else
{
$keyword=$_POST['keyword'];
}
$_SESSION['prod_id']=$keyword;
$list=$prod->select_all_2($keyword);

foreach ($list as $rs) {

  $prod_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['prod_name']);
  
  $prix=$rs['prod_price'];
  //if(empty($qt)) $qt=0;

    echo '<li class="choose_prod_v"  data-id="'.$rs['prod_id'].'" onclick="set_item_prod(\''.$rs['prod_name'].'\')">'.$prod_name.' (<b>'.$prix.' Bif</b>)</li>';
	
}
?>
