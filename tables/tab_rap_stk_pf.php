<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$pers= new BeanPersonne();


$from_date=$_GET['from_d'];
$to_date=$_GET['to_d'];
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row">
<div class="col-md-12">
<div id="vente_tab">
                            <h4 class="box-title m-b-0">Vente* du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                            <th>Date</th><th>Libellé</th><th>Entrée</th><th>Sortie</th><th>reste</th>
                                        </tr>
                            </thead>

                            <tbody>
<?php
$reste=0;
$reste=0;

$app=$op->select_all_by_date_rap_an('Production',$_GET['prod'],$from_date);
$sort=$op->select_all_by_date_rap_an('Vente',$_GET['prod'],$from_date);

$solde=$app['totqt']-$sort['totqt'];
$reste +=$solde;

if($solde>0)
{
    echo '<tr><td>'.$from_date.'</td><td>Reste entrée</td><td>'.$solde.'</td><td>-</td><td>'.$solde.'</td></tr>';
}
else
{
 echo '<tr><td>'.$from_date.'</td><td>Reste Sortie</td><td>-</td><td>'.$solde.'</td><td>'.$solde.'</td></tr>';
}

while (strtotime($from_date) <= strtotime($to_date))
{

if(empty($_GET['prod']))
{
$datas=$op->select_all_by_date_rap_2($from_date);
}
else
{
$datas=$op->select_all_by_date_rap($_GET['prod'],$from_date);
}

foreach ($datas as $un) {
$prod->select($un['prod_id']);
    if($un['op_type']=='Production')
    {
    $reste +=$un['totqt'];

    echo '<tr><td>'.$un['create_date'].'</td><td>'.$prod->getProdName().'</td><td>'.$un['totqt'].'</td><td>-</td><td>'.$reste.'</td></tr>';
    }
    elseif($un['op_type']=='Vente')
    {
    $reste -=$un['totqt'];
     echo '<tr><td>'.$un['create_date'].'</td><td>'.$prod->getProdName().'</td><td>-</td><td>'.$un['totqt'].'</td><td>'.$reste.'</td></tr>';
    }
}

$from_date = date ("Y-m-d", strtotime("+1 days", strtotime($from_date)));
}
?>
                            </tbody>
                             </table>
                            </div>
							</div>
    </div>

