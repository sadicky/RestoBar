<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$perso=new BeanPersonne();
$paie=new BeanPaiement();
$info=new BeanInfoSuppl();
$det_client=new BeanInfoSuppl();
$vente= new BeanVente();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$perso_client=new BeanPersonne();
$pos=new BeanPersonne();

?>
<section class="form-row">
<?php
$vente->select($_SESSION['op_vente_id']);
//ajout
$op->select($_SESSION['op_vente_id']);
/*fin ajout*/
if(!isset($_SESSION['op_vente_num']))
{
$_SESSION['op_vente_num']=$vente->getNumVente();
}
            ?>
<div class="col-md-12">
<div class="card">
<div class="card-header bg-light">
Facture N° : <?php if(isset($_SESSION['op_vente_num']) and !empty($_SESSION['op_vente_num'])){echo $_SESSION['op_vente_num'];}else {echo '?';} ?>

</div>
<div class="card-body" style="">
<div class="row">
<div class="col-md-7">
<?php
$op->select($_SESSION['op_vente_id']);
include('frm_vente.php');
?>
<!-- <div class="col-md-12"> -->
<?php
include('../tables/tab_fact_vente_non_paie.php');
?>
 <!-- </div> -->
</div>
<div class="col-md-5" id="current_det_vente">
<?php
include('../tables/tab_det_vente.php');
?>
 </div>
 
</div>
</div>
</div>
</div>

</section>
