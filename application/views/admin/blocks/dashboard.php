<div class="nav">
<nav class="top-bar" data-topbar role="navigation">
<section class="top-bar-section">
<ul class="">
<li class="has-dropdown"><a href="#">General administration</a>
<ul class="dropdown">
<li class="has-dropdown">
    <a href="#">Add</a>
    <ul class="dropdown">
    <li><?php echo anchor('admin/add/department', 'Department'); ?></li>
    <li><?php echo anchor('admin/add/project_category', 'Project category'); ?></li>
    <li><?php echo anchor('admin/add/project', 'Project'); ?></li>
    <li><?php echo anchor('admin/add/ip_access_rule/department', 'IP access rules for department'); ?></li>
    <li><?php echo anchor('admin/add/event', 'Event'); ?></li>
    </ul>
</li>
<li class="has-dropdown"><?php echo anchor('#','Browse');?>
<ul class="dropdown">
<li><?php echo anchor('admin/browse/department', 'Departments'); ?></li>
<li><?php echo anchor('admin/browse/project_category', 'Project categories'); ?></li>
<li><?php echo anchor('admin/browse/project', 'Projects'); ?></li>
<li><?php echo anchor('admin/browse/ip_access_rule', 'IP access rules'); ?></li>
<li><?php echo anchor('admin/browse/event', 'Events'); ?></li>
</ul></li>
</ul></li>
<li class="has-dropdown"><a href="#">Employee account administration</a>
<ul class="dropdown">
<li class="has-dropdown"><?php echo anchor('admin','Add');?>
<ul class="dropdown">
<li><?php echo anchor('admin/add/employee', 'Employee'); ?></li>
<li><?php echo anchor('admin/add/clockin_message', 'Clockin message'); ?></li>
<li><?php echo anchor('admin/add/employee_lock', 'Employee lock'); ?></li>
<li><?php echo anchor('admin/add/ip_access_rule/employee', 'IP restriction for employee'); ?></li>
<li><?php echo anchor('admin/add/event', 'Event'); ?></li>
</ul>
</li>
<li><?php echo anchor('admin/search','Search employee record'); ?></li>
</ul>
</li>

<li class="has-dropdown"><a href="#">Employee reports</a>
<ul class="dropdown">
<li class="has-dropdown"><?php echo anchor('#','View list of employees');?>
<ul class="dropdown">
<li><?php echo anchor('admin/view/employee/_type', 'By type'); ?></li>
<li><?php echo anchor('admin/view/employee/_category', 'By category'); ?></li>
</ul>
</li>
<li><?php echo anchor('admin/view/total_hours', 'Total hours worked'); ?></li>
</ul>
</li>
<li class="has-dropdown"><a href="#">Department reports</a>
<ul class="dropdown">
<li><?php echo anchor('admin/employee_hours','Employee hours by department');?></li>
<li><?php echo anchor('admin/project_worked','Projects worked by department');?></li>
<li><?php echo anchor('admin/hours_on_project','Hours on project');?></li>
</ul>
</li>
<li><a href="#">Project reports</a></li>
<li class="has-dropdown"><a href="#">Payroll administration</a>
<ul class="dropdown">
<li><?php echo anchor('admin/edit/timesheet','Edit timesheet record'); ?></li>
<li><?php echo anchor('admin/add/timesheet_record','Add timesheet record'); ?></li>
<li><?php echo anchor('admin/generate/payroll_report','Generate payroll report'); ?></li>
<li><?php echo anchor('admin/check/timesheet','Check timesheets'); ?></li>
</ul>
</li>
<li class="has-dropdown"><a href="#">Payroll maintenance</a>
<ul class="dropdown">
<li><?php echo anchor('admin/add/salary','Add salary for an employee'); ?></li>
<li><?php echo anchor('admin/add/deduction','Add payroll deduction'); ?></li>
<li><?php echo anchor('admin/add/holiday','Add holiday for an employee'); ?></li>
<li><?php echo anchor('admin/add/bonus','Add bonus for an employee'); ?></li>
<li><?php echo anchor('admin/add/sick_day','Add employee sick day'); ?></li>
</ul>
</li>
<li class="has-dropdown"><a href="#">Employee payroll maintenance</a>
<ul class="dropdown">
<li><?php echo anchor('admin/browse/payroll','View employee payroll information'); ?></li>
</ul>
</li>
</ul>
</section>
</nav>
</div>
<div class="row">