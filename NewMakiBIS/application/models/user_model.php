<?php
class User_model extends CI_Model {
	

	
	function __construct(){
	parent::__construct();

	}
	/* */
	function get_scientific_name($taxon_id){
		$this->db->from('species');
		$this->db->where('taxon_id',$taxon_id);
		/*join the taxonomy related tables*/
		$this->db->join('genus','species.genus_genus_id = genus.genus_id' );	
		$query_result = $this->db->get();
		return $query_result->result_array();
	}

	function query_images($taxon_id) {
		$query_str = "SELECT * FROM image WHERE species_taxon_id=$taxon_id";
		return $this->db->query($query_str)->result_array();
	}

	function set_profile_image($taxon_id, $image_id) {
		
		$query_str2 = "UPDATE image SET profile_image='0' WHERE profile_image='1' AND species_taxon_id=$taxon_id";
		$this->db->query($query_str2);

		$query_str = "UPDATE image SET profile_image='1' WHERE image_id=$image_id";
		$this->db->query($query_str);
	}

	function delete_image($image_id) {

		$query_str = "DELETE FROM image WHERE image_id=$image_id";
		$this->db->query($query_str);
	}

	function check_image ($taxon_id, $image_loc) {
		$query_str = "SELECT * from image where species_taxon_id=$taxon_id and image_location='$image_loc'";
		$species_profile = $this->db->query($query_str);

		if ($species_profile->num_rows() > 0) {
			return true;
		}
		else
			return false;
	}

	function update_image ($image_location, $taxon_id) {
		$query_str = "UPDATE image SET image_location=? where species_taxon_id=?";
		$this->db->query($query_str, array($image_location, $taxon_id));
	}

	function upload_image ($image_location, $taxon_id) {
		/*$this->load->database();
		$data = array(
			'image_id' => NULL,
           'image_location'=>$image_location,    
           'species_taxon_id'=>$taxon_id                 
           );
        $this->db->insert('image',$data);   */
        $query_str = "INSERT into image VALUES (NULL, $taxon_id, '0', '$image_location', NULL )";
		$this->db->query($query_str);

	}

	function update_description($image_id, $desc) {
		$query_str = "UPDATE image SET description=$desc where image_id=$image_id";
		$this->db->query($query_str);
	}

	/* */

	function check_login($username,$password){
		
		//$admin_password = md5($password);
		$admin_password = $password;
		
		$query_str = "SELECT Account_id FROM useraccounts where username=? and password=? and approval=1 and role='admin'";
		
		$result = $this->db->query($query_str,array($username,$admin_password));
		
		if($result->num_rows() == 1)
		{
			return $result->row(0)->Account_id;
		}
		else {
			return false;
		}
	}
	
	function check_login_user($username,$password){
		
		$user_password = md5($password);
		
		$query_str = "SELECT Account_id FROM useraccounts where username=? and password=? and approval=1";
		
		$result = $this->db->query($query_str,array($username,$user_password));
		
		if($result->num_rows() == 1)
		{
			return $result->row(0)->Account_id;
		}
		else {
			return false;
		}
	}
	
	//query all domain for taxon tree
	function query_domain(){
		$query = "SELECT domain_id, domain FROM domain"; 
		$query_result = $this->db->query($query);
		return $query_result;
	}
	
	//query all kingdom under a certain domain for taxon tree
	function query_kingdom($domain_id){
		$this->db->from('kingdom');
		$this->db->where('domain_domain_id',$domain_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all phylum under a certain kingdom for taxon tree
	function query_phylum($kingdom_id){
		$this->db->from('phylum');
		$this->db->where('kingdom_kingdom_id',$kingdom_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all class under a certain phylum for taxon tree
	function query_class($phylum_id){
		$this->db->from('class');
		$this->db->where('phylum_phylum_id',$phylum_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all order under a certain class for taxon tree
	function query_order($class_id){
		$this->db->from('table_order');
		$this->db->where('class_class_id',$class_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all family under a certain order for taxon tree
	function query_family_tree($order_id){
		$this->db->from('family');
		$this->db->where('table_order_order_id',$order_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all genus under a certain family for taxon tree
	function query_genus($family_id){
		$this->db->from('genus');
		$this->db->where('family_family_id',$family_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//query all species under a certain genus for taxon tree
	function query_species($genus_id){
		$this->db->from('species');
		$this->db->where('genus_genus_id',$genus_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	//function to count the number of species in a certain kingdom for pagination
	function kingdom_record_count($kingdom){
		$this->db->from('kingdom');
		$this->db->where('kingdom', $kingdom);
	
    	$this->db->join('phylum','kingdom.kingdom_id = phylum.kingdom_kingdom_id' );
		$this->db->join('class','phylum.phylum_id = class.phylum_phylum_id' );
		$this->db->join('table_order','class.class_id = table_order.class_class_id' );
		$this->db->join('family','table_order.order_id = family.table_order_order_id' );
		$this->db->join('genus','family.family_id = genus.family_family_id' );
		$this->db->join('species','genus.genus_id = species.genus_genus_id' );
		
    	$query  = $this->db->get();
		
		return $query->num_rows();		
    }
	
	//function to get species under a certain kingdom
	function fetch_kingdom($limit,$start,$kingdom){
		$this->db->limit($limit,$start);
        
		$this->db->from('kingdom');
		$this->db->where('kingdom', $kingdom);
	
    	$this->db->join('phylum','kingdom.kingdom_id = phylum.kingdom_kingdom_id' );
		$this->db->join('class','phylum.phylum_id = class.phylum_phylum_id' );
		$this->db->join('table_order','class.class_id = table_order.class_class_id' );
		$this->db->join('family','table_order.order_id = family.table_order_order_id' );
		$this->db->join('genus','family.family_id = genus.family_family_id' );
		$this->db->join('species','genus.genus_id = species.genus_genus_id' );
		
    	$query  = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $row){
				$data[] = $row;
            }
			return $data;			
        }
		return false;		
	}
	
	//funtion to get all approved species for the view all species
	function get_query_species($limit,$start){
	
		$this->db->limit($limit,$start);
		
 	 	$this->db->from('species');
		$this->db->where('flag', '1');
		
		$this->db->join('genus','species.genus_genus_id = genus.genus_id' );
		
		$query  = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;			
        }
		return false;
	}
	
	//funtion to count all approved species for pagination
	function count_all_species(){
		
		$query = "SELECT species FROM species WHERE species.flag = 1";

    	$query_result = $this->db->query($query);
		
		return $query_result->num_rows();
	}
	
	//funtion to get all book reference
	function get_reference_book(){
	   	$query  = $this->db->get('reference_book');
    	return $query;
    }
	
	//funtion to get all book chapter reference
	function get_reference_book_chapter(){
	   	$query  = $this->db->get('reference_book_chapter');
    	return $query;
    }
	
	//funtion to get all journal reference
	function get_reference_journal(){
	   	$query  = $this->db->get('reference_journal');
    	return $query;
    }
	
	//funtion to get all proceedings reference
	function get_reference_proceedings(){
	   	$query  = $this->db->get('reference_proceedings');
    	return $query;
    }
	
	//funtion to get all project report reference
	function get_reference_project_report(){
	   	$query  = $this->db->get('reference_project_report');
    	return $query;
    }
	
	//funtion to get all thesis reference
	function get_reference_thesis(){
	   	$query  = $this->db->get('reference_thesis');
    	return $query;
    }
	
	//get all information about a species given the taxon id
	function query_species_profile($taxon_id){
		$this->db->from('species');
		$this->db->where('taxon_id',$taxon_id);
		/*join the taxonomy related tables*/
		$this->db->join('genus','species.genus_genus_id = genus.genus_id' );
		$this->db->join('family','genus.family_family_id = family.family_id');
		$this->db->join('table_order', 'family.table_order_order_id = table_order.order_id');
		$this->db->join('class','table_order.class_class_id = class.class_id');
		$this->db->join('phylum', 'class.phylum_phylum_id = phylum.phylum_id');
		$this->db->join('kingdom','phylum.kingdom_kingdom_id = kingdom.kingdom_id');
		$this->db->join('domain', 'kingdom.domain_domain_id = domain.domain_id');
		
		$this->db->join('reference', 'species.reference_reference_id = reference.reference_id');

		//$this->db->join('image', 'species.taxon_id = image.species_taxon_id');

		//$this->db->join('image', 'species.taxon_id = image.species_taxon_id ','inner');
		//$this->db->join('species_author', 'species.taxon_id = species_author.species_taxon_id ','inner');
		//$this->db->join('conservation_status','species.taxon_id=conservation_status.species_taxon_id','inner');
		//$this->db->join('description','species.taxon_id = description.species_taxon_id', 'inner');
		//$this->db->join('encoder_information', 'species.taxon_id = encoder_information.species_taxon_id', 'inner');
		//$this->db->join('reproduction_mode', 'species.taxon_id = reproduction_mode.species_taxon_id', 'inner');
		//$this->db->join('habitat', 'species.taxon_id = habitat.species_taxon_id');
		
		$query_result = $this->db->get();
		return $query_result;
	}


	
	/* added by grace */
	function query_species_image($taxon_id) {
		$this->db->from('image');
		$this->db->where('species_taxon_id', $taxon_id);
		$this->db->where('profile_image', '1');
		$query_result = $this->db->get();
		return $query_result;

	}
	/* --- */

	function query_species_author($taxon_id){
		$this->db->from('species_author');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	function query_conservation_status($taxon_id){
		$this->db->from('conservation_status');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	function query_description($taxon_id){
		$this->db->from('description');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	function query_encoder_information($taxon_id){
		$this->db->from('encoder_information');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	function query_reproduction_mode($taxon_id){
		$this->db->from('reproduction_mode');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	function query_habitat($taxon_id){
		$this->db->from('habitat');
		$this->db->where('species_taxon_id',$taxon_id);
		$query_result = $this->db->get();
		return $query_result;
	}
	
	
	
	
	
	
	
	function query_reference($reference_number,$reference_code){
		if($reference_code=='B'){
			$this->db->from('reference_book');
			$this->db->where('reference_book_id',$reference_number);
			$query_result = $this->db->get();
		}
		else if($reference_code=='BC'){
			$this->db->from('reference_book_chapter');
			$this->db->where('Reference_book_chapter_id',$reference_number);
			$query_result = $this->db->get();
		}
		else if($reference_code=='JA'){
			$this->db->from('reference_journal');
			$this->db->where('Reference_journal_id',$reference_number);
			$query_result = $this->db->get();
		}
		else if($reference_code=='PR'){
			$this->db->from('reference_proceedings');
			$this->db->where('Reference_proceedings_id',$reference_number);
			$query_result = $this->db->get();
		}
		else if($reference_code=='PRR'){
			$this->db->from('reference_project_report');
			$this->db->where('Reference_project_report_id',$reference_number);
			$query_result = $this->db->get();
		}
		else if($reference_code=='TR'){
			$this->db->from('reference_thesis');
			$this->db->where('Reference_thesis_id',$reference_number);
			$query_result = $this->db->get();
		}
		return $query_result;
	}
	
	function check_scientificname($species, $genus){
		
		/*Dec. 9, 2011
		 * This function will 'try' check if the combination of the species and genus/ scientific name
		 * of the organism
		 * 
		 */	
		
		$this->db->select('species, genus');
		/*join the taxonomy related tables*/
		$this->db->from('species');
		$this->db->where('species',$species);
		$this->db->where('genus',$genus);
		$this->db->join('genus','species.genus_genus_id = genus.genus_id' );
		
		//$query_str = "SELECT species FROM species WHERE species = ?";
		
		/*trying to use active records*/

		// $this->db->from('species');
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//scientific name exist
			return true;
		}else{
			//scientific name do not exist
			return false;
		}
	}
	
	function check_genus($genus){	
		$this->db->select('genus');
		$this->db->from('genus');
		$this->db->where('genus',$genus);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			//genus exist
			return true;
		}else{
			//genus do not exist
			return false;
		}
	}
	
	function get_genus($genus){
		$this->db->select('genus_id');
		$this->db->from('genus');
		$this->db->where('genus',$genus);
		
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){
			$genus_id=$row->genus_id;
		 }
		return $genus_id;	
	}
	
	function save_species($genus_id,$species,$reference_number,$reference_code){
		$this->db->set('reference_number',$reference_number);
		$this->db->set('reference_code', $reference_code);
		$this->db->insert('reference');
		$reference_id = $this->db->insert_id();
		
		$this->db->set('species', $species);
		$this->db->set('genus_genus_id', $genus_id);
		$this->db->set('reference_reference_id', $reference_id);
		
		if($this->session->userdata('logged_in_user')){
			$this->db->set('flag', 0);
			$this->db->set('submitted_by', $this->session->userdata('user_id'));
		}
		else{
			$this->db->set('flag', 1);
			$this->db->set('submitted_by', $this->session->userdata('admin_id'));
		}
		$this->db->insert('species');
		$taxon_id = $this->db->insert_id();
		
		return  $taxon_id;
	}
	
	function query_family($genus_id){
		$this->db->from('genus');
		$this->db->where('genus_id',$genus_id);
		
		$this->db->join('family','genus.family_family_id = family.family_id');
		$this->db->join('table_order', 'family.table_order_order_id = table_order.order_id');
		$this->db->join('class','table_order.class_class_id = class.class_id');
		$this->db->join('phylum', 'class.phylum_phylum_id = phylum.phylum_id');
		$this->db->join('kingdom','phylum.kingdom_kingdom_id = kingdom.kingdom_id');
		$this->db->join('domain', 'kingdom.domain_domain_id = domain.domain_id');
		
		$query_result = $this->db->get();
		return $query_result;
	}
	
	function save_species_author($taxon_id, $scientificname_author){
							
		$this->db->set('scientificname_author', $scientificname_author);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->insert('species_author'); 						
	}
	
	
	function save_conservation_status($taxon_id,$conservation_status){
		
		$this->db->set('status', $conservation_status);
		$this->db->set('species_taxon_id',$taxon_id);
		$this->db->insert('conservation_status');
	}
	
	function save_habitat($taxon_id, $habitat){
		
		$this->db->set('habitat', $habitat);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->insert('habitat');
	}
	
	function save_reproduction_mode($taxon_id, $reproduction_mode){
		
		$this->db->set('mode', $reproduction_mode);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->insert('reproduction_mode');
	
	}
	
	function save_encoder($taxon_id, $encoder_name,$encoder_date){

		$this->db->set('encoder_name', $encoder_name);
		$this->db->set('encoder_date', $encoder_date);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->insert('encoder_information');
	}
	
	function save_description($taxon_id, $description, $reference_code, $reference_number){
		
		$this->db->set('description', $description);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->set('description_reference_number', $reference_number);
		$this->db->set('description_reference_code', $reference_code);
		$this->db->insert('description');
	}
	function get_references($limit,$start,$author,$reference_type){
    	$this->db->limit($limit,$start);
		
    	$this->db->like('Author', $author);
    	$this->db->from($reference_type);
		
    	$query  = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $row){
				$data[] = $row;
            }
			return $data;			
        }
		return false;
    
    }
	
	function count_references_results($author,$reference_type){
    	
    	$this->db->like('Author', $author);
    	$this->db->from($reference_type);
		
    	$query  = $this->db->get();
    
		return $query->num_rows();
    
    }
	
	function save_book_reference($temp,$year,$book_title,$publishing_house,$publishing_country){
	
		$this->db->set('Author', $temp);
		$this->db->set('Year_published', $year);
		$this->db->set('Book_title', $book_title);
		$this->db->set('Publisher', $publishing_house);
		$this->db->set('Reference_code', 'B');
		$this->db->set('Country', $publishing_country);
		
		$this->db->insert('reference_book');
		
				
		return $this->db->insert_id();			
	}
	
	function save_book_chapter_reference($temp1,$temp2,$year_book_chapter,$chapter_title,$book_title,$publishing_house,$publishing_country){
	
		$this->db->set('Author', $temp1);
		$this->db->set('Book_author', $temp2);
		$this->db->set('Chapter_title', $chapter_title);
		$this->db->set('Year_published', $year_book_chapter);
		$this->db->set('Book_title', $book_title);
		$this->db->set('Publisher', $publishing_house);
		$this->db->set('Country', $publishing_country);
		$this->db->set('Reference_code', 'BC');
		$this->db->insert('reference_book_chapter');
				
		return $this->db->insert_id();			
	}
	
	function save_journal_reference($temp,$year_journal,$article_title,$journal){
	
		$this->db->set('Author', $temp);
		$this->db->set('Year_published', $year_journal);
		$this->db->set('Article_title', $article_title);
		$this->db->set('Journal_name', $journal);
		$this->db->set('Reference_code', 'JA');
		$this->db->insert('reference_journal');
				
		return $this->db->insert_id();
	}
		
    function save_thesis_reference($temp,$year_thesis,$thesis_title,$manuscript_type,$manuscript_location){
				
    	$this->db->set('Author', $temp);
		$this->db->set('Year_published', $year_thesis);
		$this->db->set('Thesis_title', $thesis_title);
		$this->db->set('Type', $manuscript_type);
		$this->db->set('Location', $manuscript_location);
		$this->db->set('Reference_code', 'TR');
		$this->db->insert('reference_thesis'); 

		return $this->db->insert_id();
    }
    
    function save_proceedings_reference($temp,$day,$month,$year_proceedings,$topic_title,$symposium,$venue){
    
    	$this->db->set('Author', $temp);
		$this->db->set('Date', $day.' '.$month);
		$this->db->set('Year', $year_proceedings);
		$this->db->set('Topic_title', $topic_title);
		$this->db->set('Symposium', $symposium);
		$this->db->set('Venue', $venue);
		$this->db->set('Reference_code', 'PR');
		$this->db->insert('reference_proceedings');
				
		return $this->db->insert_id();
    }
    
    function save_project_report_reference($temp,$year,$project_title,$institution,$department,$funding_agency){
    	    	
    	$this->db->set('Author', $temp);
		$this->db->set('Project_year', $year);
		$this->db->set('Project_title', $project_title);
		$this->db->set('Institution', $institution);
		$this->db->set('Department', $department);
		$this->db->set('Funding_agency', $funding_agency);
		$this->db->set('Reference_code', 'PRR');
		$this->db->insert('reference_project_report');
				
		return $this->db->insert_id();
    }
	
	function get_family($family){

		$this->db->select('family_id');
		$this->db->from('family');
		$this->db->where('family',$family);
	
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){
		 	$family_id=$row->family_id;
		}
		
		return $family_id;
	}
	
	function get_order($order_name){

		$this->db->select('order_id');
		$this->db->from('table_order');
		$this->db->where('order_name',$order_name);
		
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){
		 	$order_id=$row->order_id;
		}
		
		return $order_id;	
	}
	
	function get_class($class){

		$this->db->select('class_id');
		$this->db->from('class');
		$this->db->where('class',$class);
	
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){	
		 	$class_id=$row->class_id;
		}
		
		return $class_id;		
	}
	
	function get_phylum($phylum){

		$this->db->select('phylum_id');
		$this->db->from('phylum');
		$this->db->where('phylum',$phylum);
			
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){	
		 	$phylum_id=$row->phylum_id;
		}
	
		return $phylum_id;			
	}
	
	function get_kingdom($kingdom){

		$this->db->select('kingdom_id');
		$this->db->from('kingdom');
		$this->db->where('kingdom',$kingdom);
		
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){ 	
		 	$kingdom_id=$row->kingdom_id;
		}
		
		return $kingdom_id;	
	}
	
	function get_domain($domain){

		$this->db->select('domain_id');
		$this->db->from('domain');
		$this->db->where('domain',$domain);
			
	 	$query = $this->db->get();
		 
		foreach ($query->result() as $row ){	
		 	$domain_id=$row->domain_id;
		}
		
		return $domain_id;		
	}
	
	function save_genus($genus,$family_id){
					
		$this->db->set('genus', $genus);
		$this->db->set('family_family_id', $family_id);
		$this->db->insert('genus'); 
		
		return $this->db->insert_id();												
	}
	
	function save_family($family,$order_id){
							
		$this->db->set('family', $family);
		$this->db->set('table_order_order_id ', $order_id);
		$this->db->insert('family'); 
		
		return $this->db->insert_id();					
	}
	
	function save_order($order_name,$class_id){
								
		$this->db->set('order_name', $order_name);
		$this->db->set('class_class_id ', $class_id);
		$this->db->insert('table_order'); 
		
		return $this->db->insert_id();					
	}
	
	function save_class($class,$phylum_id){
						
		$this->db->set('class', $class);
		$this->db->set('phylum_phylum_id ', $phylum_id);
		$this->db->insert('class'); 
		
		return $this->db->insert_id();					
	}
	
	function save_phylum($phylum,$kingdom_id){
					
		$this->db->set('phylum', $phylum);
		$this->db->set('kingdom_kingdom_id', $kingdom_id);
		$this->db->insert('phylum'); 
		
		return $this->db->insert_id();					
	}
	
	function save_kingdom($kingdom, $domain_id){
									
		$this->db->set('kingdom', $kingdom);
		$this->db->set('domain_domain_id', $domain_id);
		$this->db->insert('kingdom'); 
		
		return $this->db->insert_id();					
	}
	
	function save_vernacular_name($taxon_id, $vernacular_name, $reference_code, $reference_number){
		
		$this->db->set('vernacular_name ', $vernacular_name );
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->set('reference_number', $reference_number);
		$this->db->set('reference_code', $reference_code);
		$this->db->insert('vernacular_name'); 
		
	}
	
	function save_synonyms($taxon_id, $synonyms, $reference_code, $reference_number){
		
		$this->db->set('synonym_name', $synonyms);
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->set('reference_number', $reference_number);
		$this->db->set('reference_code', $reference_code);
		$this->db->insert('synonyms');	
	
	}
	
	function save_economic_use($taxon_id, $economic_use, $reference_code, $reference_number){
		
		$this->db->set('economic_use ', $economic_use );
		$this->db->set('species_taxon_id', $taxon_id);
		$this->db->set('reference_number', $reference_number);
		$this->db->set('reference_code', $reference_code);
		$this->db->insert('economic_use'); 

	}
	
	
	
	function check_family($family){
		
		$this->db->select('family');
		$this->db->from('family');
		$this->db->where('family',$family);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//family exist
			return true;
		}else{
			//family do not exist
			return false;
		}
	}
	
	function check_order($order_name){
		
		$this->db->select('order_name');
		$this->db->from('table_order');
		$this->db->where('order_name',$order_name);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//order exist
			return true;
		}else{
			//order do not exist
			return false;
		}
	}
	
	function check_class($class){
		
		$this->db->select('class');
		$this->db->from('class');
		$this->db->where('class',$class);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//class exist
			return true;
		}else{
			//class do not exist
			return false;
		}
	}
	
	function check_phylum($phylum){
		
		$this->db->select('phylum');
		$this->db->from('phylum');
		$this->db->where('phylum',$phylum);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//phylum exist
			return true;
		}else{
			//phylum do not exist
			return false;
		}
	
	}
	
	function check_kingdom($kingdom){
		
		$this->db->select('kingdom');
		$this->db->from('kingdom');
		$this->db->where('kingdom',$kingdom);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//kingdom exist
			return true;
		}else{
			//kingdom do not exist
			return false;
		}
	
	}
	
	function check_domain($domain){
		
		$this->db->select('domain');
		$this->db->from('domain');
		$this->db->where('domain',$domain);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//domain exist
			return true;
		}else{
			//domain do not exist
			return false;
		}
	
	}
	
	function check_vernacular($taxon_id){
    	
    	$this->db->select('vernacular_name');
		$this->db->from('vernacular_name');
		$this->db->where('species_taxon_id',$taxon_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//genus exist
			return true;
		}else{
			//genus do not exist
			return false;
		}
    }
    
    function check_synonyms($taxon_id){
    	
    	$this->db->select('synonym_name');
		$this->db->from('synonyms');
		$this->db->where('species_taxon_id',$taxon_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//genus exist
			return true;
		}else{
			//genus do not exist
			return false;
		}
    }
    
    function check_econuse($taxon_id){
    	
    	$this->db->select('economic_use');
		$this->db->from('economic_use');
		$this->db->where('species_taxon_id',$taxon_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			
			//genus exist
			return true;
		}else{
			//genus do not exist
			return false;
		}
    }
	
	 function vernacular_query($taxon_id){
      //  $this->db->select('vernacular_name');
		$this->db->from('vernacular_name');
		$this->db->where('species_taxon_id',$taxon_id);
		
		return $this->db->get();
    
    }
    
    function synonyms_query($taxon_id){
      //  $this->db->select('vernacular_name');
		$this->db->from('synonyms');
		$this->db->where('species_taxon_id',$taxon_id);
		
		return $this->db->get();
    
    }    
    function econuse_query($taxon_id){
      //  $this->db->select('vernacular_name');
		$this->db->from('economic_use');
		$this->db->where('species_taxon_id',$taxon_id);
		
		return $this->db->get();
    
    }
    
    

	function update_profile( $taxon_id,$domain,$domain_id,$kingdom,$kingdom_id,$phylum,$phylum_id,$class,$class_id,$order_name,$order_id,$family,$family_id,$reference_number,$reference_code,$scientificname_author,
											$conservation_status,$habitat,$description,$reproduction_mode,
											$edited_by,$edited_date){
			
			//update domain
			$this->db->where('domain_id', $domain_id);
			$this->db->update('domain',array('domain' => $domain)  );
			
			//update kingdom
			$this->db->where('kingdom_id', $kingdom_id);
			$this->db->update('kingdom',array('kingdom' => $kingdom)  );
			
			//update phylum
			$this->db->where('phylum_id', $phylum_id);
			$this->db->update('phylum',array('phylum' => $phylum)  );
			
			//update class
			$this->db->where('class_id', $class_id);
			$this->db->update('class',array('class' => $class)  );
			
			//update order
			$this->db->where('order_id', $order_id);
			$this->db->update('table_order',array('order_name' => $order_name)  );
			
			//update family
			$this->db->where('family_id', $family_id);
			$this->db->update('family',array('family' => $family)  );
			
			//update scientificname author
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('species_author',array('scientificname_author' => $scientificname_author)  );
			
			//update synonyms
			//$this->db->where('species_taxon_id', $taxon_id);
			//$this->db->update('synonyms',array('synonym_name' => $synonyms)  );			
			
			//update conservation_status
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('conservation_status',array('status' => $conservation_status)  );	

			//update habitat
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('habitat',array('habitat' => $habitat)  );	
	
			//update vernacular name
			//$this->db->where('species_taxon_id', $taxon_id);
			//$this->db->update('vernacular_name',array('vernacular_name' => $vernacular_name)  );

			//update description
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('description',array('description' => $description)  );

			//update economic_use
			//$this->db->where('species_taxon_id', $taxon_id);
			//$this->db->update('economic_use',array('economic_use' => $economic_use)  );	
	
			//update reproduction mode
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('reproduction_mode',array('mode' => $reproduction_mode)  );	
			
			//update encoder_information
			$this->db->where('species_taxon_id', $taxon_id);
			$this->db->update('encoder_information',array('edited_by' => $edited_by, 'edited_date'=>$edited_date)  );

											
	}
	
	function delete_profile($taxon_id){
		//get the reference_id
		$query = $this->db->get_where('species', array('taxon_id' => $taxon_id));
		foreach ($query->result() as $row ){
			$reference_id = $row->reference_reference_id;
			$genus_id = $row->genus_genus_id;
			$species = $row->species;
		}
		$query = $this->db->get_where('genus', array('genus_id' => $genus_id));
		foreach ($query->result() as $row ){
			$family_id = $row->family_family_id;
			$genus = $row->genus;
		}
		
		//echo "<script>javascript:confirm('Are you sure you want to delete ".$genus." ".$species."');</script>";
		
		$query = $this->db->get_where('family', array('family_id' => $family_id));
		foreach ($query->result() as $row ){
			$order_id = $row->table_order_order_id;
		}
		$query = $this->db->get_where('table_order', array('order_id' => $order_id));
		foreach ($query->result() as $row ){
			$class_id = $row->class_class_id;
		}
		$query = $this->db->get_where('class', array('class_id' => $class_id));
		foreach ($query->result() as $row ){
			$phylum_id = $row->phylum_phylum_id;
		}
		
		
		//delete species
		$this->db->delete('species',array('taxon_id' => $taxon_id)  );
			
		//delete reference
		$this->db->delete('reference',array('reference_id' => $reference_id)  );
		
		//delete scientificname_author
		$this->db->delete('species_author',array('species_taxon_id' => $taxon_id)  );
			
		//delete synonyms
		$this->db->delete('synonyms',array('species_taxon_id' => $taxon_id)  );			
			
		//delete conservation_status
		$this->db->delete('conservation_status',array('species_taxon_id' => $taxon_id)  );	

		//delete habitat
		$this->db->delete('habitat',array('species_taxon_id' => $taxon_id)  );	
	
		//delete vernacular name
		$this->db->delete('vernacular_name',array('species_taxon_id' => $taxon_id)  );
			
		//delete description
		$this->db->delete('description',array('species_taxon_id' => $taxon_id)  );

		//delete economic_use
		$this->db->delete('economic_use',array('species_taxon_id' => $taxon_id)  );	
	
		//delete reproduction_mode
		$this->db->delete('reproduction_mode',array('species_taxon_id' => $taxon_id)  );	
			
		//delete encoder_information
		$this->db->delete('encoder_information',array('species_taxon_id' => $taxon_id)  );
			
		//delete image
		$this->db->delete('image',array('species_taxon_id' => $taxon_id)  );
		
		$query = $this->db->get_where('species', array('genus_genus_id' => $genus_id));
		
		if($query->num_rows() == 0){
			$this->db->delete('genus',array('genus_id' => $genus_id));
			$query = $this->db->get_where('genus', array('family_family_id' => $family_id));
			if($query->num_rows() == 0){
				$this->db->delete('family',array('family_id' => $family_id));
				$query = $this->db->get_where('family', array('table_order_order_id' => $order_id));
				if($query->num_rows() == 0){
					$this->db->delete('table_order',array('order_id' => $order_id));
					$query = $this->db->get_where('table_order', array('class_class_id' => $class_id));
					if($query->num_rows() == 0){
						$this->db->delete('class',array('class_id' => $class_id));
						$query = $this->db->get_where('class', array('phylum_phylum_id' => $phylum_id));
						if($query->num_rows() == 0){
							$this->db->delete('phylum',array('phylum_id' => $phylum_id));
						}
					}
				}
			}
		}
	}
	
	function query_all_species(){

		$this->db->from('species');
		/*join the taxonomy related tables*/
		$this->db->join('genus','species.genus_genus_id = genus.genus_id' );
		$this->db->join('family','genus.family_family_id = family.family_id');
		$this->db->join('table_order', 'family.table_order_order_id = table_order.order_id');
		$this->db->join('class','table_order.class_class_id = class.class_id');
		$this->db->join('phylum', 'class.phylum_phylum_id = phylum.phylum_id');
		$this->db->join('kingdom','phylum.kingdom_kingdom_id = kingdom.kingdom_id');
		
		$this->db->join('species_author', 'species.taxon_id = species_author.species_taxon_id ','inner');
		//$this->db->join('vernacular_name','species.taxon_id = vernacular_name.species_taxon_id', 'inner');
		$this->db->join('reproduction_mode', 'species.taxon_id = reproduction_mode.species_taxon_id', 'inner');
		
	    $query_result = $this->db->get();
		return $query_result;
	}
	

}
?>