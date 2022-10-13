<div class="card card-info" >
    <div class="card-header bg-light">Infomation du Client</div>
    <div class="card-body">
        <form id="frm_consommateur" method="post">
            <div class="form-body">
                <div class="form-row">
                    <div class="col-md-2">
                        <div class="form-group">
                        <label class="control-label">Nom & Prénom</label>
                                <input type="text" id="nom" name="nom_ut" class="form-control" required>
						</div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Sexe</label>
                                <select name="sexe" id="genre" class="form-control">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                    <option value="Aucun">Aucun</option>
                                </select>
                        </div>
                    </div>
					<div class="col-md-2">
                        <div class="form-group">
                        <label class="control-label">NIF</label>
                        <input type="number" id="contact" name="tel_ut" class="form-control" value="">
					</div>
                    </div>
                    <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Adresse</label>
                            <input type="email" id="email" name="email_ut" class="form-control"
                            value="">
                    </div>
                    </div>
                    <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">CNI</label>
                            <input type="text" id="cni" name="cni" class="form-control"
                            value="">
                    </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Nationalié</label>
                        <input type="text" id="nat" name="nat" class="form-control" value="">
                            </div>
                    </div>
                            

                      </div>

                                          </div>
                                        <div class="form-actions">


											<input id="operation" type="hidden"  name="operation" value="Add"/>
                      <input id="person_id" type="hidden"  name="personne_id" value="Add"/>

                      <input id="Enregistrer" type="submit" class="btn btn-sm btn-success"
                      name="Enregistrer" value="Enregistrer"/>

                                            <button type="reset" class="btn btn-sm btn-default">Annuler</button>
                                        </div>
                                    </form>
                                    <div id="last_inserted"></div>
                                </div>
                            </div>

