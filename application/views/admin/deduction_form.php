<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add pay deduction for <?php echo $employee_name; ?></h2>
<?php echo validation_errors(); if(isset($message)) echo $message; ?>
<?php echo form_open($controller);?>
<label for="deduction_type">Type of deduction:</label>
<input name="deduction_type" required="yes" type="text"/>
<label for="deduction_date">Date [This field would be set to today's date if left blank]:</label>
<input name="deduction_date" type="text" placeholder="YYYY-MM-DD"/>
<label for="amount">Amount:</label>
<input name="amount" required="yes" type="text"/>
<label for="note">Description:</label>
<textarea name="note" rows="8"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>