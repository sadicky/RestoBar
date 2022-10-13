<?php
require_once '../load_model.php';
$animal= new BeanAnimaux();
$datas=$animal->select_all();
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Animaux</h3>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
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
</div>
