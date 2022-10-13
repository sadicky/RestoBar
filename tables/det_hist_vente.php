<?php
$m_v=$det->select_sum_op($un['op_id']);
$m_vente=$m_v - $vente->getRed();
$reste=($m_vente- $amount['paie']);
if($vente->getTva()=='1'){$tva=$m_vente*0.18; $tot_tva +=$tva;} else {$tva=0;}
$htva=$m_v-$tva;
$tot +=$m_v;
echo '<tr><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>'.$pers3->getNomComplet().'</td><td>';
echo $vente->getNumVente();
                                    if($vente->getIsPaid()=='0')
                                    {
                                    echo ' <button class=" btn btn-light btn-sm row_op_vente" data-id='.$un['op_id'].' style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></button>';
                                    }

                                    echo '</td><td>'.$vente->getPlace().'</td><td>'.$pers->getNomComplet().'</td><td><ul>';
                                    $datas2=$det->select_all($un['op_id']);
                                    $perc=0;
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                            
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'&#013;';

                                    if($un['is_paid']=='0')
                                    echo ' <a href="javascript:void(0)" class="del_det_hist" id="'.$un2["details_id"].'"><span class="fa fa-times"></span></a> ';

                                    echo ' </li>';
                                     }
                                    echo '</ul>';

                                   if($det->nb_op($un['op_id'])==0)

                                echo ' <button class="del_op_sale_hist" name="delete" data-id="'.$un['op_id'].'" id="'.$un['op_id'].'"><i class="fa fa-times"></i></button>';

                                    echo '</td>
                                    <td align="right">'.$pers->nb_format($m_v).'</td><td class="tc" align="right">'.$pers->nb_format($reste);

                                    if($trans->select_all_nb_op($un['op_id'])>1)
                                        {
                                            $datop=$trans->select_all_op($un['op_id']);
                                                echo '<ul>';
                                            foreach ($datop as $key => $value2) {
                                                echo '<li>'.$value2['amount'].' <a href="javascript:void(0)" class="text-danger delete_trans2" name="delete" id="'.$value2["transaction_id"].'"><span class="fa fa-times"></span></a></li>';
                                            }
                                            echo '</ul>';
                                        }


                                    $totdu +=$reste;
                                    echo '</td>';
                                    echo '<td class="tc" align="right">';
                                    echo $pers->nb_format($amount['paie']);
                                    $totpaie +=$amount['paie'];
                                    echo '</td><td>'.$pers2->getNomComplet().'</td></tr>';
                                    $i++;
?>