<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$op=new BeanOperation();
$perso=new BeanPersonne();
$perso_client=new BeanPersonne();
$vente=new BeanVente();
$acc=new BeanAccounts();
$info=new BeanAutreInfo();

if(isset($_SESSION['op_vente_hist_id']))
                                    {
$op->select($_SESSION['op_vente_hist_id']);
$vente->select($_SESSION['op_vente_hist_id']);
$perso->select($op->getPersonneId());
?>
<h5 class="box-title m-b-0">Facture</h5><hr>
<div id="facture_hist" class="well" style="background: white;">
    <?php
    include("../entete.php");
    ?>
        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                                <?php
                                $perso_client->select($op->getPartyCode());
                                $info->select($vente->getIdvente());
                                ?>
                                <tr>
                                    <td>Client : <?php echo $perso_client->getNomComplet(); ?></td>
                                     <td>N° Facture : <?php echo $vente->getNumVente(); ?></td>
                                </tr>
                                <tr>
                                    <td>Date : <?php echo $op->getCreateDate(); ?></td><td>Agent :
                                        <?php echo $perso->getNomComplet(); ?>
                                    </td>
                                </tr>

                            </table>
                             <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Prix</th><th>Qté</th><th>PHT</th><th>TVA(18%)</th><th>PTTC</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php


                                    $pt=0; $tva=0; $ttva=0; $phtva=0; $pttc=0;
                                    $datas2=$det->select_all($_SESSION['op_vente_hist_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());

                                    $tx='*';

                                    $perso_client->select($vente->getAssId());

                                    $aff_price=$un['amount'];

                                    $pt=$aff_price*$un['quantity'];
                                    $phtva +=$pt;
                                    /*if($vente->getTva()=='1')
                                    {*/
                                    $tva = round($pt * 0.18);
                                    /*}
                                    else
                                    {
                                        $tva=0;
                                    }*/
                                    $ttva = $ttva + $tva;
                                    $pttc = $pttc + $pt;
                                    $phtva = $phtva + ($pt-$tva);

                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'; echo number_format($aff_price,0,'.',',');
                                    echo '</td><td>'.$un['quantity'].'</td><td>'.number_format($pt-$tva,0,'.',',').'</td>
                                    <td>'.number_format($tva,0,'.',',').'</td><td>'.number_format($pt,0,'.',',').'</td>';

                                   echo '</tr>';

                                    }
                                    echo '<tr><th colspan="3">Totaux</td><th>'.number_format($pttc-$ttva,0,'.',',').'</th><th>'.number_format($ttva,0,'.',',').'</th><th>'.number_format($pttc,0,'.',',').'</th>';

                                    /*echo '<tr><th colspan="3">Réduction</td><th>'.number_format($vente->getRed(),0,'.',',').'</th>';*/

                                    $pay=$pttc - $vente->getRed();

                                    /*echo '<tr><th colspan="3">PTHTVA</td><th>'.number_format($pay,0,'.',',').'</th></tr>';*/

                                    ?>
    </tbody>
    </table>
</div>
</div>

    <?php
    $acc->select_acc_perso($op->getPartyCode());
    ?>
    <input type="hidden" value="<?php echo $op->getOpId(); ?>" id="fact_op_id" name="fact_op_id"/>
    <input type="hidden" value="<?php echo $acc->getAccId(); ?>" id="fact_party_code" name="fact_party_code"/>
    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="date_fact_pay" name="date_fact_pay"/>

<p><a href="javascript:void(0)" id="print_hist_facture" class="btn btn-success"><span class="fa fa-print"></span></a></p>
<?php
}
?>
