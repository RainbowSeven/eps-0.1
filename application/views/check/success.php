<?php echo $this->load->view('blocks/header'); ?>

<?php if($response =='y')
{?>
<div data-alert class="alert-box success">
<p>Thanks <?php echo "{$this->session->userdata('firstname')} {$this->session->userdata('lastname')}";?></p>
<p>You have successfully <?php echo $job; ?>!</p>
<a href="#" class="close">&times;</a>
</div>
<div class="row small-12 columns">
<h3><?php echo $job;?> Information</h3>
<div class="panel">
<p>Date Time: <?php echo $timenow; ?></p>
<p><?php echo $message; ?></p>
<?php
    $empid = $this->session->userdata('empid'); 
    $deptid = genericget($empid,'empid','deptid','employee');
    checkdeptmessages($deptid);
    checkmessages($empid);
?>
</div>
</div>
<?php 
} 
else
{?>
    <div data-alert class="alert-box">
     <p>You are currently <?php echo $job; ?>!</p>
     <a href="#" class="close">&times;</a>
    </div>
<?php
}
?>
<?php echo $this->load->view('blocks/footer'); ?>