<div class="container-fluid">
<form action="<?php echo base_url('admin/master/save')?>" method="post" id="product-form">
<div class="row">
    <div class="col-md-6">
		<div class="form-group">
			<label for="tax_name" class="control-label">Tax Name</label>
			<input name="tax_name" id="tax_name" class="form-control form text-left" value="<?php echo !empty($tax)?$tax->tax_name:''; ?>" placeholder="Enter Tax  Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($tax)?$tax->id:''; ?>">
		</div>
    </div>
    <div class="col-md-6">
      	<div class="form-group">
			<label for="tax_value" class="control-label">Tax Value ( in % )</label>
			<input name="tax_value" id="tax_value" class="form-control form text-left" value="<?php echo !empty($tax)?$tax->tax_value:''; ?>" placeholder="Enter Tax value"/>
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
				url:"<?php echo base_url('admin/master/save');?>",
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


