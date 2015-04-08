<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Admin extends CI_Controller {
  public function index() {
    redirect( 'admin/dashboard' );
  }

  public function dashboard() {
    $this->load->view( 'admin/dashboard' );
  }
  public function add( $item, $specifier = '' ) {
    switch ( $item ) {
      case 'department':
        $this->load->model( 'department_model' );
        if ( ! $this->input->post( 'action_btn' ) ) {
          $this->load->view( 'admin/add_department_form', array( 'departments' => $this->
              department_model->get_department_list() ) );
        } else {
          if ( $this->department_model->add_department() ) redirect( 'admin/browse/departments' );
          else  $this->load->view( 'admin/add_department_form', array( 'departments' => $this->
                department_model->get_department_list() ) );
        }
        break;
      case 'project_category':
        $this->load->model( 'department_model' );
        if ( ! $this->input->post( 'action_btn' ) ) {
          $this->load->view( 'admin/add_project_category_form', array( 'departments' => $this->
              department_model->get_department_list() ) );
        } else {
          $this->form_validation->set_rules( 'project_category_title',
            'Project category title', 'is_unique[category.name]' );
          if ( $this->form_validation->run() == false ) {
            $this->load->view( 'admin/add_project_category_form', array( 'departments' => $this->
                department_model->get_department_list() ) );
          } else {
            $this->department_model->add_project_category();
            redirect( 'admin/browse/project_category' );
          }

        }
        break;
      case 'project':
        if ( $specifier == 'back' ) {
          $this->session->set_userdata( array( 'field_dept_id' => '' ) );
        }
        if ( ! $this->session->userdata( 'field_dept_id' ) ) {
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'select_dept', array(
              'departments' => $this->department_model->get_department_list(),
              'admin' => $this->employee_model->is_admin(),
              'url' => 'admin/add/project' ) );
          } else {
            $this->session->set_userdata( array( 'field_dept_id' => $this->input->post( 'deptid' ) ) );
            redirect( 'admin/add/project' );
          }
        } else {
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'admin/add_project_form', array( 'department' => $this->
                department_model->get_department_name( $this->session->userdata( 'field_dept_id' ) ),
                'categories' => $this->department_model->get_project_categories( $this->session->
                userdata( 'field_dept_id' ) ) ) );
          } else {
            $this->form_validation->set_rules( 'project_title', 'Project Title',
              'is_unique[project.projecttitle]' );
            if ( $this->form_validation->run() == false ) {
              $this->load->view( 'admin/add_project_form', array( 'department' => $this->
                  department_model->get_department_name( $this->session->userdata( 'field_dept_id' ) ),
                  'categories' => $this->department_model->get_project_categories( 'field_dept_id' ) ) );
            } else {
              $this->department_model->add_project();
              redirect( 'admin/browse/project' );
            }
          }

        }
        break;
      case 'ip_access_rule':
        switch ( $specifier ) {
          case 'department':
            $this->load->model( 'department_model' );
            if ( ! $this->input->post( 'action_btn' ) ) {
              $this->load->view( 'admin/ip_access_form', array( 'departments' => $this->
                  department_model->get_department_list(), 'specifier' => 'department' ) );
            } else {
              $this->form_validation->set_rules( 'address_sequence', 'IP address sequence',
                'is_unique[iptable.ipaddress] valid_ip' );
              if ( ! $this->form_validation->run() ) {
                $this->load->view( 'admin/ip_access_form', array( 'departments' => $this->
                    department_model->get_department_list(), 'specifier' => 'department' ) );
              } else {
                $this->department_model->add_ip_access_rules( 'department' );
                redirect( 'admin/browse/ip_access_rule' );
              }
            }
            break;
        }

        break;
      case 'employee':
        if ( ! $this->input->post( 'action_btn' ) ) {
          $this->load->view( 'admin/add_employee_form', array(
            'departments' => $this->department_model->get_department_list(),
            'employee_types' => $this->employee_model->get_employee_type(),
            'categories' => $this->employee_model->get_category(),
            'job_titles' => $this->employee_model->get_job_title() ) );
        } else {
          $this->form_validation->set_rules( 'ssn', 'SSN',
            'is_unique[employee.ssn] numeric' );
          $this->form_validation->set_rules( 'email', 'Email', 'valid_email' );
          $this->form_validation->set_rules( 'first_name', 'Firstname', 'alpha' );
          $this->form_validation->set_rules( 'last_name', 'Lastname', 'alpha' );
          $this->form_validation->set_rules( 'city', 'City', 'alpha' );
          $this->form_validation->set_rules( 'country', 'Country', 'alpha' );
          $this->form_validation->set_rules( 'state', 'State', 'alpha' );
          $this->form_validation->set_rules( 'zipcode', 'Zip code', 'numeric' );
          $this->form_validation->set_rules( 'hourly_pay_rate', 'Hourly pay rate',
            'numeric' );
          $this->form_validation->set_rules( 'regular_hours', 'Regular hours', 'numeric' );
          if ( ! $this->form_validation->run() ) {
            $this->load->view( 'admin/add_employee_form', array(
              'departments' => $this->department_model->get_department_list(),
              'employee_types' => $this->employee_model->get_employee_type(),
              'categories' => $this->employee_model->get_category(),
              'job_titles' => $this->employee_model->get_job_title() ) );
          } else {
            if ( ! $this->upload->do_upload( 'picture' ) ) {
              $this->load->view( 'admin/add_employee_form', array(
                'departments' => $this->department_model->get_department_list(),
                'employee_types' => $this->employee_model->get_employee_type(),
                'categories' => $this->employee_model->get_category(),
                'job_titles' => $this->employee_model->get_job_title(),
                'message' => $this->upload->display_errors() ) );
            } else {
              $upload_data = $this->upload->data();
              if ( $this->employee_model->add_employee( $upload_data ) ) {
                $emp_id = $this->employee_model->get_latest_employee_id();
                $new_path = $upload_data['file_path'] . $emp_id . $upload_data['file_ext'];
                rename( $upload_data['full_path'], $new_path );
                redirect( 'admin/browse/employee/' . $emp_id );
              }

            }
          }
        }
        break;
      case 'event':
        $this->load->model( 'department_model' );
        if ( ! $this->input->post( 'action_btn' ) ) {
          $this->load->view( 'admin/add_department_event', array( 'departments' => $this->
              department_model->get_department_list() ) );
        } else {
          $event = $this->input->post( 'event_date' ) . ' ' . $this->input->post( 'event_time' );
          if ( strtotime( $event ) < strtotime( date( 'Y-m-d H:i' ) ) ) {
            $this->load->view( 'admin/add_department_event', array( 'departments' => $this->
                department_model->get_department_list(), 'message' =>
                'Event cannot be set to the past' ) );
          } else {
            $author = $this->employee_model->get_employee_name();
            $date = date( 'Y-m-d' );
            if ( $this->department_model->add_event( $author, $date ) ) {
              redirect( 'admin/browse/event' );
            } else {
              $this->load->view( 'admin/add_department_event', array( 'departments' => $this->
                  department_model->get_department_list(), 'message' => 'An error has occurred' ) );
            }
          }
        }
        break;
      case 'clockin_message':
        if ( $specifier == 'back' ) {
          $this->session->set_userdata( array( 'field_dept_id' => '' ) );
        }
        if ( ! $this->session->userdata( 'field_dept_id' ) ) {
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'select_dept', array(
              'departments' => $this->department_model->get_department_list(),
              'admin' => $this->employee_model->is_admin(),
              'url' => 'admin/add/clockin_message' ) );
          } else {
            $this->session->set_userdata( array( 'field_dept_id' => $this->input->post( 'deptid' ) ) );
            redirect( 'admin/add/clockin_message' );
          }
        } else {
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'admin/clockin_message_form', array( 'department' => $this->
                department_model->get_department_name( $this->session->userdata( 'field_dept_id' ) ),
                'employees' => $this->employee_model->get_employees_in_dept( $this->session->
                userdata( 'field_dept_id' ) ) ) );
          } else {
            $this->form_validation->set_rules( 'views', 'Number of views', 'numeric' );
            $this->form_validation->set_rules( 'clockin_message', 'Clockin message',
              'required' );
            if ( ! $this->form_validation->run() ) {
              $this->load->view( 'admin/clockin_message_form', array( 'department' => $this->
                  department_model->get_department_name( $this->session->userdata( 'field_dept_id' ) ),
                  'employees' => $this->employee_model->get_employees_in_dept( $this->session->
                  userdata( 'field_dept_id' ) ) ) );
            } else {
              $this->employee_model->add_clockin_message();
              redirect( 'admin/browse/clockin_message' );
            }
          }

        }
        break;
      case 'employee_lock':
        if ( $specifier == '' ) {
          $this->load->view( 'admin/employee_lock_master', array(
            'employees' => $this->employee_model->get_employees_in_dept( '', 'locks' ),
            'lock_controller' => 'admin/add/employee_lock/',
            'unlock_controller' => 'admin/unlock/employee/' ) );
        } else {
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'admin/add_lock_form', array( 'employee_name' => $this->
                employee_model->get_employee_name( $specifier ), 'controller' =>
                'admin/add/employee_lock/' . $specifier ) );
          } else {
            $this->employee_model->add_lock( $specifier );
            $this->load->view( 'admin/employee_lock_master', array( 'message' => $this->
                employee_model->get_employee_name( $specifier ) . ' has been locked out' ) );
          }
        }
        break;
      case 'timesheet_record':
        if ( ! $this->input->get( 'emp_id' ) ) {
          $this->load->view( 'admin/employee_select_master', array( 'employees' => $this->
              employee_model->get_employees_in_dept(), 'controller' => 'admin/add/timesheet' ) );
        }
        break;
      case 'salary':
      if(!$this->input->get('dept_id')){
        $this->load->view('admin/department_select_master',array('departments'=>$this->department_model->get_department_list(),'controller'=>'admin/add/salary'));
      }else{
        if(!$this->input->get('emp_id')){
            $dept_id = $this->input->get('dept_id');
        $this->load->view('admin/employee_select_master', array('employees'=>$this->employee_model->get_employees_in_dept($dept_id),'controller'=>'admin/add/salary?dept_id='.$dept_id));
        }
        else{
            $emp_id = $this->input->get('emp_id');
            $url = $this->input->server('HTTP_REFERER');
            if(!$this->input->post('action_btn')){
                $this->load->view('admin/salary_form', array('employee_name'=>$this->employee_model->get_employee_name($emp_id),'employee_type'=>$this->employee_model->get_employee_type($emp_id),'controller'=>$url.'?emp_id='.$emp_id));
            }else{
                $type_of_employee = $this->employee_model->type_of_employee($emp_id);
                if( $type_of_employee == 'salary'){
                    $this->employee_model->add_pay_rate('salary',$emp_id);
                }
                else{
                    $this->employee_model->add_pay_rate('hourly',$emp_id);
                }
            }
        }
      }
        break;
      case 'deduction':
        break;
      case 'holiday':
        break;
      case 'bonus':
        break;
      case 'sickday':
        break;
    }
  }
  public function browse( $item, $specifier = '' ) {
    switch ( $item ) {
      case 'department':
        if ( $specifier == '' ) {
          $this->load->view( 'admin/department_master', array( 'departments' => $this->
              department_model->get_department_list() ) );
        } else {
          $this->load->view( 'admin/department', array(
            'department_name' => $this->department_model->get_department_name( $specifier ),
            'location' => $this->department_model->get_location( $specifier ),
            'manager' => $this->employee_model->get_employee_name( $this->department_model->
              get_manager_id( $specifier ) ),
            'desc' => $this->department_model->get_description( $specifier ),
            'employees' => $this->employee_model->get_employees_in_dept( $specifier ) ) );
        }
        break;
      case 'project_category':
        $this->load->view( 'admin/category_master', array( 'project_categories' => $this->
            project_model->get_category_master() ) );
        break;
      case 'project':
        $this->load->view( 'admin/project_master', array( 'projects' => $this->
            project_model->listing() ) );
        break;
      case 'ip_access_rule':
        $this->load->view( 'admin/ip_access_rule_master', array( 'rules' => $this->
            department_model->get_rules() ) );
        break;
      case 'event':
        $this->load->view( 'admin/event_master', array( 'events' => $this->
            department_model->get_events() ) );
        break;
      case 'payroll':
        $this->load->view(); //TODO
        break;
    }
  }
  public function edit( $item ) {
    switch ( $item ) {
      case 'timesheet':
        if ( ! $this->input->get( 'emp_id' ) ) {
          $this->load->view( 'admin/employee_select_master', array( 'employees' => $this->
              employee_model->get_employees_in_dept(), 'controller' => 'admin/edit/timesheet' ) );
        } else {
          $emp_id = $this->input->get( 'emp_id' );
          if ( ! $this->input->get( 'step' ) ) $this->load->view( 'admin/employee_timesheet_master',
              array( 'timesheets' => $this->employee_model->get_time_records( $emp_id ) ) );
        }
        break;
        //        case '':
        //        break;
        //        case '';
        //        break;
    }
  }
  public function generate( $item, $specifier = '' ) {
    switch ( $item ) {
      case 'payroll_report':
        if ( ! $this->input->get( 'dept_id' ) ) {
          $this->load->view( 'admin/department_select_master', array( 'departments' => $this->
              department_model->get_department_list(), 'controller' =>
              'admin/generate/payroll_report' ) );
        } else {
          $dept_id = $this->input->get( 'dept_id' );
          if ( ! $this->input->post( 'action_btn' ) ) {
            $this->load->view( 'admin/time_span_form', array( 'controller' =>
                'admin/generate/payroll_report?dept_id=' . $dept_id, 'title' =>
                'Specify dates for which to generate payroll report' ) );
          } else {
            $this->department_model->generate_payroll_report( $dept_id );
            $this->load->view( 'admin/payroll_report', array( 'reports' => $this->
                department_model->get_payroll_report( $dept_id ) ) );
          }

        }
        break;
    }
  }
  public function check( $item, $specifier = '' ) {
    switch ( $item ) {
      case 'timesheet':
        if ( ! $this->input->get( 'dept_id' ) ) {
          $this->load->view( 'admin/department_select_master', array( 'departments' => $this->
              department_model->get_department_list(), 'controller' => 'admin/check/timesheet' ) );
        } else {
          if ( ! $this->input->get( 'emp_id' ) ) {
            $dept_id = $this->input->get( 'dept_id' );
            $this->load->view( 'admin/employee_select_master', array( 'employees' => $this->
                employee_model->get_employees_in_dept( $dept_id ), 'controller' =>
                'admin/check/timesheet?dept_id=' . $dept_id ) );
          } else {
            $emp_id = $this->input->get( 'emp_id' );
            if ( ! $this->input->get( 'timesheet_id' ) ) {
              $this->load->view( 'admin/employee_timesheet_master', array( 'timesheets' => $this->
                  employee_model->get_time_records( $emp_id ), 'employee_name' => $this->
                  employee_model->get_employee_name( $emp_id ) ) );
            }

          }
        }
        break;
    }
  }
  public function confirm( $item, $specifier = '' ) {
    switch ( $item ) {
      case 'timesheet':
        if ( ! $this->input->get( 'id' ) ) {
          redirect( 'admin/check/timesheet' );
        } else {
          $url = $this->input->server( 'HTTP_REFERER' );
          $time_id = $this->input->get( 'id' );
          $this->employee_model->confirm_timesheet( $time_id );
          redirect( $url );
        }
        break;
    }
  }
} ?>