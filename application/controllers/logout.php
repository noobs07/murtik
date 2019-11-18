<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logout
 *
 * @author andhikayogawiguna
 */
class logout extends CI_Controller {
        
    private $_content = array();
    private $_login = false;
    private $_userid = null;
    private $_userData = null;
    
    public function __construct() {
        parent::__construct();
        $this->_content['login_users'] = false;
        $this->_content['member_data'] = null;
        if($this->session->userdata('logged_in')!=null)
        {
            $this->_login = true;
            $this->_content['login_users'] = true;
            $this->_userData['session'] = $this->session->userdata('logged_in');
            $this->_userid = $this->_userData['session']['user_id'];
            
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function index(){
        session_start();
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(base_url());
    }
    
}

?>
