<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$op=new BeanOperation();

//ray->select_actif('0');
$op->select($_SESSION['op_transf_prod_id']);
$pos=$_SESSION['pos'];

//$pos=$ray->getPersonneId();
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
$stock->select($rs['prod_id'],$_SESSION['source_pos']);
$qt=$stock->getQuantity();
  // put in bold the written text
  $prod_name = $rs['prod_name'].' ('.$rs['unt_mes'].')';
  // add new option

   echo '<li class="choose_prod_sort ';

    if($stock->getQuantity()<=0 and $rs['is_stock']=='Oui')
                            {
                            echo 'text-danger ';
                            }


    echo '" data-id="'.$rs['prod_id'].'" onclick="set_item(\''.$prod_name.'\')">'.$prod_name.'->(<b>'.$qt.'</b>)</li>';

}
?>
