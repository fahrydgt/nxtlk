<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
   
    public $fl_header = 'header_1';
    public $fl_data_arr = array();
    
    function __construct()
    { 
        parent::__construct();
    }
     
    //Page header
    public function Header() {
//        echo $this->fl_header; die;
        if($this->fl_header=='header_1'){
            $this->header_1();
        }else if($this->fl_header=='header_2'){
            $this->header_2();
        }else if($this->fl_header=='header_am'){
            $this->header_am();
        }else{
            //blank
        }
    }
    
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'I', 9);
        $this->SetTextColor(135,133,133);
        $html = '<p style="text-align:center">We import chinese and Turkey products they are high quality products, and we sale wholesale and retail but we don`t sale any trading standard products. We don`t sale any character stuff and we don`t respond  to any of those (branded) after delivery we are not responsible for any damage, so there are no returns';
        // Page number
//        $this->Cell(0, 10, 'Solution by:         Zone Venture Software Solution - Dharga Townn Sri Lanka. Contact: +94775440889', 0, false, 'L', 0, '', 0, false, 'T', 'M');
//         $this->Cell(0, 10, 'We import chines and Turkey products they are high quality products, and we sale wholesale and retail but we don`t sale');
//        $this->Cell(0, 10, '    any trading standard products. We dont sale any charactor stuf and we don`t respond  to any of those (branded)');
//        $this->Cell(0, 10, 'after delivery we are not responsible for any damage, so there are no return', 0, false, 'L', 0, '', 0, false, 'T', 'M');
//        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
       $this->writeHTMLCell(170,10,10,275,$html);
       $this->writeHTMLCell(160,10,190,275,'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages());
//        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $image_zv = DEFAULT_IMAGE_LOC.'small_zv.png';
//        $this->Image($image_zv, 31, 290, 4, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        

    }
    // Page header default
    public function header_1() {
        $CI =& get_instance();
        $CI->load->model('Company_model');
        $company_dets = $CI->Company_model->get_single_row($_SESSION[SYSTEM_CODE]['company_id']);
//        echo '<pre>'; print_r($_SESSION); die;
        $header_info = '<table>
                            <tr>
                                <td><h2>'.strtoupper($company_dets[0]['company_name']).'</h2></td>
                            </tr>
                            <tr>
                                <td>'.$company_dets[0]['street_address'].'</td>
                            </tr>
                            <tr>
                                <td>'.$company_dets[0]['city'].' '.$company_dets[0]['zipcode'].'</td>
                            </tr>
                            <tr>
                                <td>'.$company_dets[0]['country_name'].'</td>
                            </tr>
                            <tr>
                                <td>Phone: '.$company_dets[0]['phone'].(($company_dets[0]['other_phone']!='')?', '.$company_dets[0]['other_phone']:'').'</td>
                            </tr>
                            <tr>
                                <td>Email: '.(($company_dets[0]['email']!='')?$company_dets[0]['email']:'').'</td>
                            </tr>
                        </table> ';
        
        $header_info2 = '<table>
                            <tr>
                                <td align="right"><i>Printed by : '.$_SESSION[SYSTEM_CODE]['user_first_name'].' '.$_SESSION[SYSTEM_CODE]['user_last_name'].'</i></td>
                            </tr>
                            <tr>
                                <td align="right"><i>Printed on: '.date('d/m/Y h:i A').'</i></td>
                            </tr> 
                        </table> '; 
        
        $image_file = COMPANY_LOGO.$company_dets[0]['logo'];
        $this->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $this->writeHTMLCell(80,20,40,11,$header_info);
        $this->writeHTMLCell(80,20,120,11,$header_info2); 
         
        $this->Line(10, 40, 200, 40); 
        
        // Set font
        $this->SetFont('helvetica', 'B', 20); 
         
    }
    public function header_am() {
        $CI =& get_instance();
        $CI->load->model('Company_model');
        $company_dets = $CI->Company_model->get_single_row($_SESSION[SYSTEM_CODE]['company_id']);
//        echo '<pre>'; print_r($_SESSION); die;
        $header_info = '<table>
                             
                            <tr>
                                <td>'.$company_dets[0]['street_address'].', </td>
                            </tr> 
                            <tr>
                                <td>'.$company_dets[0]['city'].'</td>
                            </tr>
                            <tr>
                                <td>'.$company_dets[0]['phone'].(($company_dets[0]['other_phone']!='')?', '.$company_dets[0]['other_phone']:'').'</td>
                            </tr>
                            
                        </table> ';
        
        $header_info2 = '<table> 
                            <tr>
                                <td align="right">Email: '.(($company_dets[0]['email']!='')?$company_dets[0]['email']:'').'</td>
                            </tr>
                            <tr>
                                <td align="right">Web: '.(($company_dets[0]['website']!='')?$company_dets[0]['website']:'').'</td>
                            </tr>
                            <tr>
                                <td align="right">Facebook/nextlookuk</td>
                            </tr>
                        </table> '; 
        
        $image_file = COMPANY_LOGO.$company_dets[0]['logo'];
        $this->Image($image_file, 9, 5, '', 25, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $fontname = TCPDF_FONTS::addTTFfont('storage/fonts/CanelaBarkBold_PERSONAL.ttf', 'TrueTypeUnicode', '', 96);
        
        //water_mark 
        $image_file = DEFAULT_IMAGE_LOC.'logo_water_mark.png';
        $this->Image($image_file, 30, 95,  150, '', 'PNG', '', 'T', false, 72, '', false, false, 0, false, false, false);
        
        // use the font
        $this->SetFont($fontname, '', 15.5, '', false);
        $this->SetTextColor(48,75,105);
//        $this->Text(12, 20, 'We Under take all kind of Repairs, Tinkering, Painting, Electrical Works, Engine premises,', false, false, true, 0, 0, '', false,'',1);
//        $this->Text(12, 25, 'Motor interial Fixing and Spare suppliers of all Japanese Diesel & Petrol Vehicles', false, false, true, 0, 0, '', false,'',1);
        
        
        $this->SetTextColor(48,75,105);
        $this->SetFont('helvetica', 'I', 10.5);
        $this->writeHTMLCell(80,20,11,33,$header_info);
        $this->writeHTMLCell(60,20,140,33,$header_info2); 
        
        $data_arr = $this->fl_data_arr;
//        $this->fl_data_arr = array();
        if(isset($data_arr['order_no'])){ 
            $this->SetTextColor(255,125,125);     ;
            $this->Text(172,15,$data_arr['order_no']);
            $this->SetTextColor(48,75,105); 
        }
        
        $this->Line(10, 48, 200, 48); 
        
        // Set font
        $this->SetFont('helvetica', 'B', 20); 
         
    }
    // Page footer
    public function header_2() {
        // -- set new background --- 
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->getAutoPageBreak();
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image  
        $image_file = DEFAULT_IMAGE_LOC.'am_invoice_hp.jpg';
        $this->Image($image_file, 5, 5,  200, '', 'JPG', '', 'T', false, 72, '', false, false, 0, false, false, false);
         
    }
    // EMPTY HEADER
    public function header_empty() {
        
    }
    
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */