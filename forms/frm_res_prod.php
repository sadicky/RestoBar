<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod= new BeanProducts();
$stock=new BeanStock();
$vente= new BeanVente();
$vente->select($_SESSION['op_vente_id']);
$dat=$prod->select_all_srch_cat($_POST['cat'],$_POST['prod']);
if($_SESSION['cmd']!='' and !empty($vente->getAssId()))
{
	foreach ($dat as $un) {
		$stock->select($un['prod_id'],$_SESSION['pos']);
		if(($stock->getQuantity()<=0) and $un['is_stock']=='Oui')
		{
			if(!empty($_POST['prod']))
			{
				echo '<div class="rounded p-0 m-1 border border-danger" style="display:inline-block; padding:0px;"><a href="javascript:void(0)" id="1" data-id="'.$un['prod_id'].'" class="btn btn-danger btn-sm  ch_prod" style="font-size:12px;"><b>'.$un['prod_code'].'</b>-'.$un['prod_name'].'</a>
				<input type="number" value="1" name="qt" class="qt_'.$un['prod_id'].' m-0" style="width:60px; display:inline; border-style:none; margin:0 font-size:12px;" valign="center"/></div>';
			}
		}
		else
		{
			if(!empty($_POST['prod']))
			{
				echo '<div class="rounded p-0 m-1 border border-warning" style="display:inline-block; padding:0px;"><a href="javascript:void(0)" id="1" data-id="'.$un['prod_id'].'" class="btn btn-warning btn-sm  ch_prod" style="font-size:12px;"><b>'.$un['prod_code'].'</b>-'.$un['prod_name'].'</a>
				<input type="number" value="1" name="qt" class="qt_'.$un['prod_id'].' m-0" style="width:60px; display:inline; border-style:none; margin:0 font-size:12px;" valign="center"/></div>';
			}

		}
	}
}
else
{
	 echo '<h1 style="font-weight:bold">Ajouter la commande cliquez sur la commande ou choisir le serveur</h1>';
}
?>