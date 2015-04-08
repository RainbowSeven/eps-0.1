<?php echo $this->load->view('blocks/header'); ?>
<div id="main">
<h2>Employee Login</h2>
<?php echo '<p class="warning">'.$error.'</p>'?>
<?php echo $this->load->view('blocks/login',array('processor'=>'app/login','action'=>'Login')); ?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>