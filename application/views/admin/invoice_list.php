<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Items</h3>
		<div class="card-tools">
			<a href="<?php echo base_url('admin/invoice/manage');?>" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Add Invoice</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid table-responsive">
			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th>S.N.</th>
						<th>Customer Name</th>
						<th>Invoice Code</th>
						<th>Order Number</th>
						<th>Invoice Date</th>
						<th>Due Date</th>
						<th>Download</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($invoices as $key => $value) { ?>
						<tr>
							<td class="text-center"><?php echo ++$key; ?></td>
							<td><?php echo $value->customer_name; ?></td>
							<td><?php echo $value->invoice_number; ?></td>
							<td><?php echo $value->order_number; ?></td>
							<td><?php echo $value->invoice_date; ?></td>
							<td><?php echo $value->due_date; ?></td>
							<td><a class="dropdown-item" href="<?php echo base_url('admin/mypdf/print_item');?>/<?php echo $value->id; ?>" >Download</a></td>
							<td>
                              <select class="form-control" data-id="<?php echo $value->id; ?>" onchange="change_statu('<?php echo $value->id; ?>',this.value);" id='status' name='status'>
			                        <option value="1" <?php if($value->status==1){ echo 'selected'; } ?>>None</option>
			                        <option value="2" <?php if($value->status==2){ echo 'selected'; } ?>>Paid</option>
			                        <option   class="partial" value="3" <?php if($value->status==3){ echo 'selected'; } ?> >Partial</option>
			                        <option value="4" <?php if($value->status==4){ echo 'selected'; } ?>>Void</option>
			                  </select>
                            </td>
							<td>
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action<span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <a class="dropdown-item" href="<?php echo base_url('admin/invoice/print_view');?>/<?php echo $value->id; ?>" ><span class="fa fa-eye text-primary"></span> View</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="<?php echo base_url('admin/mail/mail_send');?>/<?php echo $value->id; ?>" ><span class="fa fa-envelope text-primary"></span> Send</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="<?php echo base_url('admin/invoice/manage');?>/<?php echo $value->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $value->id; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
							</td>
						</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Product","<?php echo base_url('admin/invoice/manage');?>/"+$(this).attr('data-id'),"mid-large")
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this item permanently?","delete_product",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
		$('#uni_modal').on('shown.bs.modal', function() {
			$('.select2').select2({width:'resolve'})
			$('.summernote').summernote({
				height: 200,
				toolbar: [
					[ 'style', [ 'style' ] ],
					[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
					[ 'fontname', [ 'fontname' ] ],
					[ 'fontsize', [ 'fontsize' ] ],
					[ 'color', [ 'color' ] ],
					[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
					[ 'table', [ 'table' ] ],
					[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
				]
			})
		})
	})
	function delete_product($id){
		start_loader();
		$.ajax({
			url:"<?php echo base_url('admin/invoice/delete_inv');?>",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				// console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
<script>
function change_statu(id,status)
  {
  	if(status == 3){
         uni_modal("<i class='fa fa-edit'></i> Partial Payment","<?php echo base_url('admin/invoice/next');?>/"+id,"mid-large"); 
         $.ajax({
        type: 'POST',
        url: '<?php echo base_url('admin/invoice/change_Status'); ?>',
        data: {id:id,status:status}, 
        success: function(data){
          } 
    });
  	}else{
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('admin/invoice/change_Status'); ?>',
        data: {id:id,status:status}, 
        success: function(data){
        	// alert(data.status);
        	// console.log(data.status);

            alert("Your status has been updated");
            location.reload();
          } 
    });
    }
}

</script>