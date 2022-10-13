<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$achat= new BeanAchats();
$op=new BeanOperation();

$achat->select($_POST['op_id']);

?>
<h4 class="box-title m-b-0">Détails / Bon de commande N° : <?php echo $achat->getNumAchat(); ?></h4><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%" id="example23">
                             <thead>
                                        <tr>
                                            <th>N°</th><th>Désignation</th><th>QT MIN</th><th>SR</th><th>P.U</th><th>Qt commandée</th><th>PT</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    if(isset($_POST['op_id']))
                                    {
                                    $i=1;


                                    $datas2=$det->select_all($_POST['op_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);

                                    //sr
$reste=0;
$op->select($un['op_id']);
$app=$op->select_all_by_date_rap_an('Approvisionnement',$prod->getProdId(),$op->getCreateDate(),$_SESSION['pos']);
$sort=$op->select_all_by_date_rap_an('Sortie',$prod->getProdId(),$op->getCreateDate(),$_SESSION['pos']);
$vente=$op->select_all_by_date_rap_an('Vente',$prod->getProdId(),$op->getCreateDate(),$_SESSION['pos']);

$sr=$app['totqt']-($sort['totqt']+$vente['totqt']);

                                    //fin
                                    echo '<tr><td >'.$i.'</td><td >'.$prod->getProdName().'</td><td>'.$prod->getQtMin().'</td><td>'.$sr.'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td><td>'.number_format($un['amount']*$un['quantity'],0,'.',',').'</td>';
                                    echo '</tr>';
                                    $i++;
                                    }
                                    }
                                    ?>
    </tbody>
    </table>
</div>
