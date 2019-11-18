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
class adminx extends CI_Controller {
        
    private $_content = array();
    private $_login = false;
    private $_userid = null;
    private $_userData = null;
    
    public function __construct() {
        parent::__construct();
        $this->_content['login_users'] = false;
        $this->_content['nama'] = false;
        $this->_content['role_id'] = false;
        $this->_content['member_data'] = null;
        if($this->session->userdata('logged_in')!=null)
        {
            $this->_login = true;
            $this->_content['login_users'] = true;
            $this->_userData['session'] = $this->session->userdata('logged_in');
            $this->_userid = $this->_userData['session']['user_id'];
            $this->_content['nama'] = $this->_userData['session']['surname'];
            $this->_content['role_id'] = $this->_userData['session']['role_id'];
            
        }else{
            redirect(base_url('login'));
        }
        $this->_content['pages'] = 'home';
    }
    
    /*public function notif(){
  $data['pesawat'] = $this->customermodel->getStatus();
  $jumlah = $this->customermodel->getJumlah();
  $data['kereta'] = count($this->customermodel->getAllTrx('kereta',0));
  $data['pelni'] = count($this->customermodel->getAllTrx('pelni',0));
  
  if ($jumlah != $data['pesawat']){
   if ($jumlah < $data['pesawat']){
    echo json_encode(1);
   } else {
    echo json_encode($data['pesawat']);
   }
   $dataUpdate = array('jumlah'=>$data['pesawat']);
   $this->customermodel->setJumlah($dataUpdate);
  } else {
   echo json_encode($data);
  }
    }*/
    public function notif(){
  $data['pesawat'] = count($this->customermodel->getNotif('pesawat'));
  $data['kereta'] = count($this->customermodel->getNotif('kereta'));
  $data['pelni'] = count($this->customermodel->getNotif('pelni'));
  $data['konfirmasi'] = count($this->customermodel->getNotif('konfirmasi'));
  $data['hotel'] = count($this->customermodel->getNotif('hotel'));
  echo json_encode($data);
    } 

    public function batalBooking(){
        $data = $this->customermodel->getBatal();
        if($data['jumlah']>0){
            echo "1";
        }else{
            echo "0";
        }
       
    }
    public function index(){
        
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(0);
        $this->_content['list_new_trx'] = $listNewTrx;

        
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function confirmBayar($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>1,
            'payment_time'=>date('Y-m-d H:i:s'),
        );
        $this->customermodel->editTrxDataBooking($dataUpdate,$id);

        
        $detailTrx = $this->customermodel->getdetailIdTrx($id);
        $pnr = $detailTrx[0]['kode_order'];
        $phone = $detailTrx[0]['phone_cust'];
        $message="Terima Kasih, Pembayaran anda dengan ID Pemesanan *".$id."* telah kami terima, Pemesanan anda sedang kami Proses, Jika dalam 60 menit kedepan tiket anda belum terkirim, silahkan hub no dibawah ini\n\nWA: 0812 83 9000 91\nCS: 021 - 8810 870";
        //echo $phone.$message;
        $dataUpdateConfirmasi = array(
            'confirmed_at'=>date('Y-m-d H:i:s'),
            'view'=>1,
            'pnr'=>$pnr
        );
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$id);
        $this->notifWA($phone, $message);
        redirect(base_url('confirm-trx'));
    }
    public function confirmBayarKAI($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>1,
            'payment_time'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editBooking('kereta',$dataUpdate,$id);

        $dataUpdateConfirmasi = array(
            'confirmed_at'=>date('Y-m-d H:i:s')
        );
        $detailTrx = $this->customermodel->getdetailIdTrxKAI($id);
        $pnr = $detailTrx[0]['retrieveKey'];
        $phone = $detailTrx[0]['phoneNo'];
        $message="Terima Kasih, Pembayaran anda dengan ID Pemesanan *".$id."* telah kami terima, Pemesanan anda sedang kami Proses, Jika dalam 60 menit kedepan tiket anda belum terkirim, silahkan hub no dibawah ini\n\nWA: 0812 83 9000 91\nCS: 021 - 8810 870";
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$pnr);
        $this->notifWA($phone, $message);
        redirect(base_url('all-trx-kai'));
    }
    public function confirmBayarPelni($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>1,
            'payment_time'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editBooking('pelni', $dataUpdate,$id);

        $dataUpdateConfirmasi = array(
            'confirmed_at'=>date('Y-m-d H:i:s')
        );
        $detailTrx = $this->customermodel->getdetailIdTrxPelni($id);
        $pnr = $detailTrx[0]['kode_booking'];
        $phone = $detailTrx[0]['phoneNo'];
        $message="Terima Kasih, Pembayaran anda dengan ID Pemesanan *".$id."* telah kami terima, Pemesanan anda sedang kami Proses, Jika dalam 60 menit kedepan tiket anda belum terkirim, silahkan hub no dibawah ini\n\nWA: 0812 83 9000 91\nCS: 021 - 8810 870";
        
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$pnr);
        $this->notifWA($phone, $message);
        redirect(base_url('all-trx-pelni'));
    }
    public function confirmBayarHotel($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>1,
            'tanggal_konfirmasi_pembayaran'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editBooking('hotel', $dataUpdate,$id);

        $dataUpdateConfirmasi = array(
            'confirmed_at'=>date('Y-m-d H:i:s')
        );
        $detailTrx = $this->customermodel->getdetailIdTrxHotel($id);
        $phone = $detailTrx[0]['telp'];
        $message="Terima Kasih, Pembayaran anda dengan ID Pemesanan *".$id."* telah kami terima, Pemesanan anda sedang kami Proses, Jika dalam 60 menit kedepan tiket anda belum terkirim, silahkan hub no dibawah ini\n\nWA: 0812 83 9000 91\nCS: 021 - 8810 870";
        
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$id);
        $this->notifWA($phone, $message);
        if($this->_content['role_id']=='3'){
            redirect(base_url('all_trx_hotel'));
        }else{
            redirect(base_url('all-trx-hotel'));
        }
        
    }
    public function notifWA($phone, $message){
        //////////////////////// send WA ////////////////////////////////
	$curl = curl_init();
    $token = "mldtsD8CZd88PtnpL9P6vVtx9mTuC7a4jzoRHqEojFgHY1jxV3wY4J1BxIvQ2Qyn";//affan 081211006904
    //$token = "sD11fUdqrKG1AIMFBaPX05cwdcdPGZMBSmDxzfiH9yzfzOhPENc0m8sKRZiaztbG"; //tri 0895395101130
    
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: $token",
        )
    );
    //$message = $_POST['message'];
    //$phone.=',081357046700';
    if($phone)
    $phone.=',081283900091,081281288879';
    else
    $phone.='081283900091,081281288879';
    
    $data = [
        'phone' => $phone,
        'message' => $message,
    ];
    
    /**
     * bulk message
    $data = [
        'phone' => '081XXXXXX91,0850011xxx',
        'message' => 'hellow world',
    ];
     */
    
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://console.wablas.com/api/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
    }
    public function deleteKonfirmasiBayar($id){
        $this->customermodel->deleteKonfirmasi($id);
        redirect(base_url('konfirmasi-bayar'));
    }
    
    public function confirmTrx(){
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(1);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'confirm_trx';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }

    public function confirmasiPembayaran(){
        $listNewTrx = $this->customermodel->getAllKonfirmasiPembayaran(2);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'confirmasi_bayar';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/konfirm_bayar', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function finishedTrx(){
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(2);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'finished_trx';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function cancelledTrx(){
        $listNewTrx = $this->customermodel->getTransactionCancelled();
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'cancelled_trx';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/canceltrx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function allTrx(){
        $listNewTrx = $this->customermodel->getAllTrxSemua();
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all-trx';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxKAI(){
        $listNewTrx = $this->customermodel->getAllTrx('kereta', 'x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all-trx-kai';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trxkai', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxPelni(){
        $listNewTrx = $this->customermodel->getAllTrx('pelni', 'x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all-trx-pelni';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trxpelni', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxHotel(){
        $listNewTrx = $this->customermodel->getAllTrx('hotel', 'x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all-trx-hotel';
        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/trxhotel', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function detailTrx($id){
        if($id==null){
            redirect(base_url());
        }
        $listNewTrx = $this->customermodel->getdetailIdTrx($id);
        echo '<pre>';
        print_r($listNewTrx);
        echo '</pre>';
        if($listNewTrx==null){
            redirect(base_url());
        }
        $this->_content['detail'] = $listNewTrx[0];
        $this->_content['pages'] = 'detail_trx';
        $this->load->view('main/header', $this->_content);
        //$this->load->view('adminx/trxdetail', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function confirmTiket(){
        $id=$this->input->post('id');
        $kode_booking=$this->input->post('kode_booking');
        if($id==null){
            redirect(base_url());
        }
        if(empty($kode_booking)){
            $dataUpdate = array(
            'status_bayar'=>2,
            'confirm_tiket_at'=>date('Y-m-d H:i:s'),
            'status_pengiriman_tiket'=>'1'
        );
        }else{
            $dataUpdate = array(
            'status_bayar'=>2,
            'kode_order'=>$kode_booking,
            'confirm_tiket_at'=>date('Y-m-d H:i:s'),
            'status_pengiriman_tiket'=>'1'
        );
        }
        
        $true = $this->customermodel->editTrxDataBooking($dataUpdate,$id);

        $listNewTrx = $this->customermodel->getdetailIdTrx($id);
        $detailTrx = $listNewTrx[0];
        /*-----------------email-----------------------------------------*/
        $url = 'http://murahtiketnya.com/API/tes_email_attachment.php';
			$fields = [
				'kode_order' => $id,
			];
			$agent = 'bukanChromeBukanFirefox';

			$timeout = 60; //detik

			$handle = curl_init();
			curl_setopt($handle,CURLOPT_URL, $url);

			//jika ingin menggunakan request bermethod POST
			curl_setopt($handle,CURLOPT_POST, 1);
			curl_setopt($handle,CURLOPT_POSTFIELDS, http_build_query($fields));
			//end POST

			curl_setopt($handle,CURLOPT_USERAGENT, $agent);
			curl_setopt($handle,CURLOPT_CONNECTTIMEOUT,$timeout);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($handle);
			$httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);

        /*if($this->_content['role_id']=='3'){
            redirect(base_url('finished_trx'));
        }else{
            redirect(base_url('finished-trx'));
        }*/
        if($true){
            echo 1;
        }else{
            echo 0;
        }
        
    }
    public function confirmTiketKAI($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>2,
            'confirm_tiket_at'=>date('Y-m-d H:i:s'),
            'status_pengiriman_tiket'=>1
        );
        $this->customermodel->editTrxDataBookingKAI($dataUpdate,$id);

        //$listNewTrx = $this->customermodel->getdetailIdTrx($id);
        //$detailTrx = $listNewTrx[0];
        /*-----------------email-----------------------------------------*/
        $url = 'http://murahtiketnya.com/API/tes_email_attachment_kai.php';
			$fields = [
				'kode_order' => $id,
			];
			$agent = 'bukanChromeBukanFirefox';

			$timeout = 60; //detik

			$handle = curl_init();
			curl_setopt($handle,CURLOPT_URL, $url);

			//jika ingin menggunakan request bermethod POST
			curl_setopt($handle,CURLOPT_POST, 1);
			curl_setopt($handle,CURLOPT_POSTFIELDS, http_build_query($fields));
			//end POST

			curl_setopt($handle,CURLOPT_USERAGENT, $agent);
			curl_setopt($handle,CURLOPT_CONNECTTIMEOUT,$timeout);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($handle);
			$httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);
			if($this->_content['role_id']=='3'){
                redirect(base_url('all_trx_kai'));
            }else{
                redirect(base_url('all-trx-kai'));
            }
    }
    public function confirmTiketPelni($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>2,
            'confirm_tiket_at'=>date('Y-m-d H:i:s'),
            'status_pengiriman_tiket'=>1
        );
        $this->customermodel->editTrxDataBookingPelni($dataUpdate,$id);

        //$listNewTrx = $this->customermodel->getdetailIdTrx($id);
        //$detailTrx = $listNewTrx[0];
        /*-----------------email-----------------------------------------*/
        $url = 'http://murahtiketnya.com/API/tes_email_attachment_pelni.php';
			$fields = [
				'kode_order' => $id,
			];
			$agent = 'bukanChromeBukanFirefox';

			$timeout = 60; //detik

			$handle = curl_init();
			curl_setopt($handle,CURLOPT_URL, $url);

			//jika ingin menggunakan request bermethod POST
			curl_setopt($handle,CURLOPT_POST, 1);
			curl_setopt($handle,CURLOPT_POSTFIELDS, http_build_query($fields));
			//end POST

			curl_setopt($handle,CURLOPT_USERAGENT, $agent);
			curl_setopt($handle,CURLOPT_CONNECTTIMEOUT,$timeout);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($handle);
			$httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);
			if($this->_content['role_id']=='3'){
                redirect(base_url('all_trx_pelni'));
            }else{
                redirect(base_url('all-trx-pelni'));
            }
    }
    public function confirmTiketHotel($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'status_bayar'=>2,
            'tanggal_konfirmasi_pembayaran'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editTrxDataBookingHotel($dataUpdate,$id);

        //$listNewTrx = $this->customermodel->getdetailIdTrx($id);
        //$detailTrx = $listNewTrx[0];
        /*-----------------email-----------------------------------------*/
        $url = 'http://murahtiketnya.com/API/tes_email_attachment_hotel.php';
			$fields = [
				'kode_order' => $id,
			];
			$agent = 'bukanChromeBukanFirefox';

			$timeout = 60; //detik

			$handle = curl_init();
			curl_setopt($handle,CURLOPT_URL, $url);

			//jika ingin menggunakan request bermethod POST
			curl_setopt($handle,CURLOPT_POST, 1);
			curl_setopt($handle,CURLOPT_POSTFIELDS, http_build_query($fields));
			//end POST

			curl_setopt($handle,CURLOPT_USERAGENT, $agent);
			curl_setopt($handle,CURLOPT_CONNECTTIMEOUT,$timeout);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($handle);
			$httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);
			if($this->_content['role_id']=='3'){
                redirect(base_url('all_trx_hotel'));
            }else{
                redirect(base_url('all-trx-hotel'));
            }
    }
 
    public function deleteTrx($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editTrxDataBooking($dataUpdate,$id);
        redirect(base_url('all-trx'));
    }
    public function deleteKAI($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editBooking('kereta',$dataUpdate,$id);
        redirect(base_url('all-trx-kai'));
    }
    public function deletePelni($id){
        if($id==null){
            redirect(base_url());
        }
        $dataUpdate = array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editBooking('pelni',$dataUpdate,$id);
        redirect(base_url('all-trx-pelni'));
    }
    public function allAdmin(){
        $list_member = $this->membermodel->getDetailMemberById($this->_userid);
        $this->_content['member'] = $list_member;
        $this->_content['pages'] = 'admin';


        $this->load->view('main/header', $this->_content);
        $this->load->view('adminx/dataAdmin', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }

    public function updateAdmin($id){
        $detailAdmin = $this->membermodel->getDetailMemberById($id);
        if ($detailAdmin ==null){
            echo null;
        }
        $this->_content['list_member']= $detailAdmin;
        $this->load->view('adminx/adminUpdate',$this->_content);
    }

    public function first_name(){
        $list_member = $this->membermodel->getDetailMemberById($this->_userid);
        $this->_content['list_member'] = $list_member;


        $this->load->view('adminx/first_name', $this->_content);  
        $this->load->view('main/footer', $this->_content);  
    }

    public function updateAdminProcess(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'first_name' => $dataAdd['first_name'],
            'last_name' => $dataAdd['last_name'],
            'surname'   => $dataAdd['surname'],
            'email'     => $dataAdd['email'],
            'password'  => md5($dataAdd ['password']),
            'phone'     => $dataAdd['phone'],
            'role_id'   => 2        
            );
        $this->membermodel->updateDataMember($dataAdding,$this->_userid);
        redirect(base_url('admin'));
    }

    public function updateFirstName(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'first_name' => $dataAdd['first_name']        
            );
         $this->membermodel->updateDataMember($dataAdding,$this->_userid);
         redirect(base_url('admin'));
    }

     public function updateLastName(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'last_name' => $dataAdd['last_name']
            );
         $this->membermodel->updateDataMember($dataAdding,$this->_userid);
         redirect(base_url('admin'));
    }

    public function updatesurname(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'surname' => $dataAdd['surname'],
            'role_id'   => 2        
            );
         $this->membermodel->updateDataMember($dataAdding,$this->_userid);
        redirect(base_url('admin'));
    }


    public function updatepassword(){
        $this->_content['pages'] = 'updateadmin';
        $inputs = $this->input->post();
         $isPassword = $this->membermodel->getDetailMemberById($this->input->post('user_id'));
         if (md5($this->input->post('passwordlama')) == $isPassword[0]['password']){
            $dataAdding = array(
            'password'  => md5($this->input->post('password'))        
            );
            $this->membermodel->updateDataMember($dataAdding,$this->_userid);
            redirect(base_url('admin'));
         } else if (md5($this->input->post('passwordlama'))!= $isPassword[0]['password']) {
            $this->_content['status'] = false;
            redirect(base_url('admin?stat=false'));
            

         }
    }

    public function updateEmail(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'email' => $dataAdd['email']        
            );
         $this->membermodel->updateDataMember($dataAdding,$this->_userid);
        redirect(base_url('admin'));
    }

    public function updatePhone(){
        $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post();
        $dataAdding = array(
            'phone' => $dataAdd['phone']        
            );
         $this->membermodel->updateDataMember($dataAdding,$this->_userid);
        redirect(base_url('admin'));
    }

}

?>
