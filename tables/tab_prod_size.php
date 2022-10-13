<?php
require_once '../load_model.php';
$size= new BeanProdSize();
$datas=$size->select_all();
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Products Size</h3>
                            <hr>
                            <div class="table-responsive">
               <table id="example23" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>Size</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Size</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {

                                    echo '<tr><td>'.$un['prod_size_name'].'</td>';


                                     echo '<td><button class="btn btn-success update" name="update" id="'.$un["prod_size_id"].'"><span class="glyphicon glyphicon-edit"></span></button></td>';


                                    echo '<td><button class="btn btn-danger delete" name="delete" id="'.$un["prod_size_id"].'"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
