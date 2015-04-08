<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add <?php echo strtolower($employee_type); ?> pay rate for <?php echo $employee_name; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open($controller);?>
<?php if($employee_type == 'salary'){?>
<label for="salary_rate">Salary:</label>
<input name="salary_rate" required="yes" type="text"/>
<label for="base_year">Base year:</label>
<select name="base_year">
<?php foreach(range(date('Y'),date('Y')+5) as $year){
    echo "<option value=\"{$year}\">{$year}</option>";
} ?>
</select>
<?php } else { ?>
<label for="hourly_rate">Hourly rate:</label>
<input name="hourly_rate" required="yes" type="text"/>
<?php } ?>
<label for="note">Description:</label>
<textarea name="note" rows="8"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>