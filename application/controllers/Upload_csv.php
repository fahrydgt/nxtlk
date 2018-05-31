<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_csv extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Items_model');
        }


        public function index()
	{
            $this->view_form_csv();
	}
        
        function view_form_csv($datas=''){
//            $data = $this->load_data();
//            $data['log_list'] = $this->Audit_trial_model->search_result();
		$data['action']		= 'Add';
            $data['main_content']='upload_csv'; 
            $this->load->view('includes/template',$data);
	}
                                        
	 
        function validate(){
            $file = $_FILES["file"]["tmp_name"];
            $file_open = fopen($file, "r");

            $data_arr = array();
            
            while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {
                echo '<pre>';        print_r($csv); die;

                $item_id = get_autoincrement_no(ITEMS); 
    //            $item_code = gen_id('1', ITEMS, 'id',4);
                $inputs['status'] = (isset($inputs['status']))?1:0;
                $inputs['sales_excluded'] = (isset($inputs['sales_excluded']))?1:0;
                $inputs['purchases_excluded'] = (isset($inputs['purchases_excluded']))?1:0;

                //create Dir if not exists for store necessary images   
                if(!is_dir(ITEM_IMAGES.$item_id.'/')) mkdir(ITEM_IMAGES.$item_id.'/', 0777, TRUE); 
                if(!is_dir(ITEM_IMAGES.$item_id.'/other/')) mkdir(ITEM_IMAGES.$item_id.'/other/', 0777, TRUE);
                
                $dir_path = "F:/nl_images_2/".$csv[0];
                $file_in = $all_images = array();
                $file_in = scandir($dir_path,1);
                 
                foreach ($file_in as $img){
//                    echo $img; die;
                    if($img=='1.jpg' & $img!='.' & $img!='..'){
                        copy($dir_path.'/'.$img, ITEM_IMAGES.$item_id.'/'.$img);
                    }
                    if($img!='1.jpg' & $img!='.' & $img!='..'){
                        copy($dir_path.'/'.$img, ITEM_IMAGES.$item_id.'/other/'.$img);
                        $all_images[]=$img;
                    }
                }
//                echo '<pre>';        print_r($all_images); die;
 
                $data['item'] = array(
                                        'id' => $item_id,
                                        'item_code' => $csv[0],
                                        'item_name' => $csv[1],
                                        'item_uom_id' => 1,
                                        'item_uom_id_2' => 0,
                                        'item_category_id' => $csv[2],
                                        'item_type_id' => 1,
                                        'description' => '',
                                        'addon_type_id' => 0,
                                        'sales_excluded' => $inputs['sales_excluded'],
                                        'purchases_excluded' => $inputs['purchases_excluded'],
                                        'image' => '1.jpg',
                                        'images' => (isset($all_images))?json_encode($all_images):'',
                                        'status' => 1, 
                                        'added_on' => date('Y-m-d'),
                                        'added_by' => $this->session->userdata(SYSTEM_CODE)['ID'],
                                    );
  
                 
                    $supplier_inv_id = get_autoincrement_no(SUPPLIER_INVOICE);
                    $supplier_invoice_no = gen_id(SUP_INVOICE_NO_PREFIX, SUPPLIER_INVOICE, 'id');
        //            $data['supplier_inv'] = array(
        //                                    'id' => $supplier_inv_id,
        //                                    'supplier_invoice_no' => $supplier_invoice_no,
        //                                    'invoiced' => 0,
        //                                    'payment_term_id' => 0,
        //                                    'status' => 1,  
        //                                    'added_on' => date('Y-m-d'),
        //                                    'added_by' => $this->session->userdata(SYSTEM_CODE)['ID'],
        //                                );

                    $supplier_inv_desc_id = get_autoincrement_no(SUPPLIER_INVOICE_DESC);
                    $data['supplier_inv_desc'] = array(
                                                'id' => $supplier_inv_desc_id,
                                                'supplier_invoice_id' => 0,
                                                'supplier_item_desc' => $csv[1],
                                                'purchasing_unit' => 10,
                                                'purchasing_unit_uom_id' => 1,
                                                'secondary_unit_uom_id' => 0,
                                                'secondary_unit' => 0,
                                                'location_id' => 1,
                                                'purchasing_unit_price' => 0,
                                                'status' => 1,   
                                            );
                
                
                
                    $data['sales_price'][0] = array(
                                                    'item_id' => $item_id,
                                                    'item_price_type' => 2, //2 sales price
                                                    'price_amount' =>5,
                                                    'currency_code' =>'GBP',
                                                    'sales_type_id' =>16,
                                                    'status' =>1,
                                                    ); 
                    $data['sales_price'][1] = array(
                                                    'item_id' => $item_id,
                                                    'item_price_type' => 2, //2 sales price
                                                    'price_amount' =>5,
                                                    'currency_code' =>'GBP',
                                                    'sales_type_id' =>15,
                                                    'status' =>1,
                                                    ); 
                    
//                echo '<pre>';        print_r($data); die;
    //            if(!empty($def_image)) $data['image'] = $def_image[0]['name'];
    //                                echo '<pre>';                                print_r($data); die;
                    
                    $add_stat = $this->Items_model->add_db($data);
                if($add_stat[0]){
                    echo $csv[0].' Added Successfully <br>';
                }else{
                    echo ' <p style="color:red"> '.$csv[0].' - Error</p><br>';
                }
            } 
        }
}
