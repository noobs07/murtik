<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of airportmodel
 *
 * @author andhika yoga
 */
class airportmodel extends CI_Model {
    
    protected $_table = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_table = 'list_airport';
    }
    
    public function insert_airport($data)
    {
        $this->db->insert($this->_table,$data);
    }
    
    public function insert_country($data)
    {
        $this->db->insert('list_country',$data);
    }
    
    public function getAllAirport($country='id'){
        if($country!='all'){
            $this->db->where($this->_table.'.country_id', $country);
        }
        return $this->db->get($this->_table)->result_array();
    }
    public function getAllInternationalAirportByCountry(){        $this->db->order_by('list_international_airport.country_id');		$this->db->join('list_country as country','country.country_id=list_international_airport.country_id');        return $this->db->get('list_international_airport')->result_array();    }
    public function getAllCountry(){
        return $this->db->get('list_country')->result_array();
    }
    
    public function getAirportDetailByCodeCountry($code,$country=null){
        $this->db->where($this->_table.'.airport_code', $code);		if($country!=null){
			$this->db->where($this->_table.'.country_id', $country);		}
        return $this->db->get($this->_table)->result_array();
    }
    
}

?>
