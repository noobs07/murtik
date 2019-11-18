<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer
 *
 * @author andhikayogawiguna
 */
class customer extends CI_Controller {
        
    private $_content = array();
    
    public function insert(){
        $dataInput = $this->input->post();
        
        $inputan = array(
            'kode_order'=>$dataInput['pnr'],
            'firstname_cust'=> $dataInput['firstname_cust'],
            'surname_cust'=>$dataInput['surname_cust'],
            'email_cust'=>$dataInput['email_cust'],
            'salutation_cust'=>$dataInput['salutation_cust'],
            'phone_cust'=>$dataInput['phone_cust'],
        );
        $idCust = $this->customermodel->insert_cust_order($inputan);
        echo $idCust;
    }
    
    public function insertBookingData(){
        $dataInput = $this->input->post();
        
        $inputan = array(
            'id_cust_order'=>$dataInput['id_cust_order'],
            'kode_order'=> $dataInput['pnr'],
            'kode_maskapai'=>$dataInput['kode_maskapai'],
            'payment_time'=>  date('Y-m-d H:i:s'),
            'total_adult'=>$dataInput['adult'],
            'total_child'=>$dataInput['child'],
            'total_infant'=>$dataInput['infant']
        );
        
        $idCust = $this->customermodel->insert_data_booking($inputan);
        echo $idCust;
    }
    
    public function insertPassengerData(){
        $dataInput = $this->input->post();
        
        $inputan = array(
            'id_cust_order'=>$dataInput['id_cust_order'],
            'is_adult'=> $dataInput['is_adult'],
            'is_child'=>$dataInput['is_child'],
            'is_infant'=>$dataInput['is_infant'],
            'psg_firstname'=>$dataInput['firstname_psg'],
            'psg_surname'=>$dataInput['surname_psg'],
            'psg_birth_date'=>$dataInput['birth_psg'],
            'psg_title'=>$dataInput['title_psg'],
            'psg_id'=>$dataInput['id_psg'],
            'psg_nationality'=>$dataInput['national_psg'],
            'psg_pass_numb'=>$dataInput['pass_numb_psg'],
            'psg_pass_exp_date'=>$dataInput['exp_date_passport_psg'],
            'psg_pass_exp_month'=>$dataInput['exp_month_passport_psg'],
            'psg_pass_exp_year'=>$dataInput['exp_year_passport_psg'],
        );
        $idCust = $this->customermodel->insert_data_passengers($inputan);
        echo $idCust;
    }
    
}

?>
