<?php
require_once '../load_model.php';
$table= new BeanTabl();
$datas=$table->select_all();
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Tables</h3>
                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-rounded" id="new_table"> <i class="fa fa-plus"></i> Nouveau</a>

                            </p>
               <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>Table</th><th>Place</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
               </thead>

                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            //if($un['status']==$_POST['status'])
                            //{
                           
                            echo '<tr><td>';
                            if($un['table_parent']<>0)
                            echo $un['table_num'];
                            else
                              echo '-';

                            echo '</td><td>';

                            if($un['table_parent']<>0)
                            {
                            $table->select($un['table_parent']);
                            echo $table->getTableNum();
                            }
                            else
                            {
                            echo $un['table_num'];
                            }

                            echo '</td><td>';

                            echo '<button class="btn btn-warning btn-circle btn-sm update_table" id="'.$un['table_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';

                            if($un['status']=='1')
                             {
                            echo '<button class="btn btn-danger btn-circle btn-sm delete_table" id="'.$un['table_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                }
                                else
                                {
                                echo '<button class="btn btn-success btn-circle btn-sm delete_table" id="'.$un['table_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';
                                }

                             echo '</td></tr>';
                           //}
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
