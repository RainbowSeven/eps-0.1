<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Holidays for <?php echo $employee_name;?></h2>
<?php if(is_array($holidays)){?>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Date</th>
<th>Amount</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach ($holidays as $holiday) {
  echo "<tr>" . "<td>{$holiday['datehols']}</td>" . 
  "<td>{$holiday['payment']}</td>"
  ."<td>". anchor('admin/edit/holiday/' . $holiday['holid'],
    'Edit') .' '. anchor('admin/delete/holiday/' . $holiday['holid'],
    'Delete'). "</td>" . "</tr>";

} ?>
</tbody>
</table>
<?php }
else {
    echo "<p>No holidays set for this employee</p>";
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('table').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>