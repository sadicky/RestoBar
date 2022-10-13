<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$datas=$cat->select_all_date(date('Y-m-d'));
?>
<div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
  <thead>
               <tr>
                   <th>Categorie</th><th>A Vendre</th><th>Parent</th><th>&nbsp;</th><th>&nbsp;</th>
               </tr>
  </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {

                            $cat->select($un['parent_id']);
                            echo '<tr><td>'.$un['category_name'].'</td><td>'.$un['is_sale'].'</td>
                            <td>'.$cat->getCategoryName().'</td><td>';

                            echo '<button class="btn btn-sm btn-warning btn-circle update_cat" id="'.$un['category_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';

                            if($un['status']=='1')
                             {
                            echo '<button class="btn btn-sm btn-danger btn-circle delete_cat" id="'.$un['category_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                }
                                else
                                {
                                echo '<button class="btn btn-sm btn-success btn-circle delete_cat" id="'.$un['category_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';
                                }

                             echo '</td></tr>';

                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
