<?php
@session_start();
require_once '../load_model.php';
$stock= new BeanStock();
$seuil=3/4;
$datas=$stock->select_under_min($_SESSION['pos']);
?>
<div class="card has-shadow p-2">
  <div class="card-header bg-light"> <h3 class="box-title m-b-0">Stock  en dessous de la quantité Minimale</h3></div>
  <div class="card-body">
    <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th>Produits</th><th>Qt Min</th><th>Qt Stock</th>
                  </tr>
               </thead>


                                    <tbody>
                  <?php
                  foreach ($datas as $un) {
                            echo '<tr><td>'.$un['prod_name'].'</td>
                            <td>'.$un['qt_min'].'</td><td>'.$un['quantity'].'</td></tr>';

                            }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
</div>
