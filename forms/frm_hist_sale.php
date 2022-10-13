<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$pos= new BeanPos();
$pers=new BeanPersonne();
$per=new BeanPeriode();
$perso=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$vente= new BeanVente();



$posId=$_SESSION['pos'];
$idPer=$_SESSION['periode'];

$per->select($_SESSION['periode']);
if(isset($_SESSION['op_vente_id'])) {
    $op->select($_SESSION['op_vente_id']);
    $vente->select($_SESSION['op_vente_id']);
    $pers->select($op->getPartyCode());
}

if(!empty($_GET['date_from']))
{
$date_from=$_GET['date_from'];
$date_to=$_GET['date_to'];
}
else
{
  $date_from=date('Y-m-d'); 
  $date_to=date('Y-m-d');  
}
?>

<form method="post" id="sale-search">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Du</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" value="<?php if(!empty($_GET['date_from'])) echo $_GET['date_from']; else echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-2">
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
                                    <th>No</th><th>Date</th><th>Client</th><th>Montant</th><th>Produit</th><th>-</th>
                                </tr>
                            </thead>

                            <tbody>
                        <?php
                        $datas=$op->select_all_by_period('Vente',$date_from,$date_to,$idPer);
                        $totM=0;
                        
                        foreach ($datas as $key => $value) {
                            //$pack->select($value['pack_id']);
                            $vente->select($value['op_id']);
                            $pers->select($value['party_code']);
                            echo '<tr>
                            <td><button class="btn btn-light btn-sm row_edit_sale_hist" style="cursor:pointer" data-id="'.$value['op_id'].'"><i class="fa fa-edit fa-fw" ></i></button> '.$vente->getNumVente().'</td>
                            <td>'.$value['create_date'].'</td><td>'.$pers->getNomComplet().'</td><td align="right">'.number_format($vente->getAmount()).'</td><td>';

                 //echo '<a href="javascript:void(0)" class="show_cont_det" data-id="'.$value['op_id'].'"><i class="fa fa-plus"></i></a> &#013;';
                                        echo '<span id="det'.$value['op_id'].'" class="hide_cont_det"><ul>';
                $datas2=$det->select_all($value['op_id']);
                foreach ($datas2 as $un2) {
                $prod->select($un2['prod_id']);
                echo '<li><b>'.$un2['quantity'].'</b> - '.$prod->getProdName().'</li>';



                        }
                    echo '</span></ul>';
                echo '</td><td>';

                            if($det->nb_op($value['op_id'])==0)
                                echo '<button class="btn btn-danger btn-circle btn-sm del_op_sale" name="delete" data-id="'.$value['op_id'].'" id="'.$value['op_id'].'"><i class="fa fa-times"></i></button>';
                            else
                                echo '-';

                            echo '</td></tr>';
                            $totM +=$vente->getAmount();
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr><th>Total</th><th>-</th><th>-</th><th style="text-align: right"><?php echo number_format($totM);?></th><th>-</th><th>-</th></tr>
                    </tfoot>
                        </table>
                    </div>