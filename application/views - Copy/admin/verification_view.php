<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> ICSLibrarySystem : Verification </title>
	</head>
	<body>
		<?php echo form_open('admin/verification'); ?>
			  <label>Email</label>
			  <?php echo form_error('email'); ?>
			  <input type="text" name="email" value="<?php echo set_value('email'); ?>"/>
			  <label>Password</label>
			  <?php echo form_error('password'); ?>
			  <input type="text" name="password" value="<?php echo set_value('password'); ?>" />	  
			  <input type="submit" name="submit" value="Submit">
		<?php echo form_close(); ?>
	</body>
</html>