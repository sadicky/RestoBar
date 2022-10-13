<?php
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$perso->select($op->getPersonneId());
$pos->select($op->getPosId());
$amount=$paie->select_sum_op($_SESSION['op_vente_id']);
$sell=$det->select_sum_op($_SESSION['op_vente_id']);
$ass=$det->select_sum_op_ass($_SESSION['op_vente_id']);
$m_sell=$sell;
$payf=($m_sell-$vente->getRed());
?>
<div class="row">
<div class="col-md-12 mr-2">
<div class="form-row mb-2">
        <a href="javascript:void(0)" id="<?php echo $_SESSION['op_vente_id']; ?>" class="btn btn-sm btn-success mr-2 valid_op_vente"><i class="fa fa-save"></i> Valider</a>
         <a href="javascript:void(0)" id="new_valid" class="btn btn-sm btn-info mr-2"><i class="fa fa-plus"></i> Nouveau</a>
</div>
<div class="table-responsive" id="current_det_vente">
    <span style="display: none;"><?php include('tab_facture.php');?></span>
    <h1 style="font-size: 30px; font-style: italic; color:red;">
    <?php
    echo 'Total : '.number_format($payf,1,'.',',').' BIF';
    ?>
    </h1>
        <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
            <thead>
                <tr>
                   <th>Produit</th><th>P.U</th><th>Qt</th><th>PHTVA</th><th>TVA</th><th>PTVAC</th><th>-</th>
                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    $tot=0;
                                    if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_vente_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $tot +=$un['quantity']*$un['amount'];
                                    echo '<tr><td >'.$prod->getProdName().'</td><td class="edit_det_price" contenteditable="true" id="'.$un['details_id'].'">'.$un['amount'].'</td><td class="edit_det_qt" contenteditable="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td><td>'.number_format($un['quantity']*$un['amount'],0,'.',',').'</td><td>0</td><td>0</td>';

                                    echo '</td><th><button class="btn btn-sm btn-danger btn-circle delete_det_vente" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></th></tr>';

                                    }
                                    /*if($vente->getTva()=='1')
                                    {
                                    $tva = round($tot * 0.18);
                                    }
                                    else
                                    {*/
                                        $tva=0;
                                    //}
                                     echo '<tr><th colspan="5">PHTVA</th><th>'.number_format($tot,1,'.',',').'</th><th>-</th></tr>';
                                    echo '<tr><th colspan="5">TVA</th><th>'.number_format($tva,1,'.',',').'</th><th>-</th></tr>';

                                    echo '<tr><th colspan="5">PTVAC</th><th>'.number_format($tot,1,'.',',').'</th><th>-</th></tr>';
                                    }
                                    ?>
    </tbody>
    </table>
</div>
</div>


<!-- fin de detail supplemetaire reduction et tva -->
<!-- </div> -->
