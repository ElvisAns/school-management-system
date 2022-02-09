 <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title mb-2">MODIFIER  L'AGENT <strong>{nom}</strong> DU STAFF</h3> </div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet">
                    <?=form_open_multipart('dashboard/users/', '', array("action"=>"add_staff"));?>
                      <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell--span-12">
                          <div class="mdc-card">
                            <h6 class="card-title">PROFILE DE L'AGENT</h6>
                            <div class="template-demo">
                              <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon"> <i class="material-icons mdc-text-field__icon">account_box</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="nom" value="{nom}" required minlength="5">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Noms</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon"> <i class="material-icons mdc-text-field__icon">account_box</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="post_nom"  value="{post_nom}"  required minlength="5">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Post Noms</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon"> <i class="material-icons mdc-text-field__icon">account_box</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="prenom"  value="{prenom}"  required minlength="5">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Prenom</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">arrow_drop_down</i>
                                    <select class="mdc-text-field__input" id="text-field-hero-input" name="sexe" value="{sexe}" required minlength="5">
                                      <option value="Masculin">Masculin</option>
                                      <option value="Feminin">Feminin</option>
                                      <option value="dont_mention">Ne pas mentionner</option>
                                    </select>
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Sexe</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>


                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">arrow_drop_down</i>
                                    <select class="mdc-text-field__input" id="text-field-hero-input" name="fonction" value={fonction} required minlength="5">
                                      <option value="admin">admin</option>
                                      <option value="enseignant">enseignant</option>
                                      <option value="prefet">prefet</option>
                                      <option value="comptable">comptable</option>
                                    </select>
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Fonction occupée</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">contact_phone</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="telephone" value="{telephone}" type="tel" id="phone" name="phone" required minlength="10" maxlength="15">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" disabled class="mdc-floating-label">Telephone</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>

                          


                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">contact_mail</i>
                                    <input type="hidden" name="old_numero_id" value="{numero_id}">
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="numero_id"  max="14" min="13" value="{numero_id}" type="text">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">ID RFID (demandez assistance si pas sure de ce champs)</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>

                                 <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">photo</i>
                                    <input type="hidden" name="old_photo" value="{photo}">
                                    <input class="mdc-text-field__input" id="text-field-hero-input" name="photo" value="{photo}" type="file">
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="text-field-hero-input" class="mdc-floating-label">Photo</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                 </div>

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                  <button type="submit" class="mdc-button mdc-button--raised filled-button--success"> <i class="material-icons mdc-button__icon">add_task</i> Enregister </button>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop">
                                  <button type="reset" class="mdc-button mdc-button--raised filled-button--secondary"> <i class="material-icons mdc-button__icon">add_task</i> Reinitialiser </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>