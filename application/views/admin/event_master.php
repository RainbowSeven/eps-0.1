<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Events</h2>
<?php
if(is_array($events)){
    ?>
    <table id="event_master" class="display" cellspacing="0" width="100%">
    <thead>
    <th>Event date</th>
    <th>Event time</th>
    <th>Department</th>
    <th>Posted by</th>
    <th>Date posted</th>
    <th>Expiry date</th>
    <th>View</th>
    <th>Edit</th>
    </thead>
    <tbody>
    <?php 
    foreach ($events as $event){
        echo "<tr>"
        ."<td>{$event['eventdate']}</td>"
        ."<td>{$event['eventtime']}</td>"
        ."<td>{$event['deptname']}</td>"
        ."<td>{$event['lastname']} {$event['firstname']}</td>"
        ."<td>{$event['dateposted']}</td>"
        ."<td>{$event['expirydate']}</td>"
        ."<td>".anchor('admin/browse/rule/'.$event['eventid'],'View')."</td>"
        ."<td>".anchor('admin/edit/rule/'.$event['eventid'],'Edit')."</td>"
        ."</tr>";
    }
    
    ?>
    </tbody>
    </table>
    <?php
} else{
    echo "<p>No events</p>";
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#event_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>