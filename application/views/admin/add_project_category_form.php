<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add Project Category</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/add/project_category');?>
<label for="department">Department:</label>
<select name="department">
<?php foreach($departments as $department){
    echo "<option value=\"{$department['deptid']}\">{$department['deptname']}</option>";
}?>
</select>
<label for="project_category_title">Project category title:</label>
<input name="project_category_title" type="text" required="yes"/>
<label for="project_category_desc">Project category description:</label>
<textarea name="project_category_desc" rows="8" required="yes">
</textarea>
<button name="action_btn" type="submit" value="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>