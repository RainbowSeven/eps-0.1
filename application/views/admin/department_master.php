<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>All departments</h2>
<table id="department_master" class="display" cellspacing="0" width="100%">
<thead>
<th>Department name</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>
<?php foreach ($departments as $department) {
  echo "<tr>" . "<td>" . $department['deptname'] . "</td>" . "<td>" . anchor('/admin/browse/department/' .
    $department['deptid'], 'View') . "</td>" . "<td>" . anchor('/admin/edit/department/' . $department['deptid'],
    'Edit') . "</td>" . "<td>" . anchor('admin/delete/department/' . $department['deptid'],
    'Delete') . "</td>" . "</tr>";

} ?>
</tbody>
</table>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#department_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>