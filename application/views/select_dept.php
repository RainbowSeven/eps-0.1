<?php echo $this->load->view('blocks/header'); ?>

<?php 
if(isset($admin))
echo $this->load->view('admin/blocks/dashboard');
else
echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Choose a department</h2>
<?php echo form_open($url); ?>
<label for="department">Department:</label>
<select name="deptid">
<?php foreach($departments as $department){
    echo "<option value=".$department['deptid'].">{$department['deptname']}</option>";
}?>
</select>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close(); ?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>