<?php
require_once '../load_model.php';
$mn= new BeanMenu();
$perso=new BeanPersonne();
$attrib= new BeanAttributionMenu();

$perso->select($_POST['perso_id']);

?>
<table class="table table-bordered">
<thead>
        <tr><th>Utilisateur : <?php echo $perso->getNomComplet(); ?> <input value="<?php echo $_POST['perso_id']; ?>" type="hidden" id="attrib_person"> </th></tr>
    </thead>
    <tbody>
<?php
$datas=$attrib->select_all_2($_POST['perso_id'],$_POST['menu_id']);
foreach ($datas as $value) {
  if($value['menu_id_text']=='' and $value['menu_parent']!='0')
 {
echo '<tr class="row_del_sm" id='.$value['attrib_id'].' style="cursor:pointer"><td> <i class="fa fa-minus"></i> '.$value['menu_text'].' (Group)</td></tr>';
  }
  else
  {
   echo '<tr class="row_del_sm" id='.$value['attrib_id'].' style="cursor:pointer"><td> <i class="fa fa-minus"></i> '.$value['menu_text'].'</td></tr>';
  }
}
?>
</tbody>
</table>
