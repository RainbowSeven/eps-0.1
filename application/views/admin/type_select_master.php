<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>All employee engagement types</h2>
<?php if(is_array($pay_types)){?>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Type</th>
<th>Action</th>
</thead>
<tbody>

<?php 
foreach ($pay_types as $pay_type) {
  echo "<tr>" . "<td>{$pay_type['typename']}</td>" .
  "<td>".anchor($controller.'?type_id='.$pay_type['typeid'],'Select')."</td>";
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
    $('table').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>