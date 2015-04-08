<?php echo $this->load->view('blocks/header'); ?>
<?php if ($this->session->userdata('login') == '') { ?>
<div class="columns">
<div class="right">
    <p>You are not logged in.</p>
</div>
</div>
<?php } ?>
<div class="row">
    <div class="small-5 columns">
        <p>CLOCK SYSTEM</p>
        <ul>
            <?php if(!$this->session->userdata('checkedin')) {?>
             <li><?php echo anchor('perform/checkin','Check In'); ?></li>
             <?php } else { ?>
            <li><?php echo anchor('perform/checkout','Check Out');?></li>
            <?php } ?>
        </ul>
        <p>ACCOUNT MANAGER</p>
           <ul>
            <?php 
                if(! $this->session->userdata('login')) 
                echo "<li>". anchor('/app/login','Login')."</li>";
                else
                echo "<li>". anchor('/app/logout','Logout')."</li>";
            ?>
        </ul>
    </div>
    <div id="main" class="">
        <?php if(!isset($employeeCheckedIn)) {?>
        <div data-alert class="alert-box info">
            <p>No employees currently checked in!</p>
            <a href="#" class="close">&times;</a>
        </div>
        <?php } else { 
                //TODO: employees checked-in in my department
            ?>
            <h2>Employees checked in:</h2>
            
        <?php }?>
        
    </div>
</div>


<?php echo $this->load->view('blocks/footer'); ?>