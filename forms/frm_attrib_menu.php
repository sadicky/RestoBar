
<?php
require_once '../load_model.php';

$perso=new BeanPersonne();
$mn= new BeanMenu();
$attrib= new BeanAttributionMenu();
$menu=$mn->select_all_menu_type("");
$perso->select($_POST['perso_id']);
?>

<h4>Attribution des menus aux utilisateurs</h4><hr/>
<section class="row">
<div class="col-lg-4 " >
<div class="alert alert-info" style="background-color: white;" id="list_menu_attrib">
<table class="table table-bordered">
    <thead>
        <tr><th>Menu Principal</th></tr>
    </thead>
    <tbody>
<?php
foreach ($menu as $value) {
echo '<tr class="row_menu" data-id='.$value['menu_id'].' style="cursor:pointer"><td>'.$value['menu_text'].' <span class="fa arrow"></span> </td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
<div class="col-lg-4 " >
<div class="alert alert-info" style="background-color: white;" id="list_sub_menu_attrib">
<table class="table table-bordered">
<thead>
        <tr><th>Sous-Menu</th></tr>
    </thead>
    <tbody>
<?php
/*foreach ($menu as $value) {
echo '<tr><td>'.$value['menu_text'].'</td></tr>';
}*/
?>
</tbody>
</table>
</div>
</div>
<div class="col-lg-4 " >
<div class="alert alert-info" style="background-color: white;" id="tab_user_attrib_menu">
<table class="table table-bordered">
<thead>
        <tr><th>Utilisateur : <?php echo $perso->getNomComplet(); ?> <input value="<?php echo $_POST['perso_id']; ?>" type="hidden" id="attrib_person"> </th></tr>
    </thead>
    <tbody>
<?php
/*$datas=$attrib->select_all($_POST['perso_id']);
foreach ($datas as $value) {
echo '<tr class="row_del_sm" id='.$value['attrib_id'].' style="cursor:pointer"><td> <i class="fa fa-plus"></i> '.$value['menu_text'].'</td></tr>';
}*/
?>
</tbody>
</table>
</div>
</div>
</section>

