<!--<div class="row">     		
    <div id="error" class= "alert alert-danger col-xs-6 col-md-11">
    <button id="error2" type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
   	<?php echo validation_errors('<p class="error">'); ?>
    </div>
</div>
<!--<?php echo form_open("update_email"); ?>-->


<form id="emailForm" method="post">
		<i class="glyphicon glyphicon-send"></i> Email Address:&nbsp;
		<input id="email" name="email" type="text" value="<?php echo $this->session->userdata('email'); ?>">&nbsp;
		<label for="email" id ="email_label"><?php echo $this->session->userdata('email'); ?></label>
		<input type="button" id="update_email" value="Update Email" class="btn btn-primary btn-sm" onclick="edit()">
		<input type="button" id="set_email" value="Save" class="btn btn-primary btn-sm" style="display:none;" data-toggle="modal">
		<input type="button" id="cancel" value="Cancel" class="btn btn-primary btn-sm" onclick="cancel_email()" style="display:none;">
		<span id="error_update"> </span>
</form><!--<?php //echo form_close(); ?>-->
	<!--To check if the profile has been successfully updated -->

	<div class="modal fade" id="email_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 class="modal-title" id="myModalLabel">Update Email</h3>
				</div>
				<div class="modal-body">
				  <form class="form-signin" role="form">
				  <h4 class="form-signin-heading">Your email has been successfully updated. </h4>						
				</div>
				<div class="modal-footer">
				  <input href="#ok" data-dismiss="modal" onclick="" type="submit" value="Done" class="btn btn-primary"/>
				  </form>
				</div>
			</div>
		</div>
	</div>
