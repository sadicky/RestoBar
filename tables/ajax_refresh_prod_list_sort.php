<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$op=new BeanOperation();
$op->select($_SESSION['op_sortie_mp_id']);
$pos=$_SESSION['pos'];

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

  $prod_name = $rs['prod_name'].' ('.$rs['unt_mes'].')->';
  // add new option
  $stock->select($rs['prod_id'],$pos);
  $qt=$stock->getQuantity();

   echo '<li class="choose_prod_sort ';
    if($stock->getQuantity()<=0 and $rs['is_stock']=='Oui')
                            {
                            echo 'text-danger ';
                            }
    echo '" data-id="'.$rs['prod_id'].'" onclick="set_item(\''.$prod_name.'\')">'.$prod_name.' (<b>'.$qt.'</b>)</li>';
 

}
?>
