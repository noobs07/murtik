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
class promo extends CI_Controller {
        
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
            $this->_content['nama'] = $this->_userData['session']['surname'];
            
        }
        $this->_content['pages'] = 'promo';
    }
    
    public function index(){

        $dataPromo = $this->promomodel->getallpromo();
        $this->_content['list_promo'] = $dataPromo;

        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/list', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
	
	public function promonew(){
        $dataPromo = $this->promomodel->getallpromo();
        $this->_content['list_promo'] = $dataPromo;
        $this->_content['pages'] = 'new_promo';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/newpromo', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
	
	public function ambilData(){
        $detailDiskon = $this->promomodel->getDetailDiskon($id);
        echo json_encode($detailDiskon[0]);
	}
	
	public function diskon(){
        $dataPromo = $this->promomodel->getdiskon();
        $diskonHotel = $this->promomodel->getdiskonHotel();
        //print_r($diskonHotel);
        $this->_content['list_promo'] = $dataPromo;
        $this->_content['tambahan'] = $diskonHotel[0]['tambahan'];
        $this->_content['tambahan_persen'] = $diskonHotel[0]['tambahan_persen'];
        $this->_content['potongan'] = $diskonHotel[0]['potongan'];
        $this->_content['potongan_persen'] = $diskonHotel[0]['potongan_persen'];
        $this->_content['pages'] = 'diskon';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('promo/diskon', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function edit($id){
        $detailPromo = $this->promomodel->getDetail($id);
        if($detailPromo==null){
            //redirect(base_url('promo'));
			echo null;
        }
		$this->_content['list_promo'] = $detailPromo;
        $this->load->view('promo/form', $this->_content);
    }
    public function updateDiskonHotel(){
        //echo "tes";
        $data = $this->input->post();
        return $this->promomodel->saveDiskonHotel($data);
    }
	
	public function EditDiskon($id_diskon){
        $detailDiskon = $this->promomodel->getDetailDiskon($id_diskon);
        if($detailDiskon==null){
            //redirect(base_url('promo'));
			echo null;
        }
		$this->_content['list_promo'] = $detailDiskon;
        $this->load->view('promo/formnew', $this->_content);
    }

    public function editprocesspromo(){
        $dataAdd = $this->input->post();
        $lastId = $dataAdd['id'];
        $dataEdit = array(
            'promo_title' => $dataAdd['promo_title'],
            'start_show' => $dataAdd['start_show'].' 00:00:00',
            'end_show'   => $dataAdd['end_show'].' 23:59:59',
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
	
	 public function editprocessdiskon(){
        //print_r($this->input->post());
        $dataAdd = $this->input->post();
        $lastId = $dataAdd['maskapai'];
        $dataEdit = array(
            'maskapai' => $dataAdd['maskapai'],
            'diskon' => $dataAdd['diskon'],
            'diskon_promo' => $dataAdd['diskon_promo'],
            'bagasi' => $dataAdd['bagasi'],
    );
        $this->promomodel->editDiskon($dataEdit, $lastId);

        redirect(base_url('promo/diskon'));

    }

    public function del($id){
        if($id==null){
            redirect(base_url('promo'));
        }

        $dataEdit = array(
            'updated_at' => date('Y-m-d h:i:s'),
            'deleted_at' => date('Y-m-d h:i:s')
        );
        $this->promomodel->DeletePromo($id);
        redirect(base_url('promo'));
    }
	
	 public function deldiskon($id_diskon){
        if($id_diskon==null){
            redirect(base_url('diskon'));
        }
        $this->promomodel->DeleteDiskon($id_diskon);
        redirect(base_url('diskon'));
    }

    public function addpromo(){
        $dataAdd = $this->input->post();
        $dataAdding = array(
            'promo_title' => $dataAdd['promo_title']
            //'start_show' => $dataAdd['start_show'].' 00:00:00',
            //'end_show'   => $dataAdd['end_show'].' 23:59:59'
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
            $configlib['source_image'] = './assets/images/promo' . $data['upload_data']['file_name'];
            $configlib['width'] = 150;
            $configlib['height'] = 100;


            $this->load->library('image_lib', $configlib);

            $this->image_lib->resize();
        }
        redirect(base_url('promo'));
    }
	
	public function adddiskon(){
        $dataAdd = $this->input->post();
        $dataAdding = array(
            'nama_maskapai' => $dataAdd['nama_maskapai'],
            'diskon' => $dataAdd['diskon'],
            'is_active_diskon' => '1'
        );

        $lastId = $this->promomodel->insert_diskon($dataAdding);

        if (!empty($_FILES['imagename']['name'])) {
            $config['upload_path'] = './assets/images/diskon/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '3000';
            $config['max_height'] = '2000';
            $new_name = 'promo' . $lastId;
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('imagename');
            $data = array('upload_data' => $this->upload->data());

            $ext = pathinfo($_FILES['imagename']['name'], PATHINFO_EXTENSION);

            $dataEdit = array(
                'image' => $new_name.'.'.$ext
            );
            $this->promomodel->editDiskon($dataEdit, $lastId);

            $configlib['image_library'] = 'gd2';
            $configlib['source_image'] = './assets/images/diskon/' . $data['upload_data']['file_name'];
            $configlib['width'] = 150;
            $configlib['height'] = 100;


            $this->load->library('image_lib', $configlib);

            $this->image_lib->resize();
        }
        redirect(base_url('promo/diskon'));
    }

}

?>
