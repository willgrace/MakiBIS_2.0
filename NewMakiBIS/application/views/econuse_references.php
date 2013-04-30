<div class="main_content">	
<h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all"> Add Reference</h4>		
			<?php echo validation_errors();?> 
			<div id="accordion" class="form_margin text">
				<h3><a href="#book">Book</a></h3>
				<?php echo form_open('user/add_other_book'); ?>
				<div class="text"> 
				 		<p>
					     Please follow the format:
					     	First Author: [SURNAME],[INITIALS].
					     	Other Authors: [INITIALS]. [SURNAME]
					     </p>
				<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    <div id="dynamicInput" class="text">

					         		Author 1:
						          <!--
						          <input type="text" name="author[]">
						 	    	-->
					    		 <?php echo form_input(array('name'=>'author[]','id'=>'author','value'=> set_value('author[]'),  'class'=>'ui-widget-content ui-corner-all'));?>
						
					</div>
					
					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add author" onClick="addInput('dynamicInput');">
					
					<br/>
					<?php echo 'Year: ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year" id="year">
					<!-- options generated dynamically -->
					</select>
							<?php 
							echo form_label('Book Title: ','book_title');
							echo form_input(array('id'=>'book_title','name'=>'book_title','value'=> set_value('book_title'),'class'=>'text ui-widget-content ui-corner-all'));
							echo '<br/>';
							echo form_label('Publisher: [Publishing House]');
							echo nbs(10);
							echo form_label('[Country]');
							echo '<br/>';
							echo nbs(17);
							echo form_input(array('id'=>'publishing_house','name'=>'publishing_house', 'value'=>set_value('publishing_house'),'class'=>'text ui-widget-content ui-corner-all'));
							echo nbs(2);
							echo form_input(array('id'=>'publishing_country','name'=>'publishing_country', 'value'=> set_value('publishing_country'),'class'=>'text ui-widget-content ui-corner-all'));
							echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
							echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
							?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Book');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Book Chapter</a></h3>
				<?php echo form_open('user/add_other_book_chapter'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>

					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput2">
						Chapter Author 1:<!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'chapter_author[]','id'=>'chapter_author','value'=> set_value('chapter_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Chapter Author" onClick="addInput2('dynamicInput2');">
					
					<br/>
					
					<?php echo 'Year: ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_book_chapter" id="year_book_chapter">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo form_label('Chapter Title: ','chapter_title');
						echo form_input(array('id'=>'chapter_title','name'=>'chapter_title','value'=> set_value('chapter_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Book Title: ','book_title');
						echo form_input(array('id'=>'book_title','name'=>'book_title','value'=> set_value('book_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
					?>
					
					<div id="dynamicInput3">
						Book Author1:
						<?php echo form_input(array('name'=>'book_author[]','id'=>'book_author','value'=> set_value('book_author[]'),'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>
					
					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Book Author" onClick="addInput3('dynamicInput3');">
					
					<?php
						echo '<br/>';
						echo form_label('Publisher: [Publishing House]');
						echo nbs(10);
						echo form_label('[Country]');
						echo '<br/>';
						echo nbs(17);
						echo form_input(array('id'=>'publishing_house','name'=>'publishing_house', 'value'=>set_value('publishing_house'),'class'=>'text ui-widget-content ui-corner-all'));
						echo nbs(2);
						echo form_input(array('id'=>'publishing_country','name'=>'publishing_country', 'value'=> set_value('publishing_country'),'class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
					?>
					
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Book Chapter');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Journal Article/ Review</a></h3>
				<?php echo form_open('user/add_other_journal'); ?>
				<div>
					<p>
					Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput4">
						Journal Author 1:<!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'journal_author[]','id'=>'journal_author','value'=> set_value('journal_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Journal Author" onClick="addInput4('dynamicInput4');">
					
					<br/>
					
					<?php echo 'Year: ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_journal" id="year_journal">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo '<br/>';
						echo form_label('Review/Article Title: ','article_title');
						echo form_input(array('id'=>'article_title','name'=>'article_title','value'=> set_value('article_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Journal (Journal name volume: pages)');
						echo form_input(array('id'=>'journal','name'=>'journal', 'value'=> set_value('journal'),'class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Journal');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Thesis</a></h3>
				<?php echo form_open('user/add_other_thesis'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput5">
						Thesis Author 1:<!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'thesis_author[]','id'=>'thesis_author','value'=> set_value('thesis_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Thesis Author" onClick="addInput5('dynamicInput5');">
					
					<br/>
					
					<?php echo 'Year: ';?>
  					<select class ='ui-widget-content ui-corner-all' name="year_thesis" id="year_thesis">
					<!-- options generated dynamically -->
					</select>
					
					<?php 
						echo form_label('Thesis Title: ','thesis_title');
						echo form_input(array('id'=>'thesis_title','name'=>'thesis_title','value'=> set_value('thesis_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
					?>
						<label>Type of Manuscript : </label>
						<select  class ='ui-widget-content ui-corner-all' name='manuscript_type' id='manuscript_type'>
							<option class ='ui-widget-content ' value = 'BSc Thesis'>BSc Thesis</option>
							<option class ='ui-widget-content ' value = 'MSc Thesis'>MSc Thesis</option>
							<option class ='ui-widget-content ' value = 'PhD Dissetation'>PhD Dissertation</option>
						</select>
					<?php
						echo '<br/>';
						echo form_label('Location of Manuscript: ');
						echo form_input(array('id'=>'manuscript_location','name'=>'manuscript_location', 'value'=> set_value('manuscript_location'),'class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Thesis');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Proceedings</a></h3>
				<?php echo form_open('user/add_other_proceedings'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput6">
						Proceedings Author 1:<!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'proceedings_author[]','id'=>'proceedings_author','value'=> set_value('proceedings_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Proceedings Author" onClick="addInput6('dynamicInput6');">
					
					<br/>
					
					<?php 
						echo form_label('Date of Symposium:');
						echo form_input(array('id'=>'day','name'=>'day','value'=> set_value('day'),'class'=>'text ui-widget-content ui-corner-all'));
					?>
						<label>Month: </label>
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
						echo 'Year: ';
					?>
  					<select class ='ui-widget-content ui-corner-all' name="year_proceedings" id="year_proceedings">
					<!-- options generated dynamically -->
					</select>
					<br/>
					<?php 
						echo form_label('Topic Title: ','topic_title');
						echo form_input(array('id'=>'topic_title','name'=>'topic_title','value'=> set_value('topic_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Symposium/Seminar: ');
						echo form_input(array('id'=>'symposium','name'=>'symposium', 'value'=> set_value('symposium'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Venue: ');
						echo form_input(array('id'=>'venue','name'=>'venue', 'value'=> set_value('venue'),'class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
					?>
					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Proceedings');?>
					<?php echo form_close();?>
				</div>
				<h3><a href="#">Project Report</a></h3>
				<?php echo form_open('user/add_other_project_report'); ?>
				<div>
					<p>
						Please follow the format:
						First Author: [SURNAME],[INITIALS].
					    Other Authors: [INITIALS]. [SURNAME]
					</p>
					
					<script src="/wp-includes/js/addInput.js" language="Javascript" type="text/javascript"></script>
				    
					<div id="dynamicInput7">
						Project Report Author 1:<!--<input type="text" name="author[]">-->
					    <?php echo form_input(array('name'=>'project_report_author[]','id'=>'project_report_author','value'=> set_value('project_report_author[]'),  'class'=>'text ui-widget-content ui-corner-all'));?>
					</div>

					<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Project Report Author" onClick="addInput7('dynamicInput7');">
					
					<br/>
					
					<?php echo 'Inclusive Years of Project: ';?>
					<select class ='ui-widget-content ui-corner-all' name="year1" id="year1">
						<!-- options generated dynamically -->
					</select>
					<?php echo ' - ';?>
					<select class ='ui-widget-content ui-corner-all' name="year2" id="year2">
						<!-- options generated dynamically -->
					</select>
					<br />
					<?php 
						echo form_label('Project Title: ','project_title');
						echo form_input(array('id'=>'project_title','name'=>'project_title','value'=> set_value('project_title'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Institution: ');
						echo form_input(array('id'=>'institution','name'=>'institution', 'value'=> set_value('institution'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Department: ');
						echo form_input(array('id'=>'department','name'=>'department', 'value'=> set_value('department'),'class'=>'text ui-widget-content ui-corner-all'));
						echo '<br/>';
						echo form_label('Funding Agency: ');
						echo form_input(array('id'=>'funding_agency','name'=>'funding_agency', 'value'=> set_value('funding_agency'),'class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'flag','name'=>'flag', 'value'=> 'econuse','type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
						echo form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
					?>

					<br/>
					<br/>
					<?php echo form_submit(array('name'=>'submit','class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all"), 'Save Project Report');?>
					<?php echo form_close();?>
				</div>
			</div>
			
			<!-- </div>End demo -->
</div>
