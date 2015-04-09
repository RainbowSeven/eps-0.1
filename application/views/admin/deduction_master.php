<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Pay deductions for <?php echo $employee_name;?></h2>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Deduction type</th>
<th>Amount</th>
<th>Date</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach ($deductions as $deduction) {
  echo "<tr>" . "<td>{$deduction['deductype']}</td>" . 
  
  "<td>{$deduction['amount']}</td>" . "<td>{$deduction['deductdate']}</td>" 
  ."<td>". anchor('admin/edit/deduction/' . $deduction['deducid'],
    'Edit') .' '. anchor('admin/delete/deduction/' . $deduction['deducid'],
    'Delete'). "</td>" . "</tr>";

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