<style type="text/css">
	tbody tr td, tfoot tr td {
		border: 1px solid #d2d2d2;
	}
	tbody tr, tfoot tr {
		background: white;
	}
	.btnCT {
		padding: 5px 8px;
		/*border-radius: 0px;*/
    	margin-top: 7px;
	}
        .SHead {
            background: #2a3f54
        }
        .SHead th {
            color: white;
            font-size: 14px;
            padding-left: 10px;
        }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width: 100%;"> 
            <h3>Card Balance Status</h3> 
        </div>
        <div class="title_right">
            <!--<a class="btn btn-primary btn-round pull-right" href="#">Create Follow Up</a>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <form method="post" action="<?php echo site_url('CardBoxBalance'); ?>">
        <div class="well" style="background-color: #d2d2d2; border: 1px solid #636363;">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Start Date:</label>
                        <input type="text" name="startDate" id="startDate" class="form-control" placeholder="yyyy-mm-dd" />
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>End Date:</label>
                        <input type="text" name="endDate" id="endDate" class="form-control" placeholder="yyyy-mm-dd" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Brand:</label>
                        <select class="form-control" name="company">
                            <option value="">--- Select Brand ---</option>
                            <?php if(!empty($companyData)){ foreach($companyData as $compObj){ ?>
                            <option value="<?php echo $compObj->id; ?>"><?php echo $compObj->company_name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                </div> 
                <div class="col-md-4 col-sm-4 col-xs-4"> 
                    <label style="display: block;">&nbsp;</label>
                    <button type="submit" class="btn btn-primary" name="fliter"><i class="fa fa-search"></i> &nbsp;Search</button> 
                </div>
            </div>
        </div>
    </form>
    <div class="row">
    	<div class="col-md-12 table-responsive">
    		<table id="" class="display tablColor" width="100%" cellspacing="0">
                    <thead> 
                        <tr>
                            <th rowspan="2">Sr.#</th>
                            <th rowspan="2" style="min-width:100px;">Card Date</th>
                            <th rowspan="2" style="min-width: 90px;">File No</th>
                            <th rowspan="2">Amount</th>
                            <th rowspan="2">Expense</th>
                            <th rowspan="2">Claimable</th> 
                            <th rowspan="2" style="min-width: 80px;">£ Status</th>
                            <th colspan="3" class="text-center" style="border-bottom: 1px solid gray;">File Status</th> 
                            <th rowspan="2">Agent</th>
                            <th rowspan="2">Actions</th>
                        </tr> 
                        <tr>
                            <th>Pending</th>
                            <th>Issued</th>
                            <th>C.Cancelation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cardAmountTotal=0;
                        $cardExpensenseToatl=0;
                        $cardClaimable=0;
                        if(!empty($bookingRecord))
                        {
                            $sr=0;
                            foreach($bookingRecord as $cardObj){
                                $idData=$cardObj->id;
                                $encodeData=idencode($cardObj->id);
                                $fileStatus=idToName('ticket_cost','booking_id',$cardObj->id,'file_status');
                                $cardAmount=0;
                                $cardExpense=0;
                                $cardClaim=0;
                                $inReceivedMark=0;
                                $cardAmount=sumOfAmount('customer_recepet_history','amount',array('booking_id'=>$cardObj->id,'receipt_via'=>1));
                                $cardAmountTotal=$cardAmountTotal+$cardAmount;
                                $cardExpense=ticketCharges($cardObj->id);
                                $cardExpensenseToatl=$cardExpensenseToatl+$cardExpense;
                                $cardClaim=($cardAmount-$cardExpense);
                                $cardClaimable=$cardClaimable+$cardClaim;
                                $inReceivedMark=countTotal('card_charge_Status',array('booking_id'=>$cardObj->id,'paid_status'=>1));
                        ?>
                        <tr id="cardRowNonEdit<?php echo $cardObj->id;  ?>" <?php if($inReceivedMark >0){ ?> style="background-color: #dff0d8 !important;" <?php } ?> >
                                    <td><?php echo ++$sr; ?></td>
                                    <td><?php echo  cardChargedDate('customer_recepet_history',array('booking_id'=>$cardObj->id,'receipt_via'=>1),'paymentDate'); ?></td>
                                    <td><a href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($fileStatus)); ?>"><?php echo idToName('company','id',$cardObj->company,'company_Code').'-'.$cardObj->id ?></a></td>
                                    <td><?php echo $cardAmount; ?></td>
                                    <td><?php echo $cardExpense;  ?></td>
                                    <td><?php echo $cardClaim; ?></td>
                                    <td><?php if($inReceivedMark >0){ ?>Received <?php } else{ ?>Not Received<?php } ?></td>
                                    <td class="text-center">
                                        <?php if($fileStatus==1){ ?>
                                        <i class="fa fa-check" style="color: #ffb027"></i>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                         <?php if($fileStatus==2){ ?>
                                        <i class="fa fa-check" style="color: #15a918"></i>
                                         <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($fileStatus==3){ ?>
                                        <i class="fa fa-check" style="color: #ff0803"></i>
                                         <?php } ?>
                                    </td>
                                    <td><?php echo idToName('admin','id',$cardObj->booked_agent_id,'login_name'); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-warning btn-round" onclick="showCardEditRow(<?php echo $cardObj->id ?>)">Edit</button>
                                    </td>
                        </tr> 
                        <tr id="cardRowEditAble<?php echo $cardObj->id;  ?>" style="display: none;">
                                    <td><?php echo ++$sr; ?></td>
                                    <td><?php echo  cardChargedDate('customer_recepet_history',array('booking_id'=>$cardObj->id,'receipt_via'=>1),'paymentDate'); ?></td>
                                    <td><a href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($fileStatus)); ?>"><?php echo idToName('company','id',$cardObj->company,'company_Code').'-'.$cardObj->id ?></a></td>
                                    <td><?php echo $cardAmount; ?></td>
                                    <td><?php echo $cardExpense;  ?></td>
                                    <td><?php echo $cardClaim; ?></td>
                                    <td><select id="receiveStatus<?php echo $cardObj->id;  ?>" name="" class="form-control"><option value="">--select One--</option><option value="0">Not Receive</option><option value="1" <?php if($inReceivedMark >0){ ?>selected="selected"<?php } ?> >Receive</option></select></td>
                                    <td class="text-center">
                                        <?php if($fileStatus==1){ ?>
                                        <i class="fa fa-check" style="color: #ffb027"></i>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                         <?php if($fileStatus==2){ ?>
                                        <i class="fa fa-check" style="color: #15a918"></i>
                                         <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($fileStatus==3){ ?>
                                        <i class="fa fa-check" style="color: #ff0803"></i>
                                         <?php } ?>
                                    </td>
                                    <td><?php echo idToName('admin','id',$cardObj->booked_agent_id,'login_name'); ?></td>
                                    <td class="text-center">
                                        <button type="button" onclick="filesaveAsCardAmountRecaived(<?php echo $cardObj->id;  ?>)" class="btn btn-xs btn-primary btn-round">save</button>
                                        <button type="button" class="btn btn-xs btn-danger btn-round" onclick="cancelEditRow(<?php echo $cardObj->id;  ?>)">Cancel</button>
                                    </td>
                        </tr> 
                        <?php
                        if(!empty($receivedCardData))
                            {
//                            print_r($receivedCardData);
                                foreach($receivedCardData as $brealLineobj)
                                {
                                   if($brealLineobj->file_number==$idData)
                                   {
                                       ?>
                                        <tr>
                                            <td colspan="12">Total</td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>fgf</td>
                                            <td></td>
                                            <td></td>
                                            <td>fhdfh</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                       <?php 
                                   } 
                                }
                            }
                        }
                        } ?>
                            <tr>
                                    <td colspan="2" style="font-weight: bold;color: #009fbe;"><?php echo $countFiles ?></td> 
                                    <td style="font-weight: bold;color: #009fbe;"></td>
                                    <td style="color: #ff0803;font-weight: bold"><?php echo $cardAmountTotal; ?></td>
                                    <td style="color: blue;font-weight: bold"><?php echo $cardExpensenseToatl; ?></td>
                                    <td style="color: #15a918;font-weight: bold"><?php echo $cardClaimable; ?></td>
                                    <td colspan="8"></td> 
                            </tr>
                            <tr id="transectionRow">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"></td>
                                    <td></td> 
                                    <td colspan="3"></td>
                                    <td colspan="2"></td>
                                    <td colspan="3" class="text-right">
                                        <button type="button" onclick="showCardAmountReceiveRow()" class="btn btnCT btn-primary btn-round">Card Transaction</button>
                                    </td>
                            </tr>
                            <tr id="CardAmountReceiveRow" style="display: none;">
                                    <td></td>
                                    <td>
                                        <input type="hidden" value="<?php echo $cardClaimable; ?>" id="claimAbAmount">
                                        <input type="text" id="cardAmountReceived" readonly="" name="" placeholder="yyyy-mm-dd" class="form-control">
                                        <span id="cardAmountReceivedError"></span>
                                    </td>
                                    <td>
                                        <select id="fileNumber" class="form-control">
                                            <option value="">--Select One--</option>
                                            <?php 
                                            if(!empty($NotrecivedFiles))
                                            {
                                                foreach ($NotrecivedFiles as $files)
                                                {
                                                    ?>
                                            <option value="<?php echo $files->id; ?>"><?php echo $files->id; ?></option>
                                                    <?php 
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="fileNumberError"></span>
                                    </td>
                                    <td colspan="2">
                                        <input type="text" name="" id="file_comment" class="form-control" placeholder="File No. Or Ref.?">
                                        <span id="file_commentError"></span>
                                    </td>
                                    <td>
                                        <input type="text" name="" onkeypress="removeerror('Amount_card_Error',this.id)" onkeyup="numberWithDeceimal('Amount_card_Error',this.id)" id="amount_card" placeholder="Amount" class="form-control">
                                        <span id="Amount_card_Error"></span>
                                    </td> 
                                    <td colspan="1"></td>
                                    <td colspan="4">
                                        <select class="form-control" id="cardReceivedFor"> 
                                            <option value="Issuance Transfer">Issuance Transfer (Put PYMT ref. here.)</option>
                                            <option value="Transfer US">Transfer US (Put PYMT ref. here.)</option>
                                            <option value="Chargeback">Chargeback (File No. ref. CHBK AMT+PK)</option>
                                            <option value="Refund">Refund (File No. ref. AMT+Again T.C)</option>
                                        </select>
                                    </td>
                                    <td colspan="3" class="text-right">
                                        <button type="button" class="btn btnCT btn-primary btn-round btn-xs" onclick="ReceivedAmountCardRecord()">Save</button>&nbsp;
                                        <button type="button" onclick="cancelCardTransectionRow()" class="btn btnCT btn-primary btn-round btn-xs">Cancel</button>
                                    </td> 
                            </tr>
                            <tr class="SHead"> 
                                <th></th>
                                <th>Date Received</th>
                                <th colspan="3">File No. Or Ref.?</th>
                                <th>Taken Amounts</th>
                                <th colspan="2">Received For</th>
                                <th colspan="2">Claimable Amount</th>
                                <th colspan="2">Left Amount</th>
                            </tr>
                            <?php $leftAm=0;$rece=0;$last_amount=0; if(!empty($receivedCardData)){ foreach($receivedCardData as $recivedObj){$last_amount=$recivedObj->amount; $rece=$rece+$recivedObj->amount;$leftAm=$recivedObj->left_amount; ?>
                            <tr>
                                <td></td>
                                <td><?php echo $recivedObj->date_received; ?></td>
                                <td colspan="3"><?php echo $recivedObj->file_comment; ?></td>
                                <td><?php echo $recivedObj->amount; ?></td>
                                <td colspan="2"><?php echo $recivedObj->received_for; ?></td>
                                <td colspan="2"><?php echo $recivedObj->claimable_amount; ?></td>
                                <td colspan="2"><?php echo $recivedObj->left_amount; ?></td>
                            </tr>
                            <?php } } ?>
                                <input type="hidden" id="leftAmountTo" value="<?php echo $cardClaimable-$rece; ?>">      
                                <br>
                                <tr>
                                    <td colspan="2" style="font-weight: bold"></td> 
                                    <td colspan="8" style="font-weight: bold;color: #009fbe;">Left Total</td>
                                    <!-- <td colspan="2" style="color: #ff0803;font-weight: bold"></td>
                                    <td colspan="2" style="color: blue;font-weight: bold"></td>  
                                    <td colspan="2" style="color: #15a918;font-weight: bold"></td> -->
                                    <td colspan="2" style="color: #15a918;font-weight: bold"><?php echo $leftAm-$last_amount; ?></td> 
                            </tr>
                    </tbody> 
    		</table>
    	</div>
    </div>
</div>
<!-- /page content -->
