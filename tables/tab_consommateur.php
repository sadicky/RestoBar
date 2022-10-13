<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$customer= new BeanCustomer();
$info=new BeanInfoSuppl();
$datas=$perso->select_all_role('customer');
?>

                    <div class="white-box">
                            <h2>Clients</h2>
                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-sm btn-primary btn-rounded" id="new_customer"> <i class="fa fa-plus"></i> Nouveau</a> 

							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Nom & Prénom</th><th>Sexe</th><th>NIF</th><th>Adresse</th><th>CNI</th><th>Nationalité</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $customer->select($un['personne_id']);
                             $info->select($un['personne_id']);
                             
                             echo '<tr><td class="fiche_cli" data-id="'.$un['personne_id'].'" id="'.$un['nom_complet'].'" style="cursor:pointer;"> <i class="fa fa-hand-o-right fa-fw"></i> '.$un['nom_complet'].'</td><td>'.$un['genre'].'</td><td>'.$un['contact'].'</td><td>'.$un['email'].'</td><td>'.$info->getCni().'</td><td>'.$info->getNat().'</td>';

                             echo '<td>';

                            echo '<button class="btn btn-sm btn-warning btn-circle update_cust" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                            if(!$perso->exist_party($un['personne_id'])){
                            echo '<button class="btn btn-sm btn-danger btn-circle delete_cust" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
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
