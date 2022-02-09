<?php
class Data_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function get_action_logs_table()
        {     
               $query = $this->db->get('user_actionlogs');

                return $query->result_array();
        }

        public function add_class($nvlclasse){
                /*
                CREATE TABLE IF NOT EXISTS `payment_maxfee` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `classe` varchar(15) NOT NULL,
                  `frais_scolaires` varchar(15) NOT NULL,
                  `frais_fonctionnement` varchar(15) NOT NULL,
                  `frais_construction` varchar(15) NOT NULL,
                  `frais_bibliotheque` varchar(15) NOT NULL,
                  `frais_cantine` varchar(15) NOT NULL,
                  `frais_transport` varchar(15) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
                */

                $data=array(
                'classe' => $nvlclasse
                );

                $this->db->select('classe');
                $this->db->where(array('classe' => $nvlclasse));
                $this->db->from('payment_maxfee');
                $query=$this->db->count_all_results();
                
                if($query!=0){
                        return "la classe existe deja";
                }
                
                if($this->db->insert('payment_maxfee', $data)){

                	$this->db->insert('paymentmod',$data);
                        return true;
                }
                else{
                        return "La classe n'a pas ete ajoute verifier si elle n'existe pas deja";
                }
        }

        public function get_class(){


                $this->db->select('classe');
                $query = $this->db->from("payment_maxfee");
                $query = $this->db->get();
                $result=$query->result_array();
                $classes=array(); 
                foreach ($result as $key => $value) {
                        array_push($classes,$value);
                }

                return $classes;

        }

        public function get_attendance_perdayOfweek_eleves(){

        $lundi = strtotime("last monday");
        $lundi = date('w', $lundi)==date('w') ? $lundi+7*86400 : $lundi;
        $mardi = strtotime(date("Y-m-d",$lundi)." +1 days");
        $mercredi = strtotime(date("Y-m-d",$lundi)." +2 days");
        $jeudi  = strtotime(date("Y-m-d",$lundi)." +3 days");
        $vendredi =strtotime(date("Y-m-d",$lundi)." +4 days");
        $samedi =strtotime(date("Y-m-d",$lundi)." +5 days");

        $date_du_lundi=date("Y-m-d",$lundi);
        $date_du_mardi=date("Y-m-d",$mardi);
        $date_du_mercredi=date("Y-m-d",$mercredi);
        $date_du_jeudi=date("Y-m-d",$jeudi);
        $date_du_vendredi=date("Y-m-d",$vendredi);
        $date_du_samedi=date("Y-m-d",$samedi);

        $attendanceTotalNumber=array();

        $this->db->where('today_date', $date_du_lundi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results()); //lundi

        $this->db->where('today_date', $date_du_mardi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results()); //mardi...

        $this->db->where('today_date', $date_du_mercredi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_jeudi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_vendredi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_samedi);
        $this->db->from('student_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());

        return $attendanceTotalNumber;

        }

         public function get_attendance_perdayOfweek_staff(){

        $lundi = strtotime("last monday");
        $lundi = date('w', $lundi)==date('w') ? $lundi+7*86400 : $lundi;
        $mardi = strtotime(date("Y-m-d",$lundi)." +1 days");
        $mercredi = strtotime(date("Y-m-d",$lundi)." +2 days");
        $jeudi  = strtotime(date("Y-m-d",$lundi)." +3 days");
        $vendredi =strtotime(date("Y-m-d",$lundi)." +4 days");
        $samedi =strtotime(date("Y-m-d",$lundi)." +5 days");

        $date_du_lundi=date("Y-m-d",$lundi);
        $date_du_mardi=date("Y-m-d",$mardi);
        $date_du_mercredi=date("Y-m-d",$mercredi);
        $date_du_jeudi=date("Y-m-d",$jeudi);
        $date_du_vendredi=date("Y-m-d",$vendredi);
        $date_du_samedi=date("Y-m-d",$samedi);

        $attendanceTotalNumber=array();

        $this->db->where('today_date', $date_du_lundi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results()); //lundi

        $this->db->where('today_date', $date_du_mardi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results()); //mardi...

        $this->db->where('today_date', $date_du_mercredi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_jeudi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_vendredi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());


         $this->db->where('today_date', $date_du_samedi);
        $this->db->from('staff_attendance');

        array_push($attendanceTotalNumber,$this->db->count_all_results());

        return $attendanceTotalNumber;

        }

        public function dashboard_utility(){ //loading basic dashboard datas
        /*

            'income' => '569$ soit 447.000frc',
            'reguliers' => 239,
            'reguliers_agents' =>11,
            'rate_reguliers' => '75%',
            'inscrits' => 351,
            'presents' => 132,
            'rate_presents' => '61%',
            'staff_number' => 47, 
        */
          $money_dolla_today = $this->db->select_sum('montant_verse')->where('date',Date("F j, Y"))->get('payment_process')->result_array()[0]['montant_verse'];
          $dolla=$this->db->select_sum('montant_verse')->get('payment_process')->result_array()[0]['montant_verse'];
          $today_attendee = count($this->db->select_sum('numero_id')->where('today_date',date("Y-m-d"))->get('student_attendance')->result_array()[0]['numero_id']);
          $total_eleve = count($this->db->select_sum('numero_id')->get('ujnstudents')->result_array()[0]['numero_id']);
          $pourcent_present = round(floatval($today_attendee/$total_eleve)*100);
          $ponctuels_eleves=0;
          $atte_time_eleve = $this->db->select('presence_avant')->get('student_attendance')->result_array();

          if(null != $atte_time_eleve){
            foreach ($atte_time_eleve as $key => $value) {
              $tmp = explode(':', $atte_time_eleve[0]['presence_avant']);
              $hour = (int)$tmp[0];
              $minute = (int)$tmp[1];
              if($hour == 7 & $minute <= 20)
                $ponctuels_eleves++;
            }
          }

          $ponctuels_agents=0;

           $atte_time_personnel = $this->db->select('presence_avant')->get('staff_attendance')->result_array();
          
            if(null != $atte_time_personnel){
            foreach ($atte_time_personnel as $key => $value) {
              $tmp1 = explode(':', $value['presence_avant']);
              $hour1 = (int)$tmp1[0];
              $minute1 = (int)$tmp1[1];

              if($hour1 == 7 AND $minute1 <= 20)
                $ponctuels_agents++;
            }
          }

          $values=array(
            'eleves_inscrits' => count($this->db->select('numero_id')->get("ujnstudents")->result_array()),
            'personel_enregistre' => count($this->db->select('numero_id')->get("ujnagents")->result_array()),

            'eleves_ponctuels' => $ponctuels_eleves, //missing
            'personel_ponctuels' => $ponctuels_agents, //missing

            'entree_aujourdhui' => floatval($money_dolla_today)."$ soit ".(floatval($money_dolla_today )*2050)."fc",
            'entree_total' => floatval($dolla)."$ soit ".(floatval($dolla)*2050)."fc",
            'eleves_present_aujourdhui' => $today_attendee,

            'pourcent_present' => $pourcent_present
          );


          return $values;


        
        }

        public function checkout($processor,$data){ 
                /*
                

                 CREATE TABLE IF NOT EXISTS `payment_process` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `numero_id` int(14) NOT NULL,
                  `nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `postnom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `prenom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `classe` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `montant_verse` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `motif` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `dateheure` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `verse_par` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `receptionne_par` int(255) NOT NULL,
                  UNIQUE KEY `numero_id` (`numero_id`),
                  KEY `id` (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=1 ;
                        
                $data format array (size=18)
                  'slip_num_id' => string '3ePEDA-JOHN#5fe23403#263294246' (length=30)
                  'random' => string 'wmrzds0r' (length=8)
                  'student_fname' => string 'John' (length=4)
                  'nom_de_leleve' => string 'JOHN SANTOS JOSANTOSND20' (length=24)
                  'student_id' => string '263294246' (length=9)
                  'student_classe' => string '3ePEDA' (length=6)
                  'minerval' => string '' (length=0)
                  'construction' => string '' (length=0)
                  'bibliotheque' => string '9.3' (length=3)
                  'transport' => string '' (length=0)
                  'Quantine' => string '' (length=0)
                  'style' => string '...
                'author' => string 'John' (length=4)
                  'Fonction' => string 'Comptable' (length=9)
                  'date' => string '22 December  2020 , 19:59:31' (length=28)
                  'logo' => string 'http://localhost/ujn-e-system/favicon.png' (length=41)
                  'somme_total' => float 9.3
                  'copyright' => string '&copy; 2020 ujn-electronic-system, Group Supra Electronic' (length=57)
                        

                CREATE TABLE IF NOT EXISTS `students_payments` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `numero_id` varchar(14) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_scolaires` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_fonctionement` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_construction` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_bibliotheque` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_syllabus` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_cantine` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  `frais_transport` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
                  UNIQUE KEY `numero_id` (`numero_id`),
                  KEY `id` (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=2 ;
                 

                */

                $names=explode(" ", $data["nom_de_leleve"]);

                $slip_datas=array();
                $slip_datas["numero_id"]=$data["student_id"];
                $slip_datas["slip_id"]=$data["slip_num_id"];
                $slip_datas["nom"]=$names[0];
                $slip_datas["postnom"]=$names[1];
                $slip_datas["prenom"]=$names[2];
                $slip_datas["classe"]=$data["student_classe"];
                $slip_datas["montant_verse"]=$data["somme_total"];
                $motif="payment de frais:";
                $motif.=$data["minerval"]>0?"minerval ":"";
                $motif.=$data["construction"]>0?"construction ":"";
                $motif.=$data["bibliotheque"]>0?"bibliotheque ":"";
                $motif.=$data["transport"]>0?"transport ":"";
                $motif.=$data["Quantine"]>0?"Quantine":"";
                $slip_datas["motif"]=$motif;
                $slip_datas["dateheure"]=$data["date"];
                $slip_datas["verse_par"]="-";
                $slip_datas["receptionne_par"]=$processor;

                $logs=array(
                  'trans_id' => $data["slip_num_id"],
                  'username' => $processor,
                  'action' => $motif.'>>'.$data['somme_total'].'$'.' cash',
                  'dateheure' => $data['date']
                );

					if(!$this->db->insert('user_actionlogs',$logs)) return false;
                $slip_datas['date'] = Date("F j, Y");

                if(!$this->db->insert('payment_process',$slip_datas)) return false;

                $old_payment = $this->db->get_where('students_payments',array("numero_id" => $data["student_id"]))->result_array();

                $old_minerval = floatval($old_payment[0]["frais_scolaires"]);
                $old_construction =floatval( $old_payment[0]["frais_construction"]);
                $old_bibliotheque = floatval($old_payment[0]["frais_bibliotheque"]);
                $old_cantine = floatval($old_payment[0]["frais_cantine"]);
                $old_transport =floatval( $old_payment[0]["frais_transport"]);

                $new_minerval = $old_minerval+floatval($data["minerval"]);
                $new_construction = $old_construction+floatval($data["construction"]);
                $new_bibliotheque = $old_bibliotheque+floatval($data["bibliotheque"]);
                $new_cantine = $old_cantine+floatval($data["Quantine"]);
                $new_transport = $old_transport+floatval($data["transport"]);

                if(!$this->db->delete('students_payments', array('numero_id' => $data["student_id"]))) return true;

                $new_student_payment=array(
                'numero_id' => $data["student_id"],
                'frais_scolaires' => $new_minerval,
                'frais_construction' => $new_construction,
                'frais_bibliotheque' => $new_bibliotheque,
                'frais_cantine' => $new_cantine,
                'frais_transport' => $new_transport
                );

                $this->db->insert('students_payments',$new_student_payment);

                return true;
        }


       
        public function get_list_eleve(){

        		return $this->db->get('ujnstudents')->result_array();

        }

        public function get_list_eleve_active(){
        		return $this->db->get_where('ujnstudents',array('status' => 'active'))->result_array();
        }

        
        public function get_list_staff_with_state(){
        		
        		$rep = $this->db->get_where('ujnagents',array("normal_access" => "active"))->result_array();

        		/*
        		      'photo' => base_url('assets/images/faces/john%20santos.jpg') ,
                    'noms_personnel' => 'John',
                    'id_personnel' => '463844834',
                    'post_nom_personnel' => 'Santos',
                    'prenom_personnel' => 'josantosnd20',
                    'telephone_personnel' => '099133784',
                    'mail_personnel' => "josantosnd20@gmail.com",
                    'lien_action' => base_url("dashboard/editer/personel/24636784"),
                    'fonction_personnel' => 'Comptable',
                    'checkstate_normal' => 'checked', //this field should always be checked for all users having some access
                    'checkstate_comptes' => '',
                    'checkstate_finances' => 'checked',
                    'lien_action' => base_url("dashboard/access_control/staff_ecole"),
               */

             $formated=array();
             $final_list = array();

                 foreach ($rep as $key => $value) {
                 		$formated['photo'] =  base_url($value['photo']);
                 		$formated['noms_personnel'] =  $value['nom'];
                 		$formated['post_nom_personnel'] =  $value['post_nom'];
                 		$formated['prenom_personnel'] =  $value['prenom'];
                 		$formated['telephone_personnel'] =  $value['telephone'];
                 		$formated['mail_personnel'] =  $value['email'];
                 		$formated['lien_action'] =  base_url("dashboard/access_control/staff_ecole/");
                 		$formated['fonction_personnel'] = $value['fonction'];
                 		$formated['checkstate_normal'] = $value['normal_access'] =="active"?"checked":"";
                 		$formated['checkstate_comptes'] = $value['checkstate_comptes'] =="active"?"checked":"";
                 		$formated['checkstate_finances'] = $value['checkstate_finances'] =="active"?"checked":"";
                 		$formated['id_personnel'] = $value['numero_id'];
                 		array_push($final_list, $formated);
                 }
               return $final_list;
        }

        public function update_permission_agent($data){

        	$this->db->where(array('numero_id' => $data['numero_id']));
        	unset($data["numero_id"]);
        	
        	if($this->db->update('ujnagents' , $data))
        		return true;
        	else return false;

        }
          public function get_list_staff_with_state_inactives(){
        		
        		$rep = $this->db->get_where('ujnagents',array("normal_access" => "inactive"))->result_array();

        		/*
        		      'photo' => base_url('assets/images/faces/john%20santos.jpg') ,
                    'noms_personnel' => 'John',
                    'id_personnel' => '463844834',
                    'post_nom_personnel' => 'Santos',
                    'prenom_personnel' => 'josantosnd20',
                    'telephone_personnel' => '099133784',
                    'mail_personnel' => "josantosnd20@gmail.com",
                    'lien_action' => base_url("dashboard/editer/personel/24636784"),
                    'fonction_personnel' => 'Comptable',
                    'checkstate_normal' => 'checked', //this field should always be checked for all users having some access
                    'checkstate_comptes' => '',
                    'checkstate_finances' => 'checked',
                    'lien_action' => base_url("dashboard/access_control/staff_ecole"),
               */

             $formated=array();
             $final_list = array();

                 foreach ($rep as $key => $value) {
                 		$formated['photo'] =  base_url($value['photo']);
                 		$formated['noms_personnel'] =  $value['nom'];
                 		$formated['post_nom_personnel'] =  $value['post_nom'];
                 		$formated['prenom_personnel'] =  $value['prenom'];
                 		$formated['telephone_personnel'] =  $value['telephone'];
                 		$formated['mail_personnel'] =  $value['email'];
                 		$formated['lien_action'] =  base_url("dashboard/access_control/staff_ecole");
                 		$formated['fonction_personnel'] = $value['fonction'];
                 		$formated['checkstate_normal'] = $value['normal_access'] =="active"?"checked":"";
                 		$formated['checkstate_comptes'] = $value['checkstate_comptes'] =="active"?"checked":"";
                 		$formated['checkstate_finances'] = $value['checkstate_finances'] =="active"?"checked":"";
                 		$formated ['id_personnel'] = $value['numero_id'];
                 		array_push($final_list, $formated);
                 }

               return $final_list;
        }




        public function get_list_eleve_inactive(){
        	return $this->db->get_where('ujnstudents',array('status' => 'inactive'))->result_array();
        }

        public function activate($id){

        	$this->db->where(array("numero_id"=> $id));

        	if($this->db->update('ujnstudents', array('status' => 'active'))) return true;
        	else return false;
        }

        public function reactivation_agent($id){

        	$this->db->where(array("numero_id"=> $id));
        	if($this->db->update('ujnagents', array('normal_access' => 'active'))) return true;
        	else return false;
        }

		public function desactivate($id){
	 		$this->db->where(array("numero_id"=> $id));

        	if($this->db->update('ujnstudents', array('status' => 'inactive'))) return true;
        	else return false;

		}



       public function  get_list_eleve_with_payment()
       {

       	$array_student= $this->db->get('ujnstudents')->result_array();
       	$students_payments_list=array();
       	$eleves=array();
       	foreach ($array_student as $key => $value) {
       		$eleves = $value;
       		$classe = $value["classe"];
       		$student_id = $value["numero_id"];
       		$payments_ya_mwanafunzi = $this->db->get_where('students_payments',array('numero_id' => $student_id))->result_array();
       		$payment_ya_classe = $this->db->get_where('payment_maxfee',array('classe' => $classe))->result_array();

       		$new_ya_student=array();
       		
       		if(null == $payments_ya_mwanafunzi){
				 $keys=array(
				 	'numero_id',
				  'frais_scolaires_paid' ,
				  'frais_construction_paid' ,
				  'frais_bibliotheque_paid' ,
				  'frais_cantine_paid' ,
				  'frais_transport_paid');

				 $values = array('0','0','0','0','0','0');
				 $new_ya_student = array('0' => array_combine($keys, $values));

       		}
       		else{
       			$new_ya_student=array('0' => 
       				array(
						  'frais_scolaires_paid' => $payments_ya_mwanafunzi[0]['frais_scolaires'],
						  'frais_construction_paid' => $payments_ya_mwanafunzi[0]['frais_construction'] ,
						  'frais_bibliotheque_paid' => $payments_ya_mwanafunzi[0]['frais_bibliotheque'],
						  'frais_cantine_paid' => $payments_ya_mwanafunzi[0]['frais_cantine'] ,
						  'frais_transport_paid' => $payments_ya_mwanafunzi[0]['frais_transport']
						)
       			);
       		}
       		unset($payment_ya_classe[0]['id']);

       		$payment_ya_classe[0]['photo'] = base_url($eleves['photo_eleve']);
       		$payment_ya_classe[0]['lien_action'] = base_url("dashboard/editer/eleve/".$eleves['numero_id']);
       		$payment_ya_classe[0]['paiement']=base_url("borderaux");
       		$tmp = array_merge($eleves,$new_ya_student[0],$payment_ya_classe[0]);
       		array_push($students_payments_list, $tmp);
       	}
       		return $students_payments_list;  
        }

         public function get_list_staff(){

        		return $this->db->get('ujnagents')->result_array();

        }

        public function get_specific_eleve($user_rfid){

        	
        		 $this->db->select('numero_id');
                $this->db->where('numero_id',$user_rfid);
                $this->db->from('ujnstudents');
                $query=$this->db->count_all_results();
                
                if($query!=0){
                		$user=$this->db->get_where('ujnstudents',array('numero_id'=>$user_rfid))->result_array();
        					return $user;
                }
                else{
                	return false;
                }
                
        }

	       public function update_eleve($data){
				unset($data['old_photo']);
	       	unset($data['action']);

	       	$old_id=$data['old_numero_id'];
	       	$user=$this->db->get_where('ujnstudents', array('numero_id'=>$data['old_numero_id']))->result_array();
	       	$this->db->where(array('numero_id'=>$data['old_numero_id']));
	       	
	       	unset($data['old_numero_id']);

				if($this->db->update('ujnstudents', $data)){

					$this->db->where(array('numero_id'=> $old_id ));
					$this->db->update('students_payments', array('numero_id' => $data['numero_id']));

					$this->db->where(array('numero_id'=> $old_id ));
					$this->db->update('student_attendance', array('numero_id' => $data['numero_id']));

				}

				return true;

	       } 


        public function get_specific_staff($user_rfid){

        	
        		 $this->db->select('numero_id');
                $this->db->where('numero_id',$user_rfid);
                $this->db->from('ujnagents');
                $query=$this->db->count_all_results();
                
                if($query!=0){
                		$user=$this->db->get_where('ujnagents',array('numero_id'=>$user_rfid))->result_array();
        					return $user;
                }
                else{
                	return false;
                }
                
        }


            public function update_staff($data){

				unset($data['old_photo']);

	       	unset($data['action']);

	       	$user=$this->db->get_where('ujnagents',array('numero_id'=>$data['old_numero_id']))->result_array();

	       	$this->db->where(array('numero_id'=>$data['old_numero_id']));

	       	unset($data['old_numero_id']);
				$this->db->update('ujnagents', $data);
				return true;

	       } 


	       public function create_eleve($data){
				unset($data['action']);
				unset($data['old_numero_id']);

	       	$this->db->select('numero_id');
                $this->db->where(array('numero_id' => $data['numero_id']));
                $this->db->from('ujnstudents');

                if($this->db->count_all_results()!==0) return false; //user already 
                $this->db->insert('students_payments',array('numero_id' => $data['numero_id']));
                $this->db->insert('ujnstudents',$data);
	       }


	       public function create_staff($data){
				unset($data['action']);
				unset($data['old_numero_id']);
				
	       	$this->db->select('numero_id');
                $this->db->where(array('numero_id' => $data['numero_id']));
                $this->db->from('ujnagents');
                if($this->db->count_all_results()!==0) return false; //user already 
                $this->db->insert('ujnagents',$data);
                $this->authit->signup($data['email'], 'ujn'.$data['telephone']);
	       }

	       public function getAttendance_eleve(){

	       	 /*'photo_eleve' => base_url('assets/images/faces/john%20santos.jpg') ,
                'noms_eleve' => 'John',
                'post_nom_eleve' => 'Santos',
                'prenom_eleve' => 'josantosnd20',
                'classe' => '3ePEDA',
                'date' => '2020-11-23',
                'heure_arrive' => '07:22',
                'heure_sortie' => "13:38",
                'observation' => "en ordre"
                */

                $students = $this->db->get('student_attendance')->result_array();

                $tmp=array();

                $final_list=array();

                foreach ($students as $key => $value) {
                	$noms = explode(" ", $value['noms']);
                	$tmp['photo_eleve'] = base_url($value['photo']);
                	$tmp['noms_eleve'] = $noms[0];
                	$tmp['post_nom_eleve'] = $noms[1];
                	$tmp['prenom_eleve'] = $noms[2];
                	$tmp['classe'] = $value['classe'];
                	$tmp['heure_sortie'] = $value['presence_apres'];
                	$tmp['heure_arrive'] = $value['presence_avant'];
                	$tmp['date'] = $value['today_date'];
                	$tmp['observation'] = "-";
                	array_push($final_list, $tmp);
                }

                return $final_list;
	       }



	       public function getAttendance_staff(){

	       	$staff= $this->db->get('staff_attendance')->result_array();
                $tmp=array();
                $final_list=array();
               foreach ($staff as $key => $value) {
                	$noms = explode(" ", $value['noms']);
                	$tmp['photo'] = base_url($value['photo']);
                	$tmp['noms_personnel'] = $noms[0];
                	$tmp['post_nom_personnel'] = $noms[1];
                	$tmp['prenom_personnel'] = $noms[2];
                	$tmp['fonction'] = $value['fonction'];
                	$tmp['heure_sortie'] = $value['presence_apres'];
                	$tmp['heure_arrive'] = $value['presence_avant'];
                	$tmp['date'] = $value['today_date'];
                	$tmp['observation'] = "-";
                	array_push($final_list, $tmp);
                }
                return $final_list;
	       }


	       public function get_class_slice($class_name){
	       	return $this->db->get_where('paymentmod',array('classe' => $class_name))->result_array();
	       }


	       public function get_class_fees($class_name){
	       	return $this->db->get_where('payment_maxfee',array('classe' => $class_name))->result_array();
	       }

	       public function update_payment_offset($data){
	       	$this->db->where(array('classe' => $data['classe']));
	       	unset($data['classe']);
	       	$this->db->update('paymentmod', $data);
	       	return true;
	       }

	       public function update_max_fees($data){
	       	$this->db->where(array('classe'=>$data['classe']));
	       	unset($data['classe']);
	       	$this->db->update('payment_maxfee', $data);
	       	return true;
	       }

         public function getUserPermision($email){
           $response = $this->db->get_where('ujnagents', array('email' => $email))->result_array();
            
            $datatoSend=array(
              'nom' => $response[0]['nom'],
              'fonction' => $response[0]['fonction'],
              'normal_access' => $response[0]['normal_access'],
              'checkstate_comptes' => $response[0]['checkstate_comptes'],
              'checkstate_finances' => $response[0]['checkstate_finances'],
              'profile_photo' => $response[0]['photo'],
              'email' => $response[0]['email']
            );

            return $datatoSend;

         }
}
