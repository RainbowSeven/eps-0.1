<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add Project in <?php echo $department; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/add/project');?>
<label for="project_category">Project category:</label>
<?php if(is_array($categories)){?>
<select>
<?php foreach($categories as $category){
    echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
}?>
</select>
<?php } 
else 
echo "<p>No categories added yet. "
        .anchor('admin/add/project_category','Add project category')
        ."</p>"

?>
<label for="project_title">Project title:</label>
<input name="project_title" required="yes" type="text"/>
<label for="project_desc">Project description:</label>
<textarea name="project_desc" rows="8"></textarea>
<?php echo anchor('admin/add/project/back','Back','class="button back"');?>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>