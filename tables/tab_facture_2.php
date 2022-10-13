<?php
if(isset($_SESSION['lot'])) $lot=$_SESSION['lot'];
else
$lot=1
?>
<h5 class="box-title m-b-0">Facture</h5><hr>
<div id="facture_2" class="card">
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
                                $m_p=$paie->select_sum_op($_SESSION['op_vente_id']);
                                ?>
                               <tr>
                                    <td>Client : <?php echo $perso_client->getNomComplet(); ?></td>
                                     <td>N° Fact (Ticket) : <?php echo $vente->getNumVente(); ?></td>
                                </tr>
                                <tr>
                                   <td>Date : <?php echo $op->getCreateDate().'-'.date('h:i'); ?></td><td>Agent : <?php  $perso->select($op->getPersonneId()); echo $perso->getNomComplet(); ?></td>
                                </tr>
                                <tr>
                                   <td>Table : <?php $pl->select($vente->getPlace()); echo $pl->getPlaceNum(); ?></td><td>Serv : <?php $perso->select($vente->getAssId()); echo $perso->getNomComplet(); ?></td>
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
                                    if(isset($_SESSION['list_det']))$max=sizeof($_SESSION['list_det']);
                                    else $max=0;
                                   
                                    if($max==0)
                                    {
                                    $datas2=$det->select_all_4($_SESSION['op_vente_id'],$lot);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cmd->select($un['det']);
                                    if($cmd->getIsPaid()==0)
                                    {
                                    $pt=$un['amount']*$un['quantity'];
                                    if($prod->getIsTva()=='1')
                                    {
                                    $price=($un['amount']*100)/118;
                                    $tva = round($un['quantity']*$price * 0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                        $price=$un['amount'];
                                    }

                                    $pt=$un['quantity']*$price;
                                    $ttva = $ttva + $tva;
                                    $ptc=$un['quantity']*$un['amount'];
                                    $pttc = $pttc + $ptc;
                                    $phtva = $phtva + $pt;

                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td align=right>'.number_format($un['amount']).'</td>
                                    <td align=right>'.number_format($tva).'</td><td align=right>'.number_format($ptc).'</td></tr>';
                                    }
                                }
                                    }
                                    else
                                    {
                                    foreach ($_SESSION['list_det'] as $key => $value) {
                                       
                                        $datas2=$det->select_all_5($_SESSION['op_vente_id'],$value);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    
                                    $pt=$un['amount']*$un['quantity'];
                                    if($prod->getIsTva()=='1')
                                    {
                                    $price=($un['amount']*100)/118;
                                    $tva = round($un['quantity']*$price * 0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                        $price=$un['amount'];
                                    }

                                    $pt=$un['quantity']*$price;
                                    $ttva = $ttva + $tva;
                                    $ptc=$un['quantity']*$un['amount'];
                                    $pttc = $pttc + $ptc;
                                    $phtva = $phtva + $pt;

                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td align=right>'.number_format($un['amount']).'</td>
                                    <td align=right>'.number_format($tva).'</td><td align=right>'.number_format($ptc).'</td></tr>';

                                                
                                    }
                                     }
                                 }

                                     echo '<tr><th colspan="4">PTHTVA</td><th>'.number_format($pttc).'</th></tr>';
                                    echo '<tr><th colspan="4">TVA</td><th>'.number_format($ttva).'</th></tr>';
                                    
                                    $pttc -=$vente->getRed();
                                    echo '<tr><th colspan="4">PTTAVC</td><th>'.number_format($pttc).'</th></tr>';

                                    ?>    </tbody>
    </table>
    <p>Merci et à bientôt Murakoze Grazie</p>
</div>
</div>
    <div class="card-footer form-row">
        
<a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
</div>

</div>



<?php
//}
?>
