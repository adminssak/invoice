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
   <form action="<?php echo base_url('admin/items/save')?>" method="post" id="product-form">
	<div class="row">
	    <div class="col-md-6">
	        
  
		<div class="form-group">
			<label for="price" class="control-label">Name</label>
			<input name="name" id="name" class="form-control form text-left" value="<?php echo !empty($items)?$items->name:''; ?>" placeholder="Enter Item Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($items)?$items->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="sac_code" class="control-label">SAC Code</label>
			<select class="form-control" name="sac_code" id="sac_code">
            <option value="">--SELECT--</option>
            <?php
              if(empty($items)){
              foreach ($sac as  $row) 
              { 
              ?>
            <option value="<?php echo $row->sac_code;?>"><?php echo strtoupper($row->sac_code);?></option>
          <?php } } else {?>
            <option value="<?php echo !empty($items)?$items->sac_code:''; ?>" selected><?php echo !empty($items)?$items->sac_code:''; ?></option>
          <?php } ?>
         </select>
		</div>
		<div class="form-group">
			<label for="unit" class="control-label">Unit</label>
			<input name="unit" id="unit" class="form-control form text-left" value="<?php echo !empty($items)?$items->unit:''; ?>" placeholder="Enter Unit Number"/>
		</div>
		 <div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea name="description" id="description" class="form-control form text-left" placeholder="Enter Description"/><?php echo !empty($items)?$items->description:''; ?></textarea>
		</div>

	    </div>
	    <div class="col-md-6 pop-up-modal">
	    <div class="form-group">
			<label for="price" class="control-label">Price</label>
			<input name="price" id="price" class="form-control form text-left" value="<?php echo !empty($items)?$items->price:''; ?>" placeholder="Enter Price"/>
		</div>
	   
		<div class="form-group">
			<label for="category_name" class="control-label">Category</label>
			<select class="form-control" name="category_name" id="category_name">
            <option value="">--SELECT--</option>
            <?php
              if(empty($items)){
              foreach ($category as  $row) 
              { 
              ?>
            <option value="<?php echo $row->category_name;?>"><?php echo strtoupper($row->category_name);?></option>
             <?php } } else {?>
            <option value="<?php echo !empty($items)?$items->category_name:''; ?>" selected><?php echo !empty($items)?$items->category_name:''; ?></option>
          <?php } ?>
     </select>
		</div>
		
		<div class="form-group">
			<label for="tax-preference" class="control-label">Tax Preference</label>
			<select class="form-control" id="preference" name="tax_preference" onchange='CheckTax(this.value)';>
                <option value="">--SELECT--</option>
                <?php 
                if(empty($items)){
                ?>
                <option value="taxable" <?php echo !empty($items)?$items->tax_preference:''; ?>>Taxable</option>
                <option value="nontaxable" <?php echo !empty($items)?$items->tax_preference:''; ?>>Non-Taxable</option>
              <?php } else { ?>
                <option value="<?php echo !empty($items)?$items->tax_preference:''; ?>" selected><?php echo !empty($items)?$items->tax_preference:''; ?></option>
              <?php } ?>
             </select>
		</div>
		<div class="form-group" id="tax_preference" style='display:none;'>
			<input name="tax_preference"  class="form-control form text-left" placeholder="Enter Tax Preference"/>
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
				url:"<?php echo base_url('admin/items/save');?>",
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


