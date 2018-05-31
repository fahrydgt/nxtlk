<?php
	
	$result = array(
                        'id'=>"",
                        'customer_id'=>"",
                        'description'=>"",
                        'pending_invoice_amount'=>0,
                        'pending_total_amount'=>0,
                        'trans_reference'=>0,
                        'trans_date'=>date('m/d/Y'),
                        'transection_type_id'=>1,
                        'transection_amount'=>0,
                        'extra_km_rate'=>0,
                        'extra_time_rate'=>0,//per hour
                        'owner_rate_plan'=>0,
                        'owner_rate'=>0,
                        'currency_code'=>"LKR",
                        'status'=>"1",
                        );   		
	
	 
	switch($action):
	case 'Add':
		$heading	= 'Add';
		$dis		= 'readonly';
		$view		= '';
		$o_dis		= ''; 
	break;
	
	case 'Edit':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'Edit';
		$dis		= '';
		$view		= '';
		$o_dis		= ''; 
	break;
	
	case 'Delete':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'Delete';
		$dis		= 'readonly';
		$view		= '';
		$o_dis		= ''; 
		$check_bx_dis		= 'disabled'; 
	break;
      
	case 'View':
		if(!empty($user_data[0])){$result= $user_data[0];} 
		$heading	= 'View';
		$view		= 'hidden';
		$dis        = 'readonly';
		$o_dis		= 'disabled'; 
	break;
endswitch;	 

//var_dump($result);
?> 
<!-- Main content -->
 <br>
        <div class="col-md-12">
            
             <!--Flash Error Msg-->
                             <?php  if($this->session->flashdata('error') != ''){ ?>
					<div class='alert alert-danger ' id="msg2">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<i ></i>&nbsp;<?php echo $this->session->flashdata('error'); ?>
					<script>jQuery(document).ready(function(){jQuery('#msg2').delay(1500).slideUp(1000);});</script>
					</div>
				<?php } ?>
				
					<?php  if($this->session->flashdata('warn') != ''){ ?>
					<div class='alert alert-success ' id="msg2">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<i ></i>&nbsp;<?php echo $this->session->flashdata('warn'); ?>
					<script>jQuery(document).ready(function(){jQuery('#msg2').delay(1500).slideUp(1000);});</script>
					</div>
				<?php } ?>  
            <div class="">
                 <a href="<?php echo ($res_det['person_type']==20)?base_url('Invoices/view/'.$res_det['id']):base_url('Bookings/edit/'.$res_det['id']);?>" class="btn btn-app "><i class="fa fa-backward"></i>Back</a>
                <!--<a class="btn btn-app "><i class="fa fa-trash"></i>Delete</a>-->
            </div>
        </div>
 <br><hr>
    <section  class="content"> 
        <div class="">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $action;?> </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              
             <?php echo form_open_multipart("Customer_payments/validate"); ?> 
             <?php echo form_hidden('person_type',$res_det['person_type'])?> 
                
                    <div class="box-body fl_scroll">
                              
                        <div class="row"> 
                                        
                                            <div class="col-md-6">
                                                <h5>Invoice Info</h5>
                                                <hr> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Customer:<span style="color: red">*</span></label>
                                                    <div class="col-md-9">    
                                                       <?php  echo form_dropdown('customer_id',$customer_list,set_value('customer_id',$res_det['customer_id']),' class="form-control select2" data-live-search="true" id="addon_type" '.$o_dis.'');?> 
                                                        <span class="help-block"><?php echo form_error('customer_id');?>&nbsp;</span>
                                                    </div> 
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Transection Type:<span style="color: red">*</span></label>
                                                    <div class="col-md-9">    
                                                       <?php  echo form_dropdown('transection_type_id',$transection_type_list,set_value('transection_type_id',$res_det['transection_type_id']),' class="form-control" data-live-search="true" id="addon_type" '.$o_dis.'');?> 
                                                        <span class="help-block"><?php echo form_error('transection_type_id');?>&nbsp;</span>
                                                    </div> 
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Invoice No<span style="color: red"></span></label>
                                                    <div class="col-md-9">    
                                                        <?php echo form_input('trans_reference', set_value('trans_reference',$res_det['trans_reference']), 'id="trans_reference" class="form-control" placeholder="Invoice No"'.$dis.' '.$o_dis.' '); ?>
                                                        <span class="help-block"><?php echo form_error('trans_reference');?>&nbsp;</span>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Pending for Invoice<span style="color: red"></span></label>
                                                    <div class="col-md-9">    
                                                        <?php echo form_input('pending_invoice_amount', set_value('pending_invoice_amount', number_format($pending_invoice_amount,2)), 'id="pending_invoice_amount" class="form-control" placeholder="Pending Amount this Invoice"'.$dis.' '.$o_dis.' '); ?>
                                                        <span class="help-block"><?php echo form_error('pending_invoice_amount');?>&nbsp;</span>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Total Pending <span style="color: red"></span></label>
                                                    <div class="col-md-9">    
                                                        <?php echo form_input('pending_total_amount', set_value('pending_total_amount', number_format($pending_total_amount,2)), 'id="pending_total_amount" class="form-control" placeholder="Pending Amount from customer"'.$dis.' '.$o_dis.' '); ?>
                                                        <span class="help-block"><?php echo form_error('pending_total_amount');?>&nbsp;</span>
                                                    </div> 
                                                </div>
                                            </div>
                                               
                                            <div class="col-md-6">
                                                <h5>Payment Amounts Info</h5>
                                                <hr>
                                                 <div class="form-group">
                                                    <label class="col-md-3 control-label">Date Payment<span style="color: red">*</span></label>
                                                    <div class="col-md-9">    
                                                        <?php echo form_input('trans_date', set_value('trans_date', $result['trans_date']), 'id="trans_date" class="datepicker form-control" placeholder="Click to select Date"'.$dis.' '.$o_dis.' '); ?>
                                                        <span class="help-block"><?php echo form_error('trans_date');?>&nbsp;</span>
                                                    </div> 
                                                </div>
                                                 <div class="form-group">
                                                    <label class="col-md-3 control-label">Amount<span style="color: red">*</span></label>
                                                    <div class="col-md-9">    
                                                        <?php echo form_input('transection_amount', set_value('transection_amount', number_format($result['transection_amount'],2,'.','')), 'id="transection_amount" class="form-control" placeholder="Enter amount" '.$o_dis.' '); ?>
                                                        <span class="help-block"><?php echo form_error('transection_amount');?>&nbsp;</span>
                                                    </div> 
                                                </div>
                                                 
                                                
                                                <div class="form-group">
                                                <label class="col-md-3 control-label">Memo/Note</label>
                                                    <div class="col-md-9">                                            
                                                        <div class="input-group">  
                                                             <?php echo form_textarea(array('name'=>'description','rows'=>'4','cols'=>'60', 'class'=>'form-control', 'placeholder'=>'Enter description' ),$result['description'],$o_dis.' '); ?>
                                                        </div>                                            
                                                        <span class="help-block"><?php echo form_error('description');?><br></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    </div>
                                           
                                             
                        </div>
                    </div>
                          <!-- /.box-body -->

                    <div class="box-footer">
                          <!--<butto style="z-index:1" n class="btn btn-default">Clear Form</button>-->                                    
                                    <!--<button class="btn btn-primary pull-right">Add</button>-->  
                                    <?php if($action != 'View'){?>
                                    <?php echo form_hidden('id', $res_det['id']); ?>
                                    <?php echo form_hidden('action',$action); ?>
                                    <?php echo form_submit('submit',$action ,'class="btn btn-primary"'); ?>&nbsp;

                                    <?php echo anchor(site_url('Bookings/edit/'.$res_det['id']),'Back','class="btn btn-info"');?>&nbsp;
                                    <?php echo form_reset('reset','Reset','class = "btn btn-default"'); ?>

                                 <?php }else{ 
                                        echo form_hidden('action',$action);
                                        echo anchor(site_url($this->router->fetch_class()),'OK','class="btn btn-primary"');
                                    } ?>
                      <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                    </div>
                  </form>
                </div>
                <!-- /.box -->
          </div> 
    </section> 
 
<script>
    
$(document).ready(function(){  
    included_show();
    $('#calculation_type').change(function(){
        included_show();
    });
    function included_show(){
        var cal_type_val = $('#calculation_type').val(); 
        if(cal_type_val==2){ 
            $('#included_div').show(); 
            $('#currency_div').hide(); 
        }else{
            if(cal_type_val==1){
                $('#currency_div').show(); 
            }
            $('#included_div').hide(); 
        }
    }
});
</script>