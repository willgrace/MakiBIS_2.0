<div id="reference_list">
	<table id="records" border = "1">
		<td><b>Type</b><hr/></td>
 		<td><center><b>References</b></center><hr/></td>
		<td><b>Code</b><hr/></td>
	
    	<?php
    		
			$reference_query = $this->user_model->get_reference_book();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Book</b></td>';
					echo '<td>';
					$id = $row->Reference_book_id;
					$author = $row->Author;
					$year = $row->Year_published;
					$title = $row->Book_title;
					$publisher = $row->Publisher;
					$reference_code = $row->Reference_code;
					$country = $row->Country;
					echo '<b>'.$author.'. '.$year.'</b> . '.$title.'. '.$publisher.':'.$country;
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
			////////////////////////
			$reference_query = $this->user_model->get_reference_book_chapter();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Book Chapter</b></td>';
					echo '<td>';
					$id = $row->Reference_book_chapter_id;
					$author = $row->Author;
					$year = $row->Year_published;
					$chapter_title = $row->Chapter_title;
					$book_title = $row->Book_title;
					$book_author = $row->Book_author;
					$publisher = $row->Publisher;
					$reference_code = $row->Reference_code;
					$country = $row->Country;

					echo '<b>'.$author.'</b> . '.$year.'. '.$chapter_title.'. In.:<b>'.$book_author.'</b> (eds) '.$book_title.'. '.$publisher.':'.$country;
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
			//////////////////////////
			$reference_query = $this->user_model->get_reference_journal();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Journal</b></td>';
					echo '<td>';
					$id = $row->Reference_journal_id;
					$author = $row->Author;
					$year = $row->Year_published;
					$article_title = $row->Article_title;
					$journal_name = $row->Journal_name;
					$reference_code = $row->Reference_code;
					echo '<b>'.$author.' . '.$year.'</b>. '.$article_title.'. '.$journal_name;
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
			/////////////////////
			$reference_query = $this->user_model->get_reference_proceedings();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Proceedings</b></td>';
					echo '<td>';
					$id = $row->Reference_proceedings_id;
					$author = $row->Author;
					$date = $row->Date;
					$year = $row->Year;
					$topic_title = $row->Topic_title;
					$symposium = $row->Symposium;
					$venue = $row->Venue;
					$reference_code = $row->Reference_code;					
					echo '<b>'.$author.'</b>'.$date.' '.$year.'.'.$topic_title.'.'.$symposium.':'.$venue;								
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
			///////////////////////
			$reference_query = $this->user_model->get_reference_project_report();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Project Report</b>';
					echo nbs(6);
					echo '</td>';
					echo '<td>';
					$id = $row->Reference_project_report_id;
					$author = $row->Author;
					$year = $row->Project_year;
					$institution = $row->Institution;
					$department = $row->Department;
					$funding_agency = $row->Funding_agency;
					$reference_code = $row->Reference_code;
					$project_title = $row->Project_title;
					echo '<b>'.$author.'</b>'.$year.'.'.$institution.'.'.$department.'.'.$funding_agency;
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
			////////////////////
			$reference_query = $this->user_model->get_reference_thesis();
			if(!$reference_query){
				//echo 'No Books Found';
			}else{
				foreach ($reference_query->result() as $row ){
					
					echo '<tr>';
					echo '<td><b>Thesis</b></td>';
					echo '<td>';
					$author = $row->Author;
					$year = $row->Year_published;
					$title = $row->Thesis_title;
					$type = $row->Type;
					$location = $row->Location;
					$reference_code = $row->Reference_code;
					$id = $row->Reference_thesis_id;
					echo '<b>'.$author.'</b> '.$year.'. '.$title.'. '.$type.':'.$location;
					echo '</td><td>';
					if ($this->session->userdata('logged_in_admin'))
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					else
						echo nbs(5).$reference_code.$id;
					echo '</td></tr>';
				}
			}
					
		?>
								
    </table>
    </div>