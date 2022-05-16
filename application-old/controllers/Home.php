<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller
{
     public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
        //ob_end_flush();
        if($this->session->userdata('userId')==''){
            redirect("login");
        }
    }
    public function index()
    {
     
//        $data['view']='module';
        $data['view']='progress_sheet_view';
        $data['tab']=''; 
        $month=$this->input->post('month');
        $year=$this->input->post('year');
        $brand=$this->input->post('brand');
        if(!empty($month) && !empty($year))
        {
            $currentMonth=$year.'-'.$month.'-'.'01';
            $a_date = $currentMonth;
            $lastDay= date("t", strtotime($a_date));
            $lastDateOfMonth=date('Y-'.$month.'-'.$lastDay);
            $flitrMonth=$month;
            $fliterYear=$year;
        }
        else
        {
            $currentMonth=date('Y-m-01');
            $a_date = date('Y-m-d');
            $lastDay= date("t", strtotime($a_date));
            $lastDateOfMonth=date('Y-m-'.$lastDay);
            $flitrMonth=date('m');
            $fliterYear=date('Y');
        }
        $data['agents']=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>5));
       $dataBooking=array();
        foreach($data['agents'] as $agent)
        {
            
           $query="  Select booking_details.*,booking_details.id as BookingId from booking_details  where booking_details.booked_agent_id='$agent->id' AND  booking_details.issue_date BETWEEN '$currentMonth' AND '$lastDateOfMonth'  ";
           $pendingQry=" Select count(*) as totalPending  from booking_details  where booking_details.booked_agent_id='$agent->id' AND  booking_details.flag='1' AND  booking_details.canceled_stat!='1'  ";
           $IssuedQry=" Select count(*) as totalIssued  from booking_details  where booking_details.booked_agent_id='$agent->id' AND  booking_details.flag='2' AND  booking_details.issue_date BETWEEN '$currentMonth'  AND  '$lastDateOfMonth'   ";
           $TodayQry=" Select count(*) as totalToday  from booking_details  where booking_details.booked_agent_id='$agent->id' AND  booking_details.booking_date='$a_date'  ";
           $currentMonthQry=" Select count(*) as totalThisMonth  from booking_details  where booking_details.booked_agent_id='$agent->id' AND booking_details.booking_date BETWEEN '$currentMonth' AND '$lastDateOfMonth' ";
           $canceledQry=" Select count(*) as totalCancel  from booking_details  where booking_details.booked_agent_id='$agent->id' AND booking_details.canceled_stat='1' AND  booking_details.cancel_date BETWEEN '$currentMonth' AND '$lastDateOfMonth' ";
           $canceledProfitQry=" Select * from booking_details  where booking_details.booked_agent_id='$agent->id' AND booking_details.canceled_stat='1' AND  booking_details.cancel_date BETWEEN '$currentMonth' AND '$lastDateOfMonth' ";
           $pendingResult               = $this->BaseModel->getQuery($pendingQry); 
           $issuedResult                = $this->BaseModel->getQuery($IssuedQry); 
           $todayResult                 = $this->BaseModel->getQuery($TodayQry); 
           $currentMonthResult          = $this->BaseModel->getQuery($currentMonthQry); 
           $canceledResult              = $this->BaseModel->getQuery($canceledQry); 
           $canceledProfitResult        = $this->BaseModel->getQuery($canceledProfitQry); 
           $canceledProfit=0;
           
           if(!empty($canceledProfitResult))
           {
               foreach($canceledProfitResult as $canceled)
               {
                   
                   
                   $amountGotoCustomer=0;
                   $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$canceled->id));
                   //$amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$canceled->id));
                   $receiveCount_cancel=0;
                   $profit_gross_cancel=0;
                   $additionalCharges_cancel=0;
                   $receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$canceled->id)) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$canceled->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$canceled->id)));
                  
                   $additionalCharges_cancel=(ticketCharges($canceled->id)+ticketChargesAditional($canceled->id));
                   $chargeBackAndPlenty=chargebackPlenty($canceled->id);
                   $refendAmount=(refundSum($canceled->id)+$amountGotoCustomer);
                 $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                  $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
//                  echo $profit_gross_cancel."======= Agent ============ ".$canceled->booked_agent_id."<br> ";
                   $canceledProfit=($canceledProfit)+($profit_gross_cancel);
               }
           }
           $dataBooking[$agent->id]    = $this->BaseModel->getQuery($query); 
           $dataBooking[$agent->id]['pendingBooking']=$pendingResult[0]->totalPending;
           $dataBooking[$agent->id]['cancelBooking']=$canceledResult[0]->totalCancel;
           $dataBooking[$agent->id]['issuedBooking']=$issuedResult[0]->totalIssued;
           $dataBooking[$agent->id]['todayBooking']=$todayResult[0]->totalToday;
           $dataBooking[$agent->id]['currentMonthBooking']=$currentMonthResult[0]->totalThisMonth;
           $dataBooking[$agent->id]['canceledBookingProfit']=$canceledProfit;
        }
//        echo "<pre>";
//        print_r($dataBooking);
//        echo "</pre>";
        $data['agentData']=$dataBooking;
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['fliterMonth']    =  $flitrMonth; 
        $data['fliterYear']    =  $fliterYear; 
        $this->load->view('dashboard',$data);
        
    }
    public function agentBaseGraph()
    {
        $data['view']='progress_sheet_view_agent_base';
        $agentId=$this->uri->segment(2);
        $agentName=idToName('admin','id',$agentId,'login_name');
        $agentbookingTarget=idToName('admin','id',$agentId,'sales_target');
        $profitTarget=idToName('admin','id',$agentId,'profitTarget');
       $arraydata=array();
       $prfitArary=array();
       $title=$agentName." Per Month Bookings Target: ".$agentbookingTarget;
       for($i=1;$i<=12;$i++)
       {
           $detae=12-$i;
           $e=$i-1;
            $month=date("y M",strtotime("-".$detae." month"));
            $Formatedmonth=date("M y",strtotime("-".$detae." month"));
            $fliterDate=date("Y-m-d",strtotime("-".$detae." month"));
            $firstDay=date('Y-m-01',  strtotime($fliterDate));
            $lastDayfliter=date("Y-m-t", strtotime($firstDay));
            
            $qry="";
            $qry="select a.id,a.booked_agent_id,a.company,a.issue_date,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.flag='2' and a.booked_agent_id='$agentId'  AND a.issue_date BETWEEN '$firstDay' AND '$lastDayfliter' ";
            $result=$this->BaseModel->getQuery($qry);
            $agentBooked=0;
            $bookingQry="select id,booked_agent_id,company,booking_under_brand,booking_date  
            from booking_details
            where booked_agent_id='$agentId'  AND booking_date BETWEEN '$firstDay' AND '$lastDayfliter' ";
            $resultBooking=$this->BaseModel->getQuery($bookingQry);
            if(!empty($resultBooking))
           {
               $agentBooked=count($resultBooking);
           }
           else
           {
              $agentBooked=0; 
           }
            if(!empty($result))
            {
                 $agentProfit=0;
                 foreach($result as $profit)
                 {
                    $profit_gross=0;
                    $receiveCount=0;
                    $additionalCharges=0;
                    $total_ticket_cost=0;
                    $salePrice=0;
                    $profit_gross=0;
                    $additionalCharges=(ticketCharges($profit->id)+ticketChargesAditional($profit->id));
                    $payableSupplier=ticketCost($profit->id);
                     $receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$profit->id))+sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$profit->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$profit->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$profit->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$profit->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$profit->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$profit->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$profit->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$profit->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$profit->id));                         
                 $total_ticket_cost=($additionalCharges + $payableSupplier);
                 $salePrice=salePrice($profit->id);
                
                           $profit_gross=($salePrice-$total_ticket_cost);
                           $agentProfit=$agentProfit+$profit_gross;
                     }
            }
            else
            {
                $agentProfit=0;
            }
           
             $canceledProfitQry=" Select * from booking_details  where booking_details.booked_agent_id='$agentId' AND booking_details.canceled_stat='1' AND  booking_details.cancel_date BETWEEN '$firstDay' AND '$lastDayfliter' ";
            $canceledProfitResult        = $this->BaseModel->getQuery($canceledProfitQry);
            $canceledProfit=0;
            if(!empty($canceledProfitResult))
           {
               foreach($canceledProfitResult as $canceled)
               {
                   
                   
                   $amountGotoCustomer=0;
                   $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$canceled->id));
                   $receiveCount_cancel=0;
                   $profit_gross_cancel=0;
                   $additionalCharges_cancel=0;
                   $receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$canceled->id)) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$canceled->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$canceled->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$canceled->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$canceled->id)));
                  
                   $additionalCharges_cancel=(ticketCharges($canceled->id)+ticketChargesAditional($canceled->id));
                   $chargeBackAndPlenty=chargebackPlenty($canceled->id);
                   $refendAmount=(refundSum($canceled->id)+$amountGotoCustomer);
                 $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                  $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                   $canceledProfit=($canceledProfit)+($profit_gross_cancel);
               }
           }
            $arraydata[$e]['name']=$Formatedmonth;
            $arraydata[$e]['y']=$agentBooked;
            $arraydata[$e]['drilldown']=$Formatedmonth; 
            $prfitArary[$e]['name']=$Formatedmonth;
            $prfitArary[$e]['y']=($agentProfit+$canceledProfit);
            $prfitArary[$e]['name']=$Formatedmonth;
       }

        $data['tab']='';
        $jsonData=  json_encode($arraydata,true);
        $jsonDataProfit=  json_encode($prfitArary,true);
        $data['agentId']=$agentId;
        $data['agentBookings']=$jsonData;
        $data['agentProfit']=$jsonDataProfit;
        $data['titleAgentSaleGraph']=$title;
        $data['titleAgentProfitGraph']=$agentName." Per Month Profit Target: £".$profitTarget;
        $this->load->view('dashboard',$data);
    }
    public function logout()
    {
//        unset($this->session->userdata('userId'));
//        unset($this->session->userdata('logged_in'));
       $this->session->unset_userdata('userId');
       $this->session->unset_userdata('logged_in');
       $this->session->unset_userdata('flag');
       $this->session->unset_userdata('pic');
       $this->session->unset_userdata('stat');
       $this->session->unset_userdata('email');
       $this->session->unset_userdata('loginName');
       $this->session->unset_userdata('logged_in');   
//        $this->session->unset_userdata($result);    
//        $this->session->sess_destroy();
        $this->session->sess_destroy();
         //$this->cache->clean();
//        ob_end_flush();
        redirect('Login');
    }
    public function profile()
    {
        $data['view']='myprofile_view';
        $this->load->view('dashboard',$data);
    }
    public function logHistory()
    {
        $data['view']='login_logs_view';
        $data['page']='table';
        $userId=$this->session->userdata('userId');
        $companyId=$this->session->userdata('company');
        $flag=$this->session->userdata('flag');
        if($flag==1)
        {
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history  order by id desc ');
        }
        else if($flag==2)
        {
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history order by id desc ');
        }
        else if($flag==3)
        {
//            $data['logData']=$this->BaseModel->getWhereM('log_history',array('agent_Id'=>$userId));
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history where agent_Id="'.$userId.'" order by id desc ');
        }
        else if($flag==4)
        {
//            $data['logData']=$this->BaseModel->getWhereM('log_history',array('agent_Id'=>$userId));
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history where agent_Id="'.$userId.'" order by id desc ');
        }
        else if($flag==5 && $companyId==1)
        {
//            $data['logData']=$this->BaseModel->getWhereM('log_history',array('agent_Id'=>$userId));
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history where agent_Id="'.$userId.'" order by id desc ');
        }
        else if($flag==5 && $companyId!=1)
        {
//            $data['logData']=$this->BaseModel->getWhereM('log_history',array('agent_Id'=>$userId));
            $data['logData']=$this->BaseModel->getQuery('Select * from log_history where agent_Id="'.$userId.'" order by id desc ');
        }
//        $data['logData']=$this->BaseModel->getWhereM('log_history',array('agent_Id'=>$userId));
        $this->load->view('dashboard',$data);
    }
}
?>