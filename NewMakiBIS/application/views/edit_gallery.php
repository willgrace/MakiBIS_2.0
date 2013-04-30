
<?php	//take the scientific name of the current species
	foreach ($data2 as $d) {
		$genus = $d['genus'];
		$species = $d['species'];
		//echo nbs(3).$d['genus'].' '.$d['species'];
	}

	$taxon_id = $this->uri->segment(3); 
	echo"<div id='genus_link'>";
	echo "<h4 class='ui-widget-header info_box_header text ui-widget-content ui-corner-all'>";
	echo anchor('user/edit_profile/'.$taxon_id, $genus.' '.$species);	//link to the profile of the species
	echo "</h4></div>";
?> 

 <!-- upload pictures -->
    <div id="species_image_upload" style="width:inherit;height:60px;margin:5px;">
    	<div id="uploadpiccies" style="height:inherit;float:right;">
	   	<?php $id = $this->uri->segment(3); /* to identify the taxon id */?> 
	   	<?php echo form_open_multipart('version2/up_gallery/'.$id);?>
		<input type="file" name="userfile" size="15" /><br>
		<?php
			//$js = 'onSubmit="return alert("Image Uploaded") "';
			echo form_submit(array('class'=>'ui-button ui-widget ui-state-default ui-corner-all', 'name'=>'upload_submit','style'=>'margin-top:5px;'), 'Add Picture');
			echo validation_errors();
			echo form_close();
		?>
		<br><br><br>
	</div>
    </div>
<!-- END -->
<div id="species_image_thumb" style="height:660px;width:705px;overflow:scroll;">
<table>
	<?php
		$ctr = 0;
		$ctr2=-1;
		if($data == NULL)
			echo 'No images found';
		foreach ($data as $d) { 
			//echo $ctr;
			$page="";
			if($ctr%4==0) {
				echo "<tr>";
				$ctr2 = $ctr+3;
			}
			//$page = $this->uri->segment(2); // needed to redirect to the same page
			echo "<td>";
			echo "<div class='img'>";	
				$image_loc = base_url().$d['image_location'];
				$image_loc1 = "<img class='prodimg' style='width:150px; height:150px; border: 2px solid #0c0;
  padding: 4px; ' src=".$image_loc.">";
				$image_edit_cap = base_url().'images/edit-cap.png';
				$image_link1 = "<img class='prodimg' style='width:32px; height:29px; border:none;' src=".$image_edit_cap.">"; 
				$image_set_pic = base_url().'images/set-pic.png';
				$image_link2 = "<img class='prodimg' style='width:32px; height:29px; border:none;' src=".$image_set_pic.">"; 
				$image_delete = base_url().'images/delete.png';
				$image_link3 = "<img class='prodimg' style='width:32px; height:29px; border:none;' src=".$image_delete.">"; 
				
				echo $image_loc1;
				
				echo "<div class='desc'>";

					$desc = $d['description'];
					//echo form_textarea(array('id'=>'description', 'name' => 'description', 'rows'=>'4', 'cols'=>'15', 'value'=>$desc));
					//echo '<br>'.$desc;
				echo "</div>";
				
				
				//$image_loc = base_url().'/img/arrow-next.png';
				//$image_loc1 = "<img src=".$image_loc.">";
				//echo anchor('version2/edit_caption/'.$d['species_taxon_id'].'/'.$d['image_id'], 'Edit Caption'/*, array('onclick'=>"return prompt('Insert caption') ")*/);
				
				echo '<br>';
				echo form_open('version2/edit_caption/'.$d['species_taxon_id'].'/'.$d['image_id']);
					echo form_textarea(array('id'=>'description', 'name' => 'description', 'rows'=>'2', 'cols'=>'15', 'value'=>$desc,'class'=>'ui-corner-all','style'=>'border: 2px solid #608341;resize:none; margin-bottom:5px;'));	
					echo '<br />';
					echo form_submit(array('class'=>'ui-button ui-widget ui-state-default ui-corner-all', 'name'=>'caption_submit') , 'Edit Caption');

				echo form_close();
				echo '<br>';
				
				echo anchor('version2/profile_image/'.$d['species_taxon_id'].'/'.$d['image_id'], $image_link2, array('onclick'=>"return alert('Profile Picture Updated') ",'title'=>"Set as profile picture", 'class'=>"anchr"));
				//echo '<br>';
				echo anchor('version2/delete_image/'.$d['species_taxon_id'].'/'.$d['image_id'], $image_link3, array('onclick'=>"return confirm('Are you sure to delete this file?')", 'title'=>"Delete image", 'class'=>"anchr"));		
				
						
				
				
			echo "</div>";
			echo "</td>";
			
			if($ctr==$ctr2)
				echo "</tr>";

			$ctr++;

		}
		
	?>
</table>


