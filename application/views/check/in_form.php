<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employee check in</h2>
<div data-alert class="alert-box info">
<p>The time is <?php echo date('h : i a'); ?></p>
<a href="#" class="close">&times;</a>
</div>
  <?php
  if(!$this->session->userdata('empid'))
  {
     echo $this->load->view(
        'blocks/login',
        array('processor'=>'perform/checkin','action'=>'Check In'));
  }
  else
  {
    $extra = '';
    if ( isset( $flash_message ) ) { 
    $extra .= "<div data-alert class=\"alert-box\">
                <p>echo $flash_message;</p><a href=\"#\" class=\"close\">&times;</a>
    </div>";}
    echo $this->load->view(
                'blocks/one_button_form', 
                array('processor'=>'perform/checkin','action' => 'Check In', 'extras' => $extra));
  }
  ?>
</div>
</div>


</div>

<?php echo $this->load->view('blocks/footer'); ?>