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
  <link rel="shortcut icon" href="{logo}" /> </head>
<style type="text/css">
::-webkit-scrollbar {
  width: 12px;
}

::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px #7a00ff;
}

.table thead {
  background-color: rgb(66, 63, 84);
}

.white {
  color: #fff !important;
}
</style>

<body>
  <script src="<?=base_url()?>/assets/js/preloader.js"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
      <div class="mdc-drawer__header">
        <a href="index.html" class="brand-logo"> <img src="{profile_image}" alt="logo" style="height:100px; width:auto; border-radius: 50px; border-style: solid; border-color: white "> </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">{username}</p>
          <p class="email">{email}</p>
        </div> {menu}
        <div class="profile-actions"> <a href="javascript:;">Parametres</a> <span class="divider"></span> <a href="<?=base_url("auth/logout")?>">Deconnecter</a> </div>
      </div>
    </aside>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button> <span class="mdc-top-app-bar__title">Greeting {username} </span>
            <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon search-text-field d-none d-md-flex"> <i class="material-icons mdc-text-field__icon">search</i>
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
              <button class="mdc-button mdc-menu-button"> <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="{profile_image}" alt="user" class="user">
                  </span> <span class="user-name">{username}</span> </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only"> <i class="mdi mdi-account-edit-outline text-primary"></i> </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Editer votre compte</h6> </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only"> <i class="mdi mdi-settings-outline text-primary"></i> </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal"><a href="<?=base_url("auth/logout")?>">Deconnecter</a></h6> </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button"> <i class="mdi mdi-settings"></i> </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only"> <i class="mdi mdi-alert-circle-outline text-primary"></i> </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Parametres</h6> </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button"> <i class="mdi mdi-arrow-down-bold-box"></i> </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only"> <i class="mdi mdi-lock-outline text-primary"></i> </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Verouiller</h6> </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only"> <i class="mdi mdi-logout-variant text-primary"></i> </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal"><a href="<?=base_url("auth/logout")?>">Deconnecter</a></h6> </div>
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
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                 <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title">Eleves inscrits</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{inscrits}</h5>
                    <h5 class="card-title">Personnel enregistré</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{staff_number}</h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">dvr</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--danger">
                  <div class="card-inner">
                    <h5 class="card-title">Eleves ponctuels</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{reguliers}</h5>

                    <h5 class="card-title">Agents ponctuels</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{reguliers_agents}</h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">account_circle</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--primary">
                  <div class="card-inner">
                    <h5 class="card-title">Total entrée</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{income}</h5>
                    <h5 class="card-title">Entrée aujourdhui</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{income_today}</h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">attach_money</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--info">
                  <div class="card-inner">
                    <h5 class="card-title">Eleves Présents aujourdhui</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">{presents}</h5>
                    <p class="tx-12 text-muted">{rate_presents} du total</p>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">receipt</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-2 bg-light">
                  <h6 class="card-title card-padding pb-0">Liste de presence des Eleves</h6>
                <div>
                    <div style="width: 300px; padding: 30px; display: inline-block;">
                      <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" type="date" name="date_de_naissance" value="{date}" id="date_attendance_eleves" value="{data_de_naissance}" required minlength="5">
                        <div class="mdc-notched-outline">
                          <div class="mdc-notched-outline__leading"></div>
                          <div class="mdc-notched-outline__notch">
                            <label for="date_attendance_eleves" class="mdc-floating-label">Choisir une date specifique</label>
                          </div>
                          <div class="mdc-notched-outline__trailing"></div>
                        </div>
                      </div>
                    </div>

                    <div style="width: 300px; display: inline-block; padding: 30px;">
                                  <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"> <i class="material-icons mdc-text-field__icon">arrow_drop_down</i>
                                    <select class="mdc-text-field__input" id="classe_attendance" name="classe" required>
                                      {classe_option}
                                    </select>
                                    <div class="mdc-notched-outline">
                                      <div class="mdc-notched-outline__leading"></div>
                                      <div class="mdc-notched-outline__notch">
                                        <label for="classe_attendance" class="mdc-floating-label">Selectionnez la Classe</label>
                                      </div>
                                      <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                  </div>
                                </div>
                    <div>
                      
                    </div>
                    <div style="max-width: 250px; display: inline-block; padding: 30px;">
                      <button class="mdc-button mdc-button--raised filled-button--info" id="voir_attendance_eleves"> voir la liste </button>
                    </div>

                    <div style="max-width: 300px; display: inline-block; padding: 30px;">
                      <button class="mdc-button mdc-button--raised filled-button--info" id="voir_tout_eleves"> voir la liste entière </button>
                    </div>

                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" >
                      <thead>
                        <tr>
                          <th class="text-center white">Photo</th>
                          <th class="text-center white">Noms</th>
                          <th class="text-center white">Classe | Date</th>
                          <th class="text-center white">Heure entree</th>
                          <th class="text-center white">Heure sortie</th>
                          <th class="text-center white">Observation</th>
                        </tr>
                      </thead>
                      <tbody id="attendance_eleves"> {attendance_eleves} </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-2 bg-light ">
                  <h6 class="card-title card-padding pb-0">Liste de presence du Personel</h6>
                  <div>
                    <div style="width: 300px; padding: 30px; display: inline-block;">
                      <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" type="date" name="date_de_naissance" value="{date}" id="date_attendance_personel"  required minlength="5">
                        <div class="mdc-notched-outline">
                          <div class="mdc-notched-outline__leading"></div>
                          <div class="mdc-notched-outline__notch">
                            <label for="date_personnel" class="mdc-floating-label">Choisir une date specifique</label>
                          </div>
                          <div class="mdc-notched-outline__trailing"></div>
                        </div>
                      </div>
                    </div>

                    <div style="width: 300px; display: inline-block; padding: 30px;">
                      <button class="mdc-button mdc-button--raised filled-button--info" id="voir_attendance_personel"> voir la liste </button>
                    </div>

                    <div style="width: 300px; display: inline-block; padding: 30px;">
                      <button class="mdc-button mdc-button--raised filled-button--info" id="voir_tout_personel"> voir la liste entière </button>
                    </div>

                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center white">Photo</th>
                          <th class="text-center white">Noms</th>
                          <th class="text-center white">Fonction</th>
                          <th class="text-center white">Date</th>
                          <th class="text-center white">Heure entree</th>
                          <th class="text-center white">Heure sortie</th>
                          <th class="text-center white">Observation</th>
                        </tr>
                      </thead>
                      <tbody id="attendance_personnel"> {attendance_personnel} </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        <!-- partial:partials/_footer.html -->
        <footer>
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop"> <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © <a href="" target="_blank">Group Supra Electronics</a> 2020</span> </div>
              <!--div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center tx-14"><a href="http://unjournouveau.org" target="_blank">complexe scolaire UN JOUR NOUVEAU</a> </span>
              </div--></div>
          </div>
        </footer>
        <!-- partial -->
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="<?=base_url()?>/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?=base_url()?>/assets/vendors/chartjs/Chart.min.js"></script>
  <script src="<?=base_url()?>/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="<?=base_url()?>/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?=base_url()?>/vendors/jquery-3.5.1.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=base_url()?>/assets/js/material.js"></script>
  <script src="<?=base_url()?>/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base_url()?>/assets/js/dashboard.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){

    $("#voir_attendance_eleves").on("click", function() {
      
      var date = $("#date_attendance_eleves").val();
      var classe = $("#classe_attendance").val().toLowerCase();
      var val = classe+" | "+date;

      $("#attendance_eleves tr").filter(function() { 
        $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
      });
    });

     $("#voir_tout_eleves").on("click", function() {
      var value = "";
      $("#attendance_eleves tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    })


      $("#voir_attendance_personel").on("click", function() {
      
      var date = $("#date_attendance_personel").val().toLowerCase();

      $("#attendance_personnel tr").filter(function() { 
          $(this).toggle($(this).text().toLowerCase().indexOf(date) > -1);
        });
      });

     $("#voir_tout_personel").on("click", function() {
      var value = "";
      $("#attendance_personnel tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    })




  });
  </script>
  <!-- End custom js for this page-->
</body>

</html>