<?php
@session_start();
require_once '../load_model.php';

$tar = new BeanTarif();
$pr = new BeanPrice();
$prod= new BeanProducts();

$prod->select($_GET['prod_id']);

if(!empty($_GET['id']))
{
    $pr->select($_GET['id']);
}
?>
<div class="card">
    <div class="card-header text-center">
        <strong>Tarif par Article : <?php echo $prod->getProdName();?></strong>
    </div>
    <div class="card-body card-block">
        <div class="row">
            <div class="col-md-6">
                <form action="javascript:void(0)" id="frm_tarif_art" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row p-2" style="border: 2px gray solid;">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tarif</label>
                                <select name="tar_id" id="tar_id" class="show-tick form-control" data-live-search="true" data-style="btn-darkx" style="border:1px solid gray" required>
                                    <option value="">-- Choisir --</option>
                                    <?php
                                    $datas=$tar->select_all();
                                    foreach ($datas as $key => $value) {
                                        if(!empty($_GET['id']) and $value['tar_id']==$pr->getTarId()) 
                                        {
                                            echo '<option value="'.$value['tar_id'].'" selected>'.$value['tar_name'].'</option>';
                                        }
                                        if(!$tar->exist_tar_prod($value['tar_id'],$_GET['prod_id'])) 
                                        {
                                            echo '<option value="'.$value['tar_id'].'">'.$value['tar_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-3">
                            <label class=" form-control-label">Prix</label>
                            <input type="number" id="price" name="price"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $pr->getPrice();?>" required>
                        </div>
                        <div class="col col-md-2">
                            <label class=" form-control-label">Unité</label>
                            <input type="number" id="unt" name="unt"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $pr->getUnt(); else echo '1';?>" required>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Unité Mesure</label>
                                <select id="unt_mes" name="unt_mes" class="custom-select" required>

                                    <?php
                                    $dat = array('Pce','Crt','Plat');
                                    foreach ($dat as $key => $value) {

                                        if(!empty($_GET['id']) and $value==$pr->getUntMes())
                                        {
                                            echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                        }
                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-2">

                            <br/>
                            <input type="hidden" id="prod_id" name="prod_id" value="<?php echo $_GET['prod_id']; ?>">
                            <input type="hidden" id="price_id" name="price_id" value="<?php if(!empty($_GET['id'])) {echo $_GET['id']; }?>">
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
            <div class="col-md-6">
                <?php
                echo '<input value="'.$pr->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="price_id">';
                ?>
                <table class="table table-bordered table-sm display">
                    <thead>
                        <tr><th>Tarif</th><th>Prix</th><th>Unité</th><th>Unité de Mesure</th><th>Dernière modification</th><th>-</th><th></th>
                        </thead>
                        <tbody>
                            <?php
                            $datas=$pr->select_all_art($_GET['prod_id']);
                            foreach ($datas as $key => $value) {
                                $tar->select($value['tar_id']);
                                echo '<tr><td>'.$tar->getTarName().'</td><td>'.$value['price'].'</td><td>'.$value['unt'].'</td><td>'.$value['unt_mes'].'</td><td>'.$value['last_update'].'</td>
                                <td>
                                <button class="btn btn-sm btn-warning btn-circle new_tarif_art" id="'.$value['price_id'].'" data-id="'.$value['prod_id'].'"><i class="fa fa-edit"></i>
                                </button>
                                </td><td>
                                    <button class="btn btn-danger btn-sm trash_art" id="'.$value['price_id'].'" data-id="1"><i class="fa fa-times"></i></button>
                                    </td></tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

