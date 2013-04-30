<div class='main_content'>


<!-- <div class="demo"> -->	
<h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all">Add or Select Reference</h4>
			<div class="text form_margin ">
			<?php echo form_open('user/search_references'); ?>
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
			
		
			<?php echo form_submit(array('name'=>'search','class'=>'text ui-widget-content ui-corner-all'), 'Search');?>
			<?php echo form_close();?>
			</div>
			<br/>
			<?php echo validation_errors();?> 
			<div id="accordion" class="form_margin text">
				<h3><a href="#book">Book</a></h3>
				<?php echo form_open('user/add_book'); ?>
				<div class="text"> 
				 		<p>
					     Please follow the format:
					     	First Author: [SURNAME],[INITIALS].
					     	Other Authors: [INITIALS]. [SURNAME]
					     </p>
						 <br/>
				<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    <div id="dynamicInput" class="text">

					         		<b>Author 1:</b>
						          <!--
						          <input type="text" name="author[]">
						 	    	-->
					    		 <?php echo form_input(array('name'=>'author[]','id'=>'author','value'=> set_value('author[]'),  'class'=>'ui-widget-content ui-corner-all'));?>
						
					</div>
					
					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add author" onClick="addInput('dynamicInput');">
					
					<br/><br/>
					<?php echo '<b>Year: </b>';?>
  					<select class ='ui-widget-content ui-corner-all' name="year" id="year">
					<!-- options generated dynamically -->
					</select>
							<?php 
							echo nbs(3);
							echo form_label('<b>Book Title:</b> ','book_title');
							echo form_input(array('id'=>'book_title','name'=>'book_title','value'=> set_value('book_title'),'class'=>'text ui-widget-content ui-corner-all'));
							echo '<br/><br/>';
							echo form_label('<b>Publisher: [Publishing House]</b>');
							echo nbs(18);
							echo form_label('<b>[Country]</b>');
							echo '<br/>';
							echo nbs(17);
							echo form_input(array('id'=>'publishing_house','name'=>'publishing_house', 'value'=>set_value('publishing_house'),'class'=>'text ui-widget-content ui-corner-all'));
							echo nbs(2);
							echo form_input(array('id'=>'publishing_country','name'=>'publishing_country', 'value'=> set_value('publishing_country'),'class'=>'text ui-widget-content ui-corner-all'));
							?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Book');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Book Chapter</a></h3>
				<?php echo form_open('user/add_book_chapter'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					<br/>
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput2">
						<b>Chapter Author 1:</b><!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'chapter_author[]','id'=>'chapter_author','value'=> set_value('chapter_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Chapter Author" onClick="addInput2('dynamicInput2');">
					
					<br/><br/>
					
					<?php echo '<b>Year:</b> ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_book_chapter" id="year_book_chapter">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo nbs(3);
						echo form_label('<b>Chapter Title:</b> ','chapter_title');
						echo form_input(array('id'=>'chapter_title','name'=>'chapter_title','value'=> set_value('chapter_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Book Title:</b> ','book_title');
						echo form_input(array('id'=>'book_title','name'=>'book_title','value'=> set_value('book_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
					?>
					
					<div id="dynamicInput3">
						<b>Book Author1:</b>
						<?php echo form_input(array('name'=>'book_author[]','id'=>'book_author','value'=> set_value('book_author[]'),'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>
					
					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Book Author" onClick="addInput3('dynamicInput3');">
					
					<?php
						echo '<br/><br/>';
						echo form_label('<b>Publisher: [Publishing House]</b>');
						echo nbs(15);
						echo form_label('<b>[Country]</b>');
						echo '<br/>';
						echo nbs(17);
						echo form_input(array('id'=>'publishing_house','name'=>'publishing_house', 'value'=>set_value('publishing_house'),'class'=>'text ui-widget-content ui-corner-all'));
						echo nbs(2);
						echo form_input(array('id'=>'publishing_country','name'=>'publishing_country', 'value'=> set_value('publishing_country'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
					
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Book Chapter');?>
					<br/><br/><br/>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Journal Article/ Review</a></h3>
				<?php echo form_open('user/add_journal'); ?>
				<div>
					<p>
					Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					<br/>
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput4">
						<b>Journal Author 1:</b><!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'journal_author[]','id'=>'journal_author','value'=> set_value('journal_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Journal Author" onClick="addInput4('dynamicInput4');">
					
					<br/><br/>
					
					<?php echo '<b>Year:</b> ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_journal" id="year_journal">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo '<br/><br/>';
						echo form_label('<b>Review/Article Title:</b> ','article_title');
						echo form_input(array('id'=>'article_title','name'=>'article_title','value'=> set_value('article_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Journal (Journal name volume: pages)</b>');
						echo form_input(array('id'=>'journal','name'=>'journal', 'value'=> set_value('journal'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Journal');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Thesis</a></h3>
				<?php echo form_open('user/add_thesis'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					<br/>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput5">
						<b>Thesis Author 1:</b><!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'thesis_author[]','id'=>'thesis_author','value'=> set_value('thesis_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Thesis Author" onClick="addInput5('dynamicInput5');">
					
					<br/><br/>
					
					<?php echo '<b>Year:</b> ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_thesis" id="year_thesis">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo nbs(3);
						echo form_label('<b>Thesis Title:</b> ','thesis_title');
						echo form_input(array('id'=>'thesis_title','name'=>'thesis_title','value'=> set_value('thesis_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
					?>
						<label><b>Type of Manuscript :</b> </label>
						<select  class ='ui-widget-content ui-corner-all' name='manuscript_type' id='manuscript_type'>
							<option class ='ui-widget-content ' value = 'BSc Thesis'>BSc Thesis</option>
							<option class ='ui-widget-content ' value = 'MSc Thesis'>MSc Thesis</option>
							<option class ='ui-widget-content ' value = 'PhD Dissetation'>PhD Dissertation</option>
						</select>
					<?php
						echo '<br/><br/>';
						echo form_label('<b>Location of Manuscript:</b> ');
						echo form_input(array('id'=>'manuscript_location','name'=>'manuscript_location', 'value'=> set_value('manuscript_location'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Thesis');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Proceedings</a></h3>
				<?php echo form_open('user/add_proceedings'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					<br/>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput6">
						<b>Proceedings Author 1:</b><!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'proceedings_author[]','id'=>'proceedings_author','value'=> set_value('proceedings_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Proceedings Author" onClick="addInput6('dynamicInput6');">
					
					<br/><br/>
					
					<?php 
						echo form_label('<b>Date of Symposium:</b>');
						echo form_input(array('id'=>'day', 'name'=>'day', 'value'=>set_value('day'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
						<label><b>Month:</b> </label>
						<select  class ='ui-widget-content ui-corner-all' name='month' id='month'>
							<option class ='ui-widget-content ' value = 'January'>January</option>
							<option class ='ui-widget-content ' value = 'February'>February</option>
							<option class ='ui-widget-content ' value = 'March'>March</option>
							<option class ='ui-widget-content ' value = 'April'>April</option>
							<option class ='ui-widget-content ' value = 'May'>May</option>
							<option class ='ui-widget-content ' value = 'June'>June</option>
							<option class ='ui-widget-content ' value = 'July'>July</option>
							<option class ='ui-widget-content ' value = 'August'>August</option>
							<option class ='ui-widget-content ' value = 'September'>September</option>
							<option class ='ui-widget-content ' value = 'October'>October</option>
							<option class ='ui-widget-content ' value = 'November'>November</option>
							<option class ='ui-widget-content ' value = 'December'>December</option>
						</select>
					<?php
						echo '<b>Year:</b> ';
					?>
  					<select class ='ui-widget-content ui-corner-all' name="year_proceedings" id="year_proceedings">
					<!-- options generated dynamically -->
					</select>
					<br/><br/>
					<?php 
						echo form_label('<b>Topic Title:</b> ','topic_title');
						echo form_input(array('id'=>'topic_title','name'=>'topic_title','value'=> set_value('topic_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Symposium/Seminar:</b> ');
						echo form_input(array('id'=>'symposium','name'=>'symposium', 'value'=> set_value('symposium'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Venue:</b> ');
						echo form_input(array('id'=>'venue','name'=>'venue', 'value'=> set_value('venue'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Proceedings');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Project Report</a></h3>
				<?php echo form_open('user/add_project_report'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					<br/>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput7">
						<b>Project Report Author 1:</b><!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'project_report_author[]','id'=>'project_report_author','value'=> set_value('project_report_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Project Report Author" onClick="addInput7('dynamicInput7');">
					
					<br/><br/>
					
					<?php echo '<b>Inclusive Years of Project:</b> ';?>
					<select class ='ui-widget-content ui-corner-all' name="year1" id="year1">
						<!-- options generated dynamically -->
					</select>
					<?php echo ' - ';?>
					<select class ='ui-widget-content ui-corner-all' name="year2" id="year2">
						<!-- options generated dynamically -->
					</select>
					<br/><br/>
					<?php 
						echo form_label('<b>Project Title:</b> ','project_title');
						echo form_input(array('id'=>'project_title','name'=>'project_title','value'=> set_value('project_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Institution:</b> ');
						echo form_input(array('id'=>'institution','name'=>'institution', 'value'=> set_value('institution'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Department:</b> ');
						echo form_input(array('id'=>'department','name'=>'department', 'value'=> set_value('department'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/><br/>';
						echo form_label('<b>Funding Agency:</b> ');
						echo form_input(array('id'=>'funding_agency','name'=>'funding_agency', 'value'=> set_value('funding_agency'),'class'=>'text ui-widget-content ui-corner-all'));
		
					?>

					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Project Report');?>
					<?php echo form_close();?>
				</div>
			</div>
			
			<!-- </div>End demo -->


</div>
