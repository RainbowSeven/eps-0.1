<?php echo $this->load->view( 'blocks/header' ); ?>
<?php echo $this->load->view( 'admin/blocks/dashboard' ); ?>
<div id="main" class="">
<h2>All Employees <?php if(isset($pay_type_name)) echo "paid ".strtolower($pay_type_name); else echo "in $department_name"; ?></h2>
<?php if ( is_array( $employees ) ) { ?>
<table id="employee_lock_master" class="display" cellspacing="0" width="100%">
<thead>
<th>Lastname</th>
<th>Firstname</th>
<th>Job</th>
<th>Actions</th>
</thead>
<tbody>

<?php foreach ( $employees as $employee ) {
    echo "<tr>" . "<td>{$employee['lastname']}</td>" . "<td>{$employee['firstname']}</td>" .
      "<td>{$employee['jobtitle']}</td>" 
      . "<td>" .anchor( 'admin/browse/employee/' . $employee['empid'], 'View'). ' ' . anchor( 'admin/edit/employee/' . $employee['empid'],
      'Edit' ) .' ' . anchor( 'admin/delete/employee' . $employee['empid'],
      'Delete' ) . "</td>"
    . "</tr>";

  } ?>
</tbody>
</table>
<?php } else {
  echo "<p>No employees in this department</p>"; } ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#employee_lock_master').DataTable();
} );
</script>
<?php echo $this->load->view( 'blocks/footer' ); ?>