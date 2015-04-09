<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add sick day for <?php echo $employee_name; ?></h2>
<?php echo validation_errors(); if(isset($message)) echo $message; ?>
<?php echo form_open($controller);?>
<label for="datesick">Date:</label>
<input name="datesick" required="yes" type="date" placeholder="YYYY-MM-DD"/>
<label for="amount">Amount:</label>
<input name="amount" type="text" required="yes"/>
<label for="note">Description:</label>
<textarea name="note" rows="8"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>