<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>All Employees</h2>
<table id="employee_lock_master" class="display" cellspacing="0" width="100%">
<thead>
<th>Lastname</th>
<th>Firstname</th>
<th>Job</th>
<th>Status</th>
<th>Action</th>
</thead>
<tbody>

<?php foreach ($employees as $employee) {
  echo "<tr>" . "<td>{$employee['lastname']}</td>" . "<td>{$employee['firstname']}</td>" . "<td>{$employee['jobtitle']}</td>" .
  "<td>{$employee['lockstatus']}</td>";
  if($employee['lockstatus'] =='Not locked'){
    echo "<td>" . anchor($lock_controller.$employee['empid'],
    'Lock') . "</td>";
    }
  else{
    echo "<td>" . anchor($unlock_controller.$employee['empid'],
    'Unlock') . "</td>";
    }
  echo "</tr>";    

} ?>
</tbody>
</table>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#employee_lock_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>