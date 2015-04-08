<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>All Employees</h2>
<?php if(is_array($employees)){?>
<table id="employee_lock_master" class="display" cellspacing="0" width="100%">
<thead>
<th>Lastname</th>
<th>Firstname</th>
<th>Job</th>
<th>Action</th>
</thead>
<tbody>

<?php 
$getty = $this->input->post('dept_id')?'&emp_id=':'&emp_id=';
foreach ($employees as $employee) {
  echo "<tr>" . "<td>{$employee['lastname']}</td>" . "<td>{$employee['firstname']}</td>" . "<td>{$employee['jobtitle']}</td>" .
  "<td>".anchor($controller.$getty.$employee['empid'],'Select')."</td>";
  echo "</tr>";    

} ?>
</tbody>
</table>
<?php } else
echo "<p>No employees in this department yet. ".anchor('admin/add/employee/','Add employee')."</p>";
 ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#employee_lock_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>