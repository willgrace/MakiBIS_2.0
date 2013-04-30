<div class="main_content" style="font-size:13px">
	<b>Step 2. Specify the Taxonomic classification</b>
    <?php echo form_open('user/submit_domain');?>
    <label><i>Reference ID: <?php echo $reference_code.''.$reference_number?></i></label>
      	
	<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
	<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
	<br/>
  		
	<!--<label>Sub-species: </label><br/>
  	<?// echo $sub_species;?>
  	<?php// echo form_input(array('id'=>'subspecies', 'name'=>'subspecies','type'=>'hidden','value'=> set_value('subspecies'),'class'=>'text ui-widget-content ui-corner-all'));?>
  	<br/>  -->	
  	<label>Species: </label>
  	<?php echo $species;?>
  	<?php echo form_input(array('id'=>'species', 'name'=>'species','type'=>'hidden', 'value'=> $species,'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  	<label>Genus: </label>
  	<?php echo $genus;?>
  	<?php echo form_input(array('id'=>'genus', 'name'=>'genus', 'type'=>'hidden','value'=>$genus, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  		
  	<label>Family: </label>
  	<?php echo $family;?>
  	<?php echo form_input(array('id'=>'family', 'name'=>'family', 'type'=>'hidden','value'=>$family, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  				
  	<label>Order: </label>
  	<?php echo $order_name;?>
  	<?php echo form_input(array('id'=>'order_name', 'name'=>'order_name', 'type'=>'hidden','value'=>$order_name, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  		
  	<label>Class: </label>
  	<?php echo $class;?>
  	<?php echo form_input(array('id'=>'class', 'name'=>'class', 'type'=>'hidden','value'=>$class, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  		
  	<label>Phylum: </label>
  	<?php echo $phylum;?>
  	<?php echo form_input(array('id'=>'phylum', 'name'=>'phylum', 'type'=>'hidden','value'=>$phylum, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  		
  	<label>Kingdom: </label>
  	<?php echo $kingdom;?>
  	<?php echo form_input(array('id'=>'kingdom', 'name'=>'kingdom', 'type'=>'hidden','value'=>$kingdom, 'class'=>'text ui-widget-content ui-corner-all'));?><br/>
  		
  	<label>*Domain</label><br/>
  	<select class='text ui-state-default ui-corner-all' id='domain' name='domain'>
  		<option value='Eukarya'>Eukarya</option>
  		<option value='Bacteria'>Bacteria</option>
  		<option value='Archaea'>Archaea</option>
  	</select>
  	<br/><br/>
	
	<?php  echo form_submit(array('name'=>'submit','class'=>'text ui-state-default ui-corner-all'), 'Continue>>');?>
     	
    <?php echo validation_errors()?>
 	<br/>

</div>