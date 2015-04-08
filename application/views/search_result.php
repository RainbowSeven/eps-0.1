<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employee Search</h2>
<p>Search results for "<?php echo $needle; ?>".</p>
<?php if (is_array($results)) { ?>
<table>
<thead>
<th>Name</th>
<th>Job title</th>
<th>Department</th>
<th>Action</th>
</thead>
<tbody>
<?php 
$non_duplicative = array();
foreach($results as $result){
    echo "<tr>"
        ."<td>{$result['lastname']} {$result['firstname']}</td>"
        ."<td>{$result['jobtitle']}</td>"
        ."<td>{$result['deptname']}</td>"
        ."<td>".anchor('perform/view_employee_info/'.$result['empid'],'View details', array('class'=>'button round'))."</td>"
        ."</tr>";
} ?>
</tbody>
</table>
<?php echo anchor('perform/search','Search again'); ?>
<?php } else {
  echo "<p>No employee records match the searched term.</p>";
} ?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>