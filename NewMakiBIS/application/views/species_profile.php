	
		<div>
			<?php  
				//echo img(array('src'=>'uploads/'.$taxon_id.'.jpg','width' => '200','height' => '200'));	 	
			?>
			<br>
		</div>
		<div>		
			<div id="picbox">
				<img class="species_pic" alt="" src="<?php echo base_url().$species_image;?>"><br /><br />
				<div id="link"><?php echo anchor('version2/gallery/'.$taxon_id, 'Gallery',array('style'=>' width: 125px;color:#fff;','class'=>'ui-button ui-widget ui-state-default ui-corner-all')); ?><br /></div>
			</div>

			
			<?php echo'<label><strong><b>Scientific name:</b></strong></label>';?>
			<?php echo nbs(2).'<i>'.$genus.' '.$species.'</i></br>';?>
			<?php echo'<label><strong><b>Family:</b></strong></label>'.nbs(19).$family;?>
			<?php echo'<br/><label><strong><b>Order:</b></strong></label>'.nbs(21).$order_name;?>
			<?php echo'<br/><label><strong><b>Class:</b></strong></label>'.nbs(21).$class;?>
			<?php echo'<br/><label><strong><b>Phylum:</b></strong></label>'.nbs(17).$phylum;?>
			<?php echo'<br/><label><strong><b>Kingdom:</b></strong></label>'.nbs(14).$kingdom;?>
			<?php echo'<br/><label><strong><b>Domain:</b></strong></label>'.nbs(17).$domain;?>		
		</div>

		<br/>
		
	<div>
		<div>
			<?php echo'<label><strong><b>General Description:</b></strong></label>';?>
			<?php echo $description;?>
			<br/><br/>
			<?php echo'<label><strong><b>Species Author:</b></strong></label>';?>
			<?php echo $scientificname_author;?>
			<br><br/>
			<?php echo'<label><strong><b>Conservation Status:</b></strong></label>';?>
			<?php echo $conservation_status;?>
			<br><br/>
			<?php echo'<label><strong><b>Habitat:</b></strong></label>';?>
			<?php echo $habitat;?>
			<br><br/>
			<?php echo'<label><strong><b>Reproduction Mode:</b></strong></label>';?>
			<?php echo $reproduction_mode;?>
			
			<label><br/><br/><b>Reference ID:</b></label>
			<i><?php echo  anchor('user/view_references/'.$reference_code.'/'.$reference_number.'/',$reference_code.$reference_number)?></i>
			
			<br/><br/><br/>
		</div>	
	</div>
	<div class = "main_content">
	<div class="grid_3">
	<center><b>List of Common Names:</b></center>
	<div class="grid_2">
			 <i>Common Names:</i> 
		</div>
		<div class="">
			<i>Ref.Code</i>
		</div>
		<?php 

		if($vernacular_check == true){
			$vernacular_query = $this->user_model->vernacular_query($taxon_id);
			foreach ($vernacular_query -> result() as $row ){	
				echo '<div class="grid_1">';
				echo $row->vernacular_name;
				echo '</div>';
				echo '<div class="grid_1 push_1">';	
				echo  anchor('user/view_references/'.$row->reference_code.'/'.$row->reference_number.'/',$row->reference_code.$row->reference_number);
				echo '</div>';
				echo '<hr>';	
			}
		}
		else{
			echo '<center>No records found</center>';
		}
		?>
	
	
	</div>
	
	<div class="grid_3">
	<center><b>List of Synonyms</b></center>
	<div class="grid_2">
			<i> Synonyms: </i>
		</div>
		<div class="">
			<i>Ref.Code</i>
		</div>
		<?php 
			if($synonyms_check == true){
				$synonyms_query = $this->user_model->synonyms_query($taxon_id);
				foreach ($synonyms_query -> result() as $row ){	
					echo '<div class="grid_1">';
					echo $row->synonym_name;
					echo '</div>';
					echo '<div class="grid_1 push_1">';
					echo  anchor('user/view_references/'.$row->reference_code.'/'.$row->reference_number.'/',$row->reference_code.$row->reference_number);
					echo '</div>';
					echo '<hr>';				
				}	
			}
			else{
				echo '<center>No records found</center>';
			}
		?>	
	</div>
	</div>
	<br/><br/><br/><br/>
	
	<div class="main_content">
		<div class="grid_3">
		<center><b>List of Economic Use:</b></center>
		<div class="grid_2">
			<i> Economic Use: </i>
		</div>
		<div class="">
			<i>Ref.Code</i>
		</div>
		<?php 

		if($econuse_check == true){
			$econuse_query = $this->user_model->econuse_query($taxon_id);
			foreach ($econuse_query -> result() as $row ){	
				echo '<div class="grid_1">';
				echo $row->economic_use;
				echo '</div>';
				echo '<div class="grid_1 push_1">';
				echo  anchor('user/view_references/'.$row->reference_code.'/'.$row->reference_number.'/',$row->reference_code.$row->reference_number);
				echo '</div>';
				echo '<hr>';			
			}
		}
		else{
			echo '<center>No records found</center>';
		}
	
		?>
		</div>
	
	</div>