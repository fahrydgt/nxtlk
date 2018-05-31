<?php 

class Items_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
        public function search_result($data=''){  
            
//            echo '<pre>';            print_r($data); die;
            $this->db->select('i.*');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = i.item_uom_id)  as unit_abbreviation');
            $this->db->select('(select category_name from '.ITEM_CAT.' where id = i.item_category_id)  as category_name');
            $this->db->from(ITEMS." i");  
            $this->db->where('i.deleted',0);
            if($data!=''){
                $this->db->where('i.status',$data['status']);
                $this->db->like('i.item_name',$data['item_name']);
                $this->db->like('i.item_category_id',$data['item_category_id']);
            }
            
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
            return $result;
	}
	
          public function get_single_row($id){ 
            $this->db->select('ic.*');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = ic.item_uom_id)  as unit_abbreviation');
            $this->db->from(ITEMS." ic");  
            $this->db->where('ic.id',$id);
            $this->db->where('ic.deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
        public function get_item_prices($item_id,$where=''){ 
            $this->db->select('ip.*');
            $this->db->select('(select dropdown_value from '.DROPDOWN_LIST.' where id = ip.sales_type_id)  as sales_type_name');
            $this->db->select('(select supplier_name from '.SUPPLIERS.' where id = ip.supplier_id)  as supplier_name');
            $this->db->from(ITEM_PRICES." ip");    
            $this->db->where('ip.item_id',$item_id);
            $this->db->where('ip.deleted',0);
            $this->db->where('ip.status',1);
            if($where!='') $this->db->where($where);
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
            return $result;
	}
        public function get_item_status($item_id,$where=''){ 
            $this->db->select('is.*');
            $this->db->select('(select location_name from '.INV_LOCATION.' where id = is.location_id)  as location_name');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = is.uom_id)  as uom_name');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = is.uom_id_2)  as uom_name_2');
            $this->db->from(ITEM_STOCK.' is');    
            $this->db->where('is.item_id',$item_id);
            $this->db->where('is.deleted',0);
            $this->db->where('is.status',1);
            if($where!='') $this->db->where($where);
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
            return $result;
	}
        
        public function get_available_items($where=''){ 
            $this->db->select("is.*,itm.item_code,CONCAT(itm.item_name,'-',itm.item_code) as item_name");
            $this->db->select('(select location_name from '.INV_LOCATION.' where id = is.location_id)  as location_name');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = is.uom_id)  as uom_name');
            $this->db->select('(select unit_abbreviation from '.ITEM_UOM.' where id = is.uom_id_2)  as uom_name_2');
            $this->db->join(ITEMS.' itm','itm.id = is.item_id','left');
            $this->db->from(ITEM_STOCK.' is');     
            $this->db->where('is.units_available >',0);
            $this->db->where('is.deleted',0);
            $this->db->where('is.status',1);
            if($where!='') $this->db->where($where);
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
//            echo '<pre>';            print_r($result); die;
            return $result;
	}
                        
        public function add_db_item_price($data){      
//            echo '<pre>';            print_r('$data'); die;
                $this->db->trans_start();
                
		$this->db->insert(ITEM_PRICES, $data);  
                
		$status=$this->db->trans_complete();
		return $status;
	}
        public function edit_db_item_price($id,$data){
//            echo '<pre>';            print_r($data); die;
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(ITEM_PRICES, $data); 
                        
		$status=$this->db->trans_complete(); 
		return $status;
	}
        public function add_db($data){      
//            echo '<pre>';            print_r($data); die;
                $this->db->trans_start();
                
		$this->db->insert(ITEMS, $data['item']);  
		$this->db->insert_batch(ITEM_PRICES, $data['sales_price']);  
		$this->db->insert(SUPPLIER_INVOICE_DESC, $data['supplier_inv_desc']);  
                
		$status[0]=$this->db->trans_complete();
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(ITEMS, $data); 
                        
		$status=$this->db->trans_complete(); 
		return $status;
	}
        
        public function delete_db($id,$data,$table=''){ 
                $table = ($table=='')?ITEMS:$table;
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update($table, $data); 
                
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(ITEMS, array('id' => $id));     
                $this->db->delete(HOTEL_RESOURCE, array('hotel_id' => $id));     
                $this->db->delete(HOTEL_IMAGES_TBL, array('hotel_id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>