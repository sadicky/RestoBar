<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$prod2= new BeanProducts();
$cat= new BeanCategory();
$vente= new BeanVente();
$pers= new BeanPersonne();
$compo=new BeanComposition();



$datas=$op->select_glob_vente('Vente',$_GET['from_d'],$_GET['to_d']);

?>
<div class="white-box form-row">
<div class="col-md-12"id="vente_tab">

                            <h4 class="box-title m-b-0">Vente du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?>

                            <a href="javascript:void(0)" class="btn btn-light" id="only_ingred">Uniquement les ingredients</a></h4><hr/>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Produit</th><th>Qt</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php

                                    foreach ($datas as $un) {
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';
                                    echo '<td >'.$prod->getProdName().'</td><td>'.$un['qt_tot'].'</td><td>';
                                    $datas2=$compo->select_all($un['prod_id']);
                                    echo '<table class="table-warning table-bordered table-sm">';
                                    echo '<tr><th>Ingredient</th><th>Qt</th><th>UM</th></tr>';
                                        foreach ($datas2 as $key => $value) {
                                        $prod2->select($value['ingred']);
                                        echo '<tr><td>'.$prod2->getProdName().'</td><td>'.$value['qt']*$un['qt_tot'].'</td><td>'.$prod2->getUntMes().'</td></tr>';
                                        }
                                    echo '</table>';
                                    echo '</td></tr>';

                                    }

                                    ?>
										</tbody>

							 </table>
                            </div>
							</div>

</div>
