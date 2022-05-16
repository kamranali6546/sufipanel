<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// date_default_timezone_set('Europe/London');
 function iddecode($data)
{
      $expl=  explode('s',$data);
      $impl=  implode('=', $expl);
      return $id=base64_decode($impl);
}
function idencode($data)
{
   $encodedata= base64_encode($data);
   $gg=explode('=',$encodedata);
    return  $ids=implode('s', $gg);
}
function idToName($table,$field,$id,$name)
{
     $ci =& get_instance();
     $ci->load->database();
     $query = $ci->db->get_where($table,array($field=>$id));
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result[$name];
       }
       else
       {
           return '';
       }
}
function idToNameOrderAndLimit($table,$field,$id,$name,$orderBy='',$limit='')
{
     $ci =& get_instance();
     $ci->load->database();
     
     $ci->db->select($name);
     $ci->db->where($field,$id);
     $ci->db->from($table);
     if(!empty($orderBy))
      {
         $ci->db->order_by('id',$orderBy);
      }
      if(!empty($limit))
      {
          $ci->db->limit($limit);
      }
     $query = $ci->db->get();
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result[$name];
       }
       else
       {
           return '';
       }
}
function cardChargedDate($table,$condition,$fields)
{
   $ci =& get_instance();
   $ci->load->database();
   $query = $ci->db->get_where($table,$condition);
   if($query->num_rows() > 0)
    {
     $result = $query->row_array();
     return $result[$fields];
    }
    else
    {
     return '';
    } 
}
function currentWeather()
{
        $ch = curl_init('api.openweathermap.org/data/2.5/weather?id=2643743&units=metric&APPID=835c9ceea697d6e47d25fe92b6dbd8c4');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));	
        $obj = curl_exec($ch);
        $obj3=  json_decode($obj,true);
        curl_close($ch);
        return $obj3;
}
function timeDifferenceCalculate($dateTime1,$dateTime2)
{
    if(!empty($dateTime2) && !empty($dateTime1))
        {
            $datetime1 = new DateTime($dateTime1);
            $datetime2 = new DateTime($dateTime2);
            $interval = $datetime1->diff($datetime2);
            return $interval->format('%h')." H ".$interval->format('%i')." M";
        }
}
//function checkinHours($dateTime1)
//{
//     if(!empty($dateTime1))
//     {
//          $datetime1 = new DateTime($dateTime1);
//          return $datetime1->format('h');
//     }
//}
//function checkinMints($dateTime1)
//{
//    if(!empty($dateTime1))
//     {
//          $datetime1 = new DateTime($dateTime1);
//          return $datetime1->format('i');
//     }
//}
function shiftTimeCulcate($dateTime1,$dateTime2)
{
    if(!empty($dateTime2) && !empty($dateTime1))
        {
            $datetime11 = new DateTime($dateTime1);
            $datetime22 = new DateTime($dateTime2);
            $interval = $datetime11->diff($datetime22);
            return $interval->format('%h')."%".$interval->format('%i');
        }
}
function receiptDetect($receiptVia)
{
    if($receiptVia==1){ return "Card"; }
    else if($receiptVia==2){ return "Online"; }
    else if($receiptVia==3){ return "Cash"; }
    else if($receiptVia==4){ return "Cheque"; }
    else if($receiptVia==5){ return "Card Declined"; }
}
function cardType($card)
{
    if(!empty($card))
    {
        if($card==1){return "CR Telephonic"; }
        else if($card==2){ return "DR Telephonic"; }
        else if($card==3){ return "BH Self CR 3D"; }
        else if($card==4){ return "TP Self CR 3D"; }
        else if($card==5){ return "BH Self DR 3D"; }
        else if($card==6){ return "TP Self DR 3D"; }
        else if($card==7){ return "TP 3Party DR 3D"; }
        else if($card==8){ return "TP 3Party CR 3D"; }
        
    }
}
function fileStatus($status)
{
    if(!empty($status))
    {
        if($status==1){ return "Pending Booking"; }
        else if($status==2){ return "Issued Booking"; }
        else if($status==3){ return "Card Cancellation"; }
        else if($status==4){ return "Cash Cancellation"; }
        else if($status==5){ return "Refund"; }
        else if($status==6){ return "Chargeback"; }
    }
}
function ticketCost($bookingId)
{
     $ci =& get_instance();
     $ci->load->database();
     $qry="select  (basic_fare+tax+apc+sufi+misc) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return (float) round($result['total'],2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function adjustmentPay($bookingId)
{
     $ci =& get_instance();
     $ci->load->database();
     $qry=" Select sum(amount) as total from payment where booking_ref=$bookingId AND pay_type='Cr' And payment_nature='supplier' AND pay_by!='Customer' ";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return (float) round($result['total'],2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function ticketCharges($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(card_charges+transectionCharges) as total  from customer_recepet_history  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  (float) round($result['total'],2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0.0;
       }
}
function ticketChargesAditional($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(cardRefund+cashRefund+againTransection+chargebackAmount+chargeback_plenty+postage+bank_charges+card_charges+addit_misc) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function getCardCharges($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select card_charges as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result['total'];
       }
       else
       {
           return 0;
       }
}
function ticketChargesAditionalChargeBack($bookingId)
{
     $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(againTransection+chargeback_plenty) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       } 
}
function ticketChargesAditionalChargeBackOnly($bookingId)
{
     $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(againTransection) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       } 
}
function salePrice($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(salePrice+booking_fee) as total  from passanger_details  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function refundSum($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(cardRefund+cashRefund) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function chargebackPlenty($bookingId)
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(chargebackAmount+chargeback_plenty) as total  from ticket_cost  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return  round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       }
}
function totalreceivedAmount($bookingId)
{
   $ci =& get_instance();
     $ci->load->database();
     $qry="select  sum(amount) as total  from customer_recepet_history  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
       
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return round(floatval($result['total']),2,PHP_ROUND_HALF_UP);
       }
       else
       {
           return 0;
       } 
}
function countTotal($tableName,$condition)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where($tableName,$condition);
    return $query->num_rows();
}
function sumOfAmount($table,$field,$condition)
{
    $ci =& get_instance();
    $ci->load->database();
    $ci->db->select_sum($field);
    $ci->db->where($condition);
    $query=$ci->db->get($table);
//    echo $ci->db->last_query();
    if($query->num_rows() >0)
    {
        $result = $query->row_array();
        if(!empty($result[$field]))
        {
            return $result[$field];
        }
        else
        {
            return 0;
        }
    }
    else
    {
        $zero='0';
        return $zero;
    }
}
function lateTimeCalculation($firstTime,$lastTime)
{
$firstTime=strtotime($firstTime);
$lastTime=strtotime($lastTime);
// perform subtraction to get the difference (in seconds) between times
$timeDiff=$lastTime-$firstTime;

// return the difference
return $timeDiff;

}
function secToHR($seconds)
{
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds / 60) % 60);
  $seconds = $seconds % 60;
  $dataT=$hours.":".$minutes.":".$seconds;
  return $dataT;
}
function commentGet($qry)
{
    $ci =& get_instance();
    $ci->load->database();
//    $qry="select  sum(amount) as total  from customer_recepet_history  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
      if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result;
       }
       else
       {
           return 0;
       } 
}
function commentAllGet($qry)
{
    $ci =& get_instance();
    $ci->load->database();
//    $qry="select  sum(amount) as total  from customer_recepet_history  where booking_id='$bookingId'";
     $query = $ci->db->query($qry);
      if($query->num_rows() > 0)
       {
         // print_r($query);
           $result = $query->result_array();
           return $result;
       }
       else
       {
           return 0;
       } 
}
function commentGetAll($qry)
{
    $ci =& get_instance();
    $ci->load->database();
     $query = $ci->db->query($qry);
      if($query->num_rows() > 0)
       {
          $result=array();
          foreach ($query->result_array() as $row)
            {
               $result[]=$row;
            }
           return $result;
       }
       else
       {
           return 0;
       } 
}
function getAllBanks()
{
    $ci =& get_instance();
     $ci->load->database();
     $qry="select  bank_name  from bank  where flag='1' ";
     $query = $ci->db->query($qry);
       $result=array();
       if($query->num_rows() > 0)
       {
           
           foreach ($query->result_array() as $row)
            {
               $result[]=$row;
            }
           
           return $result;
       }
       else
       {
           return $result;
       } 
}
function bankPayment($bookingId)
{
    $allbanks=getAllBanks();
    $ci =& get_instance();
    $ci->load->database();
    $toatal=0;
    foreach($allbanks as $bank)
    {
        $qryAmount=" Select amount from payment where pay_type='Cr' And booking_ref='$bookingId' And pay_to='$bank[bank_name]' ";
       $response=$ci->db->query($qryAmount);
       if($response->num_rows()>0)
       {
          $rowRes= $response->row_array();
           $toatal=$toatal+$rowRes['amount'];
       }
    }
    return round(floatval($toatal),2,PHP_ROUND_HALF_UP);
    
}
function paidFortyPerCount($flag,$agentId)
{
    $ci =& get_instance();
    $ci->load->database();
    if($flag==1 || $flag==2)
    {
        $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.canceled_stat,a.cancel_date,a.flag,a.supplier_ref,
            b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id   order by a.id asc ";
    }
    else
    {
         $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.flag,a.canceled_stat,a.cancel_date,a.supplier_ref,
                b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname   
                from booking_details as a ,flight_details as b,customer_contacts as c 
                where a.id=b.booking_id and a.id=c.booking_id  and a.booked_agent_id='$agentId'  order by a.id asc "; 
    }
    $response=$ci->db->query($qry);
    $count=0;
    if($response->num_rows()>0)
    {
        foreach($response->result_array() as $obj)
        {
            $tatalreceived=0;
            $totalSalePrice=0;
            $percent=0;
            $cardAmount=0;
            if($obj['flag']!=2 && $obj['canceled_stat']!=1)
            {
                $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj['id']));
                $bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj['id']))+sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$obj['id']));
                $tatalreceived=($cardAmount+$bankAmount);
                $totalSalePrice=salePrice($obj['id']);
                $percent=(($totalSalePrice*40)/100);
                if($tatalreceived >$percent)
                {
                    $count++;
                }
                
            }
        }
    }
    else
    {
         $count=0;
    }
    return $count;
    
}
function customerPayAmount($bookingId)
{
    $ci =& get_instance();
    $ci->load->database();
    $ary="Select sum(amount) as amount from payment where booking_ref='$bookingId' AND pay_to='Customer' AND pay_type='Cr' ";
     $response=$ci->db->query($ary);
    if($response->num_rows()>0)
    {
        $rowRes= $response->row_array();
           return round(floatval($rowRes['amount']),2,PHP_ROUND_HALF_UP);
    }
    else
    {
        return 0;
    }
}
function supplierPayAmount($bookingId)
{
    $ci =& get_instance();
    $ci->load->database();
    $ary="Select sum(amount) as amount from payment where booking_ref='$bookingId' AND payment_nature='supplier' AND pay_type='Dr' AND pay_to!='Credit Card Charge Global Travel' AND pay_to!='Debit Card Charge Global Travel' And pay_to!='Card Charge Bright Holiday'  ";
     $response=$ci->db->query($ary);
    if($response->num_rows()>0)
    {
        $rowRes= $response->row_array();
           return round(floatval($rowRes['amount']),2,PHP_ROUND_HALF_UP);
    }
    else
    {
        return 0;
    }
}
function supplierPayAmountDirect($bookingId)
{
    $ci =& get_instance();
    $ci->load->database();
    $ary="Select sum(amount) as amount from payment where booking_ref='$bookingId' AND payment_nature='supplier' AND pay_type='Dr' ";
     $response=$ci->db->query($ary);
    if($response->num_rows()>0)
    {
        $rowRes= $response->row_array();
           return round(floatval($rowRes['amount']),2,PHP_ROUND_HALF_UP);
    }
    else
    {
        return 0;
    }
}

function eTickets($bookingId)
{
    $ci =& get_instance();
    $ci->load->database();
    $qry="select eticket from passanger_details where booking_id='$bookingId' ";
    $resone=$ci->db->query($qry);
    $resultArray=array();
    if($resone->num_rows()>0)
    {
        foreach($resone->result_array() as $obj)
        {
            if(!empty($obj['eticket']))
            {
                $resultArray[]=$obj['eticket'];
            }
        }
    }
    if(count($resultArray)>0)
    {
      return implode(',', $resultArray);
    }
    else
    {
       return ' '; 
    }
    
    
}
function roundFloat($float, $neededPrecision, $startAt = 7)
{
    if ($neededPrecision < $startAt) {
        $startAt--;
        $newFloat = round($float, $startAt);
        return roundFloat($newFloat, $neededPrecision, $startAt);
    }

    return $float;
}
function todayFollowUpCount($loginId='')
{
    $ci =& get_instance();
    $ci->load->database();
    $datae=date('Y-m-d');
    if(!empty($loginId))
    {
       $qry=" Select id from inquiry where picke_date='$datae'  and picked_by='$loginId' and status='2' And source='created' ";  
    }
    else
    {
         $qry=" Select id from inquiry where picke_date='$datae'  and status='2' And source='created' ";
    }
   
    $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    }
}
function todayFollowUpDayWiseCount($loginId='')
{
    $ci =& get_instance();
    $ci->load->database();
    $datae=date('Y-m-d');
    if(!empty($loginId) && $source!='')
    {
       $qry=" Select id from inquiry where picke_date='$datae'  and picked_by='$loginId' and status='2'  ";  
    }
    else
    {
         $qry=" Select id from inquiry where picke_date='$datae'  and status='2'  ";
    }
   
    $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    }
}
function progressSheetCount($agentId=0)
{
    $ci =& get_instance();
    $ci->load->database();
    $datae=date('Y-m-d');
    $startDate=date('Y-m-01');
    if($agentId >0)
    {
         $qry=" Select id from booking_details where booking_date BETWEEN '$startDate' AND '$datae' AND booked_agent_id='$agentId' ";  
    }
    else
    {
        $qry=" Select id from booking_details where booking_date BETWEEN '$startDate' AND '$datae' "; 
    }
     $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    }
}
function receivalCount($loginId='') 
{
    $ci =& get_instance();
    $ci->load->database();
    $startDate=date('Y-m-01');
    $datae=date('Y-m-d');
    if(!empty($loginId))
    {
       $qry=" Select id from inquiry where picke_date BETWEEN $startDate AND $datae   and picked_by='$loginId' and status='2' ";  
    }
    else
    {
         $qry=" Select id from inquiry where picke_date BETWEEN $startDate AND $datae  and status='2' ";
    }
   
    $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    }
}
function countLoginArea()
{
    $ci =& get_instance();
    $ci->load->database();
    $qry=' select id  from admin  where first_name!="special" ';  
    $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    }
}
function expenditureCount()
{
    $Ci=& get_instance();
    $Ci->load->database();
    $datae=date('Y-m-d');
    $opingDate=date('Y-m-01');
    $qry=" Select * from payment where   payment_nature='expense' AND pay_date BETWEEN '$opingDate' AND '$datae' ";
    $queryres=$Ci->db->query($qry);
    $exp=0;
    if($queryres->num_rows() >0)
    {
        foreach($queryres->result_array() as $obj)
        {
            if($obj['pay_type']=='Dr')
            {
                $exp=$exp+$obj['amount'];
            }
        }
        return $exp;
    }
    else
    {
        return $exp;
    }
}
function bookingConversionCount($flag,$id=0)
{
    $Ci=& get_instance();
    $Ci->load->database();
     $start_date=date('Y-m-01');
     $end_date=date('Y-m-d');
     $inq_date_st=date('Y-m-d',  strtotime($start_date));
    $inq_date_en=date('Y-m-d',  strtotime($end_date));
    $inq_date_st1=date('Y-m-d',  strtotime($start_date));
    $inq_date_en1=date('Y-m-d',  strtotime($end_date));
     $condition=" picke_date BETWEEN '$inq_date_st'  And  '$inq_date_en'  ";
    $condition2=" booking_date BETWEEN '$inq_date_st1' And '$inq_date_en1' ";
     $total_inquiry_picked=" select count(*) as tot,picked_by from inquiry where status='2' and  picked_by NOT IN ( 1,2,22,23,27,30 ) and  ".$condition." GROUP BY picked_by ";
     $booked_totalQry=" select count(*) as booked,booked_agent_id from booking_details where  booked_agent_id NOT in ( 1,2,22,23,27,30 )  AND ".$condition2." group by booked_agent_id ";
     
     $result=$Ci->db->query($total_inquiry_picked);
     $booked_total=$Ci->db->query($booked_totalQry);
     $responseArrar=array();
    $grandtotalPic=0;
    $grandtotalbook=0;
    $totalAgents=0;
    foreach ($result->result_array() as $key=> $tota_pic_row)
            {
                 $id_conver=$tota_pic_row['picked_by'];
                $calculate_pic="select count(*) as total,picked_by from inquiry where status='2' and picked_by='$id_conver' and ".$condition."  group by picked_by";
                $calculate_book="select count(*) as book_total,booked_agent_id from booking_details where   booked_agent_id='$id_conver'   and  ".$condition2." group by booked_agent_id ";
                $percentage=0;
                $totalInquerAgent=0;
                $totalbookedAgent=0;
                $res1=$Ci->db->query($calculate_pic);
                $res2=$Ci->db->query($calculate_book);
                $obj1='';
                $obj2='';
                
                if(!empty($res1))
                {
                    $fetch=$res1->result_array();
                    $obj1=$fetch[0];
                   
                }
                if(!empty($res2))
                {
                    $fetch2=$res2->result_array();
                   $obj2=$fetch2[0];
                }
                if(!empty($obj1))
                {
                    $grandtotalPic=$grandtotalPic+$obj1['total'];
                }
                if(!empty($obj2))
                {
                    $grandtotalbook=$grandtotalbook+$obj2['book_total'];
                }
                $percentage= ceil((($obj2['book_total'] *100) / $obj1['total']));
                $totalInquerAgent=$obj1['total'];
                $totalbookedAgent=$obj2['book_total'];
                $agentIdRes=$id_conver;
                $totalAgents++;
                $responseArrar[$key]['agentId']=$agentIdRes;
                $responseArrar[$key]['totalInquery']=$totalInquerAgent;
                $responseArrar[$key]['totalbooking']=$totalbookedAgent;
                $responseArrar[$key]['percentage']=$percentage;
                
            }
            $toParcentage='0';
            $talBooking=0;
            $totalInquiry=0;
            foreach($responseArrar as $pp)
            {
                if($id!=0)
                {
                    if($pp['agentId']==$id){
                    $toParcentage=$pp['percentage'];
                    break;
                    }
                }
                else
                {
                    $talBooking=$talBooking+$pp['totalbooking'];
                    $totalInquiry=$totalInquiry+$pp['totalInquery'];
                    $toParcentage=$toParcentage+$pp['percentage'];
                }
                
            }
            if($id!=0)
            {
                 return $toParcentage.'%';
            }
            else
            {
              $adminCon= round(($talBooking/$totalInquiry)*100,2);
               return $adminCon.'%';
            }
           
}
function followUpBookingCount()
{
    $ci =& get_instance();
    $ci->load->database();
    $qry="select id from booking_details where flag='1' and canceled_stat!='1' and file_status='follow-up'  ";  
    $queryres=$ci->db->query($qry);
    if($queryres->num_rows() >0)
    {
        return $queryres->num_rows();
    }
    else
    {
        return 0;
    } 
}
function generalReportCount($id='')
{
    $ci =& get_instance();
    $ci->load->database();
    $startDate=date('Y-m-01');
    $dateToTest = date('Y-m-d');
    $lastday = date('t',strtotime($dateToTest));
    $endDate=date('Y-m').'-'.$lastday;
    $condition='';
    $condition2='';
    $qry='';
    $qry2='';
    if(!empty($id))
    {
        $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
        $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate' AND " ; 
         $condition.="  a.booked_agent_id='$id'  ";
         $condition2.="  a.booked_agent_id='$id'  ";
    }
    else
    {
       $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
       $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate' AND " ; 
       $condition.=' 1=1';
       $condition2.=' 1=1';
    }
     $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' ";
     $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,c.fullname,b.destination,b.number_Of_segment,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1' ";
    
    $result1=$ci->db->query($qry);
    $result2=$ci->db->query($qry2);
    $customersReceives=0;
    $totalPayableSullpier=0;
    $totalAdditionalCharges=0;
    $toCost_grand=0;
    $issuedTotal=0;
    $totalPriceSale=0;
    $receiveCount=0;
    $payableSupplier=0;
    $additionalCharges=0.0;
    $total_ticket_cost=0;
    $salePrice=0;
    $profit_gross=0;
    if(!empty($result1))
    {
        foreach($result1->result_array() as $key=> $objissuedObj)
        {
            $receiveCount=0;
            $payableSupplier=0;
            $additionalCharges=0.0;
            $total_ticket_cost=0;
            $salePrice=0;
            $profit_gross=0;
            $additionalCharges=  floatval(ticketChargesAditional($objissuedObj['id']));
            $payableSupplier=ticketCost($objissuedObj['id']);
            $receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id'])) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$objissuedObj['id']));
            $customersReceives=$customersReceives+$receiveCount;
            $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
            $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
            $total_ticket_cost=  ($payableSupplier) + ($additionalCharges);
            $toCost_grand=$toCost_grand+$total_ticket_cost;
            $salePrice= salePrice($objissuedObj['id']);
            $totalPriceSale=$totalPriceSale+$salePrice;
            $profit_gross=($salePrice-$total_ticket_cost);
            $issuedTotal=$issuedTotal+$profit_gross;
            
        }
    }
    $customersReceives_cancel=0;
        $totalPayableSullpier_cancel=0;
        $totalAdditionalCharges_cancel=0;
        $toCost_grand_cancel=0;
        $cancelTotal=0;
        $refendAmount_total=0;
        $chargeBackAndPlenty_total=0;
        if(!empty($result2))
        {
            foreach($result2->result_array() as $key2=> $cancleObj)
            {
                $receiveCount_cancel=0;
                $payableSupplier_cancel=0;
                $additionalCharges_cancel=0;
                $total_ticket_cost_cancel=0;
                $profit_gross_cancel=0;
                $refendAmount=0;
                $chargeBackAndPlenty=0;
                $additionalCharges_cancel=(ticketCharges($cancleObj['id'])+ticketChargesAditional($cancleObj['id']));    
                $payableSupplier_cancel=ticketCost($cancleObj['id']);
                $amountGotoCustomer=0;
                $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$cancleObj['id']));
                $receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$cancleObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$cancleObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj['id']))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$cancleObj['id'])));
                $refendAmount=(refundSum($cancleObj['id'])+$amountGotoCustomer);
                $chargeBackAndPlenty=chargebackPlenty($cancleObj['id']);
                $refendAmount_total=$refendAmount_total+$refendAmount;
                $customersReceives_cancel=$customersReceives_cancel+$receiveCount_cancel;
                $totalPayableSullpier_cancel=$totalPayableSullpier_cancel+$payableSupplier_cancel;
                $totalAdditionalCharges_cancel=$totalAdditionalCharges_cancel+$additionalCharges_cancel;
                $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                $toCost_grand_cancel=$toCost_grand_cancel+$total_ticket_cost_cancel;

                $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                $cancelTotal=$cancelTotal+$profit_gross_cancel;
                $chargeBackAndPlenty_total=$chargeBackAndPlenty_total+$chargeBackAndPlenty;
            }
        }
       return number_format(($issuedTotal+$cancelTotal),2);
}
function originInquiry($param)
{
    if($param==1)
    {
       return 'Newsletetr'; 
    }
    else if($param==2)
    {
       return 'Bing';  
    }
    else if ($param==3)
    {
      return 'google';   
    }
    else if ($param==4)
    {
        return 'Seo'; 
    }
    else
    {
        return 'Other'; 
    }
}
function sendEmail($from,$to,$messagePs,$attachment='')
{
    $to = $to;

    //sender
    $from = 'info@brightholiday.co.uk';
    $fromName = 'bright Holiday';
    $subject = 'bright Holiday'; 
    $file = $attachment;
    //email body content
 $htmlContent = "Content-Type: text/html; charset=\"UTF-8\"\n";

$to =$to;
$subject = 'bright Holiday';
$headers = "From: " .$from. "\r\n";
$headers .= "Reply-To: ".$from. "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = "<b>helo test</b> 
                <p>this my test for you</p> 
        ";

$mail=mail($to, $subject, $message, $from);

//$htmlContent = '<h1>PHP Email with Attachment by CodexWorld</h1>
//    <p>This email has sent from PHP script with attachment.</p>';

//header for sender info
$headers =$from;


//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
//$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//multipart boundary 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

//preparing attachment
//if(!empty($file)){
//    if(is_file($file)){
//        $message .= "--{$mime_boundary}\n";
//        $fp =    @fopen($file,"rb");
//        $data =  @fread($fp,filesize($file));
//        print_r($data);
//        @fclose($fp);
//        $data = chunk_split(base64_encode($data));
//        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
//        "Content-Description: ".basename($files[$i])."\n" .
//        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
//        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
//    }
//}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//send email
//$mail = mail($to, $subject, $htmlContent, $headers); 
if($mail)
    {
    return 1;
    }
    else{ return 0; }

}
?>