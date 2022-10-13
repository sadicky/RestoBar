<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$ass= new BeanServeur();
$datas=$perso->select_all_role('server');
?>

                    <div class="white-box">
                            <h3 class="box-title m-b-0">Serveurs</h3>
                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-rounded btn-sm" id="new_ass"> <i class="fa fa-plus"></i> Nouveau</a></p>

							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Code</th><th>Nom & Prénom</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $ass->select($un['personne_id']);
                             /*if($ass->getActif()==$_POST['status'])
                             {*/
                             echo '<tr><td>'.$un['contact'].'</td><td>'.$un['nom_complet'].'</td><td>';

                            echo '<button class="btn btn-warning btn-circle btn-sm update_ass" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                            
                            echo '<button class="btn btn-danger btn-sm btn-circle delete_ass" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                 
                             echo '</td>';
                             echo '</tr>';
                             //}
                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
