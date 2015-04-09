<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Projects</h2>
<?php
if(is_array($projects)){
    ?>
    <table id="project_master" class="display" cellspacing="0" width="100%">
    <thead>
    <th>Poject title</th>
    <th>Department</th>
    <th>Category</th>
    <th>Actions</th>
    </thead>
    <tbody>
    <?php 
    foreach ($projects as $project){
        echo "<tr>"
        ."<td>{$project['projecttitle']}</td>"
        ."<td>{$project['deptname']}</td>";
        if($project['category'] == ''){
            echo "<td>None</td>";
        }else{
        echo "<td>{$project['category']}</td>";}
        echo "<td>".
        anchor('admin/edit/project/'.$project['projectid'],'Edit')." ".anchor('admin/browse/project/'.$project['projectid'],'View').' '.
        anchor('admin/delete/project/'.$project['projectid'],'Delete').
        "</td>"
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
    $('#project_master').DataTable();
} );
</script>
<?php echo $this->load->view('blocks/footer'); ?>