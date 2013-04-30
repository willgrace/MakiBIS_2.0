<table id="records" border = "1">
 	<td><center><b>Type</b></center><hr/></td>
	<td><center><b>Reference</b><center><hr/></td>
	    
    <?php 
		$reference_query = $this->user_model->query_reference($reference_number,$reference_code);
		foreach ($reference_query -> result() as $row ){
					//Some sorf of hard coded but this is the best i can think for now..
					echo '<tr>';
					if($reference_code == 'TR'){
						echo '<td style="padding: 20px"><b>Thesis</b></td>';
						echo '<td>';
						$author = $row->Author;
						$year = $row->Year_published;
						$title = $row->Thesis_title;
						$type = $row->Type;
						$location = $row->Location;
						$reference_code = $row->Reference_code;
						$id = $row->Reference_thesis_id;
						echo '<b>'.$author.'</b> '.$year.'. '.$title.'. '.$type.':'.$location;
						
						
					}elseif ($reference_code == 'B'){
						echo '<td style="padding: 20px"><b>Book</b></td>';
						echo '<td>';
						$id = $row->Reference_book_id;
						$author = $row->Author;
						$year = $row->Year_published;
						$title = $row->Book_title;
						$publisher = $row->Publisher;
						$reference_code = $row->Reference_code;
						$country = $row->Country;
						echo '<b>'.$author.'. '.$year.'</b> . '.$title.'. '.$publisher.':'.$country;
						
						
					}elseif ($reference_code == 'BC'){
						echo '<td style="padding: 20px"><b>Book Chapter</b></td>';
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
						;
						
					}elseif ($reference_code == 'JA'){
						echo '<td style="padding: 20px"><b>Journal</b></td>';
						echo '<td>';
						$id = $row->Reference_journal_id;
						$author = $row->Author;
						$year = $row->Year_published;
						$article_title = $row->Article_title;
						$journal_name = $row->Journal_name;
						$reference_code = $row->Reference_code;
						echo '<b>'.$author.' . '.$year.'</b>. '.$article_title.'. '.$journal_name;
						
					}elseif($reference_code == 'PR'){
						echo '<td style="padding: 20px"><b>Proceedings</b></td>';
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
						
					}elseif ($reference_code == 'PRR'){
						echo '<td style="padding: 20px"><b>Project Report</b></td>';
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
						
					}
					
				
				echo '</td>';
			echo '</tr>';
		
		}		
		?>
    							
</table>