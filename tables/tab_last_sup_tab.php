<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$supplier= new BeanSupplier();
$datas=$perso->select_all_role_date('supplier',date('Y-m-d'));
?>

                    <div class="white-box">

							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                        <th>Code</th><th>Nom</th><th>Tel</th><th>E-mail</th><th>NIF</th><th>Personne de Contact</th><th>Nationalité</th><th>Statut</th><th>&nbsp;</th><th>&nbsp;</th>
                            </thead>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $supplier->select($un['personne_id']);

                             echo '<tr><td>'.$supplier->getSupCode().'</td><td>'.$un['nom_complet'].'</td><td>'.$un['contact'].'</td><td>'.$un['email'].'</td><td>'.$supplier->getSupNif().'</td><td>'.$supplier->getSupContact().'</td><td>'.$supplier->getSupNat().'</td><td>';
                             if($supplier->getActif()=='1'){echo 'Actif'; } else { echo 'suspendu';}
                             echo '</td>';


                             echo '</td><td>';

                            echo '<button class="btn btn-warning btn-sm btn-circle update_sup" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                            if($supplier->getActif()=='1'){
                            echo '<button class="btn btn-danger btn-sm btn-circle delete_sup" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                 }
                                  else {
                                    echo '<button class="btn btn-success btn-sm btn-circle delete_sup" id="'.$un['personne_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';

                                    }

                             echo '</td>';
                             echo '</tr>';

                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
