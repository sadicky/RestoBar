<?php
@session_start();
require_once '../load_model.php';
$jour= new BeanJournal();
$trans= new BeanTransactions();
$pers= new BeanPersonne();

/*if(empty($_GET['pos']))
{
$datas=$jour->select_all_by_date('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['pos']);
}
else
{*/
 $datas=$jour->select_all_by_date_pos($_GET['from_d'],$_GET['to_d'],$_GET['pos'],$_GET['choix']);
//}
?>

<div class="col-md-12">
                            <h4 class="box-title m-b-0">Historique des Journaux de Caisse Du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / POs :
                                <?php
                                $pers->select($_GET['pos']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
<div class="table-responsive">
	<table id="example23" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
		<thead>
        <tr>
            <th>#N°</th><th>Début</th><th>Fin</th><th>Caissier</th><th>Ouverture</th><th>Clôturé</th><th>Final (Après Validation)</th><th>Validé</th><th>Etat</th><th>-</th><th>-</th>
        </tr>
      </thead>
        <tbody>
									<?php
                                    $tot2=0;
                                    $tot=0;
                                    $i=1;
                                    foreach ($datas as $un) {
                                        /*$dif=$un['closing_bal']-$un['open_bal'];
                                        if($dif<0)
                                        {
                                            $dif=0;
                                        }*/
                                        /*if($un['closing_bal']>0)
                                        {*/
                                        $tot += $un['final_bal'];
                                        $tot2 += $un['closing_bal'];

                                        $pers->select($un['personne_id']);
            echo '<tr ';
            if($tot2<>$tot and $un['jour_type']=='Caissier')
            {
                echo 'class="text-danger"';
            }
            echo '><td>'.$i.'</td><td>'.$un['start_date'].'</td><td> '.$un['end_date'].'</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['open_bal'],0,'.',',').'</td><td>';

            if($un['closing_bal']>0)
            echo number_format($un['closing_bal'],0,'.',',');
            else
            echo number_format($trans->select_bal_jour_admin($un['jour_id']),0,'.',',').' (balance encours)';

            echo '</td><td>'.number_format($un['final_bal'],0,'.',',').'</td>';
            echo '<td>';

            if($un['valid']==1 and $un['jour_type']=='Caissier')
            {
                echo 'Oui (<a href="javascript:void(0)" class="btn btn-light btn-sm valid_jour" id="'.$un['jour_id'].'" data-id="'.$un['valid'].'"><i class="fa fa-times"></i></a>)';
            }
            elseif($un['valid']==1 and $un['jour_type']=='Vendeur')
            {
              echo 'Non';
            }
            else
            {
                echo '-';
            }
            echo '</td><td>';
            //number_format($dif,0,'.',',')

                if($un['jour_state']<>'1')
                {
                echo 'Cloturé';
                }
                else
                {
                  echo 'Ouvert';
                }

               
            echo '</td><td><a href="javascript:void(0)" class="btn btn-light btn-sm transact_jour" data-id="'.$pers->getNomComplet().'" id="'.$un['jour_id'].'" title="details journal:'.$un['jour_id'].'"><i class="fa fa-plus"></i></a></td><td>';

            if($un['jour_state']=='0')
            {
            echo '<a href="javascript:void(0)" class="btn btn-light btn-sm retreat_jour" id="'.$un['jour_id'].'" data-id="'.$un['valid'].'"><i class="fa fa-folder"></i></a>';
            }
            else
            {
              echo '<a href="javascript:void(0)" class="btn btn-light btn-sm retreat_jour" id="'.$un['jour_id'].'" data-id="'.$un['valid'].'"><i class="fa fa-minus"></i></a>';
            }

                echo'</td></tr>';
                $i++;
            //}
                                }
                                    ?></tbody>
                                    <tfoot>
            <tr><th>Totaux</th><th>-</th><th>-</th><th>-</th><th>-</th><th><?php echo $pers->nb_format($tot2);?></th><th><?php echo $pers->nb_format($tot);?></th><th>-</th><th>-</th><th>-</th><th>-</th></tr>
									</tfoot>

							 </table>
    </div>
</div>

