<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$supplier= new BeanSupplier();
$datas=$perso->select_all_role('supplier');
?>

                    <div class="white-box">
                            <h3 class="box-title m-b-0">Paiement des Fournisseurs</h3>
                            
							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                 <tr>
                                 <th>Code</th><th>Nom</th><th>Tel</th>
                                        </tr>
                            </thead>

                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                             $supplier->select($un['personne_id']);
                             
                             echo '<tr><td> <a href="javascript:void(0)" class="fiche_four btn btn-primary btn-sm" data-id="'.$un['personne_id'].'" id="'.$un['nom_complet'].'" style="cursor:pointer;"><i class="fa fa-hand-o-right fa-fw"></i> Paiement</a></td><td>'.$supplier->getSupCode().'</td><td>'.$un['nom_complet'].'</td><td>'.$un['contact'].'</td></tr>';
                             
                                    }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
