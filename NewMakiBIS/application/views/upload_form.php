<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>


<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />
<input type="submit" value="upload" />





<br /><br />



</form>

</body>
</html>