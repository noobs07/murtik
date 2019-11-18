<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminx
 *
 * @author andhikayogawiguna
 */
class member extends CI_Controller {
        
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
            
        }
        $this->_content['pages'] = 'member';    //
    }
    
    public function index(){

        $dataMember = $this->membermodel->getDetailMemberById();    //
        $this->_content['list_member'] = $dataMember;   //

        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/list', $this->_content);   //ini diedit tampilannya
        $this->load->view('main/footer', $this->_content);
    }
    
    public function membernew(){
        $dataMember = $this->membermodel->getDetailMemberById();    //
        $this->_content['list_member'] = $dataMember;   //
        $this->_content['pages'] = 'new_member';    //
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/newpromo', $this->_content);   //ini diedit tampilannya
        $this->load->view('main/footer', $this->_content);
    }

    public function edit($id){
        if($id==null){
            redirect(base_url('member')); //
        }
        $detailMember = $this->membermodel->updateDataMember($data,$id); //
        if($detailMember==null){
            redirect(base_url('member')); //
        }
        $this->_content['detail_member'] = $detailMember[0];    //
        $this->_content['pages'] = 'new_member';    //
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/editpromo', $this->_content); //ini diedit tampilannya
        $this->load->view('main/footer', $this->_content);
    }

    public function editprocessmember(){
        $dataAdd = $this->input->post();
        $lastId = $dataAdd['user_id'];
        $dataEdit = array(
            'firstname' => $dataAdd['firstname'],
            'lastname' => $dataAdd['lastname'],
            'surname'   => $dataAdd['surname'],
            ''
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->promomodel->editPromo($dataEdit, $lastId);

        if (!empty($_FILES['imageItem']['name'])) {
            $config['upload_path'] = './assets/images/promo/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '3000';
            $config['max_height'] = '2000';
            $new_name = 'promo' . $lastId;
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('imageItem');
            $data = array('upload_data' => $this->upload->data());

            $ext = pathinfo($_FILES['imageItem']['name'], PATHINFO_EXTENSION);

            $dataEdit = array(
                'image_name' => $new_name.'.'.$ext,
                'url_image' => base_url('assets/images/promo').'/'.$new_name.'.'.$ext
            );
            $this->promomodel->editPromo($dataEdit, $lastId);

            $configlib['image_library'] = 'gd2';
            $configlib['source_image'] = './assets/images/promo/' . $data['upload_data']['file_name'];
            $configlib['width'] = 150;
            $configlib['height'] = 100;


            $this->load->library('image_lib', $configlib);

            $this->image_lib->resize();
        }
        redirect(base_url('promo'));

    }

    public function del($id){
        if($id==null){
            redirect(base_url('promo'));
        }

        $dataEdit = array(
            'updated_at' => date('Y-m-d h:i:s'),
            'deleted_at' => date('Y-m-d h:i:s')
        );
        $this->promomodel->editPromo($dataEdit, $id);
        redirect(base_url('promo'));
    }*/

    public function addmember(){
        $dataAdd = $this->input->post();
        $dataAdding = array(
            'promo_title' => $dataAdd['promo_title'],
            'start_show' => $dataAdd['start_show'].' 00:00:00',
            'end_show'   => $dataAdd['end_show'].' 23:59:59'
        );

        $lastId = $this->promomodel->insert_promo($dataAdding);

        if (!empty($_FILES['imageItem']['name'])) {
            $config['upload_path'] = './assets/images/promo/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '3000';
            $config['max_height'] = '2000';
            $new_name = 'promo' . $lastId;
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('imageItem');
            $data = array('upload_data' => $this->upload->data());

            $ext = pathinfo($_FILES['imageItem']['name'], PATHINFO_EXTENSION);

            $dataEdit = array(
                'image_name' => $new_name.'.'.$ext,
                'url_image' => base_url('assets/images/promo').'/'.$new_name.'.'.$ext
            );
            $this->promomodel->editPromo($dataEdit, $lastId);

            $configlib['image_library'] = 'gd2';
            $configlib['source_image'] = './assets/images/promo/' . $data['upload_data']['file_name'];
            $configlib['width'] = 150;
            $configlib['height'] = 100;


            $this->load->library('image_lib', $configlib);

            $this->image_lib->resize();
        }
        redirect(base_url('promo'));
    }

}

?>
