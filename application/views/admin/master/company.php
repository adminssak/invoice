<div class="container-fluid">
    <form action="<?php echo base_url('admin/company/save')?>" method="post" id="product-form">
<div  class="row">
     
    <div class="col-md-6">
       	<div class="form-group">
        <label class="form-label"> Image </label>
        <input type="file" name="image"  class="form-control form text-left" value="<?php if(!empty($edit_service)) echo($edit_service->image); ?>">
        <input type="hidden" name="old_image" value="<?php if(!empty($edit_service)) echo($edit_service->image); ?>"  class="form-control" >
        <input type="hidden" name="edit_id" value="<?php if(!empty($edit_service)) echo($edit_service->id); ?>"  class="form-control" >
     </div>
      <div class="form-group">
			<label for="company_name" class="control-label">Select Invoice</label>
			<select class="form-control" name="invoice_number" id="invoice_number">
                 <option value="">--SELECT Invoice--</option>
                <?php
                  if(!empty($invoice)){
                    foreach ($invoice as  $row) 
                  { 
                  ?>
                <option value="<?php echo $row->id;?>"><?php echo strtoupper($row->prefix_name);?><?php echo $row->next_number;?></option>
                  <?php } } else {
                  ?>
                <option value="<?php echo !empty($edit_service)?$edit_service->id:''; ?>" selected><?php echo !empty($edit_service)?$edit_service->invoice_number:''; ?></option>
                <?php  }?>
            </select>
		</div>
      
      
    </div>
    <div class="col-md-6">
      	<div class="form-group">
			<label for="company_name" class="control-label">Name of Company</label>
			<input name="company_name" id="company_name" class="form-control form text-left" value="<?php echo !empty($company)?$company->company_name:''; ?>" placeholder="Enter Company  Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($company)?$company->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="gstin_number" class="control-label">GSTIN Number</label>
			<input name="gstin_number" id="gstin_number" class="form-control form text-left" value="<?php echo !empty($company)?$company->gstin_number:''; ?>" placeholder="Enter GSTIN Number"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($company)?$company->id:''; ?>">
		</div>
    </div>
    <div class="col-md-6">
    	
			<div class="form-group">
			<label for="full_address" class="control-label">Full Address</label>
			<textarea name="full_address" id="full_address" class="form-control form text-left ck-editor" placeholder="Enter Full Address"/><?php echo !empty($company)?$company->address:''; ?></textarea>
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
				url:"<?php echo base_url('admin/company/save');?>",
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