<?php class Department_model extends CI_Model {
  /**
   * This function gets all employee email address in a department
   * @param int $department_id
   * @return array $email addresses
   */
  public function get_employees_email( $deptid = '' ) {
    if ( $deptid == '' ) {
      $this->db->select( 'empid, email' );
      $this->db->where( array( 'deptid' => $this->session->userdata( 'deptid' ) ) );
      $query = $this->db->get( 'employee' );
      if ( $query->num_rows() > 0 ) {
        $result = array();
        foreach ( $query->result_array() as $row ) {
          if ( $row['empid'] == $this->session->userdata( 'empid' ) ) continue;
          else  $result[] = $row['email'];
        }
        return $result;
      } else {
        return false;
      }
    }
  }
  /**
   * This function gets name of a department
   * @param int $department_id
   * @return string $department_name
   */
  public function get_department_name( $deptid = '' ) {
    if ( $deptid == '' ) {
      $this->db->select( 'deptname' );
      $this->db->where( array( 'deptid' => $this->session->userdata( 'deptid' ) ) );
      $query = $this->db->get( 'department' );
      if ( $query->num_rows() != 0 ) {
        foreach ( $query->result_array() as $row ) {
          return $row['deptname'];
        }

      } else {
        return false;
      }
    } else {
      $this->db->select( 'deptname' );
      $this->db->where( array( 'deptid' => $deptid ) );
      $query = $this->db->get( 'department' );
      if ( $query->num_rows() != 0 ) {
        foreach ( $query->result_array() as $row ) {
          return $row['deptname'];
        }

      } else {
        return false;
      }

    }
  }
  public function get_department_list() {
    $this->db->select( 'deptid,deptname' );
    $query = $this->db->get( 'department' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /**
   * This function adds a  new department
   * @return bool
   */
  public function add_department() {
    try {
      $this->db->insert( 'department', array(
        'deptparentid' => $this->input->post( 'dept_parent' ),
        'deptname' => $this->input->post( 'dept_name' ),
        'location' => $this->input->post( 'location' ),
        'deptdesc' => $this->input->post( 'description' ),
        'messaging' => $this->input->post( 'messaging' ),
        'mandaworkdesc' => $this->input->post( 'clockout' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /**
   * This function checks if the clockout option is set to yes in department table
   * @return boolean
   */
  public function has_clockout_option() {
    $this->db->select( 'mandaworkdesc' );
    $this->db->where( array( 'deptid' => $this->session->userdata( 'deptid' ),
        'mandaworkdesc' => 'y' ) );
    $query = $this->db->get( 'department' );
    if ( $query->num_rows() == 1 ) {
      return true;
    } else {
      return false;
    }
  }
  /**
   * This function inserts a new project category in project table.
   * @return bool
   */
  public function add_project_category() {
    try {
      $this->db->insert( 'category', array(
        'deptid' => $this->input->post( 'department' ),
        'name' => $this->input->post( 'project_category_title' ),
        'categorydesc' => $this->input->post( 'project_category_desc' ) ) );
      return true;
    }
    catch ( exception $e ) {
      //DO Something
      return false;
    }
  }
  /** This function gets the project categories in a department from the project table.
   *  @param int $deptid
   *  @return array
   */
  public function get_project_categories( $deptid ) {
    $this->db->select( 'id, name' );
    $this->db->where( array( 'deptid' => $deptid ) );
    $query = $this->db->get( 'category' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /** This function gets the project categories in a department from the project table.
   *  @param int $deptid
   *  @return array
   */
  public function add_project() {
    try {
      $this->db->insert( 'project', array(
        'deptid' => $this->session->userdata( 'field_dept_id' ),
        'catid' => $this->input->post( 'catid' ) ? $this->input->post( 'catid' ) : 0,
        'projecttitle' => $this->input->post( 'project_title' ),
        'projectdesc' => $this->input->post( 'project_desc' ),
        'dateposted' => date( 'Y-m-d h:i:s' ) ) );
      $this->session->userdata( array( 'field_dept_id' => '' ) );
    }
    catch ( exception $e ) {
      //DO something
      return false;
    }
  }
  /** This function adds an ip access rule to the iptable
   * @param string $type
   * @return bool
   */
  public function add_ip_access_rules( $type ) {
    switch ( $type ) {
      case 'department':
        try {
          $this->db->insert( 'iptable', array(
            'type' => $type,
            'linkid' => $this->input->post( $type ),
            'ipaddress' => $this->input->post( 'address_sequence' ),
            'note' => $this->input->post( 'address_desc' ) ) );
          return true;
        }
        catch ( exception $e ) {
          //Do something
          return false;
        }
        break;
      case 'employee':

        break;
    }
  }
  /** This function add an event in the deptevents table
   * @param string author
   * @param strind date
   * @return bool
   */
  public function add_event( $author, $date ) {
    try {
      $this->db->insert( 'deptevents', array(
        'deptid' => $this->input->post( 'department' ),
        'eventdate' => $this->input->post( 'event_date' ),
        'eventtime' => $this->input->post( 'event_time' ),
        'eventbody' => $this->input->post( 'event_desc' ),
        'postedby' => $author,
        'dateposted' => $date,
        'expirydate' => $this->input->post( 'expiry_date' ) ? $this->input->post( 'expiry_date' ) :
          $this->input->post( 'event_date' ),
        'active' => 'y' ) );
      return true;
    }
    catch ( exception $e ) {
      //Do something
      return false;
    }
  }
  /**
   * This function gets the location of a department.
   * @param int $deptid
   * @return string
   */
  public function get_location( $deptid ) {
    $this->db->select( 'location' );
    $this->db->where( array( 'deptid' => $deptid ) );
    $query = $this->db->get( 'department' );
    if ( $query->num_rows() == 1 ) {
      $location = '';
      foreach ( $query->result_array() as $department ) {
        $location = $department['location'];
      }
      return $location;
    }
  }
  /**
   * This function gets the location of a department.
   * @param int $deptid
   * @return int
   */
  public function get_manager_id( $deptid ) {
    $this->db->select( 'managerid' );
    $this->db->where( array( 'deptid' => $deptid ) );
    $query = $this->db->get( 'department' );
    if ( $query->num_rows() == 1 ) {
      $manager = '';
      foreach ( $query->result_array() as $department ) {
        $manager = $department['managerid'];
      }
      return ( int )$manager;
    }
  }
  /**
   * This function gets the description text of a department.
   * @param int $deptid
   * @return string
   */
  public function get_description( $deptid ) {
    $this->db->select( 'deptdesc' );
    $this->db->where( array( 'deptid' => $deptid ) );
    $query = $this->db->get( 'department' );
    if ( $query->num_rows() == 1 ) {
      $desc = '';
      foreach ( $query->result_array() as $department ) {
        $desc = $department['deptdesc'];
      }
      return $desc;
    }
  }
  /**
   * This function gets the ip rules.
   * @return array
   */
  public function get_rules() {
    $this->db->select( 'ipid, linkid, type, ipaddress' );
    $query = $this->db->get( 'iptable' );
    if ( $query->num_rows() > 0 ) {
      $result = $query->result_array();
      $warped = array();
      foreach ( $result as $row ) {
        if ( $row['type'] == 'employee' ) {
          $this->db->select( 'lastname, firstname' );
          $this->db->where( 'empid', $row['linkid'] );
          $query = $this->db->get( 'employee' );
          if ( $query->num_rows() == 1 ) {
            foreach ( $query->result_array() as $block ) {
              $row['name'] = $block['lastname'] . ' ' . $block['firstname'];
            }
          }
        } elseif ( $row['type'] == 'department' ) {
          $this->db->select( 'deptname' );
          $this->db->where( 'deptid', $row['linkid'] );
          $query = $this->db->get( 'department' );
          if ( $query->num_rows() == 1 ) {
            foreach ( $query->result_array() as $block ) {
              $row['name'] = $block['deptname'];
            }
          }
        } else {
          $row['type'] = 'none';
          $row['name'] = 'none';
        }
        $warped[] = $row;
      }
      return $warped;
    } else {
      return false;
    }
  }
  /**
   * This function gets all events for a department
   * @return array events
   */
  public function get_events() {
    $this->db->select( 'eventid, eventdate, eventtime, department.deptname deptname, employee.lastname lastname, employee.firstname firstname, dateposted, expirydate' );
    $this->db->join( 'department', 'department.deptid = deptevents.deptid', 'left' );
    $this->db->join( 'employee', 'employee.empid = deptevents.postedby', 'left' );
    $query = $this->db->get( 'deptevents' );
    if ( $query->num_rows() > 0 ) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /**
   * This function generates payroll for employee
   * @param int employee id
   * @return bool
   */
  public function generate_payroll_report( $dept_id ) {
    $employees = $this->employee_model->get_employees_in_dept( $dept_id );
    $start = $this->input->post( 'start_date' );
    $end = $this->input->post( 'end_date' );
    if ( is_array( $employees ) ) {
      $result = array();
      foreach ( $employees as $employee ) {
        $totalhours = $this->employee_model->get_total_hours( $employee['empid'], $start,
          $end );
        $gross_pay = 0;
        $bonuses = $this->employee_model->get_bonus('total', $employee['empid'], $start, $end );
        $deductions = $this->employee_model->get_deduction( 'total', $employee['empid'],
          $start, $end );
        if ( $this->employee_model->get_employee_type( $employee['empid'] ) == 'salary' ) {
          $gross_pay = $this->employee_model->get_salary_rate( $employee['empid'] );
        } else {
          $gross_pay = $this->employee_model->get_hourly_rate( $employee['empid'] );
          $gross_pay = $gross_pay * $totalhours;
        }
        $net_pay = $gross_pay + $bonuses - $deductions;
        $data = array(
          'grosspay' => $gross_pay,
          'netpay' => $net_pay,
          'deductions' => $deductions,
          'additions' => $bonuses,
          'payrolldate' => date( 'Y-m-d' ),
          'hoursworked' => $totalhours,
          'startdate' => $start,
          'enddate' => $end,
          'empid' => $employee['empid'] );
        $this->employee_model->add_payroll( $data );
      }
    }
  }
  /**
   * This function gets payroll report
   * @param string report type
   * @param int department id
   * @return array payroll report
   */
  public function get_payroll_report( $type, $id ) {
    switch ( $type ) {
      case 'department':
        $this->db->select( 'payrollid, employee.empid empid, firstname, lastname, hoursworked, grosspay, netpay, startdate, enddate' );
        $this->db->join( 'payroll', 'payroll.empid = employee.empid' );
        $this->db->where( array( 'deptid' => $id ) );
        $query = $this->db->get( 'employee' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else  return false;
        break;
      case 'employee':
        $this->db->select( 'payrolldate, payrollid, employee.empid empid, firstname, lastname, hoursworked, grosspay, netpay, additions, deductions, startdate, enddate' );
        $this->db->join( 'payroll', 'payroll.empid = employee.empid' );
        $this->db->where( array( 'payroll.empid' => $id ) );
        $query = $this->db->get( 'employee' );
        if ( $query->num_rows() > 0 ) {
          return $query->result_array();
        } else  return false;

        break;
    }

  }

} ?>