<!--  -->
<script type="text/javascript">
function CheckTax(val){
 var element=document.getElementById('tax_preference');
 if(val=='pick a tax_preference'||val=='others')
   element.style.display='non';
 else  
   element.style.display='block';
}
</script>
<div class="container-fluid">
    <form action="<?php echo base_url('admin/category/save')?>" method="post" id="product-form">
	<div class="row">
	    <div class="col-md-6">
	        

		<div class="form-group">
			<label for="category_name" class="control-label">Category Name</label>
			<input name="category_name" id="category_name" class="form-control form text-left" value="<?php echo !empty($category)?$category->category_name:''; ?>" placeholder="Enter Category Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($category)?$category->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="sku" class="control-label">Description</label>
			<textarea name="description" id="description" class="form-control form text-left" value="" placeholder="Enter Description"/><?php echo !empty($category)?$category->description:''; ?></textarea>
		</div>
	
	    </div>
	    <div  class="col-md-6">
	        	<div class="form-group">
			<label for="hsn-code" class="control-label">Type</label>
			<select class="form-control" name="type">
			     <?php
                  if(!empty($category)){
                  ?>
                  <option value="<?php echo !empty($category)?$category->type:''; ?>"><?php echo !empty($category)?$category->type:''; ?></option>
                  <?php } else {?>
                <option value="">--SELECT--</option>
                <!--<option value="Product">Product</option>-->
                <option value="Service">Service</option>
                <?php } ?>
            </select>
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
				url:"<?php echo base_url('admin/category/save');?>",
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


