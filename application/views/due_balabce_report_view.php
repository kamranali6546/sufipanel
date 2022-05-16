<div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                      <h3>General Reports Of Left Balance</h3>
                    </div>
                    <div class="title_right"> 
                    </div>
                </div>
                <div class="clearfix"></div>
                 
                 <br><br> 
                <div class="row">
                    <div class="col-md-12"> 
                        <table id="example" class="display tablColor" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan="2">Sr.#</th>
                                    <th rowspan="2">Issue Date</th>
                                    <th rowspan="2">File#</th>
                                    <th rowspan="2">Sup.Ref#</th>
                                    <th rowspan="2">Customer Name</th>
                                    <th rowspan="2">Destination</th>
                                    <th rowspan="2">Pax</th> 
                                    <th rowspan="2">Balance</th> 
                                    <th rowspan="2">Profit</th> 
                                </tr> 
                            </thead>
                            <tbody> 
                                <?php  if(!empty($customerRemaingBalance)){
                                    $sr=0;
                                    foreach($customerRemaingBalance as $leftbalanceObj)
                                    {
                                        $saleprice=0;
                                        $amountRece=0;
                                        $ticketCost=0;
                                        $ticketCost=salePrice($leftbalanceObj->id)+ticketChargesAditional($leftbalanceObj->id)+ticketCharges($leftbalanceObj->id);
                                        $saleprice=salePrice($leftbalanceObj->id);
                                        $amountRece=totalreceivedAmount($leftbalanceObj->id);
                                        $leftBalce=($saleprice-$amountRece);
                                        $passgerCount=countTotal('passanger_details',array('booking_id'=>$leftbalanceObj->id));
                                        if($leftBalce >0)
                                        {
                                            $encodeData=idencode($leftbalanceObj->id);
                                            $sr++;
                                            ?>
                                            <tr>
                                                <td><?php echo $sr; ?></td>
                                                <td><?php echo $leftbalanceObj->issue_date; ?></td>
                                                <td><a target="_blank" href="<?php echo base_url('BookingDetailBox/'.$encodeData.'/'.idencode($leftbalanceObj->flag)); ?>"><?php echo idToName('company','id',$leftbalanceObj->company,'company_Code').'-'.$leftbalanceObj->id ?></a></td>
                                                <td><?php echo $leftbalanceObj->supplier_ref; ?></td>
                                                <td><?php echo $leftbalanceObj->fullname; ?></td>
                                                <td><?php echo $leftbalanceObj->destination; ?></td>
                                                <td><?php echo $passgerCount; ?></td>
                                                <td><?php echo $leftBalce; ?></td>
                                                <td><?php echo $ticketCost-$saleprice; ?></td>
                                            </tr>
                                            <?php 
                                        }
                                    }
                                } ?>
                            </tbody> 
                        </table>
                    </div>
                </div>           
            </div>