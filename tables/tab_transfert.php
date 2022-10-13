<?php
@session_start();
require_once '../load_model.php';
$paie = new BeanTransactions();
$bqFrom = new BeanBanque();
$bqTo = new BeanBanque();

$type='Transfert';
if(!empty($_GET['from_d']))
{
$bqId=$_GET['bq_id'];
$from_d=$_GET['from_d'];
$to_d=$_GET['to_d'];
}
else
{
$bqId='';
$from_d=date('Y-m-d');
$to_d=date('Y-m-d');
}
?>
<div class="card">
<div class="card-header">

<?php
echo '<input value="'.$paie->getTableName().'" type="hidden" name="table_name" id="table_name">';
echo '<input value="idp" type="hidden" name="idp" id="id_name">';
echo '<input value="table_trans" type="hidden" name="tab_paie" id="tab_name">';

?>
<h3> Opérations de Caisse (Transfert)</h3>

</div>

<div class="card-body">
<?php
include('../forms/frm_trans.php');
?>

<form id="frm_srch_rap_trans" method="post">
<div class="form-body">
<div class="form-row">
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Du : </label>
<input type="date" id="from_d" name="from_d" class="form-control" value="<?php if(!empty($_GET['from_d'])) echo $_GET['from_d']; else echo date("Y-m-d"); ?>" required>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Au : </label>
<input type="date" id="to_d" name="to_d" class="form-control" value="<?php if(!empty($_GET['to_d'])) echo $_GET['to_d']; else echo date("Y-m-d"); ?>" required>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Provenance</label>
<select name="bq_id" id="bq_id" class="custom-select">
<option value="" selected>Tous</option>
<?php
$mode=$bq->select_all();
foreach($mode as $e)
{
if($e['id_bq']==$_GET['bq_id']) {echo '<option value="'.$e['id_bq'].'" selected>'.$e['lib_bq'].'</option>';}
echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-md-2" >
<div class="form-group" style="bottom:0;">
&nbsp;<br/>
<button id="action" data-id="Add" type="submit" class="btn btn-success btn-sm" name="search"> <span class="fa fa-search"></span> Recherche</button>
</div>
</div>
</div>
</div>
</form>
<table class="table table-bordered table-sm table-striped display" id="tab">
<thead class="thead-dark">
<tr>
<th>Date</th><th>Libellé</th><th>Montant</th><th>Origine</th><th>Destination</th><th>Mode de Paiement</th><th>-</th>
</tr>
</thead>
<tbody>
<?php
if(empty($bqId))
{
$datas=$paie->select_all_type_period($type,$from_d,$to_d);
}
else
{
$datas=$paie->select_all_type_period_bq($type,$from_d,$to_d,$bqId);
}

foreach ($datas as $key => $value) {




if($value['status']=='IN' and empty($bqId))
{
$bqTo->select($value['id_bq']);
$paie->select($value['party_code']);
$bqFrom->select($paie->getIdBq());

echo '<tr><td>'.date('d-m-Y',strtotime($paie->date_format($value['create_date']))).'</td><td>'.$value['descript'].'</td><td align="right">'.$value['amount'].'</td><td>'.$bqFrom->getLibBq().'</td><td>'.$bqTo->getLibBq().'</td><td>'.$value['mode_paie'].'</td><td><button class="btn btn-danger btn-sm trash_trans" data-id="'.$value['transaction_id'].'"><i class="fa fa-times"></i></button></td></tr>';  
}
elseif(!empty($bqId))
{
if($value['status']=='IN')
{
$bqTo->select($value['id_bq']);
$paie->select($value['party_code']);
$bqFrom->select($paie->getIdBq());
}
else
{
$bqFrom->select($value['id_bq']);
$paie->select($value['party_code']);
$bqTo->select($paie->getIdBq());
}
echo '<tr><td>'.date('d-m-Y',strtotime($paie->date_format($value['create_date']))).'</td><td>'.$value['descript'].'</td><td align="right">'.$value['amount'].'</td><td>'.$bqFrom->getLibBq().'</td><td>'.$bqTo->getLibBq().'</td><td>'.$value['mode_paie'].'</td><td><button class="btn btn-danger btn-sm trash_trans" data-id="'.$value['transaction_id'].'"><i class="fa fa-times"></i></button></td></tr>';  
} 

}
?>
</tbody>
</table>

</div>
<div class="card-footer">

</div>
</div>
