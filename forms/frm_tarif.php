<?php
@session_start();
require_once '../load_model.php';

$tar = new BeanTarif();

if(!empty($_GET['id']))
{
    $tar->select($_GET['id']);
}
?>
<form action="javascript:void(0)" id="frm_tarif" method="post" enctype="multipart/form-data" class="form-horizontal">

    <div class="card">
        <div class="card-header text-center">
            <strong>Tarif</strong>
        </div>
        <div class="card-body card-block">

            <div class="row">

                <div class="col col-md-1">
                    <label class=" form-control-label">Code</label>
                    <input type="text" id="tar_code" name="tar_code"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $tar->getTarCode();?>">
                </div>
                <div class="col col-md-3">
                    <label class=" form-control-label">Libellé</label>
                    <input type="text" id="tar_name" name="tar_name"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $tar->getTarName();?>">
                </div>

                <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">Par Défaut</label>
                            <select class="custom-select" name="status" id="status">
                                <?php
                                $datas=array('2'=>'Non','1'=>'Oui');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$tar->getStatus())
                                    {
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">Stockable</label>
                            <select class="custom-select" name="is_stock" id="is_stock">
                                <?php
                                $datas=array('1'=>'Oui','2'=>'Non');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$tar->getIsStock())
                                    {
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


            </div>


        </div>
        <div class="card-footer">
            <input type="hidden" id="tar_id" name="tar_id" value="<?php if(!empty($_GET['id'])) {echo $_GET['id']; }?>">
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
