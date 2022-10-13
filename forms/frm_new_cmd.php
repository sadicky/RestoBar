
<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$perso=new BeanPersonne();
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
?>
<section class="form-row">

    <?php
            if(!isset($_SESSION['op_vente_id']))
            {
            ?>
<div class="col-md-12">
<div class="card card-info" >
<div>
<div class="card-body">

<h5 class="box-title m-b-0">Commandes à servir</h5>
                            <hr>
<a href="javascript:void(0)" class="btn btn-info btn-sm btn_send"><i class="fa fa-refresh "></i> <span class="nb_send"> <?php echo $op->select_count_send();?></span> </a><br>
               <table id="example2a" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0">
               <thead>
                    <tr>
                      <tr>
                        <th>#N°</th><th>Date</th><th>Montant</th><th>Client</th><!-- <th>-</th> -->
                      </tr>
                    </tr>
                </thead>
<tbody>
                  <?php
                  $datas=$op->select_all_by_state4('Vente','1',$_SESSION['pos'],'0');

                                    foreach ($datas as $un) {
                                    $vente->select($un['op_id']);
                                    if(empty($un['is_valid']))
                                    {
                                    $perso->select($un['party_code']);
                                    echo '<tr class="row_op_cmd" data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$vente->getNumVente().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';
                                    $m_vente=$vente->getAmount() - $vente->getRed();

                                    echo number_format($m_vente,0,'.',',');

                                    echo '</td><td>';
                                    echo $perso->getNomComplet();
                                    echo '</td>';

                                    /*echo '<td>';
                                    echo '<button class="btn btn-sm btn-success btn-circle close_sale" name="delete" id="'.$un["op_id"].'"><span class="fa fa-save"></span></button>';

                                    echo '</td>';*/
                                    echo '</tr>';
                                    }

                                }
                                    ?>
                    </tbody>
               </table>

                                </div>
                            </div>
                </div>
            </div>
<?php
            }
else
            {
$vente->select($_SESSION['op_vente_id']);
if(!isset($_SESSION['op_vente_num']))
{
$_SESSION['op_vente_num']=$vente->getNumVente();
}
            ?>
<div class="col-md-12">
<div class="card">
<div class="card-header bg-light">
Facture N° : <?php if(isset($_SESSION['op_vente_num']) and !empty($_SESSION['op_vente_num'])){echo $_SESSION['op_vente_num'];}else {echo '?';} ?>/Tarif : <?php $tarif->select($vente->getAssId()); echo $tarif->getNomComplet(); ?>
</div>
<div class="card-body" style="">
<div class="row">
<div class="col-md-6">
<?php
include('../tables/tab_det_vente_cmd.php');
?>
 </div>
</div>
</div>
</div>
</div>
<?php
    }
    ?>
</section>
