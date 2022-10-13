<?php
require_once '../load_model.php';

$mn=new BeanMenu();
if(!empty($_GET['id']))
{
  $mn->select($_GET['id']);
}
?>
<div class="card" >
  <div class="card-header bg-light">Menu de Navigation</div>

  <div class="card-body">
    <form id="frm_send_menu" method="post">
      <div class="form-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Texte</label>
              <input type="text" id="menu_txt" name="menu_txt" class="form-control" value="<?php if(!empty($_GET['id'])) echo $mn->getMenuText();?>" required>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">Id</label>
              <input type="text" id="menu_id_txt" name="menu_id_txt" class="form-control" value="<?php if(!empty($_GET['id'])) echo $mn->getMenuIdText();?>">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label class="control-label">Ordre</label>
              <input type="number" id="menu_order" name="menu_order" class="form-control" value="<?php if(!empty($_GET['id'])) echo $mn->getMenuOrder();?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Parent</label>
              <?php
              $menu = new BeanMenu();
              $result=$menu->select_all();
              ?>
              <select class="form-control select2" name="menu_parent" id="menu_parent">
                <option value="">Choisir</option>

                <?php
                foreach($result as $row)
                {
                  if($row['menu_parent']=='0')
                  {
                    if (!empty($_GET['id']) and $row['menu_id']==$mn->getMenuParent()) {
                      echo '<option value="'.$row['menu_id'].'" selected>'.$row['menu_text'].'</option>';
                    }
                    echo '<option value="'.$row['menu_id'].'">'.$row['menu_text'].'</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>


        </div>
      </div>
      <div class="form-actions">
        <input type="hidden" name="menu_group" id="menu_group" value="0" />
       <?php
                        if(!empty($_GET['id']))
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Edit" />
                                <input type="hidden" name="menu_id" id="menu_id" value="<?php echo $_GET['id'];?>" />
                                <input id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer" value="Modifier"/>
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Add" />
                                <input id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer" value="Enregistrer"/>
                                <?php
                            }
                            ?>
      </div>
    </form>
  </div>

</div>
