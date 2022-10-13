<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();

//$pers->select($_SESSION['pos']);

if(empty($_POST['keyword']))
{
$keyword='-*';
}
else
{
$keyword=$_POST['keyword'];
}

$list=$prod->select_all_2($keyword);

foreach ($list as $rs) {

  $prod_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['prod_name']);
  // add new option
 $stock->select($rs['prod_id'],$_SESSION['pos']);
  $qt=$stock->getQuantity();
  $prix=$rs['prod_price'];
  if(empty($qt)) $qt=0;

    echo '<li class="choose_prod_v ';
    if($stock->getQuantity()<=0 and $rs['is_stock']=='Oui')
                            {
                            echo 'text-danger ';
                            }
    echo '" data-id="'.$rs['prod_id'].'" onclick="set_item(\''.$rs['prod_name'].'\')">'.$prod_name.' (<b>'.$qt.' - '.$prix.' Bif</b>)</li>';
	
}
?>
