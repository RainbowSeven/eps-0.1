<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Timesheet</h2>
<table>
<thead>
    <th>Checkin date</th>
    <th>Checkin time</th>
    <th>Checkout date</th>
    <th>Checkout time</th>
    <th>Hours worked</th>
    <th>Confirmed?</th>
</thead>
<tbody>
<?php foreach ($timesheet as $row) {
  echo "<tr>" . "<td>";
  list($checkin_date, $checkin_time) = explode(' ', $row['checkin']);
  echo $checkin_date . "</td>" . "<td>" . $checkin_time . "</td>";
  list($checkout_date, $checkout_time) = explode(' ', $row['checkout']);
  if ($checkout_date == '0000-00-00') echo "<td>--</td>";
  else  echo "<td>{$checkout_date}</td>";
  if ($checkout_time == '00:00:00') echo "<td>--</td>";
  else  echo "<td>{$checkout_time}</td>";
  if ($row['checkout'] != '0000-00-00 00:00:00') {
    $hours = strtotime($row['checkout']) - strtotime($row['checkin']);
    $hours = floor($hours / 3600);
  } else  $hours = '--';
  echo "<td>{$hours}</td>";
  echo "<td>{$row['checked']}</td>";
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