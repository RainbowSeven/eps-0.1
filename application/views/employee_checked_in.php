<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Checked in employees in <?php echo $department; ?></h2>
<?php if(is_array($checkers)){
?>
<table>
<thead>
<th>Employee Name</th>
<th>Checkedin time</th>
</thead>    
<tbody>
<?php 
    foreach($checkers as $checker){
        echo "<tr>"
            ."<td>{$checker['empname']}</td>";
        list($checkin_date, $checkin_time) = explode(' ',$checker[0]['checkin']);
         echo "<td>{$checkin_time}</td>"
            ."</tr>";
    }
?>
</tbody>
</table>    
<?php    
} else{
    echo "<p>No employees checked in at this time.</p>";
} ?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>