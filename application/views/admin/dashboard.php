<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<p>You are logged in as <?php echo "{$this->session->userdata('firstname')} {$this->session->userdata('lastname')}"; ?></p>
<p>Welcome to admin dashboard</p>
</div>
<?php echo $this->load->view('blocks/footer'); ?>