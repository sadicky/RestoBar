<?php
require_once '../load_model.php';
$pers= new BeanPersonne();
$user= new BeanUsers();
$pos=new BeanPos();
$datas=$pers->select_all_role('users');

echo '<input value="'.$pers->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="personne_id">';
?>

<div class="white-box">
    <h3>Utilisateurs</h3>
    <p id="nouveau"><a href="javascript:void(0)" class="btn btn-sm btn-primary btn-rounded" id="new_user"> <i class="fa fa-plus"></i> Nouveau</a>
    </p>

    <div class="table-responsive">
        <table id="tab" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Identifiant</th><th>Nom </th><th>Genre</th><th>Privilèges</th><th>POS</th><th>Fonction</th><th>Menu</th><th>Modifier</th><th>Suspendre</th><th>Supprimer</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($datas as $un) {
                    $user->select_2($un['personne_id']);
                    $pos->select($user->getPosId());

                    echo '<tr><td>'.$user->getUserName().'</td><td>'.$un['nom_complet'].'</td><td>'.$un['genre'].'</td><td>'.$user->getLevelUser().'</td><td>'.$pos->getPosName().'</td>';
                    echo '<td>'.$user->getTypeUser().'</td><td>';

                    echo '<button id="'.$un['personne_id'].'" class="attrib_menu btn btn-sm btn-primary btn-circle"><i class="fa fa-plus"></i></button>';

                    echo '</td><td>';

                    echo '<button class="btn btn-sm btn-warning btn-circle update_ut" id="'.$un['personne_id'].'"><i class="fa fa-edit"></i></button>';

                    echo '</td><td>';
                    if($user->getActif()=='1'){
                        echo '<button class="btn btn-danger btn-sm btn-circle active_pers" id="'.$user->getUserId().'" data-id="0"><i class="fa fa-arrow-down"></i></button>';
                    }
                    else {
                        echo '<button class="btn btn-sm btn-success btn-circle active_pers" id="'.$user->getUserId().'" data-id="1"><i class="fa fa-arrow-up"></i></button>';

                    }

                    echo '</td><td>';
                    if(!$pers->exist_pers($un['personne_id']))
                    {
                        echo '<button class="btn btn-danger btn-sm btn-circle trash_conf" id="'.$un['personne_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                    }
                    else {
                        echo '-';

                    }

                    echo '</td>';
                    echo '</tr>';

                }
                ?>
            </tbody>
        </table>
    </div>

</div>
