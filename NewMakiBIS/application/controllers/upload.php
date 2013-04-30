<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

 	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

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

	function up_gallery() {
		$config['upload_path'] = './images/species'; //'./uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = FALSE;
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
			
	
		//$image_name = $data['genus'].'_'.$data['species'];
	
		//$config['file_name'] = $image_name;
		
		$this->upload->initialize($config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$image_data = $this->upload->data();
			//$image_path = 'images/species/'.$data['genus'].'_'.$data['species'].$image_data['file_ext'];
			//$image_name = $image_data['file_name'].$image_data['file_ext'];
			$image_path = 'images/species/'.$image_data['file_name'];
			//if($image_exist)
			//	$this->user_model->update_image($image_path, $taxon_id);
			//else
				$this->user_model->upload_image($image_path, $taxon_id);
			redirect('upload/gallery/'.$taxon_id);
		}

	}

	function gallery() {
		$taxon_id = $this->uri->segment(3);

		$result = $this->user_model->query_images($taxon_id);

		$this->load->view('v_species_gallery', array('data'=>$result));
	}

	
}
?>