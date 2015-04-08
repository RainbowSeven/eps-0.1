<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Perform extends CI_Controller
{

  public function checkin()
  {
    if ($this->session->userdata('login')) {
      if (! $this->input->post('submit')) //check in form not submitted
        {
        $this->load->view('check/in_form');
      } else {
        if ($this->employee_model->checkin()) //checkin success
          {
          $this->load->view('check/success', array(
            'timenow' => $this->input->post('timenow'),
            'response' => 'y',
            'message' => 'Work hard and do not forget to check out when you finish working.',
            'job' => 'check in'));
        } else //checkin failed
        {
          $this->load->view('check/success', array(
            'timenow' => $this->input->post('timenow'),
            'response' => 'n',
            'message' => '',
            'job' => 'check in'));
        }

      }
    } else {
      redirect('app/login');
    }
  }
  public function checkout()
  {
    $this->form_validation->set_rules('desc', 'Work description', 'required');
    if (! $this->input->post('submit')) //check out form not submitted
      {
      $this->load->model('project_model');
      $project_listing = $this->project_model->listing($this->session->userdata('deptid'));
      $this->load->view('check/out_form', array('project_listing' => $project_listing, 'clockout_option'=>$this->department_model->has_clockout_option()));
    } else {
      if ($this->employee_model->checkout()) //checkout success
        {
        $this->load->view('check/success', array(
          'timenow' => $this->input->post('timenow'),
          'response' => 'y',
          'message' => 'Rest well and do not forget to check in when you finish resting.',
          'job' => 'check out'));
      } else //checkin failed
      {
        $this->load->view('check/success', array(
          'timenow' => $this->input->post('timenow'),
          'response' => 'n',
          'message' => '',
          'job' => 'check in'));
      }

    }
  }
  public function generate_timesheet()
  {
    $data['timesheet'] = $this->employee_model->generate_timesheet();
    $this->load->view('timesheet', $data);
  }
  public function email($recipient)
  {
    if ($recipient == 'manager') {
      if ($this->employee_model->has_manager()) {
        if (! $this->input->post('action_btn')) {
          $this->load->view('email_form', array('manager_name' => $this->employee_model->
              get_employee_name($this->employee_model->has_manager()), 'recipient' =>
              'manager'));
        } else {
          mail($this->employee_model->get_employee_email($this->employee_model->
            has_manager()), $this->input->post('subject'), $this->input->post('message'),
            'Reply-To:' . $this->employee_model->get_employee_email($this->session->
            userdata('empid')));
          $this->load->view('email_success');
        }

      } else {
        $this->load->view('error', array('error' =>
            'No manager has been assigned to your department.<br /> Contact administrator.'));
      }
    } elseif ($recipient == 'department') {
      if (! $this->input->post('action_btn')) {
        $this->load->view('email_form', array('dept_name' => $this->department_model->
            get_department_name(), 'recipient' => 'department'));
      } else {
        foreach ($this->department_model->get_employees_email() as $email) {
          mail($email, $this->input->post('subject'), $this->input->post('message'),
            'Reply-To:' . $this->employee_model->get_employee_email($this->session->
            userdata('empid')));
        }
      }
    }

  }
  public function password_change()
  {
    $data['msg'] = '';
    $data['class'] = '';
    if (! $this->input->post('action_btn')) { //Form not submitted.
      $this->load->view('password_change', $data);
    } else { //Form Submitted.
      if ($this->employee_model->verify_password($this->input->post('old_password'))) {
        if ($this->employee_model->password_change()) {
          $data['msg'] = 'Password Change Successful';
          $data['class'] = 'success';
          $this->load->view('password_change_success');
        }
      } else {
        $data['msg'] = 'The old password could not be matched.';
        $data['class'] = 'warning';
        $this->load->view('password_change', $data);
      }

    }
  }
  public function edit_my_info()
  {

  }
  public function view_employees($deptid = '')
  {
    if ($deptid == '') {
      if (! $this->input->post('action_btn')) $this->load->view('select_dept', array('departments' =>
            $this->department_model->get_department_list(),'url'=>'perform/view_employees'));
      else  redirect('perform/view_employees/' . $this->input->post('deptid'));
    } else {
      $this->load->view('dept_employee_list', array('dept_name' => $this->
          department_model->get_department_name((int)$deptid), 'employee_list' => $this->
          employee_model->get_employees_in_dept((int)$deptid)));
    }
  }
  public function search()
  {
    if(!$this->input->post('action_btn'))
    $this->load->view('search_form');
    else
    $this->load->view('search_result', array('needle'=>$this->input->post('needle'),
                                    'results'=>$this->employee_model->search($this->input->post('needle'))
    ));
  }
  public function org_chart()
  {

  }
  public function view_checked_in()
  {
    $this->load->view('employee_checked_in',array('checkers'=>$this->employee_model->get_employee_checkedin(),'department'=>$this->department_model->get_department_name()));
  }
  public function view_all_checked_in()
  {
    $this->load->view('employee_checked_in',array('checkers'=>$this->employee_model->get_employee_checkedin('all'),'department'=>'all departments'));
  }
  public function view_employee_info($empid=''){
    if($empid != ''){
        $data['employee_record'] = $this->employee_model->get_employee_detail((int)$empid);
        if($this->employee_model->has_manager($empid)){
            $data['manager'] = $this->employee_model->get_employee_name($this->employee_model->has_manager($empid));
        } else
        $data['manager'] = 'No managers';
        $this->load->view('view_employee_detail',$data);
    }
  }
  public function view_timerecord()
  {
    $this->load->view('time_record',array('records'=>$this->employee_model->get_time_records()));
  }
  

}

/* End of file perform.php */
