<?php class Transection extends MY_Controller 
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
        $data['view']='transection_view';
        $data['tab']='transection';
//        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $this->load->view('dashboard',$data);
    }
    public function pk_transection()
    {
       $data['view']='pk_transection_view';
        $data['tab']='Pktransection';
//        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Pk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'local'));
        $this->load->view('dashboard',$data); 
    }
    public function makeTransection()
    {
//        print_r($_POST);
        $loginFlag=$this->session->userdata('flag');
        $brand=$this->session->userdata('company');
        $loginId=$this->session->userdata('userId');
        $dr_supplier=$this->input->post('dr_pay_to');
        $cr_supplier=$this->input->post('cr_pay_by');
        $cr_Amount=$this->input->post('cr_amount');
        $dr_Amount=$this->input->post('dr_amount');
        $cr_Reference=$this->input->post('cr_booking_ref');
        $dr_Reference=$this->input->post('dr_booking_ref');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $transectionDate=$this->input->post('transectionDate');
        
         $drCount=count($dr_supplier);
        $crCount=count($cr_supplier);
        $tdate='';
        if(!empty($transectionDate))
        {
            $tdate=date('Y-m-d',  strtotime($transectionDate));
        }
        else
        {
            $tdate=date('Y-m-d');
        }
        $resp='';
        $transectionId='';
        if($drCount==$crCount)
        {
           foreach($dr_supplier as $key=> $drentry)
            {
               $dr_supplierSplit='';
               $cr_supplierSplit='';
                $dr_supplierSplit=  explode('-', $dr_supplier[$key]);
                $cr_supplierSplit=  explode('-', $cr_supplier[$key]);
                $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                if($dr_supplierSplit[0]=='Customer')
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 else
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 
                if($cr_supplierSplit[0]=='Customer')
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
                else
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
            } 
        }
        if($resp>0)
        {
            echo $resp;
        }
        else{ echo 0; }
    }
     public function makeTransectionPk()
    {
         $loginFlag=$this->session->userdata('flag');
        $brand=$this->session->userdata('company');
        $loginId=$this->session->userdata('userId');
        $dr_supplier=$this->input->post('dr_pay_to');
        $cr_supplier=$this->input->post('cr_pay_by');
        $cr_Amount=$this->input->post('cr_amount');
        $dr_Amount=$this->input->post('dr_amount');
        $cr_Reference=$this->input->post('cr_booking_ref');
        $dr_Reference=$this->input->post('dr_booking_ref');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $transectionDate=$this->input->post('transectionDate');
        $drCount=count($dr_supplier);
        $crCount=count($cr_supplier);
        $tdate='';
        if(!empty($transectionDate))
        {
           $tdate=date('Y-m-d',  strtotime($transectionDate));
        }
        else
        {
            $tdate=date('Y-m-d');
        }
        if($drCount==$crCount)
        {
           foreach($dr_supplier as $key=> $drentry)
            {
               $dr_supplierSplit='';
               $cr_supplierSplit='';
                $dr_supplierSplit=  explode('%', $dr_supplier[$key]);
                $cr_supplierSplit=  explode('%', $cr_supplier[$key]);
                $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                if($dr_supplierSplit[0]=='Customer')
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 else
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 
                if($cr_supplierSplit[0]=='Customer')
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
                else
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
            } 
        }
       // exit();
//        $dr_supplierSplit=  explode('%', $dr_supplier);
//        $cr_supplierSplit=  explode('%', $cr_supplier);
//        $resp='';
//        $transectionId='';
//        if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 ){
//        $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference));
//        if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='')
//        { 
//            
//            if($dr_supplierSplit[0]=='Customer')
//            {
//                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>'customer'));
//            }
//            else
//            {
//                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1]));
//            }
//            
//        }
//        if($cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0)
//        {
//            if($cr_supplierSplit[0]=='Customer')
//            {
//                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'));
//            }
//            else
//            {
//                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1]));
//            }
//            
//        }
        if($resp>0)
        {
            echo $resp;
        }
        else{ echo 0; }
    }
    public function generalTransectionAdd()
    {
        $dr_supplier=$this->input->post('dr_pay_to');
        $cr_supplier=$this->input->post('cr_pay_by');
        $cr_Amount=$this->input->post('cr_amount');
        $dr_Amount=$this->input->post('dr_amount');
        $cr_Reference=$this->input->post('cr_booking_ref');
        $dr_Reference=$this->input->post('dr_booking_ref');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $transectionDate=$this->input->post('transectionDate');
        $tdate='';
        if(!empty($transectionDate))
        {
            $tdate=date('Y-m-d',  strtotime($transectionDate));
        }
        else
        {
            $tdate=date('Y-m-d');
        }
        $dr_supplierSplit=  explode('-', $dr_supplier);
        $cr_supplierSplit=  explode('-', $cr_supplier);
        $resp='';
        $transectionId='';
        if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 )
        {
        $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference));
        if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $dr_Reference!='')
        {   
            if($dr_supplierSplit[0]=='Customer')
            {
                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','card_no'=>$cardNumber,'description'=>$transection_description,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'));
            }
            else
            {
                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1]));
            }
            
        }
        if($cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 && $cr_Reference!='')
        {   
            if($cr_supplierSplit[0]=='Customer')
            {
                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'));
            }
            else
            {
                $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1])); 
            }
           
        }
        if($resp >0)
        {
            echo $resp;
        }
        else
        {
            echo 0;
        }
        }
    }
    public function customerPayementAdd()
    {
        $dr_supplier=$this->input->post('dr_pay_to');
        $cr_supplier=$this->input->post('cr_pay_by');
        $cr_Amount=$this->input->post('cr_amount');
        $dr_Amount=$this->input->post('dr_amount');
        $cr_Reference=$this->input->post('cr_booking_ref');
        $dr_Reference=$this->input->post('dr_booking_ref');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $transectionDate=$this->input->post('transectionDate');
        $tdate='';
        $loginFlag=$this->session->userdata('flag');
        $brand=$this->session->userdata('company');
        $loginId=$this->session->userdata('userId');
        $drCount=count($dr_supplier);
        $crCount=count($cr_supplier);
        $tdate='';
        $cardTerminals=array('Debit Card Charge Global Travel','Credit Card Charge Global Travel','Card Charge Bright Holiday','CARD CHARGES Square UP BH','Card ChargesGlobal Travel');
        if(!empty($transectionDate))
        {
           $tdate=date('Y-m-d',  strtotime($transectionDate));
        }
        else
        {
            $tdate=date('Y-m-d');
        }
        if($drCount==$crCount)
        {
           foreach($dr_supplier as $key=> $drentry)
            {
               $dr_supplierSplit='';
               $cr_supplierSplit='';
                $dr_supplierSplit=  explode('-', $dr_supplier[$key]);
                $cr_supplierSplit=  explode('-', $cr_supplier[$key]);
                $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                if($dr_supplierSplit[0]=='Customer')
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 else
                 {
                     $isCard=0;
                     foreach($cardTerminals as $cards)
                     {
                         if($dr_supplierSplit[0]==$cards)
                         {
                            $isCard=1; 
                         }
                     }
                     if($isCard==1)
                     {
                         $cardCharges=round(($dr_Amount[$key]*3)/100,2); 
                         $newTransectionID=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                         $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $resp3=$this->BaseModel->save('payment',array('transectionId'=>$newTransectionID,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$cardCharges,'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'payment_nature'=>'Card Charges','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $resp4=$this->BaseModel->save('payment',array('transectionId'=>$newTransectionID,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cardCharges,'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $oldCardCharges=getCardCharges($cr_Reference[$key]);
                         $newChargees=$oldCardCharges+$cardCharges; 
                         $this->BaseModel->update('ticket_cost',array('card_charges'=>$newChargees),array('booking_id'=>$cr_Reference[$key]));
                     }
                     else
                     {
                        $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId)); 
                     }
                     
                 }
                 
                if($cr_supplierSplit[0]=='Customer')
                {
                    if($cardNumber!='')
                    {
                        $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                    }
                    else
                    {
                        $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                    }
                    
                }
                else
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
            } 
        }
        if($resp >0)
            {
                echo $resp;
            }
            else
            {
                echo 0;
            }
//        if(!empty($transectionDate))
//        {
//            $tdate=date('Y-m-d',  strtotime($transectionDate));
//        }
//        else
//        {
//            $tdate=date('Y-m-d');
//        }
//        $resp='';
//        $dr_supplierSplit=  explode('%', $dr_supplier);
//        $cr_supplierSplit=  explode('%', $cr_supplier);
//        $transectionId='';
//        if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 )
//        {
//            $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference));
//            if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $dr_Reference!='')
//            {   
//                if($dr_supplierSplit[0]=='Customer')
//                {
//                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','card_no'=>$cardNumber,'description'=>$transection_description,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'));
//                }
//                else
//                {
//                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'booking_ref'=>$dr_Reference,'pay_date'=>$tdate,'pay_type'=>'Dr','card_no'=>$cardNumber,'description'=>$transection_description,'next_date'=>$next_Due_Date,'payment_nature'=>$dr_supplierSplit[1])); 
//                }
//
//            }
//            if($cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 && $cr_Reference!='')
//            {   
//                if($cr_supplierSplit[0]=='Customer')
//                {
//                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'));
//                }
//                else
//                {
//                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'booking_ref'=>$cr_Reference,'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1]));
//                }
//
//            }
//            if($resp >0)
//            {
//                echo $resp;
//            }
//            else
//            {
//                echo 0;
//            }
//        }
    }
    public function doDelete()
    {
        $transectionId=  $this->input->post('transectionIdDel');
        $result=$this->BaseModel->del('payment',array('transectionId'=>$transectionId));
        $result2=$this->BaseModel->del('transection',array('transection_id'=>$transectionId));
        if($result>0 && $result2>0)
        {
            echo $result;
        }
        else
        {
            echo 0;
        }
    }
    public function paymentUpdatedDo_old()
    {
//        print_r($_POST);
        $transectionIdEdit=  $this->input->post('editTransectionId');
        $dr_supplier=$this->input->post('dr_pay_to_Edit');
        $cr_supplier=$this->input->post('cr_pay_by_Edit');
        $cr_Amount=$this->input->post('cr_amountEdit');
//      echo"shi";
//      exit();
        $dr_Amount=$this->input->post('dr_amountEdit');
        $cr_Reference=$this->input->post('cr_booking_refEdit');
        $dr_Reference=$this->input->post('dr_booking_refEdit');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $paymentDate=  $this->input->post('paymentDate');
        $dr_supplierSplit=  explode('-', $dr_supplier);
        $cr_supplierSplit=  explode('-', $cr_supplier);
        $resp='';
        $getTransectionDetails=$this->BaseModel->getWhereM('payment',array('transectionId'=>$transectionIdEdit));
        $crUpdateId='';
        $drUpdateId='';
        if($getTransectionDetails[0]->pay_type=='Cr')
        {
             $crUpdateId=$getTransectionDetails[0]->id;
             $drUpdateId=$getTransectionDetails[1]->id;
        }
        else if($getTransectionDetails[1]->pay_type=='Cr')
        {
            $crUpdateId=$getTransectionDetails[1]->id;
            $drUpdateId=$getTransectionDetails[0]->id;
        }
//        echo $crUpdateId;
//        echo $drUpdateId;
//        print_r($getTransectionDetails);
        $transectionId='';
        $resp='';
        if($cr_Amount==$dr_Amount)
        {
            if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 )
            {
            if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $dr_Reference!='')
            {   
                if($dr_supplierSplit[0]=='Customer')
                {
                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'pay_type'=>'Dr','card_no'=>$cardNumber,'description'=>$transection_description,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'),array('id'=>$drUpdateId));
                }
                else
                {
                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'pay_type'=>'Dr','card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1]),array('id'=>$drUpdateId));
                }

            }
            if($cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 && $cr_Reference!='')
            {   
                if($cr_supplierSplit[0]=='Customer')
                {
//                    echo"shahi";
                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'),array('id'=>$crUpdateId));
                }
                else
                {
                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1]),array('id'=>$crUpdateId)); 
                }

            }
                if($resp >0)
                {
                    echo $resp;
                }
                else
                {
                    echo 0;
                }
            }
        }
        else{ echo 0; }
    }
    
    public function paymentUpdatedDo()
    {
//        print_r($_POST);
        $transectionIdEdit=  $this->input->post('editTransectionId');
        $dr_supplier=$this->input->post('dr_pay_to_Edit');
        $cr_supplier=$this->input->post('cr_pay_by_Edit');
        $cr_Amount=$this->input->post('cr_amountEdit');
//      echo"shi";
//      exit();
        $dr_Amount=$this->input->post('dr_amountEdit');
        $cr_Reference=$this->input->post('cr_booking_refEdit');
        $dr_Reference=$this->input->post('dr_booking_refEdit');
        $transection_description=$this->input->post('tr_description');
        $cardNumber=  $this->input->post('card_number');
        $next_Due_Date=$this->input->post('next_due_Date');
        $paymentDate=  $this->input->post('paymentDate');
//        $dr_supplierSplit=  explode('%', $dr_supplier);
//        $cr_supplierSplit=  explode('%', $cr_supplier);
        $resp='';
        foreach($transectionIdEdit as $key2)
        {
            if(!empty($key2))
            {
              $this->BaseModel->del('payment',array('transectionId'=>$key2));  
            }   
            else
            {

            }
        }
        $loginFlag=$this->session->userdata('flag');
        $brand=$this->session->userdata('company');
        $loginId=$this->session->userdata('userId');
        $drCount=count($dr_supplier);
        $crCount=count($cr_supplier);
        $tdate='';
        if(!empty($paymentDate))
        {
           $tdate=date('Y-m-d',  strtotime($paymentDate));
        }
        else
        {
            $tdate=date('Y-m-d');
        }
        $cardTerminals=array('Debit Card Charge Global Travel','Credit Card Charge Global Travel','Card Charge Bright Holiday','CARD CHARGES Square UP BH','Card ChargesGlobal Travel');
        if($drCount==$crCount)
        {
           foreach($dr_supplier as $key=> $drentry)
            {
               $dr_supplierSplit='';
               $cr_supplierSplit='';
                $dr_supplierSplit=  explode('-', $dr_supplier[$key]);
                $cr_supplierSplit=  explode('-', $cr_supplier[$key]);
                $transectionId=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                if($dr_supplierSplit[0]=='Customer')
                 {
                     $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                 }
                 else
                 {
                    $isCard=0;
                     foreach($cardTerminals as $cards)
                     {
                         if($dr_supplierSplit[0]==$cards)
                         {
                            $isCard=1; 
                         }
                     }
                     if($isCard==1)
                     {
                         $cardCharges=round(($dr_Amount[$key]*3)/100,2); 
                         $newTransectionID=$this->BaseModel->save('transection',array('booking_id'=>$dr_Reference[$key]));
                         $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $resp3=$this->BaseModel->save('payment',array('transectionId'=>$newTransectionID,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$cardCharges,'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'payment_nature'=>'Card Charges','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $resp4=$this->BaseModel->save('payment',array('transectionId'=>$newTransectionID,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cardCharges,'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                         $oldCardCharges=getCardCharges($cr_Reference[$key]);
                         $newChargees=$oldCardCharges+$cardCharges; 
                         $this->BaseModel->update('ticket_cost',array('card_charges'=>$newChargees),array('booking_id'=>$cr_Reference[$key]));
                     }
                     else
                     {
                         $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount[$key],'booking_ref'=>$dr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Dr','description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                     } 
                 }
                 
                if($cr_supplierSplit[0]=='Customer')
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer','brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
                else
                {
                    $resp=$this->BaseModel->save('payment',array('transectionId'=>$transectionId,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount[$key],'booking_ref'=>$cr_Reference[$key],'pay_date'=>$tdate,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1],'brand'=>$brand,'login_flag'=>$loginFlag,'login_person'=>$loginId));
                }
            } 
        }
//        $getTransectionDetails=$this->BaseModel->getWhereM('payment',array('transectionId'=>$transectionIdEdit[0]));
//        $crUpdateId='';
//        $drUpdateId='';
//        if($getTransectionDetails[0]->pay_type=='Cr')
//        {
//             $crUpdateId=$getTransectionDetails[0]->id;
//             $drUpdateId=$getTransectionDetails[1]->id;
//        }
//        else if($getTransectionDetails[1]->pay_type=='Cr')
//        {
//            $crUpdateId=$getTransectionDetails[1]->id;
//            $drUpdateId=$getTransectionDetails[0]->id;
//        }
//        echo $crUpdateId;
//        echo $drUpdateId;
//        print_r($getTransectionDetails);
//        $transectionId='';
//        $resp='';
//        if($cr_Amount==$dr_Amount)
//        {
//            if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 )
//            {
//            if($dr_supplier!='' && $dr_Amount!=0 && $dr_Amount!='' && $dr_Reference!='')
//            {   
//                if($dr_supplierSplit[0]=='Customer')
//                {
//                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'pay_type'=>'Dr','card_no'=>$cardNumber,'description'=>$transection_description,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'),array('id'=>$drUpdateId));
//                }
//                else
//                {
//                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$dr_supplierSplit[0],'pay_by'=>$cr_supplierSplit[0],'amount'=>$dr_Amount,'pay_type'=>'Dr','card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'description'=>$transection_description,'payment_nature'=>$dr_supplierSplit[1]),array('id'=>$drUpdateId));
//                }
//
//            }
//            if($cr_supplier!='' && $cr_Amount!='' && $cr_Amount!=0 && $cr_Reference!='')
//            {   
//                if($cr_supplierSplit[0]=='Customer')
//                {
////                    echo"shahi";
//                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>'customer'),array('id'=>$crUpdateId));
//                }
//                else
//                {
//                    $resp=$this->BaseModel->update('payment',array('transectionId'=>$transectionIdEdit,'pay_date'=>$paymentDate,'pay_to'=>$cr_supplierSplit[0],'pay_by'=>$dr_supplierSplit[0],'amount'=>$cr_Amount,'pay_type'=>'Cr','description'=>$transection_description,'card_no'=>$cardNumber,'next_date'=>$next_Due_Date,'payment_nature'=>$cr_supplierSplit[1]),array('id'=>$crUpdateId)); 
//                }
//
//            }
//               
//            }
//        }
//        else{ echo 0; }
         if($resp >0)
        {
            echo $resp;
        }
        else
        {
            echo 0;
        }
    }
}