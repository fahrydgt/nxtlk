
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/itemslide_flickity/css/flickity.css');?>"> 

<style>
.flickity-page-dots {
  display:none;
}
</style> 

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" style="height: 100%;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Nextlook Item <?php echo $order_id;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
               
  <!--<link rel="stylesheet" href="<?php // echo base_url('templates/plugins/itemslide_flickity/css/flickity.css');?>">--> 
     
 
    <div class="row">
    <div class="mod_contnt col-md-12">
      <div class="hero-carousel" data-flickity='' data-js="hero-carousel">
          <?php
//          echo '<pre>';          print_r($search_list_items_chunks); die;
 foreach ($search_list_items_chunks as $itm){
//     $itm_jsn = json_encode($itm);
     echo '<div id="id--'.$itm['id'].'" style="width:100%;" class="hero-carousel__cell hero-carousel__cell--'.$itm['id'].'">
                        <div class="hero-carousel__cell__content">';

                          echo form_open("", 'id="'.$itm['id'].'_form_itm"');

                          echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                  <div class="carousel-inner">'; 
                                  if($itm['image']!='')
                                      echo '<div id="'.$itm['id'].'_img_1"  name="item'.$itm['id'].'[]" class="item active"><img src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/'.$itm['image'].'" alt="First slide" style="width:100%"></div>';
                                       $cn=2;
                                     if($itm['images']!='' && isset($itm['images'])){
                                         $other_imgs = json_decode($itm['images']);
                                         foreach ($other_imgs as $other_img){
                                           echo '<div id="'.$itm['id'].'_img_'.$cn.'" name="item'.$itm['id'].'[]" class="item"><img src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/other/'.$other_img.'" alt="Otehr slide" style="width:100%"></div>';
                                           $cn++;
                                         }  
                                      }
                                 echo ' </div> 
                                  <div class="carousel-small-img row pad" style="margin:5px"> 
                                    <img id="'.$itm['id'].'_imgtmb_1" style="border-width:5px;height:80px;  border-style:ridge;" class="itm-thmb pad col-md-3 col-sm-3 col-xs-3 border-left" src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/'.$itm['image'].'">';
                                 
                                    $cn=2;
                                     if($itm['images']!='' && isset($itm['images'])){
                                         $other_imgs = json_decode($itm['images']);
                                         foreach ($other_imgs as $other_img){
                                            echo '<img id="'.$itm['id'].'_imgtmb_'.$cn.'" style="border-width:5px;height:80px; border-style:ridge;" class="pad col-md-3 col-sm-3 col-xs-3 itm-thmb" src="'.base_url(ITEM_IMAGES).'/'.$itm['id'].'/other/'.$other_img.'">';
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
                                    <input hidden="" name="order_id" readonly type="text" id="item_order_id" value="'.((isset($order_id))?$order_id:0).'">
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
      </div>  
    </div> 
    </div>  
  
        </div>
      </div>
</div>
</div>

<script src="<?php echo base_url('templates/plugins/itemslide_flickity/js/flickity.pkgd.min.js')?>"></script> 
<!--<script src="<?php // echo base_url('templates/plugins/itemslide_flickity/js/flickity-docs.min.js')?>"></script>--> 
<script>
    $(document).ready(function(){
        // show carousel after modal shown
        $('#exampleModalCenter').on( 'shown.bs.modal', function( event ) {
          $('.hero-carousel').flickity('resize');
        });
        
        $('.confirm_order_item').click(function(){
            var itm_id1 = (this.id).split('_')[0];
            add_item_to_order(itm_id1);
        }); 
    });
    function item_click_pop(item_div_id){
            var cat =  $('#cat_id_clicked').val();
            var id2 = item_div_id.split('_')[1];
            var id21 = item_div_id.split('_')[0];
//            cat = 12;
                
        $('.hero-carousel').flickity('resize');
        $('.hero-carousel').flickity( 'select', (id21-1) );
        // jQuery
        $('.hero-carousel').on( 'change.flickity', function( event, cur_index ) { 
            var flickity = $('.hero-carousel').data('flickity');    
            var totslide_flickt = parseFloat(flickity.slides.length);  
            if((totslide_flickt - cur_index)<3){ //right 
                var page_no_static = parseFloat($('.active .page-link').text());
                var tot_pages_res = parseFloat($('#tot_pages_res_1').val());
                for(var k=page_no_static; k<=tot_pages_res; k++){ 
                    if(typeof($('#page_'+k).val())=='undefined'){ 
                        break;
                    }
                }  
                
                var page_to_load = k; 
                var res_page_count = parseFloat($('#tot_pages_res_1').val());  
                if(res_page_count >= page_to_load){
                    $.ajax({
                                        url: "<?php echo site_url('Sales_order_items/fl_ajax');?>",
                                        type: 'post',
                                        data : {function_name:'search_items_for_modal',category_id:cat,item_code:$('#item_code').val(),order_id:$('[name="order_id"]').val(),page_no:page_to_load},
                                        success: function(result){
                                            console.log(result)
                                                var cell_elm = $(result); 
//                                            alert('Totalitems: '+totslide_flickt+'---pages_all'+res_page_count+'----Loadpage:'+page_to_load); 
                                            $('.hero-carousel').flickity( 'append', cell_elm ); 
                                                    
                                                        $('.confirm_order_item').click(function(){
                                                               var itm_id1 = (this.id).split('_')[0];
                                                               add_item_to_order(itm_id1);
                                                        });  
                                        }
                                    });
                                }
            }
            if((totslide_flickt - cur_index) > (totslide_flickt-3)){ //left 
               
                var page_no_static = parseFloat($('.active .page-link').text());
                for(var k=page_no_static; k>=1; k--){ 
                    if(typeof($('#page_'+k).val())=='undefined'){ 
                        break;
                    }
                } 
                var page_to_load = k; 
                var res_page_count = parseFloat($('#tot_pages_res_1').val());  
                if(1 <= page_to_load){
                    $.ajax({
                                        url: "<?php echo site_url('Sales_order_items/fl_ajax');?>",
                                        type: 'post',
                                        data : {function_name:'search_items_for_modal',category_id:cat,item_code:$('#item_code').val(),order_id:$('#order_id').val(),page_no:page_to_load},
                                        success: function(result){
                                                var cell_elm = $(result);
                                                $('.hero-carousel').flickity( 'insert', cell_elm,0 ); 
                                                    
                                                $('.confirm_order_item').click(function(){
                                                       var itm_id1 = (this.id).split('_')[0];
                                                       add_item_to_order(itm_id1);
                                                }); 
                                        }
                                    });
                                }
            } 
            
                
        });
                  
                $('.itm-thmb').click(function(){
                        var tmbimg_id = (this.id).split('_')[2]; 
                        var active_mg = $('.carousel-inner .active').attr('id').split('_')[2]; 
//                        alert(active_mg)
                        var oldimg = (this.id).split('_')[0]+'_img_'+active_mg;
                        var clickedimg =(this.id).split('_')[0]+'_img_'+tmbimg_id; 
//                        alert('old:'+oldimg+'---- new'+clickedimg)
                        $('[name="item'+(this.id).split('_')[0]+'[]"]').removeClass('active');
//                        $('#'+oldimg).removeClass('active');
                        $('#'+clickedimg).addClass('active'); 
                });
    
            
            $('#exampleModalCenter').modal('toggle'); 
//            $('#exampleModalCenter').modal({
//                backdrop: 'static',
//                keyboard: false
//            }); 
    } 
 
    function add_item_to_order(itm_id){
        $("#"+itm_id+"_res1_fl").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Retrieving Data..');    
        set_list_cookies(itm_id)
        return false;
        var itm_data_jsn = $('[name="itm_data_'+$('[name="modal_itm_id"]').val()+'"]').val();  
        var itm_data = JSON.parse(itm_data_jsn);
        
            $.ajax({
                url: "<?php echo site_url('Sales_order_items/fl_ajax');?>",
                type: 'post',
                data : {function_name:'add_items_order',item_dets:itm_data,order_id:$('#order_id').val(),modal_qty:$('#modal_qty').val(),modal_price:$('#modal_price').val()},
                success: function(result){
//                    alert(result)
                    if(result){
                        $("#"+itm_id+"_res1_fl").html('<br><p style="color:green;">Item added Suucessfully</p>');
                    }else{
                        $("#"+itm_id+"_res1_fl").html('<br><p style="color:red;">Error! Something went wrong. Please Retry!</p>');
                    }
                    $('.modal-body',this).css({width:'auto',height:'auto', 'max-height':'100%'});
                       
                }
            });
	}
        
        function set_list_cookies(itm_id){
            var tabl_data = jQuery('#'+itm_id+'_form_itm').serializeArray(); 
            var input_lengt = tabl_data.length;
            tabl_data[input_lengt] = {name:'function_name',value:'item_list_set_cookies'}
            console.log(tabl_data)
//            alert()
            $.ajax({
			url: "<?php echo site_url('Sales_order_items/fl_ajax?function_name=item_list_set_cookies');?>",
			type: 'post',
			data : tabl_data,
			success: function(result){
                                $("#"+itm_id+"_res1_fl").html(result);
                                if(result){
                                    $("#"+itm_id+"_res1_fl").html('<br><p style="color:green;"><span class="fa fa-check-circle"></span> Item added to order list.</p>');
                                    $('#modal_qty').val(1);
                                }else{
                                    $("#"+itm_id+"_res1_fl").html('<br><p style="color:red;">Error! Something went wrong. Please Retry!</p>');
                                }
                                $('.modal-body',this).css({width:'auto',height:'auto', 'max-height':'100%'});
                                jQuery('#'+itm_id+'_res1_fl p').delay(1000).slideUp(2000);
                        }
            });
        }
</script>