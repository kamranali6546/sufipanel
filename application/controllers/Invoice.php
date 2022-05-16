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
        $data['AgentLine']=idToName('admin','id',$agentId,'cell');
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
    public function generate_invoice($bookingId)
    {
        $data['view']='invoice_generate_view';
        
        $data['tab']='';
        $data['pageTitle']='Invoice Generate';
        $data['bookingId']=iddecode($bookingId);
        $this->load->view('dashboard',$data);
    }
    public function pdf_invoice()
    {
        require './vendor/autoload.php';
        
        $bookingId      =  $this->input->post('booing');
        $from           =  $this->input->post('seg_from');
        $to             =  $this->input->post('seg_to');
        $airline        =  $this->input->post('seg_airline');
        $flightNo       =  $this->input->post('seg_flightNo');
        $dertDate       =  $this->input->post('seg_dep_Date');
        $dertTime       =  $this->input->post('seg_dep_time');
        $arrDate        =  $this->input->post('seg_arr_Date');
        $arrTime        =  $this->input->post('seg_arr_time');
        $companyId=idToName('booking_details','id',$bookingId,'company');
        $companyCode=idToName('company','id',$companyId,'company_Code');
        $data['fileN']=$bookingId;
        $flightHtml='';
        if(!empty($from) && count($from) >0)
        {
            foreach($from as $key=>$itenery)
            {
                $air=  explode('-', $airline[$key]);
                $flightHtml.='<tr>';
                        $flightHtml.='<td>Airline  <img src="'.base_url().'lib/images/airlines/'.$air[0].'.gif"><br><span>Flight No. '.$flightNo[$key].'</span></td>';    
                        $flightHtml.='<td style="text-align: center;"><span>'.$itenery.'</span><br><br><span>'.$to[$key].'</span></td>';    
                        $flightHtml.='<td style="text-align: center;"><span>'.$dertTime[$key].'</span><br><br><span>'.date('d-M-y',strtotime($dertDate[$key])).'</span></td>';    
                        $flightHtml.='<td style="text-align: center;"><span>'.$arrTime[$key].'</span><br><br><span>'.date('d-M-y',strtotime(arrDate[$key])).'</span></td>';    
                $flightHtml.='</tr>';
            }
        }
//        print_r($from);
//        echo $flightHtml;
        $data['flightIt']=$flightHtml;
        $data['flightDetails']=$this->BaseModel->getWhereM('flight_details',array('booking_id'=>$bookingId));
        $data['ContactDetails']=$this->BaseModel->getWhereM('customer_contacts',array('booking_id'=>$bookingId));
        $htmldd=$this->load->view('invoice_viewer',$data,true);
//        echo $htmldd;
//        exit();
        $options = new Dompdf\Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('debugKeepTemp', TRUE);
        $options->set('isHtml5ParserEnabled', true);
        $proHtml=  $this->ob_html_compress($htmldd);
         $dompdf = new Dompdf\Dompdf($options);
        $dompdf->loadHtml($proHtml);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Get the generated PDF file contents
        $pdf = $dompdf->output();
    $dompdf->stream("Invoice-".$companyCode."-".$bookingId.".pdf", array("Attachment" => true));
        // Output the generated PDF to Browser
//        $dompdf->stream();
    }
    public function ob_html_compress($buf)
    {
     return str_replace(array("\n","\r","\t"),'',$buf);
    }
}
    ?>