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



$datas=$op->select_glob_ingred('Vente',$_GET['from_d'],$_GET['to_d']);

?>
<div class="white-box form-row">
<div class="col-md-12"id="vente_tab">

                            <h4 class="box-title m-b-0">Ingredients utilisées lors des ventes du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?>
</h4>
                            <hr/>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Produit</th><th>Qt</th><th>UM</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php

                                    foreach ($datas as $un) {
                                    $prod->select($un['ingred']);
                                    echo '<tr><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';
                                    echo '<td>'.$prod->getProdName().'</td><td>'.$un['qt_tot'].'</td><td>'.$prod->getUntMes().'</td></tr>';

                                    }

                                    ?>
										</tbody>

							 </table>
                            </div>
							</div>

</div>
