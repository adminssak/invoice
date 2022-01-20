<script type="text/javascript">
function CheckTax(val){
 var element=document.getElementById('tax');
 if(val=='pick a tax'||val=='others')
   element.style.display='non';
 else  
   element.style.display='block';
}
</script>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Items</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_item" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Add Item</a>
			
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid  table-responsive">
			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th>S.N.</th>
						<th>Date Created</th>
						<th>Name</th>
						<!--<th>SKU</th>-->
						<th>Unit</th>
						<th>Price</th>
						<th>Category Name</th>
						<!--<th>Hsn Code</th>-->
						<th style="width:20%;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($items as $key => $value) { ?>
						<tr>
							<td class="text-center"><?php echo ++$key; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($value->created_at)) ?></td>
							<td><?php echo $value->name; ?></td>
							<!--<td><?php echo $value->sku; ?></td>-->
							<td><?php echo $value->unit; ?></td>
							<td><?php echo number_format($value->price,2) ?></td>
							<td><?php echo $value->category_name; ?></td>
							<!--<td><?php echo $value->hsn_code; ?></td>-->
							<td style="width:20%;" align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action<span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $value->id; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
		$('#create_item').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add Item  ","<?php echo base_url('admin/items/manage');?>","mid-large")
			
		})
		 
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Product","<?php echo base_url('admin/items/manage');?>/"+$(this).attr('data-id'),"mid-large")
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
			url:"<?php echo base_url('admin/items/delete_data');?>",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
