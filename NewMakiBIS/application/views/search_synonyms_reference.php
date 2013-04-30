			<?php echo form_open('user/search_synonyms_references'); ?>
			<label>Search References : </label>
			<select  class ='text ui-widget-content ui-corner-all' name='reference_type' id='reference_type'>
				  <option class ='ui-widget-content ' value = 'reference_book'>Book</option>
				  <option class ='ui-widget-content ' value = 'reference_book_chapter'>Book Chapter</option>
				  <option class ='ui-widget-content ' value = 'reference_journal'>Journal</option>
				  <option class ='ui-widget-content ' value = 'reference_thesis'>Thesis</option>
				  <option class ='ui-widget-content ' value = 'reference_proceedings'>Proceedings</option>
				  <option class ='ui-widget-content ' value = 'reference_project_report'>Project Report</option>
			</select>
			<?php echo form_label("Author: ");?>
			<?php echo form_input(array('id'=>'author', 'name'=>'author', 'class'=>'text ui-widget-content ui-corner-all', 'value'=>set_value('author')));?>
			
			<?php echo form_input(array('id'=>'taxon_id', 'name'=>'taxon_id','type'=>'hidden', 'value'=>$taxon_id ));?>	
			<?php echo form_input(array('id'=>'reference_number', 'name'=>'reference_number','type'=>'hidden', 'value'=>$reference_number ));?>
			<?php echo form_input(array('id'=>'reference_code', 'name'=>'reference_code','type'=>'hidden', 'value'=>$reference_code ));?>
			<?php echo form_submit(array('name'=>'search','class'=>'text ui-widget-content ui-corner-all'), 'Search');?>
			<?php echo form_close();?>