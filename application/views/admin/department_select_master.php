<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>All Departments</h2>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Department</th>
<th>Action</th>
</thead>
<tbody>

<?php foreach ($departments as $department) {
  echo "<tr>" . "<td>{$department['deptname']}</td>".
  "<td>".anchor($controller.'?dept_id='.$department['deptid'],'Select')."</td>";
  echo "</tr>";    

} ?>
</tbody>
</table>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('table').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>