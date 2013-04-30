<div class="main_content grid_5 push_2 info_box_header text">
<hr>
						<?php echo form_open('user/signup_validation'); ?>
						<table border ="0">
							<tr>
								<td>First Name:</td>
								<td><?php echo form_input(array('id'=>'fname','name'=>'fname','class'=>'ui-widget-content ui-corner-all', 'value'=> set_value('fname')));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('fname'); ?></td>
							</tr>
							<tr>
								<td>Middle Name:</td>
								<td><?php echo form_input(array('id'=>'mname','name'=>'mname','class'=>'ui-widget-content ui-corner-all','value'=> set_value('mname')));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('mname'); ?></td>
							</tr>
							<tr>
								<td>Last Name:</td>
								<td><?php echo form_input(array('id'=>'lname','name'=>'lname','class'=>'ui-widget-content ui-corner-all','value'=> set_value('lname')));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('lname'); ?></td>
								</tr>
							<tr>
								<td>Username:</td>
								<td><?php echo form_input(array('id'=>'username','name'=>'username','class'=>'ui-widget-content ui-corner-all','value'=> set_value('username')));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('username'); ?></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><?php echo form_password(array('id'=>'password','name'=>'password','class'=>'ui-widget-content ui-corner-all'));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('password'); ?></td>
							</tr>
							<tr>
								<td>Confirm Password:</td>
								<td><?php echo form_password(array('id'=>'confirmpw','name'=>'confirmpw','class'=>'ui-widget-content ui-corner-all'));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('comfirmpw'); ?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo form_input(array('id'=>'email','name'=>'email','class'=>'ui-widget-content ui-corner-all','value'=> set_value('email')));?></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('email'); ?></td>
							</tr>
							<tr>
								<td>Gender:</td>
								<td>
								<?php echo form_radio(array('name'=> 'gender','id'=> 'gender','value'=> 'male','checked'=> TRUE));?>Male
								<?php echo form_radio(array('name'=> 'gender','id'=> 'gender','value'=> 'female'));?>Female
								 </td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('gender'); ?></td>
							</tr>
							<tr>
								<td>Birthday:</td>
								<td><input type="text" name="birthday" id="birthday"   class="text ui-widget-content ui-corner-all"/></td>
								<td style='color:red; font-size: 12px;'><?php echo form_error('birthday'); ?></td>
							</tr>
							<tr>
								<td>Location:</td>
								<td><input name = "location" class = "ui-widget-content ui-corner-all" type = "text"/></td>
							
							</tr>
							
							<tr>
								<td>Role:</td>
								<td>
								<?php echo form_radio(array('name'=> 'role','id'=> 'role','value'=> 'admin'));?>Admin
								<?php echo form_radio(array('name'=> 'role','id'=> 'role','value'=> 'student','checked'=> TRUE));?>Student
								</td>
							</tr>
				
							
						</table>
					<div style='padding-left: 70px; padding-top: 20px'>
					<?php echo form_submit(array('id'=>'submit','name'=>'submit','class'=>'ui-button ui-state-default ui-corner-all'),'Submit');?>
						
					</div>
							
						<?php echo form_close();?>
						<br>
<hr>						
</div>