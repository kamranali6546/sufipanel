<?php error_reporting(0);  class NewBooking extends MY_Controller 
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
        $data['view']='new_booking_view';
        $data['pageTitle']='New Booking';
        $data['via']=$this->BaseModel->getSelectedFieldQry('airport_code,airport_name','airports');
        if($this->session->userdata('flag')==1)
        {
          $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));  
        }
        else
        {
            $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1)); 
        }
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $this->load->view('dashboard',$data);
    }
    public function saveBooking()
    {
//        $bookingDate=explode(' ',$this->input->post('bookingDateC'));
        $bookingDate=$this->input->post('bookingDateC');
        $bookingQote= $this->input->post('quote_value');
        $bookingPaymentNote= $this->input->post('paymentNoteValue');
//       $kk= split('\n', $bookingNotes);
//        echo $bookingNotes;
//        $hhh=explode('\n', $bookingNotes);
//        print_r($kk);
//        exit();
        $bookingDetailsArray=array(
            'booking_date'=>$this->input->post('bookingDateC'),
            'booked_agent_id'=>$this->input->post('bookingAgentID'),
            'supplier_name'=>$this->input->post('supplier_name'),
            'supplier_agent_name'=> $this->input->post('supplierAgent'),
            'supplier_ref'=>$this->input->post('ibe'),
            'booking_under_brand'=>$this->input->post('booking_brand'),
            'flag'=>1,
            'company'=>$this->input->post('booking_brand')
        );
       //booking_notes
        
        $res=$this->BaseModel->save('booking_details',$bookingDetailsArray);
        if(!empty($bookingQote)){
        $this->BaseModel->save('event_history',array('booking_id'=>$res,'agent_id'=>$this->input->post('bookingAgentID'),'event_type'=>'Auto','event'=>$bookingQote,'flag'=>1));
        }
        if(!empty($bookingPaymentNote))
        {
            $this->BaseModel->save('event_history',array('booking_id'=>$res,'agent_id'=>$this->input->post('bookingAgentID'),'event_type'=>'Auto','event'=>$bookingPaymentNote,'flag'=>1));
        }
       $customerContactArray=array(
        'booking_id' => $res,
        'fullname'=>$this->input->post('name'),
        'line_number'=>$this->input->post('lineNumber'),
        'postal_address'=> htmlentities($this->input->post('postalAddress')),
        'mobile'=>$this->input->post('mobileNumber'),
        'email'=>$this->input->post('customerEmail'),
        'source_of_booking'=>$this->input->post('source_booking')
               );
       $coustomerContactRes=$this->BaseModel->save('customer_contacts',$customerContactArray);
       $paying_method=$this->input->post('paying_method');
       $paymentDueDate= explode(' ',$this->input->post('paymentDueDate'));
       if($paying_method=="Bank")
        {
           $receiptCustomerDetails=array(
           'booking_id' => $res,
           'paying_by'=>$this->input->post('paying_method'),
           'paymentDue_date'=>$paymentDueDate[0],
           'paymentDueTime'=>$paymentDueDate[1],
           'newbookingChargeAmount'=>$this->input->post('amountCharged')
            );
        }
        else if($paying_method=="Card")
        {
           $receiptCustomerDetails=array(
           'booking_id' => $res,
           'paying_by'=>$this->input->post('paying_method'),
           'postal_address'=>htmlentities($this->input->post('postalAddress')),
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
           $card=array(
               'booking_id'=>$res,
               'card_number'=>$this->input->post('cardNumber'),
               'card_holder_name'=>$this->input->post('cardHolderName'),
               'card_expiry'=>$this->input->post('cardExpiryDate'),
               'cvv'=>$this->input->post('cvvNumber'),
               'validFrom'=>$this->input->post('validFrom'),
               'card_type'=>$this->input->post('cardType'),
               'card_brand'=>$this->input->post('cardBrand'),
               'issue_bank_name'=>$this->input->post('issuingBank'),
               'new_address'=>htmlentities($this->input->post('postalAddress')),
               'flag'=>1
               
           );
          // $this->BaseModel->save('card_details',$card);
        }
      $customerReceiptRes= $this->BaseModel->save('customer_receipt_details',$receiptCustomerDetails);
      $departed_date=  explode(' ', $this->input->post('departureDate'));
      $returnDate=  explode(' ',$this->input->post('returnDate'));
      $pnrExpiryDate=  explode(' ',$this->input->post('pnrExpireDate'));
      $fareExpirtDate=  explode(' ',$this->input->post('fareExpireDate'));
      $passangerCate=$this->input->post('category');
      $passangerTitle=$this->input->post('passangerTitle');
      $passangerFirstNanme=$this->input->post('firstName');
      $passangerMiddleName=$this->input->post('middle_name');
      $passangerSurName=$this->input->post('sir_name');
      $passangerAge=$this->input->post('age');
      $passangerSalePrice=$this->input->post('salePrice');
      $passangerBookingFee=$this->input->post('booking_fee');
      $countPassenger=count($passangerCate);
      $customerFlightDetails=array(
          'booking_id' => $res, 
          'departure'=>$this->input->post('bookingDeparture'),
          'destination'=>$this->input->post('bookingDestination'),
          'via'=>  implode(',',$this->input->post('bookingVia')),
          'returningVia'=>  implode(',',$this->input->post('bookingViaReturn')),
          'flight_type'=>$this->input->post('flightType'),
          'departure_date'=>$departed_date[0],
          'departedTime'=>$departed_date[1],
          'returnDate'=>$returnDate[0],
          'returnTime'=>$returnDate[1],
          'airline'=>$this->input->post('bookingAirline'),
//          'flight_number'=>$this->input->post('flightNo'),
          'flight_class'=>$this->input->post('flightClass'),
          'number_Of_segment'=>($this->input->post('noOfSegments')*$countPassenger),
          'pnr'=>$this->input->post('pnr'),
          'airlineLocatore'=>  $this->input->post('airlineLocatore'),
          'gds'=>$this->input->post('gds'),
          'pnrExpiryDate'=>$pnrExpiryDate[0],
          'pnrExpiryTime'=>$pnrExpiryDate[1],
          'fareExpiryDate'=>$fareExpirtDate[0],
          'fareExpiryTime'=>$fareExpirtDate[1],
          'ticketDetails'=>$this->input->post('ticket_details'),
          'systemFlightDetails'=>$this->input->post('systemFlightDetails')
      );
//      print_r($customerFlightDetails);
//      die();
      $flightDetailsRes=$this->BaseModel->save('flight_details',$customerFlightDetails);
      $totalCost=$this->input->post('basicFare')+$this->input->post('tax') + $this->input->post('apc') + $this->input->post('bankCharge') + $this->input->post('cardCharges') + $this->input->post('transectionCharges') ;
      $ticketCostArray=array(
          'booking_id'=> $res,
          'basic_fare'=>$this->input->post('basicFare'),
          'tax'=>$this->input->post('tax'),
          'apc'=>$this->input->post('apc'),
          'sufi'=>$this->input->post('safi'),
          'misc'=>$this->input->post('misc'),
         // 'file_status'=>$this->input->post('fileStatus'),
//          'bank_charges'=>$this->input->post('bankCharge'),
          'card_charges'=>$this->input->post('cardCharges'),
          'transection_charges'=>$this->input->post('transectionCharges'),
          'totalcost'=>$totalCost
      );
      $customerTicketCostRes=$this->BaseModel->save('ticket_cost',$ticketCostArray);
      $passangerCate=$this->input->post('category');
      $passangerTitle=$this->input->post('passangerTitle');
      $passangerFirstNanme=$this->input->post('firstName');
      $passangerMiddleName=$this->input->post('middle_name');
      $passangerSurName=$this->input->post('sir_name');
      $passangerAge=$this->input->post('age');
      $passangerSalePrice=$this->input->post('salePrice');
      $passangerBookingFee=$this->input->post('booking_fee');
      $countPassenger=count($passangerCate);
     for($passengerStart=0;$passengerStart < $countPassenger ; $passengerStart++)
     {
         $passangerArray=array(
            'booking_id'=> $res,
            'category'=>$passangerCate[$passengerStart],
            'title'=>$passangerTitle[$passengerStart],
            'firstName'=>$passangerFirstNanme[$passengerStart],
            'midle_name'=>$passangerMiddleName[$passengerStart],
            'sur_name'=>$passangerSurName[$passengerStart],
            'age'=>$passangerAge[$passengerStart],
            'salePrice'=>$passangerSalePrice[$passengerStart],
            'booking_fee'=>$passangerBookingFee[$passengerStart]
         );
         $this->BaseModel->save('passanger_details',$passangerArray);
         //print_r($passangerArray);
     }
    // exit();
        if($res > 0)
            {
                  unset($_POST);
                  redirect(base_url('Pending'));
//                  $data['view']='new_booking_view';
//                   $data['via']=$this->BaseModel->getSelectedFieldQry('airport_code,airport_name','airports');
//                  $this->load->view('dashboard',$data);
            }
            else
            {
                    $data['view']='new_booking_view';
                    if($this->session->userdata('flag')==1)
                    {
                      $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));  
                    }
                    else
                    {
                        $data['copany']=$this->BaseModel->getWhereM('company',array('id'=>$this->session->userdata('company'))); 
                    }
                    $data['via']=$this->BaseModel->getSelectedFieldQry('airport_code,airport_name','airports');
                    $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
                    $this->load->view('dashboard',$data);
            }
    }
}