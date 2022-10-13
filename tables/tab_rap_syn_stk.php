<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$pers= new BeanPersonne();
$stock=new BeanStock();
$pos=new BeanPos();
$pr=new BeanPrice();

$from_date=$_GET['from_d'];
$to_date=$_GET['to_d'];
$posId=$_GET['pos_id'];
$id_per=$_GET['id_per'];
?>
<div class="white-box form-row">
    <div><button id="print_rp" class="btn btn-success m-2" title="Imprimer"><span class="fa fa-print"></span></button></div>
<div class="col-md-12" id="rapport">

                            <h4 class="box-title m-b-0">Mouvement périodique du stock du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> Stock :
                                <?php
                                $pos->select($posId);
                                echo $pos->getPosName();
                                ?>
                            </h4>
                            <hr>
<table id="tab" border="1" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Produit</th><th>Initial</th><th>Entrée</th><th>Sortie</th><th>Reste</th>
        </tr>
    </thead>
    <tbody>
<?php
//solde
$all_prod=$prod->select_all_2();

foreach ($all_prod as $key => $value) {
$in=$op->select_all_by_date_rap_an('stock_in',$value['prod_id'],$from_date,$posId,$id_per);
$out=$op->select_all_by_date_rap_an('stock_out',$value['prod_id'],$from_date,$posId,$id_per);

$solde=0;
$entre=0;
$sortie=0;

$solde=$in['totqt']-$out['totqt'];
$datas=$op->select_all_between_date_rap($value['prod_id'],$from_date,$to_date,$posId,$id_per);

foreach ($datas as $un) {

    if($un['party_type']=='stock_in')
    {
    $entre +=$un['totqt'];
    }
    elseif($un['party_type']=='stock_out')
    {
    $sortie +=$un['totqt'];
    }
}
$reste=(($solde + $entre)-$sortie);
$t=0;
if($solde!=0){$t=1;} if($entre!=0){$t=1;} if($sortie!=0){$t=1;} if($reste!=0){$t=1;}

if($t==1)
{
echo '<tr><td>'.$value['prod_name'].'</td><td>'.$solde.'</td><td>'.$entre.'</td><td>'.$sortie.'</td><td>'.$reste.'</td></tr>';
}
}
?>
</tbody>
</table>
<h3 style="font-weight: bold">
                Agent : <?php $pers->select($_SESSION['perso_id']); echo $pers->getNomComplet(); ?><br>
                Date : <?php echo date('d-m-Y h:i:s'); ?>
               </h3>
    </div>
</div>


