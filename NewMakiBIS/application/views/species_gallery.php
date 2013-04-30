
<?php	//take the scientific name of the current species
	foreach ($data2 as $d) {
		$genus = $d['genus'];
		$species = $d['species'];
		//echo nbs(3).$d['genus'].' '.$d['species'];
	}

	$taxon_id = $this->uri->segment(3); 
	echo"<div id='genus_link'>";
	echo "<h4 class='ui-widget-header info_box_header text ui-widget-content ui-corner-all'>";
	echo anchor('user/species_profile/'.$taxon_id, $genus.' '.$species);	//link to the profile of the species
	echo "</h4></div>";
?>

 
<div id="page">

<div id="gallery">
	<div id="panel">


	<?php
		$ctr = 0;
		$ctr2=-1;
		if($data == NULL)
			echo 'No images found';
		foreach ($data as $d) { 
		$image_loc = base_url().$d['image_location'];
			echo "<img id='largeImage' style='width:565px; height:350px;' src=".$image_loc." />";
				echo"<div id='desc'>";	
				$desc = $d['description'];
				echo '<br>'.$desc;
				echo "</div>
			</div>
			<br />
			<div id='thumbs'>";
			break;
		}
		foreach ($data as $d) { 
			
			$desc = $d['description'];
			$page="";
			
			$image_loc = base_url().$d['image_location'];
			
			$image_loc1 = "<img alt='".$desc."' class='prodimg' style='width:150px; height:150px;' src=".$image_loc.">"; 
			echo $image_loc1;
			$ctr++;

		}
	?>

	</div>
</div>

</div>

<script>

$('#thumbs').delegate('img','click', function(){
	$('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
	$('#desc').html($(this).attr('alt'));
});

</script>

  
