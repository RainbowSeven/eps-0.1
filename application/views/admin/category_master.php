<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Project Categories</h2>

<?php if (is_array($project_categories)) { ?>
<table id="category_master" class="display" cellspacing="0" width="100%"> 
<thead>
<th>Category title</th>
<th>Department</th>
<th>View</th>
<th>Edit</th>
</thead>
<tbody>   
    <?php foreach ($project_categories as $project_category) {
        echo "<tr>"
        ."<td>{$project_category['name']}</td>"
        ."<td>{$project_category['deptname']}</td>"
        ."<td>".anchor('admin/view/project_category/'.$project_category['id'],'View')."</td>"
        ."<td>".anchor('admin/edit/project_category/'.$project_category['id'],'Edit')."</td>"
        ."</tr>";
  } ?>
</tbody>
</table>  
<?php } else {
  echo "<p>No categories added yet. ".anchor('admin/add/project_category','Add category','class="button"')."</p>";
} ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#category_master').DataTable();
} );
</script>
</div>
<?php echo $this->load->view('blocks/footer'); ?>