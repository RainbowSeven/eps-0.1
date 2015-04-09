<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Sick days for <?php echo $employee_name;?></h2>
<?php if(is_array($sick_days)){?>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Date</th>
<th>Amount</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach ($sick_days as $sick_day) {
  echo "<tr>" . "<td>{$sick_day['datesick']}</td>" . 
  "<td>{$sick_day['payment']}</td>"
  ."<td>". anchor('admin/edit/bonus/' . $sick_day['sickid'],
    'Edit') .' '. anchor('admin/delete/bonus/' . $sick_day['sickid'],
    'Delete'). "</td>" . "</tr>";

} ?>
</tbody>
</table>
<?php }
else {
    echo "<p>No bonus set for this employee</p>";
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('table').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>