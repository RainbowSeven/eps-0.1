<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Reports</h2>
<?php
if(is_array($reports)){
    ?>
    <table class="display" cellspacing="0" width="100%">
    <thead>
    <th>Lastname</th>
    <th>Firstname</th>
    <th>Hours worked</th>
    <th>Gross pay</th>
    <th>Net pay</th>
    <th>Start date</th>
    <th>End date</th>
    <th>Edit</th>
    </thead>
    <tbody>
    <?php 
    foreach ($reports as $report){
        echo "<tr>"
        ."<td>{$report['lastname']}</td>"
        ."<td>{$report['firstname']}</td>"
        ."<td>{$report['hoursworked']}</td>"
        ."<td>{$report['grosspay']}</td>"
        ."<td>{$report['netpay']}</td>"
        ."<td>{$report['startdate']}</td>"
        ."<td>{$report['enddate']}</td>"
        ."<td>".anchor('admin/edit/payroll/'.$report['payrollid'],'Edit')."</td>"
        ."</tr>";
    }
    
    ?>
    </tbody>
    </table>
    <?php
} else{
    echo "<p>No reports</p>";
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('table').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>