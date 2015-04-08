<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add new department</h2>
<?php echo form_open('admin/add/department'); ?>
<label for="dept_name">Department Name:</label>
<input name="dept_name" type="text" required="yes"/>
<label for="location">Location [This is the physical location of the department (e.g building name, room number etc..) ]:</label>
<input name="location" type="text" required="yes"/>
<label for="has_parent">Has parent:</label>
<input name="has_parent" type="radio"/>Yes <input name="has_parent" type="radio"/>No<br/>
<label for="parent">Parent [Is this department the sub-department of another department?]:</label>
<select name="parent">
<?php foreach($departments as $department){
    echo "<option value=\"{$department['deptid']}\">{$department['deptname']}</option>";
}?>
</select>
<label for="description">Description:</label>
<textarea name="description" rows="8"></textarea>
<label for="clockout">Clock Out Option [Do you to make it mandatory for employees of this department to put a text description of what they have worked when they clock out?]:</label>
<input name="clockout" type="radio"/>Yes <input name="clockout" type="radio"/>No<br />
<label for="messaging">Messaging [Do you to want to allow employees of this department to be able to message each other?]:</label>
<input name="messaging" type="radio"/>Yes <input name="messaging" type="radio"/>No<br />
<button name="action_btn" type="submit" value="submit">Submit</button>
<?php echo form_close(); ?>
</div>
<script>
//TODO: UX for parent option
</script>
<?php echo $this->load->view('blocks/footer'); ?>