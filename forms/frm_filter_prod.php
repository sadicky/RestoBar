<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$datas=$cat->select_all();
?>


                        <div class="col-md-3">
                            <label class="label-control">Filtrer par Categorie</label>
                            <select class="form-control select2" id="filter_prod" name="srch_perso">
                                <option value="xxx">-- Choisir --</option>
                                <option value="">-- Tous --</option>
                                <?php
                                //$letters = range('A', 'Z');
                                foreach ($datas as $un)
                                {
                                    echo '<option value="'.$un['category_id'].'">'.$un['category_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
<hr>
<div id="tab_filtered_prod">

</div>
