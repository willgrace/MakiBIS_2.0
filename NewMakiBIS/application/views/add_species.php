<div class="main_content" style="font-size:13px">
	<b>Step 2. Specify the Taxonomic classification</b>
    <?php echo form_open('user/submit_species');?>
    <label><i>Reference ID: <?php echo $reference_code.''.$reference_number?></i></label>
      	
	<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
	<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
	<br/>
  		
  	<!--<label>Sub-species: </label><br/>
  	<?php// echo form_input(array('id'=>'subspecies', 'name'=>'subspecies','value'=> set_value('subspecies'),'class'=>'text ui-widget-content ui-corner-all'));?>
  	<br/>  -->	
  	<label>*Species: </label><br/>
  	<?php echo form_input(array('id'=>'species', 'name'=>'species', 'value'=> set_value('species'),'class'=>'text ui-state-default ui-corner-all'));?><br/>
  	<label>*Genus</label><br/>
  	<?php echo form_input(array('id'=>'genus', 'name'=>'genus', 'value'=>set_value('genus'), 'class'=>'text ui-state-default ui-corner-all'));?><br/>
  	<br>
  	<?php  echo form_submit(array('name'=>'submit','class'=>'ui-button ui-widget ui-state-default ui-corner-all'), 'Continue>>');?>
     	
    <?php echo validation_errors()?>
 	<br/>
    <?php if($existing == TRUE){
 		echo "Species Existing! Check your data.";
 	}?>
    </div>