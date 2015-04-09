<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Bonuses for <?php echo $employee_name;?></h2>
<?php if(is_array($bonuses)){?>
<table class="display" cellspacing="0" width="100%">
<thead>
<th>Date</th>
<th>Amount</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach ($bonuses as $bonus) {
  echo "<tr>" . "<td>{$bonus['datebonus']}</td>" . 
  "<td>{$bonus['bonuspayment']}</td>"
  ."<td>". anchor('admin/edit/bonus/' . $bonus['bonusid'],
    'Edit') .' '. anchor('admin/delete/bonus/' . $bonus['bonusid'],
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