


<div class='main_content'>
<hr>
<b><i>Current reference: <?php echo $reference_code.''.$reference_number;?></i></b>
<?php //echo $taxon_id;?>
<p>if this is not the reference you may change the reference by searching for another one or adding a new one.</p>
<br>
<?php 
include 'search_vernacular_reference.php';
?>

<?php echo form_open('user/vernacular_reference')?>
	<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
	<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
	<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
					
	<?php  echo form_submit(array('name'=>'submit','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all ui-icon-locked'), 'New Reference');?>
	
<?php echo form_close();?>
<br>

 <hr>
 
 		<table id="">
			<?php echo form_open('user/save_vernacular_name');?>
			<tr>
				<td>
					<label>Vernacular Names:</label>
					<br />
					<?php echo form_input(array('id'=>'vernacular_name', 'name' => 'vernacular_name','size'=>'25', 'value'=>set_value('vernacular_name'),'class'=>'text ui-state-default ui-corner-all' ));?>
					<br/>
					<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
					<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
					<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>
					<label><i>Reference ID: <?php echo $reference_code.''.$reference_number?></i></label>
				</td>
				<td>
					<?php echo nbs(5);?>
				</td>
			</tr>	
		</table>
  		<?php  echo form_submit(array('name'=>'submit','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all'), 'Add');?>
    	<?php echo form_close();?>
    	<br><br>
    	<hr>
    	<?php echo form_open('user/skip_vernacular_name');?>
		<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>
		<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
		<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
		<?php echo form_submit(array('name'=>'submit','class'=>'ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all'), '<<Back');?>
		<?php echo validation_errors()?>
		<?php echo form_close();?>

 
</div>