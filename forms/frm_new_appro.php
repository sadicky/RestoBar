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
$achat= new BeanAchats();
$bq=new BeanBanque();
$trans=new BeanTransactions();
$paie=new BeanPaiement();
$pr=new BeanPrice();
$aut=new BeanAutreFrais();

$pos->select_status('Oui');
$posId=$_SESSION['pos'];
$idPer=$_SESSION['periode'];
if(isset($_SESSION['op_appro_id'])) {
    $op->select($_SESSION['op_appro_id']);
    $achat->select($_SESSION['op_appro_id']);
    $pers->select($op->getPartyCode());
}
?>
<section class="row">
    <div class="col-md-7">
        <div class="card card-info" >
            <div class="card-header bg-light">Approvisionnement - No : <?php echo $achat->getNumAchat(); ?></div>
            <div>
                <div class="card-body">
                    <form id="frm_new_appro" method="post" autocomplete="off">
                        <div class="form-body">
                            <div class="row">
                                
                            <div class="col-md-5">
                                <label class="control-label">Fournisseurs</label>
                                <div class="input_container">
                                    <input type="text" id="content_lib_sup" name="content_lib_sup" class="form-control" value="<?php if(isset($_SESSION['op_appro_id'])) echo $pers->getNomComplet();?>" required 
                                    <?php if(isset($_SESSION['op_appro_id'])) echo 'readonly';?>
                                    > 
                                    <ul id="content_list_sup"></ul>
                                    <input type="hidden" name="sup_id" id="sup_id" value="<?php if(isset($_SESSION['op_appro_id'])) echo $pers->getPersonneId();?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <input type="date" id="date_appro" class="form-control" name="date_appro"  value="<?php  if(isset($_SESSION['op_appro_id'])) echo $op->getCreatedate(); else echo date("Y-m-d"); ?>" <?php if(isset($_SESSION['op_appro_id'])) echo 'readonly';?>>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Produit : </label>
                                <div class="input_container">
                                    <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value="" required> 
                                    <ul id="content_list_prod"></ul>
                                    <input type="hidden" name="prod_id" id="prod_id" value="" />
                                </div>
                            </div>
                            <div class="col-md-3 p-1">
                                <label class="control-label">P.U.A</label>
                                <input type="number" name="price" id="price" class="form-control" step="any">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Qt</label>
                                <input type="number" name="qt" id="qt" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                                <input type="hidden" name="op_id" id="op_id" value="<?php if(isset($_SESSION['op_appro_id'])) echo $_SESSION['op_appro_id'];?>">
                                <input type="hidden" name="det_id" id="det_id" value="">
                                <input type="hidden" name="operation" id="operation_inv" value="Add">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="post" id="appro-search">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Du</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" value="<?php if(!empty($_GET['date_from'])) echo $_GET['date_from']; else echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Au</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" value="<?php if(!empty($_GET['date_to'])) echo $_GET['date_to']; else echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                            </div>
                    </div>
                </form>
                <div class="title m-3" style="text-align: center; font-weight: bold; font-size: 14px;"><h3>Du <?php echo $_GET['date_from'];?> Au <?php echo $_GET['date_to'];?></h3></div>
                <div class="table-responsive">
                <table class="table table-bordered table-sm tab">
                    <thead>
            <tr>
                <th>Date</th><th>Fournisseur</th><th style="width:150px;">Produit</th><th>Mont</th><th>Par</th><th>-</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $datas=$op->select_all_by_period('Approvisionnement',$_GET['date_from'],$_GET['date_to'],$idPer);
            $tot=0;
            foreach ($datas as $key => $value) {
                $pers->select($value['party_code']);
                $achat->select($value['op_id']);
                $user->select($value['personne_id']);


                $tot +=$det->select_sum_op($value['op_id']);

                echo '<tr><td>'.$value['create_date'].' <button class="btn btn-light btn-sm row_edit_appro_hist" style="cursor:pointer" data-id="'.$value['op_id'].'"><i class="fa fa-edit fa-fw" ></i></button></td><td>'.$pers->getNomComplet().'</td><td>';

                 //echo '<a href="javascript:void(0)" class="show_cont_detapx" data-id="'.$value['op_id'].'"><i class="fa fa-plus"></i></a> &#013;';
                                        echo '<span id="detx'.$value['op_id'].'" class="hide_cont_detx"><ul>';
                $datas2=$det->select_all($value['op_id']);
                foreach ($datas2 as $un2) {
                $prod->select($un2['prod_id']);
                echo '<li> <b>'.$un2['quantity'].'</b> : '.$prod->getProdName().'</li>';



                        }
                    echo '</span></ul>';
                echo '</td><td align="right">'.number_format($det->select_sum_op($value['op_id'])).'</td><td>'.$user->getNomComplet().'</td><td>';

                if($det->nb_op($value['op_id'])==0)
                    echo '<button class="btn btn-danger btn-circle btn-sm del_op_appro" name="delete" data-id="'.$value['op_id'].'" id="'.$value['op_id'].'"><i class="fa fa-times"></i></button>';
                else
                    echo '-';

                echo '</td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr><th>Total</th><th>-</th><th>-</th><th style="text-align: right"><?php echo number_format($tot) ?></th><th>-</th><th>-</th></tr>
        </tfoot>
                </table>
               
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-5">
    <span style="display: none;"><?php include('../tables/tab_bon_appro.php');?></span>
    <p> <a href="javascript:void(0)" class="btn btn-sm btn-info mr-2 mt-2 new_appro"><i class="fa fa-plus"></i> Nouveau</a>
        <?php if(isset($_SESSION['op_appro_id'])) {?>
        <a href="javascript:void(0)" id="print_rp" class="btn btn-sm btn-success mr-2 mt-2"><i class="fa fa-print"></i> Imprimer</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-primary mr-2 mt-2 new_aut_f"><i class="fa fa-plus"></i> Autres Frais</a>
    <?php } ?>
    </p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed display table-sm tabx">
                <thead>
                    <tr>
                        <th>Produit</th><th>Prix</th><th>Qt</th><th>Tot</th><th>-</th><th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_SESSION['op_appro_id']))
                    {
                        $datas2=$det->select_all($_SESSION['op_appro_id']);
                        $tot=0;
                        $totF=$aut->select_sum_op($_SESSION['op_appro_id']);

                        $tot +=$totF;
                        foreach ($datas2 as $un) {
                            $prod->select($un['prod_id']);
                            $tot +=($un['amount']*$un['quantity']);
                            echo '<tr><td >'.$prod->getProdName().'</td><td align="right">'.$un['amount'].'</td><td>'.$un['quantity'].'</td><td align="right">'.number_format($un['amount']*$un['quantity']).'</td>';

                            echo '
                            <td><button class="btn btn-sm fetch_inv_op" name="update" id="'.$un["details_id"].'" data-id="'.$un["details_id"].'"><i class="fa fa-edit"></i></button></td><td><button class="btn btn-sm del_det_appro" name="delete" data-id="'.$un["details_id"].'" id="'.$un["details_id"].'"><i class="fa fa-times"></i></button></td></tr>';

                        }
                        echo '<tr><th>Autres Frais</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($totF).'</th><th>-</th><th>-</th></tr>';
                         
                        echo '<tr><th>Totaux</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($tot).'</th><th>-</th><th>-</th></tr>';
                    }

                    ?>
                </tbody>
            </table>   
        </div>

        <hr color="blue">
        <!-- <h3>Paiement de la facture</h3> -->
        <?php
        if(isset($_SESSION['op_appro_id']))
        {
                    $bq->select_status('Oui');
                    $balance=$trans->select_balance($bq->getIdBq());

                        
                        $frais=$aut->select_sum_op($_SESSION['op_appro_id']);
                        $du=$det->select_sum_op($_SESSION['op_appro_id']);
                        $du +=$frais;

                        $p=$paie->select_sum_op($_SESSION['op_appro_id']);
                        $pay=$du-$p['paie'];


                        //$frais -=$p['paie'];
                        //if($frais<0){$du +=$frais; $frais=0; }
                        //if($du<0){$du=0;}
            ?>
            <form method="post" action="javascript:void(0)" id="pay_facture_sup">
                <div class="form-row">

                    <div class="form-row">
                            <div class="col col-md-4">
                                <label class=" form-control-label">Date</label>
                                <input type="date" id="date_trans" name="date_trans"  class="form-control" value="<?php echo date('Y-m-d');?>">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Provenance</label>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Balance</label>
                                    <input type="number" name="balance" id="balance" class="form-control" value="<?php echo $balance; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Montant Du</label>
                                    <input type="number" name="mont_du" id="mont_du" class="form-control" value="<?php echo $du; ?>"readonly>
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
                                <input type="hidden" name="op_id" id="op_id_paie" value="<?php echo $_SESSION['op_appro_id']; ?>">
                                
                                <?php
                                if($pay>0)
                                    {?>
                                        
                                        <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> <!-- Payer --></button> 
                                        <?php
                                    }
                                    ?>
                                
                                </div>


                            </div>
                        </form>
                </form>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
    include('frm_autre_frais.php');
    ?>