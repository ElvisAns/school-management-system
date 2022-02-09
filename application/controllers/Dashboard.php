<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *    http://example.com/index.php/welcome
     *  - or -
     *    http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {

      parent::__construct();
      $this
      ->load
      ->library('parser');
      $this
      ->load
      ->helper('url');
      $this
      ->load
      ->helper('form');

      $this->load->library('authit');
      $this->load->helper('authit');
      $this->config->load('authit');
      
      $this->load->helper('url');

      date_default_timezone_set("Africa/Kigali");

      $this
      ->load
      ->library('session');
        //echo "test ... test ... test..";

      $this->load->model("data_model");
      
    }

    


    public function index()
    {
      if(!logged_in()) redirect('auth/login');
      
      function round_toUpper($n) 
      { 
        $a=$n%10==0?$n:$n>10?(10-$n%10)+$n:$n+(5-$n%10);
        return $a;
      } 

      $user_data = (array)user();

      $email = $user_data['email'];

      $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */

            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'',
              'style_link_users' => '',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> 'background-color:#fff; color:#000;',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);


            $table_template = "";

            $template = '<tr><!--td><img src="{proccess_author_image}" style="height :30px; width : auto; border-radius:15px;"></td-->
            <td>{username}</td>
            <td>{trans_id}</td>
            <td>{action}</td>
            <td>{dateheure}</td>
            </tr>';

            $data = $this->data_model-> get_action_logs_table();

            foreach ($data as $menuitem)
            {
              $table_template .= $this
              ->parser
              ->parse_string($template, $menuitem, true);
            }

        $attendance_eleve = $this->data_model->get_attendance_perdayOfweek_eleves(); //array of attendance in the week
        $attendance_staff = $this->data_model->get_attendance_perdayOfweek_staff(); //array of attendance in week

        $m1=max($attendance_eleve);
        $m2=max($attendance_staff);

        $maxChart=round_toUpper(max($m1,$m2));

        $stepSizeChart=$maxChart>10?$maxChart>100?$maxChart>1000?100:10:5:1;

        $attendance_eleve_json = json_encode($attendance_eleve);
        $attendance_staff_json = json_encode($attendance_staff);

        $json = array(
          'data_eleves' => $attendance_eleve_json,
          'data_staff' => $attendance_staff_json,
          'step_size' => $stepSizeChart,
          'max_for_chart' => $maxChart

        );

        $chart_template = $this
        ->parser
        ->parse('chart_template', $json, true);

        $data = array(
          'title' => 'ujn-e-system',

          'username' => $user_permission['nom'],
          'email' => $user_permission['email'],
          'profile_image' => base_url($user_permission['profile_photo']) ,

          'logo' => base_url('favicon.png') ,
          
          'income' => $this->data_model->dashboard_utility()['entree_total'],
          
          'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
          
          'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
          
          'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
          
          'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
          
          'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
          
          'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
          
          'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

          'list_history' => $table_template,
          
          'script_chart' => $chart_template,
          
          'menu' => $menu
        );

        $this   
        ->parser
        ->parse('dashboard', $data);

      }

      public function users($option = false)

      {
        if(!logged_in()) redirect('auth/login');

        if($this->input->post("action")=="add_eleve"){
          
          $config['upload_path'] = 'assets/images/faces/';
          $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']     = '800'; //max 800kb
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $this->input->post("nom").time();

      $this->load->library('upload', $config);

      $u = $this->upload->do_upload('photo_eleve');

      if(!$u)  $_POST["photo"] = $this->input->post("old_photo");
      
      else $_POST["photo_eleve"]=$config['upload_path'].$this->upload->data('file_name') ;

      $this->data_model->update_eleve($this->input->post());

      $option="voir";
    }
    
      if($this->input->post("action")=="add_staff"){ //update staff


        $config['upload_path'] = 'assets/images/faces/';
        $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']     = '800'; //max 800kb
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $this->input->post("nom").time();

      $this->load->library('upload', $config);

      $u = $this->upload->do_upload('photo');

      if(!$u)  $_POST["photo"] = $this->input->post("old_photo");
      
      else $_POST["photo"]=$config['upload_path'].$this->upload->data('file_name') ;


      $this->data_model->update_staff($this->input->post());

      $option="voir";
    }


      if($this->input->post("action") == "config_eleve"){ //insert student



        $config['upload_path'] = 'assets/images/faces/';
        $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']     = '800'; //max 800kb
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $this->input->post("nom").time();

      $this->load->library('upload', $config);

      $u = $this->upload->do_upload('photo_eleve');

      if(!$u)  unset($_POST["photo_eleve"]);
      
      else $_POST["photo_eleve"]=$config['upload_path'].$this->upload->data('file_name') ;

      $e=$this->data_model->create_eleve($this->input->post());

      if(!$e) redirect("dashboard/users/voir");

      else $option="voir";
    }


    if($this->input->post("action") == "config_staff"){
      
      $config['upload_path'] = 'assets/images/faces/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']     = '800'; //max 800kb
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $this->input->post("nom").time();

      $this->load->library('upload', $config);

      $u = $this->upload->do_upload('photo');

      if(!$u)  $_POST["photo"] = "assets/images/faces/avatar.png";
      
      else $_POST["photo"]=$config['upload_path'].$this->upload->data('file_name') ;

      $e=$this->data_model->create_staff($this->input->post());

      if(!$e) redirect("dashboard/users/voir");

      else $option="voir";
    }





    if (!$option)
    {
      redirect("dashboard");
    }

    
    $user_data = (array)user();

    $email = $user_data['email'];

    $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */

            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'',
              'style_link_users' => 'background-color:#fff; color:#000;',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);

            

            if ($option == "ajouter")
            {

              $options = "";

              $classes_list = $this->data_model->get_class();
              

              $classes_list_template = '<option value="{classe}">{classe}</option>';

              foreach ($classes_list as $key)
              {
                $options .= $this
                ->parser
                ->parse_string($classes_list_template, $key, true);
              }

              $data_ajouter = array(
                'title' => 'ujn-e-system',
                'title' => 'ujn-e-system',

                'username' => $user_permission['nom'],
                'email' => $user_permission['email'],
                'profile_image' => base_url($user_permission['profile_photo']) ,
                'logo' => base_url('favicon.png') ,

                
                'income' => $this->data_model->dashboard_utility()['entree_total'],
                
                'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
                
                'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
                
                'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
                
                'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
                
                'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
                
                'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
                
                'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

                'menu' => $menu,
                'classe_options' => $options,
                'date' => date('Y-m-d')
              );

              $this
              ->parser
              ->parse('users_config', $data_ajouter);
            }

            elseif ($option = "voir")
            {

              $eleves_list = array();

              $eleves = array();

              foreach ( $this->data_model->get_list_eleve() as $key => $value) {
                $eleves['photo_eleve']=base_url($value['photo_eleve']);
                $eleves['post_nom_eleve']=$value['post_nom'];
                $eleves['prenom_eleve']=$value['nom'];
                $eleves['noms_eleve']=$value['prenom'];
                $eleves['classe']=$value['classe'];
                $eleves['date_inscription']=$value['inscription'];
                $eleves['telephone_parent']=$value['telephone_parent'];
                $eleves['mail_parents']=$value['email_parents'];
                $eleves['lien_action']=base_url("dashboard/editer/eleve/".$value['numero_id']);
                array_push($eleves_list, $eleves);
              }

              $personel_list = array();
              $personel = array();

              foreach ( $this->data_model->get_list_staff() as $key => $value) {
                $personel['photo']=base_url($value['photo']);
                $personel['noms_personnel']=$value['nom'];
                $personel['post_nom_personnel']=$value['post_nom'];
                $personel['prenom_personnel']=$value['prenom'];
                $personel['telephone_personnel']=$value['telephone'];
                $personel['mail_personnel']=$value['email'];
                $personel['lien_action']=base_url("dashboard/editer/personel/".$value['numero_id']);
                $personel['fonction']=$value['fonction'];
                array_push($personel_list,$personel);
              }

              $liste_eleves = "";
              $liste_personnel = "";

              $liste_eleves_template = '<tr>
              <th><img src="{photo_eleve}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
              <td class="text-center">{noms_eleve} {post_nom_eleve} {prenom_eleve}</td>
              <td class="text-center">{classe}</td>
              <td class="text-center">{date_inscription}</td>
              <td class="text-center">{telephone_parent}</td>
              <td class="text-center">{mail_parents}</td>
              <td class="text-center"><a href="{lien_action}">Editer</a></td>
              </tr>';

              $liste_personnel_template = '<tr>
              <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
              <td class="text-center">{noms_personnel}</td>
              <td class="text-center">{post_nom_personnel}</td>
              <td class="text-center">{prenom_personnel}</td>
              <td class="text-center">{telephone_personnel}</td>
              <td class="text-center">{mail_personnel}</td>
              <td class="text-center">{fonction}</td>
              <td class="text-center"><a href="{lien_action}">Editer</a></td>
              </tr>';

              foreach ($eleves_list as $menuitem)
              {
                $liste_eleves .= $this
                ->parser
                ->parse_string($liste_eleves_template, $menuitem, true);
              }

              foreach ($personel_list as $menuitems)
              {
                $liste_personnel .= $this
                ->parser
                ->parse_string($liste_personnel_template, $menuitems, true);
              }

              $data_liste = array(
                'title' => 'ujn-e-system',

                'username' => $user_permission['nom'],
                'email' => $user_permission['email'],
                'profile_image' => base_url($user_permission['profile_photo']) ,

                'logo' => base_url('favicon.png') ,
                
                
                'income' => $this->data_model->dashboard_utility()['entree_total'],
                
                'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
                
                'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
                
                'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
                
                'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
                
                'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
                
                'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
                
                'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],
                'menu' => $menu,
                'liste_eleves' => $liste_eleves,
                'liste_personnel' => $liste_personnel
              );

              $this
              ->parser
              ->parse('user_action', $data_liste);
            }
            else
            {
              redirect("dashboard");
            }
          }

          public function editer($destination = false, $user_rfid = false)
          {
            if(!logged_in()) redirect('auth/login');

            if (!$destination || !$user_rfid) redirect("dashboard/users/voir");

            
            $user_data = (array)user();

            $email = $user_data['email'];

            $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */

            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'',
              'style_link_users' => 'background-color:#fff; color:#000;',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);


            $options = "";

            $classes_list = $this->data_model->get_class();

            $classes_list_template = '<option value="{classe}">{classe}</option>';

            foreach ($classes_list as $key)
            {
              $options .= $this
              ->parser
              ->parse_string($classes_list_template, $key, true);
            }

        #noms,prenom,postnom,sexe, fonction,address,Telephone,mail,rfid,image_path,classe,lieu_de_naissance,nom_du_pere,nom_de_la_mere,date_de_naissance,lieu_de_naissance,Telephone_parent,autre_contact,Observation_sanitaire,
            

            $formdata = "";

            if ($destination == "eleve")
        { //select where user_rfid=$userrfid
          if(!$user_rfid) redirect("dashboard/users/");

          $eleves_prev_data=$this->data_model->get_specific_eleve($user_rfid);

          if(!$eleves_prev_data) redirect("dashboard/users/");

          $eleves = $eleves_prev_data;

          $tmp = array(
            'classe_option' => $options
          );

          $buffer = $this
          ->load
                ->view('editer_eleve', $tmp, true); //editer_eleve is the form

            //print_r($buffer);
                foreach ($eleves as $key)
                {
                  $formdata .= $this
                  ->parser
                  ->parse_string($buffer, $key, true);
                }

              }

              else if ($destination == "personel")
        { //select wher

          if(!$user_rfid) redirect("dashboard/users/");

          $staff_prev_data=$this->data_model->get_specific_staff($user_rfid);

          $personel = $staff_prev_data;

          $buffer = $this
          ->load
                ->view('editer_staff', '', true); //editer_staff is the form template
                

                foreach ($personel as $key)
                {

                  $formdata .= $this
                  ->parser
                  ->parse_string($buffer, $key, true);
                }

              }
              else
              {
                redirect("dashboard/users/voir");
              }

              $data_editer = array(
                'title' => 'ujn-e-system',

                'username' => $user_permission['nom'],
                'email' => $user_permission['email'],
                'profile_image' => base_url($user_permission['profile_photo']) ,
                'logo' => base_url('favicon.png') ,

                
                'income' => $this->data_model->dashboard_utility()['entree_total'],
                
                'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
                
                'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
                
                'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
                
                'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
                
                'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
                
                'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
                
                'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],
                'menu' => $menu,
                'filled_form' => $formdata
              );

              $this
              ->parser
              ->parse('users_edit', $data_editer);

            }

            public function payment()
            {
              
              if(!logged_in()) redirect('auth/login');

              $entry_modality_template = '<tr {background-table-row}>
              <td >
              <input value="{class}" disabled {style_text} class="f_in" name="{class}">
              <p>
              <div class="mdc-form-field">
              <label {style_text} for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Renvoie insolvable</label>
              <div class="mdc-checkbox">
              <input type="checkbox"
              id="basic-disabled-checkbox"
              class="mdc-checkbox__native-control"
              {class_chase_status}  name="{class}_chase_status" />
              <div class="mdc-checkbox__background">
              <svg class="mdc-checkbox__checkmark"
              viewBox="0 0 24 24">
              <path class="mdc-checkbox__checkmark-path"
              fill="none"
              d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
              </svg>
              <div class="mdc-checkbox__mixedmark"></div>
              </div>
              </div>
              
              </div>

              </td>
              <td>
              <label {style_text}>Minerval</label> <input value={class_minerval} type="number"   step="0.01"  name="{class}_minerval">
              <p> 
              <label {style_text} >Avoir payé</label> <input type="number"   step="0.01"  value={class_minerval_offset} name="{class}_minerval_offset">
              </td>

              <td>
              <label {style_text}>Construction</label><input type="number"   step="0.01"  value={class_constr} name="{class}_constr">
              <p> 
              <label {style_text}>Avoir payé</label> <input type="number"   step="0.01" value={class_constr_offset} name="{class}_constr_offset">
              </td>

              <td>
              <label {style_text}>Bibliotheque</label><input type="number"   step="0.01" value={class_biblio} name="{class}_biblio">
              <p> 
              <label {style_text}>Avoir payé</label> <input type="number"   step="0.01"  value={class_biblio_offset} name="{class}_biblio_offset">
              </td>



              <td>
              <label {style_text}>transport</label><input type="number"   step="0.01" value={class_trans} name="{class}_trans">
              <p> 
              <label {style_text}>Avoir payé</label> <input type="number"   step="0.01"  value={class_trans_offset} name="{class}_trans_offset">
              </td>


              <td>
              <label {style_text}>Quantine</label><input type="number"   step="0.01" value={class_quantine} name="{class}_quantine">
              <p> 
              <label {style_text}>Avoir payé</label> <input type="number"   step="0.01" value={class_quantine_offset} name="{class}_quantine_offset">
              </td>
              </tr>';

        $classes_list = $this->data_model-> get_class(); //normalement ces elts viennent d'une requete
        sort($classes_list);

        $offset_settings = array();

        $offset_str = "";
        $i = 0;
        foreach ($classes_list as $key => $value)
        {

          $classe_slices = $this->data_model->get_class_slice($classes_list[$key]["classe"]);
          $classe_fees = $this->data_model->get_class_fees($classes_list[$key]["classe"]);
          $tmp=$classe_slices;
          unset($tmp[0]['id']);
          unset($tmp[0]['classe']);

          $chase_status=array_values($tmp[0]);

          $maxu = max($chase_status); 

          $statx=true;

          if ($maxu > 0){
            $statx = true;
          }

          else{
            $statx = false;
          }

          $settings = array(
            "class" => $classes_list[$key]["classe"],
            "class_minerval" => $classe_fees[0]['frais_scolaires'],
            "class_minerval_offset" => $classe_slices[0]['frais_scolaires'],
            "class_trans" => $classe_fees[0]['frais_transport'],
            "class_trans_offset" => $classe_slices[0]['frais_transport'],
            "class_constr" => $classe_fees[0]['frais_construction'],
            "class_constr_offset" => $classe_slices[0]['frais_construction'],
            "class_biblio" => $classe_fees[0]['frais_bibliotheque'],
            "class_biblio_offset" => $classe_slices[0]['frais_bibliotheque'],
            "class_quantine" => $classe_fees[0]['frais_cantine'],
            "class_quantine_offset" => $classe_slices[0]['frais_cantine'],
            "class_chase_status" => $statx? "checked" : "",
            "style_text" => !$statx? 'style="color:blue;"' : 'style="color:#fff;"',
            "background-table-row" => !$statx? 'style="background-color:#fff;"' : 'style="background-color:rgba(191, 38, 8,0.7);"'
            ); //before saving make sure we append the dollar sign if not included when saving\
          array_push($offset_settings, $settings);
          $i++;
        }

        foreach ($offset_settings as $key)
        {
          $offset_str .= $this
          ->parser
          ->parse_string($entry_modality_template, $key, true);
        }

        $user_data = (array)user();

        $email = $user_data['email'];

        $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */
            if($user_permission['checkstate_finances']=='inactive'){
              
              redirect('no_permission');
            }


            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'',
              'style_link_payment' => 'background-color:#fff; color:#000;',
              'style_link_comptabilite'=>'',
              'style_link_users' => '',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);


            $data_payment = array(
              'title' => 'ujn-e-system',

              'username' => $user_permission['nom'],
              'email' => $user_permission['email'],
              'profile_image' => base_url($user_permission['profile_photo']) ,

              'logo' => base_url('favicon.png') ,
              
              'income' => $this->data_model->dashboard_utility()['entree_total'],
              
              'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
              
              'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
              
              'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
              
              'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
              
              'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
              
              'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
              
              'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

              'entry_modality' => $offset_str,
              'menu' => $menu
            );

            $this
            ->parser
            ->parse('modality', $data_payment);

          }

          public function presences()
          {
            
            if(!logged_in()) redirect('auth/login');

            $user_data = (array)user();

            $email = $user_data['email'];

            $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */

            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'background-color:#fff; color:#000;',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'',
              'style_link_users' => '',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);


            $attendance_eleves = $this->data_model->getAttendance_eleve();

            $attendance_personel = $this->data_model->getAttendance_staff();

            $liste_eleves = "";
            $liste_personnel = "";

            $attendance_eleves_template = '<tr>
            <th><img src="{photo_eleve}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_eleve} {post_nom_eleve} {prenom_eleve}</td>
            <td class="text-center">{classe} | {date}</td>
            <td class="text-center">{heure_arrive}</td>
            <td class="text-center">{heure_sortie}</td>
            <td class="text-center">{observation}</td>
            </tr>';

            $attendance_personnel_template = '<tr>
            <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_personnel} {post_nom_personnel} {prenom_personnel}</td>
            <td class="text-center">{fonction}</td>
            <td class="text-center">{date}</td>
            <td class="text-center">{heure_arrive}</td>
            <td class="text-center">{heure_sortie}</td>
            <td class="text-center">{observation}</td>
            </tr>';

            foreach ($attendance_eleves as $menuitem)
            {
              $liste_eleves .= $this
              ->parser
              ->parse_string($attendance_eleves_template, $menuitem, true);
            }

            foreach ($attendance_personel as $menuitems)
            {
              $liste_personnel .= $this
              ->parser
              ->parse_string($attendance_personnel_template, $menuitems, true);
            }

            $options = "";

        $classes_list = $this->data_model->get_class(); //normalement ces elts viennent d'une requete
        

        $classes_list_template = '<option value="{classe}">{classe}</option>';

        foreach ($classes_list as $key)
        {
          $options .= $this
          ->parser
          ->parse_string($classes_list_template, $key, true);
        }

        $data_liste = array(
          'title' => 'ujn-e-system',

          'username' => $user_permission['nom'],
          'email' => $user_permission['email'],
          'profile_image' => base_url($user_permission['profile_photo']) ,

          'logo' => base_url('favicon.png') ,
          
          'income' => $this->data_model->dashboard_utility()['entree_total'],
          
          'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
          
          'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
          
          'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
          
          'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
          
          'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
          
          'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
          
          'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

          'menu' => $menu,
          'attendance_eleves' => $liste_eleves,
          'attendance_personnel' => $liste_personnel,
          'date' => date('Y-m-d') ,
          'classe_option' => $options
        );

        $this
        ->parser
        ->parse('users_attendance', $data_liste);

      }

      public function finances($action = false, $student_classe = false, $student_id = false, $motif = false, $error = '', $sname = false)
      {
        if(!logged_in()) redirect('auth/login');

        
        $user_data = (array)user();

        $email = $user_data['email'];

        $user_permission = $this->data_model->getUserPermision($email);

        $processor=$email.', '.$user_permission['nom'];
        $html = "";
        $filename = "";


        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */

            if($user_permission['checkstate_finances']=='inactive'){
              redirect('no_permission');
            }

            $data_menu = array(
              'style_link_control_access' =>'',
              'style_link_presence' =>'',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'background-color:#fff; color:#000;',
              'style_link_users' => '',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);


            if ($action and $student_classe and $student_id and $motif)
        { //this will generate the bank slip
          $data_liste = array(
            'title' => 'ujn-e-system',
            'username' => 'John santos',
            'email' => 'josantosnd20@gmail.com',
            'profile_image' => base_url('assets/images/faces/john%20santos.jpg') ,
            'logo' => base_url('favicon.png') ,
            
            
            'income' => $this->data_model->dashboard_utility()['entree_total'],
            
            'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
            
            'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
            
            'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
            
            'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
            
            'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
            
            'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
            
            'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

            'menu' => $menu,
            'date' => Date("F j, Y H:i:s") ,
            'classe' => $student_classe,
            ''
          );

          $this
          ->parser
          ->parse('student_pay', $data_liste);

        }
        else
        {
          $eleves_list = array();

          $eleves = array();

          foreach ( $this->data_model->get_list_eleve() as $key => $value) {
            $eleves['photo_eleve']=base_url($value['photo_eleve']);
            $eleves['post_nom_eleve']=$value['post_nom'];
            $eleves['prenom_eleve']=$value['nom'];
            $eleves['noms_eleve']=$value['prenom'];
            $eleves['classe']=$value['classe'];
            $eleves['date_inscription']=$value['inscription'];
            $eleves['telephone_parent']=$value['telephone_parent'];
            $eleves['mail_parents']=$value['email_parents'];
            $eleves['lien_action']=base_url("dashboard/editer/eleve/".$value['numero_id']);
            $eleves['paiement']=base_url("bordereaux");
            array_push($eleves_list, $eleves);
          }

          $list_eleves = $this->data_model->get_list_eleve_with_payment();

            /*
            2 => 
              0 => 
            array (size=31)
              'id' => string '1' (length=1)
              'numero_id' => string '263294246' (length=9)
              'nom' => string 'Murhula' (length=7)
              'post_nom' => string 'Kalala' (length=6)
              'prenom' => string 'Lucien' (length=6)
              'photo_eleve' => string 'assets/images/faces/Murhula1608770431.jpg' (length=41)
              'classe' => string '1ereA' (length=5)
              'section' => string 'HP' (length=2)
              'sexe' => string 'Masculin' (length=8)
              'adresse' => string 'GOMA' (length=4)
              'date_naissance' => string '2020-12-06' (length=10)
              'lieu_naissance' => string 'GOMA' (length=4)
              'nom_pere' => string 'VITAL' (length=5)
              'nom_mere' => string 'AIME' (length=4)
              'telephone_parent' => string '0975134801' (length=10)
              'email_parents' => string 'greenlight@gmail.com' (length=20)
              'nom_enseignant' => string 'CLAUDE' (length=6)
              'details_sanitaires' => string 'inconn' (length=6)
              'status' => string '1' (length=1)
              'photo' => string 'assets/images/faces/Murhula1608770342.png' (length=41)
              'inscription' => string '' (length=0)
              'frais_scolaires_paid' => string '395.4' (length=5)
              'frais_construction_paid' => string '9' (length=1)
              'frais_bibliotheque_paid' => string '256.7' (length=5)
              'frais_cantine_paid' => string '14' (length=2)
              'frais_transport_paid' => string '116.1' (length=5)
              'frais_scolaires' => string '0' (length=1)
              'frais_construction' => string '0' (length=1)
              'frais_bibliotheque' => string '0' (length=1)
              'frais_cantine' => string '0' (length=1)
              'frais_transport' => string '0' (length=1)
            */
              $liste_eleves = "";

              $payment_eleves_template = '<tr>
              <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
              <td class="text-center">{nom} {post_nom} {prenom}</td>
              <td class="text-center">{classe}</td>
              <td class="text-center">{frais_scolaires_paid}$/{frais_scolaires}$</td>
              <td class="text-center">{frais_construction_paid}$/{frais_construction}$</td>
              <td class="text-center">{frais_bibliotheque_paid}$/{frais_bibliotheque}$</td>
              <td class="text-center">{frais_transport_paid}$/{frais_transport}$</td>
              <td class="text-center">{frais_cantine_paid}$/{frais_cantine}$</td>
              <td class="text-center">
              <form action="{paiement}" autocomplete="off" class="lancer" method="POST">
              <input type="hidden" name="student_id" value="{numero_id}">
              <input type="hidden" name="student_classe" value="{classe}">
              <input type="hidden" name="student_name" value="{nom} {post_nom} {prenom}">
              <input type="hidden" name="student_fname" value="{nom}">
              <input type="hidden" name="randomn_check" value="">

              <input type="hidden" name="action" value="print">
              <input type="number" class="money" step="0.01"  value="" name="minerval" placeholder="minerval" style="width:90px; margin:10px; height:20px; letter-spacing:1px; text-align:center;">
              <br>
              <input type="number" class="money" step="0.01" value="" name="construction" placeholder="construction" style="width:90px; margin:10px; margin-top:none;height:20px; letter-spacing:1px; text-align:center;">
              <br>
              <input type="number" class="money" step="0.01" value="" name="bibliotheque" placeholder="bibliotheque" style="width:90px;  margin:10px; margin-top:none; height:20px; letter-spacing:1px; text-align:center;">
              <br>
              <input type="number" class="money" step="0.01" value="" name="transport" placeholder="transport" style="width:90px; margin:10px; margin-top:none; height:20px; letter-spacing:1px; text-align:center;">
              <br>
              <input type="number" class="money" step="0.01"  value="" name="Quantine" placeholder="cantine" style="width:90px; margin:10px; margin-top:none; height:20px; letter-spacing:1px; text-align:center;">
              <br>
              <button  class="mdc-button mdc-button--raised filled-button--info confirm">valider</button>

              <button type="submit" class="mdc-button mdc-button--raised filled-button--danger">Lancer</button>
              </form>

              </td>
              </tr>';

              foreach ($list_eleves as $menuitem)
              {
                $liste_eleves .= $this
                ->parser
                ->parse_string($payment_eleves_template, $menuitem, true);
              }

              $options = "";

            $classes_list = $this->data_model->get_class(); //normalement ces elts viennent d'une requete
            

            $classes_list_template = '<option value="{classe}">{classe}</option>';

            foreach ($classes_list as $key)
            {
              $options .= $this
              ->parser
              ->parse_string($classes_list_template, $key, true);
            }

            if ($error === "1")
            {
              $error = ' 
              $.notify("verifiez les valeurs entrées pour #' . $sname . '");
              $.notify("vous avez entre des valeurs qui ne correspondent pas");
              ';
            }

            if ($error === "2")
            {
              $error = ' 
              $.notify("Vous venez d\'annuler l\'enregistrement explicitement");
              ';
            }

            if ($error === "3")
            {
              $error = ' 
              $.notify("Vous venez d\'entrer des characteres incorrects, rassurez vous d\'etre bien frais");
              ';
            }

            if ($error === "7")
            {
              $error = ' 
              $.notify("Le payment precedent n\'a pas eu lieu du à une erreur inconnue");
            //$.notify("Veuilez réessayer, si non effectué toujours; verifiez les valeurs entrées ou demandez assistance");
              ';
            }

            if ($error === "4")
            {
                #if (empty($_SESSION['pdf_data'])) redirect("dashboard/finances/0/0/0/0/5/");

              $this
              ->load
              ->library('pdf');

              $html = $this->parser->parse('bank_slip_model', $this->session->userdata('pdf_data') , true);


              $filename = 'Recu-' . $_SESSION["pdf_data"]["student_classe"] . '-' . strtoupper($_SESSION["pdf_data"]['student_fname']) . '#' . dechex(time()) . '#' . strtolower($_SESSION["pdf_data"]["student_id"]);

              
                //$_SESSION['pdf_data'] = array(); //dont distroy it help to generated\ pdf, remember, resetting is made before any invoice
              
              $this
              ->pdf
              ->createPDF($html, $filename, false);


              $this
              ->load
              ->view('export');

              $error = ' 
              //$.notify("Paiement effectué avec succes");
              $.notify("Veuilez verifiez votre zone de telechargement pour retrouver le recu de payment");
              ';
            }

            if ($error === "5")
            {
              $error = ' 
        //$.notify("Veuillez repeter l\'action");
              $.notify("Erreur fatale");
              ';
            }

            $data_liste = array(
              'title' => 'ujn-e-system',

              'username' => $user_permission['nom'],
              'email' => $user_permission['email'],
              'profile_image' => base_url($user_permission['profile_photo']) ,

              'logo' => base_url('favicon.png') ,
              
              'income' => $this->data_model->dashboard_utility()['entree_total'],
              
              'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
              
              'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
              
              'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
              
              'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
              
              'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
              
              'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
              
              'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

              'menu' => $menu,
              'financial_state_eleves' => $liste_eleves,
              'date' => date('Y-m-d') ,
              'classe_option' => $options,
              'error' => $error
            );

            $this
            ->parser
            ->parse('finance_control', $data_liste);
          }

        }

        private function export_pdf()
        {
          if(!logged_in()) redirect('auth/login');

          redirect();

          $slip_num_id = "";

          $this
          ->load
          ->library('pdf');
          $html = $this
          ->load
          ->view('form_bordereau');
          $this
          ->pdf
          ->createPDF($html, 'mypdf', false);

          $this
          ->load
          ->view('export');

        }

        public function access_control($option = false,$action=false,$id=false)
        {      
          if(!logged_in()) redirect('auth/login');

          $user_data = (array)user();

          $email = $user_data['email'];

          $user_permission = $this->data_model->getUserPermision($email);

        /*
         $user_permission = array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo']
              'email' => $response[0]['email']
            )
        */
            if($user_permission['checkstate_comptes']=='inactive'){
              redirect('no_permission');
            }

            $data_menu = array(
              'style_link_control_access' =>'background-color:#fff; color:#000;',
              'style_link_presence' =>'',
              'style_link_payment' => '',
              'style_link_comptabilite'=>'',
              'style_link_users' => '',
              'style_link_ajouter_classe'=>'',
              'style_link_dash'=> '',

              'style_dash' => "",
              'style_users' => $user_permission['checkstate_comptes']=='inactive'? "display:none;" : "",
              'style_ajouter_classe' =>" ",
              'style_comptabilite' => $user_permission['checkstate_finances']=='inactive'? 'display:none;' : " ",
              'style_control_access' => $user_permission['checkstate_comptes']=='inactive'? 'display:none;' : "",
              'style_presence' => "",
              'style_payment' => $user_permission['checkstate_finances']=='inactive'? "display:none;" : ""
            );


            $menu = $this
            ->parser
            ->parse("menu_dashboard", $data_menu, true);

            $notification="";

            if (!$option)
            {
              redirect("dashboard");
            }

            if ($option == "eleves")
            {
              if($action=="desactive"){
                //perform db action, 
               $dbresponse = $this->data_model->desactivate($id);

               if($dbresponse){ 
                $notification='$.notify("Action effectué avec success, l\'eleve a ete desactivé");';
              }
              else{
                $notification='$.notify("Action non effectué, veuillez réessayer");';
              }
            }
            else if ($action == "active") {
                 //perform db action, 
              $dbresponse = $this->data_model->activate($id);

              if($dbresponse){ 
                $notification='$.notify("Action effectué avec success, l\'eleve a ete reactivé dans le system")';
              }
              else{
                $notification='$.notify("Action non effectué, veuillez réessayer")';
              }
            }

            
            $eleves_list = array();

            $eleves_tmp = array();

            foreach ( $this->data_model->get_list_eleve_active() as $key => $value) {
              $eleves_tmp ['photo_eleve']=base_url($value['photo_eleve']);
              $eleves_tmp ['post_nom_eleve']=$value['post_nom'];
              $eleves_tmp ['prenom_eleve']=$value['nom'];
              $eleves_tmp ['noms_eleve']=$value['prenom'];
              $eleves_tmp ['classe']=$value['classe'];
              $eleves_tmp ['date_inscription']=$value['inscription'];
              $eleves_tmp ['telephone_parent']=$value['telephone_parent'];
              $eleves_tmp ['mail_parents']=$value['email_parents'];
              $eleves_tmp ['lien_action']=base_url("dashboard/access_control/eleves/desactive/".$value['numero_id']);
              $eleves_tmp ['target'] = "Desactiver";
              array_push($eleves_list, $eleves_tmp );
            }
            
            $eleves = $eleves_list;

            $eleves_list_inactive = array();

            $eleves_tmp = array();

            foreach ( $this->data_model->get_list_eleve_inactive() as $key => $value) {
              $eleves_tmp ['photo_eleve']=base_url($value['photo_eleve']);
              $eleves_tmp ['post_nom_eleve']=$value['post_nom'];
              $eleves_tmp ['prenom_eleve']=$value['nom'];
              $eleves_tmp ['noms_eleve']=$value['prenom'];
              $eleves_tmp ['classe']=$value['classe'];
              $eleves_tmp ['date_inscription']=$value['inscription'];
              $eleves_tmp ['telephone_parent']=$value['telephone_parent'];
              $eleves_tmp ['mail_parents']=$value['email_parents'];
              $eleves_tmp ['lien_action']=base_url("dashboard/access_control/eleves/active/".$value['numero_id']);
              $eleves_tmp ['target'] = "Reactiver";
              array_push($eleves_list_inactive, $eleves_tmp );
            }
            


            $eleves_inactive = $eleves_list_inactive;



            $liste_eleves = "";
            $liste_eleves_inactive = "";

            $liste_eleves_template = ' <th><img src="{photo_eleve}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_eleve} {post_nom_eleve} {prenom_eleve}</td>
            <td class="text-center">{classe}</td>
            <td class="text-center">{date_inscription}</td>
            <td class="text-center">{telephone_parent}</td>
            <td class="text-center">{mail_parents}</td>
            <td class="text-center"><a href="{lien_action}">{target}</a></td>
            </tr>';


            foreach ($eleves as $menuitem)
            {
              $liste_eleves .= $this
              ->parser
              ->parse_string($liste_eleves_template, $menuitem, true);
            }

            foreach ($eleves_inactive as $menuitem)
            {
              $liste_eleves_inactive .= $this
              ->parser
              ->parse_string($liste_eleves_template, $menuitem, true);
            }

            $data_liste = array(
              'title' => 'ujn-e-system',

              'username' => $user_permission['nom'],
              'email' => $user_permission['email'],
              'profile_image' => base_url($user_permission['profile_photo']) ,

              'logo' => base_url('favicon.png') ,

              
              'income' => $this->data_model->dashboard_utility()['entree_total'],
              
              'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
              
              'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
              
              'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
              
              'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
              
              'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
              
              'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
              
              'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],


              'menu' => $menu,
              'liste_eleves' => $liste_eleves,
              'liste_eleves_inactive' => $liste_eleves_inactive,
              'notification' => $notification 
            );

            $this
            ->parser
            ->parse('eleve_control', $data_liste);


          }

          else if ($option == "staff_ecole")
          {
            if($this->input->post("action") == "reactivation"){
              $activation = $this->data_model->reactivation_agent($this->input->post("id_personnel"));
              
              if($activation){ 
                $notification='$.notify("Action effectué avec success, l\'agent a ete desactivé");';
              }
              else{
                $notification='$.notify("Action non effectué, veuillez réessayer");';
              }

            }

            if($this->input->post("action") == "update_permission"){
              
              $send=array();

              $send['numero_id'] = $_POST['id_personnel'];

              $send['normal_access'] = isset($_POST['acces_normal'])?"active" : "inactive";

              $send['checkstate_comptes'] = isset($_POST['acces_compte'])?"active" :"inactive";

              $send['checkstate_finances'] = isset($_POST['acces_finance'])?"active" : "inactive";

              $_POST=array();

              $activation = $this->data_model->update_permission_agent($send);
              
              if($activation){ 
                $notification='$.notify("Action effectué avec success");';
              }
              else{
                $notification='$.notify("Action non effectué, veuillez réessayer");';
              }

            }

            
            $liste_personnel = "";
            $liste_personnel_inactif="";


            $personel_actifs = $this->data_model->get_list_staff_with_state();

            $personel_inactifs = $this->data_model->get_list_staff_with_state_inactives();

            $liste_personnel_template = '<tr>
            <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_personnel} {post_nom_personnel} {prenom_personnel}</td>
            <td class="text-center">{telephone_personnel}</td>
            <td class="text-center">{mail_personnel}</td>
            <td class="text-center">{fonction_personnel}</td>
            <td class="text-center">
            <form style="display: block;" action="{lien_action}" method="POST"> 
            <input type="hidden" name="id_personnel" value="{id_personnel}">
            <input type="hidden" name="action" value="update_permission">
            <label for="normal">Accès normal</label>
            <input type="checkbox" id="normal" value="active" name="acces_normal" {checkstate_normal}> 

            <label for="comptes">Control des comptes</label>
            <input type="checkbox" id="comptes" value="active" name="acces_compte" {checkstate_comptes}> 
            
            <label for="finances">Control de la comptabilité</label>
            <input type="checkbox" id="finances" value="active" name="acces_finance" {checkstate_finances}> 

            <button type="submit">Enregister</button>
            </form> </a>
            </td>
            </tr>';

            $liste_personnel_inactif_template = '<tr>
            <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_personnel} {post_nom_personnel} {prenom_personnel}</td>
            <td class="text-center">{telephone_personnel}</td>
            <td class="text-center">{mail_personnel}</td>
            <td class="text-center">{fonction_personnel}</td>
            <td class="text-center">
            <form action="{lien_action}" method="POST">
            <input type="hidden" name="id_personnel" value="{id_personnel}">
            <input type="hidden" name="action" value="reactivation">
            <button type="submit" class="text-danger">Reactiver</a>
            </form>
            </td>
            </tr>';


            $liste_personnel_classification_template = '<tr>
            <th><img src="{photo}" alt="photo" style="height: 46px; width: 46px; border-radius: 28px; border-style: solid; border-color: #7a00ff;"></th>
            <td class="text-center">{noms_personnel} {post_nom_personnel} {prenom_personnel}</td>
            <td class="text-center" style="display:none;">{telephone_personnel}</td>
            <td class="text-center" style="display:none;">{mail_personnel}</td>
            <td class="text-center">{fonction_personnel}</td>
            <td class="text-center" style="display:none;">
            <form style="display: block;" action="{lien_action}" method="POST"> 
            <input type="hidden" value={id_personnel}>

            <label for="normal">Accès normal</label>
            <input type="checkbox" id="normal" name="acces_normal" {checkstate_normal}> 

            <label for="comptes">Control des comptes</label>
            <input type="checkbox" id="comptes" name="acces_compte" {checkstate_comptes}> 
            
            <label for="finances">Control de la comptabilité</label>
            <input type="checkbox" id="finances" name="acces_finance" {checkstate_finances}> 

            <button type="submit">Enregister</button>
            </form> </a>
            </td>
            </tr>';




            foreach ($personel_actifs as $menuitem)
            {
              $liste_personnel .= $this
              ->parser
              ->parse_string($liste_personnel_template, $menuitem, true);
            }



            foreach ($personel_inactifs as $menuitem)
            {
              $liste_personnel_inactif .= $this
              ->parser
              ->parse_string($liste_personnel_inactif_template, $menuitem, true);
            }

            $liste_personnel_acces_normal="";  $liste_personnel_acces_normal_array=array();
            $liste_personnel_acces_users="";  $liste_personnel_acces_users_array=array();
            $liste_personnel_acces_finance=""; $liste_personnel_acces_finance_array=array();

            foreach ($personel_actifs as $key => $value) {
              

              if($personel_actifs[$key]['checkstate_normal']=='checked'){ array_push($liste_personnel_acces_normal_array, $personel_actifs[$key] );

              }

              if($personel_actifs[$key]['checkstate_finances']=='checked') array_push($liste_personnel_acces_finance_array, $personel_actifs[$key] );

              if($personel_actifs[$key]['checkstate_comptes']=='checked') array_push($liste_personnel_acces_users_array, $personel_actifs[$key] );

            }

            foreach ($liste_personnel_acces_normal_array as $key) {
              $liste_personnel_acces_normal.= $this
              ->parser
              ->parse_string($liste_personnel_classification_template, $key, true);
            }
            
            foreach ($liste_personnel_acces_finance_array as $key) {
              $liste_personnel_acces_finance.= $this
              ->parser
              ->parse_string($liste_personnel_classification_template, $key, true);
            }
            

            foreach ($liste_personnel_acces_users_array as $key) {
              $liste_personnel_acces_users.= $this
              ->parser
              ->parse_string($liste_personnel_classification_template, $key, true);
            }
            

            $data_liste = array(
              'title' => 'ujn-e-system',

              'username' => $user_permission['nom'],
              'email' => $user_permission['email'],
              'profile_image' => base_url($user_permission['profile_photo']) ,

              'logo' => base_url('favicon.png') ,

              
              'income' => $this->data_model->dashboard_utility()['entree_total'],
              
              'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
              
              'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
              
              'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
              
              'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
              
              'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
              
              'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
              
              'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],


              'menu' => $menu,
              'liste_personnel' => $liste_personnel,
              'liste_personnel_inactive' => $liste_personnel_inactif,
              'simple_access' => $liste_personnel_acces_normal,
              'control_finance' => $liste_personnel_acces_finance,
              'control_compte' => $liste_personnel_acces_users,
                #'liste_eleves_inactive' => $liste_eleves_inactive,
              'notification' => $notification 
            );

            $this
            ->parser
            ->parse('staff_control', $data_liste);

          }

          else
          {
            redirect("dashboard");
          }

        }

        public function ajouter_classe(){
          
          if(!logged_in()) redirect('auth/login');

          if($this->input->post()){
            
            foreach ($this->input->post() as $key => $value) {
              $this->data_model->add_class($value);
            }

            redirect("dashboard/ajouter_classe");
            
          }

          else{
           $classes_list=$this->data_model->get_class();

           $options="";

           $classes_list_template = '<span style="font-size:10px; padding:5px; padding-left:0px;margin-top:8px; display:inline-block;">{classe}, </span>';

           foreach ($classes_list as $key)
           {
            $options .= $this
            ->parser
            ->parse_string($classes_list_template, $key, true);
          }


          $data=array(
            'classes' => $options
          );

          $this->parser->parse('form_add_class',$data);
        }

      }

      public function modalities(){

        if(!logged_in()) redirect('auth/login');

        if(null !== $this->input->post()){

          
          $classes_list = $this->data_model->get_class();

          foreach ($classes_list as $key => $value) {
            
           /* 'action' => string 'config_mod' (length=10)
            '1ereA_minerval' => string '32$' (length=3)
            '1ereA_minerval_offset' => string '0$' (length=2)
            '1ereA_constr' => string '30$' (length=3)
            '1ereA_constr_offset' => string '0$' (length=2)
            '1ereA_biblio' => string '40$' (length=3)
            '1ereA_biblio_offset' => string '0$' (length=2)
            '1ereA_fonc' => string '40$' (length=3)
            '1ereA_trans_offset' => string '0$' (length=2)
            '1ereA_quantine' => string '3.4$' (length=4)
            '1ereA_quantine_offset' => string '0$' (length=2)
          1ereA
          */

          $classe_name=$value['classe'];
          $classe_minerval = floatval($this->input->post($classe_name."_minerval"));
          $classe_minerval_offset = floatval($this->input->post($classe_name."_minerval_offset"));

          $classe_constr = floatval($this->input->post($classe_name."_constr"));
          $classe_constr_offset = floatval($this->input->post($classe_name."_constr_offset"));

          $classe_biblio = floatval($this->input->post($classe_name."_biblio"));
          $classe_biblio_offset = floatval($this->input->post($classe_name."_biblio_offset"));

          $classe_quantine = floatval($this->input->post($classe_name."_quantine"));
          $classe_quantine_offset = floatval($this->input->post($classe_name."_quantine_offset"));

          $classe_trans = floatval($this->input->post($classe_name."_trans"));
          $classe_trans_offset = floatval($this->input->post($classe_name."_trans_offset"));

          $key=array("classe", "frais_scolaires", "frais_cantine", "frais_bibliotheque", "frais_transport", "frais_construction");

          $values_offset=array($classe_name,$classe_minerval_offset,$classe_quantine_offset, $classe_biblio_offset, $classe_trans_offset, $classe_constr_offset);

          $value = array($classe_name,$classe_minerval,$classe_quantine, $classe_biblio, $classe_trans, $classe_constr);


          $values_offset = array_combine($key, $values_offset);
          $value = array_combine($key, $value);

          $this->data_model->update_payment_offset($values_offset);
          $this->data_model->update_max_fees($value);

        }

        redirect ('dashboard/payment');

      }

      else{
        redirect('dashboard/payment');
      }
    }

    public function documentation(){

      if(!logged_in()) redirect('auth/login');

      $user_data = (array)user();

      $email = $user_data['email'];

      $user_permission = $this->data_model->getUserPermision($email);

      $data = array(
        'title' => 'ujn-e-system',

        'username' => $user_permission['nom'],
        'email' => $user_permission['email'],
        'profile_image' => base_url($user_permission['profile_photo']) ,

        'logo' => base_url('favicon.png') ,
        
        'income' => $this->data_model->dashboard_utility()['entree_total'],
        
        'income_today' => $this->data_model->dashboard_utility()['entree_aujourdhui'],
        
        'reguliers' => $this->data_model->dashboard_utility()['eleves_ponctuels'],
        
        'reguliers_agents' =>$this->data_model->dashboard_utility()['personel_ponctuels'],
        
        'inscrits' => $this->data_model->dashboard_utility()['eleves_inscrits'],
        
        'presents' => $this->data_model->dashboard_utility()['eleves_present_aujourdhui'],
        
        'rate_presents' => $this->data_model->dashboard_utility()['pourcent_present'].'%',
        
        'staff_number' => $this->data_model->dashboard_utility()['personel_enregistre'],

        'list_history' => $table_template,
        
        'script_chart' => $chart_template,
        
        'menu' => $menu
      );


      $this->parser->parse('docs',$data);
    }

  }

