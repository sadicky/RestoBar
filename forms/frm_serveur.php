
				<div class="card card-info" >
                            <div class="card-header bg-light">Serveurs</div>
                            <div class="card-wrapper">
                                <div class="card-body">
                        <form id="frm_serveur" method="post">
                                        <div class="form-body">

                        <div class="row">
                          <div class="col-md-2">
                              <div class="form-group">
                                <label class="control-label">Code</label>
                                <input type="text" id="contact" name="tel_ut" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group">
                                <label class="control-label">Nom & Prénom</label>
                                <input type="text" id="nom" name="nom_ut" class="form-control" required>
												    </div>
                          </div>
                      </div>

                                          </div>
                                        <div class="form-actions">

                      <input id="email" type="hidden"  name="email_ut" value="-"/>
                     <!--  <input id="contact" type="hidden"  name="tel_ut" value="-"/> -->
											<input id="operation" type="hidden"  name="operation" value="Add"/>
                      <input id="person_id" type="hidden"  name="personne_id" value="Add"/>

                      <input id="Enregistrer" type="submit" class="btn btn-success"
                      name="Enregistrer" value="Enregistrer"/>

                                            <button type="reset" class="btn btn-default">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                </div>
