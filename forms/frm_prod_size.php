
<?php
require_once '../load_model.php';
$size= new BeanProdSize();
$datas=$size->select_all();
?>
<form method="post" id="prod_size_form">
<div class="form-body">
<h3 class="box-title">Products sizes</h3>
<hr>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Name</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="text" id="prod_size_name" name="prod_size_name" class="form-control" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="hidden" name="prod_size_id" id="prod_size_id" />
            <input type="hidden" name="operation_size" id="operation_size" value="Add_size" />
            <label class="control-label">&nbsp;</label>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <span class="glyphicon glyphicon-save"></span></button>

        </div>
    </div>
</div>
</div>
</form>


                            <div class="table-responsive">
                             <table id="example23" class="table table-bordered table-condensed table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                            <th>Sizes</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sizes</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    foreach ($datas as $un) {

                                    echo '<tr><td>'.$un['prod_size_name'].'</td>';

                                     echo '<td><button class="btn btn-success update_size" name="update_size" id="'.$un["prod_size_id"].'"><span class="glyphicon glyphicon-edit"></span></button></td>';

                                    echo '<td><button class="btn btn-danger delete_size" name="delete_size" id="'.$un["prod_size_id"].'"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                                    }
                                    ?>
                                        </tbody>
                             </table>
                            </div>
