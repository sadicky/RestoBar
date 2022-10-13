
<form id="frm_inventaire" method="post">
  <div class="row">
    <div class="col-md-3">
      <label class="control-label">Periode</label>
      <select name="id_per" id="id_per" class="show-tick form-control" data-live-search="true" data-style="btn-darkx" required>
        <option value="">Choisir Période</option>
        <?php
        $datas=$per->select_all();
        foreach ($datas as $key => $value) {
          if($value['id_per']==$_SESSION['periode']) 
          {
            echo '<option value="'.$value['id_per'].'" selected>'.$value['code_per'].'</option>';
          }
          echo '<option value="'.$value['id_per'].'">'.$value['code_per'].'</option>';
        }
        ?>
      </select>

    </div>
    <div class="col-md-4">
      <label class="control-label">Point de Vente</label>
      <select name="pos_id" id="pos_id" class="show-tick form-control" data-live-search="true" data-style="btn-darkx" required>
        <?php
        $datas=$pos->select_all();
        foreach ($datas as $key => $value) {
          echo '<option value="'.$value['pos_id'].'">'.$value['pos_name'].'</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-2">
      <br/>
      <button class="btn btn-primary btn-sm" type="submit">Inventaire</button>
    </div>
  </div>
</form>