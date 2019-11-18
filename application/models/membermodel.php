<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of membermodel
 *
 * @author andhika yoga
 */
class membermodel extends CI_Model {
    
    protected $_table = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_table = 'member';
    }
    
    public function insert_member($data)
    {
        $this->db->insert($this->_table,$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    
    public function getAllMemberByRole($role){
        $this->db->where($this->_table.'.role_id', $role);
        //$this->db->where('member.deleted_at IS NULL');
        //$this->db->join('member','member.user_id='.$this->_table.'.user_id');
        //$this->db->order_by('member.user_id','DESC');
        return $this->db->get($this->_table)->result_array();

        
    }

    public function getDetailMemberById($userid){
        $this->db->where($this->_table.'.user_id', $userid);
        return $this->db->get($this->_table)->result_array();
    }
    
    public function getArrayMemberById($userid){
        $this->db->where($this->_table.'.user_id', $userid);
        return $this->db->get($this->_table)->result_array();
    }
    
    public function getMemberByEmail($email){
        $this->db->where($this->_table.'.email', $email);
        return $this->db->get($this->_table)->result_array();
    }
    
    public function getAllUserByRole($role){
        $this->db->where($this->_table.'.role_id', $role);
        return $this->db->get($this->_table)->result_array();
    }

    public function passwordCheck($password){
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('user_id', $password['user_id']);
        $this->db->where('password', $dataLogin['password']);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
          return $query->result();
        }
        else 
        {
          return null;
        }
        
    }
    
    public function memberLoginCheck($dataLogin)
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('email', $dataLogin['email']);
        $this->db->where('password', $dataLogin['password']);
        $this->db->limit(1);
        
        $query = $this->db->get(); 
 
        if($query->num_rows() == 1)
        {
          return $query->result();
        }
        else 
        {
          return null;
        }
    }
    
    public function updateDataMember($data,$id)
    {
        $this->db->where('user_id', $id);
        $this->db->update($this->_table, $data);
        return true;
    }

    public function delMember($id)
    {
        $this->db->where($this->_table.'.user_id',$id);
        $this->db->delete($this->_table,array('user_id'=> $id));
    }
    
    public function regNewsletter( $email ){
        return $this->db->insert( 'newsletter', array('email' => $email, 'datetime' => time()) );
    }
    public function getNewsletter( $where = null ){
        if ( !empty($where) ){
            return $this->db->get_where( 'newsletter', $where )->result_array();
        }
        return $this->db->get( 'newsletter' )->result_array();
    }
    public function delNewsletter( $id ){
        return $this->db->delete( 'newsletter', array('id' => $id) );
    }
    public function editNewsletter( $id, $data ){
        return $this->db->update( 'newsletter', $data, array('id' => $id) );
    }
}

?>
