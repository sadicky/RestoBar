<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$perso=new BeanPersonne();
$info=new BeanInfoSuppl();
$vente= new BeanVente();
$vente2= new BeanVente();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$perso_client=new BeanPersonne();
$pos=new BeanPersonne();
$acc=new BeanAccounts();
$det_client=new BeanInfoSuppl();
$paie=new BeanPaiement();
$cmd=new BeanCoupon();
$stock=new BeanStock();
$tabl=new BeanTabl();

$op->select($_POST['op_id']);
$vente->select($_POST['op_id']);
$perso->select($op->getPersonneId());
$pos->select($op->getPosId());
?>
<h5>Facture</h5><hr>
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
                                $m_p=$paie->select_sum_op($_POST['op_id']);
                                ?>
                                <tr>
                                    <td>Client : <?php echo $perso_client->getNomComplet(); ?></td>
                                    <td>stock : <?php echo $pos->getNomComplet(); ?></td>
                                     <td>N° Fact (Note) : <?php echo $vente->getNumVente(); ?></td>
                                </tr>
                                <tr>
                                   <td colspan="2">Date : <?php echo $op->getCreateDate(); ?></td><td >Operateur : <?php echo $perso->getNomComplet(); ?></td>
                                </tr>
                                <tr>
                                   <td>Table : <?php $tabl->select($vente->getPlace()); echo $tabl->getTableNum() ?></td><td colspan="2">Serveur : <?php $perso->select($vente->getAssId()); echo $perso->getNomComplet(); ?></td>
                                </tr>

                            </table>
                             <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Qté</th><!-- <th>Prix</th> --><th>PHTVA</th><th>TVA</th><th>PTTVAC</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php


                                    $pt=0; $tva=0; $ttva=0; $phtva=0; $pttc=0;
                                    $datas2=$det->select_all_3($_POST['op_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());

                                    $tx='*';

                                    $perso_client->select($vente->getAssId());

                                    $aff_price=$un['amount'];

                                    $pt=$aff_price*$un['quantity'];
                                    

                                    if($vente->getTva()=='1')
                                    {
                                    $tva = round($pt * 0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                    }

                                    $ttva = $ttva + $tva;
                                    $pttc = $pttc + $pt;
                                    $phtva = $phtva + ($pt-$tva);

                                    echo '<tr><td >'.$prod->getProdName().'</td>';

                                    //<td>'; echo number_format($aff_price,0,'.',',');

                                    echo '<td>'.$un['quantity'].'</td><td>'.number_format($pt-$tva,0,'.',',').'</td>
                                    <td>'.number_format($tva,0,'.',',').'</td><td>'.number_format($pt,0,'.',',').'</td>';

                                   echo '</tr>';

                                    }

                                     echo '<tr><th colspan="4">PTHTVA</td><th>'.number_format($pttc-$ttva,0,'.',',').'</th></tr>';
                                    echo '<tr><th colspan="4">TVA</td><th>'.number_format($ttva,1,'.',',').'</th></tr>';
                                    /*echo '<tr><th colspan="5">Réduction</td><th>'.number_format($vente->getRed(),1,'.',',').'</th></tr>';*/
                                    //echo '<tr><th colspan="5">Payé</td><th>'.number_format($amount['paie'],1,'.',',').'</th></tr>';
                                    /*echo '<tr><th colspan="3">Totaux</td><th>'.number_format($pttc-$ttva,1,'.',',').'</th><th>'.number_format($ttva,1,'.',',').'</th><th>'.number_format($pttc - $vente->getRed()-$amount['paie'],1,'.',',').'</th></tr>';*/

                                    /*echo '<tr><th colspan="5">Réduction</td><th>'.number_format($vente->getRed(),0,'.',',').'</th>';*/

                                    $pay=$pttc - $vente->getRed()-$m_p['paie'];

                                    echo '<tr><th colspan="4">PTTAVC</td><th>'.number_format($pay,0,'.',',').'</th></tr>';

                                    ?>
    </tbody>
    </table>
    <p>Merci et à bientôt Murakoze Grazie</p>
</div>
</div>
<div class="card-footer form-row">      
<a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
</div>
</div>
<hr color="blue">
    <h3>Paiement de la facture</h3>
    <form method="post" action="javascript:void(0)" id="pay_facture_2">
<div class="form-row">

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Mode de Paie</label>
            <select name="mode_paie" id="mode_paie" class="form-control">
                <option value="Cash">Cash</option>
                <option value="Banque">Banque</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Montant Du</label>
            <input type="number" name="mont_du" id="mont_du" class="form-control" value="<?php echo $pay; ?>" required readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Montant Payé</label>
            <input type="number" name="mont_trans" id="mont_trans" class="form-control" value="<?php echo $pay; ?>">
        </div>
    </div>

    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <?php
        if($pay>0)
        {?>
        <input type="hidden" name="cheque" id="cheque" class="form-control">
        <input type="hidden" name="opera" id="opera" value="Add" class="form-control">
        <input type="hidden" name="op_id" id="op_id" value="<?php echo $_POST['op_id']; ?>" class="form-control">
        <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> Payer</button> 
        <?php
           }
        ?>


    </div>

</div>
</form>

