<?php
@session_start();
require_once '../load_model.php';
//$prov = new BeanProvince();
$typ = new BeanTypeDep();

if(!empty($_GET['id']))
{
    $typ->select($_GET['id']);
}
?>
<div class="p-2 m-2" style="border: 1px gray solid; border-radius: 5px;">
<form action="javascript:void(0)" id="frm_typ_dep" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="row ">

        <div class="col col-md-5">
            <label class=" form-control-label">Libellé</label>
            <input type="text" id="lib_typ" name="lib_typ"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $typ->getLibTyp();?>">
        </div>
        <div class="col col-md-3">
            <br>
            <input type="hidden" id="idmod" name="idmod" value="<?php if(!empty($_GET['id'])) {echo $_GET['id']; }?>">
            <input type="hidden" id="operation" name="operation" value="<?php if(!empty($_GET['id'])) {echo 'Edit';} else { echo 'Add';}?>">
            <button type="submit" name="enregistrer" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> <?php
                if(!empty($_GET['id']))
                {
                    echo 'Modifier';
                }
                else
                {
                    echo 'Enregistrer';
                }
                ?>
            </button>

        </div>
    </div>

</form>
</div>