<div class="container-fluid">
    <form action="<?php echo base_url('admin/customer/save')?>" method="post" id="product-form">
	<div class="row">
	    <div class="col-md-6">
	        
    <div class="form-group">
			<label for="tax-preference" class="control-label">Customer Type</label>
			<select class="form-control" name="customer_type">
                <option value="">--SELECT--</option>
                <option value="business" <?php echo !empty($customer)?$customer->customer_type:''; ?>>Business</option>
                <option value="individual" <?php echo !empty($customer)?$customer->customer_type:''; ?>>Individual</option>
             </select>
		</div>
		<div class="form-group">
			<label for="firstname" class="control-label">First Name</label>
			<input name="firstname" id="firstname" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->firstname:''; ?>" placeholder="Enter First Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($customer)?$customer->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="lastname" class="control-label">Last Name</label>
			<input name="lastname" id="lastname" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->lastname:''; ?>" placeholder="Enter Last Name"/>
		</div>
		<div class="form-group">
			<label for="company_name" class="control-label">Company Name</label>
			<input name="company_name" id="company_name" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->company_name:''; ?>" placeholder="Enter Company Name"/>
		</div>
		<div class="form-group">
			<label for="display_name" class="control-label">Customer Display Name</label>
			<input name="customer_display_name" id="customer_display_name" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->customer_display_name:''; ?>" placeholder="Enter Customer Dispaly Name"/>
		</div>
	
		<div class="form-group">
			<label for="gst_number" class="control-label">GST Number</label>
			<input name="gst_number" id="gst_number" type="text" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->gst_number:''; ?>" placeholder="Enter GST Number"/>
		</div>
	
	    </div>
	    <div class="col-md-6">
	      	
		<div class="form-group">
			<label for="shipping_city" class="control-label">City</label>
			<select class="form-control" name="shipping_city">
            <option value="">--SELECT--</option>
            <option value="lucknow" <?php echo !empty($customer)?$customer->shipping_city:''; ?>>Lucknow</option>
      </select>
		</div>
	      	<div class="form-group">
			<label for="shipping_state" class="control-label">State</label>
			<select class="form-control" name="shipping_state">
            <option value="">--SELECT--</option>
           <?php 
              foreach($state as $row){
            ?>
            <option value="<?php echo $row->id;?>" <?php echo !empty($customer)?$customer->state:''; ?>><?php echo $row->state;?></option>
        <?php } ?>
      </select>
		</div>
		<div class="form-group">
			<label for="shipping_zip_code" class="control-label">Zip Code</label>
			<input name="shipping_zip_code" id="shipping_zip_code" type="text" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->shipping_zip_code:''; ?>" placeholder="Enter Zip Code"/>
		</div>
		<div class="form-group">
			<label for="shipping_number" class="control-label">Phone</label>
			<input name="shipping_number" id="shipping_number" type="text" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->shipping_number:''; ?>" placeholder="Enter Phone Number"/>
		</div>
      	<div class="form-group">
			<label for="customer_email" class="control-label">Customer Email</label>
			<input name="customer_email" id="customer_email" type="email" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->customer_email:''; ?>" placeholder="Enter Customer Email"/>
		</div>
		<div class="form-group">
			<label for="shipping_address" class="control-label">Address</label>
			<textarea name="shipping_address" id="shipping_address" type="text" class="form-control form text-left" placeholder="Enter Address"/><?php echo !empty($customer)?$customer->shipping_address:''; ?></textarea>
		</div>
	    </div>
	</div>
	<hr>
	<div class="row">
	    <div class="col-md-6">
		<label>ADDRESS</label>
		<div class="form-group">
			<label for="country_region" class="control-label">Country / Region</label>
		  <select class="form-control" name="country_region">
            <option value="">--SELECT--</option>
            <option value="india" <?php echo !empty($customer)?$customer->country_region:''; ?>>India</option>
      </select>
		</div>
		 <div class="form-group">
			<label for="tax-city" class="control-label">City</label>
			<select class="form-control" name="city">
            <option value="">--SELECT--</option>
            <option value="lucknow" <?php echo !empty($customer)?$customer->city:''; ?>>Lucknow</option>
      </select>
		</div>
		<div class="form-group">
			<label for="address" class="control-label">Address</label>
			<textarea name="address" id="address" type="text" class="form-control form text-left" placeholder="Enter Address"/><?php echo !empty($customer)?$customer->address:''; ?></textarea>
		</div>
	    </div>
	    <div class="col-md-6 mt-2"><br>
	     	<div class="form-group">
			<label for="state" class="control-label">State</label>
			<select class="form-control" name="state">
            <option value="">--SELECT--</option>
            <?php 
              foreach($state as $row){
            ?>
            <option value="<?php echo $row->id;?>" <?php echo !empty($customer)?$customer->state:''; ?>><?php echo $row->state;?></option>
        <?php } ?>
      </select>
		</div>
		<div class="form-group">
			<label for="zip_code" class="control-label">Zip Code</label>
			<input name="zip_code" id="zip_code" type="text" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->zip_code:''; ?>" placeholder="Enter Zip Code"/>
		</div>
		<div class="form-group">
			<label for="phone" class="control-label">Phone</label>
			<input name="phone" id="phone" type="number" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->phone:''; ?>" placeholder="Enter Phone Number"/>
		</div>
	    </div>
	</div>
	<hr>
	<div class="row">
	    <div class="col-md-6">
	       	<div class="form-group">
			<label>Contact Person</label>
		</div>
		<div class="form-group">
			<label for="salutation" class="control-label">Salutation</label>
    		<select class="form-control" name="salutation">
                <option value="">--SELECT--</option>
                <option value="Mr." <?php echo !empty($customer)?$customer->salutation:''; ?>>Mr.</option>
                <option value="Mrs." <?php echo !empty($customer)?$customer->salutation:''; ?>>Mrs.</option>
                <option value="Miss." <?php echo !empty($customer)?$customer->salutation:''; ?>>Miss.</option>
            </select>
		</div>
		<div class="form-group">
			<label for="contact_first_name" class="control-label">First Name</label>
			<input name="contact_first_name" id="contact_first_name" type="text" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->contact_first_name:''; ?>" placeholder="Enter First Name"/>
		</div>
		<div class="form-group">
			<label for="last_name" class="control-label">Last Name</label>
			<input name="contact_last_name" id="contact_last_name" type="text" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->contact_last_name:''; ?>" placeholder="Enter Last Name"/>
		</div>
		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<input name="contact_email" id="contact_email" type="email" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->contact_email:''; ?>" placeholder="Enter Email"/>
		</div> 
	    </div>
	    
	    <div class="col-md-6 mt-2"><br>
		<div class="form-group">
			<label for="work_phone" class="control-label">Work Phone</label>
			<input name="work_phone" id="work_phone" type="text" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->work_phone:''; ?>" placeholder="Enter Work Phone"/>
		</div>
		<div class="form-group">
			<label for="mobile_number" class="control-label">Mobile</label>
			<input name="mobile_number" id="mobile_number" type="text" min="0" class="form-control form text-left" value="<?php echo !empty($customer)?$customer->mobile_number:''; ?>" placeholder="Enter Mobile Number"/>
		</div>
			<div class="form-group">
			<label for="contact_address" class="control-label">Address</label>
			<textarea name="contact_address" id="contact_address" type="text" class="form-control form text-left" placeholder="Enter Address"/><?php echo !empty($customer)?$customer->contact_address:''; ?></textarea>
		</div>
	    </div>
	</div>
	</form> 
</div>
<script>
  
	$(document).ready(function(){
		$('#product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:"<?php echo base_url('admin/customer/save');?>",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
        
	})
</script> 
<script type="text/javascript">
    $(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#same_as").hide();
            } else {
                $("#same_as").show();
            }
        });
    });
</script>

