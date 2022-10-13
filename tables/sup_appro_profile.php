
<?php 
session_start();
require_once '../load_model.php';
$acc = new BeanAccounts();
$pers = new BeanPersonne();
$price = new BeanPrice();
$prod= new BeanProducts();
$stock= new BeanStock();

$acc->select($_SESSION['sup_id']);
$pers->select($acc->getPersonneId());
$datas=$price->select_all($_SESSION['sup_id']);
?>

<div class="row">
<div class="col-md-3 well">	
<img src="img&design/<?php echo $pers->getPhoto(); ?>" class="img-circle" style="width:50%;"/>
<p>Nom : <?php echo $pers->getNom(); ?></p>
<p>Prénom : <?php echo $pers->getPrenom(); ?></p>
<p>Role : <?php echo $pers->getRole(); ?></p>
<p>Cash : <?php echo $acc->getBalCash(); ?></p>
<p><button class="btn btn-success nv_appro">Nouveau Appro</button></p>
</div>

<div class="col-md-9 well">
	<h3 class="box-title m-b-0">Produits</h3>
	<hr>
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed" id="prod_sup">
<thead>
<tr><th>Products</th><th>Prix</th><th>s_qty</th><th>s_weight</th><th>ns_qty</th>
	<th>ns_weight</th></tr>	
</thead>
<tbody>
<?php 
    foreach ($datas as $un) {
    $prod->select($un['prod_id']);
    $stock->select($un['prod_id']);
if($un['state']=='1')
                                        {
    echo '<tr class="row_prod" data-id='.$un['price_id'].' style="cursor:pointer"><td>'.$prod->getProdName().'</td><td>'.$un['price'].'</td><td>'.$stock->getSQuantity().'</td><td>'.$stock->getSWeight().'</td><td>'.$stock->getNsQuanity().'</td><td>'.$stock->getNsWeight().'</td></tr>';
    }	
	    }
?>
</tbody>	
</table>
</div>	
</div>	

</div>

