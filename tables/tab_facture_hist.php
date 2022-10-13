    <?php

?>
<h5 class="box-title m-b-0">Facture</h5><hr>
<div id="facture" class="card">
    <div class="card-header bg-light">
    <?php
    include("../entete.php");
    ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                                <?php
                                $perso_client->select($op->getPartyCode());
                                $info->select($vente->getIdvente());
                                $det_client->select($perso_client->getPersonneId());
                                ?>
                                <tr>
                                    <td>Client : <?php echo $perso_client->getNomComplet(); ?></td>
                                    <td>stock : <?php echo $pos->getNomComplet(); ?></td>
                                     <td>N° Fact : <?php echo $vente->getNumVente(); ?></td>
                                </tr>
                                <tr>
                                    <td>NIF : <?php echo $perso_client->getEmail(); ?></td>
                                     <td>RC : <?php echo $det_client->getMat(); ?></td>
                                     <td>ASSUJETIT : <?php echo $det_client->getService(); ?></td>
                                </tr>

                                <tr>
                                    <td>Bénef : <?php echo $info->getBenef(); ?></td><td>N° Bon : <?php echo $info->getNumBon(); ?></td><td>Aff : <?php echo $info->getAffilie(); ?></td>
                                </tr>
                                <tr>
                                   <td>Date : <?php echo $op->getCreateDate().' '.date('h:i:s',strtotime($op->getDhOp())); ?></td><td colspan="2">Agent : <?php echo $perso->getNomComplet(); ?></td>
                                </tr>

                            </table>
                             <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                           <th>Produit</th><!-- <th>P.U</th> --><th>Qté</th><th>PHTVA</th><th>TVA</th><th>PTVAC</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php


                                    $pt=0; $tva=0; $ttva=0; $phtva=0; $pttc=0;
                                    $datas2=$det->select_all($_POST['op_id']);
                                    $tot=0;
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());

                                    $tx='*';

                                    $perso_client->select($vente->getAssId());

                                    $aff_price=$un['amount'];
                                    $pt=$aff_price*$un['quantity'];
                                    $tot=$pt*((100-$un['det'])/100);
                                    $phtva +=$tot;
                                    /*if($vente->getTva()=='1')
                                    {
                                    $tva = round($tot * 0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                    }
                                    $ttva +=$tva;
                                    $pttc +=$tot;*/
                                    //$phtva +=($tot-$tva);

                                    echo '<tr><td >'.$prod->getProdName().'</td><td align="right">'.$un['quantity'].'</td><td align="right">'.number_format($pt,0,'.',',').'</td>
                                    <td align="right">'.number_format($tva,0,'.',',').'</td><td align="right">'.number_format($pt,0,'.',',').'</td>';

                                   echo '</tr>';

                                    }
                                    echo '<tr><th colspan="4">PHTVA</td><th align="right">'.number_format($phtva,0,'.',',').'</th></tr>';
                                    echo '<tr><th colspan="4">TVA</td><th align="right">'.number_format(0,0,'.',',').'</th></tr>';
                                   /* echo '<tr><th colspan="6">Réduction</td><th>'.number_format($vente->getRed(),1,'.',',').'</th></tr>';*/
                                   /* echo '<tr><th colspan="6">Payé</td><th>'.number_format($amount['paie'],1,'.',',').'</th></tr>';*/

                                    $pay=$pttc - $vente->getRed()-$amount['paie'];

                                    echo '<tr><th colspan="4">PTVAC</td><th align="right">'.number_format(0,0,'.',',').'</th></tr>';

                                    ?>
    </tbody>
    </table>
    <p>Merci et à bientôt</p>
</div>
</div>
    <div class="card-footer form-row">
        <div class="col-md-6">

    <?php
    $perso->select($op->getPartyCode());
    ?>
    <input type="hidden" value="<?php echo $op->getOpId(); ?>" id="fact_op_id" name="fact_op_id"/>
    <input type="hidden" value="<?php echo $acc->getAccId(); ?>" id="fact_party_code" name="fact_party_code"/>
    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="date_fact_pay" name="date_fact_pay"/>

            <?php
            if($vente->getTva()=='1')
            {
                echo '<input type="hidden" id="val_tva" name="val_tva" value="0">';
            }
            elseif($vente->getTva()=='0')
            {
                echo '<input type="hidden" id="val_tva" name="val_tva" value="1">';
            }
            ?>
            <input type="hidden" id="det_sup_vente_id" name="det_sup_vente_id" class="form-control" value="<?php echo $vente->getIdvente(); ?>" required>
        </div>
<a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
</div>

</div>



<?php
//}
?>
