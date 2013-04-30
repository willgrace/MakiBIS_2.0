

    <!--Grace -->
	
      	<div id="species_image" style="float:right;">
	      	<img class="species_pic" alt="" src="<?php echo base_url().$species_image;?>">
	      	<div id="link"><h4 class='ui-widget-header info_box_header text ui-widget-content ui-corner-all'><?php 
	      		echo '<br>';
	      		echo anchor('version2/edit_gallery/'.$taxon_id, 'Gallery',array('style'=>'font-size: 19px;'));
	      		echo '<br>';
	      	?></h4></div>

	      	
	      	

	      
      	</div>
    <!-- END -->

    <div id="biological_information">
		<b>Step 3. Provide the necessary information</b>
      	
      	

      	<?php echo form_open('user/update_species');?>
      			
			<b><i>Reference Id:<?php echo $reference_code.''.$reference_number;?></i></b>
			<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
			<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>		
			<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
			
      	
      	

		<br/><br/>
  		
  		<label><b>Scientific name: </b></label>
  		<i><?php echo nbs(3).$genus.' '.$species;?></i>
  		<?php echo form_input(array('id'=>'species', 'name'=>'species','type'=>'hidden', 'value'=>$species));?>
		<?php echo form_input(array('id'=>'genus', 'name'=>'genus','type'=>'hidden', 'value'=>$genus));?><br/>
		
  		<label><b>Family: </b></label>
  		<?php echo nbs(17).form_input(array('id'=>'family', 'name'=>'family', 'size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$family));?>
  		<?php echo form_input(array('id'=>'family_id', 'name'=>'family_id','type'=>'hidden', 'value'=>$family_id));?><br/>
  		
  		<label><b>Order: </b></label>
  		<?php echo nbs(18).form_input(array('id'=>'order_name', 'name'=>'order_name', 'size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$order_name));?>
  		<?php echo form_input(array('id'=>'order_id', 'name'=>'order_id','type'=>'hidden', 'value'=>$order_id));?>
  		<br/>
  		
  		<label><b>Class: </b></label>
  		<?php echo nbs(20).form_input(array('id'=>'class', 'name'=>'class', 'size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$class));?>
		<?php echo form_input(array('id'=>'class_id', 'name'=>'class_id','type'=>'hidden', 'value'=>$class_id));?>
  		<br/>
  		
  		 <label><b>Phylum: </b></label>
  		<?php echo nbs(16).form_input(array('id'=>'phylum', 'name'=>'phylum', 'size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$phylum));?>
		<?php echo form_input(array('id'=>'phylum_id', 'name'=>'phylum_id','type'=>'hidden', 'value'=>$phylum_id));?>
		<br/>
		
		 <label><b>Kingdom: </b></label>
		<?php echo nbs(14).form_input(array('id'=>'kingdom', 'name'=>'kingdom', 'size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$kingdom));?>
		<?php echo form_input(array('id'=>'kingdom_id', 'name'=>'kingdom_id','type'=>'hidden', 'value'=>$kingdom_id ));?>	
		<br/>
		
		<label><b>Domain: </b></label>
  		<?php echo nbs(16)?>
		<?php
		if($domain=='Bacteria'){
			echo "<select class='text ui-state-default ui-corner-all' id='domain' name='domain'>";
			echo "<option value='Eukarya'>Eukarya</option>";
			echo "<option value='Bacteria' selected >Bacteria</option>";
			echo "<option value='Archaea'>Archaea</option>";
			echo '</select>';
		}
		else if($domain=='Archaea'){
			echo "<select class='text ui-state-default ui-corner-all' id='domain' name='domain'>";
			echo "<option value='Eukarya'>Eukarya</option>";
			echo "<option value='Bacteria'>Bacteria</option>";
			echo "<option value='Archaea' selected>Archaea</option>";
			echo '</select>';
		}
		else{
			echo "<select class='text ui-state-default ui-corner-all' id='domain' name='domain'>";
			echo "<option value='Eukarya'>Eukarya</option>";
			echo "<option value='Bacteria'>Bacteria</option>";
			echo "<option value='Archaea'>Archaea</option>";
			echo '</select>';
		
		}
		

		
		?>
		<?php echo form_input(array('id'=>'domain_id', 'name'=>'domain_id','type'=>'hidden', 'value'=>$domain_id));?>
		
		<br/>
		<br/>
		
		<table id="">
			<tr>
				<td>
					<label>Species Author:</label>
					<br/>
					<?php echo form_input(array('id'=>'scientificname_author', 'name' => 'scientificname_author','size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>$scientificname_author ));?>
			  		<br/>
					<!--<label>Vernacular Name</label>
			  		<br/>
			  		<?php //echo form_input(array('id'=>'vernacular_name', 'name' => 'vernacular_name','size'=>'25', 'value'=>$vernacular_name ,'class'=>'text ui-state-default ui-corner-all'));?>
					<br/>
					
					<label>Synomyns:</label>
					<br />
					//<?php echo form_input(array('id'=>'synonyms', 'name' => 'synonyms','size'=>'25', 'value'=>$synonyms,'class'=>'text ui-state-default ui-corner-all' ));?>
					<br/> -->
					<label>Conservation Status:</label>
					<br />
					<?php echo form_input(array('id'=>'conservation_status', 'name' => 'conservation_status','size'=>'25', 'value'=>$conservation_status,'class'=>'text ui-state-default ui-corner-all' ));?>
					<br />
					<label>Habitat:</label>
					<br />
					<?php echo form_input(array('id'=>'habitat', 'name' => 'habitat','size'=>'25', 'value'=>$habitat,'class'=>'text ui-state-default ui-corner-all' ));?>
					<br />
				</td>
				<td>
					<?php echo nbs(5);?>
				</td>
				<td>
					<label>General Description</label>
					<br/>
					<?php echo form_textarea(array('id'=>'description', 'name' => 'description', 'rows'=>'4', 'cols'=>'30', 'value'=>$description,'class'=>'text ui-state-default ui-corner-all' ));?>
					<br/>
					<!--<label>Economic Use:</label>
					<br />
					//<?php echo form_input(array('id'=>'economic_use', 'name' => 'economic_use','size'=>'25', 'value'=>$economic_use ,'class'=>'text ui-state-default ui-corner-all'));?>
					<br/>-->
					<label>Reproduction Mode:</label>
					<br/>
					<?php echo form_input(array('id'=>'reproduction_mode', 'name' => 'reproduction_mode','size'=>'25', 'value'=>$reproduction_mode ,'class'=>'text ui-state-default ui-corner-all'));?>
									
					<br /><br />
						
				</td>
				<td>
				<?php echo nbs(5);?>
				</td>
				<td>
					<label>Edited by: </label>admin
					<?php echo form_input(array('id'=>'edited_by', 'name'=>'edited_by','type'=>'hidden', 'value'=>'admin',  'class'=>'text ui-widget-content ui-corner-all'));?>	
					<br/>
					<p>Date:<br/> <input type="text" name="date" id="date" size="30"  class="text ui-state-default ui-corner-all"/></p>

			  		
			  		
				</td>
			</tr>
			
			
		</table>
  		<?php  echo form_submit(array('name'=>'submit','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all'), 'Continue>>');?>
    	<?php echo validation_errors()?>
    	<?php echo form_close();?>
    	
 		<br/>


  	
    </div>
 


