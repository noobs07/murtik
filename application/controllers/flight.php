<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight extends CI_Controller {


    public function __construct() {
        parent::__construct();

    }   

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function airport(){
        
        $dataAirportIndonesia = $this->airportmodel->getAllAirport(config_item('code_airport_indonesia'));
        
        if ($dataAirportIndonesia == null) {
            redirect(base_url('errors'));
        }

        $dataInternationalAirport = $this->airportmodel->getAllInternationalAirportByCountry();
		
        $listDataAirport = array();
        $indexAirport =0;
        foreach($dataAirportIndonesia as $listAirport){
            if($listAirport['country_id']==  config_item('code_airport_indonesia')){
                $listDataAirport[$indexAirport]['mixed'] = $listAirport['location_name'].' -- '.$listAirport['airport_code'].'';
                $listDataAirport[$indexAirport]['airport_code'] = $listAirport['airport_code'];
                $listDataAirport[$indexAirport]['country_id']   = $listAirport['country_id'];
                if((isset($listAirport['popular_airport']))&&($listAirport['popular_airport']==1))
                {
                    $listDataAirport[$indexAirport]['popular_airport'] = 1;
                }else{
                    $listDataAirport[$indexAirport]['popular_airport'] = 0;
                }
                $indexAirport++;
            }
        }
		
        foreach($dataInternationalAirport as $intrl){
		$listDataAirport[$indexAirport]['mixed'] = $intrl['location_name'].' -- '.$intrl['airport_code'].'';
		$listDataAirport[$indexAirport]['airport_code'] = $intrl['airport_code'];
		$listDataAirport[$indexAirport]['country_id']   = $intrl['country_id'];
		$listDataAirport[$indexAirport]['popular_airport'] = 0;
		$indexAirport++;
	}
        echo json_encode($listDataAirport);

    }

    public function searchFlight(){
        if ($this->input->get()!=null) {
            $dataSearch = $this->input->get();
            $dataSent = array(
                'type'  => 1,
                'flight'=> $dataSearch['maskapai'],
                'depart'=> $dataSearch['from'],
                'destiny'=>$dataSearch['to'],
                'date'=> $dataSearch['date_to'],
                'adult'=> $dataSearch['adult'],
                'child'=> $dataSearch['child'],
                'infant'=> $dataSearch['infant'],
                'show'=> 'b2c'
            );
            $dataFlight = $this->api2model->searchFlight2($dataSent);
            echo $dataFlight;
        }else{
            echo '';
        }    
    }

    public function search(){
        //if ($this->input->post()!=null) {
            //$dataSearch = $this->input->post();
            /*$dataSent = array(
                'type'  => 1,
                'flight'=> $dataSearch['maskapai'],
                'depart'=> $dataSearch['from'],
                'destiny'=>$dataSearch['to'],
                'date'=> $dataSearch['date_to'],
                'adult'=> $dataSearch['adult'],
                'child'=> $dataSearch['child'],
                'infant'=> $dataSearch['infant'],
                'show'=> 'b2c'
            );
            */
            $dataSent = array(
                'type'  => 1,
                'flight'=> 'lion',
                'depart'=> 'SUB',
                'destiny'=>'CGK',
                'date'=> '20-01-2016',
                'adult'=> '1',
                'child'=> '0',
                'infant'=> '0',
                'show'=> 'b2c'
            );
            $dataFlight = $this->api2model->searchFlight($dataSent);
            echo '<pre>';
            print_r($dataFlight);
            echo '</pre>';

        //}    
    }

}