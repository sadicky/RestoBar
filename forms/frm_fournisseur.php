<?php
require_once '../load_model.php';
$pers= new BeanPersonne();
$sup= new BeanSupplier();

if(!empty($_GET['id']))
{
    $pers->select($_GET['id']);
    $sup->select($_GET['id']);
}
echo '<input value="'.$pers->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="personne_id">';
?>
<div class="card" >
  <div class="card-header bg-light"><h3>Fournisseurs (*Champs obligatoire)<h3></div>
  <div class="card-wrapper">
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <form id="frm_fournisseur" method="post" autocomplete="off">
            <div class="form-body  p-1 mb-2" style="border: 1px gray solid; border-radius: 5px;">
              <div class="row" >
                <div class="col-md-4">
                  <label class="control-label">Code</label>
                  <input type="text" id="sup_code" name="sup_code" class="form-control" value="<?php if(!empty($_GET['id'])) echo $sup->getSupCode(); else echo $pers->select_code('Supplier');?>">
                </div>
                <div class="col-md-8">
                  <label class="control-label">Nom*</label>
                  <input type="text" id="nom" name="nom" class="form-control" required value="<?php if(!empty($_GET['id'])) echo $pers->getNomComplet();?>">
                </div>
                <div class="col-md-5">
                  <label class="control-label">Tél</label>
                  <input type="number" id="tel" name="tel" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pers->getContact();?>">
                </div>
                <div class="col-md-3">
                  <br>
                  <?php 
                            if(!empty($_GET['id']))
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Edit" />
                                <input type="hidden" name="personne_id" id="pes=rsonne_id" value="<?php echo $_GET['id'];?>" />
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Add" />
                                <?php
                            }
                            ?>

                  <button id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer"><i class="fa fa-save"></i></button>
                </div>
              </div>
            </div>
          </form>
       
          <div class="table-responsive">
            <table id="tab" class="table table-bordered table-sm table-striped display">
              <thead>
                <tr>
                  <th>Nom</th><th>Code</th><th>Tel</th><th>-</th><th>-</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $datas=$pers->select_all_role('supplier');
                foreach ($datas as $un) {
                  $sup->select($un['personne_id']);

                  echo '<tr><td><a href="javascript:void(0)" class="sup_det_pay" data-id="'.$un['personne_id'].'">'.$un['nom_complet'].'</a></td><td>'.$sup->getSupCode().'</td><td>'.$un['contact'].'</td><td>

                  <button class="btn btn-warning btn-sm btn-circle edit_sup" data-id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>
                  </td><td>';

                  if(!$pers->exist_party($un['personne_id'])){
                    echo '<button class="btn btn-danger btn-sm btn-circle trash_stk" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                  }
                  else {
                    echo '-';
                    }
                  echo '</td>';
                  echo '</tr>';

                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-7 sup_paie">
          
        </div>
      </div>
    </div>
  </div>
</div>
