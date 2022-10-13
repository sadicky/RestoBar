
<?php
require_once '../load_model.php';
$acc = new BeanAccounts();
$pers = new BeanPersonne();
$acc->select($_GET['acc_id']);
$pers->select($acc->getPersonneId());
?>
<span id="sup_acc_id" data-id="<?php echo $_GET['acc_id']; ?>"></span>
<img src="upload/<?php echo $pers->getPhoto(); ?>" class="img-circle" style="width:50%;"/>
<p>Fournisseur : <?php echo $pers->getNomComplet(); ?></p>
<p>Tél : <?php echo $pers->getContact(); ?></p>
<p>N° Compte : <?php echo $acc->getAccNum(); ?></p>
