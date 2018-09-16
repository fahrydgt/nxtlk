
<input hidden type="text" class="page_trackn" id="page_<?php echo $page_no;?>" value="<?php echo $page_no;?>">
<?php

//            echo '<pre>';            print_r($search_list_items_chunks); die;
            
 foreach ($search_list_items_chunks as $itm){
//     $itm_jsn = json_encode($itm);
     echo '<div id="id--'.$itm['id'].'" style="width:100%;" class="hero-carousel__cell hero-carousel__cell--'.$itm['id'].'">
                        <div class="hero-carousel__cell__content">';

                          echo form_open("", 'id="'.$itm['id'].'_form_itm"');

                          echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                  <div class="carousel-inner">'; 
                                  if($itm['image']!='')
                                      echo '<div id="img_1"  name="'.$itm['id'].'" class="item active"><img src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/'.$itm['image'].'" alt="First slide" style="width:100%"></div>';
                                       $cn=2;
                                     if($itm['images']!='' && isset($itm['images'])){
                                         $other_imgs = json_decode($itm['images']);
                                         foreach ($other_imgs as $other_img){
                                           echo '<div id="img_'.$cn.'" name="'.$itm['id'].'" class="item"><img src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/other/'.$other_img.'" alt="Otehr slide" style="width:100%"></div>';
                                           $cn++;
                                         }  
                                      }
                                 echo ' </div> 
                                  <div class="carousel-small-img row pad" style="margin:5px"> 
                                    <img id="imgtmb_1" style="border-width:5px;height:80px;  border-style:ridge;" class="itm-thmb pad col-md-3 col-sm-3 col-xs-3 border-left" src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/'.$itm['image'].'">';
                                 
                                    $cn=2;
                                     if($itm['images']!='' && isset($itm['images'])){
                                         $other_imgs = json_decode($itm['images']);
                                         foreach ($other_imgs as $other_img){
                                            echo '<img id="imgtmb_'.$cn.'" style="border-width:5px;height:80px; border-style:ridge;" class="pad col-md-3 col-sm-3 col-xs-3 itm-thmb" src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/other/'.$other_img.'">';
                                           $cn++;
                                         }  
                                      }
                                 echo' </div>
                            </div> 
                           <div class="caption">
                              <div class="mailbox-attachment-info">
                                <div class="mailbox-attachment-name">
                                    <h5>NAME : <span id="modal_item_desc">'.$itm['item_name'].'</span></h5>
                                    <h5>ITEM NO : <span id="modal_item_code">'.$itm['item_code'].'</span></h5>
                                    <h5>ITEM DESC : <span id="modal_item_info">'.$itm['description'].'</span></h5>
                                    <div class="row">
                                        <div class="col-md-6  col-sm-6  col-xs-6">
                                              UNITS : <span id="modal_item_uom">'.$itm['unit_abbreviation'].'</span>
                                              <input name="modal_qty" class="form-control" type="number" id="modal_qty" min="1" value="1">
                                          </div>
                                        <div class="col-md-6  col-sm-6  col-xs-6">
                                              Price : <span id="modal_item_price"></span>
                                              <input name="modal_price" class="form-control" type="text" id="modal_price" min="0" value="'.$itm['item_price_amount'].'">
                                          </div>
                                    </div> 
                                    <input hidden="" name="modal_itm_id" readonly type="text" id="modal_itm_id" value="'.$itm['id'].'">
                                    <input hidden="" name="order_id" readonly type="text" id="order_id" value="'.((isset($order_id))?$order_id:0).'">
                                    <input  hidden="" name="item_code_txt" readonly type="text" id="item_code_txt" value="'.$itm['item_code'].'">
                                    <input  hidden="" name="item_uom_id_txt" readonly type="text" id="item_uom_id_txt" value="'.$itm['item_uom_id'].'">
                                    <input  hidden="" name="item_det_json" readonly type="text" id="item_det_json" value="0">
                                    <div id="'.$itm['id'].'_res1_fl"></div>
                                </div> 
                                </div>  

                        </div>
                        <div class="modal-footer"> 
                            <div class="row">
                                <div style="padding-top: 5px;" class="col-md-6 col-sm-6  col-xs-6">
                                    <a id="'.$itm['id'].'_confirm_order_item" type="button" class="btn btn-block btn-success btn-lg confirm_order_item">Add to Order</a>
                                </div>
                                <div style="padding-top: 5px;" class="col-md-6 col-sm-6  col-xs-6">
                                      <a type="button" class="btn btn-block btn-primary btn-lg" data-dismiss="modal">Back</a>
                                </div>
                            </div>
                        </div>';
                             echo form_close();
          echo '</div>
        </div>';
 }
?>
