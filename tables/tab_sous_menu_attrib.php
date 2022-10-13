<?php
require_once '../load_model.php';
$mn= new BeanMenu();
$menu=$mn->select_all_menu_type($_POST['menu_id']);
$mn->select($_POST['menu_id']);
$attrib= new BeanAttributionMenu();
?>
<table class="table table-bordered">
<thead>
        <tr><th>Sous Menu de :<?php echo $mn->getMenuText(); ?> <input value="<?php echo $mn->getMenuId(); ?>" type="hidden" id="pr_menu_id"></th></tr>
    </thead>
    <tbody>
<?php
foreach ($menu as $value) {
$nb=$attrib->select_attrib_perso($_POST['perso_id'],$value['menu_id']);
if($nb==0)
{
 if($value['menu_id_text']=='' and $value['menu_parent']!='0')
 {
echo '<tr class="row_add_sm" data-id='.$value['menu_id'].' style="cursor:pointer"><td><i class="fa fa-plus"></i> '.$value['menu_text'].' (Group)</td></tr>';
  }
  else
  {
    echo '<tr class="row_add_sm" data-id='.$value['menu_id'].' style="cursor:pointer"><td><i class="fa fa-plus"></i> '.$value['menu_text'].' </td></tr>';
  }
}
}
?>
</tbody>
</table>
