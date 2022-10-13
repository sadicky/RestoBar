<?php
$vente=new BeanVente();
$det=new BeanDetailsOperation();
$prod=new BeanProducts();
?>
<div class="card card-info" >
    <div class="card-header bg-light">Infomation du Client</div>
    <div class="card-body">
        <form id="frm_client_hot" method="post" autocomplete="off">
            <div class="form-body">
                <div class="form-row">
        <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Clients En cours</label>
            <select id="select_cust_loc"  name="current_cust" class="form-control" <?php if($complete) echo 'disabled'; ?>>
                <option value="">Choisir le Client</option>
                <?php
                $datas=$loc->select_all_current('1');
                foreach ($datas as $key => $un) {
                    $pers2->select($un['party_code']);
                    echo '<option value="'.$pers2->getPersonneId().'">'.$pers2->getNomComplet().'</option>';
                    
                }
                ?>
             </select>
        </div>
        </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Tél</label>
                        <input type="number" id="contact_cli" name="tel_ut" class="form-control" value="<?php 
                                if($complete) echo $pers->getContact();
                                ?>" <?php if($complete) echo 'readonly'; ?> required>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">CNI</label>
                            <input type="text" id="cni_cli" name="cni" class="form-control"
                            value="<?php 
                                if($complete) echo $info->getCni();
                                ?>" <?php if($complete) echo 'readonly'; ?> required>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Nom & Prénom</label>
                                <input type="text" id="nom" name="nom_ut" class="form-control" value="<?php 
                                if($complete) echo $pers->getNomComplet();
                                ?>" <?php if($complete) echo 'readonly'; ?> required >
						</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Sexe</label>
                                <select name="sexe" id="genre" class="form-control"  <?php if($complete) echo 'readonly'; ?>>
                                    <?php
                                    $datas = array('Homme','Femme');
                                    foreach ($datas as $key => $e) {

                                        if($complete and $e==$pers->getGenre())
                                        echo '<option value="'.$pers->getGenre().'" selected>'.$pers->getGenre().'</option>';
                                        else
                                        echo '<option value="'.$e.'">'.$e.'</option>';

                                    }
                                    ?>
                                </select>
                        </div>
                    </div>
					
                    <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">E-mail</label>
                            <input type="email" id="email" name="email_ut" class="form-control"
                            value="<?php 
                                if($complete) echo $pers->getEmail();
                                ?>" <?php if($complete) echo 'readonly'; ?>>
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nationalié</label>
                        <input type="text" id="nat" name="nat" class="form-control" value="<?php 
                                if($complete) echo $info->getNat();
                                ?>" <?php if($complete) echo 'readonly'; ?>>
                            </div>
                    </div>
                            

                      </div>

                                          </div>
                                        <div class="form-actions">


											<input id="operation" type="hidden"  name="operation" value="Add"/>
                      

                      <input id="enregistrer_cli" type="submit" class="btn btn-sm btn-success"
                      name="Enregistrer" value="Enregistrer" <?php if($complete) echo 'disabled'; ?> />

                                            
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
<hr color="blue">
<h3>Les Factures Bar & Resto</h3>
<?php
$datas=$op->select_op_paid_part($pers->getPersonneId(),'0');
?>

<div class="table-responsive">
                             <table id="example23" class="table table-bordered table-striped table-sm display dtab2" border="1">
                             <thead>
                        <tr>
                        <th>#</th><th>N° Fact.</th><th>Date de saisie</th><th>Description</th><th>Dû</th><th>TVA</th><th>Payé</th>
                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $tot_tva=0;
                                    $i=1;
                                    foreach ($datas as $un) {

                                    if($un['op_type']=='Vente')
                                    {
                                    $pers2->select($un['personne_id']);
                                    
                                    $fact->select($un['op_id']);
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);


                                    
                                    echo '<tr><td>';
                                    echo $i.'</td><td>';
                                    
                                     echo $vente->getNumVente();
                                    
                                    echo '</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td><ul>';
                                    $datas2=$det->select_all($un['op_id']);
                                    $perc=0;
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                            
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'&#013;</li>';
                                     }
                                     echo '</ul><a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture" data-id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>';
                                    
                                    echo '</td>';
                                    echo '<td align="right">';

                                        $m_vente=$det->select_sum_op($un['op_id']) - $vente->getRed();
                                        $reste=($m_vente- $amount['paie']);
                                        echo $pers->nb_format($reste);
                                    
                                    $totdu +=$reste;

                                    echo '</td><td align="right">';

                                    
                                    if($vente->getTva()=='1'){$tva=$vente->getAmount()*0.18; $tot_tva +=$tva;} else {$tva=0;}
                                            echo $pers->nb_format($tva);
                                    
                                    echo '</td><td class="tc" align="right">';
                                    echo $pers->nb_format($amount['paie']);
                                    $totpaie +=$amount['paie'];
                                    echo '</td>';
                                    echo '</tr>';
                                    $i++;
                                }

                                }
                                    ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                             <th>#</th><th>-</th><th>Total</th><th>-</th>
                                             <td align="right"><b><?php echo $pers->nb_format($totdu);?></b></td>
                                             <td align="right"><b><?php echo $pers->nb_format($tot_tva);?></b></td>
                                             <td align="right"><b><?php echo $pers->nb_format($totpaie); ?></b></td>
                                        </tr>
                                    </tfoot>
                             </table>
                            </div>