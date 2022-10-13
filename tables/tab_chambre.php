<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$chamb=new BeanPlace();
$datas=$chamb->select_all_2();
$loc=new BeanLocation();
$fact=new BeanLocationFact();
$pers=new BeanPersonne();
?>
<div class="card p-2">
  <div class="card-header bg-light"> <h3 class="box-title m-b-0">Réservations</h3></div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-sm display tab" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Hébergements</th><th>Catégorie</th><th>Réservation</th>
              </tr>
            </thead>


            <tbody>
              <?php
              foreach ($datas as $un) {

                $chamb->select_2($un['place_parent']);
                if($chamb->getStatus()==2)
                {
                echo '<tr><td>'.$un['place_num'].'</td><td>'.$chamb->getPlaceLib().'</td>
                <td>';

                echo '<button data-id="'.$un['place_id'].'" id="" class="new_loc btn btn-sm btn-info btn-circle"><i class="fa fa-plus" ></i></button>';

                echo '</td></tr>';
                }

              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-9">

          <div class="table-responsive">
               <table class="table table-sm table-bordered table-striped tab">
          <thead>
            <tr><th>#</th><th>Début</th><th>Fin</th><th>Hebergement</th><th>Client</th><th>Tél</th><th>Jour</th><th>Invités</th><th>Total</th><th>Détails</th><th>-</th></tr>
          </thead>
          <tbody>
            <?php
            $datas=$loc->select_all_current('1');
            $cout=0;
            $i=1;
            foreach ($datas as $key => $value) {
              $to_day=date('Y-m-d');
              $chamb->select_2($value['chamb_id']);
              $pers->select($value['party_code']);

              echo '<tr><td>'.$i.'<td>'.$value['from_d'].'</td><td>'.$value['to_d'].'</td><td>'.$chamb->getPlaceNum().'</td><td>'.$pers->getNomComplet().'</td><td>'.$pers->getContact().'</td><td>';

              if($chamb->getStatus()=='0') { $nb_days=$loc->dateDiff($value['from_d'],$to_day);}
              else { $nb_days=$loc->dateDiff($value['from_d'],$value['to_d']); }

              if($nb_days<=0) $nb_days=1;
              /*if($value['loc_type']=='Location')
              {*/
                echo $nb_days;
                $price_day=$nb_days*$value['loc_price'];
                $cout +=$price_day;
              /*}
              else
              {
                echo '0';
                $price_day=0;
              }*/

              echo '</td><td>'.$value['loc_g'].'</td><td>'.$pers->nb_format($price_day).'</td><td>';

              echo '<a href="javascript:void(0)" class="new_loc btn btn-warning btn-sm" id="'.$value['op_id'].'" data-id="'.$value['chamb_id'].'"><i class="fa fa-file"></i></a>';

              echo '</td><td>';

              if($value['loc_type']=='Location') echo '<a href="javascript:void(0)" class="cancel_loc2 text-danger text-light btn btn-danger btn-sm rounded" data-id="'.$value['loc_id'].'" id=""><i class="fa fa-times"></i></a>'; 
                                      elseif($value['loc_type']=='Reservation') {
                                        if($value['from_d']>date('Y-m-d'))
                                        {
                                         echo '<a href="javascript:void(0)" class="cancel_loc2 text-light btn btn-danger btn-sm rounded" id="" data-id="'.$value['loc_id'].'"> <i class="fa fa-times"></i> </a>';
                                        }
                                        else
                                        {
                                        echo '<a href="javascript:void(0)" class="change_st text-light btn btn-success btn-sm rounded" data-id="1" id="'.$value['loc_id'].'"><i class="fa fa-check"></i></a>';
                                        } 
                                      }

              echo '</td></tr>';
              $i++;
            }
            ?>
          </tbody>
          

        </table>
              </div>

      </div>
    </div>

  </div>
</div>
