<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author andhikayogawiguna
 */
class login extends CI_Controller {
        
    private $_content = array();
    private $_login = false;
    private $_userid = null;
    private $_userData = null;
    
    public function __construct() {
        parent::__construct();
        $this->_content['login_users'] = false;
        $this->_content['member_data'] = null;
    }
    
    public function index(){
        $this->load->view('main/header_login', $this->_content);
        $this->load->view('adminx/login', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function processLogin(){
        $inputs = $this->input->post();
        if($inputs==null){
            redirect(base_url('login'));
        }
        $dataLogin = array(
            'email'=>$this->input->post('email_login'),
            'password'=>md5($this->input->post('pass_login'))
        );
        
        $isLoginData = $this->membermodel->memberLoginCheck($dataLogin);
        
        if($isLoginData==null){
            $urlFalseLogin= base_url('login?false=true');
            redirect($urlFalseLogin);
        }else{
            $loginData = (array) $isLoginData[0];
            $sess_array = array(
                'user_id' => $loginData['user_id'],
                'role_id' => $loginData['role_id'],
                'surname' => $loginData['surname']
            );
            $this->session->set_userdata('logged_in', $sess_array);
            
            if($loginData['role_id']==1){
                $urlSuccessLogin = base_url();
            }else if ($loginData['role_id']==2) {
                $urlSuccessLogin = base_url();
            }
            else if ($loginData['role_id']==3){
                $urlSuccessLogin = base_url('superadminx');
            }
//            echo '<pre>';
//            print_r($loginData);
//            echo '</pre>';
            redirect($urlSuccessLogin);
        }
        
    }
    
}

?>
