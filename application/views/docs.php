<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{title}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/jvectormap/jquery-jvectormap.css">
  <!-- End plugin css for this page -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/demo/style.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{logo}" />
</head>
<style type="text/css">
  ::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px #7a00ff; 
}
</style>
<body>
<script src="<?=base_url()?>/assets/js/preloader.js"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
      <div class="mdc-drawer__header">
        <a href="index.html" class="brand-logo">
          <img src="{profile_image}" alt="logo" style="height:100px; width:auto; border-radius: 50px; border-style: solid; border-color: white " >
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">{username}</p>
          <p class="email">{email}</p>
        </div>
        {menu}
        <div class="profile-actions">
          <a href="javascript:;">Parametres</a>
          <span class="divider"></span>
          <a href="<?=base_url("dashboard")?>"> Retour</a>
        </div>
      </div>
    </aside>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
            <span class="mdc-top-app-bar__title">Greeting {username} </span>
            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex">
              <i class="material-icons mdc-text-field__icon">search</i>
              <input class="mdc-text-field__input" id="text-field-hero-input">
              <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch">
                  <label for="text-field-hero-input" class="mdc-floating-label">Search..</label>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
              </div>
            </div>
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container menu-profile d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="{profile_image}" alt="user" class="user">
                  </span>
                  <span class="user-name">{username}</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-account-edit-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Editer votre compte</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-settings-outline text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal"><a href="<?=base_url("dashboard")?>"> Retour</a></h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-settings"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-alert-circle-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Parametres</h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-arrow-down-bold-box"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Verouiller</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-logout-variant text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal"><a href="<?=base_url("dashboard")?>"> Retour</a></h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          
        <!--DOCUMENTATION CODE -->
            <a href="#introduction">Introduction</a><br />
            <a href="#admin">Le compte Admin</a><br />
            <a href="#comptable">Le compte Comptable</a><br />
            <a href="#supplementaire">Compte Supplementaires</a><br /> 
            <!--<a href="#troubleshooting">Problèmes et Soutions</a><br /> 
            <a href="#conclusion">Conclusion</a><br />  -->
            </p>
            <hr style="border-width:2px; border-style:inset; margin-start:auto;margin-end:auto;color:rgb(47, 6, 141);"></hr>
            <p>Bienvenu sur la page <strong> Guide</strong>, ici vous allez decouvrir comment 
                naviguer, manipuler et effectuer des operations dans l'application selon votre niveau d'accès. 
                Vous allez egalement apprendre comment effectuer soigneusement une opération ou une tâche spécifique pour votre compte.
                Cette application est offerte avec 3 niveaux d'accès entre autre : </p>
            <ul>
                <li>Niveau 1 : Administration</p>
                <li>Niveau 2 : Gestion Financière</p>
                <li>Niveau 3 : Accès temporaires</p>
            </ul>
            <form>
                <fieldset>
                    <legend><h2 style="color:rgb(47, 6, 141);" id="introduction">Introduction</h2></legend>
                        <p>Si vous lisez ce Guide, c'est que vous avez accès au Système de Gestion Scolaire UN JOUR NOUVEAU. UJN-eSYSTEM est une 
                            solution informatique de gestion des opérations scolaires entre autre(presence des agents, presences des élèves, analyse et 
                            enregistrement des operations financcières dont les frais scolaires, de fonctionnement, de construction, de bibliothèque, 
                            frais de la cantine et le transport pour les enfants souscrits à cette activité. Ainsi donc, tout agent ayant accès au système 
                            a un compte d'accès valide pendant une année. 
                            Le point focal qui est l'Administrateur du Système est la seule et unique personne capable 
                            d'accorder et/ou de priver d'accès à un utilisateur ou de supprimer définitivement un agent... la connexion 
                            s'effectue en general grace à un nom d'utilisateur et un mot de passe personnel que vous définissez lors de la création de compte. 
                            cela veux dire que si vous oubliez le mot de passe ou le nom d'utilisateur, vous ne pouvez pas acceder 
                            au système. Definissez donc un nom d'utilisateur et mot de passe dont vous vous souviendrez facilement. Neamoins, 
                            le mot de passe doit être long(aumoins 8charractères), contenant aumoins un charactère en Majuscule, et un nombre pour 
                            plus de securité. <menu></menu></p>
                </fieldset>
            </form>
            <form>
                <fieldset>
                    <legend><h2 style="color:rgb(47, 6, 141);" id="admin">Administrateur</h2></legend>
                        <p>L'administrateur est le controlleur principal du systeme, c'est lui qui crée un agent, supprime un agent, donne accès à un agent temporaire
                            qu'il pourra supprimer plus tard, visionne les données des élèves et des enseignants; imprimer un rapport journalier ou hebdomadaire. il 
                            peux également exporter les données des opérations journalier pour les archiver et/ou les analyser...
                        </p>
                        
                    <h3>Accueil Admin</h3>
                        <figure>
                            <img class="resized-images" src="../assets/images/doc/admin0.png" alt="Accueil" />
                            <figcaption><i>Accueil Admin</i></figcaption>  
                        </figure>
                        <p>L'image represente la page d'accueil du bureau de l'administrateur, où il a
                            la possibilité de voir tous les trafics financiers, les presences, les presences, le nombres d'élèves 
                            inscrits, presents, reguliers ainsi qu'un graphique representatif des presences hebdomadaires agents et élèves
                            il est également possible d'exporter le rapport généré après chaque moindre évenement effectué dans le système.
                            </p>    
                    <h3>Ajouter Agent ou Eleve</h3>
                        <figure>
                            <img class="resized-images" src="../assets/images/doc/admin1.png" alt="Ajouts" />
                            <figcaption><i>Ajout</i></figcaption>  
                        </figure>
                        <figure>
                            <img class="resized-images" src="../assets/images/doc/admin2.png" alt="Ajouts2" />
                            <figcaption><i>Ajout élève</i></figcaption>  
                        </figure>
                        <figure>
                            <img class="resized-images" src="../assets/images/doc/admin3.png" alt="Ajouts3" />
                            <figcaption><i>Ajout Agent STAFF</i></figcaption>  
                        </figure>
                        <p>L'image represente la page d'ajout d'un agent ou d'un élève, ici nous prenons en compte plusieurs details
                            de l'enfant et les stockons dans une base des données. Lorsque l'adminitrateur clique sur Enregistrer, il envoi donc 
                            les données remplies dans les champes vers la base des données, chaque champ à sa place spécifique. Toute les cases doivent être remplie,
                            si les données d'une case sont manquant, saisissez un très d'union aulieu de laisser la case vide.  
                            Ci dessous la liste des élements à remplir et les spécifications à respecter :
                            </p>

                        <table id="t01">
                                <tr>
                                    <th colspan="0">Champs à remplir(Eleve)</th>
                                    <th colspan="0">Champs à replir(Agents)</th>
                                </tr>
                                <tr>
                                    <td>Nom de l'élève</td>
                                    <td>Nom de l'agent</td>
                                </tr>
                                <tr>
                                    <td>Post Nom</td>
                                    <td>Post Nom de l'agent</td>
                                </tr>
                                <tr>
                                    <td>Prénom</td>
                                    <td>Prénom de l'agent</td>
                                </tr>
                                <tr>
                                    <td>Sexe</td>
                                    <td>Sexe de l'agent</td>
                                </tr>
                                <tr>
                                    <td>Classe</td>
                                    <td>Fonction occupée</td>
                                </tr>
                                <tr>
                                    <td>Adresse de Résidence</td>
                                    <td>Adresse de Résidence</td>
                                </tr>
                                </tr>
                                    <td>Date de naissance </td>
                                    <td>Télephone</td>
                                </tr>
                                <tr>
                                    <td>Lieu de naissance</td>
                                    <td>Adresse mail</td>
                                </tr>
                                    <td>Nom du Père</td>
                                    <td>ID Rfid de l'agent</td>
                                </tr>
                                <tr>
                                    <td>Nom de la Mère</td>
                                    <td>Photo de profile</td>
                                </tr>
                                <tr>
                                    <td>Télephone parents</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Adresse mail des parents</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Observations sanitaires</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ID RFID de l'élève</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Un fichier photo de profile</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Details financiers</td>
                                    <td></td>
                                </tr>
                        </table>
                </fieldset>
            </form>
            <form>
                <fieldset>
                    <legend><h2 style="color:rgb(47, 6, 141);" id="comptable">Comptabilité</h2></legend>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nobis cumque ab, sed inventore et dignissimos nulla ullam. Perspiciatis sunt iste consequatur suscipit ex sequi porro expedita necessitatibus, rerum molestias.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil voluptatibus cum dicta, ea dolores corrupti repudiandae labore autem aperiam. Ex quia voluptas illo magnam in hic asperiores. Delectus, praesentium natus.
                        </p>
                </fieldset>
            </form>
            </form>
                <fieldset>        
                    <legend><h2 style="color:rgb(47, 6, 141);" id="supplementaire">Agents Temporaires</h2></legend> <!-- Titre du fieldset -->            
                  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, quisquam officiis! Obcaecati vitae rem quidem, excepturi ratione tenetur mollitia fugit laudantium maiores dolores fugiat sapiente ipsum, a blanditiis accusantium facilis.
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, nulla. Maxime ipsam doloribus qui exercitationem sapiente ipsum odio quia quo obcaecati sequi. Eveniet dolorum, placeat deleniti quod explicabo tenetur dolorem?
                  </p>     
            </fieldset>  
        </form>      
    </div>
    </main>
    <!-- partial:partials/_footer.html -->
    <footer>
        <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
            <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © <a href="" target="_blank">Group Supra Electronics</a> 2020</span>
            </div>
            <!--div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center tx-14"><a href="http://unjournouveau.org" target="_blank">complexe scolaire UN JOUR NOUVEAU</a> </span>
            </div-->
        </div>
        </div>
    </footer>
    <!-- partial -->
    </div>
</div>
</div>
  <!-- documentation -->
    <script src="scribbler.js"></script>
  <!-- plugins:js -->
  <script src="<?=base_url()?>/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?=base_url()?>/assets/vendors/chartjs/Chart.min.js"></script>
  <script src="<?=base_url()?>/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="<?=base_url()?>/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=base_url()?>/assets/js/material.js"></script>
  <script src="<?=base_url()?>/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base_url()?>/assets/js/dashboard.js"></script>

  <script type="text/javascript">{script_chart}</script>
  <!-- End custom js for this page-->
</body>
</html> 