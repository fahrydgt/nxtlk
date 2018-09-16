<style> 
    .cat_click {
        cursor: pointer;
    }
</style>
<div id="item_contents_swipe" class="row ">  
<input hidden type="text" class="page_trackn" id="page_<?php echo $page_no;?>" value="<?php echo $page_no;?>">      
    <?php
    
//        echo '<pre>';        print_r($search_list_items_chunks); die;
    
    if(!empty($search_list_items_chunks)){
        $j=1;
        foreach ($search_list_items_chunks as $search){
//            echo '<pre>';        print_r($res_page_count); die;
            echo form_hidden('itm_data_'.$search['id'], json_encode($search));
            echo '<div style="padding:5px;" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div id="'.$j.'_'.$search['id'].'"  class="thumbnail itm_click swipeitm_'.$j.'">
                          <a > <img class="toResizeClass" src="'. base_url(ITEM_IMAGES.$search['id'].'/'.$search['image']).'" alt="'.$search['item_name'].'" style="width:100%;height:100px;;overflow: hidden"></a>

                          <div class="caption">
                              <div class="mailbox-attachment-info">
                                <a class="mailbox-attachment-name cat_click"><span style="font-size:10px;">'.$search['item_name'].'</span></a> 
                                </div> 
                          </div> 
                    </div>
                </div>';
             
            if($j%3==0) echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> </div>';
            $j++;
        }
    }else{
        echo '<p><span class="fa fa-warning"></span> No Items found for this Category!</p>';
    }
    ?>
</div>
<?php $this->load->view('sales_order_items/so_modals/item_pop_modal.php'); ?>

<script>
 
$(document).ready(function() {
    
    
    $('.itm_click').click(function(){
//              item_click_pop2_del(this.id);
              item_click_pop(this.id);
    });
    
//        $('#item_contents_swipe').swipe( {
//            
//                //Generic swipe handler for all directions
//                swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
////                    alert()
////                alert($(this).closest('div').attr('name'));
//                var page_swip_no = parseFloat($("#page_count_str").val());
////                alert($("#page_count_str").val())
//                    if(direction=='left'){ 
//                            page_swip_no++; 
//                        }
//                    if(direction=='right'){ 
//                        page_swip_no--; 
//                    }
//                $('#pagination_'+page_swip_no).trigger('click');
//                }
//            });
    
    
               $('#thumb-right-click').click(function(){
                    item_click_next('left')
               });
               $('#thumb-left-click').click(function(){
                    item_click_next('right')
               });
               
//               $(document).click(function(){
//                   if(($("#exampleModalCenter").data('bs.modal') || {}).isShown){
//                        
//                        console.log($('.modal-body').data('clicked'))
//                            alert()
//                         
//                    }
//               })
               
//               $('#exampleModalCenter').on('shown.bs.modal', function (e) { 
//                    alert("I want this to appear after the modal has opened!");
//                    
//               
//                if($('.modal-body').data('clicked')) {
//                    alert('yes');
//                }
//                });
                 
});
    function item_click_pop2_del(item_div_id){
        
        var id2 = item_div_id.split('_')[1];
        var id21 = item_div_id.split('_')[0];
//        alert(id2);
        var itm_data_jsn = $('[name="itm_data_'+id2+'"]').val(); 
        var itm_data = JSON.parse(itm_data_jsn);
//        console.log(itm_data)
        $('#modal_item_uom').text(itm_data.unit_abbreviation);
        $('#modal_item_code').text(itm_data.item_code);
        $('#modal_item_desc').text(itm_data.item_name);
        $('#modal_item_info').text(itm_data.description);
        
        $('#item_code_txt').val(itm_data.item_code);
        $('#item_uom_id_txt').val(itm_data.item_uom_id);
        $('#modal_itm_id').val(itm_data.id);
        $('#modal_price').val(parseFloat(itm_data.item_price_amount).toFixed(2));
        $('#item_det_json').val(itm_data_jsn);
        
        if(typeof(itm_data.image) != "undefined" && itm_data.image !== ""){ 
            var img_def = '<div id="img_1"  name="'+id21+'" class="item active"><img src="<?php echo base_url(ITEM_IMAGES);?>/'+itm_data.id+'/'+itm_data.image+'" alt="First slide" style="width:100%"></div>';
            var img_def_thumb = '<img id="imgtmb_1" style="border-width:5px;height:80px;  border-style:ridge;" class="itm-thmb pad col-md-3 col-sm-3 col-xs-3 border-left" src="<?php echo base_url(ITEM_IMAGES);?>/'+itm_data.id+'/'+itm_data.image+'">';
            $('.carousel-inner').html(img_def); 
            $('.carousel-small-img').html(img_def_thumb); 
        }  
            
        if(typeof(itm_data.images) != "undefined" && itm_data.images !== ""){
            
            var itm_imgdata = JSON.parse(itm_data.images);
            var cnt = 2;
            if(typeof(itm_imgdata) != "undefined" && itm_imgdata !== ""){
                $(itm_imgdata).each(function (index, o) {   
                     var $img = '<div id="img_'+cnt+'" name="'+id21+'" class="item"><img src="<?php echo base_url(ITEM_IMAGES);?>/'+itm_data.id+'/other/'+o+'" alt="First slide" style="width:100%"></div>';
                     var img_def_thumb = '<img id="imgtmb_'+cnt+'" style="border-width:5px;height:80px; border-style:ridge;" class="pad col-md-3 col-sm-3 col-xs-3 itm-thmb" src="<?php echo base_url(ITEM_IMAGES);?>/'+itm_data.id+'/other/'+o+'">';
                        $('.carousel-inner').append($img);
                        $('.carousel-small-img').append(img_def_thumb);
                        cnt++;
                 });
            }
         }  
        $('#exampleModalCenter').modal({
            backdrop: 'static',
            keyboard: false
        });
//        $('#exampleModalCenter').modal('toggle');
              $('.itm-thmb').click(function(){
              var tmbimg_id = (this.id).split('_')[1]; 
              var active_mg = $('.carousel-inner .active').attr('id').split('_')[1];
                var dif = parseFloat(tmbimg_id)-parseFloat(active_mg);
                $('#img_'+active_mg).removeClass('active');
                $('#img_'+tmbimg_id).addClass('active'); 
              });
    }
        
    </script>