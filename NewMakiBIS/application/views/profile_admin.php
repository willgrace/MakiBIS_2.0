
<div class='profile_admin'>
	<div id='genus_link'>
		<h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all"><?php echo $genus.' '.$species?></h4>
	</div>	
	<br><img class="species_pic" alt="" src="<?php echo base_url().$species_image;?>"><br>

	<div class="content text">
		<!--Choose photo:
		<?php//echo form_open_multipart('user/do_upload/'.$taxon_id);?>
			<input type="file" name="userfile" class= "ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"  size="10" />
			<input type="submit" value="upload" class="ui-button ui-button-text-only ui-state-default ui-corner-all"/>
		</form> -->

	</div>
	
	<div class="content text">
  		<b>Family: </b><?php echo nbs(14).$family?><br>
  		<b>Order: </b><?php echo nbs(15).$order_name?><br>
  		<b>Class: </b><?php echo nbs(15).$class?><br>
  		<b>Phylum: </b><?php echo nbs(12).$phylum?><br>
  		<b>Kingdom: </b><?php echo nbs(10).$kingdom?><br>
  		<b>Domain: </b><?php echo nbs(12).$domain?>
	</div>



	<div class="text content">
		<h6 class="ui-widget-header info_box_subheader text ui-widget-content ui-corner-all">Description</h6>
		<?php echo $description;?>
		<br><hr>

		<b>Scientificname Author: </b> <?php echo $scientificname_author;?>
		<br>
		<b>Habitat: </b><?php echo $habitat;?>
		<br>
		<b> Mode of Reproduction: </b><?php echo $reproduction_mode;?>
		<br>
		<b>Conservation Status: </b><?php echo $conservation_status;?>
		<br>

		<hr>
		<b><i>Main Reference: </i></b>
		<?php echo $reference_code.$reference_number;?>
	</div>


</div>

<div class="profile_admin content">

	<div class="grid_3">
		<?php echo form_open('user/vernacular_name')?>
		<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
		<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
		<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
		<center>		
			<?php  echo form_submit(array('name'=>'submit','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all ui-icon-locked'), 'Add Common Name');?>
		</center>
		<?php echo form_close();?>
		<div class="grid_3" style="overflow:">
		<?php 
		echo '<table id="" border = "1">';
		echo '<th>';
		echo '<b> Common Names:</b>';
		echo '</th><th class="table_multiple">';
		echo '<b>Ref.Code</b>';
		echo '</th>';
		
		if($vernacular_check == true){
			$vernacular_query = $this->user_model->vernacular_query($taxon_id);
			foreach ($vernacular_query -> result() as $row ){
				echo '<tr><td><blockquote><p>';
				echo $row->vernacular_name;
				echo '</blockquote></p></td><td class="table_multiple">';
				echo '<center>'.$row->reference_code.''.$row->reference_number.'</center>';	
				echo '</td></tr>';
			}
		}
		echo '</table>';
		?>
		</div>
	</div>
	
	<div class="grid_3">
		<?php echo form_open('user/economic_use')?>
	
		<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
		<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
		<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
		<center>
		<?php  echo form_submit(array('name'=>'economic','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all ui-icon-locked'), 'Add Economic Use');?>
		</center>
		<?php echo form_close();?> 	
	
		<?php
		echo '<center>';
		echo '<table id="" border = "1">';
		echo '<th>';
		echo '<b>Economic Use:</b>';
		echo '</th><th class="table_multiple">';
		echo '<b>Ref.Code</b>';
		echo '</th>';
		
		if($econuse_check == true){
			$econuse_query = $this->user_model->econuse_query($taxon_id);
			foreach ($econuse_query -> result() as $row ){	
				echo '<tr><td>';
				echo $row->economic_use;
				echo '</td><td class="table_multiple">';
				echo '<center>'.$row->reference_code.''.$row->reference_number.'</center>';	
				echo '</td></tr>';			
			}
		}
		echo '</table>';
		echo '</center>';
		?>
	</div>
	
	<div class="grid_3">
		<?php echo form_open('user/synonyms')?>
	
		<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
		<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
		<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
	
		<?php  echo form_submit(array('name'=>'synonyms','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all ui-icon-locked'), 'Add Synonyms');?>
		<?php echo form_close();?>  	
	
		
		<?php 
			echo '<table id="" border = "1">';
			echo '<th>';
			echo '<b>Synonyms:</b>';
			echo '</th><th class="table_multiple">';
			echo '<b>Ref.Code</b>';
			echo '</th>';
		
			if($synonyms_check == true){
				$synonyms_query = $this->user_model->synonyms_query($taxon_id);
				foreach ($synonyms_query -> result() as $row ){	
					echo '<tr><td>';
				echo $row->synonym_name;
				echo '</td><td class="table_multiple">';
				echo '<center>'.$row->reference_code.''.$row->reference_number.'</center>';	
				echo '</td></tr>';				
				}	
			}
			echo '</table>';
		?>	
	</div>

</div>