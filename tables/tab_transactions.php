<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$jr= new BeanJournal();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$vente= new BeanVente();
$paie=new BeanPaiement();
$bank=new BeanBanque();
$bq=0;
if(isset($_SESSION['jour']))
{
    $jour=$_SESSION['jour'];
}
else
{
    $jour="";
}
$titre="JOURNAL GENERAL DES OPERATIONS";
/*if($_SESSION['level']=='3')
{*/
if(isset($_POST['select_type_jour']))
{
    if($_POST['select_type_jour']=='Tous')
    {
     $datas=$trans->select_all_jour_admin($jour);
     $titre="JOURNAL GENERAL DES OPERATIONS";
    }
    else
    {
     $datas=$trans->select_all_jour_admin_typ($jour,$_POST['select_type_jour']);
     if($_POST['select_type_jour']=='Caisse')
        {
            $titre="JOURNAL DES OPERATIONS DES VENTES";
        }
        else
        {
            $titre="JOURNAL DES OPERATIONS DE FONDS DE CAISSE";
        }
    }
}
else
{
$datas=$trans->select_all_jour_admin($jour);
}
/*}
else
{
$datas=$trans->select_all_jour($jour);
}*/
$jr->select($jour);
?>
<div class="white-box">
    <h4 class="box-title m-b-0">Journal de Caisse</h4>
    <small>(Journal Du <?php echo $jr->getStartDate(); ?> Au <?php if(!empty($jr->getEndDate())) echo $jr->getEndDate(); else echo '?'; ?> )</small>
    <div class="row">
        <div class="col-md-5">
    <h5>Balance Caisse : <i><?php
    
    echo number_format($trans->select_bal_jour_admin($jour),0,'.',',');
    
     ?> BIF</i></h5>
     <h5>Balance Hors Cqisse : <i><?php
    
    echo number_format($trans->select_bal_jour_admin_bq($jour),0,'.',',');
    
     ?> BIF</i></h5></div>
     <div class="col-md-5">
         <div style="width: 200px;">
        <select class="form-control select2" id="select_type_jour" name="select_type_jour" required>
                <option value="">-- Choisir --</option>
                <?php
                  $mode=$bank->select_all();
                  foreach($mode as $e)
                    {
                    echo '<option value="'.$e['lib_bq'].'">'.$e['lib_bq'].'</option>';
                    }
            ?>
            </select>
        </div>
     </div>
 </div>
    <hr/>
<a href="javascript:void(0)" id="print_rap" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
                            <div class="table-responsive" id="print_rap_f">
    <H3><?php echo $titre; ?></H3>
							 <table border="1" id="example2x" class="table table-bordered table-condensed display" cellspacing="0" width="100%" style="font-size:12px;">
							 <thead>
    <tr>
        <th>Date/Heure</th><th>Description</th>
        <?php
        
           //echo '<th>Caissier</th>';
        
        ?>
        <th>Debit</th><th>Credit</th><th>Caisse</th><th>Hors Caisse</th>
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
 echo ' ><td>'.date("d-m-Y h:i:s", strtotime($un['create_date'])).'</td>';
 echo '<td>';

 $vente->select($un['op_id']);
    $paie->select_by_trans($un['transaction_id']);




 if($un['transaction_type']=='Vente')
 {
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
 echo '<td>';
 if($un['status']=='IN')
 {

    if($un['canceled']=='1')
    {
        if($un['mode_paie']=='Caisse')
        {
        $solde +=$un['amount'];
        }
        else
        {
            $bq +=$un['amount'];
        }
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
        if($paie->getModePaie()=='Caisse' or $un['mode_paie']=='Caisse')
        {
        $solde  -=$un['amount'];
        }
        else
        {
        $bq -=$un['amount'];
        }
  }
  echo number_format($un['amount'],0,'.',',');
 }
 else
 {
    echo '0';
 }
 echo '</td>';/*<td>'.number_format($solde+$bq,0,'.',',').'</td>*/echo '<td><b>'.number_format($solde,0,'.',',').'</b></td><td><b>'.number_format($bq,0,'.',',').'</b></td>';
/*if(!empty($un['op_id']) or $un['transaction_type']=='Ouverture' or $un['personne_id']!=$_SESSION['perso_id'])
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
}*/
//echo '-';
echo '</tr>';
                                    }
                                    ?>
										</tbody>
							 </table>
							</div>
</div>
