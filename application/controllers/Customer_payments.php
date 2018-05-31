<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_payments extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Customer_payments_model'); 
        }

        public function index(){
            $this->add();
	} 
        
	function add_customer_payment($inv_id,$person_type=10){ //10 rent cust 
            $this->load->model('Invoice_model');
            
            $data['pending_total_amount']=0; 
            if($person_type==20){//for sale invoice
                $res_charges_inv = $this->get_invoice_info($inv_id);
                $data['res_det']['transection_type_id'] = 1;//customer payment
                $data['res_det']['customer_id'] = $res_charges_inv['invoice_dets']['person_id'];
                $data['res_det']['trans_reference'] = $res_charges_inv['invoice_dets']['invoice_no'];//regerences
                $data['res_det']['id'] = $res_charges_inv['invoice_dets']['id'];
                $data['pending_invoice_amount'] = ((isset($res_charges_inv['invoice_total']))?$res_charges_inv['invoice_total']:0);
//                $res_charges_inv = $this->get_reservation_charges($data['res_det']['id'], $data['res_det']['start_from'], $data['res_det']['end_to']);
                
            }
            $data['res_det']['person_type'] = $person_type;//customer payment 
            //for customer invoice
            $invoice_list_cust = $this->Invoice_model->search_result(array('customer_id'=>$data['res_det']['customer_id'])); 
//            echo '<pre>';                print_r($invoice_list_cust); die;
            foreach ($invoice_list_cust as $res_inv){
                $inv_charges_1 = $this->get_invoice_info($res_inv['id']);
                $data['pending_total_amount'] = $data['pending_total_amount'] + ((isset($inv_charges_1['invoice_total']))?$inv_charges_1['invoice_total']:0);
            }
            
            $data['action']		= 'Add';
            $data['main_content']='customer_payments/manage_customer_payments'; 
            $data['customer_list'] = get_dropdown_data(CUSTOMERS,'customer_name','id','',array('col'=>'id','val'=>$data['res_det']['customer_id']));  
            $data['transection_type_list'] = get_dropdown_data(TRANSECTION_TYPES,'name','id','',array('col'=>'cats','val'=>'sales')); 
            $this->load->view('includes/template',$data);
	}
	 
	function delete($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'Delete';
            $data['main_content']='customers/manage_customers'; 
            $this->load->view('includes/template',$data);
	}
	
	function view($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'View';
            $data['main_content']='customers/manage_customers'; 
            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            $this->load->view('includes/template',$data);
	}
	
        
	function validate(){   
            $this->form_val_setrules(); 
            if($this->form_validation->run() == False){
                switch($this->input->post('action')){
                    case 'Add':
                            $this->session->set_flashdata('error','Not Saved! Please Recheck the form'); 
                            $this->add_customer_payment($this->input->post('id'),$this->input->post('person_type'));
                            break;
                    case 'Edit':
                            $this->session->set_flashdata('error','Not Saved! Please Recheck the form');
                            $this->edit($this->input->post('id'));
                            break;
                    case 'Delete':
                            $this->delete($this->input->post('id'));
                            break;
                } 
            }
            else{
                switch($this->input->post('action')){
                    case 'Add':
                            $this->create();
                    break;
                    case 'Edit':
                        $this->update();
                    break;
                    case 'Delete':
                        $this->remove();
                    break;
                    case 'View':
                        $this->view();
                    break;
                }	
            }
	}
        
	function form_val_setrules(){
            $this->form_validation->set_error_delimiters('<p style="color:rgb(255, 115, 115);" class="help-block"><i class="glyphicon glyphicon-exclamation-sign"></i> ','</p>');

            $this->form_validation->set_rules('customer_id','Customer','required');
            $this->form_validation->set_rules('trans_date','Date','required'); 
            $this->form_validation->set_rules('transection_amount','Amount','required|numeric|greater_than[0]'); 
      }	 
      
	function create(){   
            $inputs = $this->input->post();  
                    
            
            $data = array(
                            'transection_type_id' => $inputs['transection_type_id'], //cust_payment
                            'reservation_id' => $inputs['id'],
                            'trans_reference' => $inputs['id'],
                            'person_type' => $inputs['person_type'], //customer
                            'person_id' => $inputs['customer_id'], 
                            'transection_amount' => $inputs['transection_amount'],
                            'trans_date' => strtotime($inputs['trans_date']),
                            'trans_memo' => $inputs['description'], 
                        );
                    
//            echo '<pre>';            print_r($data); die;
		$add_stat = $this->Customer_payments_model->add_db($data);
                
		if($add_stat[0]){ 
                    //update log data
                    $new_data = $this->Customer_payments_model->get_single_row($add_stat[1]);
                    add_system_log(TRANSECTION, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
                    $this->session->set_flashdata('warn',RECORD_ADD);
                    if($inputs['person_type']==20)redirect(base_url('Invoices/view/'.$inputs['id'])); 
                    redirect(base_url('Invoices/edit/'.$inputs['id'])); 
                }else{
                    $this->session->set_flashdata('warn',ERROR);
                    if($inputs['person_type']==20)redirect(base_url('Invoice_list')); 
                    redirect(base_url('Invoices/edit/'.$inputs['id'])); 
                } 
	}
	
	function update(){ 
            $inputs = $this->input->post();
            $customer_id = $inputs['id']; 
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } else{
                $inputs['status'] = 0;
            }
             //create Dir if not exists for store necessary images   
            if(!is_dir(CUSTOMER_LICENSE.$customer_id.'/')) mkdir(CUSTOMER_LICENSE.$customer_id.'/', 0777, TRUE); 

            $this->load->library('fileuploads'); //file upoad library created by FL
            $res_image = $this->fileuploads->upload_all('licence_image',CUSTOMER_LICENSE.$customer_id.'/');
            
            $data = array(
                            'customer_name' => $inputs['customer_name'],
                            'short_name' => $inputs['short_name'],
                            'customer_type_id' => $inputs['customer_type_id'],
                            'description' => $inputs['description'],
                            'nic_no' => $inputs['nic_no'],
                            'license_no' => $inputs['license_no'],
                            'status' => $inputs['status'],
                            'phone' => $inputs['phone'],
                            'fax' => $inputs['fax'],
                            'email' => $inputs['email'],
                            'website' => $inputs['website'],
                            'address' => $inputs['address'],
                            'city' => $inputs['city'],
                            'postal_code' => $inputs['postal_code'],
                            'state' => $inputs['state'],
                            'country' => $inputs['country'],
                            'commision_plan' => $inputs['commision_plan'],
                            'commission_value' => $inputs['commission_value'],
                            'credit_limit' => $inputs['credit_limit'],
                            'licence_image' => (!empty($res_image))?$res_image[0]['name']:'',
                            'updated_on' => date('Y-m-d'),
                            'updated_by' => $this->session->userdata(SYSTEM_CODE)['ID'],
                        );
            
//            echo '<pre>'; print_r($data); die;
            //old data for log update
            $existing_data = $this->Customer_payments_model->get_single_row($inputs['id']);

            $edit_stat = $this->Customer_payments_model->edit_db($inputs['id'],$data);
            
            if($edit_stat){
                //update log data
                $new_data = $this->Customer_payments_model->get_single_row($inputs['id']);
                add_system_log(CUSTOMERSS, $this->router->fetch_class(), __FUNCTION__, $new_data, $existing_data);
                $this->session->set_flashdata('warn',RECORD_UPDATE);
                    
                redirect(base_url($this->router->fetch_class().'/edit/'.$inputs['id']));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            } 
	}	
        
        function remove(){
            $inputs = $this->input->post();
                                        
            $data = array(
                            'deleted' => 1,
                            'deleted_on' => date('Y-m-d'),
                            'deleted_by' => $this->session->userdata(SYSTEM_CODE)['ID']
                         ); 
                
            $existing_data = $this->Customer_payments_model->get_single_row($inputs['id']);
            $delete_stat = $this->Customer_payments_model->delete_db($inputs['id'],$data);
                    
            if($delete_stat){
                //update log data
                add_system_log(CUSTOMERSS, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url($this->router->fetch_class()));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            }  
	}
	
	
	function remove2(){
            $id  = $this->input->post('id'); 
            
            $existing_data = $this->Customer_payments_model->get_single_row($inputs['id']);
            if($this->Customer_payments_model->delete2_db($id)){
                //update log data
                add_system_log(HOTELS, $this->router->fetch_class(), __FUNCTION__, '', $existing_data);
                
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url('company'));

            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url('company'));
            }  
	}
        
        function load_data($id){
            
            $data['user_data'] = $this->Customer_payments_model->get_single_row($id); 
            if(empty($data['user_data'])){
                $this->session->set_flashdata('error','INVALID! Please use the System Navigation');
                redirect(base_url($this->router->fetch_class()));
            }
            
            $data['customer_type_list'] = get_dropdown_data(CUSTOMER_TYPE,'customer_type_name','id',''); 
            $data['country_list'] = get_dropdown_data(COUNTRY_LIST,'country_name','country_code','');
            $data['country_state_list'] = get_dropdown_data(COUNTRY_STATES,'state_name','id',''); 
            $data['country_district_list'] = get_dropdown_data(COUNTRY_DISTRICTS,'district_name','id',''); 
            return $data;	
	}	
        
        function search(){
		$search_data=array( 'customer_name' => $this->input->post('name'), 
                                    'category' => $this->input->post('category'), 
                                    ); 
		$data_view['search_list'] = $this->Customer_payments_model->search_result($search_data);
                                        
		$this->load->view('customers/search_customers_result',$data_view);
	}
                    
    function get_invoice_info($inv_id){
            if($inv_id!=''){
                 $data['invoice_dets'] = $this->Invoice_model->get_single_row($inv_id,'invoice_type = 10'); //10 fro sele invoice
                if(empty($data['invoice_dets'])){
                    $this->session->set_flashdata('error','INVALID! Please use the System Navigation');
                    redirect(base_url($this->router->fetch_class()));
                }
            }
           
            $data['invoice_desc'] = array();
            $invoice_desc = $this->Invoice_model->get_invc_desc($inv_id);
            $data['invoice_desc_list'] = $invoice_desc;
            
            $data['item_cats'] = get_dropdown_data(ITEM_CAT, 'category_name','id');
            $item_cats = get_dropdown_data(ITEM_CAT, 'category_name','id');
            
            $data['invoice_desc_total']= 0;
            foreach ($item_cats as $cat_key=>$cay_name){ 
                foreach ($invoice_desc as $invoice_itm){
                    if($invoice_itm['item_category']==$cat_key){
                        $data['invoice_desc'][$cat_key][]=$invoice_itm;
                        $data['invoice_desc_total'] +=  $invoice_itm['sub_total'];
                    }
                }
            }
            $data['invoice_total'] = $data['invoice_desc_total'];
            $data['transection_total']=0;
           $data['inv_transection'] = $this->Invoice_model->get_transections($inv_id);
            foreach ($data['inv_transection'] as $trans){
                switch ($trans['calculation']){
                    case 1: //  addition from invoive
                            $data['transection_total'] += $trans['transection_amount'];
                            $data['invoice_total'] += $trans['transection_amount'];
                            break;
                    case 2: //substitute from invoiice
                            $data['transection_total'] -= $trans['transection_amount'];
                            $data['invoice_total'] -= $trans['transection_amount'];
                            break;
                    case 4: //settlement cust
                            $data['transection_total'] += $trans['transection_amount'];
                            $data['invoice_total'] += $trans['transection_amount'];
                            break;
                    default:
                            break;
                } 
            }
//            echo '<pre>';            print_r($data); die;
            return $data;
        }                    
}
