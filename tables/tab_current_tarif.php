<?php
@session_start();
require_once '../load_model.php';
$price= new BeanPrice();
$price2= new BeanPrice();
$prod=new BeanProducts();
$pers=new BeanPersonne();
$datas=$prod->select_all_crt_tar($_POST['rech'],$_SESSION['pos']);
?>
<h5>Tarifs</h5>
<table class="table table-striped table-bordered table-hover table-sm">
	<thead>
		<tr><th>Libellé</th><th>Qt</th><th>Prix</th></tr>
	</thead>
	<tbody>
		<?php
		foreach ($datas as $key => $value) {
			echo '<tr><td>'.$value['prod_name'].'</td><td>'.$value['quantity'].'</td><td>'.number_format($value['prod_price'],0,'.',',').'</td></tr>';
		}
		?>
	</tbody>
</table>  