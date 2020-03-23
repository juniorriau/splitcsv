<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
	    parent::__construct();
		$this->load->model('User_model');
	}
	 
	public function index()
	{
		$data=array("action"=> site_url("login/validate"));
        $this->load->view('login', $data);
	}
	public function validate(){
		$this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
				'username' => $this->input->post('username',TRUE),
                'password'=>sha1($this->config->item('encryption_key').$this->input->post('password',TRUE)),
            );

            $u=$this->User_model->get_by_user($data);
			if($u){
				$session_data=array(
					"id"=>$u->id,
					"username"=>$u->username,
                );
                $this->session->set_userdata("logged_in",$session_data);
				redirect(site_url('data'));
			}
			else{
				redirect(site_url('login'));
			}
        }
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in',"");
        redirect(site_url('login'));
	}
	public function _rules() 
    {
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
