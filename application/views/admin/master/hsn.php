<div class="container-fluid">
	<form action="<?php echo base_url('admin/master/save_hsn')?>" method="post" id="product-form">
		<div class="form-group">
			<label for="hsn_code" class="control-label">HSN Code</label>
			<input name="hsn_code" id="hsn_code" class="form-control form text-left" value="<?php echo !empty($hsn)?$hsn->hsn_code:''; ?>" placeholder="Enter HSN Code Here"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($hsn)?$hsn->id:''; ?>">
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
				url:"<?php echo base_url('admin/master/save_hsn');?>",
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


