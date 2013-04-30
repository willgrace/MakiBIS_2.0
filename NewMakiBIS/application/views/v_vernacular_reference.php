<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>MakiBIS</title>
<?php 
 include 'resources.php';
?>
<script type="text/javascript">
	//THIS IS FOR THE "YEAR" DROPDOWN
function populateYearSelect()
{
    d = new Date();
    curr_year = d.getFullYear();
 
    for(i = 0; i < 500; i++)
    {
        document.getElementById('year').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year1').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year2').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year_book_chapter').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year_journal').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year_thesis').options[i] = new Option(curr_year-i,curr_year-i);
		document.getElementById('year_proceedings').options[i] = new Option(curr_year-i,curr_year-i);
    }
}
</script>
</head>
<body onLoad="populateYearSelect()">

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
		
		<div class="grid_10">
		<?php 
		 include 'vernacular_references.php';
		
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