<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Information on <?php echo $department_name;?></h2>
<?php if($location!=''){
    echo "<p>Location: {$location}</p>";
} else echo "<p>No location set for this department</p>"; ?> 
<?php if($manager!=''){
    echo "<p>Manager: {$manager}</p>";
} else echo "<p>No manager assigned for this department</p>"; ?> 
<?php if($desc!=''){
    echo "<p>Description: {$desc}</p>";
} else echo "<p>No description for this department</p>"; ?> 
<h3>Employees in <?php echo $department_name;?></h3>
<?php if(is_array($employees)){
    ?>
    <table>
    <thead>
    <th>Employee name</th>
    <th>View</th>
    <th>Edit</th>
    </thead>
    <tbody>
    <?php foreach ($employees as $employee){
        echo "<tr>"
            ."<td>{$employee['lastname']} {$employee['firstname']}</td>"
            ."<td>".anchor('admin/browse/employee/'.$employee['empid'],'View')."</td>"
            ."<td>".anchor('admin/edit/employee/'.$employee['empid'],'Edit')."</td>"
            ."</tr>";        
    }?>
    </tbody>
    </table>
<?php    
    
}?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>