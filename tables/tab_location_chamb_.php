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


$chambId=$_POST['chamb_id'];
$chamb->select($chambId);
$cat->select($chamb->getCategoryId());

$complete=false;

       if(!empty($_POST['op_id']))
		{
			$complete=true;
			//$loc->select_chamb($chambId,'1');
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

?>
<input type="hidden" name="op_id_loc" id="op_id_loc" value="<?php echo $_POST['op_id']; ?>">
<div class="row">
	<div class="col-md-4">
<form>
<div class="form-row">
<div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Catégorie</label>
            <select id="select_cat_chamb"  name="cat_id" class="form-control">
                <option value="">Choisir Catégorie</option>
                <?php
                $datas=$cat->select_all_type('Hebergement');
                foreach ($datas as $key => $un) {
                    echo '<option value="'.$un['category_id'].'">'.$un['category_name'].'</option>';
                    
                }
                ?>
             </select>
        </div>
</div>
<div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Chambre</label>
            <select id="select_chamb_loc"  name="chamb_id" class="form-control">
                <option value="">Choisir Chambre</option>
                <?php
                $datas=$chamb->select_all();
                foreach ($datas as $key => $un) {
                	if($un['chamb_id']==$chambId)
                    echo '<option value="'.$un['chamb_id'].'" selected>'.$un['chamb_num'].'</option>';
                	else
                	echo '<option value="'.$un['chamb_id'].'">'.$un['chamb_num'].'</option>';
                    
                }
                ?>
             </select>
        </div>
</div>
</div>
</form>

		<table class="table table-sm table-bordered table-striped">
			<tr><th>Chambre No</th><td><?php echo $chamb->getChambNum(); ?></td></tr>
			<tr><th>Prix</th><td><?php echo $pers->nb_format($chamb->getChambPrice()); ?></td></tr>
			<tr><th>Etat</th><td><?php 
			if($chamb->getChambEtat()=='1')
			echo '<span class="text-success" style="font-weight:bold">Disponible</span>';
			else
			echo '<span class="text-danger"  style="font-weight:bold">Occupé</span>';
			 ?></td></tr>
			<tr><th>Categorie</th><td><?php echo $cat->getCategoryName(); ?></td></tr>
			<tr><th>Caracteristique</th><td><?php echo $chamb->getChambCara(); ?></td></tr>
			<?php
			if($chamb->getChambEtat()=='0')
			{
				echo '<tr><td colspan="2"><button class="btn btn-danger btn-sm cancel_loc" id="'.$chambId.'" data-id="'.$loc->getLocId().'"><i class="fa fa-times"></i> Annuler</button></td></tr>';
			}
			?>
		</table>
		<?php
		if(isset($_SESSION['op_loc_id']) and !empty($_SESSION['op_loc_id']))
		{
			?>

<span style="display: none;"><?php include('tab_facture_loc.php');?></span>

<a href="javascript:void(0)" id="<?php echo $_SESSION['op_loc_id']; ?>" class="btn btn-sm btn-info mr-2 mt-2 close_location"><i class="fa fa-save"></i> Cloturer</a>

<a href="javascript:void(0)" id="print_facture_loc" data-id="<?php //echo $pay; ?>" class="btn btn-sm btn-success mr-2 mt-2"><i class="fa fa-print"></i> Facture</a>

<?php
            if($fact->getLocTva()=='1')
            {
                ?>
            <a id="add_det_hot_tva" data-id="<?php echo $_SESSION['op_loc_id']; ?>" href="javascript:void(0)" class="btn btn-sm btn-danger  mr-2 mt-2"> TVA </a>
            <input type="hidden" id="val_tva" name="val_tva" value="0">
            <?php
            }
            else
            {
              ?>
            <a id="add_det_hot_tva" data-id="<?php echo $_SESSION['op_loc_id']; ?>" href="javascript:void(0)" class="btn btn-sm btn-success  mr-2 mt-2"> TVA </a>
            <input type="hidden" id="val_tva" name="val_tva" value="1">
            <?php
            }
            ?>

<hr>
<div class="table-responsive">
		<table class="table table-sm table-bordered table-striped">
			<thead>
				<tr><th>Chambre No</th><th>Du</th><th>Au</th><th>Nb Jrs</th><th>Tot</th></tr>
			</thead>
			<tbody>
				<?php
				$datas=$loc->select_all($_SESSION['op_loc_id']);
				$cout=0;
				foreach ($datas as $key => $value) {
					$to_day=date('Y-m-d');
					$chamb->select($value['chamb_id']);
					$test=$loc->dateDiff($value['from_d'],$to_day);

					echo '<tr><td>'.$chamb->getChambNum();
					if($test<0) echo '<br>(Reservation)';
					echo '</td><td>'.$value['from_d'].'</td><td>'.$value['to_d'].'</td><td>';
			
			 if($chamb->getChambEtat()=='0') { $nb_days=$fact->dateDiff($value['from_d'],$to_day);}
              else { $nb_days=$fact->dateDiff($value['from_d'],$value['to_d']); }

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

					echo '</td><td>'.$pers->nb_format($price_day).'</td></tr>';
			
				}

				$cout=$cout-$fact->getLocRed();
				if($fact->getLocTva()=='1') $tot_tva=$cout*0.18;
				else
				$tot_tva=0;

				?>
			</tbody>
			<tfoot>
				<tr><th colspan="4">Totaux</th><th><?php echo $pers->nb_format($cout); ?></th></tr>
				<tr><th colspan="4">Réduction</th><th><?php echo $pers->nb_format($fact->getLocRed()); ?></th></tr>
				<tr><th colspan="4">Payé</th><th><?php echo $pers->nb_format($p['paie']); ?></th></tr>
				<tr><th colspan="4">PTHTVA</th><th><?php echo $pers->nb_format($cout-$tot_tva); ?></th></tr>
				<tr><th colspan="4">TVA</th><th><?php echo $pers->nb_format($tot_tva);
				 ?></th></tr>
				 <tr><th colspan="4">PTTVAC</th><th><?php echo $pers->nb_format($cout);
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
		include('../forms/frm_client.php');
		 ?>
	</div>
	<div class="col-md-4">
		<?php 
		include('../forms/frm_location.php');
		 ?>
	</div>
</div>