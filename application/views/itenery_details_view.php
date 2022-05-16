<style>
  .booking-item-payment {
    -webkit-box-shadow: 0 2px 1px rgba(0,0,0,0.1);
    box-shadow: 0 2px 1px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.15);
}
.booking-item-payment > header {
    padding: 10px 15px;
    background: #f7f7f7;
}
.mb0 {
    margin-bottom: 0 !important;
}
.booking-item-payment .booking-item-payment-details {
    list-style: none;
    margin: 0;
    padding: 15px;
    border-top: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
}
.booking-item-payment .booking-item-payment-details > li {
    margin-bottom: 20px;
    overflow: hidden;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .fa-plane, .booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .fa-plane {
    font-size: 20px;
}
.booking-item-flight-details .booking-item-departure .fa-plane, .booking-item-flight-details .booking-item-arrival .fa-plane {
    float: left;
    display: block;
    font-size: 30px;
    margin-right: 5px;
    position: relative;
    top: 4px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure h5, .booking-item-payment-flight .booking-item-flight-details .booking-item-arrival h5 {
    font-size: 14px;
}
.booking-item-flight-details .booking-item-departure h5, .booking-item-flight-details .booking-item-arrival h5 {
    margin-bottom: 0;
}  
.booking-item-payment h5 {
    font-size: 18.2px;
    font-weight: 300;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-departure .booking-item-date, .booking-item-payment-flight .booking-item-flight-details .booking-item-arrival .booking-item-date {
    padding-left: 23px;
    font-size: 11px;
}
.booking-item-flight-details .booking-item-departure .booking-item-date, .booking-item-flight-details .booking-item-arrival .booking-item-date {
    margin-bottom: 7px;
    font-size: 12px;
    line-height: 1em;
    padding-left: 32px;
}
.booking-item-payment-flight .booking-item-flight-details .booking-item-destination {
    font-size: 12px;
    color: #fd962c;
}

.booking-item-flight-details .booking-item-destination {
    font-size: 12px;
    line-height: 1.3em;
}
.booking-item-flight-details .booking-item-departure, .booking-item-flight-details .booking-item-arrival {
    float: left;
    width: 47%;
}
.fa-flip-vertical {
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1);
    -webkit-transform: scale(1, -1);
    -moz-transform: scale(1, -1);
    -ms-transform: scale(1, -1);
    -o-transform: scale(1, -1);
    transform: scale(1, -1);
}
.booking-item-payment-flight .booking-item-flight-duration > p {
    margin-bottom: 5px;
    line-height: 1em;
    font-size: 13px;
}
.booking-item-payment-flight .booking-item-flight-duration > h5 {
    font-weight: 400;
}
.booking-item-flight-details {
    overflow: hidden;
}
.booking-item-flight-details .booking-item-departure {
    margin-right: 6%;
}
.booking-item-payment .booking-item-payment-total {
    margin-bottom: 0;
    padding: 8px 30px 8px 15px;
    font-size: 12px;
}
.booking-item-payment .booking-item-payment-total > span {
    font-size: 24px;
    color: #686868;
    font-weight: 400;
    letter-spacing: -2px;
}
</style>

<?php
$itenery=unserialize(base64_decode($itenery)); 
if(!empty($itenery)){
   $fareOption=$itenery['FareInfo'];
   $adultFare=$fareOption['AdtPrice'] + $fareOption['AdtTax'];
                          $childFare=$fareOption['ChdPrice'] + $fareOption['ChdTax'];
                          $InfantFare=$fareOption['InfPrice'] + $fareOption['InfTax'];
                          $fardestion=$fareOption['To'];
                          $departFare1=$fareOption['From'];
                                  $goingAirlineCode='';
                                  $returnAirlineCode='';
                                    $legCount=count($itenery['Leg']);
                                    $leg=$itenery['Leg'];
                                    $goingAirlineCode=$leg[0]['AvlCarrier']; 
                                    $going_depart_time=$leg[0]['DepTime'];
                                    $going_depart_date=$leg[0]['DepDate'];
                                    $return_depart_time='';
                                    $return_desti_time='';
                                    $returnAirlineCode='';
                                    $returnStopData='';
                                    $goingTimeElspaed=0;
                                    $returnTimeElpised=0;
                                    $return_desti_date='';
                                    $destIndex=0;
                                    $departFare=$leg[0]['AvlFrom'];
                                    $goingVia=0;
                                    for($j=0;$j< $legCount;$j++)
                                    {
//                                       echo  $leg[$j]['AvlFrom'];
                                        if($leg[$j]['AvlTo']==$fardestion)
                                        {
                                            $going_deasti_date=$leg[$j]['ArrDate'];
                                            $going_desti_time=$leg[$j]['ArrTime'];
                                            $goingVia=$j;
                                            $destIndex=$j;
                                            for($k=0;$k< $j;$k++)
                                            {
                                                $stopData.=$leg[$k]['AvlTo'].',';
                                                $timeelaspedArrayGo=  explode(':', $leg[$k]['ElapsedTime']);
                                                $goingTimeElspaed=$goingTimeElspaed+(($timeelaspedArrayGo[0]*60)+$timeelaspedArrayGo[1]);
                                            }
                                        }
                                        if($leg[$j]['AvlFrom']==$fardestion)
                                        {
                                            $return_depart_date=$leg[$j]['DepDate'];
                                            $return_depart_time=$leg[$j]['DepTime'];
                                            $returnAirlineCode=$leg[$j]['AvlCarrier'];
                                        }
                                    }
                                            $return_desti_date=$leg[$legCount-1]['ArrDate'];
                                            $return_desti_time=$leg[$legCount-1]['ArrTime'];
                                            $returnVia=((($legCount-1)-($goingVia+1)));
                                            for($h=$destIndex+1;$h < $legCount-1;$h++)
                                            {
                                                $returnStopData.=$leg[$h]['AvlTo'].',';
                                                $timeElaspedRetArray=  explode(':',$leg[$h]['ElapsedTime']);
                                                $returnTimeElpised=$returnTimeElpised+(($timeElaspedRetArray[0]*60)+$timeElaspedRetArray[1]);
                                            }
                                        
                                    $timeelaspedArrayGo=  explode(':', $leg[$k]['ElapsedTime']);
                                    $goingTimeElspaed=$goingTimeElspaed+(($timeelaspedArrayGo[0]*60)+$timeelaspedArrayGo[1]);
                                    $timeElaspedRetArray=  explode(':',$leg[$j-1]['ElapsedTime']);
                                    $returnTimeElpised=$returnTimeElpised+(($timeElaspedRetArray[0]*60)+$timeElaspedRetArray[1]);
?>
<div class="container">
    <style>
        .list li {    text-decoration: none;list-style: none;}
    </style>
                        <div class="booking-item-payment" style="background: white">
                            <!-- <header class="clearfix">
                                <h5 class="mb0">Flight Details</h5>
                            </header> -->
                            <ul class="booking-item-payment-details">
                                <li>
                                    <!--<h5>Flight Details</h5>-->
                                    <?php for($goDe=0;$goDe<= $destIndex; $goDe++){ $checkOutBounGroungTim=$goDe+1;
                                        ?>
                                    <div class="booking-item-payment-flight">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="booking-item-flight-details">
                                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                        <h5><?php echo $leg[$goDe]['DepTime']; ?></h5>
                                                        <p class="booking-item-date"><?php echo date('D, M d',  strtotime($leg[$goDe]['DepDate'])); ?></p>
                                                        <p class="booking-item-destination"><?php echo $leg[$goDe]['AvlFrom'].'-'.idToName('airports','airport_name','airport_code',$leg[$goDe]['AvlFrom'])  ?></p>
                                                    </div>
                                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                        <h5><?php echo  $leg[$goDe]['ArrTime']; ?></h5>
                                                        <p class="booking-item-date"><?php echo date('D, M d',strtotime($leg[$goDe]['ArrDate'])); ?></p>
                                                        <p class="booking-item-destination"><?php echo $leg[$goDe]['AvlTo'].'-'.idToName('airports','airport_name','airport_code',$leg[$goDe]['AvlTo']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="booking-item-flight-duration">
                                                    <p>Duration</p>
                                                    <h5><?php $elpasedTimeArray=explode(':',$leg[$goDe]['ElapsedTime']); echo $elpasedTimeArray[0].'H '.' '.$elpasedTimeArray[1].'m'; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(array_key_exists('GroundTime',$leg[$checkOutBounGroungTim])){ ?>
                                        <p>STOP <?php $groundTimeArray=  explode(':',$leg[$checkOutBounGroungTim]['GroundTime']); echo $groundTimeArray[0].'H '.' '.$groundTimeArray[1].'m '; ?></p>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </li>
                                <?php if($ticket_type!='O'){ ?><hr>
                                     <li>
                                    <!--<h5>Flight Details</h5>-->
                                    <?php 
                                    for($reD=$destIndex+1;$reD <= $j; $reD++)
                                    {
                                        if($leg[$reD]['DepTime']!='')
                                            {
                                            $checkInbounGroungTim=$reD+1;
                                        ?>
                                    <div class="booking-item-payment-flight">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="booking-item-flight-details">
                                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                        <h5><?php echo $leg[$reD]['DepTime']; ?></h5>
                                                        <p class="booking-item-date"><?php echo date('D, M d',  strtotime($leg[$reD]['DepDate'])); ?></p>
                                                        <p class="booking-item-destination"><?php echo $leg[$reD]['AvlFrom'].'-'.idToName('airports','airport_name','airport_code',$leg[$reD]['AvlFrom']);  ?></p>
                                                    </div>
                                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                        <h5><?php echo  $leg[$reD]['ArrTime']; ?></h5>
                                                        <p class="booking-item-date"><?php echo date('D, M d',strtotime($leg[$reD]['ArrDate'])); ?></p>
                                                        <p class="booking-item-destination"><?php echo $leg[$reD]['AvlTo'].'-'.idToName('airports','airport_name','airport_code',$leg[$reD]['AvlTo']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="booking-item-flight-duration">
                                                    <p>Duration</p>
                                                    <h5><?php $retunElspedTimeArray=  explode(':',$leg[$reD]['ElapsedTime']); echo $retunElspedTimeArray[0].'H '.' '.$retunElspedTimeArray[1].'m '; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(array_key_exists('GroundTime',$leg[$checkInbounGroungTim])){ ?>
                                        <p>STOP <?php $groundtimeretunArray= explode(':',$leg[$checkInbounGroungTim]['GroundTime']); echo $groundtimeretunArray[0].'H '.' '.$groundtimeretunArray[1].'m '; ?></p>
                                        <?php } ?>
                                    <?php } } ?>
                                    </div>
                                </li>
                                    
                               <?php }
                                ?>
                                
                                <li>
                                    <h5><?php //echo $adultTotal+$childTotal+$infantTotal.'Passengers'; ?></h5>
                                    <ul class="booking-item-payment-price">
                                        <?php
                                        foreach($prices_details as $prices)
                                        {
                                        $sales_t=$prices['saleTotal']; $pracenfgr=end($prices['passengers']); $keys= array_keys($prices['passengers']);
                                        ?>
                                        <li>
                                            <p class="booking-item-payment-price-title"><?php echo $pracenfgr; ?><?php if($keys[1]=='adultCount'){ echo "Adult"; }else if($keys[1]=='childCount'){ echo "Child"; } else if($keys[1]=='infantInLapCount'){ echo "Infant"; } ?></p>
                                            <p class="booking-item-payment-price-amount"><?php echo $sales_t; ?></p>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                            <p class="booking-item-payment-total">Total Price  <?php  echo '&pound;'.$totalPrice; ?> for Passengers:<?php echo $adultCount+$childCount+$infantCount; ?> <span><?php echo $salesTotal; ?></span>
                            </p>
                        </div>
                    </div>
<?php } ?>