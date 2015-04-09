<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class App extends CI_Controller {

  public function index() {
    if ( ! $this->session->userdata( 'login' ) ) $this->load->view( 'index' );
    else  redirect( 'app/dashboard' );
  }
  public function login() //Login user
    {
    $data['error'] = '';
    $this->load->library( 'form_validation' );
    $this->form_validation->set_rules( 'login', 'Login', 'required' );
    $this->form_validation->set_rules( 'password', 'Password', 'required' );

    if ( ! $this->input->post( 'submit' ) ) $this->load->view( 'login', $data );
    else {
      if ( $this->form_validation->run() == false ) {
        $this->load->view( 'login' );
      } else {
        if ( $this->employee_model->login( $this->input->post( 'login' ), $this->input->
          post( 'password' ) ) ) {
          if ( $this->employee_model->is_admin() ) redirect( 'admin/dashboard' );
          else  redirect( 'app/dashboard' );
        } else { //User data not found
          $data['error'] = 'Employee profile not found in the database!';
          $this->load->view( 'login', $data );
        }
      }
    }

  }
  public function dashboard() {
    if ( $this->session->userdata( 'empid' ) ) {
        $flash_message = $this->session->userdata('flash_message');
      if ( $this->employee_model->is_admin() ) $this->load->view( 'admin/dashboard',array('flash_message'=> $flash_message) );
      else  $this->load->view( 'dashboard' , array('flash_message'=> $flash_message));
    } else  redirect( '/app/login' );

  }

  public function logout() {
    $this->session->unset_userdata( 'login' );
    redirect( 'app/login' );
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/app.php */
