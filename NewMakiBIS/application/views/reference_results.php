    <div class="main_content " >
	    <table id="records" style="font-size:13px;">
 				<td><h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all">References <br></h4></td>
				<td><h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all">Code<br></h4></td>
				
		<?php 
		if($results==false){
			echo '<tr>';
				echo '<td>';
					echo 'No results Found';
				echo '</td>';
			echo '</tr>';
		}
		else{
			foreach ($results as $row ){
			
				echo '<tr>';
					echo '<td>';
						if($reference_type == 'reference_thesis'){
							$author = $row->Author;
							$year = $row->Year_published;
							$title = $row->Thesis_title;
							$type = $row->Type;
							$location = $row->Location;
							$reference_code = $row->Reference_code;
							$id = $row->Reference_thesis_id;
							echo '<b>'.$author.'</b> '.$year.'. '.$title.'. '.$type.':'.$location;	
								echo '<hr>';
						}elseif ($reference_type == 'reference_book'){
							$id = $row->Reference_book_id;
							$author = $row->Author;
							$year = $row->Year_published;
							$title = $row->Book_title;
							$publisher = $row->Publisher;
							$reference_code = $row->Reference_code;
							$country = $row->Country;
							echo '<b>'.$author.'. '.$year.'</b> . '.$title.'. '.$publisher.':'.$country;
								echo '<hr>';
						}elseif ($reference_type == 'reference_book_chapter'){
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
							echo '<hr>';
						}elseif ($reference_type == 'reference_journal'){
							$id = $row->Reference_journal_id;
							$author = $row->Author;
							$year = $row->Year_published;
							$article_title = $row->Article_title;
							$journal_name = $row->Journal_name;
							$reference_code = $row->Reference_code;
							
							echo '<b>'.$author.' . '.$year.'</b>. '.$article_title.'. '.$journal_name;
								echo '<hr>';
							
						}elseif($reference_type == 'reference_proceedings'){
							$id = $row->Reference_proceedings_id;
							$author = $row->Author;
							$date = $row->Date;
							$year = $row->Year;
							$topic_title = $row->Topic_title;
							$symposium = $row->Symposium;
							$venue = $row-Venue;
							$reference_code = $row->Reference_code;
							
							echo '<b>'.$author.'</b>'.$date.' '.$year.'.'.$topic_title.'.'.$symposium.':'.$venue;
								echo '<hr>';
							
						}elseif ($reference_type == 'reference_project_report'){
							$id = $row->Reference_project_report_id;
							$author = $row->Author;
							$year = $row->Project_year;
							$institution = $row->Institution;
							$department = $row->Department;
							$funding_agency = $row->Funding_agency;
							$reference_code = $row->Reference_code;
							$project_title = $row->Project_title;
							
							echo '<b>'.$author.'</b>'.$year.'.'.$institution.'.'.$department.'.'.$funding_agency;
								echo '<hr>';
						}
						
					
					echo '</td>';
					
					echo '<td>';
					if($flag=='vernacular'){
						echo nbs(5).anchor('user/vernacular_name/'.$taxon_id.'/'.$id.'/'.$reference_code, $reference_code.''.$id );
					}
					else if($flag=='econuse'){
						echo nbs(5).anchor('user/economic_use/'.$taxon_id.'/'.$id.'/'.$reference_code, $reference_code.''.$id );
					}
					else if($flag=='synonyms'){
						echo nbs(5).anchor('user/synonyms/'.$taxon_id.'/'.$id.'/'.$reference_code, $reference_code.''.$id );
					}
					else{
						echo nbs(5).anchor('user/add_species/'.$id.'/'.$reference_code, $reference_code.''.$id );
					}
					echo '</td>';
				echo '</tr>';
		
			}
		}		
		?>
    </table>
	<p><?php echo $links; //links for pagination?></p>
  	
    </div>