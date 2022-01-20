<!-- <input type="radio" name="manual" id="manual" onchange="show2()" value="option1" checked>Manual
<input type="radio" name="manual" id="auto" onchange="show(this.value)" value="option2">Auto -->
<div class="container-fluid" id="sh2">
    <form action="<?php echo base_url('admin/master/save')?>" method="post" id="product-form">
<div class="row">
    <div class="col-md-6">
		<div class="form-group">
			<label for="prefix_name" class="control-label">Prefix Name</label>
			<input name="prefix_name" id="prefix_name" class="form-control form text-left" value="<?php echo !empty($invoice)?$invoice->prefix_name:''; ?>" placeholder="Enter Prefix  Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($invoice)?$invoice->id:''; ?>">
		</div>
	
    </div>
    <div class="col-md-6">
      	<div class="form-group">
			<label for="next_number" class="control-label">Next Number</label>
			<input type="number" min='0' name="next_number" id="next_number" class="form-control form text-left" value="<?php echo !empty($invoice)?$invoice->next_number:''; ?>" placeholder="Enter Next value"/>
		</div>
    </div>
</div>
</form>  
</div>

<!-- <div class="container-fluid" style="display: none;" id="sh1">
	<form action="<?php echo base_url('admin/master/save_invo')?>" method="post" id="product-form">
		<div class="form-group">
			<label for="prefix_name" class="control-label">Prefix Name</label>
			<input name="prefix_name" id="name" class="form-control form text-left" value="<?php echo !empty($invoice)?$invoice->prefix_name:''; ?>" placeholder="Enter Prefix  Name"/>
			<input type="hidden" name="edit_id" value="<?php echo !empty($invoice)?$invoice->id:''; ?>">
		</div>
		<div class="form-group">
			<label for="next_number" class="control-label">Next Number</label>
			<input name="next_number" id="number" class="form-control form text-left" value="<?php echo !empty($invoice)?$invoice->next_number:''; ?>" placeholder="Enter Next value"/>
		</div>
		<button type="button" class="btn btn-primary" onClick="randomString();">Generate Invoice Number</button>
	</form>
</div> -->
<script>
  
	$(document).ready(function(){
		$('#product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:"<?php echo base_url('admin/master/save_invoice');?>",
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
	
	$("#next_number").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
	
	
	
	
	
</script> 
<script>
function randomString() {
	var characters = "INC";
	var character = "INC";
	var lenString = 3;
	var len=4
	var random='';
	var randomstring = '';
	for (var i=0; i<len; i++) {
		var rnum = Math.floor(Math.random() * character.length);
		random += characters.substring(rnum, rnum+1);
	}
	for (var i=0; i<lenString; i++) {
		var rnum = Math.floor(Math.random() * characters.length);
		randomstring += characters.substring(rnum, rnum+1);
	}
	
	console.log(randomstring);
	$('#name').val(random);
	$('#number').val(randomstring);

	// console.log(randomstring);
	//document.getElementById("invoice_number").innerHTML = randomstring;
}
</script>
<script type="text/javascript">
    function show(str){
        document.getElementById('sh2').style.display = 'none';
        document.getElementById('sh1').style.display = 'block';
     }
    function show2(sign){
        document.getElementById('sh2').style.display = 'block';
        document.getElementById('sh1').style.display = 'none';
     }
   </script>



