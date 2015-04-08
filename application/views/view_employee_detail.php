<?php echo $this->load->view('blocks/header'); ?>
<?php echo $this->load->view('blocks/dashboard'); ?>
<div id="main" class="">
<h2>Employee record</h2>

<?php if (is_array($employee_record)) {
  foreach ($employee_record as $detail) {
    echo "<div class='clearfix'><div class='small-5 columns'><img class='th' src=" . base_url('images/' . $detail['link']) . " /></div>" .
      "<div class=''><p>Employee Id: {$detail['empid']}</p>" . "<p>SSN: {$detail['ssn']}</p>" .
      "<p>Name: {$detail['lastname']} {$detail['firstname']}</p>" . "<p>Department: {$detail['deptname']}</p>" .
      "<p>Job: {$detail['jobtitle']}</p></div></div>" . "<div class='clearfix'><h3>Contact Information</h3>" .
      "<p>Email: {$detail['email']}</p>" . "<p>Webpage: {$detail['webpage']}</p>" .
      "<h3>Work Information</h3>" . "<p>Type: {$detail['typename']}</p>" . "<p>Category: {$detail['catname']}</p>" .
      "<p>Department: {$detail['deptname']}</p>" . "<p>Manager: {$manager}</p>" .
      "<p>Regular hours: {$detail['regularhours']}</p>" . "<h3>Address</h3>" . "<p>{$detail['address1']}</p>" ."<p>{$detail['address2']}</p>"."<p>{$detail['city']}</p>"."<p>{$detail['country']}</p>"
      ."<h3>Biodata</h3>" . "<p>Race: {$detail['race']}</p>" . "<p>Marital status: {$detail['marital']}</p>" .
      "<p>Gender: {$detail['gender']}</p>" . "<p>Date of birth: {$detail['dob']}</p></div>";
  }

} else{
    echo "<p>No records are available.</p>";
}?>
</div>
<?php echo $this->load->view('blocks/footer'); ?>