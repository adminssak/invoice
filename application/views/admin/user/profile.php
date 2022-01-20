<style>
#cimg{
    height: 50px;
    width: 50px;
}
</style>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<form  method="post" id="manage-user">	
				<input type="hidden" name="id" value="">
				<div class="form-group">
					<label for="name">Admin Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo !empty($setting)?$setting['firstname']:''; ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Project Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo !empty($setting)?$setting['lastname']:''; ?>" required>
				</div>
				
				<div class="form-group">
					<label for="" class="control-label">Avatar</label>
					<div class="custom-file">
		              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="image" onchange="displayImg(this,$(this))" >
		              <label class="custom-file-label" for="customFile">Choose file</label>
		            </div>
				</div>
	          <?php 
	          if(!empty($setting)){
	          ?>
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo base_url().'uploads/company/'. $setting['image'];?>" alt="" class="img-fluid img-thumbnail" style="height: 100px; width: 140px;">
				</div>
				<?php } else {?>
					<div class="form-group d-flex justify-content-center">
					<img src="" alt="" id="cimg" class="img-fluid img-thumbnail" >
				</div>
				<?php } ?>
				<div class="card-footer">
        			<div class="col-md-12">
        				<div class="row">
        					<button type="submit" class="btn btn-sm btn-primary" form="manage-user">Update</button>
        				</div>
        			</div>
        		</div>
			</form>
		</div>
	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_loader()
		$.ajax({
			url:'<?php echo base_url('admin/user/save');?>',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp.status ==1){
					windows.location.reload();
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
			}
		})
	})

</script>
	 