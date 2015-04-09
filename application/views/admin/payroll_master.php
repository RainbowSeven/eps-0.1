<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Pay slips for <?php echo $employee_name;?></h2>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Payroll date</th>
<th>Hours worked</th>
<th>Gross pay</th>
<th>Deduction</th>
<th>Bonus</th>
<th>Net pay</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach ($payroll_slips as $slip) {
  echo "<tr>" . "<td>{$slip['payrolldate']}</td>" . 
  
  "<td>{$slip['hoursworked']}</td>" . "<td>{$slip['grosspay']}</td>" . "<td>{$slip['deductions']}</td>" . "<td>{$slip['additions']}</td>" . "<td>{$slip['netpay']}</td>" 
  ."<td>". anchor('admin/edit/pay_slip/' . $slip['payrollid'],
    'Edit') .' '. anchor('admin/delete/pay_slip/' . $slip['payrollid'],
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