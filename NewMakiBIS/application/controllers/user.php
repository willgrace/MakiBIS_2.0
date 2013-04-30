<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}
	
	function populate_images() {
		$this->load->view('populate_images');
	}


	function login(){
		$data["message"] = "";
		$this->load->view('v_login',$data);
	
	}
	
	
	
	function admin_login()
	{
		
		$this->form_validation->set_rules('username','Username','required|trim|max_length[50]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('password','Password','required|trim|max_length[50]|alpha_numeric|xss_clean');
		
		
			if ($this->form_validation->run() == FALSE)
			{
				$data["message"] = "*Username and Password do not match";
				$this->load->view('v_login',$data);
			}
			else{
			
				extract($_POST);
							
				$admin_id = $this->user_model->check_login($username,$password);
				
				if(! $admin_id){
				
					$user_id = $this->user_model->check_login_user($username,$password);
					
					if(!$user_id){
						$data["message"] = "*Username and Password do not match";
						$this->load->view('v_login',$data);
					}
					else{
						//logged in success.
						$this->session->set_userdata(array(
						'logged_in_user'=>TRUE,
						 user_id => $user_id
						 )); 
						//echo 'user login';	 
					//redirect('user/user_home');
					}
					

				}else{
					//logged in success.
					$this->session->set_userdata(array(
								'logged_in_admin'=>TRUE,
								 $admin_id => $admin_id
								 )); 
						//echo 'admin login';	 
					redirect('user/admin_home');
				}
			}
		
		
	}
	function admin_home(){
	
		$this->load->view('v_admin_home');
	
	}
	
	function signup_page()
	{
		//$this->load->helper(array('form', 'url'));
		$this->load->view('v_sign_up');
		//echo 'sign up';
	}
	
	function signup_validation(){
		
		$this->form_validation->set_rules('fname', 'Fname', 'required|trim|xss_clean');
		$this->form_validation->set_rules('mname', 'Mname', 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', 'Lname', 'required|trim|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirmpw]');
		$this->form_validation->set_rules('confirmpw', 'Confirm Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		
		$this->form_validation->set_message('required', ' *Required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('v_sign_up');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password = md5($password);
			$email = $this->input->post('email');
			$gender = $this->input->post('gender');
			$birthday = $this->input->post('month').'-'.$this->input->post('day').'-'.$this->input->post('year');
			$location = $this->input->post('location');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$lname = $this->input->post('lname');
			$role = $this->input->post('role');
			
			$this->user_model->add_user($username,$password,$email,$gender,$birthday,$location,$fname,$mname,$lname, $role );
			
		}
	}
	
	function logout()
	{
		/*
		 * this just destroy the session of admin.
		 * the commented line does the same thing.
		 * */
	//	$this->session->set_userdata('logged_in',FALSE);
		$this->session->sess_destroy();
	//	redirect('user/index');
		//$this->load->view('home');
		//$this->load->view('home');
		redirect(base_url());
	}
	
	function taxon_tree(){
		
		$this->load->view('v_taxon_tree');
	}
	function view_animalia(){
		$config = array();
		$config["base_url"] = 'http://localhost/NewMakiBIS/index.php/user/view_animalia';
		$config["total_rows"] = $this->user_model->kingdom_record_count('Animalia');
		
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
	   
		$this->pagination->initialize($config);
	   
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->user_model->fetch_kingdom($config["per_page"],$page,'Animalia');
		$data["links"] = $this->pagination->create_links();
	   
	   
		$this->load->view('v_animalia',$data);
	}
	function view_plantae(){
		$config = array();
		$config["base_url"] = 'http://localhost/NewMakiBIS/index.php/user/view_plantae';
		$config["total_rows"] = $this->user_model->kingdom_record_count('Plantae');
		
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
	   
		$this->pagination->initialize($config);
	   
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->user_model->fetch_kingdom($config["per_page"],$page,'Plantae');
		$data["links"] = $this->pagination->create_links();
	   
	   
		$this->load->view('v_plantae',$data);
	}
	function view_all_species()
	{
		$config = array();
		$config["base_url"] = 'http://localhost/NewMakiBIS/index.php/user/view_all_species';
		$config["total_rows"] = $this->user_model->count_all_species();
		
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
	   
		$this->pagination->initialize($config);
	   
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->user_model->get_query_species($config["per_page"],$page);
		$data["links"] = $this->pagination->create_links();
		$this->load->view('v_all_species',$data);
		
	}
	
	function view_all_reference(){
		$this->load->view('v_reference_list');
	}
	
	function species_profile($taxon_id){
		
		$data['title'] = "MakiBIS";
		
		$species_profile = $this->user_model->query_species_profile($taxon_id);
			$data['taxon_id']=$taxon_id;
		foreach ($species_profile->result() as $row ){
			//for the taxonomical classification
			$data['domain']=$row->domain;
			$data['kingdom']=$row->kingdom;
			$data['phylum']=$row->phylum;
			$data['class']=$row->class;
			$data['order_name']=$row->order_name;
			$data['family']=$row->family;
			$data['species']=$row->species;
			$data['genus']=$row->genus;
		
			$data['reference_id']= $row->reference_id;	
			$data['reference_code']=$row->reference_code;
			$data['reference_number']=$row->reference_number;
		}
		
		/* added by grace */
		$species_profile = $this->user_model->query_species_image($taxon_id);
		if($species_profile->result()==NULL){
			$species_image = 'images/default_image.jpg';
			$data['species_image'] = $species_image ;
			//$this->user_model->save_species_author($taxon_id, $species_image);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['species_image'] = $row->image_location;		
			}
		}
		/* --- */

		$reference_code = $data['reference_code'];
		$reference_number = $data['reference_number'];
		
		$species_profile = $this->user_model->query_species_author($taxon_id);
		if($species_profile->result()==NULL){
			$scientificname_author = 'no records found';
			$data['scientificname_author'] = $scientificname_author ;
			$this->user_model->save_species_author($taxon_id, $scientificname_author);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['scientificname_author'] = $row->scientificname_author;		
			}
		}
		
		$species_profile = $this->user_model->query_conservation_status($taxon_id);
		if($species_profile->result()==NULL){
		
			$conservation_status = 'no records found';
			$data['conservation_status'] = $conservation_status; 
			$this->user_model->save_conservation_status($taxon_id,$conservation_status);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['conservation_status'] = $row->status;		
			}
		}
		
		$species_profile = $this->user_model->query_description($taxon_id);
		if($species_profile->result()==NULL){
			$description = 'no records found';
			$data['description'] = $description;
			$this->user_model->save_description($taxon_id, $description, $reference_code, $reference_number);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['description'] = $row->description;		
			}
		}
		
		$species_profile = $this->user_model->query_encoder_information($taxon_id);
		if($species_profile->result()==NULL){
			$encoder_name = 'no records found';
			$date = 'no records found';
			$data['encoder_name'] = $encoder_name;
			$data['encoder_date']= $date;
			$this->user_model->save_encoder($taxon_id, $encoder_name,$date);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['encoder_name'] = $row->encoder_name;
				$data['encoder_date']=$row->encoder_date;
			}
		}
		
		$species_profile = $this->user_model->query_reproduction_mode($taxon_id);
		if($species_profile->result()==NULL){
			$reproduction_mode = 'no records found';
			$data['reproduction_mode'] = $reproduction_mode;
			$this->user_model->save_reproduction_mode($taxon_id, $reproduction_mode);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['reproduction_mode']=$row->mode;		
			}
		}
		
		$species_profile = $this->user_model->query_habitat($taxon_id);
		if($species_profile->result()==NULL){
			$habitat = 'no records found';
			$data['habitat'] = $habitat;	
			$this->user_model->save_habitat($taxon_id, $habitat);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['habitat'] = $row->habitat;		
			}
		}
		
		
		
		$vernacular_check = $this->user_model->check_vernacular($taxon_id);
		if($vernacular_check == true){
		$data['vernacular_check']=true;
		}else{
		$data['vernacular_check']=false;
		}
		
		$econuse_check = $this->user_model->check_econuse($taxon_id);
		if($econuse_check == true){
		$data['econuse_check']=true;
		}else{
		$data['econuse_check']=false;
		}
		
		$synonyms_check = $this->user_model->check_synonyms($taxon_id);
		if($synonyms_check == true){
		$data['synonyms_check']=true;
		}else{
		$data['synonyms_check']=false;
		}
		
		$this->load->view('v_species_profile', $data);
	}
	
	function view_references(){
    	$data['title'] = "MakiBIS";
    	
    	$data['reference_code'] = $this->uri->segment(3);
		$data['reference_number'] = $this->uri->segment(4);
			
		$this->load->view('v_species_reference',$data); 
    }
	
	function add_species(){
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add New Species";
			
		$data['reference_number'] = $this->uri->segment(3);
		$data['reference_code'] = $this->uri->segment(4);
		$data['existing'] = FALSE;
			
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->load->view('v_add_species', $data);
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_species(){
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add New Species";	
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			/*THIS ARE THE NOT REQUIRED FIELDS*/
			$this->form_validation->set_rules('subspecies','Subspecies','alpha_numeric|xss_clean');
			$this->form_validation->set_rules('subgenus','Subgenus','alpha_numeric|xss_clean');
			/*THIS ARE THE REQUIRED FIELDS*/
		
			$this->form_validation->set_rules('species','Species','required|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('genus','Genus', 'required|alpha_numeric|xss_clean');
		
			/*
			* NOTE:THIS WILL GET THE ENTERED DATA OF THE USER
			* */
			extract($_POST);
		
			/*NOTE: Dec.8,2011
			* make a function that will check the existence of both the paired genus and species aka. scientific name
			* Now. How will i do that
			* 
			* first: call backfunction will not work here since it only check the existence of the 
			* single field, species or genus.
			* second: if you do this, it will also be implemented in the other tables. without using 
			* the callback function since there is a "bug" using it.
			* */

			$existing = $this->user_model->check_scientificname($species, $genus);
		
			if($this->form_validation->run() == FALSE){
				$data['reference_number']=$reference_number;
				$data['reference_code'] = $reference_code;
				$data['existing'] = FALSE;
				$this->load->view('v_add_species', $data); 
		
			}
			else{
				/*NOTE: place here the code of the actual adding of the new species. the super juicy part...i think it is here somewhere.haiz.*/
				//	$data['subspecies'] = $subspecies;
				$data['species'] = $species;
				$data['genus'] = $genus;
				$data['reference_number']=$reference_number;
				$data['reference_code'] = $reference_code;
				$data['title'] = "MakiBIS";
				$data['heading'] = "Add New Species";
			
				if($existing){
					//echo "existing";
					/*there must be some kind of error message or error view*/
					$data['existing']=TRUE;
					$this->load->view('v_add_species',$data);
				}
				else{
					//Note: the scientific name is not existing. But we have to check if the genus is existing.
					$data['existing'] = FALSE;
					if($this->user_model->check_genus($genus)){
					/*Note: dec 11,2011
					* if genus is existing, get the other data needed eg. the other tables information then get all thier ID then
					* last to be added is the species with all the foreign id since it will not add if the foreign keys are not valid. 
					*/
						$genus_id = $this->user_model->get_genus($genus);
						$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
						/*Feb 9 2012
						* Get all the data from species -> domain
						*/
						$query_result = $this->user_model->query_family($genus_id);
						foreach ($query_result->result() as $row ){		
							$data['family'] = $row->family;
							$data['order_name'] = $row->order_name;
							$data['class'] = $row->class;
							$data['phylum'] = $row->phylum;
							$data['kingdom'] = $row->kingdom;
							$data['domain'] = $row->domain;					
						}	
						$this->load->view('v_biological_information',$data);
					}else{
						//echo 'genus not existing';
					
						$this->load->view('v_add_family', $data);
					}
				}
		
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function save_species7(){
		
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add New Species";
		
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			//$this->form_validation->set_rules('subspecies','Subspecies','alpha_numeric|xss_clean');
			$this->form_validation->set_rules('scientificname_author','Scientificname Author','require|xss_clean');
			$this->form_validation->set_rules('conservation_status','Conservation Status','required|xss_clean');
			$this->form_validation->set_rules('habitat','Habitat','required|xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('encoder_name','Encoder Name','required|xss_clean');
			$this->form_validation->set_rules('date','Date','required|xss_clean');
			$this->form_validation->set_rules('reproduction_mode','Reproduction Mode','required|xss_clean');
		
			extract($_POST);
				
			$data['species'] = $species;
			$data['genus'] = $genus;
			$data['family'] = $family;
			$data['order_name'] = $order_name;
			$data['class'] = $class;
			$data['phylum'] = $phylum;
			$data['kingdom'] = $kingdom;
			$data['domain'] = $domain;
			$data['taxon_id'] = $taxon_id;
				
			$data['reference_number'] =$reference_number;
			$data['reference_code'] = $reference_code;			
			$data['scientificname_author'] = $scientificname_author;							
			$data['conservation_status'] = $conservation_status;
			$data['habitat'] = $habitat;
			$data['description'] = $description;
			$data['encoder_name'] = $encoder_name;
			$data['encoder_date']=$date;
			$data['reproduction_mode']=$reproduction_mode;
				
			if($this->form_validation->run() == FALSE){

				$this->load->view('v_biological_information', $data); 
		
			}
			else{
 
				$this->user_model->save_species_author($taxon_id, $scientificname_author);
				$this->user_model->save_conservation_status($taxon_id,$conservation_status);
				$this->user_model->save_habitat($taxon_id, $habitat);
				$this->user_model->save_reproduction_mode($taxon_id, $reproduction_mode);
				$this->user_model->save_encoder($taxon_id, $encoder_name,$date);
				$this->user_model->save_description($taxon_id, $description, $reference_code, $reference_number);
				
				if($this->session->userdata('logged_in_user')){
					redirect('user/species_profile/'.$taxon_id);
				}
				else{
					redirect('user/species_profile_admin/'.$taxon_id);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function species_profile_admin($taxon_id){
		
		$data['title'] = "MakiBIS";
		//$data['heading'] = "Species Profile";
	
		$species_profile = $this->user_model->query_species_profile($taxon_id);
			$data['taxon_id']=$taxon_id;
		foreach ($species_profile->result() as $row ){
			
			$data['species']=$row->species;
			$data['genus']=$row->genus;
			//for the taxonomical classification
			$data['domain']=$row->domain;
			$data['kingdom']=$row->kingdom;
			$data['phylum']=$row->phylum;
			$data['class']=$row->class;
			$data['order_name']=$row->order_name;
			$data['family']=$row->family;
			//$data['subspecies']=$row->sub_species;
			
			$data['reference_id']= $row->reference_id;	
			$data['reference_code']=$row->reference_code;
			$data['reference_number']=$row->reference_number;
			
			/*$data['scientificname_author'] = $row->scientificname_author;		
			$data['conservation_status'] = $row->status;
			$data['habitat'] = $row->habitat;
			$data['description'] = $row->description;
			$data['encoder_name'] = $row->encoder_name;
			$data['encoder_date']=$row->encoder_date;
			$data['reproduction_mode']=$row->mode;
			$data['profile_image'] = $row->image_location;*/
		
		}
		
		$species_profile = $this->user_model->query_species_author($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['scientificname_author'] = $row->scientificname_author;		
		}
		$species_profile = $this->user_model->query_conservation_status($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['conservation_status'] = $row->status;		
		}
		$species_profile = $this->user_model->query_description($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['description'] = $row->description;		
		}
		$species_profile = $this->user_model->query_encoder_information($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['encoder_name'] = $row->encoder_name;
			$data['encoder_date']=$row->encoder_date;
		}
		$species_profile = $this->user_model->query_reproduction_mode($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['reproduction_mode']=$row->mode;		
		}
		$species_profile = $this->user_model->query_habitat($taxon_id);
		foreach ($species_profile->result() as $row ){
			$data['habitat'] = $row->habitat;		
		}
		
		$vernacular_check = $this->user_model->check_vernacular($taxon_id);
		if($vernacular_check == true){
		$data['vernacular_check']=true;
		}else{
		$data['vernacular_check']=false;
		}
		
		$econuse_check = $this->user_model->check_econuse($taxon_id);
		if($econuse_check == true){
		$data['econuse_check']=true;
		}else{
		$data['econuse_check']=false;
		}
		
		$synonyms_check = $this->user_model->check_synonyms($taxon_id);
		if($synonyms_check == true){
		$data['synonyms_check']=true;
		}else{
		$data['synonyms_check']=false;
		}

		/* added by grace */
		$species_profile = $this->user_model->query_species_image($taxon_id);
		if($species_profile->result()==NULL){
			$species_image = 'images/default_image.jpg';
			$data['species_image'] = $species_image ;
			//$this->user_model->save_species_author($taxon_id, $species_image);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['species_image'] = $row->image_location;		
			}
		}
		/* --- */

		$this->load->view('v_species_profile_admin', $data);
	}
	
	function vernacular_name(){
			
		if(extract($_POST) == NULL){
			$data['taxon_id'] = $this->uri->segment(3);
			$data['reference_number'] = $this->uri->segment(4);
			$data['reference_code'] = $this->uri->segment(5);			
		}else{
			extract($_POST);
			$data['taxon_id'] = $taxon_id;
			$data['reference_code'] = $reference_code;
			$data['reference_number'] = $reference_number;			
		}
		$this->load->view('v_add_vernacular',$data);
	}
	
	function vernacular_reference(){
		extract ($_POST);
		$data['taxon_id'] = $taxon_id;
		$data['reference_code'] = $reference_code;
		$data['reference_number'] = $reference_number;	
		
		$this->load->view('v_vernacular_reference', $data);	
	}
	
	function save_vernacular_name(){
		
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add Vernacular Names";
		
		$this->form_validation->set_rules('vernacular_name','Vernacular_name','required|xss_clean');
		
		extract($_POST);
				
				$data['taxon_id'] = $taxon_id;	
				$data['reference_number'] =$reference_number;
				$data['reference_code'] = $reference_code;									
				$data['vernacular_name'] = $vernacular_name;
		
		if($this->form_validation->run() == FALSE){

			$this->load->view('v_add_vernacular',$data);
		
		}else{
			
			$this->user_model->save_vernacular_name($taxon_id, $vernacular_name, $reference_code, $reference_number);
			
			redirect('user/species_profile_admin/'.$taxon_id);
				
		}
	
	}
	
	function economic_use(){
		
		if(extract($_POST) == NULL){
			$data['taxon_id'] = $this->uri->segment(3);
			$data['reference_number'] = $this->uri->segment(4);
			$data['reference_code'] = $this->uri->segment(5);			
		}else{
			extract($_POST);
			$data['taxon_id'] = $taxon_id;
			$data['reference_code'] = $reference_code;
			$data['reference_number'] = $reference_number;			
		}
				
		$this->load->view('v_add_economic_use',$data);
	}
	
	function econuse_reference(){
	
		extract ($_POST);
			
		$data['taxon_id'] = $taxon_id;
		$data['reference_code'] = $reference_code;
		$data['reference_number'] = $reference_number;	
		
		$this->load->view('v_econuse_reference', $data);	
	
	}
	
	function save_econuse(){
		
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add Economic Status";
		
		$this->form_validation->set_rules('economic_use','Economic Status','required|xss_clean');
		
		extract($_POST);
				
			$data['taxon_id'] = $taxon_id;	
			$data['reference_number'] =$reference_number;
			$data['reference_code'] = $reference_code;									
			$data['economic_use'] = $economic_use;
		
		if($this->form_validation->run() == FALSE){

			$this->load->view('v_add_economic_use',$data);
		
		}else{
			
			$this->user_model->save_economic_use($taxon_id, $economic_use, $reference_code, $reference_number);
			
			redirect('user/species_profile_admin/'.$taxon_id);
			
		}
	}
	
	function synonyms(){
		
		if(extract($_POST) == NULL){
			$data['taxon_id'] = $this->uri->segment(3);
			$data['reference_number'] = $this->uri->segment(4);
			$data['reference_code'] = $this->uri->segment(5);			
		}else{
			extract($_POST);
			$data['taxon_id'] = $taxon_id;
			$data['reference_code'] = $reference_code;
			$data['reference_number'] = $reference_number;			
		}	
		$this->load->view('v_add_synonyms',$data);
	}
	
	function synonyms_reference(){
	
		extract ($_POST);
			
		$data['taxon_id'] = $taxon_id;
		$data['reference_code'] = $reference_code;
		$data['reference_number'] = $reference_number;	
		
		$this->load->view('v_synonyms_reference', $data);	
	}
	
	function save_synonyms(){
		
		$data['title'] = "MakiBIS";
		$data['heading'] = "Add Economic Status";
		
		$this->form_validation->set_rules('synonyms','Synonyms','required|xss_clean');
		
		extract($_POST);
				
		$data['taxon_id'] = $taxon_id;	
		$data['reference_number'] =$reference_number;
		$data['reference_code'] = $reference_code;									
		$data['synonyms'] = $synonyms;
		
		if($this->form_validation->run() == FALSE){

			$this->load->view('v_add_synonyms',$data);
		
		}else{
			
			$this->user_model->save_synonyms($taxon_id, $synonyms, $reference_code, $reference_number);
			
			redirect('user/species_profile_admin/'.$taxon_id);				
		}
	
	}
	
	function admin_add_species()
	{
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->load->view('v_admin_add_species');
		}
		else{
			redirect(base_url());
		}
	}
	
	function search_references(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$flag = 'species';
			$this->form_validation->set_rules('author','Author','alpha|required|xss_clean');
			
			extract($_POST);
			
			$data['heading'] = "References Results";
			$data['author']=$author;
			$data['reference_type']=$reference_type;
    			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "References";
				$this->load->view('v_admin_add_species', $data);
			}
			else{
			
				redirect('user/search_results/'.$author.'/'.$reference_type.'/'.'0'.'/'.$flag);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function search_vernacular_references(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$flag = 'vernacular';
			$this->form_validation->set_rules('author','Author','alpha|required|xss_clean');
			
			extract($_POST);
			
			$data['heading'] = "References Results";
			$data['author']=$author;
			$data['reference_type']=$reference_type;
			$data['reference_code']=$reference_code;
			$data['reference_number']=$reference_number;
			$data['taxon_id']=$taxon_id;
    			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "References";
				$this->load->view('v_add_vernacular', $data);
			}
			else{
				redirect('user/search_results/'.$author.'/'.$reference_type.'/'.$taxon_id.'/'.$flag);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function search_econuse_references(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$flag = 'econuse';
			$this->form_validation->set_rules('author','Author','alpha|required|xss_clean');
			
			extract($_POST);
			
			$data['heading'] = "References Results";
			$data['author']=$author;
			$data['reference_type']=$reference_type;
			$data['reference_code']=$reference_code;
			$data['reference_number']=$reference_number;
			$data['taxon_id']=$taxon_id;
    			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "References";
				$this->load->view('v_add_economic_use', $data);
			}
			else{
				redirect('user/search_results/'.$author.'/'.$reference_type.'/'.$taxon_id.'/'.$flag);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function search_synonyms_references(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$flag = 'synonyms';
			$this->form_validation->set_rules('author','Author','alpha|required|xss_clean');
			
			extract($_POST);
			
			$data['heading'] = "References Results";
			$data['author']=$author;
			$data['reference_type']=$reference_type;
			$data['reference_code']=$reference_code;
			$data['reference_number']=$reference_number;
			$data['taxon_id']=$taxon_id;
    			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "References";
				$this->load->view('v_add_synonyms', $data);
			}
			else{
				redirect('user/search_results/'.$author.'/'.$reference_type.'/'.$taxon_id.'/'.$flag);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function search_results($author,$reference_type,$taxon_id,$flag){
    	if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			
				$config = array();
				$config["base_url"] = 'http://localhost/NewMakiBIS/index.php/user/search_results/'.$author.'/'.$reference_type.'/'.$taxon_id.'/'.$flag;
				$config["total_rows"] = $this->user_model->count_references_results($author,$reference_type);
		
				$config["per_page"] = 5;
				$config["uri_segment"] = 7;
	   
				$this->pagination->initialize($config);
	   
				$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
				$data["results"] = $this->user_model->get_references($config["per_page"],$page,$author,$reference_type);
				$data["links"] = $this->pagination->create_links();
				$data['author']=$author;
				$data['reference_type']=$reference_type;
				$data['taxon_id']=$taxon_id;
				$data['flag']=$flag;
				
				$this->load->view('v_reference_results',$data); 
			
		}else{
			redirect(base_url());
		}
    }
	
	function add_book(){
	
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('author[]','Author','required|xss_clean');
			$this->form_validation->set_rules('book_title','Book title','required|xss_clean');
			$this->form_validation->set_rules('publishing_house','Publishing House','required|xss_clean');
			$this->form_validation->set_rules('publishing_country','Publishing Country','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Book References";
				$this->load->view('v_admin_add_species');
			}else{
				$temp=$author[0];
				$i=1;
				if(count($author)>1){
				//more than 1 author
					while($i < count($author)){
						$temp = $temp.', '.$author[$i];
						$i++;
					}
				}
				$data['reference_number'] = $this->user_model->save_book_reference($temp,$year,$book_title,$publishing_house,$publishing_country);
				$data['reference_code'] = 'B';
				$data['existing']=FALSE;
				$this->load->view('v_add_species', $data);
			}
		
		}
		else{
			redirect(base_url());
		}
    }
	
	function add_other_book(){
	
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('author[]','Author','required|xss_clean');
			$this->form_validation->set_rules('book_title','Book title','required|xss_clean');
			$this->form_validation->set_rules('publishing_house','Publishing House','required|xss_clean');
			$this->form_validation->set_rules('publishing_country','Publishing Country','required|xss_clean');
		
			extract($_POST);
			
			$temp=$author[0];
			$i=1;
			if(count($author)>1){
			//more than 1 author
				while($i < count($author)){
					$temp = $temp.', '.$author[$i];
					$i++;
				}
			}
			$data['reference_number'] = $this->user_model->save_book_reference($temp,$year,$book_title,$publishing_house,$publishing_country);
			$data['reference_code'] = 'B';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;	
				
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Book References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}else{
				
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
			}
		
		}
		else{
			redirect(base_url());
		}
    }
	
	function add_book_chapter(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('chapter_author[]',' Chapter Author','required|xss_clean');
			$this->form_validation->set_rules('chapter_title','Chapter title','required|xss_clean');
			$this->form_validation->set_rules('book_title','Book title','required|xss_clean');
			$this->form_validation->set_rules('book_author[]','Book Author','required|xss_clean');
			$this->form_validation->set_rules('publishing_house','Publishing House','required|xss_clean');
			$this->form_validation->set_rules('publishing_country','Publishing Country','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Book Chapter References";
				$this->load->view('v_admin_add_species');
			}
			else{
				$temp=$chapter_author[0];
				$i=1;
				if(count($chapter_author)>1){
					//more than 1 author
					while($i < count($chapter_author)){
						$temp = $temp.', '.$chapter_author[$i];
						$i++;
					}
				}
				$temp2=$book_author[0];
				$j=1;
			
				if(count($book_author)>1){
					//more than 1 author
					while($j < count($book_author)){
						$temp2 = $temp2.', '.$book_author[$j];
						$j++;
					}
				}

				$data['reference_number'] = $this->user_model->save_book_chapter_reference($temp,$temp2,$year_book_chapter,$chapter_title,$book_title,$publishing_house,$publishing_country);
				$data['reference_code'] = 'BC';
				$data['existing']=FALSE;
				$this->load->view('v_add_species', $data);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_other_book_chapter(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('chapter_author[]',' Chapter Author','required|xss_clean');
			$this->form_validation->set_rules('chapter_title','Chapter title','required|xss_clean');
			$this->form_validation->set_rules('book_title','Book title','required|xss_clean');
			$this->form_validation->set_rules('book_author[]','Book Author','required|xss_clean');
			$this->form_validation->set_rules('publishing_house','Publishing House','required|xss_clean');
			$this->form_validation->set_rules('publishing_country','Publishing Country','required|xss_clean');
		
			extract($_POST);
			
			$temp=$chapter_author[0];
			$i=1;
			if(count($chapter_author)>1){
				//more than 1 author
				while($i < count($chapter_author)){
					$temp = $temp.', '.$chapter_author[$i];
					$i++;
				}
			}
			$temp2=$book_author[0];
			$j=1;		
			if(count($book_author)>1){
				//more than 1 author
				while($j < count($book_author)){
					$temp2 = $temp2.', '.$book_author[$j];
					$j++;
				}
			}

			$data['reference_number'] = $this->user_model->save_book_chapter_reference($temp,$temp2,$year_book_chapter,$chapter_title,$book_title,$publishing_house,$publishing_country);
			$data['reference_code'] = 'BC';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;
			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Book Chapter References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}
			else{
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_journal(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('journal_author[]',' Journal Author','required|xss_clean');
			$this->form_validation->set_rules('article_title','Article title','required|xss_clean');
			$this->form_validation->set_rules('journal','Journal title','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Journal References";
				$this->load->view('v_admin_add_species');
			}
			else{
				$temp=$journal_author[0];
				$i=1;
				if(count($journal_author)>1){
					//more than 1 author
					while($i < count($journal_author)){
						$temp = $temp.', '.$journal_author[$i];
						$i++;
					}
				}
			
				$data['reference_number'] = $this->user_model->save_journal_reference($temp,$year_journal,$article_title,$journal);
				$data['reference_code'] = 'JA';
				$data['existing']=FALSE;
		
				$this->load->view('v_add_species', $data);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_other_journal(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('journal_author[]',' Journal Author','required|xss_clean');
			$this->form_validation->set_rules('article_title','Article title','required|xss_clean');
			$this->form_validation->set_rules('journal','Journal title','required|xss_clean');
		
			extract($_POST);
			
			$temp=$journal_author[0];
			$i=1;
			if(count($journal_author)>1){
				//more than 1 author
				while($i < count($journal_author)){
					$temp = $temp.', '.$journal_author[$i];
					$i++;
				}
			}
			
			$data['reference_number'] = $this->user_model->save_journal_reference($temp,$year_journal,$article_title,$journal);
			$data['reference_code'] = 'JA';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;
			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Journal References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}
			else{
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
					
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_thesis(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('thesis_author[]','Thesis Author','required|xss_clean');
			$this->form_validation->set_rules('thesis_title','Thesis title','required|xss_clean');
			$this->form_validation->set_rules('manuscript_type','Manuscript type','required|xss_clean');
			$this->form_validation->set_rules('manuscript_location','Manuscript location','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Thesis References";
				$this->load->view('v_admin_add_species');
			}
			else{
				$temp=$thesis_author[0];
				$i=1;
				if(count($thesis_author)>1){
					//more than 1 author
					while($i < count($thesis_author)){
						$temp = $temp.', '.$thesis_author[$i];
						$i++;
					}
				}
			
				$data['reference_number'] = $this->user_model->save_thesis_reference($temp,$year_thesis,$thesis_title,$manuscript_type,$manuscript_location);
				$data['reference_code'] = 'TR';
				$data['existing']=FALSE;
		
				$this->load->view('v_add_species', $data);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_other_thesis(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('thesis_author[]','Thesis Author','required|xss_clean');
			$this->form_validation->set_rules('thesis_title','Thesis title','required|xss_clean');
			$this->form_validation->set_rules('manuscript_type','Manuscript type','required|xss_clean');
			$this->form_validation->set_rules('manuscript_location','Manuscript location','required|xss_clean');
		
			extract($_POST);
			
			$temp=$thesis_author[0];
			$i=1;
			if(count($thesis_author)>1){
				//more than 1 author
				while($i < count($thesis_author)){
					$temp = $temp.', '.$thesis_author[$i];
					$i++;
				}
			}
			
			$data['reference_number'] = $this->user_model->save_thesis_reference($temp,$year_thesis,$thesis_title,$manuscript_type,$manuscript_location);
			$data['reference_code'] = 'TR';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;
			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Thesis References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}
			else{
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_proceedings(){
    	if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('proceedings_author[]','Proceedings Author','required|xss_clean');
			$this->form_validation->set_rules('day','Day','required|xss_clean');
			$this->form_validation->set_rules('topic_title','Topic Title','required|xss_clean');
			$this->form_validation->set_rules('symposium','Symposium/Seminar','required|xss_clean');
			$this->form_validation->set_rules('venue','Venue','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Proceedings References";
				$this->load->view('v_admin_add_species');
			}
			else{
				$temp=$proceedings_author[0];
				$i=1;
				if(count($proceedings_author)>1){
					//more than 1 author
					while($i < count($proceedings_author)){
					$temp = $temp.', '.$proceedings_author[$i];
					$i++;
					}
				}

				$data['reference_number'] = $this->user_model->save_proceedings_reference($temp,$day,$month,$year_proceedings,$topic_title,$symposium,$venue);
				$data['reference_code'] = 'PR';
				$data['existing']=FALSE;
		
				$this->load->view('v_add_species', $data);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_other_proceedings(){
    	if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('proceedings_author[]','Proceedings Author','required|xss_clean');
			$this->form_validation->set_rules('day','Day','required|xss_clean');
			$this->form_validation->set_rules('topic_title','Topic Title','required|xss_clean');
			$this->form_validation->set_rules('symposium','Symposium/Seminar','required|xss_clean');
			$this->form_validation->set_rules('venue','Venue','required|xss_clean');
		
			extract($_POST);
		
			$temp=$proceedings_author[0];
			$i=1;
			if(count($proceedings_author)>1){
				//more than 1 author
				while($i < count($proceedings_author)){
				$temp = $temp.', '.$proceedings_author[$i];
				$i++;
				}
			}

			$data['reference_number'] = $this->user_model->save_proceedings_reference($temp,$day,$month,$year_proceedings,$topic_title,$symposium,$venue);
			$data['reference_code'] = 'PR';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Proceedings References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}
			else{
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_project_report(){
    	if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('project_report_author[]','Project Report Author','required|xss_clean');
			$this->form_validation->set_rules('project_title','Project Title','required|xss_clean');
			$this->form_validation->set_rules('institution','Institution','required|xss_clean');
			$this->form_validation->set_rules('department','Department','required|xss_clean');
			$this->form_validation->set_rules('funding_agency','Funding Agency','required|xss_clean');
		
			extract($_POST);
		
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Project Report References";
				$this->load->view('v_admin_add_species');
			}
			else{
				$temp=$project_report_author[0];
				$i=1;
				if(count($project_report_author)>1){
					//more than 1 author
					while($i < count($project_report_author)){
						$temp = $temp.', '.$project_report_author[$i];
						$i++;
					}
				}
				$year = $year1.'-'.$year2;

				$data['reference_number'] = $this->user_model->save_project_report_reference($temp,$year,$project_title,$institution,$department,$funding_agency);
				$data['reference_code'] = 'PRR';
				$data['existing']=FALSE;
		
				$this->load->view('v_add_species', $data);
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function add_other_project_report(){
    	if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$this->form_validation->set_rules('project_report_author[]','Project Report Author','required|xss_clean');
			$this->form_validation->set_rules('project_title','Project Title','required|xss_clean');
			$this->form_validation->set_rules('institution','Institution','required|xss_clean');
			$this->form_validation->set_rules('department','Department','required|xss_clean');
			$this->form_validation->set_rules('funding_agency','Funding Agency','required|xss_clean');
		
			extract($_POST);
			
			$temp=$project_report_author[0];
			$i=1;
			if(count($project_report_author)>1){
				//more than 1 author
				while($i < count($project_report_author)){
					$temp = $temp.', '.$project_report_author[$i];
					$i++;
				}
			}
			$year = $year1.'-'.$year2;

			$data['reference_number'] = $this->user_model->save_project_report_reference($temp,$year,$project_title,$institution,$department,$funding_agency);
			$data['reference_code'] = 'PRR';
			$data['existing']=FALSE;
			$data['taxon_id']=$taxon_id;
			
			if($this->form_validation->run() == FALSE){
				$data['heading'] = "Add Project Report References";
				if($flag=='vernacular'){
					$this->load->view('v_vernacular_reference', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_econuse_reference', $data);
				}
				else{
					$this->load->view('v_synonyms_reference', $data);
				}
			}
			else{
				if($flag=='vernacular'){
					$this->load->view('v_add_vernacular', $data);
				}
				else if($flag=='econuse'){
					$this->load->view('v_add_economic_use', $data);
				}
				else{
					$this->load->view('v_add_synonyms', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_family(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
		
			$this->form_validation->set_rules('family','Family','required|alpha_numeric|xss_clean|callback_family_not_exist');

			extract($_POST);
		    
			$data['species'] = $species;
			$data['genus'] = $genus;
			$data['family'] = $family;
			$data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code;		   
			
			if($this->form_validation->run() == FALSE){

				$this->load->view('v_add_family', $data); 
		
			}else{	
				if($this->user_model->check_family($family)){	//family is existing
				
					$family_id = $this->user_model->get_family($family);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){		
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;						
					}
					
					$this->load->view('v_biological_information',$data);
				}else{ //family is not existing
					
					$this->load->view('v_add_order', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_order(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
			
			$this->form_validation->set_rules('order_name','Order','required|alpha_numeric|xss_clean|callback_order_not_exist');
		
			extract($_POST);

		    $data['species'] = $species;
		    $data['genus'] = $genus;
		    $data['family'] = $family;
		    $data['order_name'] = $order_name;
			$data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code;		   
		
			if($this->form_validation->run() == FALSE){
			
				$this->load->view('v_add_order', $data); 
		
			}else{
				if($this->user_model->check_order($order_name)){ //order is existing
				
					$order_id = $this->user_model->get_order($order_name);
					$family_id = $this->user_model->save_family($family,$order_id);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){
								
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;					
					}
					
					$this->load->view('v_biological_information',$data);
				}
				else{
					//order not existing
					$this->load->view('v_add_class', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_class(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
		
			$this->form_validation->set_rules('class','Class','required|alpha_numeric|xss_clean|callback_class_not_exist');
		
			extract($_POST);

		    $data['species']=$species;
		    $data['genus'] = $genus;
		    $data['family'] = $family;
		    $data['order_name'] = $order_name;
		    $data['class'] = $class;
			$data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code;		   
			
			if($this->form_validation->run() == FALSE){
			
				$this->load->view('v_add_class', $data); 
		
			}
			else{
				if($this->user_model->check_class($class)){ //class existing
					
					$class_id = $this->user_model->get_class($class);
					$order_id = $this->user_model->save_order($order_name, $class_id);
					$family_id = $this->user_model->save_family($family,$order_id);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){
								
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;					
					}
					
					$this->load->view('v_biological_information',$data);
				}
				else{  //class not existing
					
					$this->load->view('v_add_phylum', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_phylum(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
		
			$this->form_validation->set_rules('phylum','Phylum','required|alpha_numeric|xss_clean|callback_phylum_not_exist');
		
			extract($_POST);
		   
		    $data['species']=$species;
		    $data['genus'] = $genus;
		    $data['family'] = $family;
		    $data['order_name'] = $order_name;
		    $data['class'] = $class;
		    $data['phylum'] = $phylum;
		    $data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code;
		   
			if($this->form_validation->run() == FALSE){
			
				$this->load->view('v_add_phylum', $data); 
		
			}
			else{
				if($this->user_model->check_phylum($phylum)){ //phylum existing
						
					$phylum_id = $this->user_model->get_phylum($phylum);
					$class_id = $this->user_model->save_class($class, $phylum_id);
					$order_id = $this->user_model->save_order($order_name, $class_id);
					$family_id = $this->user_model->save_family($family,$order_id);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){
								
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;					
					}
						
					$this->load->view('v_biological_information',$data);
				
				}
				else{ //phylum not existing
						
					$this->load->view('v_add_kingdom', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_kingdom(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
	
			$this->form_validation->set_rules('kingdom','Kingdom','required|alpha_numeric|xss_clean|callback_kingdom_not_exist');
		
			extract($_POST);
		
		    $data['species']=$species;
		    $data['genus'] = $genus;
		    $data['family'] = $family;
		    $data['order_name'] = $order_name;
		    $data['class'] = $class;
		    $data['phylum'] = $phylum;
		    $data['kingdom'] = $kingdom;
			$data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code;		   
			
			if($this->form_validation->run() == FALSE){
			
				$this->load->view('v_add_kingdom', $data); 
		
			}
			else{
				if($this->user_model->check_kingdom($kingdom)){ //kingdom existing
						
					$kingdom_id = $this->user_model->get_kingdom($kingdom);		
					$phylum_id = $this->user_model->save_phylum($phylum, $kingdom_id);
					$class_id = $this->user_model->save_class($class, $phylum_id);
					$order_id = $this->user_model->save_order($order_name, $class_id);
					$family_id = $this->user_model->save_family($family,$order_id);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){
								
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;
										
					}

					$this->load->view('v_biological_information',$data);
				}
				else{ //kingdom not existing
						
					$this->load->view('v_add_domain', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function submit_domain(){
		if($this->session->userdata('logged_in_user')||$this->session->userdata('logged_in_admin')){
		
			$data['title'] = "MakiBIS";
			$data['heading'] = "Add New Species";
		
			$this->form_validation->set_rules('domain','Domain','required|alpha_numeric|xss_clean|callback_domain_not_exist');
		
			extract($_POST);
		
		    $data['species']=$species;
		    $data['genus'] = $genus;
		    $data['family'] = $family;
		    $data['order_name'] = $order_name;
		    $data['class'] = $class;
		    $data['phylum'] = $phylum;
		    $data['kingdom'] = $kingdom;
		    $data['domain'] = $domain;
			$data['reference_number']=$reference_number;
			$data['reference_code'] = $reference_code; 
			
			if($this->form_validation->run() == FALSE){
			
				$this->load->view('v_add_domain', $data); 
		
			}
			else{
				if($this->user_model->check_domain($domain)){ //domain existing
						
					$domain_id = $this->user_model->get_domain($domain);					
					$kingdom_id = $this->user_model->save_kingdom($kingdom, $domain_id);		
					$phylum_id = $this->user_model->save_phylum($phylum, $kingdom_id);
					$class_id = $this->user_model->save_class($class, $phylum_id);
					$order_id = $this->user_model->save_order($order_name, $class_id);
					$family_id = $this->user_model->save_family($family,$order_id);
					$genus_id = $this->user_model->save_genus($genus,$family_id);
					
					$data['taxon_id'] = $this->user_model->save_species($genus_id,$species,$reference_number,$reference_code);
					
					$query_result = $this->user_model->query_family($genus_id);
					
					foreach ($query_result->result() as $row ){
								
						$data['family'] = $row->family;
						$data['order_name'] = $row->order_name;
						$data['class'] = $row->class;
						$data['phylum'] = $row->phylum;
						$data['kingdom'] = $row->kingdom;
						$data['domain'] = $row->domain;
										
					}
												
					$this->load->view('v_biological_information',$data);
				}
				else{
					echo $domain.  ' domain not existing';
						
					$this->load->view('v_add_domain', $data);
				}
			}
		}
		else{
			redirect(base_url());
		}
	}
	
	function edit_profile($taxon_id){
		$data['error'] ='';

		$species_profile = $this->user_model->query_species_profile($taxon_id);
			
		foreach ($species_profile->result() as $row ){
			//for the taxonomical classification
			$data['taxon_id']= $taxon_id; 
			$data['domain']=$row->domain;
			$data['domain_id']=$row->domain_id;
			$data['kingdom']=$row->kingdom;
			$data['kingdom_id']=$row->kingdom_id;
			$data['phylum']=$row->phylum;
			$data['phylum_id']=$row->phylum_id;
			$data['class']=$row->class;
			$data['class_id']=$row->class_id;
			$data['order_name']=$row->order_name;
			$data['order_id']=$row->order_id;
			$data['family']=$row->family;
			$data['family_id']=$row->family_id;
			$data['species']=$row->species;
			$data['genus']=$row->genus;
			$data['subspecies']=$row->sub_species;
			//for the basic information
			

			$data['reference_id']= $row->reference_id;	
			$data['reference_code']=$row->reference_code;
			$data['reference_number']=$row->reference_number;
			
			//$data['vernacular_name'] = $row->vernacular_name;
			//$data['synonyms'] = $row->synonym_name;
			//$data['economic_use'] = $row->economic_use;
			//$data['profile_image'] = $row->species_image;
			//$data['profile_image'] = 'uploads/thumbs/'.$row->taxon_id. '.jpg';
		}
		
		/* added by grace */
		$species_profile = $this->user_model->query_species_image($taxon_id);
		if($species_profile->result()==NULL){
			$species_image = 'images/default_image.jpg';
			$data['species_image'] = $species_image ;
			//$this->user_model->save_species_author($taxon_id, $species_image);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['species_image'] = $row->image_location;		
			}
		}
		/* --- */


		$reference_code = $data['reference_code'];
		$reference_number = $data['reference_number'];
		
		$species_profile = $this->user_model->query_species_author($taxon_id);
		if($species_profile->result()==NULL){
			$scientificname_author = 'no records found';
			$data['scientificname_author'] = $scientificname_author;
			$this->user_model->save_species_author($taxon_id, $scientificname_author);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['scientificname_author'] = $row->scientificname_author;		
			}
		}
		
		$species_profile = $this->user_model->query_conservation_status($taxon_id);
		if($species_profile->result()==NULL){
			$conservation_status = 'no records found';
			$data['conservation_status'] = $conservation_status; 
			$this->user_model->save_conservation_status($taxon_id,$conservation_status);			
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['conservation_status'] = $row->status;		
			}
		}
		
		$species_profile = $this->user_model->query_description($taxon_id);
		if($species_profile->result()==NULL){
			$description = 'no records found';
			$data['description'] = $description;
			$this->user_model->save_description($taxon_id, $description, $reference_code, $reference_number);			
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['description'] = $row->description;		
			}
		}
		
		$species_profile = $this->user_model->query_encoder_information($taxon_id);
		if($species_profile->result()==NULL){
			$encoder_name = 'no records found';
			$date = 'no records found';
			$data['encoder_name'] = $encoder_name;
			$data['encoder_date']= $date;
			$this->user_model->save_encoder($taxon_id, $encoder_name,$date);
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['encoder_name'] = $row->encoder_name;
				$data['encoder_date']=$row->encoder_date;
			}
		}
		
		$species_profile = $this->user_model->query_reproduction_mode($taxon_id);
		if($species_profile->result()==NULL){
			$reproduction_mode = 'no records found';
			$data['reproduction_mode'] = $reproduction_mode;
			$this->user_model->save_reproduction_mode($taxon_id, $reproduction_mode);		
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['reproduction_mode']=$row->mode;		
			}
		}
		
		$species_profile = $this->user_model->query_habitat($taxon_id);
		if($species_profile->result()==NULL){
			$habitat = 'no records found';
			$data['habitat'] = $habitat;	
			$this->user_model->save_habitat($taxon_id, $habitat);	
		}
		else{
			foreach ($species_profile->result() as $row ){
				$data['habitat'] = $row->habitat;		
			}
		}
		
		$this->load->view('v_edit_profile', $data);
	}
	
	/* GRACE */
	function do_upload()
	{
		$config['upload_path'] = './images/species'; //'./uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		//$this->upload->do_upload();
			
		$taxon_id = $this->uri->segment(3);
		/* extract the species and genus to be used in formating image name */
		$species_profile = $this->user_model->query_species_profile($taxon_id);
			
			foreach ($species_profile->result() as $row ){
				$data['taxon_id']=$row->taxon_id;
				$data['species']=$row->species;
				$data['genus']=$row->genus;
			}
			$image_exist = $this->user_model->check_image($taxon_id); // returns TRUE if image exists
			
	
		$image_name = $data['genus'].'_'.$data['species'];
	
		$config['file_name'] = $image_name;
		
		$this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$image_data = $this->upload->data();
			$image_path = 'images/species/'.$data['genus'].'_'.$data['species'].$image_data['file_ext'];
			
			if($image_exist)
				$this->user_model->update_image($image_path, $taxon_id);
			else
				$this->user_model->upload_image($image_path, $taxon_id);
			redirect('user/edit_profile/'.$taxon_id);
		}
	}
	/* ---------- */


	function update_species(){
		$data['title'] = "MakiBIS";
		$data['heading'] = "Welcome to MakiBIS Admin";
		
		$this->form_validation->set_rules('domain','Domain','required|xss_clean');
		$this->form_validation->set_rules('kingdom','Kingdom','required|xss_clean');
		$this->form_validation->set_rules('phylum','Phylum','required|xss_clean');
		$this->form_validation->set_rules('class','Class','required|xss_clean');
		$this->form_validation->set_rules('order_name','Order','required|xss_clean');
		$this->form_validation->set_rules('family','Family','required|xss_clean');
		$this->form_validation->set_rules('scientificname_author','Scientificname Author','required|xss_clean');
		//$this->form_validation->set_rules('vernacular_name','Vernacular_name','required|xss_clean');
		//$this->form_validation->set_rules('synonyms','Synonyms','required|xss_clean');
		$this->form_validation->set_rules('conservation_status','Conservation Status','required|xss_clean');
		$this->form_validation->set_rules('habitat','Habitat','required|xss_clean');
		$this->form_validation->set_rules('description','Description','required|xss_clean');
		//$this->form_validation->set_rules('economic_use','Economic Use','required|xss_clean');
		$this->form_validation->set_rules('edited_by','Edited By','required|xss_clean');
		$this->form_validation->set_rules('date','Date','required|xss_clean');
		$this->form_validation->set_rules('reproduction_mode','Reproduction Mode','required|xss_clean');
	//	$this->form_validation->set_rules('encoder_name','Encoder Name','required|xss_clean');
	//	$this->form_validation->set_rules('encoder_date','Encoder Date','required|xss_clean'); 
		
			extract($_POST);
			$data['taxon_id'] = $taxon_id;
			//$data['subspecies'] = $subspecies;
			$data['species'] = $species;
		    $data['genus'] = $genus;
			$data['family'] = $family;
			$data['family_id'] = $family_id;
			$data['order_name'] = $order_name;
			$data['order_id'] = $order_id;
			$data['class'] = $class;
			$data['class_id'] = $class_id;
			$data['phylum'] = $phylum;
			$data['phylum_id'] = $phylum_id;
			$data['kingdom'] = $kingdom;
			$data['kingdom_id'] = $kingdom_id;
			$data['domain'] = $domain;
			$data['domain_id'] = $domain_id;
			
			$data['reference_number'] =$reference_number;
			$data['reference_code'] = $reference_code;			
			$data['scientificname_author'] = $scientificname_author;							
			//$data['vernacular_name'] = $vernacular_name;
			//$data['synonyms'] = $synonyms;
			$data['conservation_status'] = $conservation_status;
			$data['habitat'] = $habitat;
			$data['description'] = $description;
			//$data['economic_use'] = $economic_use;
			$data['edited_by'] = $edited_by;
			$data['date']=$date;
		 	$data['reproduction_mode']=$reproduction_mode;
		 	
		 	//$data['profile_image'] = 'uploads/thumbs/'.$taxon_id. '.jpg';
			/* added by grace */
				$species_profile = $this->user_model->query_species_image($taxon_id);
				if($species_profile->result()==NULL){
					$species_image = 'images/default_image.jpg';
					$data['species_image'] = $species_image ;
					//$this->user_model->save_species_author($taxon_id, $species_image);
				}
				else{
					foreach ($species_profile->result() as $row ){
						$data['species_image'] = $row->image_location;		
					}
				}
			/* --- */
			
			
		if($this->form_validation->run() == FALSE){
			
			$this->load->view('v_edit_profile', $data); 
		
		}else{
					//echo 'must update every table except the taxonomical information';
			
		$success = $this->user_model->update_profile( $taxon_id,$domain,$domain_id,$kingdom,$kingdom_id,$phylum,$phylum_id,$class,$class_id,$order_name,$order_id,$family,$family_id,$reference_number,$reference_code,$scientificname_author,$conservation_status,$habitat,$description,$reproduction_mode,
											$edited_by,$date);
											
								
		redirect('user/species_profile_admin/'.$taxon_id);
		
		}
	
	}
	
	function update_image() {
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		//$config['max_size'] = '100';
		//$config['max_width'] = '1024';
		//$config['max_height'] = '768';

		$this->upload->initialize($config);

		$this->load->view('test');

		/*if(!$this->user->update_image()) {
			$error = array('error'=> $this->user->dislay_errors());
			
		}
		else {
			$data = array('upload_data'=>$this->user->data());
			$this->load->view('test', $data);
		}*/
	}

	function delete_profile($taxon_id){
	
		//extract($_POST);
		
		//$data['taxon_id']=$taxon_id;
		
		//$this->user_model->delete_profile($data['taxon_id']);
		
		$this->user_model->delete_profile($taxon_id);
		
		redirect('user/view_all_species');
		
	}
	
	function export_xml()
	{
		$data['title'] = "MakiBIS";
		$data['heading'] = "Export XML File";
		
		if($this->session->userdata('logged_in_admin')){
				
			//$this->load->view('view_export_xml', $data);
			$species_list = $this->user_model->query_all_species();
			$xmlDoc = new DOMDocument();
			$xmlDoc->formatOutput = true;
			$xmlDoc->load("SimpleDarwinRecordSet.xml");
			foreach ($species_list->result() as $row ){
				$newRecordNode = $xmlDoc->createElement("SimpleDarwinRecord");
				$newNode = $xmlDoc->createElement("dwc:specificEpithet");
				$newName = $xmlDoc->createTextNode($row->species);
				$newLine1 = $xmlDoc->createTextNode("\n");
				$newLineAgain = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newLineAgain);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine1);
					
				$newNode = $xmlDoc->createElement("dwc:genus");
				$newName = $xmlDoc->createTextNode($row->genus);
				$newLine2 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine2);
					
				$newNode = $xmlDoc->createElement("dwc:family");
				$newName = $xmlDoc->createTextNode($row->family);
				$newLine3 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine3);
					
				$newNode = $xmlDoc->createElement("dwc:order");
				$newName = $xmlDoc->createTextNode($row->order_name);
				$newLine4 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine4);
				
				$newNode = $xmlDoc->createElement("dwc:class");
				$newName = $xmlDoc->createTextNode($row->class);
				$newLine5 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine5);
			
				$newNode = $xmlDoc->createElement("dwc:phylum");
				$newName = $xmlDoc->createTextNode($row->phylum);
				$newLine6 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine6);
		
				$newNode = $xmlDoc->createElement("dwc:kingdom");
				$newName = $xmlDoc->createTextNode($row->kingdom);
				$newLine7 = $xmlDoc->createTextNode("\n");
				$newNode->appendChild($newName);
				$newRecordNode->appendChild($newNode);
				$newRecordNode->appendChild($newLine7);
					
				$newLineFinal = $xmlDoc->createTextNode("\n");
				$x = $xmlDoc->getElementsByTagName("SimpleDarwinRecordSet")->item(0);
				$x->appendChild($newRecordNode);
				$x->appendChild($newLineFinal);
			}
			$file = 'MakiBISRecordSet.xml';
			$xmlDoc->save($file);
			$data = file_get_contents($file);
			force_download($file, $data);
		}
		else{
			
			redirect('user/admin_login');
		}
	}
	
}//end of controller USER




/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */