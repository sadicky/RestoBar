<?php
require_once '../load_model.php';
$stock= new BeanStock();

$datas=$stock->select_all_prod($_POST['prodId'],$_POST['posId'],$_POST['tarId']);

/*echo '<option value="">Choisir Exp :</option>';*/
$next=date('Y')+10;
$today=$next.'/12/31';
$i=0;
foreach ($datas as $key => $value) 
{
	if($value['quantity']>0)
	{
	echo '<option value='.$value['date_exp'].'"><b>'.$value['quantity'].'</b> - Exp :'.date('m/y',strtotime($value['date_exp'])).'</option>';
	}
	$i++;
}
if($i==0)
{
echo '<option value="'.$today.'">Aucun</option>';
}
?>