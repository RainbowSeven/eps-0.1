<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('admin/blocks/dashboard'); ?>
<div id="main" class="">
<h2>Add employee form</h2>
<?php if(isset($message)){
    echo "<p>{$message}</p>";
}
echo validation_errors();
?>
<?php echo form_open_multipart('admin/add/employee');?>
<fieldset>
<legend>Employee Information</legend>
<label for="department">Department:</label>
<select name="department">
<?php foreach($departments as $department){
    echo "<option value=\"{$department['deptid']}\">{$department['deptname']}</option>";
}?>
</select>
<label for="employee_type">Type:</label>
<select name="employee_type">
<?php foreach($employee_types as $type){
    echo "<option value=\"{$type['typeid']}\">{$type['typename']}</option>";
}?>
</select>
<label for="employee_type">Category:</label>
<select name="employee_category">
<?php foreach($categories as $category){
    echo "<option value=\"{$category['catid']}\">{$category['catname']}</option>";
}?>
</select>
<label for="job_title">Job title:</label>
<select name="job_title">
<?php foreach($job_titles as $job_title){
    echo "<option value=\"{$job_title['jobid']}\">{$job_title['jobtitle']}</option>";
}?>
</select>
<label for="regular_hours">Regular hours per week:</label>
<input name="regular_hours" type="text"/>
<label for="hourly_pay_rate">Hourly pay rate:</label>
<input name="hourly_pay_rate" type="text"/>
<label for="ssn">Identification Number [SSN]:</label>
<input name="ssn" type="text"/>
<label for="salutation">Salutation:</label>
<select name="salutation">
<option value="Mr">Mr</option>
<option value="Mrs">Mrs</option>
<option value="Miss">Miss</option>
<option value="Dr">Dr</option>
<option value="Prof">Prof</option>
</select>
<label for="first_name">Firstname:</label>
<input name="first_name" type="text" required="yes"/>
<label for="middle_name">Middlename:</label>
<input name="middle_name" type="text"/>
<label for="last_name">Lastname:</label>
<input name="last_name" type="text" required="yes"/>
</fieldset>
<fieldset>
<legend>Biodata</legend>
<label for="dob">Date of birth:</label>
<input name="dob" type="date" required="yes" placeholder="yyyy-mm-dd"/>
<label for="race">Race:</label>
<select name="race">
<option value="black">Black</option>
<option value="hispanic">Hispanic</option>
<option value="white">White</option>
<option value="american indian">American Indian</option>
<option value="Other">Other</option>
</select>
<label for="marital_status">Marital status:</label>
<select name="marital_status">
<option value="single">Single</option>
<option value="married">Married</option>
<option value="divorced">Divorced</option>
<option value="widowed">Widowed</option>
</select>
<label for="gender">Gender:</label>
<input name="gender" type="radio" required="yes"/>Male
<input name="gender" type="radio" required="yes"/>Female<br/>
</fieldset>
<fieldset>
<legend>Electronic contact</legend>
<label for="email">Email:</label>
<input name="email" type="email" required="yes"/>
<label for="website">Website:</label>
<input name="website" type="text"/>
<label for="home_phone">Home phone:</label>
<input name="home_phone" type="text" placeholder="999-999-9999"/>
<label for="mobile_phone">Mobile phone:</label>
<input name="mobile_phone" type="text" required="yes" placeholder="999-999-9999"/>
<label for="cell_phone">Cell phone:</label>
<input name="cell_phone" type="text" placeholder="999-999-9999"/>
</fieldset>
<fieldset>
<legend>Address</legend>
<label for="address1">Address 1:</label>
<input name="address1" type="text" required="yes"/>
<label for="address2">Address 2:</label>
<input name="address2" type="text"/>
<label for="city">City:</label>
<input name="city" type="text" required="yes"/>
<label for="state">State:</label>
<input name="state" type="text"/>
<label for="zipcode">Zip code:</label>
<input name="zipcode" type="text"/>
<label for="country">Country:</label>
<input name="country" type="text" required="yes"/>
</fieldset>
<fieldset>
<legend>Employee picture</legend>
<input name="picture" type="file"/>
</fieldset>
<button name="action_btn" value="submit" type="submit">Submit</button>
<?php echo form_close();?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>