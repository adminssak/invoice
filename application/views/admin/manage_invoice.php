<style>
input[type="date"].form-control,  input[type="month"].form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    font-size: 13px;
}
</style>
<section class="content  text-dark">
  <div class="container-fluid">
    <style>
		#item-list th, #item-list td{
			padding:5px 3px!important;
		}
</style>
		<div class="card card-outline card-primary">
			<div class="card-header">
			<h3 class="card-title">New Invoice</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('admin/invoice/save_invoice');?>" method="post" enctype="multipart/form-data" id="product-form">
				<div class="container-fluid">
						<input type="hidden" name ="id" id="forms" value="<?php if(!empty($invoice)) echo ($invoice->id); ?>">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="customer_name" class="control-label">Customer Name</label>
									<select name="customer_name" id="name"  class="form-control custom-select-sm select">
										  <option value="" selected>Select</option>
										  <?php foreach($customer as $row){  //print_r($row);?>
										  	  <option data-customer-email="<?php echo $row->customer_email; ?>" data-customer-type="<?php echo $row->customer_type; ?>" data-company-name="<?php echo $row->company_name; ?>" data-gstn="<?php echo $row->gst_number; ?>" <?php if(!empty($invoice)&&$invoice->customer_name ==$row->firstname){ echo 'selected="selected"'; } ?> value="<?php echo $row->firstname;?>"><?php echo strtoupper($row->firstname);?></option>
										  <?php } ?>
									</select>
									<!--<span id="cust_type"></span>-->
									<!--<span id="comp_name"></span>-->
									<!--<span id="gst_num"></span>-->
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="gstin" class="control-label">GSTIN</label>
									<select name="gstin" id="gstin"  class="form-control custom-select-sm select">
										<?php 
	                                     if(!empty($invoice)){
										?>
										  <option <?php if(!empty($invoice)) echo ($invoice->gstin); ?> value="<?php if(!empty($invoice)) echo ($invoice->gstin); ?>" selected><?php if(!empty($invoice)) echo ($invoice->gstin); ?></option>
                    	                   <?php } else {?>
                        	              
									  <?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="place_of_supply" class="control-label">Place of Supply</label>
									<select name="place_of_supply" id="place_of_supply"  class=" form-control custom-select-sm select">
										 <option value="" selected>Select</option>
										  <?php 
										  if(empty($invoice)){
		                                   foreach($state as $row){
										  ?>
									    <option  value="<?php echo $row->id;?>"><?php echo $row->state	;?></option>
									  	<?php } } else {?>
									  		<option <?php if(!empty($invoice)) echo ($invoice->place_of_supply); ?> value="<?php if(!empty($invoice)) echo ($invoice->place_of_supply); ?>"><?php if(!empty($invoice)) echo ($invoice->place_of_supply); ?></option>
									  	<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="invoice_number" class="control-label">Invoice Number</label>
									<input type="text" name="invoice_number" id="invoice_number" class="form-control" readonly="true" value="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="order_number" class="control-label">Order Number</label>
									<input type="text" min="0" name="order_number" id="order_number" cols="30" rows="2" class="form-control form no-resize" value="#<?php echo $orders; ?>">
									<input type="hidden" min="0" name="edit_id" cols="30" rows="2" class="form-control form no-resize" value="<?php if(!empty($invoice)) echo ($invoice->id);?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="invoice_date" class="control-label">Invoice Date</label>
									<input name="invoice_date" type="date" id="txtDate" cols="30" rows="2" class="form-control form no-resize date-decide" value="<?php if(!empty($invoice)) echo ($invoice->invoice_date);?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="due_date" class="control-label">Due Date</label>
									<input name="due_date" type="date" id="due" cols="30" rows="2" class="form-control form no-resize" value="<?php if(!empty($invoice)) echo ($invoice->due_date);?>">
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="form-group">
									<label for="type" class="control-label">Enter Email</label>
									<input name="email" type="email" id="email" cols="30" rows="2" class="form-control form no-resize" value="<?php if(!empty($invoice)) echo ($invoice->email) ;?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="place_of_supply" class="control-label">Select Unit Type</label>
									<select name="type" id="type"  class="form-control custom-select-sm select">
										  <option value="" selected>Select</option>
									    <!--<option value="Product">Product</option>-->
									    <option value="Service">Service</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="company" class="control-label">Select Company</label>
									<select name="company" id="company"  class="form-control custom-select-sm select">
										  <option value="" selected>Select Company</option>
										<?php 
										if(empty($invoice)){
		                                  foreach($company as $row){
										  ?>
										  <option value="<?php echo $row->id;?>"><?php echo $row->company_name;?></option>
										<?php } } else { ?>
											<option <?php if(!empty($invoice)) echo ($invoice->account); ?> value="<?php if(!empty($invoice)) echo ($invoice->id); ?>"><?php if(!empty($invoice)) echo ($invoice->account); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="account" class="control-label">Select Account</label>
									<select name="account_full" id="account_full"  class="form-control custom-select-sm select">
										  <option value="" selected>Select Account</option>
									
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="due_type" class="control-label">Select Due Type</label>
									<select name="due_type" id="due_type"  class="form-control custom-select-sm select">
										<option value="" selected>Select</option>
									    <option value="1">1 Month</option>
									    <option value="2">3 Month</option>
									    <option value="3">6 Month</option>
									    <option value="4">12 Month</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
							    <?php 
							    foreach($customer_notes as $cust){
							     //   print_r($cust);
							     //   die();
							    ?>
								<div class="form-group">
									<label for="customer_notes" class="control-label">Customer Notes</label>
									<textarea name="customer_notes" id="customer_notes" cols="30" rows="2" class="form-control form no-resize summernote"><?php  echo $cust->customer_notes;?></textarea>
								</div>
								<?php } ?>
							</div>
							
							<div class="col-md-6">
							     <?php 
							    foreach($term as $terms){
							    ?>
								<div class="form-group">
									<label for="terms_condition" class="control-label">Terms & Condition</label>
									<textarea name="terms_condition" id="terms_condition" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo $terms->term;?></textarea>
								</div>
								<?php } ?>
							</div>
						</div>
						<hr>
						<!--<h4>Item Form:</h4>-->
						<div class="row align-items-end">
							<div class="col-md-3">
								<div class="form-group">
								 <label for="category" class="control-label">Category</label>
									<select id="category_id" class="form-control">
										
									</select>
							 </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label for="form_id" class="control-label">Product/Service</label>
									<select  id="form_id" class="form-control" >
									
								</select>
								<small id="price"></small>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="unit" class="control-label">Unit</label>
									<select  id="unit" class="form-control" >
									
								</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="qty" class="control-label">QTY</label>
									<input type="number" min='1' id="qty"  class="form-control text-right">
								</div>
							</div>
							<div class="col-md-2 pb-1">
								<div class="form-group">
									<button class="btn btn-flat btn-primary" type="button" onclick="add_item();"><i class="fa fa-plus"></i> Add</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 table-responsive">
								<?php 
								$qty=array();
								if(!empty($invoice)){
								    // print_r($invoice);
								    // die();
									$item_data=json_decode($invoice->items);
									if(!empty($item_data))
									{
										$qty=$item_data->qty;
										$unit=$item_data->unit;
										$item_category=$item_data->item_category;
										$item_name=$item_data->item_name;
										$item_description=$item_data->item_description;
										$price=$item_data->price;
										$total=$item_data->total;
									}
								}
								?>
								<table class="table table-bordered mt-3" id="item-list">
									<thead>
										<tr>
											<th class="text-center">QTY</th>
											<th class="text-center">UNIT</th>
											<th class="text-center">Product/Service</th>
											<th class="text-center">Cost</th>
											<th class="text-center">Total</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if(!empty($qty )){
                    foreach($qty as $key=> $row){
										?>
										<tr>
											<td class="text-center">
												<?php echo $row; ?>
													<input type="hidden" name="qty[]" value="<?php echo $row; ?>">
													<input type="hidden" name="unit[]" value="<?php echo $unit[$key]; ?>">
													<input type="hidden" name="item_category[]" value="<?php echo $item_category[$key]; ?>">
													<input type="hidden" name="item_name[]" value="<?php echo $item_name[$key]; ?>">
													<input type="hidden" name="item_description[]" value="<?php echo $item_description[$key]; ?>">
													<input type="hidden" name="price[]" value="<?php echo $price[$key]; ?>">
													<input type="hidden" name="total[]" value="<?php echo $total[$key]; ?>">
											</td>
											<td class="text-center">
												<?php echo $unit[$key]; ?>
											</td>
											<td class="text-center">
												<p class="m-0"><small><b>Category:<?php echo $item_category[$key]; ?></b> </small></p>
												<p class="m-0"><small><b>Name: <?php echo $item_name[$key]; ?></b></small></p>
												<div class="m-0"><small><?php echo $item_description[$key]; ?></small></div>
												</td>
											<td class="text-center">
												<?php echo $price[$key]; ?>
											</td>
											<td class="text-center price_sub" data-rate="<?php echo $total[$key]; ?>">
												<?php echo $total[$key]; ?>	
											</td>
											<td class="text-center">
												<button class='btn btn-sm btn-outline-danger' type='button' onclick='rem_item($(this))'><i class='fa fa-trash'></i></button>
											</td>
                     </tr>
                   <?php } }  ?>
									</tbody>
									<tfoot>
										<tr>
											<th class="text-right" colspan="4">Sub Total</th>
											<th class="text-right" id="sub_total">
												<?php if(!empty($invoice)){ echo ($invoice->sub_total);} ?>
											</th>
										</tr>
										<tr>
											<th class="text-right" colspan="4">Tax Rate</th>
											<th class="text-right" id="tax_rate">18%</th>
										</tr>
										<tr>
											<th class="text-right" colspan="4">Tax</th>
											<?php 
												$tax_details=0;
                       if(!empty($invoice)){
                       	$tax_details = ($invoice->sub_total*18)/100;
                       	}
											?>
											<th class="text-right" id="tax"><?php echo $tax_details;?></th>
										</tr>
										<tr>
											<th class="text-right" colspan="4">Grand Total</th>	
											<th class="text-right" id="gtotal"><?php if(!empty($invoice)) echo ($invoice->grant_total);?>
											</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7">
								<div class="form-group">
									<label for="remarks" class="control-label">Remarks</label>
									<input type="hidden" name="sub_totals" value="<?php if(!empty($invoice)){ echo ($invoice->sub_total); } ?>">
									<input type="hidden" name="tax_rate" value="18">
									<input type="hidden" name="tax" id="tax" value="<?php echo $tax_details;?>">
									<input type="hidden" name="total_amount" value="<?php if(!empty($invoice)) echo ($invoice->grant_total);?>">
									<textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control form no-resize summernote"><?php if(!empty($invoice)) echo ($invoice->remarks);?></textarea>
								</div>
							</div>
						</div>
				</div>
				<div class="card-footer mt-3">
						<button class="btn btn-flat btn-sm btn-primary" type="submit">Save</button>
						<a class="btn btn-flat btn-sm btn-default" href="javascript:void();">Cancel</a>
				</div>
					</form>
			</div>
		</div>
		</div>
		</section>
		<script type="text/javascript">
		
		  $(document).ready(function(){
		  	$('#name').change(function(){ 
	      $('#cust_type').html($('option:selected',this).attr('data-customer-type'));
        $('#comp_name').html($('option:selected',this).attr('data-company-name'));
        $('#gst_num').html($('option:selected',this).attr('data-gstn'));
        $('#email').val($('option:selected',this).attr('data-customer-email'));   
	      }); 

	      $('#type').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/Items/get_catgegory');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	                  $('#category_id').html(data);
	              }
	          });
	          return false;
	      }); 
	      
	      
	      $('#form_id').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/Items/get_unit');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	                  $('#unit').html(data);
	              }
	          });
	          return false;
	      }); 

	      $('#category_id').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/Items/get_items');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	                  $('#form_id').html(data);
	              }
	          });
	          return false;
	      });
	      
	      $('#company').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/invoice/get_account');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	              	// alert(data);
	                  $('#account_full').html(data);
	              }
	          });
	          return false;
	      });
	      
	      
	      $('#company').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/master/get_invoice');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	              	// alert(data);
	                  $('#invoice_number').val(data);
	              }
	          });
	          return false;
	      });
	      
	      
	      $('#name').change(function(){ 
	          var id=$(this).val();
	          $.ajax({
	              url : "<?php echo site_url('admin/master/get_gst');?>",
	              method : "POST",
	              data : {id: id},
	              async : true,
	              dataType : 'json',
	              success: function(data){
	              	// alert(data);
	                  $('#gstin').html(data);
	              }
	          });
	          return false;
	      });
	      
		  });
		</script>
		
		<script>
			$(function(){
			    var dtToday = new Date();
			    var month = dtToday.getMonth() + 1;
			    var day = dtToday.getDate();
			    var year = dtToday.getFullYear();
			    if(month < 10)
			        month = '0' + month.toString();
			    if(day < 10)
			        day = '0' + day.toString();
			    var minDate= year + '-' + month + '-' + day;
			    $('#txtDate').attr('min', minDate);
			});
		</script>
		<script>
			$(function(){
			    var dtToday = new Date();
			    var month = dtToday.getMonth() + 1;
			    var day = dtToday.getDate();
			    var year = dtToday.getFullYear();
			    if(month < 10)
			        month = '0' + month.toString();
			    if(day < 10)
			        day = '0' + day.toString();
			    var minDate= year + '-' + month + '-' + day;
			    $('#due').attr('min', minDate);
			});
		</script>
		<script type="text/javascript">
		  function add_item($obj = null){
				var tr, td, item_id='', qty='', unit='', form_name, form_id='', price, total, description, category;
				var description = $('option:selected', '#unit').attr('dataid');
				if($obj == null){
					qty = $('#qty').val();
					unit = $('#unit').val();
					form_id = $('#form_id option:selected').text();
					cost = $('#form_id option:selected').attr('data-price');
					category = $('#category_id option:selected').text();
					total = parseFloat(cost) * parseFloat(qty);
				
				}else{
					qty = $obj.quantity;
					unit = $obj.unit;
					form_id = $obj.form_id;
					category = $obj.cat_name;
					cost = $('#form_id option:selected').attr('data-price');
					total = parseFloat(cost) * parseFloat(qty);
				}
				if($('#item-list tbody').find('[name="form_id[]"][value="'+form_id+'"]').length > 0){
					alert_toast('Item already on the list.','warning')
					end_loader();
					return false;
				}
				tr = $("<tr>")
					td = $("<td>")
					td.addClass('text-center')
					td.text(qty)
					td.append('<input type="hidden" name="qty[]" value="'+qty+'" />') 
					td.append('<input type="hidden" name="unit[]" value="'+unit+'" />')
					td.append('<input type="hidden" name="item_category[]" value="'+category+'" />')
					td.append('<input type="hidden" name="item_name[]" value="'+form_id+'" />')
					td.append('<input type="hidden" name="item_description[]" value="'+description+'" />')
					td.append("<input type='hidden' name='price[]' value='"+cost+"' />") 
			    td.append("<input type='hidden' name='total[]' value='"+total+"' />") 
			    // td.append("<input type='hidden' name='sub_total[]' value='"+total_amount+"' />") 
					tr.append(td)
					td = $("<td>")
					td.addClass('text-center')
					td.text(unit)
					tr.append(td)
					td = $("<td>")
					td.html("<p class='m-0'><small><b>Name: </b>"+form_id+"</small></p>"+
							"<div class='m-0'><small><b>Description: </b>"+description+"</small></div>");
					tr.append(td)
				  td = $("<td>")
					td.addClass('text-right')
					td.text(parseFloat(cost).toLocaleString('en-US'))
					tr.append(td)
				  td = $('<td class="price_sub" data-rate="'+total+'">')
					td.addClass('text-right')
					td.text(parseFloat(total).toLocaleString('en-US'))
					tr.append(td)
					td = $("<td>")
					td.addClass('text-center')
					td.append("<button class='btn btn-sm btn-outline-danger' type='button' onclick='rem_item($(this))'><i class='fa fa-trash'></i></button>")
					tr.append(td)
				  $('#item-list tbody').append(tr);
		      catculate_total();
				if($obj == null)
				end_loader();
			}

			function rem_item(_this){
				_this.closest('tr').remove();
				catculate_total();
			}
		</script>
		<script type="text/javascript">
			function catculate_total()
			{
				let total=0;
				$('.price_sub').each(function(){
					total +=parseFloat($(this).attr('data-rate'));
				});
				let tax = ((total*18)/100);
				let gtotal = tax+total;
				$('#sub_total').text(parseFloat(total).toLocaleString('en-US'))
				$('[name="sub_totals"]').val(total);
				$('#tax').text(parseFloat(tax).toLocaleString('en-US'));
				$('[name="tax"]').val(tax);
				$('#gtotal').text(parseFloat(gtotal).toLocaleString('en-US'));
				$('[name="total_amount"]').val(gtotal);
			}
		</script>
		<script> 
			$(document).ready(function(){
				$('#product-form').submit(function(e){
					e.preventDefault();
		      var _this = $(this)
					$('.err-msg').remove();
					start_loader();
					$.ajax({
						url:"<?php echo base_url('admin/invoice/sav_invoice');?>",
						data: new FormData($(this)[0]),
		                cache: false,
		                contentType: false,
		                processData: false,
		                method: 'POST',
		                type: 'POST',
		                dataType: 'json',
						error:err=>{
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
		                        
							}
						}
					})
				})
		        
			})
		</script> 
		       