<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add IP address restriction</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/add/ip_access_rule/'.$specifier);?>
<?php if($specifier == 'department') {?>
<label for="department">Department:</label>
<select name="department">
<?php foreach($departments as $department){
    echo "<option value=\"{$department['deptid']}\">{$department['deptname']}</option>";
}?>
</select>
<?php } else { ?>
<?php } ?> 
<label for="address_sequence">IP Address Sequence:</label>
<input name="address_sequence" type="text" placeholder="000.000.000.000" required="yes"/>
(e.g 130.74.96.*)
Note that wildcards can be used. e.g * means all the whole range of numbers from 1-255 of an IP address. 
<label for="address_desc">IP Description:</label>
<textarea name="address_desc" rows="8" required="yes"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>