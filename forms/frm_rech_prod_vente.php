
<div class="card">
  <?php
  @session_start();
  //$_SESSION['type_stock']='1';
   echo '<h5 class="box-title m-b-0">Recherche de Produits</h5>';
  ?>

<div class="form-row">
    <div class="col-md-6">
        <label class="label-control">Par Désignation</label>
            <input type="text" name="rech_prod_vente" id="rech_prod_vente" value="" class="form-control" />
    </div>
    <div class="col-md-6">
        <label class="label-control">Par Code</label>
            <input type="text" name="rech_prod_vente_code" id="rech_prod_vente_code" value="" class="form-control"
            <?php
            if(!isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
            {
                echo 'disabled';
            }
            ?>
             />
    </div>
    <!-- <div class="col-md-6">
    <label class="control-label">Stock : </label><br/>
            <div class="form-check form-check-inline">
            <?php

            /*if($_SESSION['type_stock']=='1')
            {
            echo '<button class="btn btn-success choose_stk" id="det" data-id="1">Details</button>';
            }
            else
            {
              echo '<button class="btn btn-default choose_stk" id="det" data-id="1">Details</button>';
            }*/
            ?>
            </div>
            <div class="form-check form-check-inline">
            <?php

            /*if($_SESSION['type_stock']=='0')
            {
            echo '<button class="btn btn-success choose_stk" id="gros" data-id="0">Gros</button>';
            }
            else
            {
              echo '<button class="btn btn-default choose_stk" id="gros" data-id="0">Gros</button>';
            }*/
            ?>
            </div>
    </div> -->
</div>
<div id="tab_srched_prod">

</div>
</div>
