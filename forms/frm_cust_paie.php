<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$pos= new BeanPos();
$tar= new BeanTarif();
$pers=new BeanPersonne();
$user=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$vente= new BeanVente();
$bq=new BeanBanque();
$trans=new BeanTransactions();
$paie=new BeanPaiement();
$aut=new BeanAutreFrais();

$pers->select($_POST['cust_id']);
?>
<section class="row">
    <div class="col-md-12">
        <div class="card card-info" >
            <div class="card-header bg-light">Paiement - Client : <?php echo $pers->getNomComplet(); ?></div>
            <div>
                <div class="card-body">
                    <?php
                    $bq->select_status('Oui');
                    $balance=$trans->select_balance($bq->getIdBq());

                    if(!empty($_POST['op_id']))
                    {
                        
                        $frais=$aut->select_sum_op($_POST['op_id']);
                        $du=$det->select_sum_op($_POST['op_id']);

                        $p=$paie->select_sum_op($_POST['op_id']);
                        $pay=($du + $frais )-$p['paie'];

                        $frais -=$p['paie'];
                        if($frais<0){$du +=$frais; $frais=0; }
                        if($du<0){$du=0;}
                    }
                    else
                    {
                        $du=0;
                        $frais=0;
                        $pay=0;
                    }
                    ?>
                    <form method="post" action="javascript:void(0)" id="pay_facture_cust">
                        <div class="form-row">
                            <div class="col col-md-4">
                                <label class=" form-control-label">Date</label>
                                <input type="date" id="date_trans" name="date_trans"  class="form-control" value="<?php echo date('Y-m-d');?>">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Destination</label>
                                    <select name="id_bq" id="id_bq_sup" class="custom-select" required>
                                        
                                        <?php
                                        echo '<option value="'.$bq->getIdBq().'" selected>'.$bq->getLibBq().'</option>';
                                        $mode=$bq->select_all();
                                        foreach($mode as $e)
                                        {

                                            echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';

                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mode Paiement</label>
                                    <select id="mode_paie" name="mode_paie" class="custom-select" required>
                                        <?php
                                        $dat = array('Espèce','Chèque','Virement');
                                        foreach ($dat as $key => $value) {
                                            echo '<option value="'.$value.'">'.$value.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Balance</label> -->
                                    <input type="hidden" name="balance" id="balance" class="form-control" value="<?php echo $balance; ?>" >
                               <!--  </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Montant Du</label>
                                    <input type="number" name="mont_du" id="mont_du" class="form-control" value="<?php echo $du; ?>"readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Autres Frais</label>
                                    <input type="number" name="autref" id="autref" class="form-control" value="<?php echo $frais; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Montant Payé</label>
                                    <input type="number" name="mont_trans" id="mont_trans" class="form-control" value="<?php echo $pay; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="control-label">&nbsp;</label><br/>
                                <input type="hidden" name="op_id" id="op_id_paie" value="<?php echo $_POST['op_id']; ?>">
                                <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $_POST['cust_id']; ?>">
                                <?php
                                if($pay>0)
                                    {?>
                                        
                                        <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> <!-- Payer --></button> 
                                        <?php
                                    }
                                    ?>
                                    <?php
                                
                                if($trans->select_all_nb_op($_POST['op_id'])>0 and !empty($_POST['op_id']))
                                    {?>
                                        <a href="javascript:void(0)" class="btn btn-sm more_pay_cust"><i class="fa fa-file"></i> Paiements</a> 
                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm tab">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Date</th><th>Dû</th><th>Autres Frais</th><th>Payé</th><th>Article</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $datas=$op->select_sup_period($_POST['cust_id'],$_SESSION['periode']);
                                    $tot_du=0;
                                    $tot_p=0;
                                    $tot_f=0;

                                    foreach ($datas as $key => $value) {
                                        //$tar->select($value['tar_id']);
                                        $vente->select($value['op_id']);
                                        $m_paid=$paie->select_sum_op($value['op_id']);

                                        $frais=$aut->select_sum_op($value['op_id']);
                                        $du=$det->select_sum_op($value['op_id']);
                                        $frais -=$m_paid['paie'];
                                        if($frais<0){$du +=$frais; $frais=0; }
                                        if($du<0){$du=0;}
                                        echo '<tr><td>';
                                        echo $vente->getNumVente();
                                        echo '</td><td>'.$value['create_date'].'</td><td align="right">'.number_format($du).'</td><td align="right">'.number_format($frais).'</td><td align="right">';

                                        echo '<a href="javascript:void(0)" class="row_cust_pay" style="cursor:pointer" id="'.$value['op_id'].'" data-id="'.$value['party_code'].'">'.number_format($m_paid['paie']).'</a>';

                                        echo '</td><td><ul>';

                                        $datas2=$det->select_all($value['op_id']);
                                        foreach ($datas2 as $un2) {
                                            $prod->select($un2['prod_id']);
                                            echo '<li><b>'.$un2['quantity'].'</b> '.$prod->getProdName().'<span style="visibility:hidden;">;</span>&#013;</li>';

                                        }
                                        
                                        $datas2=$aut->select_all_op($value['op_id']);
                                        foreach ($datas2 as $un2) {
                                            echo '<li> + '.$un2['aut_det'].' :<b>'.$un2['amount'].' Fbu</b><span style="visibility:hidden;">;</span>&#013;</li>';
                                        }
                                        echo '</ul>';
                                        if($value['is_paid']==0)
                                        echo '<button class="btn btn-light btn-sm row_op_vente" style="cursor:pointer"  data-id="'.$value['op_id'].'"><i class="fa fa-edit fa-fw" ></i></button> ';
                                        echo '</td></tr>';

                                        $tot_du +=$du;
                                        $tot_f +=$frais;
                                        $tot_p +=$m_paid['paie'];
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr><th>Total</th><th>-</th><th style="text-align: right"><?php echo number_format($tot_du) ?></th><th style="text-align: right"><?php echo number_format($tot_f) ?></th><th style="text-align: right"><?php echo number_format($tot_p) ?></th><th>-</th></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('modal_pay_det_cust.php'); ?>
    