<?php echo $this->load->view( 'blocks/header' ); ?>
<?php echo $this->load->view( 'blocks/dashboard' ); ?>
<div id="main" class="">
<h2>Employee check out</h2>
<div data-alert class="alert-box info">
<p>The time is <?php echo date( 'h : i a' ); ?></p>
<a href="#" class="close">&times;</a>
</div>
<p><?php echo "{$this->session->userdata('firstname')} {$this->session->userdata('lastname')}" ?>, please select the project that you have worked on from the drop down box below and then put a short description of what you have done today.</p>
  <?php echo validation_errors();
if ( ! $this->session->userdata( 'empid' ) ) {
  echo $this->load->view( 'blocks/login', array( 'processor' => 'perform/checkout',
      'action' => 'Check Out' ) );
} else {

  foreach ( $project_listing as $key => $value ) {
    $list[$value['projectid']] = $value['projecttitle'];
  }
  $extra = form_label( 'Projects in ' . getempdeptname( $this->session->userdata( 'deptid' ) ) .
    ':' ) . form_dropdown( 'project', $list );
  if(isset($clockoutoption) and $clockoutoption){  
  $extra = $extra.form_label( 'Work description:' ) .
    form_textarea( 'desc' );
  }
  echo $this->load->view( 'blocks/one_button_form', array(
    'processor' => 'perform/checkout',
    'action' => 'Check Out',
    'extras' => $extra ) );
} ?>
</div>
</div>
</div>

<?php echo $this->load->view( 'blocks/footer' ); ?>