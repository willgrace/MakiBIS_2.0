<script src="/wp-includes/js/confirmDelete.js" language="Javascript" type="text/javascript"></script>
<table id="records">
	<tr>
		<td><b>Scientific Name</b><br/><br/></td>
	</tr>
	<tr>
		<td>
		<?php
			if($results==false){
				echo 'No results Found';
			}else{
				foreach ($results as $row ){
					$species= $row->genus." ".$row->species;
					$taxon_id=$row->taxon_id;															
					echo '<tr>';
						echo '<td>';								
							echo anchor('user/species_profile/'.$taxon_id,$species );
							echo '<br/><br/>';
						echo '</td>';
						echo '<td>';
							if ($this->session->userdata('logged_in_admin')){
								echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. anchor('user/edit_profile/'.$taxon_id,'Edit');
								
							}
						echo '</td>';
						echo '<td>';
							if ($this->session->userdata('logged_in_admin')){
								echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. anchor('user/delete_profile/'.$taxon_id,'Delete',array('class' => 'delete', 'title'=>"$species"));
								//echo form_open('user/delete_profile');
								//echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.form_input(array('id'=>'taxon_id','name'=>'taxon_id', 'value'=>$taxon_id,'type'=>'hidden','class'=>'text ui-widget-content ui-corner-all'));
								//echo '<input type="submit" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Delete" onClick="confirmDelete();">';
								//echo form_close();
							}
						
						
						echo '</td>';
					echo '</tr>';
				}
				//echo '<input type="button" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" value="Add Chapter Author" onClick="confirmDelete();">';
			}										
		?>
		</td>
	</tr>
</table>
<p><?php echo $links; //links for pagination?></p>