<?php echo $this->load->view( 'blocks/header' ); ?>
<?php echo $this->load->view( 'blocks/dashboard' ); ?>
<div id="main" class="">
<h2>Change your password</h2>
<?php echo '<p class="' . $class . '">' . $msg . '</p>'; ?>
<?php echo form_open( 'perform/password_change' ); ?>
<label for="old_password">Enter old password:</label>
<input name="old_password" type="password"/>
<label for="new_password">Enter new password:</label>
<input name="new_password" type="password"/>
<button name="action_btn" type="submit" value="change">Change Password</button>
<?php echo form_close(); ?>
</div>
<?php echo $this->load->view( 'blocks/footer' ); ?>