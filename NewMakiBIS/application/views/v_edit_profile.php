<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link type="text/css" href="<?php echo base_url();?>jquery/css/body_style.css" rel="stylesheet" />
    <title>MakiBIS</title>
<?php 
 include 'resources.php';
?>
</head>
<body>

<?php 

include 'body_style.php';

?>




<?php 
 include 'header.php';
?>
<div class="container_12 main">

	<div class="container_12 ">
	<hr>
		<div class="grid_2" >
		<?php 
		 include 'v_admin_menu.php';
		?>
		<br>
			<div class="" id="datepicker"></div>
		</div>
		
		<div class="grid_9 view_page">
		<?php 
		 include 'edit_profile.php';
		
		?>
	
		</div>
	</div>
<br>
<hr>

<hr>

</div>




<div id="copyright">Copyright &copy; 2012 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

</body>
</html>