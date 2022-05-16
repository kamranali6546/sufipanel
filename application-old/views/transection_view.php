<title>UK New Transaction</title>
<style>
    .bdrBtm {
        border-bottom: 3px solid #b9b8b8;
    }
    .bdrBtm a{
        color: #0a7ff7;
        font-size: 15px;
    }
    .formInlineFlex .row .col-md-3, .formInlineFlex .row .col-md-6, .formInlineFlex .row .col-md-12 {
        display: inline-flex;
    }
    .formInlineFlex .row .col-md-3 label, .formInlineFlex .row .col-md-6 label, .formInlineFlex .row .col-md-12  label {
        width: 160px;
        position: relative;
        top: 10px;
    }
    .inner-addon { position: relative; }  
    .inner-addon .glyphicon { 
        position: absolute; 
        padding: 10px; 
        pointer-events: none;  
        z-index: 99;
        background: none;
        border: 0px;
        top: -2px;
        cursor: text;
        font-size: 17px;  
    }  
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;} 
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; cursor: pointer !important; } 
    .vertical-align-bottom { vertical-align: bottom !important; }
    .input-group {margin-bottom: 0px;}
    .table-drcr label {
        font-size: 10px !important;
    }
    .input-group input { width: 135px !important; }
    #debitEntryTransection .row, #crEntryTransection .row {
        margin-bottom: 10px;
    }
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
          <h3>UK New Transaction</h3>
        </div>
        <div class="title_right">
           
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row table-drcr ">
        <div class="col-md-9">
            <form  class="" method="post" id="transectionForm" >
            <div class="row">
                <div class="col-md-12">
<!--                    <form action="" class="form-inline">-->
                        <label for="">Transaction Date: &nbsp;</label> 
                        <div class="input-group"> 
                            <div class="inner-addon right-addon">
                                <!-- <i class="glyphicon glyphicon-calendar"></i> -->
                                <input type="text" class="form-control nextDueDate" readonly="" value="<?php echo date('Y-m-d'); ?>" name="transectionDate" id="TransactionDate"> 
                            </div>
                        </div> 
                    <!--</form>-->
                </div>
            </div> <br>
                <div class="row bdrBtm">
                    <div class="col-md-8">
                        <!--<a href="javascript:void(0);" >(+) Add One More Debit Entry</a>-->
                        <a href="javascript:void(0);" onclick="addDebit()">(+) Add One More Debit Entry</a>
                    </div>
                    <div class="col-md-4">
                        <a href="javascript:void(0);" onclick="decrementDebit()">(-) Remove Last Debit Entry</a>
                        <!--<a href="javascript:void(0);" >(-) Remove Last Debit Entry</a>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%;margin-top: 10px;">
                            <tbody>
                                <tr>
                                    <td>
                                            <input type="hidden" id="drCount" value="1">
                                            <div id="debitEntryTransection">
                                                <div class="row" id="dr1">
                                                    <div class="col-md-6"> 
                                                        <?php //print_r($supplierData); ?>
                                                        <label for="">To (Dr.): &nbsp;</label>
                                                        <select name="dr_pay_to[]"  class="form-control"> 
                                                           <option value="">--Select One--</option>
                                                            <?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ ?>
                                                            <option value="<?php echo $supplierObjDr->supplier_name.'-supplier'; ?>"><?php echo $supplierObjDr->supplier_name.'  -  '. idToName('bank','id',$supplierObjDr->BankId,'bank_name'); ?></option>
                                                            <?php } } ?>
                                                            <?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
                                                            <option value="<?php echo $bankObj->bank_name.'-bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
                                                            <?php } } ?>
                                                            <?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
                                                            <option value="<?php echo $expObj->expense_name.'-expense'; ?>"><?php echo $expObj->expense_name; ?></option>
                                                            <?php } } ?>
                                                             <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj){ ?>
                                                            <option value="<?php echo $imcomeObj->head_name.'-income'; ?>"><?php echo $imcomeObj->head_name; ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <label for="">Amount (&pound;): &nbsp;</label>
                                                        <input type="text" name="dr_amount[]" onblur="drTotalCount(this.value,'genTrsnDrSum')"   class="form-control"> 
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                                                        <input type="text" name="dr_booking_ref[]"  class="form-control"> 
                                                    </div>
                                                </div> 
                                            </div>
<!--                                        </form>-->
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <!--<form action="" class="formInlineFlex">-->
                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-6"> 
                                                    <label for="">Dr. Total &nbsp;</label>
                                                    <label for="" class="text-right" id="genTrsnDrSum">0</label> 
                                                </div> 
                                            </div> 
                                        <!--</form>-->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> <br>
                <div class="row bdrBtm">
                    <div class="col-md-8">
                        <!--<a href="javascript:void(0);" >(+) Add One More Credit Entry</a>-->
                        <a href="javascript:void(0);" onclick="addCredit()">(+) Add One More Credit Entry</a>
                    </div>
                    <div class="col-md-4">
                        <!--<a href="javascript:void(0);" >(-) Remove Last Credit Entry</a>-->
                        <a href="javascript:void(0);" onclick="decrementCredit()">(-) Remove Last Credit Entry</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%;margin-top: 10px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <!--<form action="" class="formInlineFlex">-->
                                            <input type="hidden" id="crCount" value="1">
                                            <div id="crEntryTransection">
                                                <div class="row" id="cr1">
                                                    <div class="col-md-6"> 
                                                        <label for="">By (Cr.): &nbsp;</label>
                                                        <select name="cr_pay_by[]" class="form-control">
                                                            <option value="">--Select One--</option>
                                                            <?php if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ ?>
                                                            <option value="<?php echo $supplierObjDr->supplier_name.'-supplier'; ?>"><?php echo $supplierObjDr->supplier_name.'  -  '. idToName('bank','id',$supplierObjDr->BankId,'bank_name'); ?></option>
                                                            <?php } } ?>
                                                            <?php if(!empty($BankData)){ foreach ($BankData as $bankObj){ ?>
                                                            <option value="<?php echo $bankObj->bank_name.'-bank'; ?>"><?php echo $bankObj->bank_name; ?></option>
                                                            <?php } } ?>
                                                            <?php if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ ?>
                                                            <option value="<?php echo $expObj->expense_name.'-expense'; ?>"><?php echo $expObj->expense_name; ?></option>
                                                            <?php } } ?>
                                                             <?php if(!empty($IncomData)){ foreach($IncomData as $imcomeObj2){ ?>
                                                            <option value="<?php echo $imcomeObj2->head_name.'-income'; ?>"><?php echo $imcomeObj2->head_name; ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <label for="">Amount (&pound;): &nbsp;</label>
                                                        <input type="text" name="cr_amount[]"  onblur="crTotalCount(this.value,'genTrnsCrSum')" class="form-control"> 
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                                                        <input type="text" name="cr_booking_ref[]"  class="form-control"> 
                                                    </div>
                                                </div> 
                                            </div>
                                        <!--</form>-->
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <!--<form action="" class="formInlineFlex">-->
                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-6"> 
                                                    <label for="">Cr. Total &nbsp;</label>
                                                    <label for="" class="text-right" id="genTrnsCrSum">0</label>
                                                </div> 
                                            </div> 
                                        <!--</form>-->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><br>
                <div class="row">
                    <table style="width: 100%;margin-top: 0px;">
                        <tr>
                            <td>
                                <!--<form action="" class="formInlineFlex">-->
                                    <div class="row">  
                                        <div class="col-md-12"> 
                                            <label for="" style="width: 120px;">Description: &nbsp;</label>
                                            <input type="text" name="tr_description" id="description" class="form-control"> 
                                        </div>
                                    </div> <br>
                                    <div class="row">  
                                        <div class="col-md-6"> 
                                            <label for="">Card No: &nbsp;</label>
                                            <input type="text" name="card_number" id="cardNumnerAtPaymentAdd"  class="form-control"> 
                                        </div>
                                        <div class="col-md-6"> 
                                            <label for="">Next Due Date: &nbsp;</label>
                                            <input type="text" name="next_due_Date" readonly="" id="nextDueDate"  class="form-control nextDueDate"> 
                                        </div>
                                    </div> 
                                <!--</form>-->
                            </td>
                        </tr>
                    </table> 
                </div> <br><br>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <button type="submit" class="btn btn-primary btn-round" >Save</button> 
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-danger btn-round">Cancel</button>
                    </div>
                </div>
             </form>
        </div>
    </div>               
</div>
<script>
    function addDebit()
    {
        
        var countDr =parseInt($('#drCount').val());
        countDr=countDr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'dr-more-transection-html',
            data:{countDr:countDr},
            cache:false,
            async: false,
            success:function(response)
            {
                 hideLoder();
                 $('#debitEntryTransection').append(response);
                $('#drCount').val(countDr);
            }
        });
       
    }
    function decrementDebit()
    {
        var countDr=parseInt($('#drCount').val()); 
        if(parseInt(countDr)==1)
        {
            
        }
        else
        {
            $('#dr'+countDr).remove();
            countDr=parseInt(countDr)-1;
            $('#drCount').val(countDr);
        }
    }
    function  addCredit()
    {
//        alert('Under Developed');
        var countCr =parseInt($('#crCount').val());
        countCr=countCr+1;
        showLoder();
        $.ajax({
            type:'post',
            url:ajaxUrl+'cr-more-transection-html',
            data:{countCr:countCr},
            cache:false,
            async: false,
            success:function(responseCr)
            {
                 hideLoder();
                 $('#crEntryTransection').append(responseCr);
                 $('#crCount').val(countCr);
            }
        });
       
    }
    function decrementCredit()
    {
//        alert('Under Developed');
        var countCr=parseInt($('#crCount').val()); 
//        alert(countCr);
        if(parseInt(countCr)==1)
        {
            
        }
        else
        {
            $('#cr'+countCr).remove();
            countCr=parseInt(countCr)-1;
            $('#crCount').val(countCr);
        }
    }
//    function transectionMake()
//    {
//        $('#transectionForm').attr('action','<?php echo base_url() ?>Transection/makeTransection');
//        $('#transectionForm').submit();
//    }
    $("#transectionForm").on('submit',(function(e) {
         e.preventDefault();
         $.ajax({
        	url: ajaxUrl+'Transection/makeTransection',
                type: "POST",
		data:  new FormData(this),
		contentType: false,
                processData:false,
		success: function(data)
		    {
                        if(data>0)
                        {
                          alertify.success('Payment Added Successfully');
                          hideLoder();
                            location.reload();
                            setInterval(function() {$("#body-overlay").hide(); },500);
                             }
                             else
                             {
                                 alertify.error('Network Error Occer Please Try again!');
                                 hideLoder();
//                                 $('#supplierPatModal').modal('hide');
                             }
			},
		  	error: function() 
                        {
                            hideLoder();
                        } 	        
	   });
     }));
</script>