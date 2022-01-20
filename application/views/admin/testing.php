<!DOCTYPE html>
<html>
    <head>
        <style>
        table {
        border-collapse: collapse;
        }
        </style>
    </head>
    <body>

        <table style="width:100%; border:none;" >
            <!--   <tr>
                <th>Firstname</th>
                <th>La
                stname</th>
                <th>Age</th>
            </tr> -->
              <?php 
                 $account_details = $this->db->get_where('tbl_account',['id'=> $invoice->account])->row();
                //   print_r($account_details->id);
                //  die();
                 $company_details=$this->db->get_where('tbl_company',['id'=>$account_details->company_name])->row();
                 $customer_details=$this->db->get_where('tbl_customer',['firstname'=>$invoice->customer_name])->row();
                  
                ?>
            <tbody>
                <tr>
                    <td colspan="7">
                        <!--<p style="margin-left: 15px;"> <img src="<?php // echo base_url().'uploads/membership/'. $company_details->image;?>" width="150px" height="150px"> </p>-->
                        <p style="margin:0px;"> <img src="https://pragatisoulutions.com/invoice/assets/logo_invoice.png" height="100px"> </p>
                     <p style="float: right;margin:6px;">
                      <p style="margin-right: 15px;font-size: 20px;margin:0px;padding-left:15px;">
                        <span><?php echo $company_details->address;?><br> GSTIN No :- <?php echo $company_details->gstin_number;?></span> 
                      </p>
                    </p>
                    </td>
                   
                     <td>
                         <h2 style="margin:0px;font-size:40px;text-transform: uppercase;">Invoice</h2>
                          <p style="display:flex;margin: 0;font-size:20px;font-weight: 600;"><strong># </strong> <?php echo $invoice->invoice_number;?></p>
                     </td>
                   
                    </tr>
                    <tr>
                        <td colspan="7">
                            <?php  
                             $data = $this->db->get_where('tbl_state',['id'=>$invoice->place_of_supply])->row();
                            ?>
                            <p style="margin-left: 15px;font-size: 16px;"><strong style="font-size:20px;">Bill To - </strong><br>
                            <span style="marging-left:20px;"><strong>Party Name: </strong><?php echo $customer_details->customer_display_name;?> (On Invoice)</span><br>
                            <span><strong>Address: </strong></span><span style="marging-left:20px;"><?php echo $data->state;?></span><br>
                            <span><strong>GSTN: <strong></span><span style="marging-left:20px;"><?php echo $invoice->gstin;?></span></p>
                        </td>
                        
                        <td style="float: right;">
                         <span style="font-size: 16px;">
                            
                          <p style="display:flex;margin: 0;"><strong>Balance Due - Rs.</strong> <?php echo $invoice->grant_total;?></p>
                        <p style="display:flex;margin: 0;"><strong>Order No: - </strong><?php echo $invoice->order_number;?></p>
                       
                        <p style="display:flex;margin: 0;"><strong>Due Date: -</strong> <?php echo $invoice->due_date;?></p>    
                         </span>
                        </td>
                    </tr>
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
                    <tr>
                        <td colspan="7">
                            <p style="margin-left: 15px;font-size: 19px;"><strong>Invoice Summary</strong></p>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;background-color: #000;color: #fff;-webkit-print-color-adjust: exact;">
                        <th style="width:3.333%;">S.N.</th>
                        <th style="width:30%;">Item & Description</th>
                        <th style="width:11.1111%;">HSN/SAC</th>
                         <th style="width:11.1111%;">Unit</th>
                          <th style="width:11.1111%;">Quantity</th>
                          <th style="width:11.1111%;">GST </th>
                        <th style="width:11.1111%;text-align: right;">Rate</th>
                        <th style="width:11.1111%; text-align: right;padding-right:10px;">Amount</th>
                    </tr>
                    <?php 
                        $i=1;
                        if(!empty($qty )){
                        foreach($qty as $key=> $row){
                    ?>
                    <tr style="border-bottom: 1px solid black;">
                        <td style="width:3.333%;"><?php echo $i++;?></td>
                        <td style="width:30%;padding-left: 15px;"><?php echo $item_name[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"><?php echo $row; ?></td>
                        <td style="width:11.1111%; text-align: center;">Rs. <?php echo $price[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: right;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: right;"> Rs. <?php echo $total[$key]; ?></td>
                    </tr>
                    <?php } }?>
                    <tr>
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Sub-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $invoice->sub_total;?></td>
                   </tr>
                     <?php 
                       $cgst= ($invoice->sub_total*9)/100;
                       $sgst= ($invoice->sub_total*9)/100;
                       $gst = $cgst+$sgst;
                    ?>
                   <tr>
                     
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>CGST (9%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $cgst;?></td>
                   </tr>
                   <tr>
                          
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>SGST (9%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $sgst;?></td>
                   </tr>
                   <tr  style="border-bottom: 1px solid black;">
                    
                    <td style="text-align: right;padding: 6px;" colspan="7"><strong>Total GST (18%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $gst;?></td>
                   </tr>
                   <?php 
                    if(!empty($invoicelist)){
                   ?>
                   <tr style="border-bottom: 1px solid black;">
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Grand-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;"><strong> Rs. <?php echo $invoicelist[0]->grant_total;?></strong></td>
                   </tr>
                   <?php } else {?>
                    <tr style="border-bottom: 1px solid black;">
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Grand-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;"><strong> Rs. <?php echo $invoice->grant_total;?></strong></td>
                   </tr>
                   <?php } ?>
                   <!-- checkit -->
                   <tr>
                       
                       <td colspan="8" style="padding-top:15px;">
                           <h6 style="margin: 0; padding-left: 15px;font-size: 17px;">Notes</h6>
                           <p style="margin: 0; padding-left: 15px;font-size: 16px;"><?php echo $invoice->customer_notes;?>.Another common use of the non-breaking space is to prevent browsers from truncating spaces in HTML pages.</p>
                       </td>
                      
                   </tr>
                   <tr>
                    <td colspan="7">
                     <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span> <strong>Name in the Account:- </strong></span><span><?php echo $account_details->name_in_account;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Account Number:-</strong> </span><span><?php echo $account_details->account_number;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>IFSC Code:-</strong>  </span><span><?php echo $account_details->ifsc_code;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Bank Name:- </strong> </span><span><?php echo $account_details->bank_name;?></span></p>   
                       <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Branch Name:- </strong></span><span><?php echo $account_details->branch_name;?></span></p> 
                       
                         </td> 
                   
                   
                       <td style="float: right;">
                         <p style="padding-right: 15px;"> <img src="<?php echo base_url();?>assets/sharda.png" width="100%" height="150px"> </p>
                         </td>
                      </tr>
                       <tr style="padding:20px;">
                    <td colspan="7">
                        <p style="display: flex; padding-left:10px;padding-right: 100px;"><span><strong>Terms & Conditions -</strong></span><spna style="padding-left:15px;"><?php echo $invoice->terms_condition;?>.Another common use of the non-breaking space is to prevent browsers from truncating spaces in HTML pages.</spna></p>
                    </td> 
                     
                    <td style="float: right;padding-right: 50px;font-size: 18px;">
                      <strong>Signature</strong>
                         </td>
                    </tr>
                </tbody>
            </table>

        </body>
    </html>
    <br>
    <?php
     $i=1;
   if(!empty($invoicelist)){
   foreach($invoicelist as $invoices)
   {
    //   print_r($invoice);
    //   die();
   ?>
   <!DOCTYPE html>
<html>
    <head>
        <style>
        table {
        border-collapse: collapse;
        }
        </style>
    </head>
    <body>
    
        <table style="width:100%; border:none;" >
            <!--   <tr>
                <th>Firstname</th>
                <th>La
                stname</th>
                <th>Age</th>
            </tr> -->
              <?php 
                 $account_details = $this->db->get_where('tbl_account',['id'=> $invoice->account])->row();
                //   print_r($account_details->id);
                //  die();
                 $company_details=$this->db->get_where('tbl_company',['id'=>$account_details->company_name])->row();
                //   print_r($company_details);
                //  die();
                ?>
            <tbody>
                <tr>
                    <td colspan="7">
                        <!--<p style="margin-left: 15px;"> <img src="<?php // echo base_url().'uploads/membership/'. $company_details->image;?>" width="150px" height="150px"> </p>-->
                        <p style="margin:0px;"> <img src="https://pragatisoulutions.com/invoice/assets/logo_invoice.png" height="100px"> </p>
                     <p style="float: right;margin:6px;">
                      <p style="margin-right: 15px;font-size: 20px;margin:0px;padding-left:15px;">
                        <span><?php echo $company_details->address;?><br> GSTIN No :- <?php echo $company_details->gstin_number;?></span> 
                      </p>
                    </p>
                    </td>
                     <td>
                         <h2 style="margin:0px;font-size:40px;text-transform: uppercase;">Invoice</h2>
                          <p style="display:flex;margin: 0;font-size:20px;font-weight: 600;"><strong># </strong> <?php echo $invoice->invoice_number;?></p>
                     </td>
                   
                    </tr>
                    <tr>
                        <td colspan="7">
                            <?php  
                             $data = $this->db->get_where('tbl_state',['id'=>$invoice->place_of_supply])->row();
                            ?>
                            <p style="margin-left: 15px;font-size: 16px;"><strong style="font-size:20px;">Bill To - </strong><br>
                           <span style="marging-left:20px;"><strong>Party Name: </strong><?php echo $customer_details->customer_display_name;?> (On Invoice)</span><br>
                            <span><strong>Address: </strong></span><span style="marging-left:20px;"><?php echo $data->state;?></span><br>
                            <span><strong>GSTN: <strong></span><span style="marging-left:20px;"><?php echo $invoice->gstin;?></span></p>
                        </td>
                        <?php  
                          $maindata =    $this->db->get_where('tbl_invoice',['id'=>$invoices->user_id])->row();
                         $data = $this->db->get_where('tbl_state',['id'=>$maindata->place_of_supply])->row();
                        ?>
                        <td style="float: right;">
                         <span style="font-size: 16px;">
                          <p style="display:flex;margin: 0;"><strong>Balance Due - Rs.</strong> <?php echo $invoice->grant_total;?></p>
                        <p style="display:flex;margin: 0;"><strong>Order No: - </strong><?php echo $invoice->order_number;?></p>
                        <p style="display:flex;margin: 0;"><strong>Paid Date: - </strong><?php echo $invoices->paid_date;?></p>
                        <p style="display:flex;margin: 0;"><strong>Due Date: -</strong> <?php echo $invoice->due_date;?></p>    
                         </span>
                        </td>
                    </tr>
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
                    <tr>
                        <td colspan="7">
                            <p style="margin-left: 15px;font-size: 19px;"><strong>Invoice Summary</strong></p>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;background-color: #000;color: #fff;-webkit-print-color-adjust: exact;">
                        <th style="width:3.333%;">#</th>
                        <th style="width:30%;">Item & Description</th>
                        <th style="width:11.1111%;">HSN/SAC</th>
                         <th style="width:11.1111%;">Unit</th>
                          <th style="width:11.1111%;">Quantity</th>
                          <th style="width:11.1111%;">GST </th>
                        <th style="width:11.1111%;text-align: right;">Rate</th>
                        <th style="width:11.1111%; text-align: right;padding-right:10px;">Amount</th>
                    </tr>
                    <?php 
                        if(!empty($qty )){
                        foreach($qty as $key=> $row){
                    ?>
                    <tr style="border-bottom: 1px solid black;">
                        <td style="width:3.333%;">10</td>
                        <td style="width:30%;padding-left: 15px;"><?php echo $item_name[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"><?php echo $row; ?></td>
                        <td style="width:11.1111%; text-align: center;">Rs. <?php echo $price[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: center;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: right;"> Rs. <?php echo $total[$key]; ?></td>
                        <td style="width:11.1111%; text-align: right;"> Rs. <?php echo $total[$key]; ?></td>
                    </tr>
                    <?php } }?>
                    <tr>
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Sub-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $invoice->sub_total;?></td>
                   </tr>
                     <?php 
                       $cgst= ($invoice->sub_total*9)/100;
                       $sgst= ($invoice->sub_total*9)/100;
                       $gst = $cgst+$sgst;
                    ?>
                   <tr>
                     
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>CGST (9%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $cgst;?></td>
                   </tr>
                   <tr>
                          
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>SGST (9%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $sgst;?></td>
                   </tr>
                   <tr  style="border-bottom: 1px solid black;">
                    
                    <td style="text-align: right;padding: 6px;" colspan="7"><strong>Total GST (18%)</strong></td>
                    <td class="thick-line text-right" style="text-align: right;">Rs. <?php echo $gst;?></td>
                   </tr>
                   <tr style="border-bottom: 1px solid black;">
                          
                    
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Grand-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;"><strong> Rs. <?php echo $invoices->grant_total;?></strong></td>
                   </tr>
                   <tr style="border-bottom: 1px solid black;">
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Paid-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;"><strong> Rs. <?php echo $invoices->ammount_paid;?></strong></td>
                   </tr>
                    <tr style="border-bottom: 1px solid black;">
                    <td style="text-align: right;padding: 6px;"  colspan="7"><strong>Due-Total</strong></td>
                    <td class="thick-line text-right" style="text-align: right;"><strong> Rs. <?php echo $invoice->grant_total;?></strong></td>
                   </tr>
                   <!-- checkit -->
                   <tr>
                       
                       <td colspan="8" style="padding-top:15px;">
                           <h6 style="margin: 0; padding-left: 15px;font-size: 17px;">Notes</h6>
                           <p style="margin: 0; padding-left: 15px;font-size: 16px;"><?php echo $invoice->customer_notes;?>.Another common use of the non-breaking space is to prevent browsers from truncating spaces in HTML pages.</p>
                       </td>
                      
                   </tr>
                   <tr>
                    <td colspan="7">
                     <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span> <strong>Name in the Account:- </strong></span><span><?php echo $account_details->name_in_account;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Account Number:-</strong> </span><span><?php echo $account_details->account_number;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>IFSC Code:-</strong>  </span><span><?php echo $account_details->ifsc_code;?></span></p>   
                      <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Bank Name:- </strong> </span><span><?php echo $account_details->bank_name;?></span></p>   
                       <p style="padding-left: 15px; font-size: 16px;display: flex;margin: 0;"><span><strong>Branch Name:- </strong></span><span><?php echo $account_details->branch_name;?></span></p> 
                       
                         </td> 
                   
                   
                       <td style="float: right;">
                         <p style="padding-right: 15px;"> <img src="<?php echo base_url();?>assets/sharda.png" width="150px" height="150px"> </p>
                         </td>
                      </tr>
                       <tr style="padding:20px;">
                    <td colspan="7">
                        <p style="display: flex; padding-left:10px;padding-right: 100px;"><span><strong>Terms & Conditions -</strong></span><spna style="padding-left:15px;"><?php echo $invoice->terms_condition;?>.Another common use of the non-breaking space is to prevent browsers from truncating spaces in HTML pages.</spna></p>
                    </td> 
                     
                    <td style="float: right;padding-right: 50px;font-size: 18px;">
                      <strong>Signature</strong>
                         </td>
                    </tr>
                </tbody>
            </table>

        </body>
    </html>
    <?php } }?>