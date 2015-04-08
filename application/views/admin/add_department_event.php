<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add Event</h2>
<?php if(isset($message)){
    echo "<p>{$message}</p>";
}?>
<?php echo form_open('admin/add/event');?>
<label for="department">Department:</label>
<select name="department">
<?php foreach($departments as $department){
    echo "<option value=\"{$department['deptid']}\">{$department['deptname']}</option>";
}?>
</select>
<label for="event_date">Event date:</label>
<input name="event_date" type="date" required="yes" placeholder="yyyy-mm-dd"/>
<label for="event_time">Event time [Specify event time in 24 hours format]:</label>
<input name="event_time" type="time" required="yes" placeholder="hh:mm"/>

<label for="event_desc">Event description:</label>
<textarea name="event_desc" required="yes" rows="8"></textarea>
<label for="expiry_date">Event expiry date:</label>
<input name="expiry_date" type="date" placeholder="yyyy-mm-dd"/>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>