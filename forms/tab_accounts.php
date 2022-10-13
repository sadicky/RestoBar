<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$datas=$acc->select_all();
?>

                    <div class="white-box">
                            <h3 class="box-title m-b-0">Compte d'Utilisateurs</h3>

                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-warning btn-rounded" id="trash_acc"> <i class="fa fa-trash"></i> Corbeille</a></p>

							<div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Créé</th><th>Propriétaire</th><th>N° Compte</th><th>Crédit</th><th>Débit</th><th>Dernière Mise à jour</th><th>&nbsp;</th>
                                        </tr>
                            </thead>
                            <tfoot>
                                       <tr>
                                            <th>Créé</th><th>Propriétaire</th><th>N° Compte</th><th>Crédit</th><th>Débit</th><th>Dernière Mise à jour</th><th>&nbsp;</th>
                                        </tr>
                            </tfoot>
                            <tbody>
                            <?php
                             foreach ($datas as $un) {
                              if($un['status']==$_GET['status'])
                              {
                             echo '<tr><td>'.$un['created_date'].'</td><td>'.$un['nom_complet'].'</td><td>'.$un['acc_num'].'</td><td>'.$un['bal_cash'].'</td><td>'.$un['bal_adv'].'</td><td>'.$un['last_update'].'</td><td>';
                             if($un['status']=='1')
                             {
                            echo '<button class="btn btn-danger btn-circle delete_acc" id="'.$un['acc_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                }
                                else
                                {
                                echo '<button class="btn btn-success btn-circle delete_acc" id="'.$un['acc_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';
                                }
                             }
                             echo '</td>';
                             echo '</tr>';
                             }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
