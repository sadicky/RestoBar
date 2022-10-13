<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$pos= new BeanPos();
$datas=$perso->select_all_role_date('pos',date('Y-m-d'));
?>

                    <div class="white-box">
							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Point de vente</th><th>Statut</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $pos->select($un['personne_id']);

                             echo '<tr><td>'.$un['nom_complet'].'</td><td>';
                             if($pos->getActif()=='1'){echo 'Actif'; } else { echo 'suspendu';}
                             echo '</td>';

                             echo '<td>';

                            echo '<button class="btn btn-warning btn-circle update_pos" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                            if($pos->getActif()=='1'){
                            echo '<button class="btn btn-danger btn-circle delete_pos" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                 }
                                  else {
                                    echo '<button class="btn btn-success btn-circle delete_pos" id="'.$un['personne_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';

                                    }

                             echo '</td>';
                             echo '</tr>';

                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
