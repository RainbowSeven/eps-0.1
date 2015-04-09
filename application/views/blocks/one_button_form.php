<?php echo form_open($processor);?>
<label><?php echo ucfirst($action);?> time:</label>
<input value="<?php echo date('Y-m-d H:i:s') ?>" disabled="yes" /><br />
<?php echo $extras; ?>
<input name="timenow" value="<?php echo date('Y-m-d H:i:s') ?>" type="hidden"/>
<button name="action_btn" type="submit" value="<?php echo $action;?>"><?php echo $action; ?></button>
</form>