<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customermodel
 *
 * @author andhikayogawiguna
 */
class customermodel extends CI_Model {
    
    protected $_table = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_table = 'customer_order';
    }
    
    public function getStatus(){
        $this->db->where('data_booking.status_bayar', 0);
        $this->db->where('data_booking.deleted_at IS NULL');
        $this->db->join('data_booking','data_booking.id_cust_order = '.$this->_table.'.id_cust_order');
        return $this->db->get($this->_table)->num_rows();
    }

    public function insert_cust_order($data)
    {
        $this->db->insert($this->_table,$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function insert_data_booking($data)
    {
        $this->db->insert("data_booking",$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function getdetailIdTrx($id){
        $this->db->where($this->_table.'.id_cust_order', $id);
        $this->db->join('data_booking','data_booking.id_cust_order = '.$this->_table.'.id_cust_order');
        return $this->db->get($this->_table)->result_array();
    }
    public function getdetailIdTrxKAI($id){
        $this->db->where('data_booking_kai.id_cust_order', $id);
        return $this->db->get('data_booking_kai')->result_array();
    }
    public function getdetailIdTrxPelni($id){
        $this->db->where('data_booking_pelni.id_cust_order', $id);
        return $this->db->get('data_booking_pelni')->result_array();
    }
    public function getdetailIdTrxHotel($id){
        $this->db->where('id', $id);
        return $this->db->get('order_hotel')->result_array();
    }
    
    public function getAllTransactionByStatus($status){
        if($status!='x'){
            $this->db->where('data_booking.status_bayar', $status);
        }
        $this->db->where('data_booking.deleted_at IS NULL');
        $this->db->join('data_booking','data_booking.id_cust_order = '.$this->_table.'.id_cust_order');
        $this->db->order_by("data_booking.id_data_booking",'DESC');
        return $this->db->get($this->_table)->result_array();
    }
    
    public function getTransactionCancelled(){
        $where = 'status = 0';
        $this->db->where($where);
        return $this->db->get("customer_order_batal")->result_array();
    }
    
    public function getBatal(){
        $this->db->select('COUNT("kode_order") AS jumlah');
        $this->db->where('status',0);
        $result=$this->db->get('customer_order_batal')->result_array();
        return $result[0];
    }
    
    public function getAllKonfirmasiPembayaran(){
        //$this->db->join('konfirmasi_pembayaran','konfirmasi_pembayaran.');
        $this->db->order_by("created_at", "desc");
        return $this->db->get("konfirmasi_pembayaran")->result_array();
        
    }
    
    public function deleteKonfirmasi($id){
        $this->db->where("id_konfirmasi_bayar",$id);
        $this->db->delete("konfirmasi_pembayaran");
    }

    public function getAllTrxSemua(){
        $this->db->where('data_booking.deleted_at IS NULL');
        $this->db->join('data_booking','data_booking.id_cust_order = '.$this->_table.'.id_cust_order');
        $this->db->order_by("time_order", "desc");
        //$this->db->join('data_booking','data_booking.kode_order = konfirmasi_pembayaran.pnr');
        //$this->db->join('konfirmasi_pembayaran','konfirmasi_pembayaran.id_cust_order= '.$this->_table.'.id_cust_order');
        //return $this->db->get("konfirmasi_pembayaran")->result_array();
        return $this->db->get($this->_table)->result_array();
    }
    public function getAllTrx($id, $status){//semua transaksi kereta dan pelni
        if($id=='kereta'){
            if($status!='x'){
                $this->db->where("status_bayar",$status);
            }
            //$this->db->where("status_bayar",0);
            $this->db->where('data_booking_kai.deleted_at IS NULL');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('data_booking_kai')->result_array();
        }elseif($id=='pelni'){
            if($status!='x'){
                $this->db->where("status_bayar",$status);
            }
            $this->db->where('data_booking_pelni.deleted_at IS NULL');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('data_booking_pelni')->result_array();
        }elseif($id='hotel'){
            if($status!='x'){
                $this->db->where("status_bayar",$status);
            }
            $this->db->where('delete_at IS NULL');
            $this->db->order_by("tanggal_pesan", "desc");
            return $this->db->get('order_hotel')->result_array();
        }
        
    }
    public function getNotif($id){
        if($id=='kereta'){
            $this->db->where("view","0");
            $this->db->where('data_booking_kai.deleted_at IS NULL');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('data_booking_kai')->result_array();
        }elseif($id=='pelni'){
            $this->db->where("view","0");
            $this->db->where('data_booking_pelni.deleted_at IS NULL');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('data_booking_pelni')->result_array();
        }elseif($id=='pesawat'){
            $this->db->where("view","0");
            $this->db->where('data_booking.deleted_at IS NULL');
            $this->db->join($this->_table,'data_booking.id_cust_order = '.$this->_table.'.id_cust_order');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('data_booking')->result_array();
        }elseif($id=='konfirmasi'){
            $this->db->where("view","0");
            $this->db->where('konfirmasi_pembayaran.confirmed_at IS NULL');
            $this->db->order_by("created_at", "desc");
            return $this->db->get('konfirmasi_pembayaran')->result_array();
        }elseif($id=='hotel'){
            $this->db->where("view","0");
            //$this->db->where('data_booking_hotel.deleted_at IS NULL');
            $this->db->order_by("tanggal_pesan", "desc");
            return $this->db->get('order_hotel')->result_array();
        }
    }
    public function updateKodeKAI($id,$data){
        $this->db->where('id_cust_order', $id);
        if($this->db->update('data_booking_kai', $data)){
            return 1;
        }else{
            return 0;
        } 
    }
    public function updateKodePelni($id,$data){
        $this->db->where('id_cust_order', $id);
        if($this->db->update('data_booking_pelni', $data)){
            return 1;
        }else{
            return 0;
        } 
    }
    public function getPenumpangPelni($id){
        $this->db->where('is_infant !=', '1');
        $this->db->where('id_cust_order', $id);
        $result = $this->db->get("customer_passenger_pelni")->result_array();
        return $result;
    }
    public function updateKursiPelni($id, $kursi){
        $this->db->set('ruang', $kursi);
        $this->db->where('id',$id);
        $this->db->update("customer_passenger_pelni");
    }
    public function updateKodeHotel($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('order_hotel', $data)){
            return 1;
        }else{
            return 0;
        } 
    }
    public function insert_data_passengers($data)
    {
        $this->db->insert("customer_passenger",$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function editTrxDataBooking($data,$id){
        $this->db->where('id_cust_order', $id);
        $update = $this->db->update('data_booking', $data);
        return $update;
    }
    public function editTrxDataBookingKAI($data,$id){
        $this->db->where('id_cust_order', $id);
        $this->db->update('data_booking_kai', $data); 
    }
    public function editTrxDataBookingPelni($data,$id){
        $this->db->where('id_cust_order', $id);
        $this->db->update('data_booking_pelni', $data); 
    }
    public function editTrxDataBookingHotel($data,$id){
        $this->db->where('id', $id);
        $this->db->update('order_hotel', $data); 
    }
    public function editBooking($kode,$data,$id){
        
        if($kode=='kereta'){
            $this->db->where('id_cust_order', $id);
            $this->db->update('data_booking_kai', $data);
        }elseif($kode=='pelni'){
            $this->db->where('id_cust_order', $id);
            $this->db->update('data_booking_pelni', $data);
        }elseif($kode=='hotel'){
            $this->db->where('id', $id);
            $this->db->update('order_hotel', $data);
        }
    }

    public function editTrxDataKonfirmasi($data,$code){
        $this->db->where('id_cust_order', $code);
        $this->db->update('konfirmasi_pembayaran', $data); 
    }
    public function editStatusBatal($data, $id){
        $this->db->where('kode_order', $id);
        $this->db->update('customer_order_batal', $id);
    }
    
    
    public function getJumlah(){
  $this->db->select('jumlah');
  $this->db->where('id', 1);
  $result = $this->db->get("jumlah")->result_array();
        return $result[0]['jumlah'];
    }
 
 public function setJumlah($data){
  $this->db->where('id', 1);
        $this->db->update('jumlah', $data); 
    }
}

?>
