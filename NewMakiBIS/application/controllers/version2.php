<?php

class Version2 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

 	function index() {
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload() {
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

	function up_gallery() {

		$config['upload_path'] = './images/species'; //'./uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		//$this->upload->do_upload();
		$this->upload->initialize($config);
		
		$taxon_id = $this->uri->segment(3);		
		$result = $this->user_model->query_images($taxon_id);
		$species_profile = $this->user_model->get_scientific_name($taxon_id);

		/*$this->form_validation->set_rules('image','File','');

		if($this->form_validation->run() == FALSE){
			$this->load->view('v_edit_gallery', array('data'=>$result, 'data2'=>$species_profile));
		}

		else {*/
			
			/* extract the species and genus to be used in formating image name */
			$species_profile = $this->user_model->query_species_profile($taxon_id);
				
				foreach ($species_profile->result() as $row ){
					$data['taxon_id']=$row->taxon_id;
					$data['species']=$row->species;
					$data['genus']=$row->genus;
				}
			
			//$this->upload->initialize($config);
		
			if ( ! $this->upload->do_upload())
			{
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
				redirect('version2/edit_gallery/'.$taxon_id);
			}
			else
			{
				//$image_path = 'images/species/'.$data['genus'].'_'.$data['species'].$image_data['file_ext'];
				//$image_name = $image_data['file_name'].$image_data['file_ext'];
				$image_data = $this->upload->data();
				$image_path = 'images/species/'.$image_data['file_name'];

				/*if($this->user_model->check_image($taxon_id, $image_path)) { // returns TRUE if image exists
					//redirect('version2/edit_gallery/'.$taxon_id.'/'.'1');
					echo 'exist';
				}
				else echo 'no';
				*/	
				
				$this->user_model->upload_image($image_path, $taxon_id);
				redirect('version2/edit_gallery/'.$taxon_id);
			}
		//}

	}

	function image_check($str)
	{
		if ($str == 'images/species/3rakdj.jpg')
		{
			$this->form_validation->set_message('image_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function gallery() {
		$taxon_id = $this->uri->segment(3);

		$result = $this->user_model->query_images($taxon_id);

		$species_profile = $this->user_model->get_scientific_name($taxon_id);

		$this->load->view('v_species_gallery', array('data'=>$result, 'data2'=>$species_profile));	
	}

	function edit_gallery() {
		$taxon_id = $this->uri->segment(3);

		$result = $this->user_model->query_images($taxon_id);

		$species_profile = $this->user_model->get_scientific_name($taxon_id);
			
		$this->load->view('v_edit_gallery', array('data'=>$result, 'data2'=>$species_profile));	
	}

	function profile() {
		$this->load->view('species_profile');
	}

	function profile_image() {
		$taxon_id = $this->uri->segment(3);
		$image_id = $this->uri->segment(4);
		$this->user_model->set_profile_image($taxon_id, $image_id);

		redirect('version2/edit_gallery/'.$taxon_id);
	}

	function delete_image() {
		$taxon_id = $this->uri->segment(3);
		$image_id = $this->uri->segment(4);
		$this->user_model->delete_image($image_id);

		//echo $taxon_id.' ';
		//echo $image_id;

		redirect('version2/edit_gallery/'.$taxon_id);
	}

	function save_desc() {
		$taxon_id = $this->uri->segment(3);
		$image_id = $this->uri->segment(4);

		extract ($_POST);
		$data['taxon_id'] = $taxon_id;

		$this->user_model->update_description($image_id);
		redirect('version2/edit_gallery/'.$taxon_id);

	}

 	function alert() {
 		$this->load->helper('form');
		$this->load->helper('html');

 		$this->load->view('alert');
 	}

	function ajax_lookUpUsername(){
	   	$image_location = 'images/species/3rakdj.jpg';
	    $username = $this->input->post('userfile');
	   	$this->db->from('image');
	    $this->db->where('image_location', $image_location);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0){
	       //echo $image_location;
	       echo 0;
	    } else {
	       echo 1;
	    }
	}

	public function edit_caption($taxon_id, $image_id){
		
		
		$data = array(
		    'description'=> $this->input->post('description')		
		);

			   
	    $this->db->where('image_id', $image_id);
	    $this->db->update('image', $data);

	    //$a = $this->input->post('description');
	    //echo $image_id.' '.$a;
	   // $this->load->view('alert');
		redirect('version2/edit_gallery/'.$taxon_id);	    
			   
	}
	
}
?>