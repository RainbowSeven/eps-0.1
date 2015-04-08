<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employees in <?php echo $dept_name; ?> </h2>
<?php if(is_array($employee_list)){?>
<table>
<thead>
<th>Employee Name</th>
<th>Email</th>
<th>Home Phone</th>
<th>Office Phone</th>
<th>Cell Phone</th>
</thead>
<tbody>
<?php foreach($employee_list as $employee){
    echo "<tr>"
        ."<td>{$employee['lastname']}, {$employee['firstname']} </td>"
        ."<td>{$employee['email']}</td>"
        ."<td>{$employee['homephone']}</td>"
        ."<td>{$employee['officephone']}</td>"
        ."<td>{$employee['cellphone']}</td>"
        ."</tr>";
}  ?>
</tbody>
</table>
<?php } else {
    echo "<p>There are no employees in this department</p>";
}?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>