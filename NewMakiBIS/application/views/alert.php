<?php include 'resources.php'; ?>

<div id="species_image" style="float:right;">
	  	<?php $id = 1; /* to identify the taxon id */?> 
	   	<?php echo form_open_multipart('version2/ajax_lookUpUsername');?>
		<input type="file" name="userfile" size="50" /><br>
		
		<?php
			$name = 'images/species/3rakdj.jpg';
			$js = 'onClick="lookUpUsername()"';
			echo form_submit('image', 'Add Picture', $js);
			echo form_close();
		?>
		<br><br><br>
    </div>


