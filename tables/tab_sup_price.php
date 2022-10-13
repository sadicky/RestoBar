<?php 
@session_start();
require_once '../load_model.php';
$price= new BeanPrice();
$prod= new BeanProducts();
$acc= new BeanAccounts();
$pers= new BeanPersonne();
$datas=$price->select_all($_SESSION['sup_id']);
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Produits - Prix</h3>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Produit</th><th>Prix</th><th>Début</th><th>Fin</th><th>Statut</th><th>Executé Par</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Produit</th><th>Prix</th><th>Début</th><th>Fin</th><th>Statut</th><th>Executé Par</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php 
                                    foreach ($datas as $un) {
                                    $prod->select($un['prod_id']);
                                    $acc->select($un['set_by']);
                                    $pers->select($acc->getPersonneId());

                                    echo '<tr><td>'.$prod->getProdName().'</td><td>'.$un['price'].'</td><td>'.$un['start_date'].'</td><td>';

                                    if(empty($un['end_date'])) echo '-'; else echo $un['end_date'];
                                    echo '</td><td>';

                                    if($un['state']=='1') echo 'encours'; else echo 'terminé';
                                    echo '</td><td>'.$pers->getNom().' '.$pers->getPrenom().'</td><td>';

                                    if($un["state"]=='1') echo '<button class="btn btn-success update" name="update" id="'.$un["price_id"].'"><span class="glyphicon glyphicon-edit"></span></button>';
                                    else echo '-';

                                    echo '</td><td><button class="btn btn-danger delete" name="delete" id="'.$un["price_id"].'">';
                                    if($un["state"]=='1') echo '<span class="glyphicon glyphicon-remove"></span>';
                                    else echo '<span class="glyphicon glyphicon-ok"></span>';

                                    echo '</button></td></tr>';
                                    }
                                    ?>
										</tbody>
							 </table>
							</div>
</div>