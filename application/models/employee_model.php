<?php class Employee_model extends CI_Model {
  public function login( $login, $password ) {
    $query = $this->db->get_where( 'employee', array( 'login' => $login, 'password' =>
        $password ) );
    if ( $query->num_rows() == 1 ) {
      foreach ( $query->result() as $row ) {
        $this->session->set_userdata( array(
          'login' => $login,
          'empid' => $row->empid,
          'deptid' => $row->deptid,
          'lastname' => $row->lastname,
          'firstname' => $row->firstname ) );
      }
      return true;
    } else {
      return false;
    }
  }

  public function checkin() {
    try {
      $this->db->where( array( 'empid' => $this->session->userdata( 'empid' ) ) );
      $this->db->order_by( 'timeid asc' );
      $this->db->limit( 1 );
      $query = $this->db->get( 'timesheet' );
      if ( $query->num_rows() == 1 ) //return single row
        {
        foreach ( $query->result() as $row ) {
          if ( $row->checkout == '' ) throw new Exception( 'Not checked out!' );
          else {
            if ( $this->input->server( 'REMOTE_ADDR' ) == '::1' ) $ip = '127.0.0.1';
            else  $ip = $this->input->server( 'REMOTE_ADDR' );
            if ( $this->db->insert( 'timesheet', array(
              'timeid' => null,
              'empid' => $this->session->userdata( 'empid' ),
              'checkin' => $this->input->post( 'timenow' ),
              'checkout' => '',
              'rawtime' => '',
              'ipcheckin' => $ip,
              'checked' => 'n' ) ) ) {
              $this->session->set_userdata( array( 'checkedin' => true ) );
              return true;
            } else  throw new Exception( 'Unable to check in employee at this time!' );
          }

        }
      }

    }
    catch ( exception $e ) {
      redirect( 'app/dashboard' );
    }
  }

  public function checkout() {
    $timeid = '';
    $this->db->where( array( 'empid' => $this->session->userdata( 'empid' ) ) );
    $this->db->order_by( 'timeid asc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'timesheet' );
    if ( $query->num_rows() == 1 ) {
      foreach ( $query->result() as $row ) {
        $timeid = $row->timeid;
        if ( $row->checkout != '0000-00-00 00:00:00' ) throw new Exception( 'Already checked out!' );
        else {
          $this->db->where( 'timeid', $timeid );
          if ( $this->db->update( 'timesheet', array(

            'empid' => $this->session->userdata( 'empid' ),
            'checkout' => $this->input->post( 'timenow' ),
            'workdesc' => $this->input->post( 'desc' ),
            'projectid' => $this->input->post( 'project' ),
            'ipcheckout' => $this->input->server( 'REMOTE_ADDR' ),
            'checked' => 'n' ) ) ) {
            $this->session->unset_userdata( 'checked_in' );
            return true;
          } else  throw new Exception( 'Unable to check in employee at this time!' );
        }

      }

    }
  }
  /**
   * This function generates timesheet for currently logged employee
   * @return array timesheet 
   */
  public function generate_timesheet() {
    if ( $this->session->userdata( 'empid' ) ) {
      $this->db->select( 'checkin, checkout, checked' );
      $query = $this->db->get_where( 'timesheet', array( 'empid' => $this->session->
          userdata( 'empid' ) ) );
      if ( $query->num_rows() > 0 ) {
        return $query->result_array();
      } else  return 'There are no timesheet records available.';
    } else  return 'There are no timesheet records available.';
  }

  public function password_change() { //Change password
    if ( $this->session->userdata( 'empid' ) ) {
      $this->db->where( 'empid', $this->session->userdata( 'empid' ) );
      $this->db->update( 'employee', array( 'password' => $this->input->post( 'new_password' ) ) );
      return true;
    } else {
      return false;
    }
  }
  /**
   * This function verifies the password of an employee.
   * @param string $password
   * @return boolean
   */
  public function verify_password( $password ) {
    if ( $this->session->userdata( 'empid' ) ) {
      $this->db->where( array( 'empid' => $this->session->userdata( 'empid' ),
          'password' => $password ) );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() == 1 ) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  /**
   * This function checks if a manager was assigned to a department.
   * @param int $empid
   * @return int $manager_id
   */
  public function has_manager( $empid = '' ) { //Checks if employee has manager assigned to his department
    if ( $empid != '' ) {
      $record = $this->get_employee_detail( $empid );
      $deptid = 0;
      foreach ( $record as $detail ) {
        $deptid = $detail['deptid'];
      }
      $this->db->select( 'managerid' );
      $this->db->where( array( 'deptid' => $deptid ) );
      $query = $this->db->get( 'department' );
      if ( $query->num_rows() == 1 ) {
        $result = false;
        foreach ( $query->result_array() as $manager ) {
          if ( $manager['managerid'] == 0 ) $result = false;
          else  $result = $manager['managerid'];
        }
        return $result;
      } else {
        return false;
      }
    } else {
      $this->db->select( 'managerid' );
      $this->db->where( array( 'deptid' => $this->session->userdata( 'deptid' ) ) );
      $query = $this->db->get( 'department' );
      if ( $query->num_rows() == 1 ) {
        $result = false;
        foreach ( $query->result_array() as $manager ) {
          if ( $manager['managerid'] == 0 ) $result = false;
          else  $result = $manager['managerid'];
        }
        return $result;
      } else {
        return false;
      }
    }
  }
  /**
   * This function gets the email address of an employee by id.
   * @param int employee id
   * @return string email
   */
  public function get_employee_email( $empid ) {
    if ( $this->session->userdata( 'empid' ) ) {
      $this->db->select( 'email' );
      $this->db->where( array( 'empid' => $empid ) );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() == 1 ) {
        $email = '';
        foreach ( $query->result_array() as $row ) {
          $email = $row['email'];
        }
        return $email;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  /**
   * This function gets the name of an employee by id.
   * @param int employee id
   * @return string employee name
   */
  public function get_employee_name( $empid = '' ) {
    if ( $empid != '' ) {
      $this->db->select( 'lastname, firstname, minit' );
      $this->db->where( array( 'empid' => $empid ) );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() == 1 ) {
        $name = '';
        foreach ( $query->result_array() as $row ) {
          $name = $row['lastname'] . ' ' . $row['firstname'];
        }
        return $name;
      } else {
        return false;
      }
    } else {
      $this->db->select( 'lastname, firstname, minit, empid' );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() > 1 ) {
        return $query->result_array();
      } else {
        return false;
      }
      return false;
    }
  }
  /**
   *This function gets all employees in a department by deptid.
   * @param int deptid
   * @param string beam
   * @param string is
   * @return array employees
   */
  public function get_employees_in_dept( $deptid = '', $beam = '', $is = '' ) {
    switch ( $beam ) {
      case 'pay_type':
        $this->db->select( 'empid, lastname, firstname, minit, jobtitle' );
        $this->db->join( 'jobtitle', 'jobtitle.jobid = employee.jobid' );
        $this->db->where( array( 'typeid' => $is ) );
        $query = $this->db->get( 'employee' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else {
          return false;
        }
        break;
      default:
        $this->db->select( 'empid, lastname, firstname, minit, jobtitle, email, officephone, homephone, cellphone' );
        if ( $deptid != '' ) $this->db->where( array( 'deptid' => $deptid ) );
        $this->db->join( 'jobtitle', 'jobtitle.jobid = employee.jobid' );
        $query = $this->db->get( 'employee' );
        if ( $query->num_rows() > 0 ) {
          $result = $query->result_array();
          if ( $beam == '' ) {
            return $result;
          } elseif ( $beam == 'locks' ) {
            $fit = array();
            foreach ( $result as $row ) {
              // echo $value['empid'];
              $fit[$row['empid']]['lockstatus'] = $this->is_locked( $row['empid'] ) ? 'Locked' :
                'Not locked';
              $fit[$row['empid']]['lastname'] = $row['lastname'];
              $fit[$row['empid']]['firstname'] = $row['firstname'];
              $fit[$row['empid']]['jobtitle'] = $row['jobtitle'];
              $fit[$row['empid']]['empid'] = $row['empid'];
            }
            return $fit;
          }
        } else {
          return false;
        }
    }
  }
  /**
   * This function searches for an employee in employee table
   *@param string needle
   *@return array result
   */
  public function search( $needle ) {
    $needles = explode( ' ', $needle );
    $condition = '';
    foreach ( $needles as $n ) {
      $condition = $condition . "((firstname like '%$n%') or (minit like '%$n%') or (lastname like '%$n%') or (ssn like '%$n%') or (email like '%$n%') ) and ";
    }

    $condition = substr_replace( $condition, '', -4, -1 );
    $this->db->where( $condition );
    $this->db->join( 'jobtitle', 'jobtitle.jobid = employee.jobid', 'left join' );
    $this->db->join( 'department', 'department.deptid=employee.deptid', 'left join' );
    $query = $this->db->get( 'employee' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /**
   * This function gets employee detail
   * @param int employee id
   * @return array employee detail
   */
  public function get_employee_detail( $empid ) {
    $this->db->where( array( 'employee.empid' => $empid ) );
    $this->db->join( 'jobtitle', 'jobtitle.jobid = employee.jobid' );
    $this->db->join( 'department', 'department.deptid = employee.deptid' );
    $this->db->join( 'empcategory', 'empcategory.catid = employee.catid' );
    $this->db->join( 'employeetype', 'employeetype.typeid = employee.typeid' );
    $this->db->join( 'emppicture', 'emppicture.picid = employee.empid', 'left outer' );
    $query = $this->db->get( 'employee' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  public function get_employee_checkedin( $specifier = '' ) {
    if ( $specifier == '' ) {
      $employees = $this->get_employees_in_dept( $this->session->userdata( 'deptid' ) );
    } else {
      $employees = $this->get_employees_in_dept();
    }
    $checkers = array();
    foreach ( $employees as $employee ) {
      if ( is_array( $this->checked_in( $employee['empid'] ) ) ) $checkers[$employee['empid']] =
          $this->checked_in( $employee['empid'] );
      else  continue;
    }
    return $checkers;
  }
  /**
   * This function checks for users checked in.
   * @param int employee id
   * @return array checkin employees
   */
  public function checked_in( $empid ) {
    $this->db->where( array( 'empid' => $empid, 'checkout' => '0000-00-00 00:00:00' ) );
    $this->db->order_by( 'timeid', 'desc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'timesheet' );
    if ( $query->num_rows() > 0 ) {
      $result = array();
      $result['empname'] = $this->get_employee_name( $empid );
      foreach ( $query->result_array() as $row => $value ) {
        $result[$row] = $value;
      }
      return $result;
    } else  return false;
  }
  /** This function gets the time record.
   * @param int employee id
   * @return array time records
   */
  public function get_time_records( $empid = '' ) {
    if ( $empid == '' ) {
      $this->db->where( array( 'empid' => $this->session->userdata( 'empid' ) ) );
    } elseif ( $empid > 0 ) $this->db->where( array( 'empid' => $empid ) );
    $this->db->join( 'project', 'timesheet.projectid = project.projectid', 'inner' );
    $query = $this->db->get( 'timesheet' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  public function is_admin() {
    $this->db->select( 'admin' );
    $this->db->where( array( 'empid' => $this->session->userdata( 'empid' ), 'admin' =>
        1 ) );
    $query = $this->db->get( 'employee' );
    if ( $query->num_rows() == 1 ) {
      return true;
    } else {
      return false;
    }
  }
  /**
   *This function gets employee types
   * @param int $empid
   * @return array employee types
   */
  public function get_employee_type( $emp_id = '' ) {
    if ( $emp_id == '' ) {
      $this->db->select( 'typeid, typename' );
      $query = $this->db->get( 'employeetype' );
      if ( $query->num_rows() > 0 ) {
        return $query->result_array();
      } else {
        return false;
      }
    } else {
      $this->db->select( 'typename' );
      $this->db->join( 'employeetype', 'employeetype.typeid = employee.typeid' );
      $this->db->where( array( 'employee.empid' => $emp_id ) );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() == 1 ) {
        $employee_type = '';
        foreach ( $query->result_array() as $row ) {
          $employee_type .= $row['typename'];
        }
        return $employee_type;
      } else {
        return false;
      }
    }

  }
  /**
   *This function gets employee categories from empcategory table
   * @param int $empid
   * @return array employee categories
   */
  public function get_category( $empid = '' ) {
    if ( $empid == '' ) {
      $this->db->select( 'catid, catname' );
      $query = $this->db->get( 'empcategory' );
      if ( $query->num_rows() > 0 ) {
        return $query->result_array();
      } else {
        return false;
      }
    }
  }
  /**
   *This function gets employee job titles from jobtitle table
   * @param int $empid
   * @return array employee job titles
   */
  public function get_job_title( $empid = '' ) {
    if ( $empid == '' ) {
      $this->db->select( 'jobid, jobtitle' );
      $query = $this->db->get( 'jobtitle' );
      if ( $query->num_rows() > 0 ) {
        return $query->result_array();
      } else {
        return false;
      }
    }
  }
  /**
   * This function adds employee to the employee table
   * @param array data
   * @return boolean
   */
  public function add_payroll( $data ) {
    try {
      if ( $this->db->insert( 'payroll', $data ) ) return true;
      else  return false;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }

  /**
   * This function adds employee to the employee table
   * @param array upload data
   * @return boolean
   */
  public function add_employee( $upload_data ) {
    try {
      $this->load->helper( 'text' );
      $generated_password = '';
      for ( $i = 0; $i < 6; $i++ ) {
        $generated_password .= mt_rand( 0, 9 );
        $login = $this->input->post( 'last_name' ) . character_limiter( $this->input->
          post( 'first_name' ), 1 );
      }
      if ( $this->db->insert( 'employee', array(
        'deptid' => $this->input->post( 'department' ),
        'typeid' => $this->input->post( 'employee_type' ),
        'jobid' => $this->input->post( 'job_title' ),
        'catid' => $this->input->post( 'employee_category' ),
        'salutation' => $this->input->post( 'salutation' ),
        'ssn' => $this->input->post( 'ssn' ),
        'firstname' => $this->input->post( 'first_name' ),
        'lastname' => $this->input->post( 'last_name' ),
        'minit' => $this->input->post( 'middle_name' ),
        'dob' => $this->input->post( 'dob' ),
        'gender' => $this->input->post( 'gender' ),
        'race' => $this->input->post( 'race' ),
        'marital' => $this->input->post( 'marital_status' ),
        'address1' => $this->input->post( 'address1' ),
        'address2' => $this->input->post( 'address2' ),
        'city' => strtolower( $this->input->post( 'city' ) ),
        'state' => $this->input->post( 'state' ),
        'zipcode' => $this->input->post( 'zipcode' ),
        'country' => strtolower( $this->input->post( 'country' ) ),
        'email' => $this->input->post( 'email' ),
        'webpage' => $this->input->post( 'website' ),
        'homephone' => $this->input->post( 'home_phone' ),
        'officephone' => $this->input->post( 'office_phone' ),
        'cellphone' => $this->input->post( 'cell_phone' ),
        'regularhours' => $this->input->post( 'regular_hours' ),
        'login' => $login,
        'password' => $generated_password ) ) ) {
        $emp_id = $this->get_latest_employee_id();
        $msg = 'Login: ' . $login . "\r\n" . 'Password: ' . $generated_password;
        mail( $this->input->post( 'email' ), 'Your password for EPS', $msg,
          'From: admin@' . base_url() );
        $this->db->insert( 'hourly', array( 'hourlyrate' => $this->input->post( 'hourly_pay_rate' ),
            'empid' => $emp_id ) );
        $this->db->insert( 'emppicture', array( 'link' => $emp_id . $upload_data['file_ext'],
            'picid' => $emp_id ) );
        return true;
      } else  throw new Exception( 'Failed to add employee' );
    }
    catch ( exception $e ) {
      //DO something
      return false;
    }
  }
  /**
   * This function gets the latest employee
   * @return int employee id
   */
  public function get_latest_employee_id() {
    $this->db->select( 'empid' );
    $this->db->order_by( 'empid', 'desc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'employee' );
    if ( $query->num_rows() == 1 ) {
      $emp_id = '';
      foreach ( $query->result_array() as $row ) {
        $emp_id = $row['empid'];
      }
      return $emp_id;
    } else {
      return false;
    }

  }
  /**
   * This function adds a clockin message for an employee in the messages table.
   * @return bool
   */
  public function add_clockin_message() {
    try {
      $author = $this->get_employee_name( $this->session->userdata( 'empid' ) );
      if ( $this->db->insert( 'messages', array(
        'empid' => $this->input->post( 'employee' ),
        'message' => $this->input->post( 'clockin_message' ),
        'postedby' => $author,
        'numviews' => $this->input->post( 'views' ) ) ) ) {
        return true;
      } else {
        throw new Exception( 'An error occurred when adding clockin message' );
        return false;
      }

    }
    catch ( exception $e ) {
      //DO Something
      return false;
    }
  }

  /**
   *This function add a lock out to an employee
   * @param int employee id
   * @return boolean
   */
  public function add_lock( $emp_id ) {
    if ( ! $this->is_locked( $emp_id ) ) {
      try {
        $author = $this->get_employee_name( $this->session->userdata( 'empid' ) );
        if ( $this->db->insert( 'locks', array(
          'reasonlock' => $this->input->post( 'lock_message' ),
          'empid' => $emp_id,
          'active' => 'y',
          'lockedby' => $author,
          'datelock' => date( 'Y-m-d' ) ) ) ) return true;
        else  throw new Exception( 'An error occurred when adding lock' );
      }
      catch ( exception $e ) {
        //Do something
        return false;
      }
    }
  }
  /**
   * This function locks out an employee
   * @param int employee id
   * @return boolean
   */
  public function toggle_lock( $emp_id ) {
    if ( $this->is_locked( $emp_id ) ) {
      $lockid = '';
      foreach ( $lock as $row ) {
        $lockid = $row['lockid'];
      }
      $this->db->update( 'locks', array( 'active' => 'n' ), 'lockid = ' . $lockid );
    } else {
      $lock = $this->is_locked();
      $lockid = '';
      foreach ( $lock as $row ) {
        $lockid = $row['lockid'];
      }
      $this->db->update( 'locks', array( 'active' => 'y' ), 'lockid = ' . $lockid );
    }
  }
  /**
   * This function checks if an employee is locked out
   * @param int employee id
   * @return boolean
   */
  public function is_locked( $emp_id = '' ) {
    $this->db->select( 'lockid, empid' );
    if ( $emp_id != '' ) $this->db->where( array( 'empid' => $emp_id, 'active' =>
          'y' ) );
    else  $this->db->where( array( 'empid' => $emp_id ) );
    $this->db->order_by( 'datelock', 'desc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'locks' );
    if ( $query->num_rows() == 1 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /**
   * This function gets the total hours worked in a time span for an employee
   * @param int employee id
   * @param date start
   * @param date end
   * @return int total hours
   */
  public function get_total_hours( $emp_id, $start, $end ) {
    $this->db->select( 'roundedtime' );
    $this->db->where( array(
      'checkout >=' => $start,
      'checkout <=' => $end,
      'empid' => $emp_id,
      'checked' => 'y' ) );
    $query = $this->db->get( 'timesheet' );
    if ( $query->num_rows > 0 ) {
      $total_hours = 0;
      foreach ( $query->result_array() as $row ) {
        $total_hours = $total_hours + $row( 'roundedtime' );
      }
      return $total_hours;
    } else {
      return 0;
    }
  }
  /**
   * This function gets employee salary rate
   * @param int employee id
   * @return int salary rate
   */
  public function get_salary_rate( $emp_id ) {
    $this->db->select( 'salaryrate' );
    $this->db->where( array( 'empid' => $empid ) );
    $this->db->order_by( 'salaryid', 'desc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'salary' );
    if ( $query->num_rows() == 1 ) {
      $salary_rate = 0;
      foreach ( $query->result_array() as $row ) {
        $salary_rate = $salary_rate + $row['salaryrate'];
      }
      return $salary_rate;
    } else {
      return 0;
    }
  }
  /**
   * This function gets employee hourly rate
   * @param int employee id
   * @return int hourly rate
   */
  public function get_hourly_rate( $emp_id ) {
    $this->db->select( 'hourlyrate' );
    $this->db->where( array( 'empid' => $emp_id ) );
    $this->db->order_by( 'hourid', 'desc' );
    $this->db->limit( 1 );
    $query = $this->db->get( 'hourly' );
    if ( $query->num_rows() == 1 ) {
      $hourly_rate = 0;
      foreach ( $query->result_array() as $row ) {
        $hourly_rate = $hourly_rate + $row['hourlyrate'];
      }
      return $hourly_rate;
    } else {
      return 0;
    }
  }
  /**
   * This function gets employee bonus from bonus table.
   * @param string type
   * @param int employee id
   * @param date start
   * @param date end
   * @return int bonus
   */
  public function get_bonus( $type, $emp_id, $start = '', $end = '' ) {
    switch ( $type ) {
      case 'total':
        $this->db->select( 'bonuspayment' );

        $this->db->where( array(
          'empid' => $emp_id,
          'datebonus >=' => $start,
          'datebonus <=' => $end ) );

        $query = $this->db->get( 'bonus' );
        if ( $query->num_rows() > 0 ) {
          $bonuses = 0;
          foreach ( $query->result_array() as $row ) {
            $bonuses = $bonuses + ( int )$row['bonuspayment'];
          }
          return $bonuses;
        } else  return 0;
        break;
      case 'list':
        $this->db->select( 'bonusid, datebonus, bonuspayment, note' );
        $query = $this->db->get( 'bonus' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else {
          return false;
        }
        break;
    }
  }
  /**
   * This function gets employee deduction from deductions table.
   * @param string type
   * @param int employee id
   * @param date start
   * @param date end
   * @return int deduction
   */
  public function get_deduction( $type, $emp_id, $start = '', $end = '' ) {
    switch ( $type ) {
      case 'total':
        $this->db->select( 'amount' );
        $this->db->where( array(
          'empid' => $emp_id,
          'deductdate >=' => $start,
          'deductdate <=' => $end ) );
        $query = $this->db->get( 'deductions' );
        if ( $query->num_rows() > 0 ) {
          $deductions = 0;
          foreach ( $query->result_array() as $row ) {
            $deductions = $deductions + ( int )$row['bonuspayment'];
          }
          return $deductions;
        } else  return 0;
        break;
      case 'list':
        $this->db->where( array( 'empid' => $emp_id ) );
        $query = $this->db->get( 'deductions' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else {
          return false;
        }
        break;
    }
  }
  /**
   * This function confirms employee timesheet
   * @param int timesheet id
   * @return bool
   */
  public function confirm_timesheet( $time_id ) {
    try {
      $this->db->update( 'timesheet', array( 'checked' => 'y' ), 'timeid = ' . $time_id );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /**
   * This function gets the type of employee
   * @param int employee id
   * @return string employee type
   */
  public function type_of_employee( $emp_id ) {
    $this->db->select( 'typename' );
    $this->db->join( 'employeetype', 'employeetype.typeid = employee.typeid' );
    $this->db->where( array( 'employee.empid' => $emp_id ) );
    $query = $this->db->get( 'employee' );
    if ( $query->num_rows() > 0 ) {
      $employee_type = '';
      foreach ( $query->result_array() as $row ) {
        $employee_type .= $row['typename'];
      }
      return strtolower( $employee_type );
    } else {
      return false;
    }
  }
  /**
   * This function add pay rate for an employee
   * @param string employee time
   * @param int employee id
   * @return bool
   */
  public function add_pay_rate( $type, $emp_id ) {
    switch ( $type ) {
      case 'hourly':
        try {
          $this->db->insert( 'hourly', array(
            'empid' => $emp_id,
            'hourlyrate' => $this->input->post( 'hourly_rate' ),
            'note' => $this->input->post( 'note' ) ) );
          return true;
        }
        catch ( exception $e ) {
          //Do something
          return false;
        }
        break;
      case 'salary':
        try {
          $this->db->update( 'salary', array(
            'empid' => $emp_id,
            'salaryrate' => $this->input->post( 'salary_rate' ),
            'note' => $this->input->post( 'note' ),
            'baseyear' => $this->input->post( 'base_year' ) ) );
          return true;
        }
        catch ( exception $e ) {
          //Do something
          return false;
        }
        break;
    }

  }
  /**
   * This function adds employee pay deduction in the deductions table
   * @param int employee id
   * @return bool
   */
  public function add_deduction( $emp_id ) {
    try {
      $date = $this->input->post( 'deduction_date' );
      if ( $date == '' ) {
        $date = date( 'Y-m-d' );
      }
      $this->db->insert( 'deductions', array(
        'empid' => $emp_id,
        'deductype' => $this->input->post( 'deduction_type' ),
        'deductdate' => $date,
        'amount' => $this->input->post( 'amount' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /** This function adds employee holiday
   * @param int employee id
   * @return bool
   */
  public function add_holiday( $emp_id ) {
    try {
      $this->db->insert( 'holidays', array(
        'empid' => $emp_id,
        'datehols' => $this->input->post( 'datehols' ),
        'payment' => $this->input->post( 'amount' ),
        'note' => $this->input->post( 'note' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /** This function gets employee holiday
   * @param int employee id
   * @return array holiday
   */
  public function get_holiday( $emp_id ) {
    $this->db->select( 'holid, datehols, payment, note' );
    $query = $this->db->get( 'holidays' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /** This function adds employee bonus
   * @param int employee id
   * @return bool
   */
  public function add_bonus( $emp_id ) {
    try {
      $this->db->insert( 'bonus', array(
        'empid' => $emp_id,
        'datebonus' => $this->input->post( 'datebonus' ),
        'bonuspayment' => $this->input->post( 'amount' ),
        'note' => $this->input->post( 'note' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /** This function adds employee sick day from sickday table
   * @param int employee id
   * @return bool
   */
  public function add_sick_day( $emp_id ) {
    try {
      $this->db->insert( 'sickday', array(
        'empid' => $emp_id,
        'datesick' => $this->input->post( 'datesick' ),
        'payment' => $this->input->post( 'amount' ),
        'note' => $this->input->post( 'note' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /** This function gets employee sick day from sickday table
   * @param string type
   * @param int employee id
   * @param date start date
   * @param date end date
   * @return mixed
   */
  public function get_sick_day( $type, $emp_id, $start = '', $end = '' ) {
    switch ( $type ) {
      case 'list':
        $this->db->select( 'sickid, datesick, payment, note' );
        $this->db->where( array( 'empid' => $emp_id ) );
        $query = $this->db->get( 'sickday' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else {
          return false;
        }
        break;
      case 'total':

        break;
    }
  }
  /**
   * This function gets a pay type name from employeetype table
   * @param int pay type id
   * @return pay type name
   * 
   */
   public function get_pay_type_name($type_id){
    $this->db->select('typename');
    $this->db->where(array('typeid'=>$type_id));
    $query = $this->db->get('employeetype');
    if($query->num_rows() == 1){
        $type_name = '';
        foreach($query->result_array() as $row){
            $type_name .= $row['typename'];
        }
        return $type_name;
    }
    else{
        return false;
    }
   }
} ?>