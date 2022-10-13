
<?php
@session_start();
require_once '../load_model.php';

$perso=new BeanPersonne();
$prod= new BeanProducts();
$prod2= new BeanProducts();
$compo= new BeanComposition();
$menu=$prod->select_all_menu('Non','Oui');
$ing=$prod2->select_all_menu('Non','Oui');;

?>

<h4>Composition</h4><hr/>
<section class="form-row">
<div class="col-md-3 " >

<table class="table table-bordered" id="tab1">
    <thead>
        <tr><th>Menu</th></tr>
    </thead>
    <tbody>
<?php
foreach ($menu as $value) {
echo '<tr class="row_menu_resto" data-id='.$value['prod_id'].' style="cursor:pointer"><td>'.$value['prod_name'].' <span class="glyphicon glyphicon-edit"></span> </td></tr>';
}
?>
</tbody>
</table>
</div>
<div class="col-md-3 " id="tab_compo_ingred">
<table class="table table-bordered" id="tab2">
<thead>
        <tr><th>Ingredients***</th><th>UM</th></tr>
    </thead>
    <tbody>
<?php
foreach ($ing as $value) {
echo '<tr class="row_add_ing" data-id='.$value['prod_id'].' style="cursor:pointer"><td>'.$value['prod_name'].'</td> <td>'.$value['unt_mes'].'</td></tr>';
}
?>
</tbody>
</table>
</div>
<div class="col-md-6 " id="tab_det_compo">

</div>
</section>

