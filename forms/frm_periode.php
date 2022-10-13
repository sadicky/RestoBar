<?php
@session_start();
require_once '../load_model.php';
//$prov = new BeanProvince();
$per = new BeanPeriode();
$tar =new BeanTarif();
$pos =new BeanPos();
if(!empty($_GET['id']))
{
    $per->select($_GET['id']);
}

echo '<input value="'.$per->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="id_per">';
?>

<div class="card">
    <div class="card-header text-center">
        <strong>Période</strong>
    </div>
    <div class="card-body card-block">
        <div class="row">
            <div class="col-md-5">
                <form action="javascript:void(0)" id="frm_periode" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row p-2 mb-2" style="border: 1px gray solid; border-radius: 5px;">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Code</label>
                            <input type="text" id="lib" name="lib"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $per->getCodePer();?>" required>
                        </div>
                        <div class="col col-md-5">
                            <label class=" form-control-label">Début</label>
                            <input type="date" id="debut" name="debut"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $per->getDebut(); else echo date('Y-m-d');?>" required>
                        </div>
                        <div class="col col-md-3">
                            <label class=" form-control-label">Encours :</label>
                            <select class="custom-select" name="enc" id="enc">
                                <?php
                                $datas=array('1'=>'Oui',''=>'Non');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$per->getCrt())
                                    {
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col col-md-1">
                            <br>
                            <input type="hidden" id="idmod" name="idmod" value="<?php  if(!empty($_GET['id'])) { echo $_GET['id'];}?>">
                            <input type="hidden" id="operation" name="operation" value="<?php if(!empty($_GET['id'])) {echo 'Edit';} else { echo 'Add';}?>">
                            <button type="submit" name="enregistrer" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-sm table-striped display" id="tab">
                    <thead class="thead-dark">
                        <tr>
                            <th>Code</th><th>Debut</th><th>Fin</th><th>Etat</th><th>-</th><th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $datas=$per->select_all();

                        foreach ($datas as $key => $value) {

                            echo '<tr><td>'.$value['code_per'].'</td><td>'.$value['debut'].'</td><td>'.$value['fin'].'</td><td>';
                            if($value['crt']=='1')
                            {
                                echo 'Encours';
                            }
                            else
                            {
                                echo 'Ancienne';
                            }

                            echo '</td><td>';
                            echo '<button class="btn btn-warning btn-sm nv_periode" data-id="'.$value['id_per'].'" data-id="1"><i class="fa fa-edit"></i></button>';
                            echo '</td><td>';
                            if(!$per->exist_per($value['id_per']))
                            {
                                echo '<button class="btn btn-danger btn-sm trash_stk" id="'.$value['id_per'].'" data-id="'.$value['id_per'].'"><i class="fa fa-times"></i></button>';
                            }
                            else
                            {
                                echo '-';
                            }

                            echo '</td></tr>';


                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-7">
                <?php include('frm_inventaire.php'); ?>
                <hr style="color:blue;" />
                <div class="details_inv">
                <h3>Fiche d'Inventaire - Pos : ? - Tarif : ?</h3>
                </div>
            </div>
        </div>
    </div>
</div>