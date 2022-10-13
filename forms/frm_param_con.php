
				<div class="card card-info" >
                            <div class="card-header bg-light">Modifications des parametres de connexion</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_param_con" method="post">
                                        <div class="form-body">
                      <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Ancien Mot de passe</label>
                                                        <input type="password" id="an_mp" name="an_mp_ut"
														value="" class="form-control" required>
												    </div>
                                                </div>

                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Mot de passe</label>
                                                        <input type="password" id="mp" name="mp_ut"
                            value="" class="form-control" required>
                            </div>
                                                </div>
                        <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Confirmer</label>
                                                        <input type="password" id="conf" name="conf_ut" class="form-control"
                            value="" required>
                            </div>
                                                </div>
                                            </div>
                                          </div>
                                        <div class="form-actions">


					<input id="operation" type="hidden"  name="operation" value="Edit_con"/>
                      <input id="person_id" type="hidden"  name="personne_id" value="Add"/>

                      <input id="Enregistrer" type="submit" class="btn btn-success"
                      name="Enregistrer" value="Enregistrer"/>

                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                </div>
