</div>
<footer>
    <div class="small-12 columns">
        <nav>
            <ul class="inline-list">
                <li><?php echo anchor('/app','Home');?></li>
                <?php 
                    if(! $this->session->userdata('login')) 
                    echo "<li>". anchor('/app/login','Login')."</li>";
                    else
                    echo "<li>". anchor('/app/logout','Logout')."</li>";
                ?>
                <?php if(! $this->session->userdata('login')) {
                    if(! $this->session->userdata('checkin'))
                    echo '<li>'.anchor('/perform/checkin','Check In').'</li>';
                    else 
                    echo '<li>'.anchor('/perform/checkout','Check Out').'</li>';
                  }
                ?>
             </ul>
        </nav>
        <p>&copy; 2015 Michael Akinsanya 10CK011302 Covenant University.</p>
    </div>
</footer>
<script src="<?php echo base_url('js/vendor/modernizr.js');?>"></script>
<script src="<?php echo base_url('js/foundation.min.js');?>"></script>
<script>
$(document).foundation();
</script>
</body>
</html>