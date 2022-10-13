<?php
//@session_start();
//require_once '../load_model.php';
//$det = new BeanDetailsOperation();
//$op = new BeanOperation();
//$prod=new BeanProducts();
?>
<H3>Sous - Facture No <?php echo $_SESSION['lot']; ?></H3>
        <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
            <thead>
                <tr>
                   <th>Produit</th><th>Prix</th><th>Qt</th><th>Tot</th><th>No</th><th>-</th>
                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    $tot=0;
                                    if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_vente_id']);
                                    $i=1;
                                    $next=1;
                                    $t=1;
                                    $tva=0;
                                    foreach ($datas2 as $un) {
                                    if($un['lot']==$_SESSION['lot'])
                                    {
                                    $prod->select($un['prod_id']);
                                    $tot +=$un['quantity']*$un['amount'];

                                    echo '<tr><td>'.$prod->getProdName();
                                        /*if($prod->getIsTva()=='1')
                                        {
                                            echo '(*)';
                                        }*/
                                        echo '</td><td class="edit_det_price" contenteditable="true" id="'.$un['details_id'].'">'.$un['amount'].'</td><td class="edit_det_qt" contenteditable="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td><td>'.number_format($un['quantity']*$un['amount'],0,'.',',').'</td><td class="edit_det_lot" contenteditable="true" id="'.$un['details_id'].'">'.$un['lot'].'</td>';


                                    /*echo '</td><th><button class="btn btn-sm btn-primary btn-circle ch_prod" name="delete" id="-1" data-id="'.$un["prod_id"].'"><span class="fa fa-minus"></span></button></td>';*/

                                    echo '</td><th><button class="btn btn-sm btn-danger btn-circle delete_det_vente" name="delete" id="'.$un["details_id"].'"><span class="fa fa-times"></span></button></td>';


                                    echo '</tr>';
                                    $i++;
                                    }
                                    }



                                   echo '<tr><th colspan="3">Totaux</th><th>'.number_format($tot,1,'.',',').'</th><th>-</th><th>-</th></tr>';
                                     //echo '<tr><th colspan="3">TVA</th><th>'.number_format($tva,1,'.',',').'</th><th>-</th><th>-</th></tr>';
                                   //echo '<tr><th colspan="3">Réduction</th><th>'.number_format($vente->getRed(),1,'.',',').'</th><th>-</th></tr>';
                                   //echo '<tr><th colspan="4">Payé</th><th>'.number_format($sell-$pay,1,'.',',').'</th><th>-</th></tr>';
                                    //echo '<tr><th colspan="3">PTTTC</th><th>'.number_format($tot-$tva,1,'.',',').'</th><th>-</th><th>-</th></tr>';
                                    }
                                    ?>
    </tbody>
    </table>