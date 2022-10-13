<?php
@session_start();
require_once '../load_model.php';
$acc = new BeanAccounts();
$pers = new BeanPersonne();
$pers->select($_SESSION['perso_id']);
?>
<div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="white-box well" style="background:white;">
                            <div class="user-bg">
							<?php
							if(empty($pers->getPhoto()))
							{
						echo '<span id="p'.$pers->getPersonneId().'"></span><br />
	 <span id="upload"><input type="file" name="file" id="file'.$pers->getPersonneId().'" class="'.$pers->getPersonneId().'"/></span>
	 <input type="hidden" value="'.$pers->getPersonneId().'" name="id_ut" id="h'.$pers->getPersonneId().'"/>';
							}
							else
							{
							echo '<span id="p'.$pers->getPersonneId().'"><img src="upload/'.$pers->getPhoto().'" height="150" width="150" alt="Photo" class="img-thumbnail" /></span><br />
	 <span id="upload"><input type="file" name="file" id="file'.$pers->getPersonneId().'" class="'.$pers->getPersonneId().'"/></span>
	 <input type="hidden" value="'.$pers->getPersonneId().'" name="id_ut" id="h'.$pers->getPersonneId().'"/>';
							}
							?>
							</div>
                            <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Nom</strong>
                                        <p><?php echo $pers->getNomComplet(); ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Genre</strong>
                                        <p><?php echo $pers->getGenre()?></p>
                                    </div>
                                </div>
                                <hr>
								<!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Tel</strong>
                                        <p><?php echo $pers->getContact(); ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Email</strong>
                                        <p><?php echo $pers->getEmail()?></p>
                                    </div>
                                </div>
                                <hr>
								<!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-xs-4">
                                       <a id="<?php echo $pers->getPersonneId(); ?>"href="javascript:void(0)" class="update_ut btn btn-primary btn-circle" id="modif" title="modifier">
									   <span class="fa fa-edit"></span></a>

                                    </div>
                                   
									<div class="col-xs-4"><a id="param_con" data-id="<?php echo $pers->getPersonneId();?>" href="javascript:void(0)"
									class="btn btn-success btn-circle" title="paramettre de connexion">
									   <i class="fa fa-sign-in" data-icon="v"></i></a>

                                    </div>
                                </div>
                                <hr>


                            </div>
                        </div>
                    </div>
</div>
