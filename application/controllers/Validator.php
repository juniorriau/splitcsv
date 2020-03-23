<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validator extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }
    public function is_logged_in(){
        if($this->session->userdata('logged_in')){
             return true;
        }
        else{
             $this->session->set_flashdata('feedback','Please login!');
             redirect(site_url('login'));
        }
    }
}