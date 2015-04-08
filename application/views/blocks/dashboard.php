<div class="nav">
<nav class="top-bar" data-topbar role="navigation">
<section class="top-bar-section">
        <ul><li class="has-dropdown"><a href="#">Clock functions</a>
        <ul class="dropdown">
            <li><?php echo anchor( 'perform/checkin', 'Start Work' ); ?></li>
            <li><?php echo anchor( 'perform/checkout', 'Stop Work' ); ?></li>
            <li><?php echo anchor( 'perform/generate_timesheet',
'Generate Timesheet Report for Hours worked' ); ?></li>
            <li><?php echo anchor( 'perform/email/manager', 'Email My Manager' ); ?></li>
            <li><?php echo anchor( 'perform/email/department',
'Email My Department' ); ?></li>
        </ul></li>
        <li class="has-dropdown"><a href="#">Account settings</a>
        <ul class="dropdown">
            <li><?php echo anchor( 'perform/password_change',
'Change My Password' ); ?></li>
            <li><?php echo anchor( 'perform/edit_my_info', 'Edit My Information' ); ?></li>
        </ul></li>
        <li class="has-dropdown"><a href="#">Reports</a>
        <ul class="dropdown">
            <li><?php echo anchor( 'perform/view_employees',
'Departmental Employee List' ); ?></li>
            <li><?php echo anchor( 'perform/search', 'Search for a Colleague' ); ?></li>
            <li><?php echo anchor( 'perform/org_chart', 'Organizational Chart' ); ?></li>
            <li><?php echo anchor( 'perform/view_checked_in',
'View People Currently Check in My Department' ); ?></li>
            <li><?php echo anchor( 'perform/view_all_checked_in',
'View All People Currently Checked in' ); ?></li>
        </ul></li>
        <li class="has-dropdown"><a href="#">Timesheet Management</a>
        <ul class="dropdown">
            <li><?php echo anchor( 'perform/view_timerecord',
'View my Time Record (Time + Desc)' ); ?></li>
        </ul>
        </li>
</section>
</nav>
</div>
<div class="row">