<?php
@session_start();
require_once '../load_model.php';
$prod= new BeanProducts();
$jr= new BeanJournal();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$paie= new BeanPaiement();
$op= new BeanOperation();
$trans=new BeanTransactions();
$stock = new BeanStock();
$pr=new BeanPrice();
$vente= new BeanVente();
$cat=new BeanCategory();


if(empty($_GET['jour']))
{
    $jour=$_SESSION['jour'];
}
else
{
    $jour=$_GET['jour'];
}

if(empty($_GET['date_from']))
{
    $dateFrom=date('Y-m-d', strtotime(date("Y-m-d"). ' - 15 days'));
    $dateTo=date('Y-m-d');
}
else
{
    $dateFrom=$_GET['date_from'];
    $dateTo=$_GET['date_to'];
}

$jr->select($jour);
?>
<div class="row">
<div class="col-md-6">
<form method="post" id="jr-search">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">Du</label>
                        <input type="date" name="date_from" id="date_from" class="form-control" value="<?php if(!empty($_GET['date_from'])) echo $_GET['date_from']; else echo $dateFrom; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Au</label>
                        <input type="date" name="date_to" id="date_to" class="form-control" value="<?php if(!empty($_GET['date_to'])) echo $_GET['date_to']; else echo $dateTo; ?>">
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
    <hr>
        <table class="table table-bordered table-sm" id="tab">
            <thead>
                <th>Id</th><th>Date - heure</th><th>Caissiers</th><th>Balance</th>
            </thead>
            <tbody>
                <?php
                if(empty($_GET['date_from']))
                {
                $datas=$jr->select_all_last_15();
                }
                else
                {
                $datas=$jr->select_all_by_date($dateFrom,$dateTo);
                }
                foreach ($datas as $key => $value) {
                    if($value['closing_bal']>0)
                    {
                    $pers->select($value['personne_id']);
                    echo '<tr style="cursor:pointer;" class="crt-jr" data-id="'.$value['jour_id'].'"><td>'.$value['jour_id'].'</b></td><td><b>'.$value['start_date'].'</b> Au <b>'.$value['end_date'].'</b></td><td>'.$pers->getNomComplet().'</td><td align="right">'.number_format($value['closing_bal']).'</td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>    
</div>
<div class="col-md-6">
    
<a href="javascript:void(0)" id="print_rp" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
<div class="form-row">
<div class="col-md-3">
<label class="control-label">Categorie</label>
<select class="custom-select" id="crt_cat">
    <option value="">Tous</option>
<?php
$datas=$cat->select_all();
foreach ($datas as $key => $value) {
   echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
}
?>
</select>
<input type="hidden" name="jour" id="crt_jour" value="<?php echo $jour;?>">
</div>
</div>
<div class="white-box" id="rapport">
    <h4 class="box-title m-b-0">Rapport de Synthèse de Caisse</h4>
    <small>(Journal Du <?php echo $jr->getStartDate(); ?> Au <?php if(!empty($jr->getEndDate())) echo $jr->getEndDate(); else echo '?'; ?> )</small>
 <?php   if(empty($_GET['crt_cat']))
{
    ?>
    <h5>Balance : <i><?php
    echo number_format($trans->select_bal_jour($jour));
     ?> BIF</i></h5><?php } else { $cat->select($_GET['crt_cat']); echo '<h4>Categorie : '.$cat->getCategoryName();} ?>
    <hr/>
    <hr/>

                            <div class="table-responsive">

               <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%" border="1">
               <thead>
    <tr>
        <th>Libellé</th><th>Qt</th><th>Montant</th>
    </tr>
                            </thead>

                                    <tbody>
<?php
$tot=0;
$i=1;
$datas=$op->select_all_role_jour('Vente',$jour);
foreach ($datas as $key => $value) {
    $prod->select($value['prod_id']);
    $cat->select($prod->getCategoryId());
    if(empty($_GET['crt_cat']))
    {
    $tot +=$value['price'];
    echo '<tr><td>'.$prod->getProdName().'</td><td align="right">'.number_format($value['qt'],'1','.',',').'</td><td align="right">'.number_format($value['price'],'0','.',',').'</td></tr>';
    }
    else
    {
    if($_GET['crt_cat']==$cat->getCategoryParent())
    {    
    $tot +=$value['price'];
    echo '<tr><td>'.$prod->getProdName().'</td><td align="right">'.number_format($value['qt'],'1','.',',').'</td><td align="right">'.number_format($value['price'],'0','.',',').'</td></tr>';
    }
    }

    $i++;
}
$datas=$op->select_all_aut_jour('Vente',$jour);
foreach ($datas as $key => $value) {
    echo ' <tr><td colspan="2">'.$value['aut_det'].'</th><td style="text-align: right">'.$value
    ['amount'].'</td></tr>';
    $tot +=$value['amount'];
}
?>
<?php
if(empty($_GET['crt_cat']))
{
?>
    <tr><th colspan="2">Total Cash</th><th style="text-align: right"><?php
    $cash=$trans->select_sum_op_cash($jour);
    echo number_format($cash); ?></th></tr>
    <tr><th colspan="2">Total Crédit </th><th style="text-align: right"><?php $paie_cash=$cash;
    echo number_format($tot-$paie_cash,'0','.',','); ?></th></tr>
<?php
}
?>
    <tr><th colspan="2">Total Vente</th><th style="text-align: right"><?php echo number_format(($tot),'0','.',','); ?></th></tr>
<?php
if(empty($_GET['crt_cat']))
{
?>
    <tr><th colspan="2">Paiements</th><th style="text-align: right"><?php
   $ant=$trans->select_sum_op_ant($jour);
   echo number_format($ant,'0','.',','); ?></th></tr>
    
    <tr><th colspan="2">Solde (Cash) </th><th style="text-align: right"><?php $solde=($paie_cash+$ant);
    echo number_format($solde,'0','.',','); ?></th></tr>
<?php
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
</div>
</div>