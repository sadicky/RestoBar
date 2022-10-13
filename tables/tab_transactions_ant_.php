<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$jr= new BeanJournal();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$vente= new BeanVente();
if(isset($_GET['jour']))
{
    $jour=$_GET['jour'];
}
else
{
    $jour="";
}

$jr->select($jour);
$pers->select($jr->getPersonneId());
if($jr->getJourType()=='Parent')
{
$datas=$trans->select_all_jour_admin($jour);
}
else
{
$datas=$trans->select_all_jour($jour);
}


?>
<div class="white-box">
    <h4 class="box-title m-b-0">Transations</h4>
    <small>(Journal Du <?php echo $jr->getStartDate(); ?> Au <?php if(!empty($jr->getEndDate())) echo $jr->getEndDate(); else echo '?'; ?> )</small>
    <p>Propriétaire : <i><?php  echo $pers->getNomComplet(); ?></i></p>
    <h5>Balance : <i><?php
    if($jr->getJourType()=='Parent')
    {
    echo number_format($trans->select_bal_jour_admin($jour),0,'.',',');
    }
    else
    {
    echo number_format($trans->select_bal_jour($jour),0,'.',',');
    }
     ?>  BIF</i></h5>
    <hr/>

                            <div class="table-responsive">
							 <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
    <tr>
        <th>Date/Heure</th><th>Type</th><th>Description</th>
        <?php
        if($jr->getJourType()=='Parent')
        {
           echo '<th>Caissier</th>';
        }
        ?>
        <th>Bénéf</th><th>Debit</th><th>Credit</th><th>Post-Balance</th>
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
    echo 'Facture n°: '.$vente->getNumVente();
 }
 else
 {
 echo $un['descript'];
 }

 echo '</td>';

if($jr->getJourType()=='Parent')
        {
            $pers2->select($un['personne_id']);
           echo '<td>'.$pers2->getNomComplet().'</tdyy>';
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
 echo '</td><td>'.number_format($solde,0,'.',',').'</td></tr>';
                                    }
                                    ?>
                                        </tbody>
							 </table>
							</div>
</div>
