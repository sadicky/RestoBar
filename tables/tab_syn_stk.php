<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$pers= new BeanPersonne();
$stock=new BeanStock();

$from_date=date('Y-m-d');
$to_date=date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days'));
$pos=$_SESSION['pos'];
$id_per=$_SESSION['periode'];
?>
<div class="white-box form-row">
    <div><a href="javascript:void(0)" id="print_rap" class="btn btn-success m-2" title="Imprimer"><span class="fa fa-print"></span></a></div>
<div class="col-md-12" id="rap_to_print">

                            <h4 class="box-title m-b-0">Synchronisation du Stock du <?php echo $from_date; ?> au <?php echo $to_date; ?>  </h4>
                            <hr>
<table id="example23" border="1" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Produit</th><th>Qt Stock</th>
        </tr>
    </thead>
    <tbody>
<?php
//solde
$all_prod=$prod->select_all();
$nx=$id_per+1;
foreach ($all_prod as $key => $value) {
    /*if($stock->existstock($pos,$value['prod_id']))
    {*/
$app=$op->select_all_by_date_rap_an('Approvisionnement',$value['prod_id'],$from_date,$pos,$id_per);
$production=$op->select_all_by_date_rap_an('Inventaire',$value['prod_id'],$from_date,$pos,$id_per);
$convers=$op->select_all_by_date_rap_an('Conversion',$value['prod_id'],$from_date,$pos,$id_per);


$sort_det=$op->select_all_by_date_rap_an('Sortie',$value['prod_id'],$from_date,$pos,$id_per);
$vente_det=$op->select_all_by_date_rap_an('Vente',$value['prod_id'],$from_date,$pos,$id_per);
/*$transf_det=$op->select_all_by_date_rap_an('Transfert produit',$value['prod_id'],$from_date,$pos,$id_per);*/

$solde=0;

$syn_sort=$sort_det['totqt']+$vente_det['totqt'];

$syn_entre=$app['totqt']  + $production['totqt']+ $convers['totqt'];
$solde=$syn_entre-$syn_sort;

//fin solde

$datas=$op->select_all_between_date_rap($value['prod_id'],$from_date,$to_date,$pos,$id_per);
$inv=$op->select_inv('Inventaire',$value['prod_id'],$pos,$nx);
$entre=0;
$sortie=0;

foreach ($datas as $un) {

    if($un['op_type']=='Approvisionnement')
    {
    $entre +=$un['totqt'];
    }
    elseif($un['op_type']=='Inventaire')
    {
    $entre +=$un['totqt'];
    }
    elseif($un['op_type']=='Conversion')
    {
    $entre +=$un['totqt'];
    }
    elseif($un['op_type']=='Vente')
    {
    $sortie +=$un['totqt'];
    }
    elseif($un['op_type']=='Sortie')
    {
    $sortie +=$un['totqt'];
    }

}
$reste=(($solde + $entre)-$sortie);
echo '<tr><td>'.$value['prod_name'].'</td><td>'.$reste.'</td></tr>';

    /*if($reste>0)
    {*/
      if(!$stock->existstock($_SESSION['pos'],$value['prod_id']))
     {
        $stock->setProdId($value['prod_id']);
        $stock->setOpId('1001');
        $stock->setQuantity($reste);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($_SESSION['pos']);
        $stock->setDet(true);
        $stock->insert();

     }
     else
     {
      $stock->setOpId('1000');
      $stock->setQuantity($reste);
      $stock->setUpdateDate(date('Y-m-d h:i'));
      $stock->update($value['prod_id'],$_SESSION['pos']);
    }
    //}
//}
}
?>
</tbody>
</table>
    </div>
</div>


