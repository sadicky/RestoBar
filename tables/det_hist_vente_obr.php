<?php
$m_v=$det->select_sum_op($un['op_id']);
$m_vente=$m_v - $vente->getRed();
$reste=($m_vente- $amount['paie']);

if($from_date==$un['create_date'])$tot_obr +=$m_v; 

if($tot_obr<=100000 and $from_date==$un['create_date'])
{
if($vente->getTva()=='1'){$tva=$m_vente*0.18; $tot_tva +=$tva;} else {$tva=0;}
$htva=$m_v-$tva;
echo '<tr><td>';
echo $vente->getNumVente();

                                    echo '</td><td>'.$un['create_date'].'--'.$tot_obr.'</td><td>'.$pers3->getNomComplet().'</td><td><ul>';
                                    $datas2=$det->select_all($un['op_id']);
                                    $perc=0;
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                            
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'&#013;';
                                    if(!empty($un2['lot'])) echo '(No: '.$un2['lot'].')';
                                    echo '</li>';
                                     }
                                    echo '</ul>

                                    <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture" data-id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>
                                    </td>

                                    <td align="right">'.$pers->nb_format($htva).'</td>
                                    <td align="right">'.$pers->nb_format($tva).'</td>
                                    <td align="right">'.$pers->nb_format($m_v).'</td></tr>';
                                    $i++;
}
//echo $tot_obr.'<br>';
if($tot_obr>=100000)
{
   //echo $tot_obr.'-'.$next_date.'<br>';
   $tot +=$tot_obr;
    $tot_obr=0; 
}

if($from_date!=$un['create_date'])
{
    $from_date=$next_date;
   $next_date = date ("Y-m-d", strtotime("+1 days", strtotime($next_date)));
  
}

?>