<!--  -->
<div class="container-fluid">
	<form action="" id="product-form">
		<input type="hidden" name ="id" value="">
		<div class="form-group">
			<label for="category_id" class="control-label">Category</label>
			<select name="category_id" id="category_id" class="custom-select select select2">
				<option></option>
				
				<option value=""></option>
				
			</select>
		</div>
		<div class="form-group">
			<label for="product" class="control-label">Name</label>
			<textarea name="product" id="product" cols="30" rows="2" class="form-control form no-resize"><?php //echo isset($product) ? $product : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea name="description" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php //echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="price" class="control-label">Price</label>
			<input name="price" id="price" class="form-control form text-right" value="<?php// echo isset($price) ? $price : ''; ?>" />
		
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
				url:_base_url_+"classes/Master.php?f=save_product",
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