<?php

// All Functions
// ***********


// This function is a generic function to get data
// from a table $table from the database by comparing
// $compfield with $key and returning $returnfield
//
// $key - User Input
// $compfield - Fieldname to compare $key with
// $returnfield - Field needed to be returned
// $table - Table where query will be performed
//
// This function assumes that values matched will be unique
// It is used only on primary keys to do matching
// This function works only for one search condition
//

function getempdeptname($deptid)
{
    $query = "SELECT deptname FROM department WHERE deptid=".$deptid;
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 1){
        $result_array = mysql_fetch_array($result);
        foreach($result_array as $key=>$value)
        {
            $deptname = $value;
        }
        return $deptname;
    }
    
}














function genericget($key,$compfield,$returnfield,$table)
{

       // Query to get category data based on cat id
       $query = "select $returnfield from $table where $compfield='$key'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
        
          $error="";            
          return $error; // error 
       }
       else if ($number>0)
       {

           $returndata=mysql_result($result,0,"$returnfield");

           return $returndata;
           
       }

}



// This function gets an employee id and then 
// returns the employee name in the format
// FirstName MiddleInital Lastname
function getempname($empid)
{

       // Query to get employee data based on employee id
       $query = "select firstname,minit,lastname from employee where empid='$empid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
        
          $error="Employee does not exist";
            
          return $error; // error 
       }
       else if ($number>0)
       {

           $firstname=ucwords(mysql_result($result,0,"firstname")); 
           $lastname=ucwords(mysql_result($result,0,"lastname")); 
           $minit=mysql_result($result,0,"minit"); 

           $namereturn="$firstname $minit $lastname";

           return $namereturn;
           
       }

}


// Checks if Employee has picture
// Returns 1 if there is a picture or 0 otherwsie
function checkemppicture($empid)
{

       // Query to get employee data based on employee id
       $query = "select picid from emppicture where type='e' and linkid='$empid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
        
           return 0;
         
       }
       else if ($number>0)
       {
        
           return 1;
           
       }

}




// This function checks whether the employee has any locks on their record
// If employee has locks, it displays reason for lock
function printlocks($empid)
{

        // Query to check if this person has got any lock on his/her record
     	$querylock = "select * from locks where empid='$empid' and active='y'";
        $resultlock = MYSQL_QUERY($querylock) or die("SQL Error Occured : ".mysql_error().':'.$querylock);
       
        // Getting number of rows from Querylock
        $numberlock = MYSQL_NUMROWS($resultlock);  
               
        $lockno=0;
               
                            
        // Retreiving all locks from system for that user
        while ($lockno<$numberlock)
        {
             
           // Getting data for locks 
           $lockid=mysql_result($resultlock,$lockno,"lockid");
           $datelock=mysql_result($resultlock,$lockno,"datelock");
           $reasonlock=mysql_result($resultlock,$lockno,"reasonlock");
           $lockedby=mysql_result($resultlock,$lockno,"lockedby");
           $active=mysql_result($resultlock,$lockno,"active");
           
           $lockedbyname=getempname($lockedby);
          	    
            $lockno1=$lockno+1;	
          	    
              // Priting locks for user to check
              echo "<table width=250 border=1 bordercolorlight=#CCCCCC bordercolordark=#CCCCCC cellpadding=0 cellspacing=0>";
              echo "<tr bgcolor=#CC0000>";
              echo "<td height=33>";
              echo "<div align=center><b><font size=\"-1\" color=\"#FFFFFF\"><b>RECORD LOCK $j</font></b></div></td>";
              echo "</tr><tr valign=middle>";
              echo "<td height=90>";
              
              echo "<table width=\"90%\" border=0 cellspacing=0 cellpadding=0 align=center>";
              echo "<tr>";
              echo "<td><font color=#000066 size=\"-1\">$reasonlock</font></td>";
              echo "</tr>";
              echo "</table>";

              echo "</td></tr><tr>";
              echo "<td height=33><i><font size=-2>Locked by : $lockedbyname<br>Locked on : $datelock</font></i></td>";
              echo "</tr></table>";
            
            

              

          	    
            // going to next row of locks query
            $lockno++;
          	    
        } // end while ($lockno<$numberlock)
        
        return 1;
  
}



// This function checks whether the employee has any login messages
// If employee has log in messages, then display them on login screen
// else do not do anything
function checkmessages($empid)
{

       // Query to check if user has any login messages
       $query = "select * from messages where empid='$empid' and active='y'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
       
       
       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
          return 0; // error 
       }
       else if ($number>0) 
       { 
           $i=0;
                    
           echo "<h2>Personal Messages</h2>";               
           echo "<table>";
           echo "<tr>";            
           $cols=0;
                    
           while ($i<$number)
           {
           	
              	
              $cols=$cols+1;
              echo "<td>";
           
              $lmid=mysql_result($result,$i,"lmid");
              $empid=mysql_result($result,$i,"empid");
              $message=mysql_result($result,$i,"message");
              $postedby=mysql_result($result,$i,"postedby");
              $dateposted=mysql_result($result,$i,"dateposted");
              $numview=mysql_result($result,$i,"numviews");
              

              
              $postedbyname=$postedby;

             
              $j=$i+1;
              
              echo "<table width=250 border=1 bordercolorlight=#CCCCCC bordercolordark=#CCCCCC cellpadding=0 cellspacing=0>";
              echo "<tr bgcolor=#8EA8D7>";
              echo "<td height=33>";
              echo "<div align=center><b><font size=\"-1\" color=\"#000000\">Personal Message $j</font></b></div></td>";
              echo "</tr><tr valign=middle>";
              echo "<td height=90>";
              
              echo "<table width=\"90%\" border=0 cellspacing=0 cellpadding=0 align=center>";
              echo "<tr>";
              echo "<td><font color=#000066 size=\"-1\">$message</font></td>";
              echo "</tr>";
              echo "</table>";
                        
              
              echo "</td></tr><tr>";
              echo "<td height=33><i><font size=-2>Posted by : $postedbyname<br>Posted on : $dateposted </font></i></td>";
              echo "</tr></table>";
             
            
              if ($cols==3)
              { 
                echo "</td></tr><tr>";
                $cols=0;
              }
              else
              {
                 echo "</td>";
              }
             
              $numview=$numview-1;
              
              if ($numview==0)
              {
              	
              	$queryuu1 = "update messages set numviews=numviews-1,active='n' where lmid='$lmid'";
                $resultuu1 = MYSQL_QUERY($queryuu1) or die("SQL Error Occured : ".mysql_error().':'.$queryuu1);
              	
              }
              else
              {
              
                  $queryuu = "update messages set numviews=numviews-1 where lmid='$lmid'";
                  $resultuu = MYSQL_QUERY($queryuu) or die("SQL Error Occured : ".mysql_error().':'.$queryuu);
              }             
             
             
             
             
             
              $i++;
           
           }
       
           echo "</tr>";
           echo "</table>";
           
 
       
           
       
       	   return 1; //correct 
       }
	
}


// This function checks whether the employee has any departmental messages
// If employee has departmental messages, then display them on login screen
// else do not do anything
function checkdeptmessages($deptid)
{
	
       $today=date("Y-m-d");

       // Query to check if user has any login messages
       $query = "select * from deptevents where deptid='$deptid' and active='y' and expirydate>'$today'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
       
       
       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
          return 0; // error 
       }
       else if ($number>0) 
       { 
           $i=0;
                    
           echo "<h2>Departmental Messages</h2>";          
           echo "<table>";
           echo "<tr>";            
           $cols=0;
                    
           while ($i<$number)
           {
              $cols=$cols+1;
              echo "<td>";
           
              $eventid=mysql_result($result,$i,"eventid");
              $eventdate=mysql_result($result,$i,"eventdate");
              $eventtime=mysql_result($result,$i,"eventtime");
              $eventbody=mysql_result($result,$i,"eventbody");
              $postedby=mysql_result($result,$i,"postedby");
              $dateposted=mysql_result($result,$i,"dateposted");
              $expirydate=mysql_result($result,$i,"expirydate");
              
              
              $postedbyname=$postedby;
             
              $j=$i+1;
              
              echo "<table width=250 border=1 bordercolorlight=#CCCCCC bordercolordark=#CCCCCC cellpadding=0 cellspacing=0>";
              echo "<tr bgcolor=#336633>";
              echo "<td height=33>";
              echo "<div align=center><b><font size=\"-1\" color=\"#FFFFFF\">Departmental Message $j</font></b></div></td>";
              echo "</tr><tr valign=middle>";
              echo "<td height=90>";
              
              echo "<table width=\"90%\" border=0 cellspacing=0 cellpadding=0 align=center>";
              echo "<tr>";
              echo "<td><font color=#000066 size=\"-1\">";
              echo "<b>$eventbody</b><br>";
              if ($eventdate!="")
              {
              	  echo "Date : $eventdate<br>"; 
              }
              
              if ($eventtime!="")
              {
              	  echo "Time : $eventtime<br>"; 
              }
              
              
              echo "</font></td>";
              echo "</tr>";
              echo "</table>";
                        
              
              echo "</td></tr><tr>";
              echo "<td height=33><i><font size=-2>Posted by : $postedbyname<br>Posted on : $dateposted </font></i></td>";
              echo "</tr></table>";
             
            
              if ($cols==3)
              { 
                echo "</td></tr><tr>";
                $cols=0;
              }
              else
              {
                 echo "</td>";
              }
             
              $i++;
           
           }
       
           echo "</tr>";
           echo "</table>";
       
       	   return 1; //correct 
       }
	
}



// Function to check whether login and password are correct
// If password matches with login and vice versa, a 1 is returned
// Otherwise a 0 is returned, signifying error
function checkpassword($login,$password)
{

     
	
       // Query to check if login and password are correct
       $query = "select login,password from employee where login='$login' and password='$password'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
       
       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
          return 0; // error 
       }
       else if ($number==1) 
       { 
       	   return 1; //correct 
       }
	
}

// This functions takes login and password as arguments and check for their properties
// It checks if the account is active, if the password matches and user has got
// any login messages to be displayed
// The output format is a string of integers separated by the character '>'
//
// e.g exists>lock>firstname>lastname>empid>passwordok>active
//
// Exists : if the formlogin exists {0|1}
// Lock : checks whether user has any lock {0|1} (0 = no lock , 1 = lock)
// Firstname, Lastname : Self Explanatory 
// Empid : Employee ID
// Passwordok : If password matches  {0|1} (0 = no match , 1 = match)
// Active : If user account is active {0|1} (0 = not active , 1 = active)



function checklogin($formlogin,$formpassword)
{

     
	
       // Query to check if login and password are correct
       $query = "select login,password,active,lastname,firstname,empid from employee where login='$formlogin'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
       
       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
       	
       	  $error="0>0>0>0>0>0>0";
          return $error; // error 
       }
       else if ($number==1) 
       { 
       	
       	
       	   $login=mysql_result($result,0,"login");
       	   $password=mysql_result($result,0,"password");
       	   $active=mysql_result($result,0,"active");
       	   $lastname=ucfirst(mysql_result($result,0,"lastname"));
       	   $firstname=ucfirst(mysql_result($result,0,"firstname"));
       	   $empid=mysql_result($result,0,"empid");
       	   
       	   
       	   // Query to check if this person has got any lock on his/her record
       	   
           $querylock = "select lockid from locks where empid='$empid' and active='y'";
           $resultlock = MYSQL_QUERY($querylock) or die("SQL Error Occured : ".mysql_error().':'.$querylock);
       
           // Getting number of rows from Querylock : 0 = no locks
           $numberlock = MYSQL_NUMROWS($resultlock); 
       	   
       	   $logincheck = '';
       	   if ($numberlock==0)
       	   {
       	   
       	       $lock=0;	
       	   	
       	   }
       	   else
       	   {
       	   
       	      $lock=1;	
       	   	
       	   }
       	   
       	   
       	      	         	   
       	   $logincheck=$logincheck."1>$lock>$firstname>$lastname>$empid>";
       	          	   
       	   if ($password==$formpassword)       	   
       	   {
       	   
       	   
       	       $logincheck=$logincheck."1>";	
       	   	
       	   }       	   
       	   else
       	   {
       	   	
       	   	$logincheck=$logincheck."0>";
       	   	
       	   }
       	          	   
       	   if ($active=="y")
       	   {
       	    
       	        $logincheck=$logincheck."1";
       	   	
       	   }
       	   else
       	   {
       	   	
       	   	$logincheck=$logincheck."0";
       	   	
       	   }
       	   
       	   
       	   // Format of Login Check
       	   // exists>lock>firstname>lastname>empid>passwordok>active
       	
       	   return $logincheck; //correct 
       }
	
}

// Checking if user is already logged in
// Function checkifloggedin takes argument employee id
// and returns a string of properties separated by the '>' Character
// string e.g    loggedin>loggedindate>loggedintime
//
// loggedin : Whether user is already logged in or not {0|1} (0=not logged in, 1=logged in)
// loggeddate : date that user had last checked in
// loggedtime : time that user had last checked in


function checkifloggedin($empid)
{
	   // Query to check if user is already logged in
	   $querylog = "SELECT checkin,checkout FROM timesheet where empid='{$empid}' and checkout='0000-00-00 00:00:00';"; 
           $resultlog = mysql_query($querylog);
           $numberlog = mysql_numrows($resultlog);        

           if ($numberlog==0)
           {
               $loggedin="0>0>0"; 
                return $loggedin;	
           	}
           else if ($numberlog>0)
           {
           	$checkin = mysql_result($resultlog,0,"checkin");
                list($inday,$intime)=explode(' ',$checkin);
                $loggedin="1>$inday>$intime";
                return $loggedin;
           }
}





// This function is a generic function which
// generated code for a html drop box with 
// values picked up from table $table, $optionid
// being the value passed and $optionname being
// the value shown in the drop down menu
//
// $optionid - The name of the field whose value that is stored when user 
//             chooses something from drop down menu
// $optionname - The name of the field that will be shown on drop down menu
// $table - The name of the table from which data will be queried
//

function makedropdown($optionid,$optionname,$table)
{
	   // Query to choose all departments
	   $querydrop = "select $optionid,$optionname from $table order by $optionname"; 
           $resultdrop= MYSQL_QUERY($querydrop);
           $numberdrop = MYSQL_NUMROWS($resultdrop);           

           if ($numberdrop==0)
           {
           
               echo "<option value=\"\" selected>No Data</option>";	
           	
           }
           else if ($numberdrop>0)
           {
           
              $i=0;
              
                echo "<option value=\"\">Please Choose</option>";
                
                while ($i<$numberdrop)
                {
             
                          $opid = mysql_result($resultdrop,$i,"$optionid");
           	          $opname = mysql_result($resultdrop,$i,"$optionname");
                
                          echo "<option value=\"$opid\">$opname</option>\n";
                
                          $i++;

                }
       	
           }
           
           return 0;
}

// This function gets last project worked
// by an employee and puts it as first selection
// in employee checkout screen, so that employee 
// wont have to go through drop down boxes
function getlastproject($empid)
{

       // Query to get employee data based on employee id
       $query = "select lastproject from employee where empid='$empid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query
       $number = MYSQL_NUMROWS($result); 
	
       if ($number>0)
       {

           $lastproject=mysql_result($result,0,"lastproject");
           
           
           if (($lastproject==0) or ($lastproject==""))
           {
           
           
                 echo "<option selected value=\"-1\">Select your project</option>\n";	
           	
           }
           else
           {
           
           
                   $projectname=genericget($lastproject,'projectid','projecttitle','project'); 
           
                   echo "<option selected value=\"$lastproject\">$projectname</option>";
           }
           
           
           
           return 1;
           
       }

}



// This function find and prints all
// the child of a department
function findchild($deptid)
{

       // Query to get parent/child relationship of depts
       $query = "select * from department where deptparentid='$deptid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query
       $number = MYSQL_NUMROWS($result); 
	
       if ($number>0)
       {

              echo "<table border=0>";
              echo "<tr>";
        
              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  $deptid1=mysql_result($result,$i,"deptid");
                  $managerid=mysql_result($result,$i,"managerid");
                  $deptparentid=mysql_result($result,$i,"deptparentid");
                  $deptname=mysql_result($result,$i,"deptname");
                  $location=mysql_result($result,$i,"location");
                  
                  echo "<td valign=top>";
                  
                    echo "<table width=100 border=1 cellspacing=0 cellpadding=0 align=center bordercolordark=#000000 bordercolorlight=#000000 bordercolor=#000000>";
                    echo "<tr><td height=80>";
                    echo "<font color=#003399><b><center>$deptname</center></b>";
                    echo "<br><div align=right><a href=\"viewdeptinfo.php?deptid=$deptid1\"><img src=\"images/info.gif\" alt=\"View Department Information\" width=\"17\" height=\"17\" border=0></a></div>";
        
                    
                    echo "</td></tr></table>";
                  
                  findchild($deptid1);
                  
                  echo "</td>";
                  
                  $i++;
              } // end of while i < number
              
              
              echo "</tr>";
              echo "</table>";
         
           

           
       }

return 1;

}




// This function prints all the employee of 
// a department in a table
function printdeptemployee($deptid)
{

       // Query to get parent/child relationship of depts
       $query = "select * from employee where deptid='$deptid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0) 
       {
       	
       	    echo "No Employees in this department";
       	     
       }
       elseif ($number>0)
       {

              echo "<table width=480 border=0 cellspacing=0 cellpadding=0>";
              $i = 0;  
              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;
define(APP,'ty');
                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  $empid=mysql_result($result,$i,"empid");
                  $lastname=mysql_result($result,$i,"lastname");
                  $firstname=mysql_result($result,$i,"firstname");
                  $minit=mysql_result($result,$i,"minit");
                  $jobid=mysql_result($result,$i,"jobid");
                  $jobtitle=genericget($jobid,'jobid','jobtitle','jobtitle');
                  $email=mysql_result($result,$i,"email");
                  
                  
                  // making every other alternate row
                  // of a different color
                  $k=$i/2;
                  $k=substr($k,-1,1);
                  
                  // if row is odd, then make row background grey
                  if ($k=="5")
                  {
                  
                      echo "<tr bgcolor=\"#EBEBEB\">"; 	
                  	
                  }
                  else
                  {
                       echo "<tr>";
                  }

                   echo "<td height=25 width=150><a href=\"viewempinfo.php?empid=$empid\">$lastname</a></td>";
                   echo "<td height=25 width=150>$firstname</td>";
                   echo "<td height=25>$jobtitle</td>";
                   echo "</tr>";
          
          
                  
                  
                  $i++;
              } // end of while i < number
              
              
              echo "</table>";
         
           

           
       }

return 1;

}




// This function selects all the active projects and put the data in a
// drop down box in HTML with the project names in it and projectid
// as the value passed when a department is chosen

function projectdropdown($deptid)
{
	   // Query to choose all departments
	   $querypro = "select * from project where deptid='$deptid' and active='y' order by projecttitle"; 
           $resultpro = MYSQL_QUERY($querypro);
           $numberpro = MYSQL_NUMROWS($resultpro);           

           if ($numberpro==0)
           {
           
               echo "<option value=\"0\" selected>No Projects in this dept, Choose this Option</option>";	
           	
           }
           else if ($numberpro>0)
           {
           
              $i=0;
              
              
               
                while ($i<$numberpro)
                {
             
                          $projectid = mysql_result($resultpro,$i,"projectid");
           	          $projecttitle = mysql_result($resultpro,$i,"projecttitle");
                
                          echo "<option value=\"$projectid\">$projecttitle</option>\n";
                
                          $i++;

                }
       	
           }
           
           return 0;
}

// This function find the total hours worked by an employee
function findtotalhours($empid)
{
	   // Query to choose all departments
	   $querypro = "select sum(roundedtime) as totwork from timesheet where empid='$empid'"; 

           $resultpro = MYSQL_QUERY($querypro);
           
           
           
           $amountwork=mysql_result($resultpro,0,"totwork");
           
           
           return $amountwork;
          

}


// This function updates the number of hours
// of a project by adding the current hours
// with the hours taken in by the function
function updateprojecttime($projectid,$hours)
{
	   // Query to choose all departments
	   $querypro = "update project set hoursworked=hoursworked+$hours where projectid='$projectid'"; 


           $resultpro = MYSQL_QUERY($querypro);
          

}

// This function makes a float to 2 decimal places
function twodecimals($floatnum)
{
	 
    list($first,$last)=explode('.',$floatnum);
    
    $last=substr($last,0,2);
    
    $newnum=$first.".".$last;      
    
    return $newnum;

}


// This function approves a timesheet record
// by setting the checked field to 'y'
function approvetime($timeid)
{
	   // Query to update timesheet
	   $querypro = "update timesheet set checked='y' where timeid='$timeid'"; 
           $resultpro = MYSQL_QUERY($querypro);
          
}


// This function removes hours from the 
// number of hours spent on a project
function subtractprojecttime($projectid,$hours)
{
	   // Query to choose all departments
	   $querypro = "update project set hoursworked=hoursworked-$hours where projectid='$projectid'"; 
	   

           $resultpro = MYSQL_QUERY($querypro);
          
}



// This function activate or disactivates a project
// $table == the table that the query is supposed to run
// $key == the field name of the primary key of the table to effect on
// $activateid == the value of the primary key of the row to be activated 
// $action='i' == inactivate
// $action='a' == activate
function genericactivate($action,$activateid,$key,$table)
{
           if ($action=='a')
           {
           	$active='y';
           }
           else
           {
           	$active='n';
           }	

	
	   // Query to choose all departments
	   $querypro = "update $table set active='$active' where $key='$activateid'"; 

           $resultpro = MYSQL_QUERY($querypro);

}




// This function updates the last project that employee has worked on
// in the employee table
function updatelastproject($empid,$projectid)
{
	   // Query to choose all departments
	   $querypro = "update employee set lastproject='$projectid' where empid='$empid'"; 
	   
           $resultpro = MYSQL_QUERY($querypro);
          

}


// This function rounds the time worked to a certain accuracy
// It takes the raw hours worked in decimal format
// and outputs the rounded time to the $rounding decimal factor
// Common $roundings
//  0 : No Rounding
// 25 : To the nearest quarter Hour
// 50 : To the nearest Half Hour
function roundtime($hoursworked,$roundings)
{

  // If no rounding, then return same time
  if (($roundings==0) or ($roundings<0))
  {
     
     return substr($hoursworked,0,5);

  }
  // else if there is rounding
  // do the calculations
  else if ($roundings>0)
  {

      // Break time worked into hours and minutes
      list($hours,$minutes)=explode('.',$hoursworked);

      $minutes=substr($minutes,0,2);
      
      // If minutes has got a preceding 0... like 004
      // make minute==1
      if (substr($minutes,0,1)==0) { $minutes=1; }
      
      // Finding mid point to round off to
      $halftime=$roundings/2;
      
      // Finding Quadrant in which the time is
      // Quadrant Information is stored in $multiple
      // 0 - First Quadrant
      // 1 - Second Quadrant etc...
      $multi=$minutes/$roundings;     
      list($multiple,$decimals)=explode('.',$multi);

      
      // If minutes <= midpoint of Quadrant
      // Then Round off to lower Limit
      if ($minutes<=(($roundings*$multiple) + $halftime))
      {
      	     	
      	$minutes=($roundings*$multiple);
      
      }
      // If Minutes > Midpoint of Quadrant
      // Then Round off to upper Limit
      else if ($minutes>(($roundings*$multiple) + $halftime))
      {
      	
      	$minutes=($roundings*($multiple+1));
      }
      	       
      
      // If minutes>=100
      // Add 1 to hour
      // and makes minutes zero
      if ($minutes==100)
      {
      	
      	  $hours=$hours+1;
      	  $minutes="00";
      	
      }
      
      // Put minutes in nice 00 format if = 0
      if ($minutes==0)
      {
      	
      	$minutes="00";
      	
      }
    
      $newtime=$hours.".".$minutes;
 
      return $newtime;
   }
}


// This function checks whether IP address that employee is checking in from
// is an allowed checkin ip address for that department
// If IP address is allowed, the function returns a 1, otherwise a 0 for bad ipaddres

function checkipaddress($ipadd,$empid)
{
	
      $deptid=genericget($empid,'empid','deptid','employee');	

      // Breaking IP address in 4 ip blocks
      // for individual comparison 
      if($ipadd == '::1')
      $ipadd = '127.0.0.1';
      list($ipor1,$ipor2,$ipor3,$ipor4)= explode('.',$ipadd);
      
      $goodip=0;


     // Checking if user got any individual ip address rules
     // If user has any individual ip checking rules
     // it overrides departmental ip chekcing rules
     $queryip="select * from iptable where type='e' and linkid='$empid'";
     $resultip = MYSQL_QUERY($queryip);
     $numberip = MYSQL_NUMROWS($resultip);


     // If user does not have any individual ip address checking rules
     // Then check if there is any departmental ip address checking rules 
     if ($numberip==0)
     {
           // Query to choose all Ip addresses for the particular department
           $queryip = "select * from iptable where type='d' and linkid='$deptid'"; 
           $resultip = MYSQL_QUERY($queryip);
           $numberip = MYSQL_NUMROWS($resultip);  
     }
         

     // If there is no ip address set for the department
     // Then any ip address is valid  
     if ($numberip==0)
     {
           
         $goodip=1;
                   	
     }
     else if ($numberip>0)
     {
          
        $i=0;
        while ($i<$numberip)
        {
             
              $deptipadd = mysql_result($resultip,$i,"ipaddress");
              
              // Breaking Stored ip address into 4 ip blocks
              list($ip1,$ip2,$ip3,$ip4)=explode('.',$deptipadd);  
              
              // Checking for first IP block
              // If first block is not *
              // * is wildkey.. anything goes in this ip block
              if ($ip1 != "*")
              {
              	   // If both similar, then first block correct
              	   if ($ip1==$ipor1)
              	   {
              	        $correct1=1;
              	   }
              	   else
              	   {
              	        $correct1=0;
              	   }
              }
              else if ($ip1=="*")
              {
              	   $correct1=1;
              }
              
              
              
              // Checking for second IP Block
              if ($ip2 != "*")
              {
              	   if ($ip2==$ipor2)
              	   {
              	        $correct2=1;
              	   }
              	   else
              	   {
              	        $correct2=0;
              	   }
              }
              else if ($ip2=="*")
              {
              	   $correct2=1;
              }
 
              // Checking for third IP Block
              if ($ip3 != "*")
              {
              	   if ($ip3==$ipor3)
              	   {
              	        $correct3=1;
              	   }
              	   else
              	   {
              	        $correct3=0;
              	   }
              }
              else if ($ip3=="*")
              {
              	   $correct3=1;
              }              
              
              
              // Checking for fourth IP Block
              if ($ip4 != "*")
              {
              	   if ($ip4==$ipor4)
              	   {
              	        $correct4=1;
              	   }
              	   else
              	   {
              	        $correct4=0;
              	   }
              }
              else if ($ip4=="*")
              {
              	   $correct4=1;
              }             
              
              
              // Checking if all 4 IP Blocks are correct
              if (($correct1==1) and ($correct2==1) and ($correct3==1) and ($correct4==1))
              {
            	    $goodip=1;
              	    
              	    // Ending While loop
              	    $i=$numberip;              	
              }
              else
              {
              	  $goodip=0;              	              	
              }
              
                
           $i++;

        }  // while ($i<$numberip)

      }	// if $numberip > 0
	
 
      return $goodip;
	
	
}

// This function takes a string $text, returns
// a new string with $length characters followed
// by ...
// Used in table formats so that big strings dont 
// mess up table look

function cuttext($text,$length)
{

  if (strlen($text)>$length)
  {
      $newstring=substr($text, 0, $length);
	
      $newstring=$newstring."...";
    
      return $newstring;
    
  }
  else
  {  
      $newstring=$text;
 
      return $newstring;
 	
  }

}

// This function takes two dates, $startdate and $enddate and returns
// the Number of days between the two dates
function returnnumdays($startdate,$enddate)
{

         // Breaking into tokens
         list($syear,$smonth,$sday)=explode('-',$startdate);
         list($eyear,$emonth,$eday)=explode('-',$enddate);

         // Converting to Unix Epoch Time
         $enddate1=mktime(0,0,0,date("$emonth"),date("$eday"),date("$eyear"));
         $startdate1=mktime(0,0,0,date("$smonth"),date("$sday"),date("$syear"));

         // difference in seconds 
         $diffsec=$enddate1- $startdate1;

         // difference in hours 
         $diffhour=$diffsec/3600;       

         $diffdays=$diffhour/24;
         $diffdays=$diffdays+1;
         
         return $diffdays;

	
}


// This functions the different timeslot of an employee for a 
// particular date
function printhours($empid,$workdate)
{

      $query="select empid,checkin,checkout,roundedtime from timesheet where empid='$empid' and checkin like '%$workdate%'";

      $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
       
       
       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
          return 0; // error 
       }
       else if ($number>0) 
       { 
           $i=0;
                 $totalhours =0;   
           while ($i<$number)
           {
           
                 // Fetching Timesheet Data and storing in local variables                       
                 $empid = mysql_result($result,$i,"empid");
                 $roundedtime= mysql_result($result,$i,"roundedtime");

                                      
                 $checkin = mysql_result($result,$i,"checkin");
                 $checkout = mysql_result($result,$i,"checkout");
                 
                 
                 $totalhours=$totalhours+$roundedtime;                    


                // breaking DateTime records into date and time
                list($inday,$intime)=explode(' ',$checkin);
                list($outday,$outtime)=explode(' ',$checkout);

                if ($outday!=$inday) {$outtime=$outtime."<b>(nd)</b>";};
                                      
                $intime=substr($intime,0,5);                      
                $outtime=substr($outtime,0,5);
                echo "$intime - $outtime<br>";
                                      
                $i++;
              
           }
           
         return $totalhours;  

      }

}

// This function makes a 6 character long random password
function mknewpasswd()
{

// Create an array of valid password characters.
$the_char = array( 
     "a","A","b","B","c","C","d","D","e","E","f","F","g","G","h",
     "H","i","I","j","J", "k","K","l","L","m","M","n","N","o","O",
     "p","P","q","Q","r","R","s","S","t","T", "u","U","v","V","w",
     "W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8",
     "9","0"
); 

// Set var to number of elements in the array minus 1, since arrays
// begin at 0 and the count() function returns beginning the count
// at 1. 
$max_elements = count($the_char) - 1; 

// Now we set our random vars using the rand() function with 0 and
// the array count number as our arguments. Thus returning
// $the_char[randnum]. 

srand((double)microtime()*1000000);
$c1 = $the_char[rand(0,$max_elements)];  
$c2 = $the_char[rand(0,$max_elements)];  
$c3 = $the_char[rand(0,$max_elements)];  
$c4 = $the_char[rand(0,$max_elements)];  
$c5 = $the_char[rand(0,$max_elements)];  
$c6 = $the_char[rand(0,$max_elements)];  


// Finally, echo the password.
$rp=$c1.$c2.$c3.$c4.$c5.$c6;

return $rp; 


} 

// This function makes a semi random login
function makelogin($lastname)
{
$lastname=substr($lastname,0,4); 

$randoms=mknewpasswd();

$randoms=substr($randoms,2,4);

$newlogin=$lastname.$randoms;

return $newlogin; 

} 



//***************
// Function to print payslip

 function printpayslip($empid,$startdate,$enddate,$status)
 {
                $empname=getempname($empid);
   
                // Adding time to the dates
                // Starting at 00:00 on the $startdate
                $startdate1=$startdate." 00:00:00";
          
                // Ending at 23:59:59 on the enddate
                $enddate1=$enddate." 23:59:59";

                // Query to find all checkins between $startdate and $enddate 
               $query = "select timeid,roundedtime,checked from timesheet where empid='$empid' and checkin >= '$startdate1' and checkout <= '$enddate1' order by checkin;";
               $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

               // Finding number of rows of SQL Query
               if ($result>0) { $number = MYSQL_NUMROWS($result); }
               else {$number=0;}   
 
               // If there is no timesheet record
               if ($number == 0)
               {
                   $timeworked=0;
                   $approvehours=0;                         
               }
               // else if there are timesheet records
               elseif ($number > 0)
               {
                     $totalhours=0;
                     $approvehours=0;
                     $i=0;
                               
                     // Go through each record in loop
                     while ($i < $number)
                     {                                                            
                            // Fetching Timesheet Data and storing in local variables  
                            $timeid = mysql_result($result,$i,"timeid");                     
                            $roundedtime= mysql_result($result,$i,"roundedtime");
                            $checked= mysql_result($result,$i,"checked");
                                                                        
                            if ($checked=='y')
                            {
                                 $approvehours=$approvehours+$roundedtime;
                            } 
                                   
                            // Calculating Total Hours
                            $totalhours=$totalhours+$roundedtime; 

                            $i++;
                                    
                    } // end while i < number

                } // end of else if number > 0


// get employee type
// hourly or salary support only for now
$typeid=genericget($empid,'empid','typeid','employee');
$catid=genericget($empid,'empid','catid','employee');

$catname=genericget($catid,'catid','catname','empcategory');
$typename=genericget($typeid,'typeid','typename','employeetype');


// Hourly Worker
// Hourly Type id = 1
if ($typeid=="1")
{
     $hourlyrate=genericget($empid,'empid','hourlyrate','hourly');
     $grosspay=$approvehours*$hourlyrate;
     $grosspay=twodecimals($grosspay);
     $finalpay=$grosspay;
     
     // DEDUCTIONS
     // Query to get deductions
     $querydeduc="select * from deductions where empid='$empid'";

     $resultdeduc = MYSQL_QUERY($querydeduc);
     $numberdeduc = MYSQL_NUMROWS($resultdeduc);

     $noded = 0;
                
     if ($numberdeduc > 0) 
     {     
              WHILE ($noded < $numberdeduc)
              { 
              	
              	 $dedtype=mysql_result($resultdeduc,$noded,"deductype");
              	 $dedamount=mysql_result($resultdeduc,$noded,"amount");
              	 $dednote=mysql_result($resultdeduc,$noded,"note");
              	 
              	 $deducdesc[]="$dednote";
              	 $deducamount[]=$dedamount;
              	 
              	 $finalpay=$finalpay-$dedamount;
              	 
              	 $noded++;
      
                 $finaldeducs=$finaldeducs+$dedamount;
      
              }
     } 
      
     // BONUSES
     // Query to get bonueses
     $querybonus="select * from bonus where empid='$empid' and datebonus>='$startdate' and datebonus<'$enddate'";

     $resultbonus = MYSQL_QUERY($querybonus);
     $numberbonus = MYSQL_NUMROWS($resultbonus);

     $nobon = 0;
                
     if ($numberbonus > 0) 
     {     
              WHILE ($nobon < $numberbonus)
              { 
              	
              	 $datebon=mysql_result($resultbonus,$nobon,"datebonus");
              	 $bonamount=mysql_result($resultbonus,$nobon,"bonuspayment");
              	 $bonnote=mysql_result($resultbonus,$nobon,"note");
              	           	 
              	 $bonusdesc[]="$bonnote ($datebon)";
              	 $bonusamount[]=$bonamount;
              	 
              	 $finalpay=$finalpay+$bonamount;
              	 
              	 $finaladditions=$finaladditions+$bonamount;
              	 
              	 $nobon++;   
      
              }
     }       
      
     
     // HOLIDAYS
     // Query to get holidays
     $queryhols="select * from holidays where empid='$empid' and datehols>='$startdate' and datehols<'$enddate'";

     $resulthols = MYSQL_QUERY($queryhols);
     $numberhols = MYSQL_NUMROWS($resulthols);

     $nohols = 0;
                
     if ($numberhols > 0) 
     {     
              WHILE ($nohols < $numberhols)
              { 
              	
              	 $datehols=mysql_result($resulthols,$nohols,"datehols");
              	 $holspayment=mysql_result($resulthols,$nohols,"payment");
              	 $holsnote=mysql_result($resulthols,$nohols,"note");
              	 
              	           	 
              	 $holsdesc[]="$holsnote ($datehols)";
              	 $holsamount[]=$holspayment;
              	 
              	 $finalpay=$finalpay+$holspayment;
              	 
              	 $finaladditions=$finaladditions+$holspayment;
              	 
              	 $nohols++;   
      
              }
     }       
     
     // SICK DAYS
     // Query to get sick days
     $querysick="select * from sickday where empid='$empid' and datesick>='$startdate' and datesick<'$enddate'";

     $resultsick = MYSQL_QUERY($querysick);
     $numbersick = MYSQL_NUMROWS($resultsick);

     $nosick = 0;
                
     if ($numbersick > 0) 
     {     
              WHILE ($nosick < $numbersick)
              { 
              	
              	 $datesick=mysql_result($resultsick,$nosick,"datesick");
              	 $sickpayment=mysql_result($resultsick,$nosick,"payment");
              	 $sicknote=mysql_result($resultsick,$nosick,"note");
              	 
              	           	 
              	 $sickdesc[]="$sicknote ($datesick)";
              	 $sickamount[]=$sickpayment;
              	 
              	 $finalpay=$finalpay+$sickpayment;
              	 
              	 $finaladditions=$finaladditions+$sickpayment;
              	 
              	 $nosick++;   
      
              }
     }       
     
     
     // Starting Payslip display
     
?>


<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
      <h2>Employee PayRoll Slip for <?php echo $empname; ?></h2>
      <table width="640" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Name : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><?php echo $empname; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Pay Period :</div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><?php echo "$startdate - $enddate"; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Employee Category : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><?php echo $catname; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Payroll Type : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><?php echo $typename; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Hourly Pay :</div>
          </td>
          <td height="30" width="492"><font color="#990033">$<?php echo $hourlyrate; ?></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"><div align="right">Hours Worked :</div> </td>
          <td height="30" width="492"><font color="#990033"><?php echo $approvehours; ?></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Pay Before Adjustments :</div>
          </td>
          <td height="30" width="492"><font color="#990033">$<?php echo $grosspay; ?></font></td>
        </tr>
        
      </table>
      <p>&nbsp;</p>
      <table width="640" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#CCCCCC"> 
          <td width="120" height="30"> 
            <div align="right"><b>Description</b></div>
          </td>
          <td width="1" height="30"> 
            <div align="right"><b><b><b><b></b></b></b></b></div>
          </td>
          <td width="231" height="30"> 
            <div align="center"><b>Description</b></div>
          </td>
          <td width="1" height="30"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="30"> 
            <div align="right"><b>Compensation</b></div>
          </td>
          <td width="15" height="30"> 
            <div align="right"><b><b><b><b><b></b></b></b></b></b></div>
          </td>
        </tr>
        
        
        
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Hours Worked</div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center">Normal Pay</div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<?php echo $grosspay; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?php
          
            // ****************************************
            // DEDUCTIONS
            for ($x1=0;$x1<count($deducamount);$x1++)
            {
            	 $x11=$x1+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Deduction <?php echo $x11; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><?php echo $deducdesc[$x1]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<?php echo $deducamount[$x1]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>-</b></div>
          </td>
        </tr>
        
        <?php
        
           } // end for $x1
        
        ?>

         <?php
          
         // ****************************************
         // BONUSES
         for ($x3=0;$x3<count($bonusamount);$x3++)
         {
            $x33=$x3+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Bonus <?php echo $x33; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><?php echo $bonusdesc[$x3]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<?php echo $bonusamount[$x3]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?php
        
           } // end for $x3
        
        ?>


        
        
         <?php
          
            // ****************************************
            // HOLIDAYS
            for ($x2=0;$x2<count($holsamount);$x2++)
            {
            	 $x22=$x2+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Holiday <?php echo $x22; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><?php echo $holsdesc[$x2]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<?php echo $holsamount[$x2]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?php
        
           } // end for $x2
        
        ?>
        
         <?php
          
            // ****************************************
            // SICK DAYS
            for ($x4=0;$x4<count($sickamount);$x4++)
            {
            	 $x44=$x4+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Holiday <?php echo $x44; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><?php echo $sickdesc[$x4]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<?php echo $sickamount[$x4]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?php
        
           } // end for $x2
        
        ?>        
        
        
        
        <tr bgcolor="#000000"> 
          <td width="120" height="1"> 
            <div align="right"></div>
          </td>
          <td width="1" height="1" bgcolor="#000000"></td>
          <td width="231" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="1" height="1" bgcolor="#000000"></td>
          <td width="243" height="1"> 
            <div align="right"></div>
          </td>
          <td width="15" height="1"> 
            <div align="center"><b></b></div>
          </td>
        </tr>
        <tr> 
          <td width="120" height="30"> 
            <div align="right"></div>
          </td>
          <td width="1" height="30"> 
            <div align="right"></div>
          </td>
          <td width="231" height="30"> 
            <div align="right"><b>Total :</b></div>
          </td>
          <td width="1" height="30"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="30"> 
            <div align="right"><b><font color="#990000">$<?php echo $finalpay; ?></font></b></div>
          </td>
          <td width="15" height="30"> 
            <div align="right"><b></b></div>
          </td>
        </tr>
        <tr bgcolor="#000000"> 
          <td width="120" height="1"> 
            <div align="right"></div>
          </td>
          <td width="1" height="1"> 
            <div align="center"></div>
          </td>
          <td width="231" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="1" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="1"> 
            <div align="right"></div>
          </td>
          <td width="15" height="1"> 
            <div align="center"><b></b></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>     

<?php     
     
// If this is final payroll generation
// Insert into payroll table
if ($status=="f")
{
$today=date("Y-m-d");
$queryinsertpay="INSERT INTO payroll (payrollid, empid, payrolldate, startdate, enddate, hoursworked, grosspay, deductions, additions, netpay) VALUES (null,'$empid','$today','$startdate', '$enddate', '$approvehours', '$grosspay', '$finaldeducs', '$finaladditions', '$finalpay')";
$resultinsertpay =  MYSQL_QUERY($queryinsertpay) or die("SQL Error Occured : ".mysql_error().':'.$queryinsertpay);
	
}

?>   
     
<?php
     
  
         
}// end if typeid=1
// Employee is salaried
else if ($typeid=="2")
{

    $baseyear=genericget($empid,'empid','baseyear','salary');
    
    echo "<h3>This employee is a salaried employee. Salaried Employee Payroll Generation not yet supported.</h3>";
    echo "<h3>Base Pay per Year : $baseyear </h3>";
    
    

}
else
{

    echo "<h3>This employee type not yet supported for payroll generation by this system.</h3>";

}


} // end of function print pay slip




?>

