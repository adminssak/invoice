<div class="container-fluid">
	<form method="post" id="product-form">
		<div class="form-group">
			<label for="ammount_paid" class="control-label">Amount Paid</label>
			<input name="ammount_paid" id="ammount_paid" class="form-control form text-left"  type="number" min="1" placeholder="Enter Paid Ammount"/>
			<input type="hidden" id="edit_id" name="edit_id" value="<?php echo !empty($invoice)?$invoice->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="grant_total" class="control-label">Total Amount</label>
			<input name="grant_total" id="grant_total" class="form-control form text-left" value="<?php echo !empty($invoice)?$invoice->grant_total:''; ?>" type="number" min="1" />
		</div>
		<div class="form-group">
			<label for="due_ammount" class="control-label">Due Amount</label>
			<input name="due" type="number" min="1" id="due" class="form-control form text-left" value="" />
		</div>
		<div class="form-group">
			<label for="due_dates" class="control-label">Next Due Date</label>
			<input name="due_date" type="date" min="1" id="due_date" class="form-control form text-left" value="" />
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
			var ammount_paid = $("#ammount_paid").val();
            var grant_total = $("#grant_total").val();
            var due_ammount = $("#due_ammount").val();
			$.ajax({
				url:"<?php echo base_url('admin/invoice/due_invoice');?>",
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

<script>
    $("#ammount_paid").keyup(function(){
        $("#due").html('');
        var n1 = $("#ammount_paid").val();
        var n2 = $("#grant_total").val();
        var ans = n2 - n1;
        // $("#due").attr(ans);
        $("#due").val(ans);
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
			    $('#due_dates').attr('min', minDate);
			});
		</script>
