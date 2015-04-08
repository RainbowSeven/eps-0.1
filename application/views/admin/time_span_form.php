<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2><?php echo $title;?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open($controller);?>
<label for="start_date">Start date:</label>
<input name="start_date" type="date" required="yes" placeholder="YYYY-MM-DD"/>
<label for="end_date">End date:</label>
<input name="end_date"  type="date" required="yes" placeholder="YYYY-MM-DD"/>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>