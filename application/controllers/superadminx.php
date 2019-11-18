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
class superadminx extends CI_Controller {
        
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
            $this->_content['role_id'] = $this->_userData['session']['role_id'];
            $this->_content['nama'] = $this->_userData['session']['surname'];
        }else{
            redirect(base_url('login'));
        }
        $this->_content['pages'] = 'home';
    }
    
    public function index(){
        
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(0); 
        $this->_content['list_new_trx'] = $listNewTrx;
               
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/supertrx', $this->_content);
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
        //$pnr = $detailTrx[0]['retrieveKey'];
        $pnr="";
        $phone = $detailTrx[0]['phoneNo'];
        $message="Terima Kasih, Pembayaran anda dengan ID Pemesanan *".$id."* telah kami terima, Pemesanan anda sedang kami Proses, Jika dalam 60 menit kedepan tiket anda belum terkirim, silahkan hub no dibawah ini\n\nWA: 0812 83 9000 91\nCS: 021 - 8810 870";
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$id);
        $this->notifWA($phone, $message);
        if($this->_content['role_id']=='3'){
            redirect(base_url('all_trx_kai'));
        }else{
            redirect(base_url('all_trx_kai'));
        }
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
        $this->customermodel->editTrxDataKonfirmasi($dataUpdateConfirmasi,$id);
        $this->notifWA($phone, $message);
        if($this->_content['role_id']=='3'){
            redirect(base_url('all_trx_pelni'));
        }else{
            redirect(base_url('all_trx_pelni'));
        }
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
    $token = "yeXedDlES7J07eDSQPLq8TVTY8RqJtVwjgxwRKlBRoyUxuPztYOeCiZINBaSqPyc";//affan 081211006904
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
    curl_setopt($curl, CURLOPT_URL, "https://wablas.com//api/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
    }
    public function deleteKonfirmasiBayar($id){
        $this->customermodel->deleteKonfirmasi($id);
        redirect(base_url('konfirmasi_bayar'));
    }
    
    public function confirmTrx(){
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(1);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'confirm_trx';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/supertrx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }

    public function confirmasiPembayaran(){
        $listNewTrx = $this->customermodel->getAllKonfirmasiPembayaran(2);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'confirmasi_bayar';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/konfirm_bayar', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function finishedTrx(){
        $listNewTrx = $this->customermodel->getAllTransactionByStatus(2);
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'finished_trx';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/supertrx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxPesawatbyStatus(){
        $status=$_POST['status'];
        $listNewTrx = $this->customermodel->getAllTransactionByStatus($status);
        if($listNewTrx==null):?>
                            <tr>
                                <td colspan="4">belum ada data transaksi</td>
                            </tr>
                            <?php else: ?>
                            <?php 
                            $no = 0;
                            foreach($listNewTrx as $trx){ 
                                if($trx['deleted_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id_cust_order']?></td>
                                <td><?= $trx['kode_order']?></td>
                                <td><?= $trx['firstname_cust']?></td>
                                <td><?= $trx['kode_maskapai']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['time_order']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= $trx['bank_pengirim']?></td>
                                <td><?= number_format($trx['total_bayar'],0,'',',')?></td>
                                <td class="actions">
                                    <a href="http://murahtiketnya.com/API/get_order.php?kode_order=<?=$trx['id_cust_order']?>" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['status_bayar']==0):?>
                                    <a href="<?= base_url('adminx/confirmBayar').'/'.$trx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                        <button class="btn btn-sm btn-warning" onclick="showPrompt(<?=$trx['id_cust_order']?>)">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deleteTrx').'/'.$trx['id_cust_order']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                            endif;
    }
    
    public function cancelledTrx(){
        $listNewTrx = $this->customermodel->getTransactionCancelled();
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'cancelled_trx';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/canceltrx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function allTrx(){
        $listNewTrx = $this->customermodel->getAllTrxSemua();
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all_trx';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/trx', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxKAI(){
        $listNewTrx = $this->customermodel->getAllTrx('kereta','x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all_trx_kai';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/trxkai', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxKAIbySTatus(){
        $status=$_POST['status'];
        $listNewTrx = $this->customermodel->getAllTrx('kereta',$status);
        if($listNewTrx==null):
                            ?><tr>
                                <td colspan="4">belum ada data transaksi</td>
                            </tr>
                            <?php else:
                                $no = 0;
                            foreach($listNewTrx as $trx){ 
                                if($trx['deleted_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id_cust_order']?></td>
                                <td><?= $trx['kode_booking']?></td>
                                <td><?= $trx['retrieveKey']?></td>
                                <td><?= $trx['kereta']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['created_at']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['timelimit']))?></td>
                                <td><?= number_format($trx['total_fare'],0,'',',')?></td>
                                <td class="actions">
                                    <a href="http://murahtiketnya.com/API/get_order_kai.php?kode_order=<?=$trx['id_cust_order']?>" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['status_bayar']==0):?>
                                    <a href="<?= base_url('adminx/confirmBayarKAI').'/'.$trx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                    <a href="<?= base_url('adminx/confirmTiketKAI').'/'.$trx['id_cust_order']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deleteKAI').'/'.$trx['id_cust_order']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                                endif;
    }
    public function penumpangPelni(){
        $id = $_POST['id'];
        $listPenumpang = $this->customermodel->getPenumpangPelni($id);
        //print_r($listPenumpang);
        echo '<fieldset><legend>Daftar Penumpang</legend>';
        $o=0;
        echo '<form method="post" accept-charset="utf-8" action="'.base_url().'index.php/superadminx/updateKursiPelni">';
        if($listPenumpang!=0){
        foreach($listPenumpang as $penumpang){    
            echo '<div class="form-group">
                                    <label class="col-lg-5 control-label" for="typeahead">'.$penumpang['name'].'</label>
                                    <div class="col-lg-2">:</div>
                                    <div class="col-lg-5">
                                    <input type="hidden" name="id'.$o.'" id="id'.$o.'" value="'.$penumpang['id'].'">
                                        <input type="text" placeholder="ruangan" class="form-control col-md-6" id="seat'.$o.'" autocomplete="off" name="seat'.$o.'" value="'.$penumpang['ruang'].'">
                                    </div>
                                </div>';
                                $o++;
        }
                    echo '<input type="hidden" name="jumlah_data" id="jumlah_data" value="'.$o.'">
                    <button type="submit" class="btn btn-primary">Save</button>';
        }else{
            echo "data kosong";
        }
        echo "</form>";
    }
    public function updateKursiPelni(){
        $jumlah = $_POST['jumlah_data'];
        for($i=0;$i<$jumlah;$i++){
            $this->customermodel->updateKursiPelni($_POST['id'.$i], $_POST['seat'.$i]);
        }
         if($this->_content['role_id']=='3'){
            redirect(base_url('all_trx_pelni'));
        }else{
            redirect(base_url('all-trx-pelni'));
        }
        
        
    }
    public function allTrxPelnibyStatus(){
        $status=$_POST['status'];
        $listNewTrx = $this->customermodel->getAllTrx('pelni',$status);
        if($listNewTrx==null):
                            ?><tr>
                                <td colspan="4">belum ada data transaksi</td>
                            </tr>
                            <?php else:
                                $no = 0;
                            foreach($listNewTrx as $trx){ 
                                if($trx['deleted_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id_cust_order']?></td>
                                <td><?= $trx['kode_booking']?></td>
                                <td><?= $trx['nama_kapal']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['created_at']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} else
                                    {echo "sudah";}?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['timelimit']))?></td>
                                <td><?= number_format($trx['booking_balance'],0,'',',')?></td>
                                <td class="actions">
                                    <a href="http://murahtiketnya.com/API/get_order_pelni.php?kode_order=<?=$trx['id_cust_order']?>" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['status_bayar']==0):?>
                                    <a href="<?= base_url('adminx/confirmBayarPelni').'/'.$trx['id_cust_order']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                    <a href="<?= base_url('adminx/confirmTiketPelni').'/'.$trx['id_cust_order']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deletePelni').'/'.$trx['id_cust_order']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                                endif;
    }
    public function allTrxHotelbyStatus(){
        $status=$_POST['status'];
        $listNewTrx = $this->customermodel->getAllTrx('hotel',$status);
        if($listNewTrx==null):
                            ?><tr>
                                <td colspan="4">belum ada data transaksi</td>
                            </tr>
                            <?php else:
                                $no = 0;
                            foreach($listNewTrx as $trx){ 
                                if($trx['delete_at']!=null){
                                    $classTr = 'danger';
                                }else{
                                    $classTr = 'success';
                                }
                                $no++;?>
                            <tr class="<?= $classTr;?>">
                                <td><?= $no;?></td>
                                <td><?= $trx['id']?></td>
                                <td><?= $trx['kode_booking']?></td>
                                <td><?= $trx['time_limit']?></td>
                                <td><?= date('d-m-Y H:i:s',strtotime($trx['tanggal_pesan']))?></td>
                                <td><?php if ($trx['status_bayar'] == 0)
                                    {echo "belum";} elseif($trx['status_bayar'] == 1)
                                    {echo "sudah";}else{echo "menunggu Konfirmasi";}?></td>
                                <td><?= number_format($trx['total_harga'],0,'',',')?></td>
                                <td class="actions">
                                    <?php if(empty($trx['kode_booking'])&&$trx['status_bayar']=='1'){?>
                                    <button class="btn btn-sm btn-primary" onclick="showPrompt(<?=$trx['id']?>)">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Kode Booking
                                        </button>
                                    <?php } ?>
                                    <a href="http://murahtiketnya.com/API/get_order_hotel.php?kode_order=<?=$trx['id']?>&web=1" target=_blank>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-share"></i>
                                            Detail
                                        </button>
                                    </a>
                                    <?php if($trx['view']=='1'){?><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button><?php }?>
                                    <?php if($trx['status_bayar']==3):?>
                                    <a href="<?= base_url('adminx/confirmBayarHotel').'/'.$trx['id']?>" class="confirmbayar" >
                                        <button class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            Konfirmasi Pembayaran
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($trx['status_bayar']==1):?>
                                    <a href="<?= base_url('adminx/confirmTiketHotel').'/'.$trx['id']?>" class="confirmtiket">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            Konfirmasi Tiket
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('adminx/deleteHotel').'/'.$trx['id']?>" class="deleteTrx">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Delete
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                            endif;
    }
    
    public function allTrxPelni(){
        $listNewTrx = $this->customermodel->getAllTrx('pelni', 'x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all_trx_pelni';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/trxpelni', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function allTrxHotel(){
        $listNewTrx = $this->customermodel->getAllTrx('hotel', 'x');
        $this->_content['list_new_trx'] = $listNewTrx;
        $this->_content['pages'] = 'all_trx_hotel';
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/trxhotel', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    public function updateKodeBookingKAI(){
        $id=$_POST['id'];
        $kode_booking=$_POST['kode_booking'];
        $data=array(
            'kode_booking'=>$kode_booking
            );
        $update = $this->customermodel->updateKodeKAI($id, $data);
        if($update==1){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function updateKodeBookingPelni(){
        $id=$_POST['id'];
        $kode_booking=$_POST['kode_booking'];
        $data=array(
            'kode_booking'=>$kode_booking
            );
        $update = $this->customermodel->updateKodePelni($id, $data);
        if($update==1){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function updateKodeBookingHotel(){
        $id=$_POST['id'];
        $kode_booking=$_POST['kode_booking'];
        $data=array(
            'kode_booking'=>$kode_booking
            );
        $update = $this->customermodel->updateKodeHotel($id, $data);
        if($update==1){
            echo 1;
        }else{
            echo 0;
        }
    }


    //ini tidak dipakai ?
    public function detailTrx($id){
        if($id==null){
            redirect(base_url('superadmin'));
        }
        $listNewTrx = $this->customermodel->getdetailIdTrx($id);
        echo '<pre>';
        print_r($listNewTrx);
        echo '</pre>';
        if($listNewTrx==null){
            redirect(base_url('superadmin'));
        }
        $this->_content['detail'] = $listNewTrx[0];
        $this->_content['pages'] = 'detail_trx';
        $this->load->view('main/headersuper', $this->_content);
        //$this->load->view('adminx/trxdetail', $this->_content);
        $this->load->view('main/footer', $this->_content);
    }
    
    public function confirmTiket($id){
        if($id==null){
            redirect(base_url('superadmin'));
        }
        $dataUpdate = array(
            'status_bayar'=>2,
            'confirm_tiket_at'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editTrxDataBooking($dataUpdate,$id);

        $listNewTrx = $this->customermodel->getdetailIdTrx($id);
        $detailTrx = $listNewTrx[0];

        /*$this->load->library('email');
        $this->email->from('cs@affanutama.co.id', 'Affan Utama Ticket');
        $this->email->to($detailTrx['email_cust']);
        $this->email->subject('Email Ticket');
        $this->email->message('Your ticket has been confirm. Thanks :) ');
        $this->email->send();*/
        /*-----------------email-----------------------------------------*/
        $url = 'https://murahtiketnya.com/API/tes_email_attachment.php';
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

        redirect(base_url('finished_trx'));
    }
 
    public function deleteTrx($id){
        if($id==null){
            redirect(base_url('superadmin'));
        }
        $dataUpdate = array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );
        $this->customermodel->editTrxDataBooking($dataUpdate,$id);
        redirect(base_url('finished_trx'));
    }
    public function deleteBatal($id){
        $dataUpdate = array(
            'status'=>1
        );
        $this->customermodel->editStatusBatal($dataUpdate, $id);
        redirect(base_url('cancelled_trx'));
    }
  
    // memanggil fungsi data member
    public function allMember(){        
        $list_member = $this->membermodel->getAllMemberByRole(2);
        $this->_content['list_member'] = $list_member;
        $this->_content['pages'] = 'alladmin';
       
        $this->load->view('main/headersuper', $this->_content);
        $this->load->view('adminx/daftaradmin', $this->_content);
        $this->load->view('main/footer', $this->_content);
    } 


    public function deleteMember($id){
        if($id==null){
            redirect(base_url('superadmin'));
        }
        
        $this->membermodel->delMember($id);
        redirect(base_url('alladmin'));
    }

    public function updateAdmin($id){
        $detailAdmin = $this->membermodel->getDetailMemberById($id);
        if ($detailAdmin ==null){
            echo null;
        }
        $this->_content['list_member']= $detailAdmin;
        $this->load->view('adminx/formUpdate',$this->_content);
    }

     public function updateAdminProcess(){

         $this->_content['pages'] = 'updateadmin';

        $dataAdd = $this->input->post(); 
        $id = $dataAdd['user_id'];
        $this->load->model("membermodel");        

        
        $dataAdding = array(
            'first_name'=> $dataAdd['first_name'],
            'last_name' => $dataAdd['last_name'],
            'surname'   => $dataAdd['surname'],
            'email'     => $dataAdd['email'],
            'phone'     => $dataAdd['phone'],
            'role_id'   => 2        
            );
         $this->membermodel->updateDataMember($dataAdding,$id);
         redirect(base_url('alladmin'));

    }

    public function addAdmin(){
        
        $this->_content['pages'] = 'addadmin';

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

        $this->membermodel->insert_member($dataAdding);
        redirect(base_url('alladmin'));

       
    }


}   

?>
