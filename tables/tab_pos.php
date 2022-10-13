<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$pos= new BeanPos();
$datas=$perso->select_all_role('pos');
?>

                    <div class="white-box">
                            <h3 class="box-title m-b-0">Point de vente</h3>
                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-rounded" id="new_pos"> <i class="fa fa-plus"></i> Nouveau</a> <a href="javascript:void(0)" class="btn btn-warning btn-rounded" id="trash_pos"> <i class="fa fa-trash"></i> Corbeille</a></p>

							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Stock</th><th>Type</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $pos->select($un['personne_id']);
                             
                             echo '<tr><td>'.$un['nom_complet'].'</td><td>';
                             if($pos->getActif()=='1'){echo 'Vente'; } else { echo 'Reserve';}
                             echo '</td>';

                             echo '<td>';

                            echo '<button class="btn btn-warning btn-circle btn-sm update_pos" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td>';

                             echo '<td>';
                            if(!$perso->exist_pos($un['personne_id'])){
                            echo '<button class="btn btn-sm btn-danger btn-circle delete_pos" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                 }
                                  else {
                                    /*echo '<button class="btn btn-sm btn-success btn-circle delete_cust" id="'.$un['personne_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';*/

                                    echo '-';

                                    }

                             echo '</td>';
                             echo '</tr>';
                             
                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
