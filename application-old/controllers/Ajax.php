<?php 
class Ajax extends CI_Controller
{
    /*
 * @author SHAHID Aslam
 * @cell 03446613497
 */
   public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function departTypehead()
    {
        $term=$this->input->get('term');
       $q=" select * from airports where airport_code like '$term%' or airport_name like '$term%' limit 10 ";
        $result=$this->BaseModel->getQuery($q);
        foreach($result as $obj)
        {
             $dataajax[]=$obj->airport_code.'-'.$obj->airport_name;
        }
         echo json_encode($dataajax);
    }
    public function destiTypeHead()
    {
        $term=$this->input->get('term');
       $q=" select * from airports where airport_code like '$term%' or airport_name like '$term%' limit 10 ";
        $result=$this->BaseModel->getQuery($q);
        foreach($result as $obj)
        {
             $dataajax[]=$obj->airport_code.'-'.$obj->airport_name;
        }
         echo json_encode($dataajax);
    }
    public function airlinetypeHead()
    {
       $term=$this->input->get('term');
       $q=" select * from airlines where airline_code like '$term%' or airline_name like '$term%' limit 10 ";
        $result=$this->BaseModel->getQuery($q);
        foreach($result as $obj)
        {
             $dataajax[]=$obj->airline_code.'-'.$obj->airline_name;
        }
         echo json_encode($dataajax);
    }
    public function agentInqueryCommentSave()
    {
        $inqID=$this->input->post('InqID');
        $userid=$this->session->userdata('userId');
        $msg=$this->input->post('msg');
        $comentTime=date('d-M-Y h:m:i');
        $dataArray=array(
            'agent_id'=>$userid,
            'remakts'=>$msg,
            'remarks_time'=>$comentTime,
            'inquiry_id'=>$inqID
        );
        $res=$this->BaseModel->save('agent_comments',$dataArray);
        $result=$this->BaseModel->getWhereMOrder('agent_comments',array('agent_id'=>$userid,'inquiry_id'=>$inqID),'id','desc','');
        $outp='';
        $outp.=$res.'%';
        $label='';
        if(!empty($result))
            {
                $obj=$result[0];
                $agenet_name=idToName('admin','id',$obj->agent_id,'login_name');
                $label='<label style="margin-left:3px"><b>( '.$agenet_name.')&nbsp;</b>'. $obj->remakts.'&nbsp;<b>('.$obj->remarks_time.')</b></label><br>';
                $outp.=$label;
            }
            echo $outp;
    }
    public function agentInqueryCommentSave2()
    {
        $inqID=$this->input->post('InqID');
        $userid=$this->session->userdata('userId');
        $msg=$this->input->post('msg');
        $comentTime=date('d-M-Y h:m:i');
        $dataArray=array(
            'agent_id'=>$userid,
            'remakts'=>$msg,
            'remarks_time'=>$comentTime,
            'inquiry_id'=>$inqID
        );
        $res=$this->BaseModel->save('agent_comments',$dataArray);
//        print_r($dataArray);
//        exit();
        $result=$this->BaseModel->getWhereMOrder('agent_comments',array('agent_id'=>$userid,'inquiry_id'=>$inqID),'id','desc','');
        $outp='';
        $outp.=$res.'%';
        $label='';
        if(!empty($result))
            {
                $obj=$result[0];
                $agenet_name=idToName('admin','id',$obj->agent_id,'login_name');
                $label='<label style="margin-left:3px"><b>( '.$agenet_name.')&nbsp;</b>'. $obj->remakts.'&nbsp;<b>('.$obj->remarks_time.')</b></label><br>';
                $outp.=$label;
            }
            echo $outp;
    }
    public function deteleInquiry()
    {
        $id=$this->input->post('ids');
        $this->BaseModel->del('agent_comments',array('inquiry_id'=>$id));
        $res=$this->BaseModel->del('inquiry',array('id'=>$id));
        if($res >0)
        {
           echo $res;
        }
        else
        {
            echo 0;
        }
        
    }
    public function agentsData()
    {
        $result=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>5));
        $option="<option value=''>--Select Agent--</option>";
        if(!empty($result))
        {
            foreach($result as $obj)
            {
               $option.='<option value="'.$obj->id.'">'.$obj->login_name.'</option>'; 
            }
        }
        echo $option;
    }
    public function agentsData2()
    {
        $result=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>5,'company'=>1));
        $option="<option value=''>--Select Agent--</option>";
        if(!empty($result))
        {
            foreach($result as $obj)
            {
               $option.='<option value="'.$obj->id.'">'.$obj->login_name.'</option>'; 
            }
        }
        echo $option;
    }
    
    public function assignInquiry()
    {
        $id=$this->input->post('id');
        $agent=$this->input->post('agentId');
        $picked_time=date('d-m-Y H:m:i');
        $picked_date=date('Y-m-d');
        $agenet_name=idToName('admin','id',$agent,'login_name');
        $rest=$this->BaseModel->update('inquiry',array('picked_by'=>$agent,'status'=>2,'picked_time'=>$picked_time,'picke_date'=>$picked_date),array('id'=>$id));
       
        if($rest > 0){ echo $rest.'%'.$agenet_name; } else{ echo $rest.'%'.$agenet_name;  }
    }
    public function cardCheck()
    {
        $cardNumber=$this->input->post('cardNumber');
        $cardN=substr($cardNumber,0,6);
        $ch = curl_init('https://api.bincodes.com/bin/?format=json&api_key=96e3bbe695ffee8cb1873f553a8ef95a&bin='.$cardN);	   
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");	
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);	  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));	
        $obj = curl_exec($ch);
        $obj3=  json_decode($obj,true);
        curl_close($ch);
        //print_r($obj3);
         $card_type=$obj3['type'];
         $card_bank_name=$obj3['bank'];
         $card_compny=$obj3['card'];
       echo $card_type.'%'.$card_bank_name.'%'.$card_compny;
    }
    public function deletePassenger()
    {
        $passengerId=$this->input->post('passengerId');
        $res=$this->BaseModel->del('passanger_details',array('passenger_Id'=>$passengerId));
        if($res >0)
        {
            echo $res;
        }
        else
        {
            echo 0;
        }
    }
    public function passengerUpdate()
    {
        $passengerId=$this->input->post('passengerId');
        $category=$this->input->post('category');
        $passengerTitle=$this->input->post('passengerTitle');
        $firstName=$this->input->post('firstName');
        $middleName=$this->input->post('middleName');
        $sirName=$this->input->post('sirName');
        $age=$this->input->post('age');
        $salePrice=$this->input->post('salePrice');
        $bookingFee=$this->input->post('bookingFee');
        $eticket=$this->input->post('eticket');
        $updatedResp=$this->BaseModel->update('passanger_details',array('category'=>$category,'title'=>$passengerTitle,'firstName'=>$firstName,'midle_name'=>$middleName,'sur_name'=>$sirName,'age'=>$age,'salePrice'=>$salePrice,'booking_fee'=>$bookingFee,'eticket'=>$eticket),array('passenger_Id'=>$passengerId));
        if($updatedResp >0)
        {
            echo $updatedResp;
        }
        else
        {
            echo 0;
        }
    }
    public function addPayment()
    {
        $bookingId=$this->input->post('bookingId');
        $receiverNameId=$this->input->post('receiverName');
        $receiverName=idToName('bank','id',$receiverNameId,'bank_name');
        $paymentDate=$this->input->post('paymentDate');
        $receiptVia=$this->input->post('receiptVia');
        $cardType=$this->input->post('cardType');
        $authorizedCode=$this->input->post('authorizedCode');
        $amount=$this->input->post('amount');
        $paymentReference=$this->input->post('paymentReference');
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $cardCharges=0;
        $transectionCharges=0;
        $baankcharges=0;
        if($receiptVia==1)
        { 
            if($cardType==1)
            {
                $cardCharges=(($amount*6)/100);
                $transectionCharges=1.5;
                $baankcharges=0;
            }
            else if($cardType==2)
             {
                $cardCharges=(($amount*3)/100);
                $transectionCharges=1.5;
                $baankcharges=0;
             }
             else if($cardType==3 || $cardType==4 || $cardType==5 || $cardType==6 || $cardType==7 || $cardType==8)
             {
                 $cardCharges=0;
                 $transectionCharges=0;
                 $baankcharges=0;
             }
//            $cardCharges=(($amount*4)/100);
//            $transectionCharges=1.5;
//            $baankcharges=0;
        }
        else
        {
            $cardCharges=0;
            $transectionCharges=0;
            $baankcharges=0;
        }
        $paymentResp=$this->BaseModel->save('customer_recepet_history',array('booking_id'=>$bookingId,'receiverName'=>$receiverNameId,'paymentDate'=>$paymentDate,'receipt_via'=>$receiptVia,'card_type'=>$cardType,'authorizedCode'=>$authorizedCode,'amount'=>$amount,'paymentReference'=>$paymentReference,'card_charges'=>$cardCharges,'transectionCharges'=>$transectionCharges,'bankCharges'=>$baankcharges));
        if($paymentResp >0)
        {
            $adminMailAddress='addmin.bhttl@gmail.com';
            $adminSubject='';
            $agentSubject='';
            $adminConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $agentConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $adminData=array(
                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
            );
            $agentData=array(
                'gerateing'=>'Dear '.$agentName.' Bright Holiday Ltd,'
            );
            $adminBody='';
            $agentBody='';
            $from='notifications@brightholiday.co.uk';
            $companyName='Bright HoliDay';
            if($receiptVia==1)
            {
                $adminSubject=$companyCode.'-'.$bookingId.' Card Charge Confirmations Received for GBP '.$amount;
                $agentSubject=$companyCode.'-'.$bookingId.' Card Charge Confirmations for GBP '.$amount;
                $adminData['messageData']='You have Charged for GBP '.$amount.'  for the File no '.$bookingId.' with the Ref: '.$paymentReference.' into '.$receiverName;
                $agentData['messageData']='Your Card has been Charged for GBP  '.$amount.' for the File no '.$companyCode.'-'.$bookingId.'  with the Ref: '.$paymentReference.' into '.$receiverName.'  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();  
            }
            else if($receiptVia==2)
            {
                $adminSubject=$companyCode.'-'.$bookingId.' online payment  Confirmations Received for GBP '.$amount;
                $agentSubject=$companyCode.'-'.$bookingId.' online payment Confirmations for GBP '.$amount;
                $adminData['messageData']='You have confirmed online payment of  GBP '.$amount.'  for the File no '.$bookingId.' with the Ref: '.$paymentReference.' on '.$paymentDate;
                $agentData['messageData']='Your online payment of GBP  '.$amount.' has been confirmed for the File no '.$companyCode.'-'.$bookingId.'  Into '.$receiverName.' with the Ref: '.$paymentReference.' on '.$paymentDate.'  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();    
            }
            else if($receiptVia==3)
            {
                $adminSubject=$companyCode.'-'.$bookingId.' Cash Payment  Confirmations Received for GBP '.$amount;
                $agentSubject=$companyCode.'-'.$bookingId.' Cash Payment Confirmations for GBP '.$amount;
                $adminData['messageData']='You have confirmed cash payment of  GBP '.$amount.'  for the File no '.$bookingId.' Into '.$receiverName.' with the Ref: '.$paymentReference.' on '.$paymentDate;
                $agentData['messageData']='Your cash payment of GBP  '.$amount.' has been confirmed for the File no '.$companyCode.'-'.$bookingId.'  Into '.$receiverName.' with the Ref: '.$paymentReference.' on '.$paymentDate.'  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();    
            }
            else if($receiptVia==4)
            {
                $adminSubject=$companyCode.'-'.$bookingId.' Cheque Payment  Confirmations Received for GBP '.$amount;
                $agentSubject=$companyCode.'-'.$bookingId.' Cash Payment Confirmations for GBP '.$amount;
                $adminData['messageData']='You have confirmed cheque payment of  GBP '.$amount.'  for the File no '.$bookingId.' Into '.$receiverName.' with the Ref: '.$paymentReference.' on '.$paymentDate;
                $agentData['messageData']='Your cheque payment of GBP  '.$amount.' has been confirmed for the File no '.$companyCode.'-'.$bookingId.'  Into '.$receiverName.' with the Ref: '.$paymentReference.' on '.$paymentDate.'  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();  
            }
            else if($receiptVia==5)
            {
                $adminSubject=$companyCode.'-'.$bookingId.' Card Declined Confirmations for GBP '.$amount;
                $agentSubject=$companyCode.'-'.$bookingId.' Card Declined Confirmations for GBP '.$amount;
                $adminData['messageData']='You have Declined for GBP '.$amount.'  for the File no '.$bookingId.' Into '.$receiverName.' on '.$paymentDate;
                $agentData['messageData']='Your Card has been Declined for GBP  '.$amount.' for the File no '.$companyCode.'-'.$bookingId.'  Into '.$receiverName.' on '.$paymentDate.'  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();  
            }
            
            echo $paymentResp;
        }
        else
        {
            echo 0;
        }
    }
    public function paymentDelete()
    {
        $paymentId=$this->input->post('paymentId');
        $dataobj=$this->BaseModel->getWhereM('payment',array('transectionId'=>$paymentId));
       echo json_encode($dataobj);
//       $paymentDeleteResp=$this->BaseModel->del('customer_recepet_history',array('id'=>$paymentId));
//       if($paymentDeleteResp >0)
//       {
//           echo $paymentDeleteResp;
//       }
//       else
//       {
//           echo 0;
//       }
    }
    public function paymentUpdate()
    {
        $paymentId=$this->input->post('paymentId');
        $receiptName=$this->input->post('receiverName');
        $receivVia=$this->input->post('receiveVia');
        $cardType=$this->input->post('cardType');
        $authorizedCode=$this->input->post('authorizedCode');
        $amount=$this->input->post('amount');
        $paymentRef=$this->input->post('paymentReference');
        $update=date('Y-m-d');
        $transectionCharges=0;
        $baankcharges=0;
        $cardCharges=0;
        if($receivVia==1)
        {
//            $cardCharges=(($amount*4)/100);
            
            if($cardType==1)
            {
                $cardCharges=(($amount*6)/100);
                $transectionCharges=1.5;
                $baankcharges=0;
            }
            else if($cardType==2)
            {
                $cardCharges=(($amount*3)/100);
                $transectionCharges=1.5;
                $baankcharges=0;
            }
            else if($cardType==3 || $cardType==4 || $cardType==5 || $cardType==6 || $cardType==7 || $cardType==8)
            {
                $cardCharges=0;
                $transectionCharges=0;
                $baankcharges=0; 
            }
        }
        else
        {
             $cardCharges=0;
            $transectionCharges=0;
            $baankcharges=0;
        }
        $paymentEditResp=$this->BaseModel->update('customer_recepet_history',array('receiverName'=>$receiptName,'receipt_via'=>$receivVia,'card_type'=>$cardType,'authorizedCode'=>$authorizedCode,'amount'=>$amount,'paymentReference'=>$paymentRef,'card_charges'=>$cardCharges,'transectionCharges'=>$transectionCharges,'bankCharges'=>$baankcharges,'updatedOn'=>$update),array('id'=>$paymentId));
        if($paymentEditResp>0)
        {
           echo $paymentEditResp;
        }
        else
        {
            echo 0;
        }
    }
    public function attendanceFilter()
    {
        $filterStartDate=  explode('-',$this->input->post('startDatefilter'));
        $filterEndDate=  explode('-',$this->input->post('endDateFilter'));
        $agentListFilter=$this->input->post('agentList');
        $year_start=$filterStartDate[0];
        $year_end=$filterEndDate[0];
        $month_start=$filterStartDate[1];
        $month_end=$filterEndDate[1];
        $dayStarts=$filterStartDate[2];
        $dayEnds=$filterEndDate[2];
        $flag=$this->session->userdata('flag');
         $agenId=$this->session->userdata('userId');
        if($flag==1){
        if(!empty($agentListFilter))
            {
               echo  $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') and agent_id='$agentListFilter' and checkinDay BETWEEN '$dayStarts' and '$dayEnds' "; 
                $filename='Attendance Sheet For All Agent';
//                $sdate=date('M',  strtotime($this->input->post('attendanceStartDate'))).' '.$start_data[2];
//                $eddd=date('M',  strtotime($this->input->post('attendanceEndDate'))).' '.$end_date[2];
            }
            else
            {
                $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') and checkinDay BETWEEN '$dayStarts' and '$dayEnds' order by agent_id desc "; 
                $filename='Attendance Sheet For All Agent';
//                $sdate=date('M',  strtotime($this->input->post('attendanceStartDate'))).' '.$start_data[2];
//                $eddd=date('M',  strtotime($this->input->post('attendanceEndDate'))).' '.$end_date[2];
            }
        }
        else
         {
            $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') and checkinDay BETWEEN '$dayStarts' and '$dayEnds' and agent_id='$agenId' order by agent_id desc "; 
         }
            $AttendanceRecord= $this->BaseModel->getQuery($qry);
            $resp='';
            if(!empty($AttendanceRecord))
            {
                $i=0;
                foreach($AttendanceRecord as $objA)
                {
                     $i++;
                     $timeDate1=$objA->checkinYear.'-'.$objA->checkinMonth.'-'.$objA->checkinDay.' '.$objA->chekinTime;
                     $timeDate2='';
                     if(!empty($objA->checkOutTime))
                     {
                      $timeDate2=$objA->checkinYear.'-'.$objA->checkinMonth.'-'.$objA->checkinDay.' '.$objA->checkOutTime;
                     }
                     $checkOutShitTime=  explode('%',shiftTimeCulcate($timeDate1,$timeDate2));
                     $checkinarray='';
                     $checkOutArray='';
                     if(!empty($objA->chekinTime))
                     {
                     $checkinarray= explode(':',$objA->chekinTime);
                     $checkinhour=$checkinarray[0];
                     $chekinSec=$checkinarray[2];
                     }
                     if(!empty($objA->checkOutTime))
                     {
                     $checkOutArray=  explode(':',$objA->checkOutTime);
                     }
                     if($checkinarray){
                     $checkinMint=$checkinarray[1];
                     }
                     $style='';
                     if($objA->attendanceStatus=='Sun'){  }
                     else if($objA->attendanceStatus=='A' || (($checkinhour==9 || $checkinhour > 9) && $checkinMint >= 10 && $chekinSec > 0 && $objA->attendanceStatus=='P'))
                     {
                        $style='style="background-color: #f70072;color: #ffffff;"';
                     } 
                    else if((($checkinhour < 9) && $objA->attendanceStatus=='P') || (($checkinhour <=9) && $checkinMint <= 10  && $objA->attendanceStatus=='P'))
                    {
                      $style='style="background-color: #1ABB9C;color: #ffffff;"';
                    } 
                    $checkoutTime='';
                    if($objA->attendanceStatus=='Sun'){ $checkoutTime=$objA->attendanceStatus; } else if($objA->attendanceStatus=='A'){ $checkoutTime=$objA->attendanceStatus; }  else{ $checkoutTime=$objA->checkOutTime; }
                    $shiftTime='';
                    $agentName='';
                    $agentName=idToName('admin','id',$objA->agent_id,'login_name');
                    if($objA->attendanceStatus=='Sun'){ $shiftTime=$objA->attendanceStatus; } else if($objA->attendanceStatus=='A'){ $shiftTime=$objA->attendanceStatus; } else{ if(!empty($timeDate2)){  $shiftTime=timeDifferenceCalculate($timeDate1,$timeDate2); } }
                    $statusA='';
                    $shiftStatus='';
                    if($objA->attendanceStatus=='Sun'){ echo $objA->attendanceStatus; }
                    else if($objA->attendanceStatus=='A'){ $shiftStatus='Absent'; }
                    else if(($checkinhour==9 || $checkinhour > 9) && $checkinMint >= 10 && $chekinSec > 0 && $objA->attendanceStatus=='P' ){  $shiftStatus="Late"; }
                    else if(($checkinhour==9 || $checkinhour < 9) && $checkinMint <= 10 && $chekinSec==0 && $objA->attendanceStatus=='P' && ($checkinhour >=9 && $checkOutShitTime[1] >0)){  $shiftStatus="Extra Time"; }
                    else if($objA->attendanceStatus=='P' && ($checkOutShitTime[0] < 9 )&& !(empty($objA->checkOutTime))){  $shiftStatus="Less Time"; }
                    else if(($checkinhour <=9) && $checkinMint <= 10  && $objA->attendanceStatus=='P' ){  $shiftStatus="On Time"; }
                    else if(($checkinhour < 9) && $objA->attendanceStatus=='P' ){  $shiftStatus="On Time"; }
                    if($objA->attendanceStatus=='Sun'){ $statusA=$objA->attendanceStatus; }else{ $statusA=$objA->chekinTime; }
                    $resp.='<tr '.$style.'><td>'.$i.'</td><td>'.$objA->checkinYear.'-'.$objA->checkinDay.'-'.$objA->checkinMonth.'</td><td>'.$statusA.'</td><td>'.$checkoutTime.'</td><td>'.$shiftTime.'</td><td>'.$objA->attendanceStatus.'</td><td>'.$shiftStatus.'</td><td>'.$agentName.'</td></tr>';
                   
                }
                echo $resp;
            }
            else{
                $resp.='<tr><td colspan="8" style="color:red;text-align:center;"> Sorry ! There Is Not Data About Your Search !</td></tr>';
                echo $resp;
                //echo 0;
                }
    }
    public function agentGetOnly()
    {
        $result=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>5,'last_logout'=>NULL));
        $option="<option value=''>--Select Agent--</option>";
        if(!empty($result))
        {
            foreach($result as $obj)
            {
               $option.='<option value="'.$obj->id.'">'.$obj->login_name.'</option>'; 
            }
        }
        echo $option;
    }
    public function markIssued()
    {
        $bookingId=$this->input->post('bookingId');
        $bookingIssueDate=$this->input->post('dateIssued');
        $actualDate=date('Y-m-d',strtotime($bookingIssueDate));
       $res= $this->BaseModel->update('booking_details',array('flag'=>2,'issue_date'=>$actualDate),array('id'=>$bookingId));
       if($res >0)
           {
            echo $res;
           }
       else
        {
           echo 0;
        }
        
    }
    public function bookAssignDone()
    {
        $bookingId=$this->input->post('bookingId');
        $agentId=$this->input->post('agentId');
        $resp=$this->BaseModel->update('booking_details',array('booked_agent_id'=>$agentId),array('id'=>$bookingId));
        echo $resp;
    }
    public function markAsPendingTask()
    {
        $bookingId=$this->input->post('bookingId');
        $resp=$this->BaseModel->update('booking_details',array('red_flag'=>1),array('id'=>$bookingId));
        if($resp >0)
        {
            echo $resp;
        }
        else
        {
          echo 0;
        }
    }
    public function calculateSegment()
    {
//        $flightsDetails=  explode('\n',$this->input->post('flightDetails'));
        $count=0;
        $flightsDetails=  $this->input->post('flightDetails');
       $flightArray= preg_split ('/$\R?^/m', $flightsDetails);
       foreach($flightArray as $key=>$Item)
           {
                if (preg_match('/HK/',$Item))
                {
                    $count++;
                }
           }
           echo $count;
//        echo "<pre>";
//        print_r($flightArray);
    }
    public function bankData()
    {
        $respdata=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $option='<option value="">--Select Receiver Bank--</option>';
        if(!empty($respdata))
        {
            foreach($respdata as $obj)
            {
               $option.='<option value="'.$obj->id.'">'.$obj->bank_name.'</option>'; 
            }
        }
        echo $option;
    }
    public function addRequest()
    {
        $flag=$this->session->userdata('flag');
        $booingId=$this->input->post('bookingNo');
        $requestType=$this->input->post('requestType');
        $bankNameId=$this->input->post('bankName');
        $requestReference=$this->input->post('requestReference');
        $requestAmount=$this->input->post('requestAmount');
        $requestDate=$this->input->post('requestDate');
        $agentId=$this->input->post('agentIdR');
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $bankName=idToName('bank','id',$bankNameId,'bank_name');
        $companyId=idToName('booking_details','id',$booingId,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $brand  =  $this->input->post('brand');
        $dataArray=array(
            'booking_id'=>$booingId,
            'requestType'=>$requestType,
            'requestBank'=>$bankNameId,
            'requestReference'=>$requestReference,
            'requestAmount'=>$requestAmount,
            'requestDate'=>$requestDate,
            'requestFrom'=>$agentId,
            'flag'=>1,
            'isRead'=>0,
            'entrydate'=>date('Y-m-d'),
            'brand'=>$brand
        );
        if($requestType=='Bank Payment')
        {
            $logNote='Request to confirm bank payment received -'.$requestAmount.'-  '.$companyCode.'-'.$booingId.' .... '.$requestReference;
        }
        else if($requestType=='Card Payment'){
           $logNote='Request to charge card - '.$requestAmount.'  -'.$companyCode.'-'.$booingId.'...'.$requestReference; 
        }
        else if($requestType=='Invoice'){
            
            $logNote='Request to send invoice ...'.$requestReference; 
        }
        else if($requestType=='Cancel File'){
            
            $logNote='Request to cancel file ...'.$requestReference; 
        }
        else if($requestType=='Refund To Customer')
        {
            $logNote='Request to refund to customer ...'.$requestReference; 
        }
        else if($requestType=='Airline Refund'){
            $logNote='Request to apply for airline refund -'.$requestReference; 
        }
        else if($requestType=='Other'){
            $logNote='Other Request ...'.$requestReference; 
        }
//        $logNote='Request '.$requestType.'  '.$requestReference.'  '.$requestAmount.'&pound;';
        $resData=$this->BaseModel->save('paymentRequest',$dataArray);
        if($resData >0)
        {
            $this->BaseModel->save('event_history',array('booking_id'=>$booingId,'agent_id'=>$agentId,'event_type'=>'Auto','event'=>$logNote,'flag'=>1));
//            $adminMailAddress='addmin.bhttl@gmail.com';
//            $adminSubject='';
//            $agentSubject='';
//            $adminConfig=Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//            $agentConfig=Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//            $adminData=array(
//                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
//            );
//            $agentData=array(
//                'gerateing'=>'Dear '.$agentName.' Bright Holiday Ltd,'
//            );
//            $adminBody='';
//            $agentBody='';
//            $from='notifications@brightholiday.co.uk';
//            $companyName='Bright HoliDay';
//            if($requestType=='Card')
//            {
//                $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Charge Request Received for GBP '.$requestAmount;
//                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Charge Request Sent for GBP '.$requestAmount;
//                $adminData['messageData']='You have received a card charge request from the File no. '.$companyCode.'-'.$booingId.'  for GBP  '.$requestAmount.'  into '.$bankName;
//                $agentData['messageData']='Your card charge request has been sent for GBP '.$requestAmount.' for the File no BH-'.$booingId.'  into  '.$bankName.' <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
//                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
//                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
//                        ';
//                $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
//                //Mail to Agent
//                $this->load->library('email', $agentConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($agentEmail);
//                $this->email->subject($agentSubject);
//                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
//                $this->email->message($agentBody);  
//                $this->email->send();  
//                
//            }
//            else if($requestType=='Online')
//            {
//                $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Received for GBP '.$requestAmount;
//                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Sent for GBP '.$requestAmount;
//                $adminData['messageData']='You have received online payment checking request  for <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
//                $agentData['messageData']='Your online payment checking request has been sent for <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
//                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
//                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
//                        ';
//                $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
//                //Mail to Agent
//                $this->load->library('email', $agentConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($agentEmail);
//                $this->email->subject($agentSubject);
//                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
//                $this->email->message($agentBody);  
//                $this->email->send();
//                
//            }
//            else if($requestType=='Cash')
//            {
//                $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking  Request Received for GBP '.$requestAmount;
//                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Sent for GBP '.$requestAmount;
//                $adminData['messageData']='You have received cash payment checking request for  <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
//                $agentData['messageData']='Your cash payment checking request has been sent for  <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
//                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
//                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
//                        ';
//                $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
//                //Mail to Agent
//                $this->load->library('email', $agentConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($agentEmail);
//                $this->email->subject($agentSubject);
//                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
//                $this->email->message($agentBody);  
//                $this->email->send();
//            }
//            else if($requestType=='Cheque')
//            {
//                $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking  Request Received for GBP '.$requestAmount;
//                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Sent for GBP '.$requestAmount;
//                $adminData['messageData']='You have received cheque payment checking request for   <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
//                $agentData['messageData']='Your cheque payment checking request has been sent for  <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
//                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
//                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
//                        ';
//                $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
//                //Mail to Agent
//                $this->load->library('email', $agentConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($agentEmail);
//                $this->email->subject($agentSubject);
//                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
//                $this->email->message($agentBody);  
//                $this->email->send(); 
//            }
//            else if($requestType=='Other')
//            {
//                
//            }
//                $userEmail='addmin.bhttl@gmail.com';
//                $subject=$requestType.' Charge Request Received for BH-'.$booingId;
//                $config = Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//                $this->load->library('email', $config);
//                $this->email->set_newline("\r\n");
//                $this->email->from('notifications@brightholiday.co.uk', 'Bright HoliDay');
//                $data = array(
//                     'userName'=> 'Bright HolyDay',
//                     'messageData'=>'You Have Received A '.$requestType.' charge Request for BH-'.$booingId
//                         );
//                $this->email->to($userEmail);  // replace it with receiver mail id
//                $this->email->subject($subject); // replace it with relevant subject
//                $body = $this->load->view('template50.php',$data,TRUE);
//                $this->email->message($body);  
//                $this->email->send();
//                 $config2 = Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//                $this->load->library('email', $config2);
//                $this->email->set_newline("\r\n");
//                $this->email->from('notifications@brightholiday.co.uk', 'Bright HoliDay');
//            $agentMail=$agentEmail;
//            $subjectAgent=$requestType.' Charge Request Sent for BH-'.$booingId;
//            $dataAgent = array(
//                     'userName'=> 'Bright HolyDay',
//                     'messageData'=>'You Have Sent A '.$requestType.' charge Request for BH-'.$booingId
//                         );
//            $this->email->to($agentMail);  // replace it with receiver mail id
//            $this->email->subject($subjectAgent); // replace it with relevant subject
//            $bodyA = $this->load->view('template50.php',$dataAgent,TRUE);
//            $this->email->message($bodyA);  
//            $this->email->send();
           
            
            echo $resData;
        }
        else
        {
            echo 0;
        }
    }
    public function messageread()
    {
        $msgId=$this->input->post('messageIdDa');
        $messresp=$this->BaseModel->update('paymentRequest',array('isRead'=>1),array('id'=>$msgId));
        if($messresp >0)
        {
            echo $messresp;
        }
        else
            {
            echo 0;
            }
    }
    public function deleteMessage()
    {
        $messageId=  $this->input->post('messgId');
        $getData=$this->BaseModel->getWhereM('paymentRequest',array('id'=>$messageId));
        $getObj=$getData[0];
        $agentId=$getObj->requestFrom;
        $booingId=$getObj->booking_id;
        $requestDate=$getObj->requestDate;
        $requestReference=$getObj->requestReference;
        $requestAmount=$getObj->requestAmount;
        $requestBankId=$getObj->requestBank;
        $requestType=$getObj->requestType;
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $bankName=idToName('bank','id',$requestBankId,'bank_name');
        $resDelt=$this->BaseModel->del('paymentRequest',array('id'=>$messageId));
        $companyId=idToName('booking_details','id',$booingId,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $adminMailAddress='addmin.bhttl@gmail.com';
            $adminSubject='';
            $agentSubject='';
            $adminConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $agentConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $adminData=array(
                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
            );
            $agentData=array(
                'gerateing'=>'Dear '.$agentName.' Bright Holiday Ltd,'
            );
            $adminBody='';
            $agentBody='';
            $from='notifications@brightholiday.co.uk';
            $companyName='Bright HoliDay';
        if($resDelt >0)
        {
            if($requestRef=='Card')
            {
               $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Charge Request Deleted for GBP '.$requestAmount;
                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Charge Request Deleted for GBP '.$requestAmount;
                $adminData['messageData']='You have <b style="color:blue"> Deleted </b> card charge request  from the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'<b>  for <b style="color:blue">GBP  '.$requestAmount.'</b>  into <b style="color:blue">'.$bankName.'</b>';
                $agentData['messageData']='Your card charge request has been <b style="color:blue"> Deleted </b> by admin form  the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b> for <b style="color:blue">GBP '.$requestAmount.'</b>  into  <b style="color:blue">'.$bankName.'</b> <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();   
            }
            else if($requestRef=='Online')
            {
               $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Deleted for GBP '.$requestAmount;
                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Deleted for GBP '.$requestAmount;
                $adminData['messageData']='You have Deleted online payment checking request  for <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
                $agentData['messageData']='Your online payment checking request has been Deleted for <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send(); 
            }
            else if($requestRef=='Cash')
            {
                $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking  Request Deleted for GBP '.$requestAmount;
                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Deleted for GBP '.$requestAmount;
                $adminData['messageData']='You have Deleted cash payment checking request for  <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
                $agentData['messageData']='Your cash payment checking request has been Deleted for  <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();
            }
            else if($requestRef=='Cheque')
            {
               $adminSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking  Request Deleted for GBP '.$requestAmount;
                $agentSubject=$companyCode.'-'.$booingId.' '.$requestType.' Payment checking Request Deleted for GBP '.$requestAmount;
                $adminData['messageData']='You have Deleted cheque payment checking request for   <b style="color:blue">GBP  '.$requestAmount.'</b>  For  the File no. <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>   into  <b style="color:blue">'.$bankName.'</b>  with the Ref:<b style="color:blue">'.$requestReference.'</b>  on  <b style="color:blue">'.$requestDate.'</b>';
                $agentData['messageData']='Your cheque payment checking request has been Deleted for  <b style="color:blue">GBP '.$requestAmount.'</b> for the File no <b style="color:blue">'.$companyCode.'-'.$booingId.'</b>  into  <b style="color:blue">'.$bankName.'</b> with the Ref:<b style="color:blue">'.$requestReference.'</b> on  <b style="color:blue">'.$requestDate.'</b>  <br><br>In case of any error regarding Payment please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through <b style="color:blue">addmin.bhttl@gmail.com</b>
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();  
            }
            else if($requestRef=='Other')
            {
                
            }
            echo $resDelt;
        }
        else
        {
            echo 0;
        }
    }
    public function ticketOrder()
    {
        $bookingId=$this->input->post('bookingId');
        $bookingDetails=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $flightDetails=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $systemIternery=$flightDetails[0]->systemFlightDetails;
        $departed=  explode('-',$flightDetails[0]->departure);
        $destination=  explode('-',$flightDetails[0]->destination);
        $departDate=$flightDetails[0]->departure_date;
        $departedTime=$flightDetails[0]->departedTime;
        $returnDate=$flightDetails[0]->returnDate;
        $noOfSegment=$flightDetails[0]->number_Of_segment;
        $supplierReference=$bookingDetails[0]->supplier_ref;
        $supplierAgent=$bookingDetails[0]->supplier_name;
        $flightType=$bookingDetails[0]->flight_type;
        $threeLetter=  substr($supplierReference,0, 3);
        $date = new DateTime($departDate);
       $departedFormate=$date->format('d').strtoupper($date->format('M'));
        $date2=new DateTime($returnDate);
        $returnFormate=$date2->format('d').strtoupper($date2->format('M'));
        $errors=array();
        $outerPNR=idToName('flight_details','booking_id',$bookingId,'pnr');
       if($supplierAgent=='Brightsun Travel')
       {
           if($threeLetter=='IBE' || $threeLetter=='Ibe' || $threeLetter=='ibe')
           {
               
           }
           else
               {
               $errors[]='Err-1';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
               }
       }
       else if($supplierAgent=='Travel Pack')
        {
           $travelPAck=substr($threeLetter, 0, 1);
                   
           if(preg_match('/[a-zA-Z]+/', $travelPAck))
            {
               
            }
            else
            {
                  $errors[]='Err-2';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        else if($supplierAgent=='The Holiday Team')
        {
            if(is_numeric($supplierReference))
            {
               
            }
            else
            {
                  $errors[]='Err-3';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        else if($supplierAgent=='Med View Airline')
        {
            if(substr($threeLetter, 0, 2)=='AC' || substr($threeLetter, 0, 2)=='Ac' || substr($threeLetter, 0, 2)=='ac')
            {
               
            }
            else
            {
                  $errors[]='Err-4';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        if($noOfSegment >0)
        {
            
        }
        else
        {
              $errors[]='Err-5';
//            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number Of Segments Can not be Zero please Put the System Flight Details to correct It <br>";
        }
        if(ticketCost($bookingId) >0)
        {
            
        }
        else
        {
              $errors[]='Err-6';
//            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Payable Supplier Can Not be Zero <br>";
        }
        $remainng=(salePrice($bookingId)-sumOfAmount('payment','amount',array('pay_type'=>'Dr','booking_ref'=>$bookingId)));
        if($remainng==0)
        {
            
        }
        else
        {
            $countLeftB=$this->BaseModel->count('left_balance',array('bookeing_id'=>$bookingId,'flag'=>1));
            if($countLeftB==0)
            {
              $errors[]='Err-7';
            }
//            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Remaing Balance Should be Zero or less than Zero <br>";
        }
        $profit=(salePrice($bookingId)-((ticketCost($bookingId)+ticketCharges($bookingId))));
        if($profit < 0)
        {
            $negativeCount=$this->BaseModel->count('left_balance',array('bookeing_id'=>$bookingId,'flag'=>2));
            if($negativeCount==0)
            {
              $errors[]='Err-8';
            }
//             echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Profit Can not be Negative <br>"; 
        }
        else
        {
           
        }
        if(!empty($systemIternery))
        {
          $newString=preg_replace('/[^A-Za-z0-9\s]/', '',$systemIternery);
         $iteneryForPNR= preg_split('/\n/', $systemIternery);
         $pnrEntry=$iteneryForPNR[0];
         $onlyPnrs=explode('/', $pnrEntry);
         $pnr=$onlyPnrs[0];
           $flightArrayww= explode('. ', $systemIternery); 
            $departNoted='';
            $destNooo='';
            $dateMachDepart='';
            $returnMach='';
//            print_r($flightArrayww);
           foreach($flightArrayww as $key=>$item)
           {
               if($key==0)
                   {
                   
                   }
                   else
                   {
                       $nodeArray=explode(' ',$item);
                      
                       foreach($nodeArray as $key2=>$item2)
                       {
                           $pattern = '/\s*/m';
                            $replace = '';
                           $matcheCondition=str_replace(' ','',$item2);
//                           echo $matcheCondition.'items Shaid <br>';
                           $strg=substr($item2, 0, 3);
//                           echo $strg.'shahid <br>.'. $departed[0].' deprted';
                          $strgEnd=substr($item2, 3);
                          if($strg==$departed[0])
                          {
                              $departNoted=$item;
                          }
                          if($strgEnd==$destination[0])
                          {
                              $destNooo=$item;
                          }
                          if($departedFormate==$matcheCondition)
                          {
//                              echo $item2.'In condition';
                              $dateMachDepart=$item2;
                          }
                          if($returnFormate==$matcheCondition)
                          {
                             $returnMach=$item2;
                          }
                       }
                   }
           }
           if($departNoted=='')
           {
                 $errors[]='Err-9';
//               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your departed Airport does not match with your System Flight details <br>"; 
           }
           else
            {
               
            }
            if($flightType=='Return')
            {
                if($destNooo=='')
                {
                      $errors[]='Err-10';
     //               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your Returning  Airport does not match with your System Flight details <br>"; 
                }
                else
                {

                }
            }
           if($dateMachDepart=='')
           {
                 $errors[]='Err-11';
//               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your departed  Date does not match with your System Flight details <br>"; 
           }
           else
           {
               
           }
           if($flightType=='Return')
           {
                if($returnMach=='')
                {
                      $errors[]='Err-12';
     //                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your Returning  Date does not match with your System Flight details <br>"; 
                }
                else
                {

                }
           }
           if($outerPNR==$pnr)
           {
               
           }
           else
           {
              $errors[]='Err-14'; 
           }
        }
        else
        {
            $errors[]='Err-13'; 
        }
        echo implode('%', $errors);
    }
    public function ticketOrder2()
    {
        $bookingId=$this->input->post('bookingId');
        $bookingDetails=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $flightDetails=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $systemIternery=$flightDetails[0]->systemFlightDetails;
        $departed=  explode('-',$flightDetails[0]->departure);
        $destination=  explode('-',$flightDetails[0]->destination);
        $departDate=$flightDetails[0]->departure_date;
        $departedTime=$flightDetails[0]->departedTime;
        $returnDate=$flightDetails[0]->returnDate;
        $noOfSegment=$flightDetails[0]->number_Of_segment;
        $supplierReference=$bookingDetails[0]->supplier_ref;
        $supplierAgent=$bookingDetails[0]->supplier_name;
        $flightType=$bookingDetails[0]->flight_type;
        $threeLetter=  substr($supplierReference,0, 3);
        $date = new DateTime($departDate);
       $departedFormate=$date->format('d').strtoupper($date->format('M'));
        $date2=new DateTime($returnDate);
        $returnFormate=$date2->format('d').strtoupper($date2->format('M'));
        $errors=array();
        $outerPNR=idToName('flight_details','booking_id',$bookingId,'pnr');
       if($supplierAgent=='Brightsun Travel')
       {
           if($threeLetter=='IBE' || $threeLetter=='Ibe' || $threeLetter=='ibe')
           {
               
           }
           else
               {
               $errors[]='Err-1';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
               }
       }
       else if($supplierAgent=='Travel Pack')
        {
           if(substr($threeLetter, 0, 1)=='S' || substr($threeLetter, 0, 1)=='s')
            {
               
            }
            else
            {
                  $errors[]='Err-2';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        else if($supplierAgent=='The Holiday Team')
        {
            if(is_numeric($supplierReference))
            {
               
            }
            else
            {
                  $errors[]='Err-3';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        else if($supplierAgent=='Med View Airline')
        {
            if(substr($threeLetter, 0, 2)=='AC' || substr($threeLetter, 0, 2)=='Ac' || substr($threeLetter, 0, 2)=='ac')
            {
               
            }
            else
            {
                  $errors[]='Err-4';
//                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Supplier Name And Supplier Reference Does Not Match Plese Correct It First <br>";
            }
        }
        if($noOfSegment >0)
        {
            
        }
        else
        {
              $errors[]='Err-5';
//            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Number Of Segments Can not be Zero please Put the System Flight Details to correct It <br>";
        }
        if(ticketCost($bookingId) >0)
        {
            
        }
        else
        {
              $errors[]='Err-6';
//            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Payable Supplier Can Not be Zero <br>";
        }
        $remainng=(salePrice($bookingId)-sumOfAmount('payment','amount',array('pay_type'=>'Dr','booking_ref'=>$bookingId)));
//        if($remainng==0)
//        {
//            
//        }
//        else
//        {
//            $countLeftB=$this->BaseModel->count('left_balance',array('bookeing_id'=>$bookingId,'flag'=>1));
//            if($countLeftB==0)
//            {
//              $errors[]='Err-7';
//            }
////            echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Remaing Balance Should be Zero or less than Zero <br>";
//        }
        $profit=(salePrice($bookingId)-((ticketCost($bookingId)+ticketCharges($bookingId))));
        if($profit < 0)
        {
            $negativeCount=$this->BaseModel->count('left_balance',array('bookeing_id'=>$bookingId,'flag'=>2));
            if($negativeCount==0)
            {
              $errors[]='Err-8';
            }
//             echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Profit Can not be Negative <br>"; 
        }
        else
        {
           
        }
        if(!empty($systemIternery))
        {
          $newString=preg_replace('/[^A-Za-z0-9\s]/', '',$systemIternery);
         $iteneryForPNR= preg_split('/\n/', $systemIternery);
         $pnrEntry=$iteneryForPNR[0];
         $onlyPnrs=explode('/', $pnrEntry);
         $pnr=$onlyPnrs[0];
           $flightArrayww= explode('. ', $systemIternery); 
            $departNoted='';
            $destNooo='';
            $dateMachDepart='';
            $returnMach='';
//            print_r($flightArrayww);
           foreach($flightArrayww as $key=>$item)
           {
               if($key==0)
                   {
                   
                   }
                   else
                   {
                       $nodeArray=explode(' ',$item);
                      
                       foreach($nodeArray as $key2=>$item2)
                       {
                           $pattern = '/\s*/m';
                            $replace = '';
                           $matcheCondition=str_replace(' ','',$item2);
//                           echo $matcheCondition.'items Shaid <br>';
                           $strg=substr($item2, 0, 3);
//                           echo $strg.'shahid <br>.'. $departed[0].' deprted';
                          $strgEnd=substr($item2, 3);
                          if($strg==$departed[0])
                          {
                              $departNoted=$item;
                          }
                          if($strgEnd==$destination[0])
                          {
                              $destNooo=$item;
                          }
                          if($departedFormate==$matcheCondition)
                          {
//                              echo $item2.'In condition';
                              $dateMachDepart=$item2;
                          }
                          if($returnFormate==$matcheCondition)
                          {
                             $returnMach=$item2;
                          }
                       }
                   }
           }
           if($departNoted=='')
           {
                 $errors[]='Err-9';
//               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your departed Airport does not match with your System Flight details <br>"; 
           }
           else
            {
               
            }
            if($flightType=='Return')
            {
                if($destNooo=='')
                {
                      $errors[]='Err-10';
     //               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your Returning  Airport does not match with your System Flight details <br>"; 
                }
                else
                {

                }
            }
           if($dateMachDepart=='')
           {
                 $errors[]='Err-11';
//               echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your departed  Date does not match with your System Flight details <br>"; 
           }
           else
           {
               
           }
           if($flightType=='Return')
           {
            if($returnMach=='')
            {
                  $errors[]='Err-12';
 //                echo "<i class='fa fa-times' aria-hidden='true'></i>&nbsp;Your Returning  Date does not match with your System Flight details <br>"; 
            }
            else
            {

            }
           }
           if($outerPNR==$pnr)
           {
               
           }
           else
           {
              $errors[]='Err-14'; 
           }
        }
        else
        {
            $errors[]='Err-13'; 
        }
        echo implode('%', $errors);
    }
    public function passangerAdd()
    {
        $bookingId=$this->input->post('bookingId');
        $category=$this->input->post('category');
        $title=$this->input->post('title');
        $firstname=$this->input->post('firstName');
        $midelename=$this->input->post('middlename');
        $surname=$this->input->post('surname');
        $age=$this->input->post('agep');
        $saleprice=$this->input->post('saleprice');
        $bookingfee=$this->input->post('bookingfee');
        $passangerArray=array(
            'booking_id'=> $bookingId,
            'category'=>$category,
            'title'=>$title,
            'firstName'=>$firstname,
            'midle_name'=>$midelename,
            'sur_name'=>$surname,
            'age'=>$age,
            'salePrice'=>$saleprice,
            'booking_fee'=>$bookingfee
         );
        $respSave=$this->BaseModel->save('passanger_details',$passangerArray);
        if($respSave >0)
        {
            echo $respSave;
        }
        else{ echo 0; }
    }
    public function negativeRemarks()
    {
       $bookingId=$this->input->post('bookingId'); 
       $agentId=$this->input->post('agentId'); 
//       $positiveDate=$this->input->post('dateN'); 
//       $remarks=$this->input->post('agentremarks'); 
       $isReply=$this->input->post('isreplyN');
       $dateComeLetf=  $this->input->post('leftAmopuntComeDate');
       $dataArraySave=array(
           'bookeing_id'=>$bookingId,
           'remarks_by'=>$agentId,
           'flag'=>2,
           'isGetReplay'=>$isReply,
           'dateRemaingAmount'=>$dateComeLetf
       );
       $resp=$this->BaseModel->save('left_balance',$dataArraySave);
       if($resp >0)
       {
           echo $resp;
       }
       else{ echo 0; }
    }
    public function remaingRemarks()
    {
       $bookingId=$this->input->post('leftBalancebookingId'); 
       $ticketRefendAble=$this->input->post('refundAbleTicket'); 
       $customerReply=$this->input->post('customerEmailReply'); 
       $dateAmountCome=$this->input->post('amountComeDate'); 
       $agentRemarks=$this->input->post('agentNoteAboutLeftbalance'); 
       $agentId=$this->input->post('leftBalanceAgentId'); 
       $leftBalanceArray=array(
           'bookeing_id'=>$bookingId,
           'remarks_by'=>$agentId,
           'flag'=>1,
           'isGetReplay'=>$customerReply,
           'dateRemaingAmount'=>$dateAmountCome,
           'note'=>$agentRemarks,
           'refundable'=>$ticketRefendAble
       );
       $leftresp=$this->BaseModel->save('left_balance',$leftBalanceArray);
       if($leftresp >0){ echo $leftresp; } else{ echo 0; }
    }
    public function tOrderSend()
    {
        $bookingOfTickerOrder=$this->input->post('bookingOfTickerOrder');
        $ticketOrderpriorty=$this->input->post('ticketOrderpriorty');
        $ticketorderSupplierName=$this->input->post('ticketorderSupplierName');
        $ticlketorderSupplierRef=$this->input->post('ticlketorderSupplierRef');
        $ticketOrderGDS=$this->input->post('ticketOrderGDS');
        $ticketOrderPnr=$this->input->post('ticketOrderPnr');
        $ticketOrderIssueCost=$this->input->post('ticketOrderIssueCost');
        $ticketOrderagentMassage=$this->input->post('ticketOrderagentMassage');
        $ticketOrderSupplierEmail=$this->input->post('ticketOrderSupplierEmail');
        $brand=  $this->input->post('brand');
        $agentId=idToName('booking_details','id',$bookingOfTickerOrder,'booked_agent_id');
        $companyId=idToName('booking_details','id',$bookingOfTickerOrder,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $companyName=idToName('company','id',$companyId,'company_name');
        
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $ticketOrderSendArray=array(
            'booking_id'=>$bookingOfTickerOrder,
            'supplierName'=>$ticketorderSupplierName,
            'supplierReference'=>$ticlketorderSupplierRef,
            'supplierEmail'=>$ticketOrderSupplierEmail,
            'gds'=>$ticketOrderGDS,
            'pnr'=>$ticketOrderPnr,
            'message'=>$ticketOrderagentMassage,
            'issueCost'=>$ticketOrderIssueCost,
            'priorty'=>$ticketOrderpriorty,
            'agentId'=>$agentId,
            'isRead'=>0,
            'DateReq'=>date('Y-m-d'),
            'brand'=>$brand
        );
        $logData='Ticket Issuance Sent - '.$ticketorderSupplierName.' - '.$ticketOrderPnr.' - '.'&pound;'.$ticketOrderIssueCost.' - '.$companyCode.'-'.$bookingOfTickerOrder.'  '.$ticketOrderagentMassage;
        $resporder=$this->BaseModel->save('ticketOrderRequest',$ticketOrderSendArray);
       $this->BaseModel->save('event_history',array('booking_id'=>$bookingOfTickerOrder,'agent_id'=>$agentId,'event_type'=>'Auto','event'=>$logData,'flag'=>1));
        $adminMailAddress='admin@sufitravels.co.uk';
            $adminSubject='';
            $agentSubject='';
            $adminConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $agentConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $adminData=array(
                'gerateing'=>'Dear Admin '.$companyName.' Ltd,'
            );
            $agentData=array(
                'gerateing'=>'Dear '.$agentName.' '.$companyName.' Ltd,'
            );
            $adminBody='';
            $agentBody='';
            $from='info@sufitravelandtours.co.uk';
            //$companyName='Bright HoliDay';
             $adminSubject='Ticket Order Request For File Number '.$companyCode.'-'.$bookingOfTickerOrder;
                $agentSubject='Ticket Order Request For File Number '.$companyCode.'-'.$bookingOfTickerOrder;
                $adminData['messageData']='You have received ticket order request from the File no. '.$companyCode.'-'.$bookingOfTickerOrder.'  with PNR  '.$ticketOrderPnr.'  and ISSUED COST '.$ticketOrderIssueCost;
                $agentData['messageData']='Your ticket order request has been sent for the File no '.$companyCode.'-'.$bookingOfTickerOrder.'  with  PNR  '.$ticketOrderPnr.'  and ISSUED COST '.$ticketOrderIssueCost.' <br><br>In case of any error regarding ticket Order please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through admin@sufitravels.co.uk
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();  
            
        if($resporder >0){ echo $resporder; } else{ echo 0; }
    }
    public function ticketOrderDelete()
    {
        $ticketId=$this->input->post('ticktOrderId');
        $resDel=$this->BaseModel->del('ticketOrderRequest',array('id'=>$ticketId));
        if($resDel >0){ echo $resDel; } else { echo 0; }
    }
    public function ticketOrderRead()
    {
       $ticketOrderId=$this->input->post('ticketorderId'); 
       $booking_id=idToName('ticketOrderRequest','id',$ticketOrderId,'booking_id');
        $agentId=idToName('booking_details','id',$booking_id,'booked_agent_id');
        $companyId=idToName('booking_details','id',$booking_id,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentName=idToName('admin','id',$agentId,'login_name');
       $respDat=$this->BaseModel->update('ticketOrderRequest',array('isRead'=>1),array('id'=>$ticketOrderId));
       $adminMailAddress='addmin.bhttl@gmail.com';
            $adminSubject='';
            $agentSubject='';
            $adminConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $agentConfig=Array(       
                    'mailtype' => 'html',
                     'charset' => 'utf-8',
                     'priority' => '1'
                );
            $adminData=array(
                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
            );
            $agentData=array(
                'gerateing'=>'Dear '.$agentName.' Bright Holiday Ltd,'
            );
            $adminBody='';
            $agentBody='';
            $from='notifications@brightholiday.co.uk';
            $companyName='Bright HoliDay';
             $adminSubject='Ticket Order Request Confirmations For File Number '.$companyCode.'-'.$booking_id;
                $agentSubject='Ticket Order Request Confirmations For File Number '.$companyCode.'-'.$booking_id;
                $adminData['messageData']='You have  sent Ticket Order for the File no. '.$companyCode.'-'.$booking_id;
                $agentData['messageData']='Your Ticket Order has been sent for the File no '.$companyCode.'-'.$booking_id.' <br><br>In case of any error regarding ticket Order please inform to your admin department.<br><br>
                        This message was sent from a notification email address that does not accept incoming email. Please do not reply to this message.
                        If you have any question regarding your concern, please feel free to email us on admin through addmin.bhttl@gmail.com
                        ';
                $this->load->library('email', $adminConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($adminMailAddress);
                $this->email->subject($adminSubject);
                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
                $this->email->message($adminBody);  
                $this->email->send();
                //Mail to Agent
                $this->load->library('email', $agentConfig);
                $this->email->set_newline("\r\n");
                $this->email->from($from,$companyName);
                $this->email->to($agentEmail);
                $this->email->subject($agentSubject);
                $agentBody = $this->load->view('template50.php',$agentData,TRUE);
                $this->email->message($agentBody);  
                $this->email->send();
       if($respDat>0){ echo $respDat; } else { echo 0; }
    }
    public function agentNoteDelete()
    {
      $noteId=$this->input->post('noteId'); 
      $delResp=$this->BaseModel->del('left_balance',array('id'=>$noteId));
      if($delResp >0){ echo $delResp; } else{ echo 0; }
    }
    public function markAsPendingB()
    {
        $bookingId=$this->input->post('bookingId');
        $this->BaseModel->update('ticket_cost',array('file_status'=>1),array('booking_id'=>$bookingId));
        $resp=$this->BaseModel->update('booking_details',array('flag'=>1,'issue_date'=>'00:00:00','pending_status'=>'','pending_date'=>'','canceled_stat'=>'','cancel_date'=>''),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
        
    }
    public function cardCancelation()
    {
        $bookingId=  $this->input->post('bookingId');
        $bookingCardCancelled=  $this->input->post('cardcancellationDate');
        $todate=date('Y-m-d',strtotime($bookingCardCancelled));
        $this->BaseModel->update('ticket_cost',array('basic_fare'=>0,'tax'=>0,'apc'=>0,'totalcost'=>0),array('booking_id'=>$bookingId));
        $this->BaseModel->update('passanger_details',array('salePrice'=>0,'booking_fee'=>0,'eticket'=>''),array('booking_id'=>$bookingId));
       $resp= $this->BaseModel->update('booking_details',array('supplier_ref'=>'Card Cancellation','flag'=>3,'canceled_stat'=>1,'cancel_date'=>$todate),array('id'=>$bookingId));
       if($resp>0){ echo $resp; }else{ echo 0; }
         
    }
    public function cashCancelation()
    {
        $bookingId=$this->input->post('bookingIds');
        $cashCancelledDateConfirm=$this->input->post('cashcancelledDateConfirm');
        $todate=date('Y-m-d',strtotime($cashCancelledDateConfirm));
        $this->BaseModel->update('ticket_cost',array('basic_fare'=>0,'tax'=>0,'apc'=>0,'totalcost'=>0),array('booking_id'=>$bookingId));
        $this->BaseModel->update('passanger_details',array('salePrice'=>0,'booking_fee'=>0,'eticket'=>''),array('booking_id'=>$bookingId));
       $resp= $this->BaseModel->update('booking_details',array('supplier_ref'=>'Cash Cancellation','flag'=>3,'canceled_stat'=>1,'cancel_date'=>$todate),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
    }
    public function  cashCancelCommentCheck()
    {
        $bookingId=  $this->input->post('bookingId');
        $countCheck=countTotal('refund_remrks',array('booking_id'=>$bookingId,'flag'=>4));
        echo $countCheck;
    }
    public function CardCancelCommentCheck()
    {
        $bookingId=  $this->input->post('bookingId');
        $countCheck=countTotal('refund_remrks',array('booking_id'=>$bookingId,'flag'=>3));
        echo $countCheck;
    }
    public function cardCancelledRemarks()
    {
       $bookingId=  $this->input->post('bookingId');
       $agentId=  $this->input->post('agentId');
       $pnrExire= $this->input->post('pnrExpir');
       $remarks=  $this->input->post('cardcanledremarks');
       $resp=$this->BaseModel->save('refund_remrks',array('booking_id'=>$bookingId,'agentId'=>$agentId,'remarks_date'=>date('Y-m-d'),'remarks_type'=>'Card Cancellation','remarks_details'=>$remarks,'flag'=>3,'pnrTicketOrderCancelled'=>$pnrExire));
       if($resp >0){ echo $resp; } else{ echo 0; }
       
    }
    public function cashCancelledRemarks()
    {
       $bookingId=  $this->input->post('bookingId');
       $agentId=  $this->input->post('agentId');
       $pnrExire= $this->input->post('pnrExpir');
       $remarks=  $this->input->post('cardcanledremarks');
       $resp=$this->BaseModel->save('refund_remrks',array('booking_id'=>$bookingId,'agentId'=>$agentId,'remarks_date'=>date('Y-m-d'),'remarks_type'=>'Cash Cancellation','remarks_details'=>$remarks,'flag'=>4,'pnrTicketOrderCancelled'=>$pnrExire));
       if($resp >0){ echo $resp; } else{ echo 0; } 
    }
    public function refundRemarksAgent()
    {
       $bookingId=  $this->input->post('bookingId');
       $agentId=  $this->input->post('agentId');
       $pnrExire= $this->input->post('pnrExpir');
       $remarks=  $this->input->post('cardcanledremarks');
       $resp=$this->BaseModel->save('refund_remrks',array('booking_id'=>$bookingId,'agentId'=>$agentId,'remarks_date'=>date('Y-m-d'),'remarks_type'=>'Refund','remarks_details'=>$remarks,'flag'=>5,'pnrTicketOrderCancelled'=>$pnrExire));
       if($resp >0){ echo $resp; } else{ echo 0; }  
    }
    public function chargebackRemarksAgent()
    {
       $bookingId=  $this->input->post('bookingId');
       $agentId=  $this->input->post('agentId');
       $pnrExire= $this->input->post('pnrExpir');
       $remarks=  $this->input->post('chargeBackremarks');
       $resp=$this->BaseModel->save('refund_remrks',array('booking_id'=>$bookingId,'agentId'=>$agentId,'remarks_date'=>date('Y-m-d'),'remarks_type'=>'Charge Back','remarks_details'=>$remarks,'flag'=>6,'pnrTicketOrderCancelled'=>$pnrExire));
       if($resp >0){ echo $resp; } else{ echo 0; }  
    }
    public function refundCommentCheck()
    {
        $bookingId=  $this->input->post('bookingId');
        $countCheck=countTotal('refund_remrks',array('booking_id'=>$bookingId,'flag'=>5));
        echo $countCheck;
    }
    public function refundMarks()
    {
        $bookingId=$this->input->post('bookingIds');
        $refundBookindDateConfirm=$this->input->post('refundBookingDateConfirm');
        $todate=date('Y-m-d',strtotime($refundBookindDateConfirm));
        $this->BaseModel->update('ticket_cost',array('basic_fare'=>0,'tax'=>0,'apc'=>0,'totalcost'=>0),array('booking_id'=>$bookingId));
        $this->BaseModel->update('passanger_details',array('salePrice'=>0,'booking_fee'=>0,'eticket'=>''),array('booking_id'=>$bookingId));
        $resp= $this->BaseModel->update('booking_details',array('supplier_ref'=>'Refunded','flag'=>3,'canceled_stat'=>1,'cancel_date'=>$todate),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
    }
    public function ChargeBackCommentCheck()
    {
        $bookingId=  $this->input->post('bookingId');
        $countCheck=countTotal('refund_remrks',array('booking_id'=>$bookingId,'flag'=>6));
        echo $countCheck;
    }
    public function markChargeBack()
    {
       $bookingId=$this->input->post('bookingIds');
       $chargeBackDateConfirm=$this->input->post('chargeBackDateConfirm');
        $todate=date('Y-m-d',strtotime($chargeBackDateConfirm));
        $this->BaseModel->update('ticket_cost',array('basic_fare'=>0,'tax'=>0,'apc'=>0,'totalcost'=>0),array('booking_id'=>$bookingId));
        $this->BaseModel->update('passanger_details',array('salePrice'=>0,'booking_fee'=>0,'eticket'=>''),array('booking_id'=>$bookingId));
        $resp= $this->BaseModel->update('booking_details',array('supplier_ref'=>'Refunded','flag'=>3,'canceled_stat'=>1,'cancel_date'=>$todate),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; } 
    }
    public function markpendinfTaskTopendingBooking()
    {
        $bookingId=$this->input->post('bookingId');
        $resp= $this->BaseModel->update('booking_details',array('red_flag'=>0),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; } 
    }
    public function cardreceived()
    {
        $bookingId=$this->input->post('bookingId');
        $cardStatus=$this->input->post('Cardstatus');
        $dateentry=date('Y-m-d');
        $res=$this->BaseModel->count('card_charge_Status',array('booking_id'=>$bookingId));
        if($res >0)
        {
           $ddd=$this->BaseModel->update('card_charge_Status',array('paid_status'=>$cardStatus,'received_date'=>$dateentry),array('booking_id'=>$bookingId));
        }
        else
        {
            $ddd=$this->BaseModel->save('card_charge_Status',array('booking_id'=>$bookingId,'paid_status'=>$cardStatus,'received_date'=>$dateentry));
        }
        if($ddd >0)
            {
             echo $ddd;
            }
            else{ echo 0; }
    }
    public function cardRecordReceived()
    {
        $cardReceivedDate=$this->input->post('cardRecivedDate');
        $fileComment=$this->input->post('file_comment');
        $cardAmount=$this->input->post('cardAmount');
        $receivedFor=$this->input->post('receivedFor');
        $leftAmount=$this->input->post('leftAmount');
        $calaimaAbleAmount=$this->input->post('calaimaAbleAmount');
        $res=$this->BaseModel->save('card_amount_received',array('date_received'=>$cardReceivedDate,'file_comment'=>$fileComment,'amount'=>$cardAmount,'received_for'=>$receivedFor,'claimable_amount'=>$calaimaAbleAmount,'left_amount'=>$leftAmount));
        if($res >0)
        { 
            echo $res;
        }
        else
        {
            echo 0;
        }
    }
    public function paymentCheckRequest()
    {
        $bookingId=$this->input->post('bookingId');
        $reqAmount=$this->input->post('paymentAmount');
        $paymentRef=$this->input->post('paymentref');
        $resultReq=$this->BaseModel->counDataRecord('paymentRequest',array('booking_id'=>$bookingId,'requestReference'=>$paymentRef,'requestAmount'=>$reqAmount,'isRead'=>0));
//        exit();
        if($resultReq >0)
        {
            echo $resultReq;
        }
        else{ echo 0; }
    }
    public function ticketOrderDataPoplate()
    {
       $bookingId=$this->input->post('bookingId');
       $supplierName=idToName('booking_details','id',$bookingId,'supplier_name');
       $supplierRef=idToName('booking_details','id',$bookingId,'supplier_ref');
       $gds=idToName('flight_details','booking_id',$bookingId,'gds');
       $pnr=idToName('flight_details','booking_id',$bookingId,'pnr');
       $ticketCost=ticketCost($bookingId);
       $supplierData=idToName('booking_details','id',$bookingId,'supplier_name');
       $supplierEmail=idToName('suppliers','supplier_name',$supplierData,'to_email');
//       $ticketCost=salePrice($bookingId);
       echo $supplierName.'%'.$supplierRef.'%'.$gds.'%'.$pnr.'%'.$ticketCost.'%'.$supplierEmail;
    }
    public function getBanksData()
    {
        $response=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $option="<option value=''>--Select One--</option>";
        if($response)
        {
            foreach($response as $obj)
            {
               $option.="<option value='".$obj->id."'>".$obj->bank_name."</option>"; 
            }
        }
        echo $option;
    }
    public function agentModalDataGet()
    {
        $agentId=$this->input->post('agentId');
        $Qry="Select * from admin where id='$agentId' ";
        $result=$this->BaseModel->getQuery($Qry);
        if(count($result)>0)
        {
            $array=$result[0];
            echo json_encode($array);
        }
        else
        {
            echo 0;
        }
//        print_r($result);
    }
    public function getSupplierData()
    {
        $supplierId=  $this->input->post('supplierId');
        $Qry="Select * from suppliers where id='$supplierId' ";
        $result=$this->BaseModel->getQuery($Qry);
        if(count($result)>0)
        {
            $array=$result[0];
            echo json_encode($array);
        }
        else
        {
            echo 0;
        }
    }
    public function supplierCostGet()
    {
        $bookingId=  $this->input->post('bookingId');
       echo round(ticketCost($bookingId),2);
        
    }
    public function getTrasectionEdit()
    {
        $trasectionId=  $this->input->post('transectionId');
        $response=$this->BaseModel->getWhereM('payment',array('transectionId'=>$trasectionId));
        echo json_encode($response);
    }
    public function resendDeailsGet()
    {
        $bookingId=  $this->input->post('bookingId');
        $bookingData=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $agentId=$bookingData[0]->booked_agent_id;
        $companyId=$bookingData[0]->company;
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentLine=idToName('admin','id',$agentId,'cell');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $companyName=idToName('company','id',$companyId,'company_name');
        $customerEmail=idToName('customer_contacts','booking_id',$bookingId,'email');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $pnr=idToName('flight_details','booking_id',$bookingId,'pnr');
        $airlineLocator=idToName('flight_details','booking_id',$bookingId,'airlineLocatore');
        $passengerDetails=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $iteneryDetails= strip_tags(html_entity_decode(idToName('flight_details','booking_id',$bookingId,'ticketDetails')));
        $totalSalePrice=salePrice($bookingId);
        $bankPayment=bankPayment($bookingId);
        $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId));
         $toatalReceived= $bankPayment+$cardAmount;    
         $remaining=$totalSalePrice-$toatalReceived;
         $passangerRoww='';
         $termsCondition=  $this->getTermsCondition();
         if(!empty($passengerDetails))
        {
             foreach($passengerDetails as $pObj)
                 {
                 $passangerRoww.='<tr>
                                    <td>'.$pObj->title.'</td>
                                    <td>'.$pObj->firstName.'</td>
                                    <td>'.$pObj->midle_name.'</td>
                                    <td>'.$pObj->sur_name.'</td>
                                    <td>'.$pObj->age.'</td>
                                    <td>'.$pObj->category.'</td>
                                    <td align="center">'.$pObj->salePrice.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">'.$pObj->booking_fee.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">0.00</td>
                                </tr>';
                 }
        }
        $internalMessage='Dear customer your flight schedule is changed as requested. Details are as follow:<br><br>
            <table cellpadding="0" border="0" width="325" class="width500">
                   <tbody>
                        <tr>
                           <td width="200" class="width200">Customer Name:</td>
                           <td>'.$customerName.'</td>
                        </tr>
                        <tr>
                           <td width="200" class="width200">Order Reference:</td>
                           <td>'.$companyCode.'-'.$bookingId.'</td>
                        </tr>
                        <tr>
                           <td width="200" class="width200">Total Price:</td>
                           <td>&pound;'.$totalSalePrice.'</td>
                        </tr>
                        <tr>
                           <td width="200" class="width200">Total Received:</td>
                           <td>&pound;'.$toatalReceived.'</td>
                        </tr>
                        <tr>
                           <td width="200" class="width200">Remaining Balance:</td>
                           <td>&pound;'.$remaining.'</td>
                        </tr>
                    </tbody>
            </table>
            <table cellpadding="0" border="0" width="850" class="width850">
                <tbody>
                    <tr>
                       <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                       <td colspan="6">
                          <b><u>Passenger &amp; Sale Price Details:</u></b>
                       </td>
                    </tr>
                    <tr>
                       <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                       <td><b>Title</b></td>
                       <td><b>First Name</b></td>
                       <td><b>Middle Name</b></td>
                       <td><b>Surname</b></td>
                       <td><b>Age(yrs)</b></td>
                       <td><b>Catagory</b></td>
                       <td><b>Basic (£)</b></td>
                       <td><b>Tax (£)</b></td>
                       <td><b>Booking Fee (£)</b></td>
                       <td><b>C. Card Charges (£)</b></td>
                       <td><b>Others (£)</b></td>
                    </tr>
                    '.$passangerRoww.'
                    <tr>
                       <td>&nbsp;</td>
                    </tr>
                    <tr>
                       <td colspan="6" bgcolor="#eee"><b>Total Sale Price:</b></td>
                       <td colspan="5" bgcolor="#eee"><b>&pound;'.$totalSalePrice.'</b></td>
                    </tr>
                </tbody>
            </table>
            <table cellpadding="0" border="0" width="500" class="width500">
                <tbody>
                   <tr>
                      <td colspan="2">&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="2">
                         <b><u>Proposed Flight:</u></b>
                      </td>
                   </tr>
                </tbody>
            </table>
             <p>
                Flight Itinerary/Schedule is given below. It is requested you to review it in detail.
             </p>
            <table class="width500" cellpadding="0" border="0" width="500">
                <tbody>
                   <tr>
                      <td width="200" class="width200">Passengers Reference(PNR):</td>
                      <td>'.$pnr.'</td>
                   </tr>
                   <tr>
                      <td width="200" class="width200">Airline Locator:</td>
                      <td>'.$airlineLocator.'</td>
                   </tr>
                </tbody>
            </table>
            <p>
                For any information you can contact directly to your concerned agent <b>'.$agentName.'</b> on <b>'.$agentLine.'</b> or at <b>'.$agentEmail.'</b></b>.    
            </p>
           
            <br>
                With regards,<br><br>
            <b>
                '.$agentName.'<br>
                Travel Consultant<br>
                '.$companyName.'<br>
                Email: '.$agentEmail.'<br>
                Phone: '.$agentLine.' 
            </b>
             <br><br><br>
            <hr>
            <table cellpadding="0" border="0" width="260">
               <tbody>
                  <tr>
                     <td colspan="2"><br>
                        <b><u>Flight Itinerary/Schedule</u></b>
                     </td>
                  </tr>
               </tbody>
            </table>
            <pre>'.$iteneryDetails.'</pre>
            <br><br>
            <hr>
            '.$termsCondition;
//        $respArray=array('agentEmail'=>$agentEmail,'customerEmail'=>$customerEmail,'detailsData'=>$iteneryDetails,'bookingNum'=>$bookingId);
        $emailSubject='Requested Change In Flight Schedule - Order Reference:'.$companyCode.'-'.$bookingId;
        $respArray=array('subjectEmail'=>$emailSubject,'agentEmail'=>$agentEmail,'customerEmail'=>$customerEmail,'detailsData'=>$internalMessage,'bookingNum'=>$bookingId);
        echo json_encode($respArray,true);
        exit();
    }
    public function getNotificationData()
    {
       $bookingId=$this->input->post('bookingId');
        $termsCondition=  $this->getTermsCondition();
        $bookingData=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $agentId=$bookingData[0]->booked_agent_id;
        $companyId=$bookingData[0]->company;
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentLine=idToName('admin','id',$agentId,'cell');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $customerEmail=idToName('customer_contacts','booking_id',$bookingId,'email');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $loginId=$this->session->userdata('userId');
        $loginpersoneEmail=idToName('admin','id',$loginId,'email');
        $loginPersoneNumber=idToName('admin','id',$loginId,'cell');
        $loginPersoneName=idToName('admin','id',$loginId,'full_name');
        $loginCompanyId=idToName('admin','id',$loginId,'company');
        $loginCompanyName=idToName('company','id',$loginCompanyId,'company_name');
        $qryForrequest="Select * from paymentRequest where booking_id='$bookingId' AND isRead='0' ";
        $resultQry=  $this->BaseModel->getQuery($qryForrequest);
       // $internalMessage=$termsCondition;
        $subject='Refund Notification - Order Reference:'.$companyCode.'-'.$bookingId;
        $internalMessage='Dear customer, this is just to notify you that we have refunded &pound;'.$resultQry[0]->requestAmount.' against your order reference '.$companyCode.'-'.$bookingId.'.<br>
                                   <p>
                                      For any information you can contact directly to your concerned agent <b>'.$agentName.'</b> on <b>'.$agentLine.'</b> or at <b>'.$agentEmail.'</b> or to our sales team on <b>'.$loginPersoneNumber.'</b>.    
                                   </p>
                                   <br>
                                   With regards,<br><br>
                                   <b>
                                   '.$loginPersoneName.'<br>
                                  '.$loginCompanyName.'<br>
                                   Email:'.$loginpersoneEmail.'<br>
                                   Phone: '.$loginPersoneNumber.'<br>
                                   </b> 
                                   <hr> '.$termsCondition;
        $respArray=array('subjectEmail'=>$subject,'emailFrom'=>$loginpersoneEmail,'agentEmail'=>$agentName,'customerEmail'=>$customerEmail,'detailsData'=>$internalMessage,'bookingNum'=>$bookingId);
        echo json_encode($respArray,true);
        exit();
    }
    public function getTermsCondition()
    {
        $terms='<table style="width: 100%" >
                                           <tbody>
                                               <tr>
                                                   <td>
                                                       <h2>Terms & Conditions</h2>
                                                       <p>Please read these carefully as the person making this booking (either for him selves or for any other passenger) accepts all the below terms and conditions of Sufi Travel.</p>
                                                       <br>
                                                       <h4>Deposite & Tickets Are Either Refundable Nor Changeable</h4>
                                                       <p>(Terms & Conditions May Apply). Unless Specified, All the deposits paid and tickets purchased / issued are non refundable in case of cancellation or no show (Failure to arrive at departure airport on time) and non changeable before or after departure (date change is not permitted). Once flights reserved, bookings / tickets are non-transferable to any other person means that name changes are not permitted. Issued Tickets are also not re-routable. If you are reserving the flight by making the advance partial payment (Initial deposit) then please note that fare/taxes may increase at any time without the prior notice. It means the price is not guaranteed unless ticket is issued because airline / consolidator has right to increase the price due to any reason. In that case we will not be liable and passenger has to pay the fare/tax difference. We always recommend you to pay ASAP and get issue your ticket to avoid this situation. Further more if you will cancel your reservation due to any reason, then the paid deposit(s) will not be refunded.</p>
                                                       <br>
                                                       <h4>Checking All Flight Details & Passenger Name</h4>
                                                       <p>It is your responsibility to check all the details are correct i.e. Passenger names (are same as appearing on passport / travel docs), Travelling dates, Transit Time, Origin & Destination, Stop Over, Baggage Allowance and other flight information and reply us within 24 Hours and make pyment to void any extra charge. If you cancel the booking for any reason there will be cancelation charges £ 98 each pessenger. Once the ticket is issued then no changes can be made.</p>
                                                       <br>
                                                       <h4>Passport, Visa & Immigration Requiremens</h4>
                                                       <p>You are responsible for checking all these items like Passport, Visa (including Transit Visa) and other immigration requirements. You must consult with the relevant Embassy / Consulate, well before the departure time for the up to date information as requirements may change time to time. We regret, we can accept any liability of any transit visa and if you are refused the entry onto the flight or into any country due to failure on your part to carry the correct passport, visa or other documents required by any airline, authority or country.</p>
                                                       <br>
                                                       <h4>Reconfirming Return/Onward Flight</h4>
                                                       <p>It is your responsibility to RECONFIRM your flights at least 72 hours before your departure time either with your travel agent or the relevant Airline directly. The company will not be liable for any additional costs due to your failure to reconfirm your flights.</p>
                                                       <br>
                                                       <h4>Reconfirming Return/Onward Flights</h4>
                                                       <p>It is your responsibility to RECONFIRM your flights at least 72 hours before your departure time either with your travel agent or the relevant Airline directly. The company will not be liable for any additional costs due to your failure to reconfirm your flights.</p>
                                                       <br>
                                                       <h4>Special Requests And Medical Problems</h4>
                                                       <p>If you have any special requests like meal preference, Seat Allocation and wheel chair request etc, please advise us at time of issuance of ticket. We will try our best to fulfill these by passing this request to relevant airline but we cannot guarantee and failure to meet any special request will not held us liable for any claim.</p>
                                                       <br>
                                                       <h4>Very Important</h4>
                                                       <p>ABC union inc. do not accept responsibility for any financial loss if the airline fails to operate. Passengers will be solely responsible for that so it is highly recommended that separate travel insurance must be arranged to protect yourself.</p>
                                                       <br>
                                                       <h4>Reserving Your Holiday</h4>
                                                       <p>On receipt of your request and deposit we will confirm you booking and from that point cancellation charges will apply, and send you a confirmation with details of your arrangements. Please note that a telephone booking confirmation is as firmly confirmed as if it were made/confirmed in writing at that time.</p>
                                                       <br>
                                                       <h4>Price Guarantee</h4>
                                                       <p>As scheduled airlines reserve the right to increase prices at any time the price shown on this confirmation invoice will ONLY be guaranteed once full payments is received before due date of payment. The payment of a deposit guarantees your seat, not the price.</p>
                                                       <br>
                                                       <h4>Minor Changes To Your Holiday</h4>
                                                       <p>If we are obliged to make any minor change in the arrangements for your holiday we will inform you as soon as possible.</p>
                                                       <br>
                                                       <h4>Major Changes To Your Holiday</h4>
                                                       <p>If before you depart we have to make any major change to your holiday arrangements e.g. change of departure time of more than 12 hours, change of airport(but excluding changes between airports in London region, aircraft type airline) it will only be because we are forced to do so by circumstances usually beyond our control. In such an unlikely event we will inform you immediately and our objective will be to minimise your inconvenience. We will wherever possible offer you alternative arrangements as close as possible to your original choice. You will then have a choice of accepting, taking another available holiday of similar price or cancelling. Should you choose to cancel you will be reimbursed all monies paid to us.</p>
                                                       <br>
                                                       <h4>Group Holidays</h4>
                                                       <p>Some of our holidays are based on minimum number of participants and in the unlikely event that these numbers are not reached we reserve the right to cancel the tour and refund all payments made. Prices are subject to increase if the group size is reduced.</p>
                                                       <br>
                                                       <h4>Flights</h4>
                                                       <p>Details of airlines, flight numbers/schedules and destination airport will be shown on your invoice/confirmation. We regret we are unable to guarantee specific aircraft types or airline.</p>
                                                       <br>
                                                       <h4>Insurance</h4>
                                                       <p>The Company strongly recommend that the Client takes out adequate insurance. The Client is herewith recommended to read the terms of any insurance effected to satisfy themselves as to the fitness of cover. The Company will be pleased to quote you for insurance. Should insurance be declined you will be asked to sign our indemnity form.</p>
                                                       <br>
                                                       <h4>Making A Booking</h4>
                                                       <p>The person making the booking becomes responsible to The Company for the payment of the total price of the arrangements for all passengers shown on the invoice.</p>
                                                       <br>
                                                       <h4>Changing Your Arrangments</h4>
                                                       <p>If you wish to change any item – other than increasing the number of persons in your party – and providing we can accommodate the change, you will have to pay an Amendment Fee per person. These fees can vary greatly and will be advised at the time changes are made. Changes must be confirmed to us in writing. From time to time we are required to collect additional taxes and surcharges.</p>
                                                       <br>
                                                       <h4>Canellation</h4>
                                                       <p>Should you or any member of your party be forced to cancel you holiday, we must be notified, in writing, by the person who made the booking and who is therefore responsible for the payment. of the cancellation charges. Cancellation charges are calculated from the date we receive the written notice of cancellation.</p>
                                                       <br>
                                                       <h4>Amount of cancellation charge (shown as a % total holiday cost)</h4>
                                                       <p>DEPOSITS ARE COMPLETELY NON-REFUNDABLE IF THE PAX WISHES TO CANCEL THE BOOKING OR FAILS TO PAY REMAINING BALANCE ON TIME.</p>
                                                       <p>More Than 42 days . . . . . . . . . . . . . . . . . . . Deposit</p>
                                                       <p>29-42 days . . . . . . . . . . . . . . . . . . . . . . . . . . . 50%</p>
                                                       <p>15-28 days . . . . . . . . . . . . . . . . . . . . . . . . . . . 70%</p>
                                                       <p>8-14 days . . . . . . . . . . . . . . . . . . . . . . . . . . . . 90%</p>
                                                       <p>1-7 days . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 100%</p>
                                                       <h4>Travel Insurance Premiums are not refundable</h4>
                                                       <br>
                                                       <h4>Cancellation After Ticket Issue</h4>
                                                       <p>Will result in loss of 100% of total cost of all travel arrangements in most cases. Please consult your reservation adviser. Charter flights carry a 100% cancellation fee both before and after ticket issue.</p>
                                                       <br>
                                                       <h4>Complaints</h4>
                                                       <p>If you have a problem during your holiday, it is a legal requirement that you inform the property owner/hotel management/our local agent who will endeavour to resolve the situation. If your complaint cannot be sorted out locally you must obtain written confirmation that the complaint was lodged. You must follow this up within 28days of your return home in writing to us with all the relevant details. If you fail to follow this procedure, it may make it impossible to investigate your complaint fully.</p>
                                                       <br>
                                                       <h4>Legal Jurisdiction</h4>
                                                       <p>We accept the jurisdiction of the Courts in any part of the UK in which the client is domiciled. For clients not domiciled in the UK the Court of England shall have sole jurisdiction.</p>
                                                   </td>
                                               </tr>
                                           </tbody>
                                       </table>';
        return $terms;
    }
    public function doResendDone()
    {
        $bookingId=$this->input->post('hiddenBooking');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $file=$_FILES['attachment'];
//        print_r($file);
        $EmailConfig=Array(
//                     'priority' => '1',
//                     'protocol'  => 'smtp',
//                    'smtp_host' => 'smtp.zoho.eu',
//                    'smtp_port' => 465,
//                    'smtp_user' => 'admin@brightholiday.co.uk',
//                    'smtp_pass' => 'vl[lkp2a6TVH',
//                    'mailtype'  => 'html',
//                    'charset'   => 'utf-8'
            'mailtype' => 'html',
            'charset' => 'utf-8',
//            'charset' => 'iso-8859-1',
            'priority' => '1'
                     
                );
         $mailData=array(
                'gerateing'=>'Dear  '.$customerName.','
            );
            $EmailBody='';
            $this->load->library('email',$EmailConfig);
//            $ggg=$this->email->initialize($EmailConfig);
           
            //$testTo='shahidaslam448@gmail.com';
            $testTo=  $this->input->post('resendTo');
//            $testTo='admin@brightholiday.co.uk';
            $from=$this->input->post('resendFrom');
            //$from='info@sufitravelandtours.co.uk';
            $companyName=idToName('company','id',$companyId,'company_name');
            $companyCode=idToName('company','id',$companyId,'company_Code');
            $eSubject=$this->input->post('resendSubject');
            $mailData['messageData']= $this->input->post('resendMessage');
            //print_r($mailData);
            //$mailData['messageData']='Please complete all manuel messages coming from agents requests and automated messages coming from pending tasks actions';
            //$mailData['messageData']='Helo Shahid';
            
            $this->email->set_newline("\r\n");
            $this->email->from($from,$companyName);
            $this->email->to($testTo);
            $this->email->subject($eSubject);
            $EmailBody = $this->load->view('template50.php',$mailData,true);
            $this->email->message($EmailBody);  
            if(!empty($file['name']))
            {
                
                $uploaddir = './upload/file/';
//                $deleteP=basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                $deleteP=basename($_FILES['attachment']['name']);
                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
//                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
                $this->email->attach($uploadfile);
            }
//            print_r($EmailBody);
           $resp=$this->email->send();  
          unlink($uploadfile);
         echo  $resp;
//          $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//        // Additional headers
//       
//        $headers .= 'From: '.$from;
//        $mailfrom = 'From:'.$from;
//        $mailfrom .= "MIME-Version: 1.0\r\n";
//        $mailfrom .= "Content-Type: text/html; charset=UTF-8\r\n";
//      echo $resultE=sendEmail($from,$testTo,$EmailBody,' ');
//           mail($testTo,$eSubject,$EmailBody,$mailfrom);
//          $adminMailAddress="shahidaslam448@gmail.com";
//          $adminConfig=Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//				 $adminData=array(
//                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
//            );
//			 $from='notifications@brightholiday.co.uk';
//            $companyName='Bright HoliDay';
//			 $adminSubject="Test from me";
//			 
//			 $adminData['messageData']='helo dear friends';
//			 
//			  $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
                
    }
    
    public function doSendReceipt()
    {
        $bookingId=$this->input->post('bookingIdhidenSendReceipt');
        $loginId=$this->session->userdata('userId');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $companyIdLogin=idToName('admin','id',$loginId,'company');
        $file=$_FILES['attachment'];
        $EmailConfig=Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
                     
                );
         $mailData=array(
                'gerateing'=>'Dear  '.$customerName.','
            );
            $EmailBody='';
            $this->load->library('email',$EmailConfig);
            $testTo=  $this->input->post('sendReceiptTo');
            $from=$this->input->post('sendReceiptFrom');
            $companyName=idToName('company','id',$companyIdLogin,'company_name');
            $eSubject=$this->input->post('sendReceiptSubject');
            $mailData['messageData']= $this->input->post('receiptSendMessage');
            
            $this->email->set_newline("\r\n");
            $this->email->from($from,$companyName);
            $this->email->to($testTo);
            if(!empty($this->input->post('sendReceiptCc')))
            {
                $this->email->cc($this->input->post('sendReceiptCc'));
            }
            $this->email->subject($eSubject);
            $EmailBody = $this->load->view('template50.php',$mailData,true);
            $this->email->message($EmailBody);  
            if(!empty($file['name']))
            {
                
                $uploaddir = './upload/file/';
//                $deleteP=basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                $deleteP=basename($_FILES['attachment']['name']);
                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
//                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
                $this->email->attach($uploadfile);
            }
           $resp=$this->email->send();  
          unlink($uploadfile);
          $event='Payment receipt sent to the customer.';
          $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Auto','agent_id'=>$loginId,'flag'=>1,'event'=>$event));
         echo  $resp;
                
    }
    public function doSendReceipt2()
    {
        $bookingId=$this->input->post('bookingIdhidenSendReceipt');
        $loginId=$this->session->userdata('userId');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $companyIdLogin=idToName('admin','id',$loginId,'company');
        $file=$_FILES['attachment'];
        $EmailConfig=Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
                     
                );
         $mailData=array(
                'gerateing'=>'Dear  '.$customerName.','
            );
            $EmailBody='';
            $this->load->library('email',$EmailConfig);
            $testTo=  $this->input->post('sendReceiptTo');
            $from=$this->input->post('sendReceiptFrom');
            $companyName=idToName('company','id',$companyIdLogin,'company_name');
            $eSubject=$this->input->post('sendReceiptSubject');
            $mailData['messageData']= $this->input->post('receiptSendMessage');
            
            $this->email->set_newline("\r\n");
            $this->email->from($from,$companyName);
            $this->email->to($testTo);
//            if(!empty($this->input->post('sendReceiptCc')))
//            {
//                $this->email->cc($this->input->post('sendReceiptCc'));
//            }
            $this->email->subject($eSubject);
            $EmailBody = $this->load->view('template50.php',$mailData,true);
            $this->email->message($EmailBody);  
            if(!empty($file['name']))
            {
                
                $uploaddir = './upload/file/';
//                $deleteP=basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                $deleteP=basename($_FILES['attachment']['name']);
                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
//                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
                $this->email->attach($uploadfile);
            }
           $resp=$this->email->send();  
          unlink($uploadfile);
//          $event='Payment receipt sent to the customer.';
//          $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Auto','agent_id'=>$loginId,'flag'=>1,'event'=>$event));
         echo  $resp;
                
    }
    public function doSendNotification()
    {
        $bookingId=$this->input->post('bookingSendNotificationId');
        $loginId=$this->session->userdata('userId');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $companyIdLogin=idToName('admin','id',$loginId,'company');
        $file=$_FILES['attachment'];
        $EmailConfig=Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
                     
                );
         $mailData=array(
                'gerateing'=>'Dear  '.$customerName.','
            );
            $EmailBody='';
            $this->load->library('email',$EmailConfig);
            $testTo=  $this->input->post('notificationTo');
            $from=$this->input->post('notificationFrom');
            $companyName=idToName('company','id',$companyIdLogin,'company_name');
            $eSubject=$this->input->post('notificationSubject');
            $mailData['messageData']= $this->input->post('hideNotification');
            
            $this->email->set_newline("\r\n");
            $this->email->from($from,$companyName);
            $this->email->to($testTo);
            $this->email->subject($eSubject);
            $EmailBody = $this->load->view('template50.php',$mailData,true);
            $this->email->message($EmailBody);  
            if(!empty($file['name']))
            {
                
                $uploaddir = './upload/file/';
//                $deleteP=basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                $deleteP=basename($_FILES['attachment']['name']);
                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
//                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
                $this->email->attach($uploadfile);
            }
           $resp=$this->email->send();  
          unlink($uploadfile);
           $event='Refund notification email sent to the customer.';
          $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Auto','agent_id'=>$loginId,'flag'=>1,'event'=>$event));
         echo  $resp;
                
    }
    public function getRequestDeleteData()
    {
        $requestId=$this->input->post('requestId');
        $result=$this->BaseModel->getWhereM('paymentRequest',array('id'=>$requestId));
        if($result)
        {
            echo json_encode($result[0]);
        }
        else
        {
            echo json_encode(array('error'=>0));
        }
    }
    public function doRequestDelete()
    {
        $requestType=$this->input->post('requestType');
        $bookingId=$this->input->post('requestbookingId');
        $requestId=$this->input->post('requestId');
        $note=  trim($this->input->post('resaneDelete'));
        $agentId=$this->input->post('agentId');
        $reslt=$this->BaseModel->save('paymentRequestDeleteRefNote',array('booking_id'=>$bookingId,'request_from'=>$agentId,'note'=>$note,'request_type'=>$requestType,'flag'=>1));
        $response1='';
        $response2='';
        if($reslt>0)
        {
            $response1=$reslt;
            $historyMaintainMeg='';
            if($requestType=='Bank Payment')
            {
                 $historyMaintainMeg='Request to check Bank payment Declined ';
            }
            else if($requestType=='Card Payment')
            {
                 $historyMaintainMeg='Request to charge card Declined';
            }
            else if($requestType=='Invoice')
            {
                 $historyMaintainMeg='Request to send invoice Declined - payment is not made';
            }
            else if($requestType=='Cancel File')
            {
                 $historyMaintainMeg='Request to cancel file Declined';
            }
            else if($requestType=='Refund To Customer')
            {
                 $historyMaintainMeg='Request to refund to customer Declined';
            }
            else if($requestType=='Airline Refund')
            {
                $historyMaintainMeg='Request to airline refund Declined';
            }
            else if($requestType=='Other')
            {
                $historyMaintainMeg='Request Declined';
            }
            $logperson=$this->session->userdata('userId');
            $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Auto','agent_id'=>$logperson,'flag'=>1,'event'=>$historyMaintainMeg));
            $rest=$this->BaseModel->del('paymentRequest',array('id'=>$requestId));
            if($rest>0){ $response2=$rest; } else{ $response2=0;}
        }
        else
        {
          $response1=0;
          $response1=0;
        }
        echo $response1.'-'.$response2;
        
    }
    
    public function doRequestDelete2()
    {
//        $requestType=$this->input->post('requestType');
        $bookingId=$this->input->post('requestbookingId');
        $requestId=$this->input->post('requestId');
        $note=  trim($this->input->post('resaneDelete'));
        $agentId=$this->input->post('agentId');
        $reslt=$this->BaseModel->save('paymentRequestDeleteRefNote',array('booking_id'=>$bookingId,'request_from'=>$agentId,'note'=>$note,'flag'=>1));
        $response1='';
        $response2='';
        if($reslt>0)
        {
            $response1=$reslt;
            $logperson=$this->session->userdata('userId');
            $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Auto','agent_id'=>$logperson,'flag'=>1,'event'=>'Request to ticket order Declined'));
            $rest=$this->BaseModel->del('ticketOrderRequest',array('id'=>$requestId));
            if($rest>0){ $response2=$rest; } else{ $response2=0;}
        }
        else
        {
          $response1=0;
          $response1=0;
        }
        echo $response1.'-'.$response2;
        
    }
    public function PaymentRequestConfirmDone()
    {
        $requestId=$this->input->post('reconfirmId');
        $resp=$this->BaseModel->update('paymentRequest',array('isRead'=>1),array('id'=>$requestId));
        if($resp>0){ echo $resp; } else{ echo 0; }
        
    }
    public function getSendReceiptInfo()
    {
        $bookingId=$this->input->post('bookingId');
        $loginId=$this->session->userdata('userId');
        $loginpersoneEmail=idToName('admin','id',$loginId,'email');
        $loginPersoneNumber=idToName('admin','id',$loginId,'cell');
        $loginPersoneName=idToName('admin','id',$loginId,'full_name');
        $loginCompanyId=idToName('admin','id',$loginId,'company');
        $loginCompanyName=idToName('company','id',$loginCompanyId,'company_name');
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $CompanyId=idToName('booking_details','id',$bookingId,'company');
        $CompanyName=idToName('company','id',$CompanyId,'company_name');
        $CompanyCode=idToName('company','id',$CompanyId,'company_Code');
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentNumber=idToName('admin','id',$agentId,'cell');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $to =idToName('customer_contacts','booking_id',$bookingId,'email');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        
        $customer=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $flightDetails=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $customerInfo=$customer[0];
        $subject=$CompanyCode.'-'.$bookingId.' payment Receipt';
        $from=$loginpersoneEmail;
        $passengerDetails=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $qryPaymentRequest="Select * from paymentRequest where booking_id='$bookingId' order by id Desc limit 1 ";
        $lastPaymentRequest=  $this->BaseModel->getQuery($qryPaymentRequest);
        if(!empty($lastPaymentRequest))
        {
            $lastPayRequest=$lastPaymentRequest[0];
        }
        $passangerRoww='';
         $termsCondition=  $this->getTermsCondition();
         if(!empty($passengerDetails))
        {
             foreach($passengerDetails as $pObj)
                 {
                 $passangerRoww.='<tr>
                                    <td>'.$pObj->title.'</td>
                                    <td>'.$pObj->firstName.'</td>
                                    <td>'.$pObj->midle_name.'</td>
                                    <td>'.$pObj->sur_name.'</td>
                                    <td>'.$pObj->age.'</td>
                                    <td>'.$pObj->category.'</td>
                                    <td align="center">'.$pObj->salePrice.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">'.$pObj->booking_fee.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">0.00</td>
                                </tr>';
                 }
        }
       
        $totalSalePrice=salePrice($bookingId);
        $bankPayment=bankPayment($bookingId);
        $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId));
         $toatalReceived= $bankPayment+$cardAmount+$lastPayRequest->requestAmount;    
         $remaining=$totalSalePrice-$toatalReceived;
          $trFlightIno='';
        if($flightDetails[0]->flight_type=='Return')
        {
            $trFlightIno='<tr>
                  <td width="200" class="width200">Departure Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->departure_date)).'</td>
               </tr>
               
               <tr>
                  <td width="200" class="width200">Return Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->returnDate)).'</td>
               </tr>';
        }
        else
        {
            $trFlightIno='<tr>
                  <td width="200" class="width200">Departure Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->departure_date)).'</td>
               </tr>
              ';
        }
        $internalMessage='
            <table  cellpadding="0" border="0" width="500" class="width500">
                        <tbody>
                           <tr>
                              <td width="200" class="width200">Customer Name:</td>
                              <td>'.$customerName.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Order Reference:</td>
                              <td>'.$CompanyCode.'-'.$bookingId.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Payment Date:</td>
                              <td>'.$lastPayRequest->requestDate.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Current Amount Received:</td>
                              <td>&pound;'.$lastPayRequest->requestAmount.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Payment Mode:</td>
                              <td>'.$lastPayRequest->requestType.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Total Received:</td>
                              <td>&pound;'.$toatalReceived.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Remaining Balance:</td>
                              <td>&pound;'.$remaining.'</td>
                           </tr>
                        </tbody>
        </table>
        <table cellpadding="0" border="0" width="850" class="width850">
                <tbody>
                   <tr>
                      <td colspan="6">&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="6">
                         <b><u>Passenger &amp; Sale Price Details:</u></b>
                      </td>
                   </tr>
                   <tr>
                      <td colspan="6">&nbsp;</td>
                   </tr>
                   <tr>
                      <td><b>Title</b></td>
                      <td><b>First Name</b></td>
                      <td><b>Middle Name</b></td>
                      <td><b>Surname</b></td>
                      <td><b>Age(yrs)</b></td>
                      <td><b>Catagory</b></td>
                      <td><b>Basic (&pound;)</b></td>
                      <td><b>Tax (&pound;)</b></td>
                      <td><b>Booking Fee (&pound;)</b></td>
                      <td><b>C. Card Charges (&pound;)</b></td>
                      <td><b>Others (&pound;)</b></td>
                   </tr>
                   '.$passangerRoww.'
                   <tr>
                      <td>&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="6" bgcolor="#eee"><b>Total Sale Price:</b></td>
                      <td colspan="5" bgcolor="#eee"><b>(&pound;)'.$totalSalePrice.'</b></td>
                   </tr>
                </tbody>
        </table>
        <table cellpadding="0" border="0" width="500" class="width500">
            <tbody>
               <tr>
                  <td colspan="2">&nbsp;</td>
               </tr>
               <tr>
                  <td colspan="2">
                     <b><u>Travelling Detail:</u></b>
                  </td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flight Type:</td>
                  <td>'.$flightDetails[0]->flight_type.'</td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flying From:</td>
                  <td>'.$flightDetails[0]->departure.'</td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flying To:</td>
                  <td>'.$flightDetails[0]->destination.'</td>
               </tr>
               '.$trFlightIno.'
               <tr>
                  <td colspan="2">&nbsp;</td>
               </tr>
               <tr>
                  <td colspan="2">
                     <b><u>Proposed Flight:</u></b>
                  </td>
               </tr>
            </tbody>
      </table>
      <p>
        Flight Itinerary/Schedule is given below. It is requested you to review it in detail.
     </p>
     <table cellpadding="0" border="0" width="500" class="width500">
        <tbody>
           <tr>
              <td width="200" class="width200">Passengers Reference(PNR):</td>
              <td>'.$flightDetails[0]->pnr.'</td>
           </tr>
        </tbody>
    </table>
    <p>
     For any information you can contact directly to your concerned agent <b>'.$agentName.'</b> on <b>'.$agentNumber.'</b> or at <b>'.$agentEmail.'</b>.    
    </p>
    <p>Before tickets issuance, if our agent is unable to fulfill your requirements you can ask for the full refund. In case of any complain you can contact us at <b>'.$loginPersoneNumber.'</b>.</p>
    <br>
    With regards,<br><br>
    <b>
    '.$loginPersoneName.'<br>
    '.$loginCompanyName.'<br>
    Email: '.$loginpersoneEmail.'<br>
    Phone: '.$loginPersoneNumber.'  
    </b>
    <br><br><br>
    <hr>
    <table cellpadding="0" border="0" width="260">
       <tbody>
          <tr>
             <td colspan="2">
                <b><u>Flight Itinerary/Schedule</u></b>
             </td>
          </tr>
       </tbody>
    </table>
    <pre>'.$flightDetails[0]->ticketDetails.'</pre>
    <br><br>
        <hr>
'.$termsCondition;
 
        $response=array('detailsData'=>$internalMessage,'bookingNum'=>$bookingId,'to'=>$to,'from'=>$from,'cc'=>$agentEmail,'subject'=>$subject,'message'=>'Dear customer thanks for your payment. Detail of received current payment is as follows <br>','customerInfo'=>$customerInfo);
        echo json_encode($response,true);
        exit();
    }
    public function getSendReceiptInfo2()
    {
        $bookingId=$this->input->post('bookingId');
        $loginId=$this->session->userdata('userId');
        $loginpersoneEmail=idToName('admin','id',$loginId,'email');
        $loginPersoneNumber=idToName('admin','id',$loginId,'cell');
        $loginPersoneName=idToName('admin','id',$loginId,'full_name');
        $loginCompanyId=idToName('admin','id',$loginId,'company');
        $loginCompanyName=idToName('company','id',$loginCompanyId,'company_name');
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $CompanyId=idToName('booking_details','id',$bookingId,'company');
        $CompanyName=idToName('company','id',$CompanyId,'company_name');
        $CompanyCode=idToName('company','id',$CompanyId,'company_Code');
        $agentEmail=idToName('admin','id',$agentId,'email');
        $agentNumber=idToName('admin','id',$agentId,'cell');
        $agentName=idToName('admin','id',$agentId,'login_name');
        $to =idToName('customer_contacts','booking_id',$bookingId,'email');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        
        $customer=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $flightDetails=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $customerInfo=$customer[0];
        $subject=$CompanyCode.'-'.$bookingId.' Payment Receipt';
        $from=$loginpersoneEmail;
        $passengerDetails=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $qryPaymentRequest="Select * from paymentRequest where booking_id='$bookingId' order by id Desc limit 1 ";
        $lastPaymentRequest=  $this->BaseModel->getQuery($qryPaymentRequest);
        if(!empty($lastPaymentRequest))
        {
            $lastPayRequest=$lastPaymentRequest[0];
        }
        $passangerRoww='';
         $termsCondition=  $this->getTermsCondition();
         if(!empty($passengerDetails))
        {
             foreach($passengerDetails as $pObj)
                 {
                 $passangerRoww.='<tr>
                                    <td>'.$pObj->title.'</td>
                                    <td>'.$pObj->firstName.'</td>
                                    <td>'.$pObj->midle_name.'</td>
                                    <td>'.$pObj->sur_name.'</td>
                                    <td>'.$pObj->age.'</td>
                                    <td>'.$pObj->category.'</td>
                                    <td align="center">'.$pObj->salePrice.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">'.$pObj->booking_fee.'</td>
                                    <td align="center">0.00</td>
                                    <td align="center">0.00</td>
                                </tr>';
                 }
        }
       
        $totalSalePrice=salePrice($bookingId);
        $bankPayment=bankPayment($bookingId);
        $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId));
         $toatalReceived= $bankPayment+$cardAmount+$lastPayRequest->requestAmount;    
         $remaining=$totalSalePrice-$toatalReceived;
          $trFlightIno='';
        if($flightDetails[0]->flight_type=='Return')
        {
            $trFlightIno='<tr>
                  <td width="200" class="width200">Departure Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->departure_date)).'</td>
               </tr>
               
               <tr>
                  <td width="200" class="width200">Return Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->returnDate)).'</td>
               </tr>';
        }
        else
        {
            $trFlightIno='<tr>
                  <td width="200" class="width200">Departure Date:</td>
                  <td>'.date('d-M-y',  strtotime($flightDetails[0]->departure_date)).'</td>
               </tr>
              ';
        }
        $internalMessage='
            <table  cellpadding="0" border="0" width="500" class="width500">
                        <tbody>
                           <tr>
                              <td width="200" class="width200">Customer Name:</td>
                              <td>'.$customerName.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Order Reference:</td>
                              <td>'.$CompanyCode.'-'.$bookingId.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Payment Date:</td>
                              <td>'.$lastPayRequest->requestDate.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Current Amount Received:</td>
                              <td>&pound;'.$lastPayRequest->requestAmount.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Payment Mode:</td>
                              <td>'.$lastPayRequest->requestType.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Total Received:</td>
                              <td>&pound;'.$toatalReceived.'</td>
                           </tr>
                           <tr>
                              <td width="200" class="width200">Remaining Balance:</td>
                              <td>&pound;'.$remaining.'</td>
                           </tr>
                        </tbody>
        </table>
        <table cellpadding="0" border="0" width="850" class="width850">
                <tbody>
                   <tr>
                      <td colspan="6">&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="6">
                         <b><u>Passenger &amp; Sale Price Details:</u></b>
                      </td>
                   </tr>
                   <tr>
                      <td colspan="6">&nbsp;</td>
                   </tr>
                   <tr>
                      <td><b>Title</b></td>
                      <td><b>First Name</b></td>
                      <td><b>Middle Name</b></td>
                      <td><b>Surname</b></td>
                      <td><b>Age(yrs)</b></td>
                      <td><b>Catagory</b></td>
                      <td><b>Basic (&pound;)</b></td>
                      <td><b>Tax (&pound;)</b></td>
                      <td><b>Booking Fee (&pound;)</b></td>
                      <td><b>C. Card Charges (&pound;)</b></td>
                      <td><b>Others (&pound;)</b></td>
                   </tr>
                   '.$passangerRoww.'
                   <tr>
                      <td>&nbsp;</td>
                   </tr>
                   <tr>
                      <td colspan="6" bgcolor="#eee"><b>Total Sale Price:</b></td>
                      <td colspan="5" bgcolor="#eee"><b>(&pound;)'.$totalSalePrice.'</b></td>
                   </tr>
                </tbody>
        </table>
        <table cellpadding="0" border="0" width="500" class="width500">
            <tbody>
               <tr>
                  <td colspan="2">&nbsp;</td>
               </tr>
               <tr>
                  <td colspan="2">
                     <b><u>Travelling Detail:</u></b>
                  </td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flight Type:</td>
                  <td>'.$flightDetails[0]->flight_type.'</td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flying From:</td>
                  <td>'.$flightDetails[0]->departure.'</td>
               </tr>
               <tr>
                  <td width="200" class="width200">Flying To:</td>
                  <td>'.$flightDetails[0]->destination.'</td>
               </tr>
               '.$trFlightIno.'
               <tr>
                  <td colspan="2">&nbsp;</td>
               </tr>
               <tr>
                  <td colspan="2">
                     <b><u>Proposed Flight:</u></b>
                  </td>
               </tr>
            </tbody>
      </table>
      <p>
        Flight Itinerary/Schedule is given below. It is requested you to review it in detail.
     </p>
     <table cellpadding="0" border="0" width="500" class="width500">
        <tbody>
           <tr>
              <td width="200" class="width200">Passengers Reference(PNR):</td>
              <td>'.$flightDetails[0]->pnr.'</td>
           </tr>
        </tbody>
    </table>
    <p>
     For any information you can contact directly to your concerned agent <b>'.$agentName.'</b> on <b>'.$agentNumber.'</b> or at <b>'.$agentEmail.'</b>.    
    </p>
    <p>Before tickets issuance, if our agent is unable to fulfill your requirements you can ask for the full refund. In case of any complain you can contact us at <b>'.$loginPersoneNumber.'</b>.</p>
    <br>
    With regards,<br><br>
    <b>
    '.$loginPersoneName.'<br>
    '.$loginCompanyName.'<br>
    Email: '.$loginpersoneEmail.'<br>
    Phone: '.$loginPersoneNumber.'  
    </b>
    <br><br><br>
    <hr>
    <table cellpadding="0" border="0" width="260">
       <tbody>
          <tr>
             <td colspan="2">
                <b><u>Flight Itinerary/Schedule</u></b>
             </td>
          </tr>
       </tbody>
    </table>
    <pre>'.$flightDetails[0]->ticketDetails.'</pre>
    <br><br>
        <hr>
'.$termsCondition;
 
        $response=array('detailsData'=>$internalMessage,'bookingNum'=>$bookingId,'to'=>$to,'from'=>$from,'cc'=>$agentEmail,'subject'=>$subject,'message'=>'Dear customer thanks for your payment. Detail of received current payment is as follows <br>','customerInfo'=>$customerInfo);
        echo json_encode($response,true);
        exit();
    }
    public function doSaveBookLog()
    {
        $bookingId=  $this->input->post('bookingId');
        $userId=     $this->input->post('userId');
        $noteData=   trim($this->input->post('noteData'));
        if(!empty($noteData) && $noteData!=NULL)
            {
               $restData= $this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'agent_id'=>$userId,'event_type'=>'Manual','event'=>$noteData,'flag'=>1));
            if($restData>0){ echo $restData; } else{ echo 0; }
            }
            else{ echo 0;}
    }
    
    
    public function CardAddNew()
    {
        $cardNumber=$this->input->post('cardNumber');
        $bookingId=$this->input->post('bookingNumberCard');
        $cardHolderName=$this->input->post('cardHolderName');
        $validFrom=$this->input->post('cardValid');
        $cardExpiry=$this->input->post('cardExpiryDate');
        $cvv=$this->input->post('cardCvv');
        $cardIssuingBank=$this->input->post('cardIssingBank');
        $cardBrand=$this->input->post('cardBrand');
        $cardType=$this->input->post('cardType');
        $cardAddress=$this->input->post('cardNewAddress');
        $addressType=$this->input->post('cardAddressType');
        $paymentDateTime=  explode(' ', $this->input->post('paymentDueDate'));
        $dataSave1=array(
            'booking_id'=>$bookingId,
            'card_number'=>$cardNumber,
            'card_holder_name'=>$cardHolderName,
            'card_expiry'=>$cardExpiry,
            'cvv'=>$cvv,
            'card_type'=>$cardType,
            'validFrom'=>$validFrom,
            'card_brand'=>$cardBrand,
            'new_address'=>$cardAddress,
            'address_type'=>$addressType,
            'issue_bank_name'=>$cardIssuingBank,
            'flag'=>1
        );
        $dataSave=array(
           'booking_id' => $bookingId,
           'paying_by'=>'Card',
            'postal_address'=>$cardAddress,
           'card_number'=>$cardNumber,
           'cardHolderName'=>$cardHolderName,
           'validFrom'=>$validFrom,
           'cvv'=>$cvv,
           'expiryDate'=>$cardExpiry,
           'cardBrand'=>$cardBrand,
           'cardIssuingBank'=>$cardIssuingBank,
           'paymentDue_date'=>$paymentDateTime[0],
           'paymentDueTime'=>$paymentDateTime[1],
           'cardType'=>$cardType
          
        );
        $restId=$this->BaseModel->save('customer_receipt_details',$dataSave);
        //$this->BaseModel->update('customer_receipt_details',array('paying_by'=>'Card'),array('booking_id'=>$bookingId));
        if($restId>0){
//            $this->BaseModel->update('card_details',array('flag'=>0),array('booking_id'=>$bookingId));
//            $this->BaseModel->update('card_details',array('flag'=>1),array('id'=>$restId));
            echo $restId; 
            
        } else{ echo 0; }
        
    }
    public function doUpdateCard()
    {
        $cardNumber=$this->input->post('cardNumber');
        $bookingId=$this->input->post('bookingNumberCard');
        $cardHolderName=$this->input->post('cardHolderName');
        $validFrom=$this->input->post('cardValid');
        $cardExpiry=$this->input->post('cardExpiryDate');
        $cvv=$this->input->post('cardCvv');
        $cardIssuingBank=$this->input->post('cardIssingBank');
        $cardBrand=$this->input->post('cardBrand');
        $cardType=$this->input->post('cardType');
        $paymentDateTime=  explode(' ', $this->input->post('paymentDueDate'));
//        $cardAddress=$this->input->post('cardNewAddress');
//        $addressType=$this->input->post('cardAddressType');
        $updateCardId=$this->input->post('cardId');
        $dataSave=array(
            'card_number'=>$cardNumber,
            'cardHolderName'=>$cardHolderName,
            'expiryDate'=>$cardExpiry,
            'cvv'=>$cvv,
            'cardType'=>$cardType,
            'validFrom'=>$validFrom,
            'cardBrand'=>$cardBrand,
            'paymentDue_date'=>$paymentDateTime[0],
            'paymentDueTime'=>$paymentDateTime[1],
            'cardIssuingBank'=>$cardIssuingBank
            
        );
        $restId=$this->BaseModel->update('customer_receipt_details',$dataSave,array('id'=>$updateCardId));
        if($restId>0){
            echo $restId; 
            
        } else{ echo 0; }
        
    }
    public function cardDataGet()
    {
        $cardId=  $this->input->post('cardId');
        $response=$this->BaseModel->getWhereM('customer_receipt_details',array('id'=>$cardId));
        $res='';
        if(!empty($response))
        {
            $res=$response[0];
            echo json_encode($res,true);
        }
        else
        {
            $res='';
            echo json_encode($res,true);
            
        }
    }
    public function getCardDataForRequest()
    {
        $bookingId=$this->input->post('bookingId');
        $qryCard="Select * from customer_receipt_details where booking_id='$bookingId' AND paying_by='Card'  order by id desc limit 1 ";
        $cardData=$this->BaseModel->getQuery($qryCard);
        if(!empty($cardData))
        {
            $cardRes=$cardData[0];
            $email=idToName('customer_contacts','booking_id',$bookingId,'email');
            $phone=idToName('customer_contacts','booking_id',$bookingId,'mobile');
            $dataSendArray=array(
                'email'=>$email,
                'phone'=>$phone,
                'cardHolder'=>$cardRes->cardHolderName,
                'cardNumber'=>$cardRes->card_number,
                'cvv'=>$cardRes->cvv,
                'address'=>$cardRes->postal_address,
                'cardType'=>$cardRes->cardType,
                'expiry'=>$cardRes->expiryDate
            );
            echo json_encode($dataSendArray,true);
        }
        else{ echo 0; }
    }
    public function getRefundPayment()
    {
        $bookingId=$this->input->post('bookingId');
        $qryPrepare="Select * from payment where booking_ref='$bookingId' and  	pay_by='Customer' And  pay_type='Dr' And payment_nature='bank' ";
        $response=$this->BaseModel->getQuery($qryPrepare);
        if(!empty($response))
        {
            $trId=$response[0]->transectionId;
            $qryGet2="Select * from payment where transectionId='$trId' ";
            $record=$this->BaseModel->getQuery($qryGet2);
            echo json_encode($record,true);
            
        }
        else
        {
            echo 0;
        }
    }
    public function addBookingLogAction()
    {
        $booking=$this->input->post('bookingId');
        $notify=  $this->input->post('notify');
        $amount=  $this->input->post('refundAmount');
        if($notify=='refund')
        {
            $dataSaveNotify=array(
                'booking_id'=>$booking,
                'event_type'=>'Auto',
                'agent_id'=>$this->session->userdata('userId'),
                'flag'=>1,
                'event'=>'Refund to customer done'
                
            );
            $res=$this->BaseModel->save('event_history',$dataSaveNotify);
            if($res>0){ echo $res; } else { echo 0; }
        }
        else if($notify=='Card Payment' || $notify=='Bank Payment')
        {
            if($notify=='Card Payment')
            {
                 $dataSaveNotify=array(
                'booking_id'=>$booking,
                'event_type'=>'Auto',
                'agent_id'=>$this->session->userdata('userId'),
                'flag'=>1,
                'event'=>'Card payment Charged and updated.'
                
            );
            $res=$this->BaseModel->save('event_history',$dataSaveNotify);
            if($res>0){ echo $res; } else { echo 0; }
            }
            else if($notify=='Bank Payment')
                {
                     $dataSaveNotify=array(
                        'booking_id'=>$booking,
                        'event_type'=>'Auto',
                        'agent_id'=>$this->session->userdata('userId'),
                        'flag'=>1,
                        'event'=>'Bank payment confirmed and updated.'
                
                         );
                    $res=$this->BaseModel->save('event_history',$dataSaveNotify);
                    if($res>0){ echo $res; } else { echo 0; }
                }
        }
    }
    public function issueRelatedData()
    {
        $bookingId=$this->input->post('bookingId');
        $bookingDetails=  $this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $flightDetails=  $this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $passengerDetails=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $CompanyId=idToName('booking_details','id',$bookingId,'company');
        $CompanyCode=idToName('company','id',$CompanyId,'company_Code');
        
        $responseArray=array(
          'bookingDetails'=>$bookingDetails[0],
           'flightDetails'=>$flightDetails[0],
            'passenger'=>$passengerDetails,
            'bookingTitle'=>$CompanyCode.'-'.$bookingId,
            'brandName'=>$CompanyCode
        );
        echo json_encode($responseArray,true);
    }
    public function getBookingNumber()
    {
        $bookingId=$this->input->post('bookingId');
        $CompanyId=idToName('booking_details','id',$bookingId,'company');
        $CompanyCode=idToName('company','id',$CompanyId,'company_Code');
        echo $CompanyCode.'-'.$bookingId;
    }
    public function makeCancel()
    {
        $bookingId=$this->input->post('bookigId');
        $cancelDate=$this->input->post('cancelDate');
        $remarks=$this->input->post('reasone');
        $loginId=$this->session->userdata('userId');
        $res=$this->BaseModel->save('cancel_remarks',array('booking_id'=>$bookingId,'date'=>$cancelDate,'remarks'=>$remarks,'agent_id'=>$loginId));
        if($res)
            {
                $rest=$this->BaseModel->update('booking_details',array('canceled_stat'=>1,'cancel_date'=>$cancelDate),array('id'=>$bookingId));
                echo $rest;
            } else{ echo 0; }
            
        
    }
    public function doIssue()
    {
        $passengerIds=$this->input->post('passerIds');
        $bookingId=$this->input->post('issueBookingId');
        $toatalPassenger=$this->input->post('totalPassanerIssue');
        $issueDate=$this->input->post('issueDate');
        $etickets=$this->input->post('eticketIssue');
        foreach($passengerIds as $key=>$item)
        {
            $res=$this->BaseModel->update('passanger_details',array('eticket'=>$etickets[$key]),array('passenger_Id'=>$item));
        }
        $updateRes=$this->BaseModel->update('booking_details',array('issue_date'=>$issueDate,'flag'=>2),array('id'=>$bookingId));
        $updateRes2=$this->BaseModel->update('ticketOrderRequest',array('isRead'=>1),array('booking_id'=>$bookingId));
        $dataSaveNotify=array(
                'booking_id'=>$bookingId,
                'event_type'=>'Auto',
                'agent_id'=>$this->session->userdata('userId'),
                'flag'=>1,
                'event'=>'Tickets Issued.'
                
            );
            $res=$this->BaseModel->save('event_history',$dataSaveNotify);
        if($updateRes)
        {
            
            echo $updateRes;
        }
        else{ echo 0; }
    }
    public function doEditIssue()
    {
        $passengerIds=$this->input->post('passerIdsEdit');
        $bookingId=$this->input->post('issueBookingIdEdit');
        $toatalPassenger=$this->input->post('totalPassanerIssueEdit');
        $issueDate=$this->input->post('issueDateEdit');
        $etickets=$this->input->post('eticketIssueEdit');
        $supplierRefIssueEdit=$this->input->post('supplierRefIssueEdit');
        $issuePnrEdit=$this->input->post('issuePnrEdit');
        $gdsIssueEdit=$this->input->post('gdsIssueEdit');
        foreach($passengerIds as $key=>$item)
        {
            $res=$this->BaseModel->update('passanger_details',array('eticket'=>$etickets[$key]),array('passenger_Id'=>$item));
        }
       $this->BaseModel->update('booking_details',array('issue_date'=>$issueDate,'supplier_ref'=>$supplierRefIssueEdit),array('id'=>$bookingId));
       $this->BaseModel->update('flight_details',array('pnr'=>$issuePnrEdit,'gds'=>$gdsIssueEdit),array('booking_id'=>$bookingId));
       echo '1';
    }
    public function makeReadyTicketOrder()
    {
        $bookingId=$this->input->post('bookingId');
       $accountsEmail=$this->BaseModel->getWhereM('admin',array('flag'=>2));
       $supplierName=idToName('booking_details','id',$bookingId,'supplier_name');
       $supplierRef=idToName('booking_details','id',$bookingId,'supplier_ref');
       $supplierAgent=idToName('booking_details','id',$bookingId,'supplier_agent_name');
       $gds=idToName('flight_details','booking_id',$bookingId,'gds');
       $pnr=idToName('flight_details','booking_id',$bookingId,'pnr');
       $CompanyId=idToName('booking_details','id',$bookingId,'company');
       $CompanyCode=idToName('company','id',$CompanyId,'company_Code');
       if($accountsEmail)
        {
           $accountCompanyNaem=$accountsEmail[0]->company;
           $accEmail=$accountsEmail[0]->email;
           $accPhone=$accountsEmail[0]->direct_line_number;
           $CompanyNameAcc=idToName('company','id',$accountCompanyNaem,'company_name');
        }
       
       $supplierDetails=$this->BaseModel->getWhereM('suppliers',array('supplier_name'=>$supplierName));
       $payinBank='';
       if($supplierDetails)
       {
           $payinBank=$supplierDetails[0]->BankId;
       }
       $aggredCost=round(ticketCost($bookingId),2);
       
       $internalMessage='Hi,<br>Please issue the below. Payment done into your '.$payinBank.'.<br></br>
            <table cellpadding="0" border="0" width="500" class="width500" >
                                      <tbody>
                                         <tr>
                                            <td width="200" class="width200">Supplier Ref :</td>
                                            <td>'.$supplierRef.'</td>
                                         </tr>
                                         <tr>
                                            <td width="200" class="width200">Supplier Agent Name :</td>
                                            <td>'.$supplierAgent.'</td>
                                         </tr>
                                         <tr>
                                            <td width="200" class="width200">GDS :</td>
                                            <td>'.$gds.'</td>
                                         </tr>
                                         <tr>
                                            <td width="200" class="width200">PNR :</td>
                                            <td>'.$pnr.'</td>
                                         </tr>
                                         <tr>
                                            <td width="200" class="width200">Agreed Cost :</td>
                                            <td>'.$aggredCost.'</td>
                                         </tr>
                                      </tbody>
                                   </table>    
                                   <br>
                                   Thanks.<br>
                                   Regards,<br><br>
                                   Admin Manager<br>
                                   '.$CompanyNameAcc.'<br>
                                   Email:'.$accEmail.'<br>
                                   Phone: '.$accPhone.'<br> 
                                   
            ';
       $detailsArray=array(
           'innterlMessage'=>$internalMessage,
           'bookingId'=>$bookingId,
           'fromEmail'=>$accountsEmail,
           'supplierDetails'=>$supplierDetails,
           'subject'=>$CompanyCode.'-'.$bookingId.'  - Ticker Order Against  '.$pnr
       );
       echo json_encode($detailsArray, true);
    }
    public function sendTicketOrderEmail() 
    {
        $bookingId=$this->input->post('ticketOrderEmailBookingId');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $customerName=idToName('customer_contacts','booking_id',$bookingId,'fullname');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $file=$_FILES['emailFile'];
//        print_r($file);
        $EmailConfigTicket=Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
//            'charset' => 'iso-8859-1',
            'priority' => '1'
                     
                );
         $mailData=array(
                'gerateing'=>'Dear,'
            );
            $EmailBody='';
            $this->load->library('email',$EmailConfigTicket);
//            $ggg=$this->email->initialize($EmailConfig);
           
            //$testTo='shahidaslam448@gmail.com';
            $testTo=  $this->input->post('ticketOrderEmailTo');
//            $testTo='admin@brightholiday.co.uk';
            $from=$this->input->post('ticketOrderEmailFrom');
            //$from='info@sufitravelandtours.co.uk';
            $companyName=idToName('company','id',$companyId,'company_name');
            $companyCode=idToName('company','id',$companyId,'company_Code');
            $eSubject=$this->input->post('ticketOrderEmailSubject');
            $mailData['messageData']= $this->input->post('messageInn');
            //print_r($mailData);
            //$mailData['messageData']='Please complete all manuel messages coming from agents requests and automated messages coming from pending tasks actions';
            //$mailData['messageData']='Helo Shahid';
            
            $this->email->set_newline("\r\n");
            $this->email->from($from,$companyName);
            $this->email->to($testTo);
            if(!empty($this->input->post('ticketOrderEmailCc')))
             {
                $this->email->cc($this->input->post('ticketOrderEmailCc'));
             }
            $this->email->subject($eSubject);
            $EmailBody = $this->load->view('template50.php',$mailData,true);
            $this->email->message($EmailBody);  
            if(!empty($file['name']))
            {
                
                $uploaddir = './upload/file/';
//                $deleteP=basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                $deleteP=basename($_FILES['emailFile']['name']);
                $uploadfile = $uploaddir . basename($_FILES['emailFile']['name']);
//                $uploadfile = $uploaddir . basename($_FILES['attachment']['name']).$bookingId.'-'.$companyCode;
                move_uploaded_file($_FILES['emailFile']['tmp_name'], $uploadfile);
                $this->email->attach($uploadfile);
            }
//            print_r($EmailBody);
           $resp=$this->email->send();  
            $dataSaveNotify=array(
                        'booking_id'=>$bookingId,
                        'event_type'=>'Auto',
                        'agent_id'=>$this->session->userdata('userId'),
                        'flag'=>1,
                        'event'=>'Payment transferred to supplier and ticket order sent.'
                
                         );
                    $res=$this->BaseModel->save('event_history',$dataSaveNotify);
           
          //unlink($uploadfile);
         echo  $resp;
//          $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//        // Additional headers
//       
//        $headers .= 'From: '.$from;
//        $mailfrom = 'From:'.$from;
//        $mailfrom .= "MIME-Version: 1.0\r\n";
//        $mailfrom .= "Content-Type: text/html; charset=UTF-8\r\n";
//      echo $resultE=sendEmail($from,$testTo,$EmailBody,' ');
//           mail($testTo,$eSubject,$EmailBody,$mailfrom);
//          $adminMailAddress="shahidaslam448@gmail.com";
//          $adminConfig=Array(       
//                    'mailtype' => 'html',
//                     'charset' => 'utf-8',
//                     'priority' => '1'
//                );
//				 $adminData=array(
//                'gerateing'=>'Dear Admin Bright Holiday Ltd,'
//            );
//			 $from='notifications@brightholiday.co.uk';
//            $companyName='Bright HoliDay';
//			 $adminSubject="Test from me";
//			 
//			 $adminData['messageData']='helo dear friends';
//			 
//			  $this->load->library('email', $adminConfig);
//                $this->email->set_newline("\r\n");
//                $this->email->from($from,$companyName);
//                $this->email->to($adminMailAddress);
//                $this->email->subject($adminSubject);
//                $adminBody = $this->load->view('template50.php',$adminData,TRUE);
//                $this->email->message($adminBody);  
//                $this->email->send();
                
    }
    public function checkItenery()
    {
        $pnrActual=  $this->input->post('pnrc');
        $flightDe=  $this->input->post('flightDetailsForPassanger');
         $iteneryForPNR= preg_split('/\n/', $flightDe);
         $pnrEntry=$iteneryForPNR[0];
         $onlyPnrs=explode('/', $pnrEntry);
         $pnr=strip_tags($onlyPnrs[0]);
         if($pnr==$pnrActual)
         {
             echo 1;
         }
         else { echo 0; }
    }
    public function returnToPending()
    {
        $bookingId=$this->input->post('bookingId');
        $this->BaseModel->del('cancel_remarks',array('booking_id'=>$bookingId));
        $this->BaseModel->del('left_balance',array('bookeing_id'=>$bookingId));
        $resp=$this->BaseModel->update('booking_details',array('canceled_stat'=>'','cancel_date'=>''),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
    }
    public function returnFromIssued()
    {
        $bookingId=  $this->input->post('bookingId');
        $this->BaseModel->del('left_balance',array('bookeing_id'=>$bookingId));
        $resp=$this->BaseModel->update('booking_details',array('flag'=>'1','issue_date'=>'0000-00-00','cleared_stat'=>0),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
    }
    public function doClone()
    {
        $bookingId=  $this->input->post('baseFileId');
        $bookingDetailsGet=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        if(!empty($bookingDetailsGet))
        {
            $bookingObj=$bookingDetailsGet[0];
            $newEntryArray=array(
                'booking_date'=>date('Y-m-d'),
                'bookingTime'=>$bookingObj->bookingTime,
                'booked_agent_id'=>$bookingObj->booked_agent_id,
                'supplier_name'=>$bookingObj->supplier_name,
                'supplier_agent_name'=>$bookingObj->supplier_agent_name,
                'supplier_ref'=>$bookingObj->supplier_ref,
                'booking_under_brand'=>$bookingObj->booking_under_brand,
                'flag'=>1,
                'pending_status'=>$bookingObj->pending_status,
                'pending_date'=>$bookingObj->pending_date,
                'canceled_stat'=>$bookingObj->canceled_stat,
                'red_flag'=>$bookingObj->red_flag,
                'cancel_date'=>$bookingObj->cancel_date,
                'issue_date'=>$bookingObj->issue_date,
                'company'=>$bookingObj->company,
                'duplicate_status'=>1
            );
            $newBookingId=$this->BaseModel->save('booking_details',$newEntryArray);
            $customerContact=  $this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
            if(!empty($customerContact))
             {
                $customerObj=$customerContact[0];
                $newCustomerArray=array(
                    'booking_id'=>$newBookingId,
                    'fullname'=>$customerObj->fullname,
                    'line_number'=>$customerObj->line_number,
                    'postal_address'=>$customerObj->postal_address,
                    'mobile'=>$customerObj->mobile,
                    'email'=>$customerObj->email,
                    'source_of_booking'=>$customerObj->source_of_booking
                );
                $this->BaseModel->save('customer_contacts',$newCustomerArray);
             }
             $customerReceipt=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
             if(!empty($customerReceipt))
             {
                 foreach($customerReceipt as $receiptObj)
                 {
                     $newCustomerReceiptArray=array(
                         'booking_id'=>$newBookingId,
                         'paying_by'=>$receiptObj->paying_by,
                         'postal_address'=>$receiptObj->postal_address,
                         'paymentDue_date'=>$receiptObj->paymentDue_date,
                         'paymentDueTime'=>$receiptObj->paymentDueTime,
                         'card_number'=>$receiptObj->card_number,
                         'cardHolderName'=>$receiptObj->cardHolderName,
                         'cvv'=>$receiptObj->cvv,
                         'validFrom'=>$receiptObj->validFrom,
                         'expiryDate'=>$receiptObj->expiryDate,
                         'cardType'=>$receiptObj->cardType,
                         'cardIssuingBank'=>$receiptObj->cardIssuingBank,
                         'cardBrand'=>$receiptObj->cardBrand,
                         'newbookingChargeAmount'=>$receiptObj->newbookingChargeAmount,
                         'bankCharges'=>$receiptObj->bankCharges
                         
                     );
                     $this->BaseModel->save('customer_receipt_details',$newCustomerReceiptArray);
                 }
             }
             $flightDetails=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
             if(!empty($flightDetails))
              {
                 $flightObj=$flightDetails[0];
                 $newFlightArray=array(
                     'booking_id'=>$newBookingId,
                     'departure'=>$flightObj->departure,
                     'destination'=>$flightObj->destination,
                     'via'=>$flightObj->via,
                     'returningVia'=>$flightObj->returningVia,
                     'flight_type'=>$flightObj->flight_type,
                     'departure_date'=>$flightObj->departure_date,
                     'departedTime'=>$flightObj->departedTime,
                     'returnDate'=>$flightObj->returnDate,
                     'returnTime'=>$flightObj->returnTime,
                     'airline'=>$flightObj->airline,
                     'flight_number'=>$flightObj->flight_number,
                     'flight_class'=>$flightObj->flight_class,
                     'number_Of_segment'=>$flightObj->number_Of_segment,
                     'pnr'=>$flightObj->pnr,
                     'airlineLocatore'=>$flightObj->airlineLocatore,
                     'gds'=>$flightObj->gds,
                     'pnrExpiryDate'=>$flightObj->pnrExpiryDate,
                     'pnrExpiryTime'=>$flightObj->pnrExpiryTime,
                     'fareExpiryDate'=>$flightObj->fareExpiryDate,
                     'fareExpiryTime'=>$flightObj->fareExpiryTime,
                     'ticketDetails'=>$flightObj->ticketDetails,
                     'systemFlightDetails'=>$flightObj->systemFlightDetails
                 );
                 $this->BaseModel->save('flight_details',$newFlightArray);
              }
            $passengerDetails=  $this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
            if(!empty($passengerDetails))
            {
                foreach($passengerDetails as $passObj)
                {
                    $newPassangerArray=array(
                        'booking_id'=>$newBookingId,
                        'category'=>$passObj->category,
                        'title'=>$passObj->title,
                        'firstName'=>$passObj->firstName,
                        'midle_name'=>$passObj->midle_name,
                        'sur_name'=>$passObj->sur_name,
                        'age'=>$passObj->age,
                        'salePrice'=>$passObj->salePrice,
                        'booking_fee'=>$passObj->booking_fee,
                        'eticket'=>$passObj->eticket
                    );
                  $this->BaseModel->save('passanger_details',$newPassangerArray);  
                }
            }
            $ticketCost=  $this->BaseModel->getWhereM('ticket_cost',array('booking_id'=>$bookingId));
            if(!empty($ticketCost))
            {
                $ticketCostObj=$ticketCost[0];
                $newTicketCostArray=array(
                    'booking_id'=>$newBookingId,
                    'basic_fare'=>$ticketCostObj->basic_fare,
                    'tax'=>$ticketCostObj->tax,
                    'apc'=>$ticketCostObj->apc,
                    'sufi'=>$ticketCostObj->sufi,
                    'misc'=>$ticketCostObj->misc,
                    'addit_misc'=>$ticketCostObj->addit_misc,
                    'file_status'=>$ticketCostObj->file_status,
                    'bank_charges'=>$ticketCostObj->bank_charges,
                    'card_charges'=>$ticketCostObj->card_charges,
                    'postage'=>$ticketCostObj->postage,
                    'transection_charges'=>$ticketCostObj->transection_charges,
                    'totalcost'=>$ticketCostObj->totalcost,
                    'cardRefund'=>$ticketCostObj->cardRefund,
                    'cashRefund'=>$ticketCostObj->cashRefund,
                    'againTransection'=>$ticketCostObj->againTransection,
                    'chargebackAmount'=>$ticketCostObj->chargebackAmount,
                    'chargeback_plenty'=>$ticketCostObj->chargeback_plenty
                );
                $this->BaseModel->save('ticket_cost',$newTicketCostArray);
            }
            echo $newBookingId;
        }
        else{ echo 0; }
    }
    public function markedClear()
    {
        $bookingId=  $this->input->post('bookingId');
        $payableTosupplier=round(ticketCost($bookingId),2);
        $loginFlag=$this->session->userdata('flag');
        $brand=$this->session->userdata('company');
        $loginId=$this->session->userdata('userId');
        $bookingDetils=$this->BaseModel->getWhereM('booking_details',array('id'=>$bookingId));
        $supplier=$bookingDetils[0]->supplier_name;
        $trId=  $this->BaseModel->save('transection',array('booking_id'=>$bookingId));
        $trId2=  $this->BaseModel->save('transection',array('booking_id'=>$bookingId));
        $cardPayment =sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$bookingId));
        $bankPayment=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$bookingId));
        $customerPayed=$bankPayment+ $cardPayment;
        
        $this->BaseModel->save('payment',array('transectionId'=>$trId,'pay_to'=>'Expense-Air Ticket Purchases','pay_by'=>$supplier,'amount'=>$payableTosupplier,'booking_ref'=>$bookingId,'pay_date'=>date('Y-m-d'),'pay_type'=>'Dr','description'=>'Air Ticket Purchases','payment_nature'=>'expense','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
        $this->BaseModel->save('payment',array('transectionId'=>$trId,'pay_to'=>$supplier,'pay_by'=>'Expense-Air Ticket Purchases','amount'=>$payableTosupplier,'booking_ref'=>$bookingId,'pay_date'=>date('Y-m-d'),'pay_type'=>'Cr','description'=>'Air Ticket Purchases','payment_nature'=>'supplier','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
        
        
        $this->BaseModel->save('payment',array('transectionId'=>$trId2,'pay_to'=>'Customer','pay_by'=>'Air Ticket Sales-UK','amount'=>$customerPayed,'booking_ref'=>$bookingId,'pay_date'=>date('Y-m-d'),'pay_type'=>'Dr','description'=>'Air Ticket Purchases','payment_nature'=>'supplier','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
        $this->BaseModel->save('payment',array('transectionId'=>$trId2,'pay_to'=>'Air Ticket Sales-UK','pay_by'=>'Customer','amount'=>$customerPayed,'booking_ref'=>$bookingId,'pay_date'=>date('Y-m-d'),'pay_type'=>'Cr','description'=>'Air Ticket Purchases','payment_nature'=>'income','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
        
        $resp=$this->BaseModel->update('booking_details',array('cleared_stat'=>'1'),array('id'=>$bookingId));
        if($resp>0){ echo $resp; }else{ echo 0; }
    }
    public function changeFlagSupplier()
    {
     $supplierId    =  $this->input->post('supplierId');   
     $flag          =  $this->input->post('flag'); 
     if($flag==1){$newFlag=0;} else{ $newFlag=1; }
     $resp=$this->BaseModel->update('suppliers',array('flag'=>$newFlag),array('id'=>$supplierId));
     if($resp >0){ echo $resp; } else{ echo 0; }
    }
    public function changeFlagBank()
    {
     $bankId    =  $this->input->post('bankId');   
     $flag          =  $this->input->post('flag'); 
     if($flag==1){$newFlag=0;} else{ $newFlag=1; }
     $resp=$this->BaseModel->update('bank',array('flag'=>$newFlag),array('id'=>$bankId));
     if($resp >0){ echo $resp; } else{ echo 0; }
    }
    public function changeFlagExpense()
    {
     $expenseId    =  $this->input->post('expenseId');   
     $flag          =  $this->input->post('flag'); 
     if($flag==1){$newFlag=0;} else{ $newFlag=1; }
     $resp=$this->BaseModel->update('expense_head',array('flag'=>$newFlag),array('id'=>$expenseId));
     if($resp >0){ echo $resp; } else{ echo 0; }
    }
    public function changeFlagIncome()
    {
     $incomeId    =  $this->input->post('incomeId');   
     $flag          =  $this->input->post('flag'); 
     if($flag==1){$newFlag=0;} else{ $newFlag=1; }
     $resp=$this->BaseModel->update('income_head',array('flag'=>$newFlag),array('id'=>$incomeId));
     if($resp >0){ echo $resp; } else{ echo 0; }
    }
    public function changeFlagCompany()
    {
     $companyId    =  $this->input->post('companyId');   
     $flag          =  $this->input->post('flag'); 
     if($flag==1){$newFlag=0;} else{ $newFlag=1; }
     $resp=$this->BaseModel->update('company',array('status'=>$newFlag),array('id'=>$companyId));
     if($resp >0){ echo $resp; } else{ echo 0; }
    }
    public function getViewInquiryDetails()
    {
        $inquiryId=  $this->input->post('inquiryId');
        $record=$this->BaseModel->getWhereM('inquiry',array('id'=>$inquiryId));
        $obj=$record[0];
        $html='<table class="table" width="100%">
                        <tr style="background: #ffeb3b75;">
                                <td colspan="4"><u><b>Flight Detail</b></u></td>
                        </tr>
                        <tr>
                                <td><b>Departure Airport</b></td>
                                <td>'.$obj->flight_from .'</td>
                                <td><b>Destination</b></td>
                                <td>'. $obj->destination .'</td>
                        </tr>
                        <tr>
                                <td><b>Departure Date</b></td>
                                <td>'. $obj->departure_date .'</td>
                                <td><b>Return Date</b></td>
                                <td>'. $obj->return_date.'</td>
                        </tr>
                        <tr style="background: #ffeb3b75;">
                                <td colspan="4"><u><b>Contact Detail</b></u></td>
                        </tr>
                        <tr>
                                <td><b>Name</b></td>
                                <td>'. $obj->name.'</td>
                                <td><b>Email</b></td>
                                <td>'. $obj->customer_email.'</td>
                        </tr>
                        <tr>
                                <td><b>Phone #</b></td>
                                <td>'.$obj->customer_phone.'</td>
                                <td><b>Customer Instruction</b></td>
                                <td>'.$obj->customer_instr.'</td>
                        </tr>
                        <tr style="background: #ffeb3b75;">
                                <td colspan="4"><u><b>Preference</b></u></td>
                        </tr>
                        <tr>
                                <td><b>Prefered Airline</b></td>
                                <td>'. $obj->prefered_airline.'</td>
                                <td><b>Ticket Type</b></td>
                                <td>'. $obj->ticket_type.'</td>
                        </tr>
                        <tr>
                                <td><b>Ticket Class</b></td>
                                <td>'. $obj->ticket_class.'</td>
                                <td><b>Fare</b></td>
                                <td>'. $obj->fare.'</td>
                        </tr>
                        <tr style="background: #ffeb3b75;">
                                <td colspan="4"><u><b>Passenger Detail</b></u></td>
                        </tr>
                        <tr>
                                <td><b>Adult</b></td>
                                <td>'. $obj->adult.'</td>
                                <td><b>Child</b></td>
                                <td>'. $obj->child.'</td>
                        </tr>
                        <tr>
                                <td><b>Infant</b>nbsp;</td>
                                <td>'. $obj->infaunt.'</td>
                                <td><b>Inquiry Status</b></td>
                                <td>'. $obj->status.' </td>
                        </tr>
		</table><br>';
        echo $html;
    }
    public function getBookingCommentModel()
    {
        $bookingId=$this->input->post('bookingId');
        $flag=$this->session->userdata('flag');
        $loginId=$this->session->userdata('userId');
        $qryBooking="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.airline,b.pnr,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id And  a.flag='1' and a.canceled_stat!='1' AND a.id='$bookingId' ";
        $bookingData=$this->BaseModel->getQuery($qryBooking);
        $obj=$bookingData[0];
        $ary="select * from event_history where booking_id='$bookingId' order by id desc  ";
        $array=commentGet($ary);
        $logPerson='';
        $dateTimeLog='';
        $logType='';
        $log='';
        $tatalreceived=0;
        $paymentDueDate='';
        $paymentDueDate=idToNameOrderAndLimit('customer_receipt_details','booking_id',$bookingId,'paymentDue_date','Desc','1');

        $cardAmount=sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$bookingId));
        $bankAmount=sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$bookingId))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$bookingId)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$bookingId))+sumOfAmount('payment','amount',array('pay_to'=>'Travel Pack','pay_type'=>'Dr','booking_ref'=>$bookingId));
        $tatalreceived=($cardAmount+$bankAmount);
        if(count($array)>0){ $commentStamp= explode(' ', $array['date']); $commentDateD=date('dM',  strtotime($commentStamp[0])); }
        $commentDivData='';
        $eventQry=" Select * from event_history where booking_id='$bookingId' AND flag='1' order by id desc ";
        $bookingEvents=$this->BaseModel->getQuery($eventQry);
        if(!empty($bookingEvents))
           {
                foreach ($bookingEvents as $eventObj)
                {
                    $dateArray=  explode(' ', $eventObj->date);
                    $flag=idToName('admin','id',$eventObj->agent_id,'flag');
                    $class='';
                    if($flag==1)
                    {
                        $class='adminClass';
                    }
                    else
                    {
                        $class='agentClass';
                    }
                    $commentDivData.='<p class="'.$class.'"><strong>'.idToName('admin','id',$eventObj->agent_id,'login_name').'</strong> ('.date('d-M-y',  strtotime($dateArray[0])).'  '.date('h:m:i:a',  strtotime($dateArray[1])).' ): ('.$eventObj->event_type.')   '.$eventObj->event.'</p>';
                }
        } 
       //$commentDivData='<p class="adminClass"><strong>Admin</strong> (15-Jan-19  11:01:54:am ): (Auto)   Bank payment confirmed and updated.</p>';
        $html='<div class="row">
                    <div class="col-md-12">
			<table class="table display tablColor">
                            <thead>
				<tr>
                                        <th>File No#</th>
                                        <th>File Status</th>
                                        <th>Book Date</th>
                                        <th>Pay Date</th>
                                        <th>Travek Date</th>
                                        <th>Airline</th>
                                        <th>Price</th>
                                        <th>Total Paid</th>
                                        <th>PNRS</th>
                                        <th>Comment Date</th>
				</tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td><a target="_blank" href="'.site_url('BookingDetailBox/'.idencode($obj->id).'/'.idencode(1)).'">'.idToName('company','id',$obj->company,'company_Code').'-'.$obj->id.'</a></td>
                                        <td>Follow Up</td>
                                        <td>'.date('d-M-y',  strtotime($obj->booking_date)).'</td>
                                        <td>'.date('d-M-y',  strtotime($paymentDueDate)).'</td>
                                        <td>'.date('d-M-y',  strtotime($obj->departure_date)).'</td>
                                        <td>'.substr($obj->airline,0,2).'</td>
                                        <td>'.salePrice($obj->id).'</td>
                                        <td>'.number_format($tatalreceived,2).'</td>
                                        <td>'.$obj->pnr.'</td>
                                        <td>'.$commentDateD.'</td>
                                </tr>
			</tbody>
                    </table>	
			</div>	
		</div>
		<div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <form method="post" id="customeLogAddForm">
                        <input type="hidden" name="commetPersonFlg" id="commetPersonFlg" value="'.$flag.'">
                        <input type="hidden" name="commetPersonId" id="commetPersonId" value="'.$loginId.'">
                        <input type="hidden" name="commetAgainstBooking" id="commetAgainstBooking" value="'.$bookingId.'">
                            <div class="row">
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <label>Comment:</label>
                                            <textarea class="form-control" id="customLogAdd" name="customLogAdd" rows="1"></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <button class="btn btn-primary btn-sm" id="customeLogAddBtn" style="margin-top:30px;margin-top: 23px;padding: 12px 9px;">Submit New Note</button> 
                                    </div>
                            </div>
                        </form>
                            <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="bookingnotes">
                                                    '.$commentDivData.'
                                            </div>
                                    </div>
                            </div>
                    </div>
		</div>
	</div>';
        echo $html;
    }
    public function addBookingComment()
    {
       $bookingId=$this->input->post('bookingId');
       $agentId=  $this->input->post('agentId');
       $log=  $this->input->post('comment');
       $logId=$this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'agent_id'=>$agentId,'event_type'=>'Manual','event'=>$log,'flag'=>1));
       $eventQry=" Select * from event_history where booking_id='$bookingId' AND id='$logId'  ";
        $bookingEvents=$this->BaseModel->getQuery($eventQry);
        $commentDivData='';
        $response=array();
        foreach ($bookingEvents as $eventObj)
        {
            $dateArray=  explode(' ', $eventObj->date);
            $flag=idToName('admin','id',$eventObj->agent_id,'flag');
            $class='';
            if($flag==1)
            {
                $class='adminClass';
            }
            else
            {
                $class='agentClass';
            }
            $commentDivData.='<p class="'.$class.'"><strong>'.idToName('admin','id',$eventObj->agent_id,'login_name').'</strong> ('.date('d-M-y',  strtotime($dateArray[0])).'  '.date('h:m:i:a',  strtotime($dateArray[1])).' ): ('.$eventObj->event_type.')   '.$eventObj->event.'</p>';
        }
        $response['code']=$logId;
        $response['data']=$commentDivData;
        echo json_encode($response,true);
    }
    public function addCustomComments()
    {
        $bookingId =  $this->input->post('commentBookingId');
        $agentId =    $this->input->post('commentAgentId');
        $commentA =  $this->input->post('commentCan');
        $res=$this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Manual','agent_id'=>$agentId,'flag'=>1,'event'=>$commentA,'event_nature'=>'cancel'));
        if($res >0){ echo $res; } else{ echo 0; }
    }
    public function addFolloCustomComments()
    {
        $bookingId =  $this->input->post('commentBookingId');
        $agentId =    $this->input->post('commentAgentId');
        $commentA =  $this->input->post('commentCan');
        $res=$this->BaseModel->save('event_history',array('booking_id'=>$bookingId,'event_type'=>'Manual','agent_id'=>$agentId,'flag'=>1,'event'=>$commentA,'event_nature'=>'follow-up'));
        if($res >0){ echo $res; } else{ echo 0; }
    }
    public function getDrAddMoreHtml()
    {
        $countr=$this->input->post('countDr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="dr'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">To (Dr.): &nbsp;</label>';
                $html.='<select name="dr_pay_to[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="drTotalCount(this.value,'."'genTrsnDrSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="dr_amount[]" id="drAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="dr_booking_ref[]" id="customerDrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;
    }
    public function getCrAddMoreHtml()
    {
      $countr=$this->input->post('countCr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="cr'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">By (Cr.): &nbsp;</label>';
                $html.='<select name="cr_pay_by[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="crTotalCount(this.value,'."'crSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="cr_amount[]" id="crAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="cr_booking_ref[]" id="customerCrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;  
    }
    
     public function getDrAddMorePkHtml()
    {
        $countr=$this->input->post('countDr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Pk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'local')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk'));
        $html='';
        $html='<div class="row" id="dr'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">To (Dr.): &nbsp;</label>';
                $html.='<select name="dr_pay_to[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'%supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'%bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'%expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="drTotalCount(this.value,'."'genTrsnDrSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="dr_amount[]" id="drAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="dr_booking_ref[]" id="customerDrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;
    }
    public function getCrAddMorePkHtml()
    {
      $countr=$this->input->post('countCr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Pk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'local')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk'));
        $html='';
        $html='<div class="row" id="cr'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">By (Cr.): &nbsp;</label>';
                $html.='<select name="cr_pay_by[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'%supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'%bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'%expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="crTotalCount(this.value,'."'genTrnsCrSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="cr_amount[]" id="crAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="cr_booking_ref[]" id="customerCrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;  
    }
     public function getDrModelAddMoreHtml()
    {
        $countr=$this->input->post('countDr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="drModel'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">To (Dr.): &nbsp;</label>';
                $html.='<select name="dr_pay_to[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="drTotalCount(this.value,'."'drSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="dr_amount[]" id="drAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="dr_booking_ref[]" id="customerDrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;
    }
    public function getCrModelAddMoreHtml()
    {
      $countr=$this->input->post('countCr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk')); 
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="crModel'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">By (Cr.): &nbsp;</label>';
                $html.='<select name="cr_pay_by[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="crTotalCount(this.value,'."'crSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="cr_amount[]" id="crAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="cr_booking_ref[]" id="customerCrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;  
    }
    
     public function getDrEditModelAddMoreHtml()
    {
        $countr=$this->input->post('countDr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="drModel'.$countr.'">';
            $html.='<div class="col-md-6">';
                $html.='<label for="">To (Dr.): &nbsp;</label>';
                $html.='<select name="dr_pay_to[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="drTotalCount(this.value,'."'edittrsDrSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="dr_amount[]" id="drAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="dr_booking_ref[]" id="customerDrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;
    }
    public function getCrEditModelAddMoreHtml()
    {
      $countr=$this->input->post('countCr');
        $supplierData=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $BankData=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $ExpenseData=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $IncomData=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        $html='';
        $html='<div class="row" id="crEditModel'.$countr.'">';
            $html.='<div class="col-md-6"><input type="hidden" id="transectionEditId'.$countr.'" value="" name="editTransectionId[]" >';
                $html.='<label for="">By (Cr.): &nbsp;</label>';
                $html.='<select name="cr_pay_by[]"  class="form-control">';
                $html.='<option value="">--Select One--</option>';
                
                if(!empty($supplierData)){ foreach($supplierData as $supplierObjDr){ 
                    $html.='<option value="'.$supplierObjDr->supplier_name.'-supplier">'.$supplierObjDr->supplier_name.'  -  '.$supplierObjDr->BankId.'</option>';
                    } }
                if(!empty($BankData)){ foreach ($BankData as $bankObj){
                   $html.='<option value="'.$bankObj->bank_name.'-bank">'.$bankObj->bank_name.'</option>';
                    } }
                if(!empty($ExpenseData)){ foreach($ExpenseData as $expObj){ 
                $html.='<option value="'.$expObj->expense_name.'-expense">'.$expObj->expense_name.'</option>';
                    } }
                if(!empty($IncomData)){ foreach($IncomData as $incomObj){ 
                $html.='<option value="'.$incomObj->head_name.'-income">'.$incomObj->head_name.'</option>';
                    } }
                $html.='</select>';
            $html.='</div>';
            $addfun='onblur="crTotalCount(this.value,'."'editTrsCrSum'".')"';
            $html.='<div class="col-md-3"> 
                    <label for="">Amount (&pound;): &nbsp;</label>
                    <input type="text" name="cr_amount[]" id="crAmountPopCus-'.$countr.'" '.$addfun.'  class="form-control"> 
                </div>';
            
            $html.='<div class="col-md-3"> 
                <label for="" style="width: 170px !important">Booking Ref: &nbsp;</label>
                <input type="text" name="cr_booking_ref[]" id="customerCrRef'.$countr.'"  class="form-control"> 
                </div>';
        $html.='</div>';
        echo $html;  
    }
    public function getBrand()
    {
        $brand=$this->BaseModel->getWhereM('company',array('status'=>1));
        $output='<option value="">--Select Brand--</option>';
        if(!empty($brand))
        {
            foreach($brand as $bObj)
            {
                $output.='<option value="'.$bObj->id.'">'.$bObj->company_name.'</option>';
            }
        }
        echo $output;
    }
}
?>