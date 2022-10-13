<h5 class="box-title m-b-0">Historique</h5>
                            <hr>
<!-- <a href="javascript:void(0)" class="btn btn-info btn-sm btn_valid"><i class="fa fa-refresh "></i><span class="nb_valid"> <?php //echo $op->select_count_valid();?></span> </a><br> -->
               <table id="example2a" class="table table-bordered table-striped table-condensed display table-sm tab" cellspacing="0">
               <thead>
                    <tr>
                      <tr>
                        <th>Date</th><th>Montant</th><th>Client</th>
                      </tr>
                    </tr>
                </thead>

                                    <tbody>
                  <?php
                  $datas=$op->select_all_by_state3a('Vente','0');

                                    foreach ($datas as $un) {
                                    
                                    $perso->select($un['party_code']);
                                    $amount=$det->select_sum_op($un['op_id']);
                                    echo '<tr class="row_op_vente ';
                                   
                                    echo ' " data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>'.number_format($amount,0,'.',',').'</td><td>';
                                    echo $perso->getNomComplet();
                                    echo '</td>';

                                    echo '</tr>';

                                    //}
                                    //}

                                }
                                    ?>
                    </tbody>
               </table>
