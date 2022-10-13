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

$list=$prod->select_all_2a($keyword,'1');

foreach ($list as $rs) {
$stock->select($rs['prod_id'],$_SESSION['pos']);
  // put in bold the written text
  $prod_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['prod_name']);
  // add new option

   echo '<li class="choose_prod ';

    if($stock->getQuantity()<=0 and $rs['is_stock']=='Oui')
                            {
                            echo 'text-danger ';
                            }


    echo '" data-id="'.$rs['prod_id'].'" onclick="set_item(\''.$rs['prod_name'].'\')">**'.$prod_name.'</li>';

}
?>
