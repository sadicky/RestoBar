<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
//$pers->select($pos);

if(empty($_POST['keyword']))
{
$keyword='-*';
}
else
{
$keyword=$_POST['keyword'];
}

$list=$prod->select_all_2($keyword);

$pos=$_SESSION['pos'];

foreach ($list as $rs) {
$stock->select($rs['prod_id'],$pos);
  // put in bold the written text
/*if($rs['is_stock']=='Oui')
	{*/
  $prod_name = $rs['prod_name'].' ('.$rs['unt_mes'].')';
   echo '<li class="choose_prod ';

    if($stock->getQuantity()<=0 and $rs['is_stock']=='Oui')
                            {
                            echo 'text-danger ';
                            }
    echo '" data-id="'.$rs['prod_id'].'" onclick="set_item(\''.$prod_name.'\')">'.$prod_name.'</li>';
//}
}
?>
