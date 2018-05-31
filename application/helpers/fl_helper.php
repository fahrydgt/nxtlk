<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_dropdown_data'))
{
      // generate serial
	function get_dropdown_data($table='', $name='', $id='',$first_null_option="", $where='',$where_del = 0){
		$CI =& get_instance();
                
                $name_select = (is_array($name))?$name[1]:$name;
		$CI->db->select("".$name_select.",".$id."");	
		$CI->db->from($table);	 
                if($where_del == 0){
                    $CI->db->where('deleted',0);
                    $CI->db->where('status',1);
                }
                
                
                if($where != ''){
                    if(is_array($where) && isset($where['col']) && isset($where['val'])){
                        $CI->db->where($where['col'],$where['val']);
                    }else{
                        $CI->db->where($where);
                    }
                }
                
		$res = $CI->db->get()->result_array();
//                echo $CI->db->last_query(); die;
                $dropdown_data=array();
                
                if($first_null_option != ""){
                    $dropdown_data['']='Select '.$first_null_option;
                }
                foreach ($res as $res1){
                    $name_key = (is_array($name))?$name[0]:$name;
                    $dropdown_data[$res1[$id]] = $res1[$name_key];
                }
		return $dropdown_data;
	}
}

function get_dropdown_value($dp_id){
    $CI =& get_instance();
    $CI->db->select("dropdown_value");	
    $CI->db->from(DROPDOWN_LIST);	
    $CI->db->where('id',$dp_id);
    $res = $CI->db->get()->result_array();
    if(isset($res[0]['dropdown_value'])){
        return $res[0]['dropdown_value'];
    }
    return 0;
    
}

function get_value_for_id($table, $id,$name='*'){
    $CI =& get_instance();
    $CI->db->select($name);	
    $CI->db->from($table);	
    $CI->db->where('id',$id);
    $res = $CI->db->get()->result_array();
    if(isset($res[0][$name])){
        return $res[0][$name];
    }
    return 0;
    
}

function deletion_check($table, $check_col,$val='',$where_str=''){
    $CI =& get_instance();
    $CI->db->select($check_col);	
    $CI->db->from($table);	
    $CI->db->where('deleted',0);
    if($where_str!=''){
        $CI->db->where($where_str);
    }else{
        $CI->db->where($check_col,$val);
    }
    $res = $CI->db->get()->result_array();
//    echo $CI->db->last_query();die;
    if(isset($res[0][$check_col])){
        return $res[0][$check_col];
    }
    return 0;
    
}

if ( ! function_exists('get_autoincrement_no'))
{
      // generate serial
	function get_autoincrement_no($table=''){
		$CI =& get_instance();
                $query = $CI->db->query("SHOW TABLE STATUS LIKE '$table'");
                $row = $query->result();
                return $row[0]->Auto_increment;
		
	}
}


// generate serial
    function generate_serial($table='', $column=''){
            $CI =& get_instance();
            $CI->db->select('IFNULL(MAX('.$column.'),0) AS max_no',FALSE);	
            $res_serial = $CI->db->get($table)->row();	
            $serial = $res_serial->max_no;
            $serial = ($serial == 0) ? 1 : $serial+1;
            return $serial;
    }
    
if ( ! function_exists('gen_id'))
{
// generate id
    function gen_id($prefix='', $table='', $column='', $pad_amount=7, $pad_sym='0')
    {
        return $id = $prefix.str_pad(get_autoincrement_no($table), $pad_amount, $pad_sym, STR_PAD_LEFT);
    }
}


// Encrypt Function
function mc_encrypt($encrypt, $key){
    $encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
}
// Decrypt Function
function mc_decrypt($decrypt, $key){
    $decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}

//Systeg Log adding

        function add_system_log($table,$module,$action,$old_data='',$new_data=''){
//            echo '<pre>';            print_r($log_arr); die;
            if(SYSTEM_LOG_ENABLE==0){
                return FALSE;
            }
            $CI =& get_instance();
            $log_id = generate_serial(SYSTEM_LOG, 'id');
            $log_arr = array(
                                'id' => $log_id,
                                'user_id' => $_SESSION[SYSTEM_CODE]['ID'],
                                'module_id' => $module,
                                'action_id' => $action,
                                'ip' => $_SERVER['REMOTE_ADDR'],
                                'date' => time(),
                            );
            
//            echo '<pre>';            print_r($log_arr); die;
            $log_det_arr = array(
                                    'system_log_id' => $log_id,
                                    'table_name' => $table,
                                    'data_new' => serialize($new_data),
                                    'data_old' => serialize($old_data),
                                );
            
            $CI->db->trans_start();
                
            $CI->db->insert(SYSTEM_LOG, $log_arr);
            $CI->db->insert(SYSTEM_LOG_DETAIL, $log_det_arr);

            $status=$CI->db->trans_complete();
            return $status; 
        }

        function get_default_currency_amount($amount,$currency_code, $to_curcode=''){
            if($to_curcode==''){
                $to_curcode = $_SESSION[SYSTEM_CODE]['default_currency'];
            }
            
            $CI =& get_instance(); 
            $res_from = $CI->db->get_where(CURRENCY,array('code'=>$currency_code))->result()[0];
            $res_to = $CI->db->get_where(CURRENCY,array('code'=>$to_curcode))->result()[0];
            
            $res_to->amount = ($res_to->value/$res_from->value)*$amount; 
            
            return $res_to;
        }
        
        /*
 * Matches each symbol of PHP date format standard
 * with jQuery equivalent codeword
 * @author Tristan Jahier
 */
function dateformat_PHP_to_jQueryUI($php_format)
{
    $SYMBOLS_MATCHING = array(
        // Day
        'd' => 'dd',
        'D' => 'D',
        'j' => 'd',
        'l' => 'DD',
        'N' => '',
        'S' => '',
        'w' => '',
        'z' => 'o',
        // Week
        'W' => '',
        // Month
        'F' => 'MM',
        'm' => 'mm',
        'M' => 'M',
        'n' => 'm',
        't' => '',
        // Year
        'L' => '',
        'o' => '',
        'Y' => 'yy',
        'y' => 'y',
        // Time
        'a' => '',
        'A' => '',
        'B' => '',
        'g' => '',
        'G' => '',
        'h' => '',
        'H' => '',
        'i' => '',
        's' => '',
        'u' => ''
    );
    $jqueryui_format = "";
    $escaping = false;
    for($i = 0; $i < strlen($php_format); $i++)
    {
        $char = $php_format[$i];
        if($char === '\\') // PHP date format escaping character
        {
            $i++;
            if($escaping) $jqueryui_format .= $php_format[$i];
            else $jqueryui_format .= '\'' . $php_format[$i];
            $escaping = true;
        }
        else
        {
            if($escaping) { $jqueryui_format .= "'"; $escaping = false; }
            if(isset($SYMBOLS_MATCHING[$char]))
                $jqueryui_format .= $SYMBOLS_MATCHING[$char];
            else
                $jqueryui_format .= $char;
        }
    }
    return $jqueryui_format;
}