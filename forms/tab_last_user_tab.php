<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$user= new BeanUsers();
$datas=$perso->select_all_role_date('users',date('Y-m-d'));
?>

                    <div class="white-box">
							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Pseudo</th><th>Nom Complet</th><th>Genre</th><th>Niveau</th><th>POS</th><th>Fonction</th><th>Menu</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $user->select_2($un['personne_id']);
                             $perso->select($user->getPosId());

                             echo '<tr><td>'.$user->getUserName().'</td><td>'.$un['nom_complet'].'</td><td>'.$un['genre'].'</td><td>'.$user->getLevelUser().'</td><td>'.$perso->getNomComplet().'</td>';
                              echo '<td>'.$user->getTypeUser().'</td><td>';

                             echo '<button id="'.$un['personne_id'].'" class="attrib_menu btn btn-sm btn-primary btn-circle"><i class="fa fa-plus"></i></button>';

                             echo '</td><td>';

                            echo '<button class="btn btn-sm btn-warning btn-circle update_ut" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                            if($user->getActif()=='1'){
                            echo '<button class="btn btn-danger btn-sm btn-circle delete_ut" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                 }
                                  else {
                                    echo '<button class="btn btn-sm btn-success btn-circle delete_ut" id="'.$un['personne_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';

                                    }

                             echo '</td>';
                             echo '</tr>';

                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
