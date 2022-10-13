
<?php
require_once '../load_model.php';
$animal= new BeanAnimaux();
$datas=$animal->select_all();
?>
<form method="post" id="animal_form">
<div class="form-body">
<h3 class="box-title">Animaux</h3>
<hr>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Name</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="text" id="animal_name" name="animal_name" class="form-control" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="hidden" name="animal_id" id="animal_id" />
            <input type="hidden" name="operation" id="operation" value="Add" />
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
                                            <th>Animaux</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Animaux</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    foreach ($datas as $un) {

                                    echo '<tr><td>'.$un['animal_name'].'</td>';



                                     echo '<td><button class="btn btn-success update" name="update" id="'.$un["animal_id"].'"><span class="glyphicon glyphicon-edit"></span></button></td>';


                                    echo '<td><button class="btn btn-danger delete" name="delete" id="'.$un["animal_id"].'"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                                    }
                                    ?>
                                        </tbody>
                             </table>
                            </div>
