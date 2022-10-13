<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$chamb=new BeanChambre();
$loc=new BeanLocation();
$fact=new BeanLocationFact();
$pers=new BeanPersonne();
$perso_client=new BeanPersonne();
$perso=new BeanPersonne();
$pers2=new BeanPersonne();
$op=new BeanOperation();
$info=new BeanInfoSuppl();
$paie=new BeanPaiement();

$complete=false;
if(isset($_SESSION['op_loc_id']))
       {
       	$complete=true;
       		$op->select($_SESSION['op_loc_id']);
			$pers->select($op->getPartyCode());
			$info->select($op->getPartyCode());
			$fact->select($_SESSION['op_loc_id']);

			$p=$paie->select_sum_op($_SESSION['op_loc_id']);
 
?>
<div class="row">
	<div class="col-md-4">
<span style="display: none;"><?php include('tab_facture_loc.php');?></span>

<a href="javascript:void(0)" id="<?php echo $_SESSION['op_loc_id']; ?>" class="btn btn-sm btn-info mr-2 mt-2 close_location"><i class="fa fa-save"></i> Cloturer</a>

<a href="javascript:void(0)" id="print_facture_loc" data-id="<?php //echo $pay; ?>" class="btn btn-sm btn-success mr-2 mt-2"><i class="fa fa-print"></i> Facture</a>

<hr>
<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped">
			<thead>
				<tr><th>Chambre / Salle</th><th>Arrivée</th><th>Départ</th><th>Nbre de nuitées</th><th>Total</th></tr>
			</thead>
			<tbody>
				<?php
				$datas=$loc->select_all($_SESSION['op_loc_id']);
				$cout=0;
				foreach ($datas as $key => $value) {
					$to_day=date('Y-m-d');
					$chamb->select($value['chamb_id']);
					$test=$loc->($value['from_d'],$to_day);

					echo '<tr><td>'.$chamb->getChambNum();
					if($test<0) echo '<br>(Reservation)';
					echo '</td><td>'.$value['from_d'].'</td><td>'.$value['to_d'].'</td><td>';
			
			 if($value['loc_etat']=='1') { $nb_days=$fact->($value['from_d'],$value['to_d']);}
              else { $nb_days=$fact->($value['from_d'],$value['to_d']); }

			if($nb_days<=0) $nb_days=1;
			echo $nb_days;
			$cout +=$nb_days*$value['loc_price'];
					echo '</td><td>'.$pers->nb_format($nb_days*$value['loc_price']).'</td></tr>';
				}
				?>
			</tbody>
			<tfoot>
				<tr><th colspan="4">Total</th><th><?php echo $pers->nb_format($cout); ?></th></tr>
				<tr><th colspan="4">Réduction</th><th><?php echo $pers->nb_format($fact->getLocRed()); ?></th></tr>
				<tr><th colspan="4">Payé</th><th><?php echo $pers->nb_format($p['paie']); ?></th></tr>
				<tr><th colspan="4">PTHTVA</th><th><?php echo $pers->nb_format($cout-$fact->getLocRed()-$p['paie']); ?></th></tr>
			</tfoot>
				
		</table>
	</div>
	</div>
	<div class="col-md-4">
		<?php 
		include('../forms/frm_client.php');
		 ?>
	</div>
	<div class="col-md-4">
		<?php 
		include('../forms/frm_location_paie.php');
		 ?>
	</div>
</div>
<?php

}
?>