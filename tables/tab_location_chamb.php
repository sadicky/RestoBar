<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$pr= new BeanPlace();
$chamb=new BeanPlace();
$loc=new BeanLocation();
$fact=new BeanLocationFact();
$pers=new BeanPersonne();
$perso_client=new BeanPersonne();
$perso=new BeanPersonne();
$pers2=new BeanPersonne();
$op=new BeanOperation();
$info=new BeanInfoSuppl();
$paie=new BeanPaiement();
$vente=new BeanVente();
$det=new BeanDetailsOperation();
$prod=new BeanProducts();
$bq=new BeanBanque();
$paie=new BeanPaiement();
$trans=new BeanTransactions();
$aut=new BeanAutreFrais();

$chambId=$_POST['chamb_id'];
$chamb->select_2($chambId);
$cat->select($chamb->getPlaceParent());

$complete=false;

       if(!empty($_POST['op_id']))
		{
			$complete=true;
			$loc->select_chamb($chambId,'1');
			$_SESSION['op_loc_id']=$_POST['op_id'];

			$op->select($_SESSION['op_loc_id']);
			$pers->select($op->getPartyCode());
			$info->select($op->getPartyCode());
			$fact->select($_SESSION['op_loc_id']);

			$p=$paie->select_sum_op($_SESSION['op_loc_id']);
		}
		else
		{
			unset($_SESSION['op_loc_id']);
		}

$cout=0
?>
<input type="hidden" name="op_id_loc" id="op_id_loc" value="<?php echo $_POST['op_id']; ?>">
<div class="row">
	<div class="col-md-4">
<form>
<div class="form-row">
<div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Catégorie</label>
            <select id="select_cat_chamb"  name="cat_id" class="custom-select">
                <option value="">Choisir Catégorie</option>
                <?php
                $datas=$chamb->select_all_place();
                foreach ($datas as $key => $un) {
                	if($un['status']==2)
                    echo '<option value="'.$un['place_id'].'">'.$un['place_lib'].'</option>';
                    
                }
                ?>
             </select>
        </div>
</div>
<div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Chambre</label>
            <select id="select_chamb_loc"  name="chamb_id" class="custom-select">
                <option value="">Choisir Chambre ou salle</option>
                <?php
                $datas=$chamb->select_all_2();
                foreach ($datas as $key => $un) {
                	if($un['place_id']==$chambId)
                    echo '<option value="'.$un['place_id'].'" selected>'.$un['place_num'].'</option>';
                	else
                	{
                	$pr->select_2($un['place_parent']);
                	if($pr->getStatus()==2)
                	echo '<option value="'.$un['place_id'].'">'.$un['place_num'].'</option>';
                	}
                    
                }
                ?>
             </select>
        </div>
</div>
</div>
</form>

		<table class="table table-sm table-bordered table-striped">
			<tr><th>Chambre / Salle</th><td><?php echo $chamb->getPlaceNum(); ?></td></tr>
			<tr><th>Prix</th><td><?php echo $pers->nb_format($chamb->getPlacePrice()); ?></td></tr>
			<tr><th>Etat</th><td><?php 
			if($chamb->getStatus()=='1')
			echo '<span class="text-success" style="font-weight:bold">Disponible</span>';
			else
			echo '<span class="text-danger"  style="font-weight:bold">Occupé</span>';
			 ?></td></tr>
			<tr><th>Categorie</th><td><?php $pr->select_2($chamb->getPlaceParent());echo $pr->getPlaceLib(); ?></td></tr>
			
			<?php

			if($chamb->getstatus()=='0')
			{
				echo '<tr><td colspan="2"><button class="btn btn-danger btn-sm change_st2" id="'.$chambId.'" data-id="'.$loc->getLocId().'"><i class="fa fa-times"></i> Libérer</button></td></tr>';
			}

			?>
		</table>
		<?php
		if(isset($_SESSION['op_loc_id']) and !empty($_SESSION['op_loc_id']))
		{
			?>

<span style="display: none;"><?php //include('tab_facture_loc.php');?></span>

<a href="javascript:void(0)" id="<?php echo $_SESSION['op_loc_id']; ?>" class="btn btn-sm btn-info mr-2 mt-2 close_location"><i class="fa fa-save"></i> Cloturer</a>

<a href="javascript:void(0)" id="print_facture_loc" data-id="<?php //echo $pay; ?>" class="btn btn-sm btn-success mr-2 mt-2"><i class="fa fa-print"></i> Facture</a>

<hr>
<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped">
			<thead>
				<tr><th>Chambre / Salle</th><th>Arrivée</th><th>Départ</th><th>Prix</th><th>Nbre de nuitées</th><th>Total</th><th>-</th></tr>
			</thead>
			<tbody>
				<?php
				$datas=$loc->select_all($_SESSION['op_loc_id']);
				$cout=0;
				foreach ($datas as $key => $value) {
					$to_day=date('Y-m-d');
					$chamb->select_2($value['chamb_id']);
					$test=$loc->dateDiff($value['from_d'],$to_day);

					echo '<tr><td>'.$chamb->getPlaceNum();
					if($test<0) echo '<br>(Reservation)';
					echo '</td><td class="edit_loc" contenteditable="true" id="'.$value['loc_id'].'" data-id="from_d">'.$value['from_d'].'</td><td class="edit_loc" contenteditable="true" id="'.$value['loc_id'].'" data-id="to_d">'.$value['to_d'].'</td><td class="edit_loc" contenteditable="true" id="'.$value['loc_id'].'" data-id="loc_price">'.$value['loc_price'].'</td><td>';
			
			/* if($chamb->getStatus()=='0') { $nb_days=$fact->dateDiff($value['from_d'],$to_day);}

              else {*/ $nb_days=$fact->dateDiff($value['from_d'],$value['to_d']); //}

			if($nb_days<=0) $nb_days=1;
			if($value['loc_type']=='Location')
			{
			echo $nb_days;
			$price_day=$nb_days*$value['loc_price'];
			$cout +=$price_day;
			}
			else
			{
				echo '0';
				$price_day=0;
			}

					echo '</td><td>'.$pers->nb_format($price_day).'</td><td>';
					//if($un['is_paid']=='0')
                                    echo ' <a href="javascript:void(0)" class="cancel_loc2" id="'.$value["chamb_id"].'" data-id="'.$value["loc_id"].'"><span class="fa fa-times"></span></a> ';
					echo '</td></tr>';
			
				}

				
				if($fact->getLocTva()=='1') $tot_tva=$cout*0.18;
				else
				$tot_tva=0;

				?>
			</tbody>
			<tfoot>
				<tr><th colspan="6">Total</th><th><?php echo $pers->nb_format($cout); ?></th></tr>
				<tr><th colspan="6">Réduction</th><th><?php echo $pers->nb_format($loc->getLocRed()); $cout -=$loc->getLocRed();?></th></tr>
				<!-- <tr><th colspan="4">PT.HTVA</th><th><?php //echo $pers->nb_format($cout-$tot_tva); ?></th></tr>
				<tr><th colspan="4">TVA</th><th><?php //echo $pers->nb_format($tot_tva);
				 ?></th></tr>
				 <tr><th colspan="4">PT.TVAC</th><th><?php //echo $pers->nb_format($cout);
				 ?></th></tr> -->
				 <tr><th colspan="6">Payé</th><th><?php echo $pers->nb_format($p['paie']); ?></th></tr>
				 <tr><th colspan="6">Restant Du</th><th class="text-danger"><?php $cout -=$p['paie']; echo $pers->nb_format($cout); 
				 ?></th></tr>
			</tfoot>
				
		</table>
	</div>
			<?php
		}
		?>
	</div>
	<div class="col-md-4">
		<?php 
		include('../forms/frm_customer_hot.php');
		include('tab_det_vente_loc.php');
		 ?>

	</div>
	<div class="col-md-4">
		<?php
		//$pay_fact=$cout-$p['paid']; 
		$pay=$cout;
		include('../forms/frm_location.php');
		 ?>

		 <?php
if(isset($_SESSION['op_loc_id']) and !empty($_SESSION['op_loc_id']))
{
include('../forms/frm_cust_paie_hot.php'); 
}
        ?> 
	</div>
</div>