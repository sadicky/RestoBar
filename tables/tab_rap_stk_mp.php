<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$stock = new BeanStock();

$from_date=$_GET['from_d'];
$to_date=$_GET['to_d'];
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
$prod->select($_GET['prod']);
//$stk=$_GET['stk'];
$pos=$_GET['pos_rap'];
$idPer=$_GET['id_per'];
?>
<div class="white-box form-row">
<div class="col-md-12">
<div  id="vente_tab">
                            <h4 class="box-title m-b-0">Fiche du stock du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Produit : <?php echo $prod->getProdname().$_GET['prod']; ?> / Stock :
                                <?php
                                $pers->select($pos);
                                    if($_GET['pos_rap']=='tous')
                                    {
                                        echo 'GENERAL';
                                    }
                                    else
                                    {
                                    echo $pers->getNomComplet();
                                    }

                                ?>
                            </h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                            <th>Date</th><th>Libellé</th><th>Fournisseur/Client</th><th>Utilisateur</th><th>Entrée</th><th>Sortie</th><th>reste</th>
                                        </tr>
                            </thead>

                            <tbody>
<?php
$reste=0;

if($pos=='tous')
{
$app=$op->select_all_by_date_rap_an_bis('Approvisionnement',$_GET['prod'],$from_date,$idPer);

$sort_det=$op->select_all_by_date_rap_an_bis('Sortie',$_GET['prod'],$from_date,$idPer);
$vente_det=$op->select_all_by_date_rap_an_bis('Vente',$_GET['prod'],$from_date,$idPer);
$inv=$op->select_all_by_date_rap_an_bis('Inventaire',$_GET['prod'],$from_date,$idPer);
}
else
{
$app=$op->select_all_by_date_rap_an('Approvisionnement',$_GET['prod'],$from_date,$pos,$idPer);
$inv=$op->select_all_by_date_rap_an('Inventaire',$_GET['prod'],$from_date,$pos,$idPer);

$recep_det=$op->select_all_by_date_rap_an_recep('Transfert produit',$_GET['prod'],$from_date,$pos,$idPer);
//$production=$op->select_all_by_date_rap_an('Inventaire',$_GET['prod'],$from_date,$pos,$idPer);
$convers=$op->select_all_by_date_rap_an('Conversion',$_GET['prod'],$from_date,$pos,$idPer);


$sort_det=$op->select_all_by_date_rap_an('Sortie',$_GET['prod'],$from_date,$pos,$idPer);
$vente_det=$op->select_all_by_date_rap_an('Vente',$_GET['prod'],$from_date,$pos,$idPer);
$transf_det=$op->select_all_by_date_rap_an('Transfert produit',$_GET['prod'],$from_date,$pos,$idPer);
}
$solde=0;

if($pos=='tous')
{
$solde=$sort_det['totqt']+$vente_det['totqt'];
}
else
{
$syn_sort=$sort_det['totqt']+$vente_det['totqt']+$transf_det['totqt'];

$syn_entre=$recep_det['totqt'] + $app['totqt'] + $inv['totqt'] /*+ $production['totqt']*/ + $convers['totqt'];
$solde=$syn_entre-$syn_sort;
}

$reste +=$solde;

if($solde>=0)
{
    echo '<tr><td>'.$from_date.'</td><td>Reste entrée</td><td>-</td><td>-</td><td>'.number_format($solde,'2','.',' ').'</td><td>-</td><td>'.number_format($solde,'2','.',' ').'</td></tr>';
}
else
{
 echo '<tr><td>'.$from_date.'</td><td>Reste Sortie</td><td>-</td><td>-</td><td>'.number_format($solde,'2','.',' ').'</td><td>'.number_format($solde,'2','.',' ').'</td></tr>';
}

while (strtotime($from_date) <= strtotime($to_date))
{
if($pos=='tous')
{
$datas=$op->select_all_by_date_rap_bis($_GET['prod'],$from_date,$idPer);
}
else
{
$datas=$op->select_all_by_date_rap($_GET['prod'],$from_date,$pos,$idPer);
}
foreach ($datas as $un) {
$prod->select($un['prod_id']);
$pers2->select($un['party_code']);
$pers->select($un['personne_id']);
    if($un['op_type']=='Inventaire')
    {
    $reste +=$un['totqt'];
    echo '<tr><td>'.$un['create_date'].'</td><td>Inventaire</td><td>-</td><td>-</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>-</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
    elseif($un['op_type']=='Approvisionnement')
    {
    $reste +=$un['totqt'];
    echo '<tr><td>'.$un['create_date'].'</td><td>Approvisionnement</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>-</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
     elseif($un['op_type']=='Transfert produit' and $un['pos_id']==$pos)
    {
    $reste -=$un['totqt'];
    echo '<tr><td>'.$un['create_date'].'</td><td>Transfert des produits</td><td>-</td><td>'.$pers->getNomComplet().'</td><td>-</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
    elseif($un['op_type']=='Conversion')
    {
    $reste +=$un['totqt'];
    echo '<tr><td>'.$un['create_date'].'</td><td>Conversion</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>-</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
    elseif($un['op_type']=='Transfert produit' and $un['party_code']==$pos)
    {
    $reste +=$un['totqt'];
     echo '<tr><td>'.$un['create_date'].'</td><td>Reception des produits</td><td>-</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>-</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
    elseif($un['op_type']=='Vente')
    {
    $reste -=$un['totqt'];
     echo '<tr><td>'.$un['create_date'].'</td><td>Vente</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>-</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
    }
    elseif($un['op_type']=='Sortie')
    {
    $reste -=$un['totqt'];
     echo '<tr><td>'.$un['create_date'].'</td><td>Sortie du stock</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>-</td><td>'.number_format($un['totqt'],'2','.',' ').'</td><td>'.number_format($reste,'2','.',' ').'</td></tr>';
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

