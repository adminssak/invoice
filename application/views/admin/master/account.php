<div class="container-fluid">
<form action="<?php echo base_url('admin/account/save')?>" method="post" id="product-form">
  <div class="row">
      <div class="col-md-6">
          	
	       	<div class="form-group">
			<label for="company_name" class="control-label">Select Company</label>
			<select class="form-control" name="company_name" id="company_name">
                 <option value="">--SELECT COMPANY--</option>
                <?php
                  if(empty($account)){
                    foreach ($company as  $row) 
                  { 
                  ?>
                <option value="<?php echo $row->id;?>"><?php echo strtoupper($row->company_name);?></option>
                  <?php } } else {
                  ?>
                <option value="<?php echo !empty($account)?$account->id:''; ?>" selected><?php echo !empty($account)?$account->company_name:''; ?></option>
                <?php  }?>
            </select>
		</div>
		<div class="form-group">
			<label for="name_in_account" class="control-label">Name in The Account</label>
			<input name="name_in_account" id="name_in_account" class="form-control form text-left" value="<?php echo !empty($account)?$account->name_in_account:''; ?>" placeholder="Enter Name In The Account"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($account)?$account->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="account_number" class="control-label">Account Number</label>
			<input name="account_number" id="account_number" class="form-control form text-left" value="<?php echo !empty($account)?$account->account_number:''; ?>" placeholder="Enter Account Number"/>
		</div>
		
	
      </div>
      <div  class="col-md-6">
          	<div class="form-group">
			<label for="bank_name" class="control-label">Bank Name</label>
			<input name="bank_name" id="bank_name" class="form-control form text-left" value="<?php echo !empty($account)?$account->bank_name:''; ?>" placeholder="Enter Bank Name"/>
		</div>
		<div class="form-group">
			<label for="branch_name" class="control-label">Branch Name</label>
			<input name="branch_name" id="branch_name" class="form-control form text-left" value="<?php echo !empty($account)?$account->branch_name:''; ?>" placeholder="Enter Branch Name"/>
		</div>
	<div class="form-group">
			<label for="ifsc_code" class="control-label">IFSC Code</label>
			<input name="ifsc_code" id="ifsc_code" class="form-control form text-left" value="<?php echo !empty($account)?$account->ifsc_code:''; ?>" placeholder="Enter IFSC Code"/>
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
				url:"<?php echo base_url('admin/account/save');?>",
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