<form id="emailForm" method="post">
		<i class="glyphicon glyphicon-send"></i> Email Address:&nbsp;
		<input id="email" name="email" type="text" value="<?php echo $this->session->userdata('email'); ?>">&nbsp;
		<label for="email" id ="email_label"><?php echo $this->session->userdata('email'); ?></label><br/>
		<input type="button" id="update_email" value="Update Email" class="btn btn-primary btn-sm" onclick="edit()">
		<input type="button" id="set_email" value="Save" class="btn btn-primary btn-sm" style="display:none;" data-toggle="modal">
		<input type="button" id="cancel" value="Cancel" class="btn btn-primary btn-sm" onclick="cancel_email()" style="display:none;">
</form>