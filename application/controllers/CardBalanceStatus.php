<?php class CardBalanceStatus extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 * @cell 03446613497
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        $data['view']='card_balance_status_view';
        $data['tab']='cardBalance';
        $data['pageTitle']='Card Balance Status';
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
        if(isset($_POST['fliter']))
        {
            $startDate=$this->input->post('startDate');
            $endDate=$this->input->post('endDate');
            $company=$this->input->post('company');
            $condition='';
            if(!empty($startDate) && !empty($endDate))
            {
                $condition.="  booking_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($company))
            {
                 $condition.=" company='$company' AND  ";
            }
            $condition.="  1=1 ";
            $qry="Select * from booking_details where ".$condition;
           $data['bookingRecord']=$this->BaseModel->getQuery($qry);
           $receivedCard_Query=" Select * from card_amount_received  where  date_received BETWEEN '$startDate'  AND  '$endDate'  ";
           $data['receivedCardData']=$this->BaseModel->getQuery($receivedCard_Query);
           $data['countFiles']=$this->BaseModel->getQueryCount($qry);
        }
        else
        {
//            $data['bookingRecord']=$this->BaseModel->record('booking_details');
            $onlyCardQry=" Select booking_details.id,booking_details.booking_date,booking_details.booked_agent_id,booking_details.flag,booking_details.booking_under_brand,booking_details.company,customer_recepet_history.id as paymentId,customer_recepet_history.booking_id as paymentBookingId,customer_recepet_history.receipt_via from booking_details Join customer_recepet_history on booking_details.id=customer_recepet_history.booking_id And customer_recepet_history.receipt_via=1  ";
            $bookingData=$this->BaseModel->getQuery($onlyCardQry);
//            echo '<pre>';
//            print_r($bookingData);
//            echo '</pre>';
            $data['bookingRecord']=$bookingData;
            $data['receivedCardData']=$this->BaseModel->record('card_amount_received');
            $qqry=" Select * from booking_details ";
            $data['countFiles']=$this->BaseModel->getQueryCount($qqry);
            $notreceivedQry="( Select id from booking_details where id Not in ( Select card_amount_received.file_number from card_amount_received ) ) ";
            $responseNotReceivedQry=$this->BaseModel->getQuery($notreceivedQry);
            $data['NotrecivedFiles']=$responseNotReceivedQry;
//            print_r($responseNotReceivedQry);
        }
//        $data['countFiles']=$this->BaseModel->getQueryCount();
        $data['companyData']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $this->load->view('dashboard',$data);
    }
    
    public function cashBookBank()
    {
        
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        if(empty($opingDate) && empty($closingDate))
        {
            $opingDate=date('Y-m-01');
            $closingDate=date('Y-m-d');
        }
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        $bankHead=$this->input->post('bank');
        $bHead=  explode('%',$bankHead);
        if($opingDate!='' && $closingDate!='')
        {
            if(!empty($bHead[0]))
            {
                if($bHead[0]!='All')
                {
                  $qry=" Select * from payment where pay_to ='$bHead[0]' AND payment_nature='bank' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                  $closeQry="Select * from payment where pay_to ='$bHead[0]' AND payment_nature='bank' AND pay_date <='$closingBalanceEndDate' ";
//                  echo $closeQry="Select * from payment where pay_to ='$bHead[0]' AND payment_nature='bank' AND pay_date BETWEEN '$closingBalanceStartDate' AND '$closingBalanceEndDate' ";
                }
                else
                {
                    
                    $qry=" Select * from payment where payment_nature='bank' AND pay_date BETWEEN '$opingDate' AND '$closingDate' "; 
                    //echo $closeQry="Select * from payment where payment_nature='bank' AND  pay_date BETWEEN '$closingBalanceStartDate' AND '$closingBalanceEndDate' ";
                    $closeQry="Select * from payment where payment_nature='bank' AND  pay_date <= '$closingBalanceEndDate' ";
                }
               
            }
            else
            {
                $qry=" Select * from payment where payment_nature='bank' AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                $closeQry="Select * from payment where payment_nature='bank' AND  pay_date <= '$closingBalanceEndDate' "; 
            }
             $result=$this->BaseModel->getQuery($qry);
             $closeResult=$this->BaseModel->getQuery($closeQry);
//            echo "kvkdfg";
//            exit();
//            else
//            {
//            $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
//             $closeQry="Select * from payment where  AND pay_date BETWEEN '$closingBalanceStartDate' AND '$closingBalanceEndDate' ";
//            }
          
          
        }
//        else
//        {
//            $opingDate=date('Y-m-d');
//            $closingDate=date('Y-m-d');
//            if(!empty($bankHead))
//            {
//               $qry=" Select * from payment where pay_to ='$bHead[0]' AND pay_date BETWEEN '$opingDate' AND '$closingDate' "; 
//            }
//            else
//            {
//            $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
//            }
//           $result=$this->BaseModel->getQuery($qry);
//        }
//         print_r($result);
        $openingBalance=0;
        foreach($closeResult as $objClose)
        {
            if($objClose->pay_type=='Dr')
            {
                $openingBalance=$openingBalance+$objClose->amount;
            }
            if($objClose->pay_type=='Cr')
            {
                $openingBalance=$openingBalance-$objClose->amount;
            }
        }
        $data['openingBalance']=$openingBalance;
        $data['openingBalanceDate']=$closingBalanceEndDate;
        $data['view']='bank_cash_book';
        $data['tab']='bankCashBook';
        $data['pageTitle']='Banks/Cards/Cash Books';
        $data['bankHead']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['cashBook']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['bHead']=$bHead[0];
        $this->load->view('dashboard',$data);
    }
}