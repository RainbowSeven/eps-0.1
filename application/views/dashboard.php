<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<p>You are logged in as <?php echo "{$this->session->userdata('firstname')} {$this->session->userdata('lastname')}"; ?></p>
<p>Welcome to your personal account manager</p>
</div>

<?php echo $this->load->view('blocks/footer'); ?>