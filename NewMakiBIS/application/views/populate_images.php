<!--Grace -->
    <div id="species_image" style="float:right;">
	   	
	   	<?php $id = 1; /*$this->uri->segment(3);*/ /* to identify the taxon id */?> 
	   	<?php echo form_open_multipart('upload/pop_upload/'.$id);?>
		<input type="file" name="userfile" size="15" /><br>
		<input type="submit" value="Change/Upload Picture" /><br><br><br>
    </div>
<!-- END -->