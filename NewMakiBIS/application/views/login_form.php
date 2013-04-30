<div class="main_content grid_5 push_2 ">

<h4 class="ui-widget-header info_box_header text ui-widget-content ui-corner-all">Log In</h4>
<div class="info_box_header text ">
<div class="grid_1">
<?php echo form_open('user/admin_login'); ?>
<?php
   /*	echo form_label('Username:',array('class'=>'text ui-widget-content ui-corner-all') );
   	echo '<br>';
	echo form_label('Password:',array('class'=>'text ui-widget-content ui-corner-all') );
	echo '<br>';
	echo '<br>';
	*/

?>
</div>

<div class="grid_1">
<div class="form_margin">
	<center>Username
	<?php 
		echo form_input(array('id'=> 'textbox1', 'name'=>'username', 'class'=>'ui-widget-content ui-corner-all'));
	?>
	</center>
</div>
<div class="form_margin">
	<center>Password
	<?php 
		echo form_input(array('type'=>'password','id'=> 'textbox2', 'name'=>'password', 'class'=>'ui-widget-content ui-corner-all'));
	?>
	</center>
	<?php 	
		echo '<br>';
		echo form_submit(array('id'=>'loginbutton','name'=>'submit','class'=>"ui-button ui-state-default ui-corner-all"), 'Login');
		echo form_close();
	?>

<!--
<?php //echo form_open('user/signup_page'); ?>

<center>
<?php 	//echo form_label('or',array('class'=>'text ui-widget-content ui-corner-all') );?>
<?php //echo form_submit(array('id'=>'signup','name'=>'submit','class'=>"ui-button ui-state-default ui-corner-all"), 'Sign Up');?>
</center>
<?php //form_close();?> -->
</div>

					

					
</div>


</div>
<div>

<hr>
<center><b><?php echo $message;?></b></center>
</div>

</div>
