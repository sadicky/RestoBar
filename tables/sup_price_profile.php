
<?php 
session_start();
require_once '../load_model.php';
$acc = new BeanAccounts();
$pers = new BeanPersonne();
$acc->select($_SESSION['sup_id']);
$pers->select($acc->getPersonneId());
?>

<div class="row">
<div class="col-md-12 well">	
<img src="img&design/<?php echo $pers->getPhoto(); ?>" class="img-circle" style="width:30%;"/>
<p>Nom : <?php echo $pers->getNom(); ?></p>
<p>Prénom : <?php echo $pers->getPrenom(); ?></p>
<p>Role : <?php echo $pers->getRole(); ?></p>
<p>Balance Cash : <?php echo $acc->getBalCash(); ?></p>
</div>


</div>

