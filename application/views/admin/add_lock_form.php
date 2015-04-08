<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add lock to <?php echo $employee_name; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open($controller);?>
<label for="lock_message">Lock message:</label>
<textarea name="lock_message" required="yes" rows="8" placeholder="Please put the lock message you want the employee to see when he/she tries to log in"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>