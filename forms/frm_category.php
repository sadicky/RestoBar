<?php
require_once '../load_model.php';
$cat=new BeanCategory();

if(!empty($_GET['id']))
{
    $cat->select($_GET['id']);
}

echo '<input value="'.$cat->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="category_id"/>';
?>
<div class="card" >
    <div class="card-header bg-light">Categorie des Produits | <a href="javascript:void(0)" class="new_prod"><i class="fa fa-plus"></i> Nouveau produit</a></div>

    <div class="card-body">
        <form id="frm_category" method="post">
            <div class="form-body">
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Libellé</label>
                            <input type="text" id="category_name" name="cat_name" class="form-control" value="<?php if(!empty($_GET['id'])) echo $cat->getCategoryName();?>" required>
                        </div>
                    </div>
                    <!-- <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">Coeff(Intérêt %)</label>
                            <input type="number" id="coeff" name="coeff" class="form-control" value="<?php //if(!empty($_GET['id'])) echo $cat->getCoeff();?>" required>
                        </div>
                    </div> -->
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">A Vendre</label>
                            <select class="custom-select" name="is_sale" id="is_sale">
                                <?php
                                $datas=array('Oui','Non');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$cat->getIsSale())
                                    {
                                        echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Catégorie Parent</label>
                            <select name="cat_parent" id="cat_parent" class="show-tick form-control" data-live-search="true" data-style="btn-darkx" style="border:1px solid gray">
                                <option value="">Choisir Catégorie</option>
                                <?php
                                $datas=$cat->select_all();
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value['category_id']==$cat->getCategoryParent()) 
                                    {
                                        echo '<option value="'.$value['category_id'].'" selected>'.$value['category_name'].'</option>';
                                    }
                                    if($value['category_parent']==0)
                                    echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <br/>
                        <?php 
                        if(!empty($_GET['id']))
                        {
                            ?>
                        <input type="hidden" name="operation" id="operation" value="Edit" />
                        <input type="hidden" name="cat_id" id="category_id" value="<?php echo $_GET['id'];?>" />
                        <?php
                        }
                        else
                        {
                            ?>
                             <input type="hidden" name="operation" id="operation" value="Add" />
                            <?php
                        }
                        ?>
                        <input type="hidden" name="coeff" id="coeff" value="0" />
                        <label class="control-label">&nbsp;</label>
                        <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="action"> <span class="fa fa-save"></span> Enregistrer</button>

                    </div>
                </div>
            </div>
        </form>
        <div id="last_inserted">

        <div class="table-responsive">
      <table id="tabx" class="table table-bordered table-sm display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Categorie</th><th>A Vendre</th><th>&nbsp;</th><th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
         $dat1=$cat->select_all();
          foreach ($dat1 as $un) {

            $cat->select($un['category_parent']);
            
            echo '<tr><td><a href="javascript:void(0)" class="show_cont_det" id="'.$un['category_id'].'" data-id="'.$un['category_name'].'"><i class="fa fa-plus"></i> '.$un['category_name'].'</a></td><td>'.$un['is_sale'].'</td><td><button class="btn btn-sm btn-warning btn-circle new_cat" id="'.$un['category_id'].'" data-id="'.$un['category_id'].'" id="'.$un['category_id'].'"><i class="fa fa-edit"></i></button></td><td>';

            if(!$cat->exist_cat($un['category_id']))
            {
              echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un['category_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
            }
            else
            {
              echo '-';
            }

            echo '</td></tr>';

            $dat2=$cat->select_all_parent($un['category_id']);
            foreach ($dat2 as $un2) {

                echo '<tr class="det'.$un['category_id'].' hide_cont_det"><td style="padding-left:25px;">'.$un2['category_name'].'</td><td>'.$un2['is_sale'].'</td><td><button class="btn btn-sm btn-warning btn-circle new_cat" id="'.$un2['category_id'].'" data-id="'.$un2['category_id'].'" id="'.$un2['category_id'].'"><i class="fa fa-edit"></i></button></td><td>';

            if(!$cat->exist_cat($un2['category_id']))
            {
              echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un2['category_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
            }
            else
            {
              echo '-';
            }

            echo '</td></tr>';

            }
            

          }
          ?>

        </tbody>
      </table>
    </div>

        </div>
    </div>

</div>

