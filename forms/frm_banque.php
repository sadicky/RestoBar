<?php
@session_start();
require_once '../load_model.php';
//$prov = new BeanProvince();
$bq = new BeanBanque();

if(!empty($_GET['id']))
{
    $bq->select($_GET['id']);
}
?>
<form action="javascript:void(0)" id="frm_bq" method="post" enctype="multipart/form-data" class="form-horizontal">

<div class="card">
   <div class="card-header text-center">
    <strong>Banque</strong>
    </div>
    <div class="card-body card-block">

    <div class="row form-group">

         <div class="col col-md-5">
            <label class=" form-control-label">Nom banque</label>
            <input type="text" id="lib_bq" name="lib_bq"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $bq->getLibBq();?>">
        </div>
        <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">Par Défaut</label>
                            <select class="custom-select" name="status" id="status">
                                <?php
                                $datas=array('2'=>'Non','1'=>'Oui');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$bq->getStatus())
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
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Annuler
                                        </button>
                                    </div>
                                </div>
</form>
