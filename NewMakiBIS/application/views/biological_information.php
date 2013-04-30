<div class="main_content" style="font-size:13px;">
	<b>Step 3. Provide the necessary information</b>
    <?php echo form_open('user/save_species7');?>
      			
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
  	<?php echo nbs(17).$family?>
  	<?php echo form_input(array('id'=>'family', 'name'=>'family','type'=>'hidden', 'value'=>$family));?><br/>
  		
  	<label><b>Order: </b></label>
  	<?php echo nbs(18).$order_name?>
  	<?php echo form_input(array('id'=>'order_name', 'name'=>'order_name','type'=>'hidden', 'value'=>$order_name));?>
  	<br/>
  		
  	<label><b>Class: </b></label>
  	<?php echo nbs(19).$class?>
	<?php echo form_input(array('id'=>'class', 'name'=>'class','type'=>'hidden', 'value'=>$class));?>
  	<br/>
  		
  	<label><b>Phylum: </b></label>
  	<?php echo nbs(15).$phylum?>
	<?php echo form_input(array('id'=>'phylum', 'name'=>'phylum','type'=>'hidden', 'value'=>$phylum));?>
	<br/>
		
	<label><b>Kingdom: </b></label>
  	<?php echo nbs(13).$kingdom?>
	<?php echo form_input(array('id'=>'kingdom', 'name'=>'kingdom','type'=>'hidden', 'value'=>$kingdom));?>
	<br/>
		
	<label><b>Domain: </b></label>
  	<?php echo nbs(15).$domain?>
	<?php echo form_input(array('id'=>'domain', 'name'=>'domain','type'=>'hidden', 'value'=>$domain));?>
	<br/>
	<br/>
		
	<table id="">
		<tr>
			<td>
				<label>Species Author:</label>
				<br/>
				<?php echo form_input(array('id'=>'scientificname_author', 'name' => 'scientificname_author','size'=>'25','class'=>'text ui-state-default ui-corner-all', 'value'=>set_value('scientificname_author') ));?>
		  		<br/>
				<label>Conservation Status:</label>
				<br />
				<?php echo form_input(array('id'=>'conservation_status', 'name' => 'conservation_status','size'=>'25', 'value'=>set_value('conservation_status'),'class'=>'text ui-state-default ui-corner-all' ));?>
				<br />
				<label>Habitat:</label>
				<br />
				<?php echo form_input(array('id'=>'habitat', 'name' => 'habitat','size'=>'25', 'value'=>set_value('habitat'),'class'=>'text ui-widget-content ui-corner-all','class'=>'text ui-state-default ui-corner-all' ));?>
				<br />
			</td>
			<td>
				<?php echo nbs(5);?>
			</td>
			<td>
				<label>General Description</label>
				<br/>
				<?php echo form_textarea(array('id'=>'description', 'name' => 'description', 'rows'=>'4', 'cols'=>'30', 'value'=>set_value('description'),'class'=>'text ui-state-default ui-corner-all' ));?>
				<br/>
				<label>Reproduction Mode:</label>
				<br/>
				<?php echo form_input(array('id'=>'reproduction_mode', 'name' => 'reproduction_mode','size'=>'25', 'value'=>set_value('reproduction_mode') ,'class'=>'text ui-state-default ui-corner-all'));?>
									
				<br /><br />
						
			</td>
			<td>
			<?php echo nbs(5);?>
			</td>
			<td>
				<label>Encoder: </label>admin
				<?php echo form_input(array('id'=>'encoder_name', 'name'=>'encoder_name','type'=>'hidden', 'value'=>'admin',  'class'=>'text ui-state-default ui-corner-all'));?>	
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
 