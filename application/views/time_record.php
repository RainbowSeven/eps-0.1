<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employee time records</h2>
<?php if(is_array($records)){
?>
<table>
<thead>
<th>Date checkedin</th>
<th>Date checkedout</th>
<th>Project</th>
<th>Hours worked</th>
<th>Confirmed</th>
</thead>
<tbody>
<?php   
foreach($records as $record){
    echo "<tr>"
    ."<td>{$record['checkin']}</td>"
    ."<td>{$record['checkout']}</td>"
    ."<td>{$record['projecttitle']}</td>";
    if($record['checkout']!='0000-00-00 00:00:00'){
        $hours = strtotime($record['checkout']) - strtotime($record['checkin']);
        $hours = floor($hours /3600);
    } else
    $hours ='--';
    echo "<td>{$hours}</td>"
    ."<td>{$record['checked']}</td>"
    ."</tr>";
} 
?>
</tbody>
</table>
<?php    
}
else
 echo "<p>No time records available</p>";
?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>