<?php echo validation_errors(); ?>
<?php echo form_open($processor);?>
  <p>Please provide login and password information to continue.</p>
    <div>
      <label for="login">Login:</label>
      <input name="login" type="text"/>
    </div>
    <div>
      <label for="password">Password:</label>
      <input name="password" type="password"/>       
     </div>
     <button name="submit" type="submit" value="<?php echo $action;?>"><?php echo $action; ?></button>
     <button name="cancel" class="alert" type="reset" value="Reset">Reset</button>
 <p>If you dont remember or lost your password, please click <a href="<?php site_url('app/recover')?>">here</a>.</p>
<?php echo form_close(); ?>