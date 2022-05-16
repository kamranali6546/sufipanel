<?php class PendingTask extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        $data['view']='pending_task_view';
        $data['page']='table';
        $data['pageTitle']='Pending Task';
        $data['tab']='pendingTask';
         $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
         $data['IncomData']=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
         $qry="select a.id,a.booked_agent_id,a.company,a.booking_date,a.supplier_ref,b.departure_date,b.returnDate,c.fullname  
from booking_details as a ,flight_details as b,customer_contacts as c 
where a.id=b.booking_id and  a.id=c.booking_id and a.flag='10' and a.pending_status='1'  order by a.id asc ";
         $data['PendingTaskData']=$this->BaseModel->getQuery($qry);
         $payMentOtherRequestQry='Select * from paymentRequest where requestType!="Invoice" And requestType!="Cancel File" And requestType!="Refund To Customer" And requestType!="Airline Refund" AND isRead="0" ';
         $data['paymentOtherRequest']=$this->BaseModel->getQuery($payMentOtherRequestQry);
         $data['InvoiceDataRequest']=$this->BaseModel->getWhereM('paymentRequest',array('requestType'=>'Invoice','isRead'=>0));
         $data['CanceledDataRequest']=$this->BaseModel->getWhereM('paymentRequest',array('requestType'=>'Cancel File','isRead'=>0));
         $data['RefundToCustomerRequest']=$this->BaseModel->getWhereM('paymentRequest',array('requestType'=>'Refund To Customer','isRead'=>0));
         $data['AirlineRefundRequest']=$this->BaseModel->getWhereM('paymentRequest',array('requestType'=>'Airline Refund','isRead'=>0));
         $data['ticketorder']=$this->BaseModel->getWhereM('ticketOrderRequest',array('isRead'=>0));
        $this->load->view('dashboard',$data);
    }
    
}