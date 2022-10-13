<?php
@session_start();
require_once '../load_model.php';
//$prov = new BeanProvince();
$paie = new BeanTransactions();
$bq=new BeanBanque();

if(!empty($_GET['id']))
{
    $paie->select($_GET['id']);

}
?>
<div class="pl-1 m-2" style="border: 1px gray solid; border-radius: 5px;">
<form action="javascript:void(0)" id="frm_trans" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="row">

        <div class="col col-md-2">
            <label class=" form-control-label">Date</label>
            <input type="date" id="date_trans" name="date_trans"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $paie->getCreateDate(); else echo date('Y-m-d');?>" required>
        </div>

        <div class="col col-md-2">
            <label class=" form-control-label">Montant</label>
            <input type="number" id="mont_trans" name="mont_trans"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $paie->getAmount(); else '0';?>" required>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Provenance</label>
                <select id="id_bq" name="id_bq" class="custom-select" required>
                    <option value="">-- Choisir --</option>
                    <?php
                    $mode=$bq->select_all();
                    foreach($mode as $e)
                    {
                        if(!empty($_GET['id']) and $e['id_bq']==$paie->ModePaie() and $paie->getStatus()=='OUT') 
                        {
                            echo '<option value="'.$e['id_bq'].'" selected>'.$e['lib_bq'].'</option>';
                        }
                        echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <label class="control-label">Destination</label>
            <select id="id_bq2" name="id_bq2" class="custom-select">
                <option value="">-- Choisir --</option>
                <?php
                $mode=$bq->select_all();
                foreach($mode as $e)
                {
                    if(!empty($_GET['id']) and $e['id_bq']==$paie->getModePaie() and $paie->getStatus()=='IN') 
                    {
                        echo '<option value="'.$e['id_bq'].'" selected>'.$e['lib_bq'].'</option>';
                    }
                    echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Mode Paiement</label>
                                <select id="mode_paie" name="mode_paie" class="custom-select" required>

                                    <?php
                                    $dat = array('Espèce','Chèque','Virement');
                                    foreach ($dat as $key => $value) {

                                        if(!empty($_GET['id']) and $value==$paie->getModePaie())
                                        {
                                            echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                        }
                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
        <div class="col-md-1">

            <?php
            if(!empty($_GET['id']))
            {
                ?>
                <input type="hidden" id="operation" name="operation" value="Edit">
                <input type="hidden" id="trans_id" name="trans_id" value="<?php echo $_GET['id']; ?>">
                <?php
            }
            else
            {
                ?>
                <input type="hidden" id="operation" name="operation" value="Add">
                <?php
            }
            ?>
            <br/>
            <button type="submit" name="enregistrer" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i>
            </button>
        </div>
    </div>
</form>
</div>