<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>IP access rules</h2>
<?php
if(is_array($rules)){
    ?>
    <table id="ip_rule_master" class="display" cellspacing="0" width="100%">
    <thead>
    <th>IP address</th>
    <th>Type</th>
    <th>Person or Department</th>
    <th>View</th>
    <th>Edit</th>
    </thead>
    <tbody>
    <?php 
    foreach ($rules as $rule){
        echo "<tr>"
        ."<td>{$rule['ipaddress']}</td>"
        ."<td>{$rule['type']}</td>"
        ."<td>{$rule['name']}</td>"
        ."<td>".anchor('admin/browse/rule/'.$rule['ipid'],'View')."</td>"
        ."<td>".anchor('admin/edit/rule/'.$rule['ipid'],'Edit')."</td>"
        ."</tr>";
    }
    
    ?>
    </tbody>
    </table>
    <?php
}
?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#ip_rule_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>