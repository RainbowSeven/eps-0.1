<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employee Search</h2>
<?php echo form_open('perform/search')?>
<p>Please put the name or email or ssn or part of either of the employee you want to search for in the textbox below and the program will search the database for all entries matching your entry.</p>
<label for="needle">Employee name [key]:</label>
<input name="needle" type="text"/>
<button name="action_btn" value="submit">Search</button>
<?php echo form_close(); ?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>