<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$tar=new BeanTarif();
$pos=new BeanPos();
$per=new BeanPeriode();
$op=new BeanOperation();
$det = new BeanDetailsOperation();

$per->select($_POST['id_per']);
$pos->select($_POST['pos_id']);
?>
<div class="white-box">
  <h3 class="box-title m-b-0">Point de vente : <?php echo $pos->getPosName(); ?> - Tarif : <?php echo $tar->getTarName(); ?> - FICHE D'INVENTAIRE DU <?php echo $per->getDebut(); ?></h3>

  <div class="table-responsive">
    <!-- <p><a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Détail</a></p> -->
    <form method="post" id="frm_det_inv" autocomplete="off">
      <div class="row m-1 pb-1" style="border: 1px gray solid; border-radius: 5px">
        <div class="col-md-5">
          <label class="control-label">Produit</label>
          <div class="input_container">
          <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value="" required> 
          <ul id="content_list_prod"></ul>
          <input type="hidden" name="prod_id" id="prod_id" value="" />
          </div>
        </div>
        <div class="col-md-3 p-1">
          <label class="control-label">Prix</label>
          <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="col-md-2">
          <label class="control-label">Qt</label>
          <input type="number" name="qt" id="qt" class="form-control">
        </div>
        <!-- <div class="col-md-3 p-1">
          <label class="control-label" style="display: block">Exp (Mois/Année)</label> -->
          <input type="hidden" name="m_exp" id="m_exp" class="form-control w-50" value="<?php echo date('m');?>" style="float: left">
          <input type="hidden" name="y_exp" id="y_exp" class="form-control w-50" value="<?php echo date('y');?>">
        <!-- </div> -->
        <div class="col-md-1 p-1">
          <br>
          <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i></button>
          <input type="hidden" name="op_id" id="op_id" value="<?php echo $_SESSION['op_inv_id']?>">
          <input type="hidden" name="det_id" id="det_id" value="">
          <input type="hidden" name="operation" id="operation_inv" value="Add">
        </div>
      </div>
    </form>
    <table class="table table-striped table-bordered table-hover" id="tab2">
      <thead>
        <tr>
          <th>Categorie</th><th>Produit</th><th>Qt</th></th><th>Prix</th><th>-</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $datas=$det->select_all_by_type('Inventaire',$_POST['id_per'],$_POST['pos_id']);
        foreach ($datas as $un) {

          $prod->select($un['prod_id']);
          $cat->select($prod->getCategoryId());

          echo '<tr>
          <td>'.$cat->getCategoryName().'</td><td>'.$prod->getProdName().'</td>
          <td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="quantity">'.$un['quantity'].'</td>
          <td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="amount">'.$un['amount'].'</td>
          <td>
          <button class="btn btn-sm btn-warning btn-circle fetch_inv_op" id="'.$un['details_id'].'" data-id="'.$un['details_id'].'"><i class="fa fa-edit"></i></button>

          <button class="btn btn-sm btn-danger btn-circle del_det_inv" id="'.$un['details_id'].'" data-id="'.$un['details_id'].'"><i class="fa fa-times"></i></button>

          </td>
          ';

          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
