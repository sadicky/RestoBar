<?php
@session_start();
require_once '../load_model.php';
$prod= new BeanProducts();
$stock=new BeanStock();



if(empty($_POST['keyword'])){$keyword='-*';}else{$keyword=$_POST['keyword'];}

$list=$prod->select_all_srch_prod($keyword);

$i=0;
foreach ($list as $rs) {
	$stock->select($rs['prod_id'],$_SESSION['pos']);
    $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['prod_name']);
   echo '<li class="choose_prod ';
   if($stock->getQuantity()<=0) echo 'text-danger';
   echo '"  id="'.$rs['prod_id'].'" data-id="'.$rs['prod_name'].'">'.$name.' ('.$stock->getQuantity().')</li>';
   $i++;
}

if($i>0)
{
echo '<li class="choose_prod choose_lot"  id="0" data-id="Aucun">Aucun</li>';
}
?>
