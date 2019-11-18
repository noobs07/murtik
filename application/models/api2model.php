<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api2model extends CI_Model {

	private $cache = array();
 
    private $_url;

    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('curl');
        //$this->_url = 'http://103.229.72.240/affan/searching.php?';
        $this->_url = 'localhost';
    }

    public function searchFlight($data){
    	$datapost = http_build_query($data);
    	$uri = $this->_url.$datapost;
    	$data2 = $this->curl->simple_get( $uri );
        $data_array = json_decode( $data2, true );
        return $data_array;
    }

    public function searchFlight2($data){
    	$datapost = http_build_query($data);
    	$uri = $this->_url.$datapost;
    	$data2 = $this->curl->simple_get( $uri );
        return $data2;
    }

}	