<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$jr= new BeanJournal();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$vente= new BeanVente();
if(isset($_SESSION['jour']))
{
    $jour=$_SESSION['jour'];
}
else
{
    $jour="";
}
if($_SESSION['level']=='3')
{
$datas=$trans->select_all_jour_admin($jour);
}
else
{
$datas=$trans->select_all_jour($jour);
}
$jr->select($jour);
?>
<div class="white-box">
    <h4 class="box-title m-b-0">Transations</h4>
    <small>(Journal Du <?php echo $jr->getStartDate(); ?> Au <?php if(!empty($jr->getEndDate())) echo $jr->getEndDate(); else echo '?'; ?> )</small>
    <h5>Balance : <i><?php
    if($_SESSION['level']=='3')
    {
    echo number_format($trans->select_bal_jour_admin($jour),0,'.',',');
    }
    else
    {
    echo number_format($trans->select_bal_jour($jour),0,'.',',');
    }
     ?> BIF</i></h5>
    <hr/>

                            <div class="table-responsive">
							 <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
    <tr>
        <th>Date/Heure</th><th>Type</th><th>Description</th>
        <?php
        if($_SESSION['level']=='3')
        {
           echo '<th>Caissier</th>';
        }
        ?>
        <th>Bénéf</th><th>Debit</th><th>Credit</th><th>Post-Balance</th><th>-</th><th>-</th>
    </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $solde=0;
                                    foreach ($datas as $un) {
 $pers->select($un['party_code']);
 echo '<tr ';
if($un['canceled']=='0')
{
    echo 'style="text-decoration:line-through"';
}
 echo ' ><td>'.$un['create_date'].'</td><td>'.$un['transaction_type'].'</td><td>';

 if($un['transaction_type']=='Vente')
 {
    $vente->select($un['op_id']);
    echo 'Facture n°:';
    if($un['canceled']=='1')
    {
    echo ' <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture" data-id="'.$un['op_id'].'">'.$vente->getNumVente().'</a>';
    }
    else
    {
       echo $vente->getNumVente();
    }
    if($vente->getIsPaid()=='0')
    {
     echo '<button class=" btn btn-light btn-sm row_op_vente" data-id='.$un['op_id'].' style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></button>';
    }
 }
 else
 {
 echo $un['descript'];
 }

 echo '</td>';

if($_SESSION['level']=='3')
        {
            $pers2->select($un['personne_id']);
           echo '<td>'.$pers2->getNomComplet().'</td>';
        }

 echo '<td>';

    if(empty($pers->getNomComplet()))
    {
        echo '-';
    }
    else
    {
        echo $pers->getNomComplet();
    }
 echo '</td><td>';
 if($un['status']=='IN')
 {
 if($un['canceled']=='1')
  {
 $solde +=$un['amount'];
    }
 echo number_format($un['amount'],0,'.',',');
 }
 else
 {
    echo '0';
 }
 echo '</td><td>';
 if($un['status']=='OUT')
 {
  if($un['canceled']=='1')
  {
  $solde -=$un['amount'];
  }
  echo number_format($un['amount'],0,'.',',');
 }
 else
 {
    echo '0';
 }
 echo '</td><td>'.number_format($solde,0,'.',',').'</td><td>';
if(!empty($un['op_id']) or $un['transaction_type']=='Ouverture' or $un['personne_id']!=$_SESSION['perso_id'])
{
 echo '-';
}
elseif($un['transaction_type']=='Versement' and $un['canceled']=='1')
{
echo '<button class="btn btn-success btn-sm update_vers" name="update" id="'.$un["transaction_id"].'"><span class="fa fa-edit"></span></button>';
}
elseif($un['transaction_type']=='Retrait' and $un['canceled']=='1')
{
echo '<button class="btn btn-success btn-sm update_ret" name="update" id="'.$un["transaction_id"].'"><span class="fa fa-edit"></span></button>';
}
elseif($un['transaction_type']=='Transfert' and $un['canceled']=='1')
{
echo '<button class="btn btn-success btn-sm update_trans" name="update" id="'.$un["transaction_id"].'"><span class="fa fa-edit"></span></button>';
}
else
{
    echo '-';
}

echo '</td><td>';
if($un['transaction_type']=='Ouverture' or $un['personne_id']!=$_SESSION['perso_id'])
{
 echo '-';
}
elseif($un['canceled']=='1')
{
echo '<button class="btn btn-danger btn-sm delete_trans" name="delete" id="'.$un["transaction_id"].'"><span class="fa fa-times"></span></button>';
}
else
{
    echo 'supprimée';
}
echo '</td></tr>';
                                    }
                                    ?>
										</tbody>
							 </table>
							</div>
</div>
