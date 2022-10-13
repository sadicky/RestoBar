<?php
@session_start();
require_once '../load_model.php';
$jour= new BeanJournal();
$pers= new BeanPersonne();

 $datas=$jour->select_all_by_valid('0');
?>

<div class="col-md-12">
                            <h4 class="box-title m-b-0">Journaux des Caissiers à valider</h4>
                            <hr>
<div class="table-responsive">
	<table id="example23" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
		<thead>
        <tr>
            <th>Début</th><th>Fin</th><th>Caissier/Vendeur</th><th>Ouverture</th><th>Clôture</th><th>Final</th><th>Comment</th><th>Valid</th>
        </tr>
      </thead>
        <tbody>
									<?php
                                    $i=1;
                                    foreach ($datas as $un) {
            if($un['jour_type']=='Caissier')
            {
            $pers->select($un['personne_id']);
            if($un['closing_bal']>0)
            {
            echo '<tr><td>'.$un['start_date'].'</td><td> '.$un['end_date'].'</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['open_bal'],0,'.',',').'</td><td>'.number_format($un['closing_bal'],0,'.',',').'</td><td contenteditable="true" class="edit_final" id="'.$un['jour_id'].'">'.$un['final_bal'].'</td>';
             
            echo '<td contenteditable="true" class="edit_comment" id="'.$un['jour_id'].'">'.$un['comment'].'</td>';
            
            echo '<td>';
            if($un['valid']=='0')
            {
            echo '<a href="javascript:void(0)" class="btn btn-light btn-sm valid_jour" id="'.$un['jour_id'].'" data-id="'.$un['valid'].'"><i class="fa fa-check"></i></a>';
            }
            else
            {
              echo '<a href="javascript:void(0)" class="btn btn-light btn-sm valid_jour" id="'.$un['jour_id'].'" data-id="'.$un['valid'].'"><i class="fa fa-times"></i></a>';
            }
            

            echo '</td></tr>';
            $i++;
         }
        }
        }
                                    ?>
          </tbody>
                                    <tfoot>
            <tr><th>Totaux</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th></tr>
				</tfoot>						

							 </table>
    </div>
</div>

