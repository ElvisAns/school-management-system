<?php
 echo' <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item" style="{style_dash}" >
              <a class="mdc-drawer-link " style="{style_link_dash}"  href="'.base_url("dashboard").'">
                <i class="material-icons  mdc-drawer-item-icon" aria-hidden="true">home</i>
                Acceuil
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item"  style="{style_payment}">

              <a class="mdc-drawer-link" style="{style_link_payment}" href="'.base_url("dashboard/payment").'">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
                Modalité de payment
              </a>
            </div>

            <div class="mdc-list-item mdc-drawer-item"  style="{style_presence}">

              <a class="mdc-drawer-link" style="{style_link_presence}" href="'.base_url("dashboard/presences").'">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                Liste de presences
              </a>
            </div>

            <div class="mdc-list-item mdc-drawer-item" style="{style_control_access}">

              <a class="mdc-expansion-panel-link" style="{style_link_control_access}" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                Control d\'accès
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="'.base_url("dashboard/access_control/eleves").'">
                      Eleves
                    </a>
                  </div>

                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="'.base_url("dashboard/access_control/staff_ecole").'">
                      Staff
                    </a>
                  </div>
                </nav>
              </div>
            </div>

            <div class="mdc-list-item mdc-drawer-item" style="{style_comptabilite}">
              <a class="mdc-drawer-link" style="{style_link_comptabilite}" href="'.base_url("dashboard/finances").'">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                comptabilité
              </a>
              
            </div>
             <div class="mdc-list-item mdc-drawer-item" style="{style_ajouter_classe}">
              <a class="mdc-drawer-link" style="{style_link_ajouter_classe}" href="'.base_url("dashboard/ajouter_classe/").'">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                  Ajouter classe
              </a>
            </div>

            <div class="mdc-list-item mdc-drawer-item" style="{style_users}">
              <a class="mdc-expansion-panel-link" style="{style_link_users}" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
                Utilisateurs
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="sample-page-submenu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="'.base_url("dashboard/users/ajouter").'">
                      Ajouter
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="'.base_url("dashboard/users/voir").'">
                      Listes complete
                    </a>
                  </div>
                </nav>
              </div>
            </div>

            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="http://localhost/settings/timesetting.php">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                Configuration Heure
              </a>
            </div>

            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="'.base_url("dashboard/documentation").'" target="_blank">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                Guide
              </a>
            </div>
          </nav>
        </div>'
        ;

?>