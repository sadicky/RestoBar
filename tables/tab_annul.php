<?php
@session_start();
require_once '../load_model.php';
$pers= new BeanPersonne();
$prod= new BeanProducts();
$cat= new BeanCategory();
$an=new BeanAnnulation();


 $datas=$an->select_all($_GET['from_d'],$_GET['to_d']);

?>
<div class="white-box form-row">
    <div><button id="print_rap" class="btn btn-success m-2" title="Imprimer"><span class="fa fa-print"></span></button></div>
<div class="col-md-12" id="rap_to_print">

                            <h4 class="box-title m-b-0">Annulation du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
							 <thead>
                        <tr>
                        <th>Date</th><th>Article</th><th>Quantité</th><th>Montant</th><th>Fact No</th><th>Caissier</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php 
                                    foreach ($datas as $key => $value) {
                                        
                                        $prod->select($value['prod_id']);
                                        $pers->select($value['det']);
                                        echo '<tr><td>'.$value['date_op'].'</td><td>'.$prod->getProdName().'</td><td>'.$value['quantity'].'</td><td>'.$value['amount'].'</td><td>'.$value['tab'].'</td><td>'.$pers->getNomComplet().'</td></tr>';
                                    }

                                    ?>
									</tbody>
                                        
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
