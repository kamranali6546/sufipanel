<?php error_reporting(0); 
class Pending extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 *  @cell 03446613497
 */   
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
         if($this->session->userdata('userId')==''){
            redirect("login");
        }
    }
    public function index()
    {
        $data['view']='all_pending_view';
        $data['page']='table';
        $data['tab']='pending';
        $data['pageTitle']='Pending Booking';
        $agentId='';
        $agentId=$this->uri->segment(2);
        $loginId=$this->session->userdata('userId');
        $brandFliter    =  $this->input->post('brand_fliter');
        $sortFliter     =  $this->input->post('sort_fliter');
      $brandFliterQ='';
      $sortOrder=" order by a.id asc  ";
      if(!empty($brandFliter))
      {
          $brandFliterQ.=" And a.booking_under_brand='$brandFliter' ";
      }
      if(!empty($sortFliter))
      {
          if($sortFliter=='b_date')
          {
            $sortOrder=" order by a.booking_date asc  "; 
          }
          else if($sortFliter=='t_date')
          {
              $sortOrder=" order by b.departure_date asc  "; 
          }
          else if($sortFliter=='b_no')
          {
            $sortOrder=" order by a.id asc  ";
          }
          else if($sortFliter=='c_name')
          {
            $sortOrder=" order by c.fullname asc  "; 
          }
          else if($sortFliter=='b_agent')
          {
            $sortOrder=" order by a.booked_agent_id asc  "; 
          }
      }
      $company=$this->session->userdata('company');
        if($this->session->userdata('flag')==1 && $agentId=='' && $company==1)
        {
         $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==1 && $agentId!='' && $company==1)
        {
           $agent= iddecode($agentId);
            $qry="select a.id,a.booked_agent_id,a.company,a.file_status,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname     
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id  AND  a.flag='1' and a.booked_agent_id='$agent' and a.canceled_stat!='1' ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==2 && $agentId=='' && $company==1)
        {
             $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1'  ".$brandFliterQ." ".$sortOrder." ";  
        }
        else if($this->session->userdata('flag')==2 && $agentId!='' && $company==1)
        {
            $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' AND a.booked_agent_id='$agent'  ".$brandFliterQ." ".$sortOrder." ";  
        }
        else if($this->session->userdata('flag')==3 && $agentId=='' && $company!=1)
        {
          $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' AND a.booking_under_brand='$company' ".$brandFliterQ." ".$sortOrder." ";  
        }
        else if($this->session->userdata('flag')==3 && $agentId!='' && $company!=1)
        {
          $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' AND a.booked_agent_id='$agent' AND a.booking_under_brand='$company' ".$brandFliterQ." ".$sortOrder." ";  
        }
        else if($this->session->userdata('flag')==5)
        {
            
            $qry="select a.id,a.booked_agent_id,a.company,a.file_status,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname     
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id  AND  a.flag='1' and a.booked_agent_id='$loginId' and a.canceled_stat!='1' ".$brandFliterQ." ".$sortOrder." "; 
        }
        $data['bookingData']=$this->BaseModel->getQuery($qry);
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['sortOrder']            = $sortFliter;
        $data['brandFliter']          = $brandFliter;   
        $data['bankData']             = $this->BaseModel->getWhereM('bank',array('flag'=>1));
        $this->load->view('dashboard',$data);
    }
    public function bookingDetails()
    {
        $serid=  $this->input->post('meg_serch_id');
        $number = preg_replace("/[^0-9]/", '', $serid); 
        if(!empty($number))
        {
            $bookingId= $number;  
            $booingFlag= idToName('booking_details','id',$bookingId,'flag');
        }
        else
        {
            $bookingId= iddecode($this->uri->segment(2));  
            $booingFlag= iddecode($this->uri->segment(3)); 
        }
//        $bookingId= iddecode($this->uri->segment(2));  
//        $booingFlag= iddecode($this->uri->segment(3));  
        $flag=$this->session->userdata('flag');
        $loginId=$this->session->userdata('userId');
        $data['view']='booking_details_view';
        $cancelState=idToName('booking_details','id',$bookingId,'canceled_stat');
        $clearedStt=idToName('booking_details','id',$bookingId,'cleared_stat');
        $redState=idToName('booking_details','id',$bookingId,'red_flag');
        $titleDes='';
        if($booingFlag==1 && $cancelState=='')
        {
           $data['tab']='pending'; 
           $titleDes='Pending';
        }
        else if($booingFlag==2)
        {
            if($clearedStt==1)
            {
               $data['tab']='cleared';  
               $titleDes='Issued Cleared';
            }
            else
            {
               $data['tab']='issued';  
               $titleDes='Issued Uncleared';
            }
           
        }
        else if($cancelState==1)
        {
          $data['tab']='cancel';   
          $titleDes='Cancel';
        }
        else if($booingFlag==4)
        {
          $data['tab']='redFlag';  
          $titleDes='Red Flag';
        }
        else if($booingFlag==5)
        {
            $data['tab']='fourtypercent'; 
             $titleDes='Fourty percente';
        }
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $data['pageTitle']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId.'-'.$titleDes;
        $data['heading']='<b style="color:red">'.idToName('company','id',$companyId,'company_Code').'-'.$bookingId.'</b>-'.$titleDes;
        $data['id']=$bookingId;
        $data['companyCode']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        //$qryForDetails="select from booking_details";
        $company=$this->session->userdata('company');
        if(($flag==1 || $flag==2) && $company==1)
        {
          $qryForDetails="select a.id,a.booking_date,a.file_status,a.bookingTime,a.booked_agent_id,a.company,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.cleared_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.departedTime,d.returnTime,d.returnDate,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status as fstatas,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId' AND g.booking_id='$bookingId' and flag='$booingFlag'  ";
        }
        else if(($flag==1 || $flag==2) && $company!=1)
        {
          $qryForDetails="select a.id,a.booking_date,a.file_status,a.bookingTime,a.booked_agent_id,a.company,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.cleared_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.departedTime,d.returnTime,d.returnDate,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status as fstatas,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId' AND g.booking_id='$bookingId' and flag='$booingFlag'  ";
        }
        else if($flag==3 && $company!=1)
        {
          $qryForDetails="select a.id,a.booking_date,a.file_status,a.bookingTime,a.booked_agent_id,a.company,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.cleared_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.departedTime,d.returnTime,d.returnDate,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status as fstatas,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId' AND g.booking_id='$bookingId'  and flag='$booingFlag'  AND a.booking_under_brand='$company' ";  
        }
        else if($flag==5)
        {
           $qryForDetails="select a.id,a.booking_date,a.file_status ,a.bookingTime,a.company,a.booked_agent_id,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.cleared_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.returnDate,d.departedTime,d.returnTime,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status as fstatas ,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId' AND g.booking_id='$bookingId'  and flag='$booingFlag' and booked_agent_id='$loginId'  "; 
        }
        $resPandingData=$this->BaseModel->getQuery($qryForDetails);
       // print_r($resPandingData);
        $data['cardCharges']=$this->BaseModel->sum('card_charges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['bankCharges']=$this->BaseModel->sum('bankCharges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['transectionCharges']=$this->BaseModel->sum('transectionCharges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['pendingBookingData']=$resPandingData;
        $data['passengerDetails']=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $data['passengerCount']=$this->BaseModel->count('passanger_details',array('booking_id'=>$bookingId));
        $data['paymentReceived']=$this->BaseModel->getWhereM('customer_recepet_history',array('booking_id'=>$bookingId));
        $data['bankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['negativeRemarks']=$this->BaseModel->getWhereM('left_balance',array('flag'=>2,'bookeing_id'=>$bookingId));
        $data['remaingBalanceRemark']=$this->BaseModel->getWhereM('left_balance',array('flag'=>1,'bookeing_id'=>$bookingId));
        $data['cardCancelledRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>3,'booking_id'=>$bookingId));
        $data['countcardCanelRemarks']=countTotal('refund_remrks',array('flag'=>3,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['cashCancelledRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>4,'booking_id'=>$bookingId));
        $data['countcashCanelRemarks']=countTotal('refund_remrks',array('flag'=>4,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['refundRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>5,'booking_id'=>$bookingId));
        $data['refundRemarksCount']=countTotal('refund_remrks',array('flag'=>5,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['chargebackremarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>6,'booking_id'=>$bookingId));
        $data['chargeBackCount']=countTotal('refund_remrks',array('flag'=>6,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['cancelRemarks']=$this->BaseModel->getWhereM('cancel_remarks',array('booking_id'=>$bookingId));
        $eventQry=" Select * from event_history where booking_id='$bookingId' AND flag='1' order by id desc ";
        $data['bookingEvents']=$this->BaseModel->getQuery($eventQry);
        if($this->session->userdata('flag')==1)
        {
          $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));  
        }
        else
        {
            $data['copany']=$this->BaseModel->getWhereM('company',array('id'=>$this->session->userdata('company'))); 
        }   
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $data['IncomData']=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
       //$paysupplierQry=" Select * from payment where booking_ref=$bookingId AND pay_type='Dr' AND payment_nature='supplier' AND pay_to!='Debit Card Charge Global Travel' AND pay_to!='Credit Card Charge Global Travel' ";
       $paysupplierQry=" Select * from payment where booking_ref=$bookingId AND pay_type='Dr' union  Select * from payment where booking_ref=$bookingId AND pay_type='Cr' And payment_nature='supplier' ";
        
       $data['supplierPayment']=$this->BaseModel->getQuery($paysupplierQry);
        $data['PaymentRecivedFromCustomer']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_to'=>'Customer'));
        $data['CustomerRefund']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_by'=>'Customer'));
        $pendingTasQry=" select a.id,a.booked_agent_id,a.company,a.booking_date,a.supplier_ref,b.departure_date,b.returnDate,c.fullname  
from booking_details as a ,flight_details as b,customer_contacts as c 
where a.id=b.booking_id and  a.id=c.booking_id and a.flag='10' and a.pending_status='1'  order by a.id asc ";
        $data['pendingTask']=$this->BaseModel->getWhereM('paymentRequest',array('booking_id'=>$bookingId,'isRead'=>0));
        $data['ticketorder']=$this->BaseModel->getWhereM('ticketOrderRequest',array('booking_id'=>$bookingId,'isRead'=>0));
        $data['cardData']=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
        $data['totalPayCustomer']=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$bookingId)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$bookingId)));
        $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$bookingId));
        $refendAmount=(refundSum($bookingId)+$amountGotoCustomer);
        $data['refundAmount']=$refendAmount;
        $this->load->view('dashboard',$data);
    }
    public function mega_search()
    {
         $bookingSech= $this->input->post('meg_serch_id');
         $number = preg_replace("/[^0-9]/", '', $bookingSech); 
        
        $bookingId= $number;  
        $booingFlag= iddecode($this->uri->segment(3));  
        $flag=$this->session->userdata('flag');
        $loginId=$this->session->userdata('userId');
        $data['view']='mega_search_view';
        $cancelState=idToName('booking_details','id',$bookingId,'canceled_stat');
        $redState=idToName('booking_details','id',$bookingId,'red_flag');
        if($booingFlag==1 && $cancelState=='')
        {
           $data['tab']='pending'; 
        }
        else if($booingFlag==2)
        {
           $data['tab']='issued'; 
        }
        else if($cancelState==1)
        {
          $data['tab']='cancel';   
        }
        else if($booingFlag==4)
        {
          $data['tab']='redFlag';   
        }
        else if($booingFlag==5)
        {
            $data['tab']='fourtypercent'; 
        }
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $data['pageTitle']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        $data['id']=$bookingId;
        $data['companyCode']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        //$qryForDetails="select from booking_details";
        if($flag==1)
        {
          $qryForDetails="select a.id,a.booking_date,a.bookingTime,a.booked_agent_id,a.company,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.departedTime,d.returnTime,d.returnDate,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId'  and g.booking_id='$bookingId'  ";
        }
        else
        {
           $qryForDetails="select a.id,a.booking_date,a.bookingTime,a.company,a.booked_agent_id,a.flag,a.red_flag,a.supplier_name,a.supplier_agent_name,a.supplier_ref,a.booking_under_brand,a.duplicate_status,a.cancel_date,a.canceled_stat,a.issue_date,
            c.booking_id,c.fullname,c.line_number,c.postal_address,c.mobile,c.email,c.source_of_booking,d.booking_id,d.flight_Id,d.departure,
            d.destination,d.via,d.returningVia,d.flight_type,d.departure_date,d.returnDate,d.departedTime,d.returnTime,d.airline,d.flight_number,d.flight_class,d.number_Of_segment,d.pnr,d.airlineLocatore,d.gds,d.ticketDetails,d.systemFlightDetails,d.fareExpiryDate,d.pnrExpiryDate,d.pnrExpiryTime,d.fareExpiryTime,
            f.booking_id,f.ticket_cost_id,f.basic_fare,f.tax,f.apc,f.sufi,f.misc,f.addit_misc,f.postage,f.file_status,f.bank_charges,f.card_charges,f.transection_charges,f.totalcost,f.cardRefund,f.cashRefund,f.againTransection,f.chargebackAmount,f.chargeback_plenty,
            g.booking_id,g.paying_by,g.paymentDue_date,g.paymentDueTime,g.validFrom,g.cardHolderName,g.expiryDate,g.card_number,
            g.cvv,g.cardType,g.cardIssuingBank,g.cardBrand,g.newbookingChargeAmount,g.bankCharges from booking_details as a,customer_contacts as c,flight_details as d,ticket_cost as f,customer_receipt_details as g
            where a.id='$bookingId' and c.booking_id='$bookingId' and d.booking_id='$bookingId' and f.booking_id='$bookingId'  and g.booking_id='$bookingId'   "; 
        }
        $resPandingData=$this->BaseModel->getQuery($qryForDetails);
       // print_r($resPandingData);
        $data['cardCharges']=$this->BaseModel->sum('card_charges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['bankCharges']=$this->BaseModel->sum('bankCharges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['transectionCharges']=$this->BaseModel->sum('transectionCharges','customer_recepet_history',array('booking_id'=>$bookingId));
        $data['pendingBookingData']=$resPandingData;
        $data['passengerDetails']=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $data['passengerCount']=$this->BaseModel->count('passanger_details',array('booking_id'=>$bookingId));
        $data['paymentReceived']=$this->BaseModel->getWhereM('customer_recepet_history',array('booking_id'=>$bookingId));
        $data['bankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['negativeRemarks']=$this->BaseModel->getWhereM('left_balance',array('flag'=>2,'bookeing_id'=>$bookingId));
        $data['remaingBalanceRemark']=$this->BaseModel->getWhereM('left_balance',array('flag'=>1,'bookeing_id'=>$bookingId));
        $data['cardCancelledRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>3,'booking_id'=>$bookingId));
        $data['countcardCanelRemarks']=countTotal('refund_remrks',array('flag'=>3,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['cashCancelledRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>4,'booking_id'=>$bookingId));
        $data['countcashCanelRemarks']=countTotal('refund_remrks',array('flag'=>4,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['refundRemarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>5,'booking_id'=>$bookingId));
        $data['refundRemarksCount']=countTotal('refund_remrks',array('flag'=>5,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['chargebackremarks']=$this->BaseModel->getWhereM('refund_remrks',array('flag'=>6,'booking_id'=>$bookingId));
        $data['chargeBackCount']=countTotal('refund_remrks',array('flag'=>6,'booking_id'=>$bookingId,'agentId'=>$loginId));
        $data['cancelRemarks']=$this->BaseModel->getWhereM('cancel_remarks',array('booking_id'=>$bookingId));
        $eventQry=" Select * from event_history where booking_id='$bookingId' AND flag='1' order by id desc ";
        $data['bookingEvents']=$this->BaseModel->getQuery($eventQry);
        if($this->session->userdata('flag')==1)
        {
          $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));  
        }
        else
        {
            $data['copany']=$this->BaseModel->getWhereM('company',array('id'=>$this->session->userdata('company'))); 
        }   
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
         $data['IncomData']=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
       $paysupplierQry=" Select * from payment where booking_ref=$bookingId AND pay_type='Dr' AND payment_nature='supplier' AND pay_to!='Debit Card Charge Global Travel' AND pay_to!='Credit Card Charge Global Travel' ";
        $data['supplierPayment']=$this->BaseModel->getQuery($paysupplierQry);
        $data['PaymentRecivedFromCustomer']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_to'=>'Customer'));
        $data['CustomerRefund']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_by'=>'Customer'));
        $pendingTasQry=" select a.id,a.booked_agent_id,a.company,a.booking_date,a.supplier_ref,b.departure_date,b.returnDate,c.fullname  
from booking_details as a ,flight_details as b,customer_contacts as c 
where a.id=b.booking_id and  a.id=c.booking_id and a.flag='10' and a.pending_status='1'  order by a.id asc ";
        $data['pendingTask']=$this->BaseModel->getWhereM('paymentRequest',array('booking_id'=>$bookingId,'isRead'=>0));
        $data['ticketorder']=$this->BaseModel->getWhereM('ticketOrderRequest',array('booking_id'=>$bookingId,'isRead'=>0));
        $data['cardData']=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
        $this->load->view('dashboard',$data);
    }

    public function bookingFollowUp()
    {
        $data['view']='booking_follow_up_view';
        $data['page']='Booking Follow-ups';
        $data['tab']='bfollowup';
        $data['pageTitle']='Booking Follow-ups';
        
        $data['page']='table';
        $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.airline,b.pnr,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' AND a.file_status='follow-up' ";
			
	$data['bookingData']=$this->BaseModel->getQuery($qry);
        $this->load->view('dashboard',$data);
    }

    public function bookingDetailsEdit()
    {
        $bookingId= iddecode($this->uri->segment(2));  
        $data['view']='booking_details_edit_view';
        $data['id']=$bookingId;
        if($this->session->userdata('flag')==1)
        {
            $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));  
        }
        else
        {
           $data['copany']=$this->BaseModel->getWhereM('company',array('id'=>$this->session->userdata('company'))); 
        }
         $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $this->load->view('dashboard',$data);
    }
    public function bookingUpdate()
    {
        $bookingId=$this->input->post('bookingID');
//         echo $bookingId;
//        exit();
        $bookingDate=  explode(' ',$this->input->post('bookingDate'));
        $departedDate=  explode(' ', $this->input->post('departureDate'));
        $returnDate=  explode(' ', $this->input->post('returnDate'));
        $pnrExpiryDate=  explode(' ', $this->input->post('pnrExpireDate'));
        $fareExpiryDate=  explode(' ', $this->input->post('fareExpireDate'));
        $paymentDueDate=explode(' ', $this->input->post('paymentDueDate'));
        $bookingDetailsArray=array(
//            'booking_date'=>$bookingDate[0],
//            'bookingTime'=>$bookingDate[1],
            'supplier_name'=>$this->input->post('supplier_name'),
            'supplier_agent_name'=>$this->input->post('supplierAgent'),
            'supplier_ref'=>$this->input->post('ibe'),
            'booking_under_brand'=>$this->input->post('booking_brand'),
            'company'=>$this->input->post('booking_brand'),
            'file_status'=>$this->input->post('file_update')
        );
        $customerContactDetailsArray=array(
            'fullname'=>$this->input->post('name'),
            'line_number'=>$this->input->post('lineNumber'),
            'postal_address'=>$this->input->post('postalAddress'),
            'mobile'=>$this->input->post('mobileNumber'),
            'email'=>$this->input->post('customerEmail'),
            'source_of_booking'=>$this->input->post('source_booking')
        );
        $flightDetailsArray=array(
          'departure'=>$this->input->post('bookingDeparture'),  
          'destination'=>$this->input->post('bookingDestination'),  
          'via'=> implode(',' ,$this->input->post('bookingVia')), 
          'returningVia'=> implode(',' ,$this->input->post('bookingViaReturn')),
          'flight_type'=>  $this->input->post('flightType'),
          'departure_date'=> $departedDate[0],
          'departedTime'=>  $departedDate[1],
          'returnDate'=>  $returnDate[0],
          'returnTime'=>  $returnDate[1],
          'airline'=>  $this->input->post('bookingAirline'),
          'flight_class'=>  $this->input->post('flightClass'),
          'number_Of_segment'=>  $this->input->post('noOfSegments'),
          'pnr'=>  $this->input->post('pnr'),
          'airlineLocatore'=>  $this->input->post('airlineLocatore'),
          'gds'=>  $this->input->post('gds'),
          'pnrExpiryDate'=>$pnrExpiryDate[0],
          'pnrExpiryTime'=>$pnrExpiryDate[1],
          'fareExpiryDate'=>$fareExpiryDate[0],
          'fareExpiryTime'=>$fareExpiryDate[1],
          'ticketDetails'=>$this->input->post('ticket_details'),
           'systemFlightDetails'=>$this->input->post('systemFlightDetails')
        );
        $ticketCostArray=array(
            'basic_fare'=>$this->input->post('basicFare'),
            'tax'=>$this->input->post('tax'),
            'apc'=>$this->input->post('apc'),
            'sufi'=>$this->input->post('safi'),
            'misc'=>$this->input->post('misc'),
            'addit_misc'=>$this->input->post('addmisc'),
            'postage'=>$this->input->post('postage'),
            'bank_charges'=>$this->input->post('bankCharges'),
            'card_charges'=>$this->input->post('cardCharges')
//            'file_status'=>$this->input->post('fileStatus')
        );
        $payingBy=$this->input->post('paying_method');
        if($payingBy=='Bank')
        {
           $receiptCustomerDetails=array(
           'booking_id' => $bookingId,
           'paying_by'=>$this->input->post('paying_method'),
           'paymentDue_date'=>$paymentDueDate[0],
           'paymentDueTime'=>$paymentDueDate[1],
           'newbookingChargeAmount'=>$this->input->post('amountCharged')
            );  
        }
        else if($payingBy=='Card')
        {
           $receiptCustomerDetails=array(
           'booking_id' => $bookingId,
           'paying_by'=>$this->input->post('paying_method'),
           'paymentDue_date'=>$paymentDueDate[0],
           'paymentDueTime'=>$paymentDueDate[1],
           'card_number'=>$this->input->post('cardNumber'),
           'cardHolderName'=>$this->input->post('cardHolderName'),
           'validFrom'=>$this->input->post('validFrom'),
           'cvv'=>$this->input->post('cvvNumber'),
           'expiryDate'=>$this->input->post('cardExpiryDate'),
           'cardBrand'=>$this->input->post('cardBrand'),
           'cardIssuingBank'=>$this->input->post('issuingBank'),
           'cardType'=>$this->input->post('cardType'),
           'newbookingChargeAmount'=>$this->input->post('amountCharged')
             );     
        }
        
        $bookingDetailsUpdateRes=$this->BaseModel->update('booking_details',$bookingDetailsArray,array('id'=>$bookingId));
        $customerContactUpdateRes=$this->BaseModel->update('customer_contacts',$customerContactDetailsArray,array('booking_id'=>$bookingId));
        $flightDetailsUpdateRes=$this->BaseModel->update('flight_details',$flightDetailsArray,array('booking_id'=>$bookingId));
        $ticketCostupdateResp=$this->BaseModel->update('ticket_cost',$ticketCostArray,array('booking_id'=>$bookingId));
//        $customerReceipetDetails=$this->BaseModel->update('customer_receipt_details',$receiptCustomerDetails,array('booking_id'=>$bookingId));
        
       
        $getRes="select flag from booking_details where id='$bookingId'";
        $resGet=$this->BaseModel->getQuery($getRes);
        $objg=$resGet[0];
        $idencoded=idencode($bookingId);
        $flagEncode=idencode($objg->flag);
        $filestatus=$this->input->post('fileStatus');
        if($filestatus==3)
        {
            
        }
        else if($filestatus==5)
        {
            $this->BaseModel->update('ticket_cost',array('cardRefund'=>$this->input->post('cardRefund'),'cashRefund'=>$this->input->post('cashRefund'),'againTransection'=>$this->input->post('againTransection'),'chargebackAmount'=>0,'chargeback_plenty'=>0),array('booking_id'=>$bookingId));
            
        }
        else if($filestatus==6)
        {
            $this->BaseModel->update('ticket_cost',array('cardRefund'=>0,'cashRefund'=>0,'againTransection'=>0),array('booking_id'=>$bookingId));
            $this->BaseModel->update('ticket_cost',array('cardRefund'=>0,'cashRefund'=>0,'againTransection'=>0,'chargebackAmount'=>$this->input->post('chargebackAmount'),'chargeback_plenty'=>$this->input->post('chargeback_plenty')),array('booking_id'=>$bookingId));
        }
        else if($filestatus!=5)
        {
          $this->BaseModel->update('ticket_cost',array('cardRefund'=>0,'cashRefund'=>0,'againTransection'=>0),array('booking_id'=>$bookingId));  
        }
        redirect(base_url('BookingDetailBox/'.$idencoded.'/'.$flagEncode));
    }
    
    public function redFlagBook()
    {
       $data['view']='red_flag_booking_view';
       $data['tab']='redFlag';
       $data['pageTitle']='Red Flag Pending Bookings';
       
        $loginId=$this->session->userdata('userId');
        $brandFliter    =  $this->input->post('brand_fliter');
       $sortFliter     =  $this->input->post('sort_fliter');
      $brandFliterQ='';
      $sortOrder=" order by a.id asc  ";
      if(!empty($brandFliter))
      {
          $brandFliterQ.=" And a.booking_under_brand='$brandFliter' ";
      }
      if(!empty($sortFliter))
      {
          if($sortFliter=='b_date')
          {
            $sortOrder=" order by a.booking_date asc  "; 
          }
          else if($sortFliter=='t_date')
          {
              $sortOrder=" order by b.departure_date asc  "; 
          }
          else if($sortFliter=='b_no')
          {
            $sortOrder=" order by a.id asc  ";
          }
          else if($sortFliter=='c_name')
          {
            $sortOrder=" order by c.fullname asc  "; 
          }
          else if($sortFliter=='b_agent')
          {
            $sortOrder=" order by a.booked_agent_id asc  "; 
          }
      }
      $company=$this->session->userdata('company');
        if($this->session->userdata('flag')==1 && $company==1)
        {
        $qry="select a.id,a.booked_agent_id,a.red_flag,a.booking_under_brand,a.flag,a.company,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.red_flag='1'  ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==3 && $company!=1)
        {
           $qry="select a.id,a.booked_agent_id,a.red_flag,a.booking_under_brand,a.flag,a.company,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.red_flag='1' AND a.booking_under_brand='$company'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        else if($this->session->userdata('flag')==2 && $company!=1)
        {
           $qry="select a.id,a.booked_agent_id,a.red_flag,a.booking_under_brand,a.flag,a.company,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.red_flag='1' AND a.booking_under_brand='$company'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        else if($this->session->userdata('flag')==5)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.red_flag,a.booking_under_brand,a.flag,a.booking_date,a.supplier_ref,b.departure_date,
                b.pnrExpiryDate,b.fareExpiryDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.red_flag='1' and a.booked_agent_id='$loginId'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        $data['bookingDataRed']=$this->BaseModel->getQuery($qry);
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['sortOrder']            = $sortFliter;
        $data['brandFliter']          = $brandFliter;
       $this->load->view('dashboard',$data); 
    }
    public function fortyPer()
    {
       $data['view']='fourty_percent_or_above';
       $data['tab']='fourtypercent';
       $data['pageTitle']='Paid 40% amount or above';
       $loginId=$this->session->userdata('userId');
       $brandFliter    =  $this->input->post('brand_fliter');
       $sortFliter     =  $this->input->post('sort_fliter');
      $brandFliterQ='';
      $sortOrder=" order by a.id asc  ";
      if(!empty($brandFliter))
      {
          $brandFliterQ.=" And a.booking_under_brand='$brandFliter' ";
      }
      if(!empty($sortFliter))
      {
          if($sortFliter=='b_date')
          {
            $sortOrder=" order by a.booking_date asc  "; 
          }
          else if($sortFliter=='t_date')
          {
              $sortOrder=" order by b.departure_date asc  "; 
          }
          else if($sortFliter=='b_no')
          {
            $sortOrder=" order by a.id asc  ";
          }
          else if($sortFliter=='c_name')
          {
            $sortOrder=" order by c.fullname asc  "; 
          }
          else if($sortFliter=='b_agent')
          {
            $sortOrder=" order by a.booked_agent_id asc  "; 
          }
      }
      $company=$this->session->userdata('company');
       if($this->session->userdata('flag')==1 && $company==1)
        {
        $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.booking_under_brand,a.canceled_stat,a.cancel_date,a.flag,a.supplier_ref,
            b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id   ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==3 && $company!=1)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.booking_under_brand,a.canceled_stat,a.cancel_date,a.flag,a.supplier_ref,
            b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  And a.booking_under_brand='$company'   ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==2 && $company!=1)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.booking_under_brand,a.canceled_stat,a.cancel_date,a.flag,a.supplier_ref,
            b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  And a.booking_under_brand='$company'   ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==5)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.booking_under_brand,a.flag,a.canceled_stat,a.cancel_date,a.supplier_ref,
                b.pnrExpiryDate,b.fareExpiryDate,b.departure_date,b.returnDate,c.fullname   
                from booking_details as a ,flight_details as b,customer_contacts as c 
                where a.id=b.booking_id and a.id=c.booking_id  and a.booked_agent_id='$loginId'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        $data['paidFortyBooking']=$this->BaseModel->getQuery($qry);
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['sortOrder']            = $sortFliter;
        $data['brandFliter']          = $brandFliter;   
       $this->load->view('dashboard',$data); 
    }
}