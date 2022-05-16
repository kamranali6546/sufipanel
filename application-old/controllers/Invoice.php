<?php 
class Invoice extends CI_Controller
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
        //$data['view']='invoice_view';
        //$data['tab']='Invoice';
        $id=iddecode($this->uri->segment(2));
        $data['pageTitle']='Invoice';
        $data['bookingId']=$id;
        $bookingId=$id;
        $data['bookingId']=$bookingId;
//        $data['shortMessage']=$shortmessage;
//        $data['customerTitle']=$title;
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $data['companyId']=$companyId;
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $data['flightDetails']=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $data['passengerDetails']=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $data['ContactDetails']=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $data['customerReceipt']=$this->BaseModel->getWhereM('customer_recepet_history',array('booking_id'=>$bookingId));
        $data['paymentDueDateTime']=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
        $data['agenetName']=idToName('admin','id',$agentId,'login_name');
        $data['directLineOffice']=idToName('admin','id',$agentId,'direct_line_number');
        $data['AgentLine']=idToName('admin','id',$agentId,'direct_line_number');
        $data['agentEmail']=idToName('admin','id',$agentId,'email');
        $data['webSite']=idToName('admin','id',$agentId,'webLink');
        $data['bookingDate']=idToName('booking_details','id',$bookingId,'booking_date');
        $data['FileNo']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        $data['FileNoSaveAble']='Invoice-Order-Ref-'.idToName('company','id',$companyId,'company_Code').'-'.$bookingId.'-'.date('d-m-Y');
        $data['PaymentRecivedFromCustomer']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_to'=>'Customer'));
        $dueDateQry=" Select * from customer_receipt_details where booking_id='$bookingId' order by id DESC limit 1 ";
        $data['paymentDueDate'] =  $this->BaseModel->getQuery($dueDateQry);
        $data['agentLoginEmail']=idToName('admin','id',$this->session->userdata('userId'),'email');
        $data['agentLoginName']=idToName('admin','id',$this->session->userdata('userId'),'login_name');
        $this->load->view('invoice_view.php',$data);
    }
    public function index2()
    {
        //$data['view']='invoice_view';
        //$data['tab']='Invoice';
        $id=iddecode($this->uri->segment(2));
        $data['pageTitle']='Invoice';
        $data['bookingId']=$id;
        $bookingId=$id;
        $data['bookingId']=$bookingId;
//        $data['shortMessage']=$shortmessage;
//        $data['customerTitle']=$title;
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $data['companyId']=$companyId;
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $data['flightDetails']=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $data['passengerDetails']=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $data['ContactDetails']=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $data['customerReceipt']=$this->BaseModel->getWhereM('customer_recepet_history',array('booking_id'=>$bookingId));
        $data['paymentDueDateTime']=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
        $data['agenetName']=idToName('admin','id',$agentId,'login_name');
        $data['directLineOffice']=idToName('admin','id',$agentId,'direct_line_number');
        $data['AgentLine']=idToName('admin','id',$agentId,'direct_line_number');
        $data['agentEmail']=idToName('admin','id',$agentId,'email');
        $data['webSite']=idToName('admin','id',$agentId,'webLink');
        $data['bookingDate']=idToName('booking_details','id',$bookingId,'booking_date');
        $data['FileNo']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        $data['FileNoSaveAble']='Invoice-Order-Ref-'.idToName('company','id',$companyId,'company_Code').'-'.$bookingId.'-'.date('d-m-Y');
        $data['PaymentRecivedFromCustomer']=$this->BaseModel->getWhereM('payment',array('booking_ref'=>$bookingId,'pay_type'=>'Cr','pay_to'=>'Customer'));
        $dueDateQry=" Select * from customer_receipt_details where booking_id='$bookingId' order by id DESC limit 1 ";
        $data['paymentDueDate'] =  $this->BaseModel->getQuery($dueDateQry);
        $this->load->view('invoice_view2.php',$data);
    }
    
    public function finalInvoice()
    {
        $bookingId=$this->input->post('bookingId');
//        $shortmessage=$this->input->post('short_message');
//        $title=$this->input->post('customerTitle');
        //$data['view']='final_invoice_view';
       // $data['view']='create_invoice_view';
       // $data['tab']='Invoice';
       // $data['pageTitle']='Invoice';
        $data['bookingId']=$bookingId;
        $data['shortMessage']=$shortmessage;
        $data['customerTitle']=$title;
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $data['companyId']=$companyId;
        $agentId=idToName('booking_details','id',$bookingId,'booked_agent_id');
        $data['flightDetails']=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $data['passengerDetails']=$this->BaseModel->getWhereM('passanger_details',array('booking_id'=>$bookingId));
        $data['ContactDetails']=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $data['customerReceipt']=$this->BaseModel->getWhereM('customer_recepet_history',array('booking_id'=>$bookingId));
        $data['paymentDueDateTime']=$this->BaseModel->getWhereM('customer_receipt_details',array('booking_id'=>$bookingId));
        $data['agenetName']=idToName('admin','id',$agentId,'login_name');
        $data['directLineOffice']=idToName('admin','id',$agentId,'direct_line_number');
        $data['AgentLine']=idToName('admin','id',$agentId,'direct_line_number');
        $data['agentEmail']=idToName('admin','id',$agentId,'email');
        $data['webSite']=idToName('admin','id',$agentId,'webLink');
        $data['bookingDate']=idToName('booking_details','id',$bookingId,'booking_date');
        $data['FileNo']=idToName('company','id',$companyId,'company_Code').'-'.$bookingId;
        $this->load->view('invoice_view.php',$data); 
    }
}
    ?>