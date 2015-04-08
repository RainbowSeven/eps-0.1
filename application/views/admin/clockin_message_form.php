<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add Project in <?php echo $department; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/add/clockin_message');?>
<label for="employee">Employee:</label>
<?php if(is_array($employees)){?>
<select name="employee">
<?php foreach($employees as $employee){
    echo "<option value=\"{$employee['empid']}\">{$employee['lastname']} {$employee['firstname']}</option>";
}?>
</select>
<label for="clockin_message">Message:</label>
<textarea name="clockin_message" required="yes" rows="8"></textarea>
<label for="views">Number of views:</label>
<input name="views" type="text" required="yes"/>
<?php echo anchor('admin/add/project/back','Back','class="button back"');?>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php } 
else 
echo "<p>There are no employees in {$department_name}. "
        .anchor('admin/add/employee','Add employee')
        ."</p>"

?>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>