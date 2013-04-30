<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
			if ($this->session->userdata('logged_in_admin'))
				include 'v_admin_menu.php';
			else
				include 'v_main_menu.php';
		?>
		<br>
			<div class="" id="datepicker"></div>
		</div>
		
		<div class="grid_9 view_page">
		<div id='taxon_tree' class="" style="overflow:scroll;height:500px">
			<form id="searchbox" action="">
			    <input id="search" type="text" placeholder="Type here">
			    <input id="submit" type="submit" value="Search">
			</form>
		<?php 
		 
		 include 'taxon_tree.php';

		?>
		</div>
	
		</div>
	</div>
<br>
<hr>
	<div class="container_12">
	<?php 		 include 'main_content.php'; ?>
	
	</div>
<hr>

</div>




<div id="copyright">Copyright &copy; 2012 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

</body>
</html>