<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$perso=new BeanPersonne();
$perso2=new BeanPersonne();
$tarif=new BeanPersonne();
$info=new BeanAutreInfo();
$vente= new BeanVente();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$perso_client=new BeanPersonne();
$pos=new BeanPersonne();
$acc=new BeanAccounts();
$det_client=new BeanInfoSuppl();
$paie=new BeanPaiement();

//selection
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$perso->select($op->getPersonneId());
$perso2->select($op->getPartyCode());
$pos->select($op->getPosId());
$amount=$paie->select_sum_op($_SESSION['op_vente_id']);
$sell=$det->select_sum_op($_SESSION['op_vente_id']);
$ass=$det->select_sum_op_ass($_SESSION['op_vente_id']);
$m_sell=$sell;
?>
<div class="row">
<div class="col-md-12 mr-2">
<div class="form-row mb-2">
        <?php $payf=($m_sell-$vente->getRed());

        //if($payf>0)
        //{
        /*if(!empty($op->getIsValid()))
        {*/
            ?>
        <a href="javascript:void(0)" id="print_facture" data-id="<?php //echo $payf; ?>" class="btn btn-sm btn-success mr-2"><i class="fa fa-print"></i> Facture</a>
        <?php 
         if($perso2->getNomComplet()=='Cash')
        {
        ?>
        <a href="javascript:void(0)" id="pay_facture_v" data-id="<?php echo $payf; ?>" class="btn btn-sm btn-success mr-2"><i class="fa fa-dollar"></i> Payer/Cash</a>

        <a href="javascript:void(0)" id="pay_facture_v2" data-id="<?php echo $payf; ?>" class="btn btn-sm btn-success mr-2"><i class="fa fa-dollar"></i> Payer/Banque</a>
        <?php
        }
        ?>
        <a href="javascript:void(0)" id="<?php echo $_SESSION['op_vente_id']; ?>" class="btn btn-sm btn-info mr-2 close_sale"><i class="fa fa-save"></i> Cloturer</a>

        <?php
        //}
        //}

        /*if($op->getIsSend()=='0')
        {
        ?>
        <a href="javascript:void(0)" id="<?php //echo $_SESSION['op_vente_id']; ?>" class="btn btn-sm btn-warning mr-2 send_sale"><i class="fa fa-save"></i> Envoyer</a>
        <?php
        }*/
        ?>
        <a href="javascript:void(0)" id="new_fact" class="btn btn-sm btn-info mr-2"><i class="fa fa-plus"></i> Nouveau</a>



        <?php
            if($vente->getTva()=='1')
            {
                ?>
            <a id="add_det_tva" data-id="<?php echo $_SESSION['op_vente_id']; ?>" href="javascript:void(0)" class="btn btn-sm btn-info"> TVA </a>
            <?php
            }
            else
            {
              ?>
            <a id="add_det_tva" data-id="<?php echo $_SESSION['op_vente_id']; ?>" href="javascript:void(0)" class="btn btn-sm btn-warning"> TVA </a>
            <?php
            }
            ?>
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
                                    $pttc_aff =0;
                                    $phtva_aff=0;
                                    $ttva_aff =0;
                                    if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_vente_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $tot +=$un['quantity']*$un['amount'];

                                    $price_aff=$un['amount'];
                                    $pt_aff=$price_aff*$un['quantity'];

                                    
                                    if($vente->getTva()=='1')
                                    {
                                    $tva_aff = round($pt_aff * 0.18);
                                    }
                                    else
                                    {
                                        $tva_aff=0;
                                    }
                                    $pttc_aff +=$pt_aff;
                                    $phtva_aff +=($pt_aff-$tva_aff);
                                    $ttva_aff +=$tva_aff;


                                    echo '<tr><td >'.$prod->getProdName().'</td><td class="edit_det_price" contenteditablex="true" id="'.$un['details_id'].'">'.$un['amount'].'</td><td class="edit_det_qt" contenteditablex="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td><td>'.number_format($pt_aff-$tva_aff,0,'.',',').'</td><td>'.number_format($tva_aff,0,'.',',').'</td><td>'.number_format($pt_aff,0,'.',',').'</td>';

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
                                        //$tva=0;
                                    //}
                                     echo '<tr><th colspan="5">PHTVA</th><th>'.number_format($phtva_aff,0,'.',',').'</th><th>-</th></tr>';
                                    echo '<tr><th colspan="5">TVA</th><th>'.number_format($ttva_aff,0,'.',',').'</th><th>-</th></tr>';
                                    echo '<tr><th colspan="5">Réduction</td><th>'.number_format($vente->getRed(),0,'.',',').'</th><th>-</th></tr>';

                                    echo '<tr><th colspan="5">PTVAC</th><th>'.number_format($pttc_aff-$vente->getRed(),0,'.',',').'</th><th>-</th></tr>';
                                    }
                                    ?>
    </tbody>
    </table>
</div>
</div>


<!-- fin de detail supplemetaire reduction et tva -->
<?php include('suite_det.php'); ?>
<!-- </div> -->
