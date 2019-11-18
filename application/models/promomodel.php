<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of trxmodel
 *
 * @author andhika yoga
 */
class promomodel extends CI_Model {
    
    protected $_table = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_table = 'promo';
    }

    function getallpromo($is_active=1){
    	if($is_active==1){
    		$this->db->where('deleted_at IS NULL');
    	}
    	return $this->db->get($this->_table)->result_array();
    }
	
	function getdiskon()
    
    {
        return $this->db->get('diskon')->result_array();
    }
    function getdiskonHotel()
    
    {
        return $this->db->get('diskon_hotel')->result_array();
    }
    function saveDiskonHotel($data){
        return $this->db->update(diskon_hotel, $data); 
        
    }

    function getDetail($id){
		$this->db->where('id',$id);
    	return $this->db->get($this->_table)->result_array();
    }
	
	function getDetailDiskon($id_diskon){
        $this->db->where('maskapai',$id_diskon);
        return $this->db->get('diskon')->result_array();
    }

    public function insert_promo($data)
    {
        $this->db->insert($this->_table,$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
	
	public function insert_diskon($data)
    {
        $this->db->insert('diskon_maskapai', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function editPromo($data,$id){
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data); 
        return true;
    }
	
	public function editDiskon($data,$id_diskon){
        $this->db->where('maskapai', $id_diskon);
        $this->db->update("diskon", $data); 
        return true;
    }
	
	public function DeletePromo($id){
        $this->db->where('id', $id);
        $query = $this->db->get('promo');
        $row = $query->row();
         unlink("./assets/images/promo/$row->image_name");
        $this->db->delete('promo',array('id'=>$id)); 
        return true;
    }
    
    public function DeleteDiskon($id_diskon){
        $this->db->where('id_diskon', $id_diskon);
        $query = $this->db->get('diskon_maskapai');
        $row = $query->row();
         unlink("./assets/images/diskon/$row->image");
        $this->db->delete('diskon_maskapai',array('id_diskon'=>$id_diskon)); 
        return true;
    }


 }
 