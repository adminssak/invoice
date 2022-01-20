<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}

body {
  overflow-x: hidden; /* Hide vertical scrollbar */

}

</style>
   
     <div class="container">
    <div class="row">
        <div class="col-md-12" style="width: 100%;">
            <div class="panel panel-default">
                 <?php 
                     $account_details = $this->db->get_where('tbl_account',['id'=> $invoice->account])->row();
                     $company_details=$this->db->get_where('tbl_company',['id'=>$account_details->id])->row();
                    ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-8">
            <div class="invoice-title">
                <h2><img src="<?php echo base_url().'uploads/membership/'. $company_details->image;?>" style="height: 80px; width: 130px;"></h2>
            </div>
        </div>
        <div class="col-xs-4" style="margin-top: 20px;">
            <div class="invoice-title">
                <p class="gst-address"><?php echo $company_details->address;?><br> GSTIN No :- <?php echo $company_details->gstin_number;?></p>
            </div>
        </div>
      </div>
            <div class="row">
                <div class="col-xs-8">
                    <address>
                        <?php  
                         $data = $this->db->get_where('tbl_state',['id'=>$invoice->place_of_supply])->row();
                        ?>
                        <strong>Bill To - </strong><br>
                        Party Name: <?php echo $invoice->customer_name;?><br>
                        Address: <?php echo $data->state;?><br>
                        GSTN: <?php echo $invoice->gstin;?>
                    </address>
                </div>
                <div class="col-xs-4">
                    <address class="addddggeg">
                        <strong>Balance Due - Rs. <?php echo $invoice->grant_total;?><strong><br>
                        <strong>Order No: - <?php echo $invoice->order_number;?></strong><br>
                        <strong>Invoice No: - <?php echo $invoice->invoice_number;?></strong><br>
                        <strong>Due Date: - <?php echo $invoice->due_date;?></strong><br>
                        <br>
                    </address>
            </div>
        </div>
    </div>
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Invoice Summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $qty=array();
                                if(!empty($invoice)){
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
                                <?php 
                                    if(!empty($qty )){
                                    foreach($qty as $key=> $row){
                                ?>
                                <tr>
                                    <td><?php echo $item_name[$key]; ?></td>
                                    <td class="text-center"><?php echo $row; ?></td>
                                    <td class="text-center">Rs. <?php echo $price[$key]; ?></td>
                                    <td class="text-right">Rs. <?php echo $total[$key]; ?></td>
                                </tr>
                            <?php } }?>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Sub-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $invoice->sub_total;?></td>
                                </tr>
                                <?php 
                                   $cgst= ($invoice->sub_total*9)/100;
                                   $sgst= ($invoice->sub_total*9)/100;
                                   $gst = $cgst+$sgst;
                                ?>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>CGST (9%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $cgst;?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>SGST (9%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $sgst;?></td>
                                </tr>
                                 <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total GST (18%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $gst;?></td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Grand-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $invoice->grant_total;?></td>
                                </tr>
                                <tr >
                                    <td style="margin-top:40px;">Notes</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $invoice->customer_notes;?><br><br><br>
                                    Name in the Account:- <?php echo $account_details->name_in_account;?><br>
                                    Account Number:- <?php echo $account_details->account_number;?><br>
                                    IFSC Code:- <?php echo $account_details->ifsc_code;?><br>
                                    Bank Name:- <?php echo $account_details->bank_name;?><br>
                                    Branch Name:- <?php echo $account_details->branch_name;?><br><br><br>
                                    Terms & Conditions -<br>
                                    <?php echo $invoice->terms_condition;?>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right"><img src="<?php echo base_url();?>assets/sharda.png"> <br>Signature</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
        </div>
  <!-- Next Invoice -->
  
     <div class="container">
    <div class="row">
        <div class="col-md-12" style="width: 100%;">
          <div class="panel panel-default">
           <?php
             $i=1;
           if(!empty($invoicelist)){
           foreach($invoicelist as $invoice)
           {
           ?>
            <div class="container">
              <div class="row">
                <div class="col-xs-8">
                    <div class="invoice-title">
                        <h2><img src="<?php echo base_url().'uploads/membership/'. $company_details->image;?>" style="height: 80px; width: 130px;"></h2>
                    </div>
                </div>
                <div class="col-xs-4" style="margin-top: 20px;">
                    <div class="invoice-title">
                        <p class="gst-address"><?php echo $company_details->address;?><br> GSTIN No :- <?php echo $company_details->gstin_number;?></p>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-8">
                    <address>
                        <?php  
                          $maindata =    $this->db->get_where('tbl_invoice',['id'=>$invoice->user_id])->row();
                         $data = $this->db->get_where('tbl_state',['id'=>$maindata->place_of_supply])->row();
                        ?>
                        <strong>Bill To - </strong><br>
                        Party Name: <?php echo $maindata->customer_name;?><br>
                        Address: <?php echo $data->state;?><br>
                        GSTN: <?php echo $maindata->gstin;?>
                    </address>
                </div>
                <div class="col-xs-4 address-ss">
                    <address class="addddggeg">
                        <strong>Balance Due - Rs. <?php echo $invoice->grant_total;?><strong><br>
                        <strong>Order No: - <?php echo $maindata->order_number;?> (<?php echo $i++;?>)</strong><br>
                        <strong>Invoice No: - <?php echo $maindata->invoice_number;?></strong><br>
                        <strong>Paid Date: - <?php echo $invoice->paid_date;?></strong><br>
                        <strong>Due Date: - <?php echo $invoice->due_dates;?></strong><br>
                        <br>
                    </address>
                </div>
              </div>
    </div>
     <div class="row">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Invoice Summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $qty=array();
                                if(!empty($maindata)){
                                    $item_data=json_decode($maindata->items);
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
                                <?php 
                                    if(!empty($qty )){
                                    foreach($qty as $key=> $row){
                                ?>
                                <tr>
                                    <td><?php echo $item_name[$key]; ?></td>
                                    <td class="text-center"><?php echo $row; ?></td>
                                    <td class="text-center">Rs. <?php echo $price[$key]; ?></td>
                                    <td class="text-right">Rs. <?php echo $total[$key]; ?></td>
                                </tr>
                            <?php } }?>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Sub-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $maindata->sub_total;?></td>
                                </tr>
                                <?php 
                                   $cgst= ($maindata->sub_total*9)/100;
                                   $sgst= ($maindata->sub_total*9)/100;
                                   $gst = $cgst+$sgst;
                                ?>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>CGST (9%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $cgst;?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>SGST (9%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $sgst;?></td>
                                </tr>
                                 <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total GST (18%)</strong></td>
                                    <td class="no-line text-right">Rs. <?php echo $gst;?></td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Grand-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $maindata->grant_total;?></td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Paid-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $invoice->ammount_paid;?></td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Due-Total</strong></td>
                                    <td class="thick-line text-right">Rs. <?php echo $invoice->due;?></td>
                                </tr>
                                <tr >
                                    <td style="margin-top:40px;">Notes</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $maindata->customer_notes;?><br><br><br>
                                       
                                    Name in the Account:- <?php echo $account_details->name_in_account;?><br>
                                    Account Number:- <?php echo $account_details->account_number;?><br>
                                    IFSC Code:- <?php echo $account_details->ifsc_code;?><br>
                                    Bank Name:- <?php echo $account_details->bank_name;?><br>
                                    Branch Name:- <?php echo $account_details->branch_name;?><br><br><br>
                                    Terms & Conditions -<br>
                                    <?php echo $maindata->terms_condition;?>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right"><img src="<?php echo base_url();?>assets/care.png"> <br>Signature</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 </div>
            </div>
          </div>
        </div>
  </div>
        <?php
          }
         }
      ?>