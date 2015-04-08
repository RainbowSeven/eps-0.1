<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Email <?php if(isset($manager_name)) echo $manager_name; else echo $dept_name; ?></h2>
<?php echo form_open('perform/email/'.$recipient);?>
<label for="subject">Subject:</label>
<input name="subject" type="text" required="yes"/>
<label for="message">Message:</label>
<textarea name="message" required="yes"  rows="8"></textarea>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close()?>

</div>
<?php echo $this->load->view('blocks/footer'); ?>