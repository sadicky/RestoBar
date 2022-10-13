<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$pers= new BeanPersonne();
$stock=new BeanStock();

$from_date=$_GET['from_d'];
$to_date=$_GET['to_d'];
$pos=$_GET['pos_rap'];
$id_per=$_GET['id_per'];
?>
<div class="row">
  <div class="col-md-6">
<div class="white-box form-row">
    <div><button id="print_rap" class="btn btn-success m-2" title="Imprimer"><span class="fa fa-print"></span></button></div>
<div class="col-md-12" id="rap_to_print">

                            <h4 class="box-title m-b-0">Mouvement périodique du stock du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> de la <b>Cuisine</b> Stock :
                                <?php
                                $pers->select($pos);
                                echo $pers->getNomComplet();
                                ?>
                            </h4>
                            <hr>
<table id="example23" border="1" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Produit</th><th>Initial</th><th>Entrée</th><th>Sortie</th><th>Reste</th>
        </tr>
    </thead>
    <tbody>
<?php
//solde
$all_prod=$prod->select_all_equiv();

foreach ($all_prod as $key => $value) {
$in=$op->select_all_by_date_rap_an('stock_in',$value['prod_equiv'],$from_date,$pos,$id_per);
$out=$op->select_all_by_date_rap_an_cui('stock_out',$value['prod_equiv'],$from_date,$pos,$id_per);

$solde=0;
$entre=0;
$sortie=0;

$solde=$in['totqt']-$out['totqt'];
$prod->select($value['prod_equiv']); 

$datas=$op->select_all_between_date_rap_cui($value['prod_equiv'],$from_date,$to_date,$pos,$id_per);

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
echo '<tr><td><a href="javascript:void(0)" class="fiche_det_cui" data-id="'.$prod->getProdId().'">'.$prod->getProdName().'</a></td><td>'.$solde.'</td><td>'.$entre.'</td><td>'.$sortie.'</td><td>'.$reste.'</td></tr>';

}
?>
</tbody>
</table>
    </div>
</div>
</div>
<div class="col-md-6 fiche_art_cui p-2">
    
</div>


