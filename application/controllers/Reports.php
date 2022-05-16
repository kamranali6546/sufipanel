<?php class Reports extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
        $this->load->library('excel');
        //date_default_timezone_set('Europe/London');
    }
    public function index()
    {
        $data['view']='general_report_view';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $flag=$this->session->userdata('flag');
        $company=$this->session->userdata('company');
        $agend=$this->session->userdata('userId');
        if($flag==1 && $company==1)
            {
                $agents=$this->BaseModel->getWhereM('admin',array('flag'=>5,'agent_status'=>1));
                $companyData=$this->BaseModel->getWhereM('company',array('status'=>1));  
                 $data['agentsData']=$agents;
                 $data['companyData']=$companyData;
            }
        else if($flag==2 && $company!=1)
            {
                $agents=$this->BaseModel->getWhereM('admin',array('flag'=>5,'agent_status'=>1));
                $companyData=$this->BaseModel->getWhereM('company',array('status'=>1));
                $data['agentsData']=$agents;
                 $data['companyData']=$companyData;
            }
        else if($flag==3 && $company!=1)
            {
                $agents=$this->BaseModel->getWhereM('admin',array('flag'=>5,'company'=>$company));
                $companyData=$this->BaseModel->getWhereM('company',array('status'=>1,'id'=>$this->session->userdata('company')));
                $data['agentsData']=$agents;
                 $data['companyData']=$companyData;
            }
            else
            {
                 $agents=$this->BaseModel->getWhereM('admin',array('flag'=>5,'id'=>$agend));
                $companyData=$this->BaseModel->getWhereM('company',array('status'=>1,'id'=>$this->session->userdata('company')));
                $data['agentsData']=$agents;
                 $data['companyData']=$companyData;
            }
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        
       
        $this->load->view('dashboard',$data);
    }
    public function grossProfit()
    {
       // $data['view']='gross_profit_view';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->generateGrosprofit($fliterArray);
       echo $viewData;
        
//        $this->load->view('dashboard',$data);
    }
    public function generateGrossProfit($param=array())
    {
        
         $this->load->view('dashboard',$data);
    }
    public function dueBalanceReport()
    {
        $data['view']='due_balabce_report_view';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $this->load->view('dashboard',$data);
    }
    public function generateGrosprofit()
    {
//        print_r($_POST);
//        $agentId=$this->input->post('agent');
//        $startDate=$this->input->post('startDate');
//        $endDate=$this->input->post('endDate');
//        $brand=$this->input->post('brand');
//        $supplier=$this->input->post('supplier');
//        $gds=$this->input->post('gds');
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
//        $agentId=$fliterArray['agent'];
//        $startDate=$fliterArray['startDate'];
//        $endDate=$fliterArray['endDate'];
//        $brand=$fliterArray['brand'];
//        $supplier=$fliterArray['supplier'];
//        $gds=$fliterArray['gds'];
        $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1'  ";
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            $condition2='';
            $brand=$this->session->userdata('company');
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
               $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
                 $condition2.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $condition2.=' 1=1';
//            echo $condition;
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,c.fullname,b.destination,b.number_Of_segment,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1' ";
        }
       $data['reportData']=$this->BaseModel->getQuery($qry);
       $data['reportDataCancelData']=$this->BaseModel->getQuery($qry2);
       $data['view']='gross_profit_view';
       $data['pageTitle']='Gross Profit Sheet';
       $data['reportCondition']=$reportCondition;
       $data['tab']='reports'; 
       $this->load->view('dashboard',$data);
    }
   
    public function generateGrosprofitSheet()
    {
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
        $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1'  ";
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            $condition2='';
            $brand=$this->session->userdata('company');
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
               $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
                 $condition2.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.number_Of_segment,b.gds,b.airline from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1' ";
        }
       $data['reportData']=$this->BaseModel->getQuery($qry);
       $data['reportDataCancelData']=$this->BaseModel->getQuery($qry2);
       
        $filename='Gross Profit Sheet '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
        $sheetTitleN='Gross Profit '.$startDate.' To '.$endDate; 
        $startda=date('d M y',strtotime($startDate));
        $endDa=date('d M y',strtotime($endDate));
        $finalTit=$startda." to ".$endDa;
        $titbook="Profit ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Gross Profit Sheet');
                $this->excel->getActiveSheet()->setCellValue('A2', 'Issued Bookings:');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('P'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A4', 'Sr.#');
                $this->excel->getActiveSheet()->setCellValue('B4', 'Issue Date');
                $this->excel->getActiveSheet()->setCellValue('C4', 'File No.');
                $this->excel->getActiveSheet()->setCellValue('D4', 'Sup.Ref#');
                $this->excel->getActiveSheet()->setCellValue('E4', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('F4', 'Pax');
                $this->excel->getActiveSheet()->setCellValue('G4', 'GDS');
                $this->excel->getActiveSheet()->setCellValue('H4', 'Airline');
                $this->excel->getActiveSheet()->setCellValue('I4', 'Dest.');
                $this->excel->getActiveSheet()->setCellValue('J4', 'Segt.');
                $this->excel->getActiveSheet()->setCellValue('K4', 'Sale Price');
                $this->excel->getActiveSheet()->setCellValue('L3', idToName('company','id',$this->session->userdata('company'),'company_name').' Own Cost');
                $this->excel->getActiveSheet()->setCellValue('L4', 'Supplier');
                $this->excel->getActiveSheet()->setCellValue('M4', 'Additional');
                $this->excel->getActiveSheet()->setCellValue('N4', 'Total');
                $this->excel->getActiveSheet()->setCellValue('O4', 'Profit');
                $this->excel->getActiveSheet()->setCellValue('P4', 'Agent');

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('O4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('P4')->getFont()->setBold(true);                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:P1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->mergeCells('A2:P2');
                $this->excel->getActiveSheet()->mergeCells('L3:N3');
                $this->excel->getActiveSheet()->mergeCells('A3:K3');
                $this->excel->getActiveSheet()->mergeCells('O3:P3');
                
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
                $this->excel->getActiveSheet()->getStyle('A2')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=5;		
                $serial=1;
                $total_segments=0;
                $customersReceives=0;
                $totalPayableSullpier=0;
                $totalAdditionalCharges=0;
                $toCost_grand=0;
                $issuedTotal=0;
                $totalPriceSale=0;
                $lastLine='';
                if(!empty($data['reportData']))
                {
                    foreach($data['reportData'] as $obj)
                    {
                        $passgerCount=0;
                        $segmentCoun=0;
                        $receiveCount=0;
                        $payableSupplier=0;
                        $additionalCharges=0;
                        $total_ticket_cost=0;
                        $salePrice=0;
                        $profit_gross=0;
                        $additionalCharges=(ticketCharges($obj->id)+ticketChargesAditional($obj->id));
                        $payableSupplier=ticketCost($obj->id);
                        //$receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj->id));
                        $receiveCount=paymentReceived($obj->id);
                        $passgerCount=countTotal('passanger_details',array('booking_id'=>$obj->id));
                        $segmentCoun=($obj->number_Of_segment*$passgerCount);
                        $total_segments=$total_segments+$segmentCoun;
                        $customersReceives=$customersReceives+$receiveCount;
                        $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
                        $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
                        $total_ticket_cost=($additionalCharges + $payableSupplier);
                        $toCost_grand=$toCost_grand+$total_ticket_cost;
                         $salePrice= salePrice($obj->id);
                        $totalPriceSale=$totalPriceSale+$salePrice;
                        $profit_gross=($salePrice-round($total_ticket_cost,2));
                        $issuedTotal=$issuedTotal+$profit_gross;
                        $passangerCount=countTotal('passanger_details',array('booking_id'=>$obj->id));
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                           $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                           $this->excel->getActiveSheet()->setCellValue('B'.$j,date('F,d,Y',  strtotime($obj->issue_date)));
                           $this->excel->getActiveSheet()->setCellValue('C'.$j,$fileNumber);
                           $this->excel->getActiveSheet()->setCellValue('D'.$j,$obj->supplier_ref);
                           $this->excel->getActiveSheet()->setCellValue('E'.$j,$obj->fullname);
                           $this->excel->getActiveSheet()->setCellValue('F'.$j,$passangerCount);
                           $this->excel->getActiveSheet()->setCellValue('G'.$j,$obj->gds);
                           $this->excel->getActiveSheet()->setCellValue('H'.$j,substr($obj->airline,0,2));
                           $this->excel->getActiveSheet()->setCellValue('I'.$j,substr($obj->destination,0,3));
                           $this->excel->getActiveSheet()->setCellValue('J'.$j,$segmentCoun);
                           $this->excel->getActiveSheet()->setCellValue('K'.$j,$salePrice);
                           $this->excel->getActiveSheet()->setCellValue('L'.$j,number_format($payableSupplier,2));
                           $this->excel->getActiveSheet()->setCellValue('M'.$j,number_format($additionalCharges,2));
                           $this->excel->getActiveSheet()->setCellValue('N'.$j,number_format($total_ticket_cost,2));
                           $this->excel->getActiveSheet()->setCellValue('O'.$j,number_format($profit_gross,2));
                           $this->excel->getActiveSheet()->setCellValue('P'.$j,idToName('admin','id',$obj->booked_agent_id,'login_name'));
                           $j++;
                           $serial++;
                    }
                    $lastLine=$j;     
                    $this->excel->getActiveSheet()->setCellValue('I'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('J'.$lastLine,$total_segments);
                    $this->excel->getActiveSheet()->setCellValue('K'.$lastLine,number_format($totalPriceSale,2));
                    $this->excel->getActiveSheet()->setCellValue('L'.$lastLine,number_format($totalPayableSullpier,2));
                    $this->excel->getActiveSheet()->setCellValue('M'.$lastLine,number_format($totalAdditionalCharges,2));
                    $this->excel->getActiveSheet()->setCellValue('N'.$lastLine,number_format($toCost_grand,2));
                    $this->excel->getActiveSheet()->setCellValue('O'.$lastLine,number_format($issuedTotal,2));                 
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('J'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('K'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('L'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('M'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('N'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('O'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine.':O'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
                $cancelLineTitle=$lastLine+1;
                $this->excel->getActiveSheet()->setCellValue('A'.$cancelLineTitle, 'Canceled Bookings:');
               
                $mergeHead=$cancelLineTitle+1;
                $cancelHead=$mergeHead+1;
                $this->excel->getActiveSheet()->getStyle('A'.$cancelLineTitle)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $this->excel->getActiveSheet()->getStyle('A'.$cancelLineTitle)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
                $this->excel->getActiveSheet()->mergeCells('A'.$cancelLineTitle.':P'.$cancelLineTitle);
                 for($col1 = ord('A'); $col1 <= ord('P'); $col1++)
                 { 
                    $this->excel->getActiveSheet()->getStyle(chr($col1))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A'.$cancelHead, 'Sr.#');
                $this->excel->getActiveSheet()->setCellValue('B'.$cancelHead, 'Cancel Date');
                $this->excel->getActiveSheet()->setCellValue('C'.$cancelHead, 'File No.');
                $this->excel->getActiveSheet()->setCellValue('D'.$cancelHead, 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('E'.$cancelHead, 'GDS');
                $this->excel->getActiveSheet()->setCellValue('F'.$cancelHead, 'Airline');
                $this->excel->getActiveSheet()->setCellValue('G'.$cancelHead, 'Supplier Name');
                $this->excel->getActiveSheet()->setCellValue('H'.$cancelHead, 'Dest.');
                $this->excel->getActiveSheet()->setCellValue('I'.$cancelHead, 'Pax');
                $this->excel->getActiveSheet()->setCellValue('J'.$cancelHead, 'Rcved. From Customer');
                $this->excel->getActiveSheet()->setCellValue('K'.$cancelHead, 'Rfd to cust.');
                $this->excel->getActiveSheet()->setCellValue('K'.$mergeHead, idToName('company','id',$this->session->userdata('company'),'company_name').' Own Cost');
                $this->excel->getActiveSheet()->setCellValue('L'.$cancelHead, 'CHBK+PK cost');
                $this->excel->getActiveSheet()->setCellValue('M'.$cancelHead, 'Additional.');
                $this->excel->getActiveSheet()->setCellValue('N'.$cancelHead, 'Total');
                $this->excel->getActiveSheet()->setCellValue('O'.$cancelHead, 'Profit');
                $this->excel->getActiveSheet()->setCellValue('P'.$cancelHead, 'Agent');

                $this->excel->getActiveSheet()->getStyle('A'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('O'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('P'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L'.$mergeHead)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->mergeCells('K'.$mergeHead.':N'.$mergeHead);
                $this->excel->getActiveSheet()->mergeCells('A'.$mergeHead.':J'.$mergeHead);
                $this->excel->getActiveSheet()->mergeCells('O'.$mergeHead.':P'.$mergeHead);
//                $canTi=$cancelHead+1;
//                $this->excel->getActiveSheet()->getStyle('A'.$canTi)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623'))));  
                $k=$cancelHead+1;
                
                $total_segments_cancel=0;
                $customersReceives_cancel=0;
                $totalPayableSullpier_cancel=0;
                $totalAdditionalCharges_cancel=0;
                $toCost_grand_cancel=0;
                $cancelTotal=0;
                $refendAmount_total=0;
                $chargeBackAndPlenty_total=0;
                if(!empty($data['reportDataCancelData']))
                {
                    $serial2=1;
                    foreach($data['reportDataCancelData'] as $obj2)
                    {
                        
                        $passgerCount_cancel=0;
                        $segmentCoun_cancel=0;
                        $receiveCount_cancel=0;
                        $payableSupplier_cancel=0;
                        $additionalCharges_cancel=0;
                        $total_ticket_cost_cancel=0;
                        $profit_gross_cancel=0;
                        $refendAmount=0;
                        $chargeBackAndPlenty=0;
                        
                         $additionalCharges_cancel=(ticketCharges($obj2->id)+ticketChargesAditional($obj2->id));
                        $payableSupplier_cancel=ticketCost($obj2->id);
                        $amountGotoCustomer=0;
                        $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$obj2->id));
                        //$receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj2->id)) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj2->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj2->id)));
                        $receiveCount_cancel=paymentReceived($obj2->id);
                        $passgerCount_cancel=countTotal('passanger_details',array('booking_id'=>$obj2->id));
                        $segmentCoun_cancel=($obj2->number_Of_segment*$passgerCount_cancel);
                        $refendAmount=(refundSum($obj2->id)+$amountGotoCustomer);
                        $chargeBackAndPlenty=chargebackPlenty($obj2->id);
                        $refendAmount_total=$refendAmount_total+$refendAmount;
                        $total_segments_cancel=$total_segments_cancel+$passgerCount_cancel;
                        $customersReceives_cancel=$customersReceives_cancel+$receiveCount_cancel;
                        $totalPayableSullpier_cancel=$totalPayableSullpier_cancel+$payableSupplier_cancel;
                        $totalAdditionalCharges_cancel=$totalAdditionalCharges_cancel+$additionalCharges_cancel;
                        $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                        $toCost_grand_cancel=$toCost_grand_cancel+$total_ticket_cost_cancel;
                        $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                        $cancelTotal=$cancelTotal+$profit_gross_cancel;
                        $chargeBackAndPlenty_total=$chargeBackAndPlenty_total+$chargeBackAndPlenty;
                        
                        $fileNumber2=idToName('company','id',$obj2->company,'company_Code')."-".$obj2->id;
                        $this->excel->getActiveSheet()->setCellValue('A'.$k, $serial2);
                        $this->excel->getActiveSheet()->setCellValue('B'.$k,date('F,d,Y',  strtotime($obj2->cancel_date)));
                        $this->excel->getActiveSheet()->setCellValue('C'.$k,$fileNumber2);
                        $this->excel->getActiveSheet()->setCellValue('D'.$k,$obj2->fullname);
                        $this->excel->getActiveSheet()->setCellValue('E'.$k,$obj2->gds);
                        $this->excel->getActiveSheet()->setCellValue('F'.$k,substr($obj2->airline,0,2));
                        $this->excel->getActiveSheet()->setCellValue('G'.$k,$obj2->supplier_name);
                        $this->excel->getActiveSheet()->setCellValue('H'.$k,substr($obj2->destination,0,3));
                        $this->excel->getActiveSheet()->setCellValue('I'.$k,$passgerCount_cancel);
                        $this->excel->getActiveSheet()->setCellValue('J'.$k,$receiveCount_cancel);
                        $this->excel->getActiveSheet()->setCellValue('K'.$k,$refendAmount);
                        $this->excel->getActiveSheet()->setCellValue('L'.$k,$chargeBackAndPlenty);
                        $this->excel->getActiveSheet()->setCellValue('M'.$k,$additionalCharges_cancel);
                        $this->excel->getActiveSheet()->setCellValue('N'.$k,$total_ticket_cost_cancel);
                        $this->excel->getActiveSheet()->setCellValue('O'.$k,$profit_gross_cancel);
                        $this->excel->getActiveSheet()->setCellValue('P'.$k,idToName('admin','id',$obj2->booked_agent_id,'login_name'));
                        $serial2++;
                        $k++;
                    }
                    $CancelLastLine=$k;     
                    $this->excel->getActiveSheet()->setCellValue('H'.$CancelLastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('I'.$CancelLastLine,$total_segments_cancel);
                    $this->excel->getActiveSheet()->setCellValue('J'.$CancelLastLine,$customersReceives_cancel);
                    $this->excel->getActiveSheet()->setCellValue('K'.$CancelLastLine,$refendAmount_total);
                    $this->excel->getActiveSheet()->setCellValue('L'.$CancelLastLine,$chargeBackAndPlenty_total);
                    $this->excel->getActiveSheet()->setCellValue('M'.$CancelLastLine,number_format($totalAdditionalCharges_cancel,2));
                    $this->excel->getActiveSheet()->setCellValue('N'.$CancelLastLine,number_format($toCost_grand_cancel,2));                 
                    $this->excel->getActiveSheet()->setCellValue('O'.$CancelLastLine,number_format($cancelTotal,2));                 
                    $this->excel->getActiveSheet()->getStyle('H'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('I'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('J'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('K'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('L'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('M'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('N'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('O'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('H'.$CancelLastLine.':O'.$CancelLastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                    
                    
                }
                $grandline=$CancelLastLine+1;
                $this->excel->getActiveSheet()->setCellValue('M'.$grandline,'Grand Total');
                $this->excel->getActiveSheet()->setCellValue('O'.$grandline,number_format(($issuedTotal+$cancelTotal),2));
                $this->excel->getActiveSheet()->getStyle('M'.$grandline.':O'.$grandline)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '008000'))));
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
               $objWriter->save('php://output'); 
    }
    public function getmarginSheet()
    {
        $issedData= unserialize(base64_decode($this->input->post('issuedData')));
        $cancelData=unserialize(base64_decode($this->input->post('cancelData')));
        $recortCondation=unserialize(base64_decode($this->input->post('reportCondation')));
        $filename='Margin Sheet '.$recortCondation['startDate'].' To '.$recortCondation['endDate'].'.xls'; //save our workbook as this file name
        $sheetTitleN='Margin Report '.$recortCondation['startDate'].' To '.$recortCondation['endDate']; 
        $startda=date('d M y',strtotime($recortCondation['startDate']));
        $endDate=date('d M y',strtotime($recortCondation['endDate']));
        $finalTit=$startda." to ".$endDate;
        $titbook="Margin ".$finalTit;
//       exit();
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Issued Bookings');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('M'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A2', 'Sr.No');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Issued Date');
                $this->excel->getActiveSheet()->setCellValue('C2', 'File No');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Destination');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Sup.Ref#');
                $this->excel->getActiveSheet()->setCellValue('G2', 'Segments');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Rec`d from cust.');
                $this->excel->getActiveSheet()->setCellValue('I2', 'Supplier');
                $this->excel->getActiveSheet()->setCellValue('J2', 'Additional');
                $this->excel->getActiveSheet()->setCellValue('K2', 'Total');
                $this->excel->getActiveSheet()->setCellValue('L2', 'Profit');
                $this->excel->getActiveSheet()->setCellValue('M2', 'Agent');
                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('M2')->getFont()->setBold(true);            
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:M1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
//                $this->excel->getActiveSheet()->getStyle(chr('A1'))->getFont()->setSize(16);
              
//                $AttendanceRecord=false;
//                if($AttendanceRecord->num_rows() >0)
                $ser=3;
                $issuedTotal=0;
                $cancelTotal=0;
                if($issedData)
                    {
                        $i=1;
                        $total_segments=0;
                        $customersReceives=0;
                        $totalPayableSullpier=0;
                        $totalAdditionalCharges=0;
                        $toCost_grand=0;
                    foreach ($issedData as $row)
                        {
                            $fileNo=idToName('company','id',$row->company,'company_Code').'-'.$row->id;
                            $segmentCoun=0;
                            $passgerCount=0;
                            $receiveCount=0;
                            $payableSupplier=0;
                            $additionalCharges=0;
                            $total_ticket_cost=0;
                            $profit_gross=0;
                            $passgerCount=countTotal('passanger_details',array('booking_id'=>$row->id));
                            $segmentCoun=($row->number_Of_segment*$passgerCount);
                           $total_segments=$total_segments+$segmentCoun;
                           $receiveCount=number_format(totalreceivedAmount($row->id),2);
                           $customersReceives=$customersReceives+$receiveCount;
                           $payableSupplier=number_format(ticketCost($row->id),2);
                           $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
                           $additionalCharges=(number_format(ticketCharges($row->id),2)+number_format(ticketChargesAditional($row->id),2));
                           $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
                           $total_ticket_cost=$additionalCharges+$payableSupplier;
                           $toCost_grand=$toCost_grand+$total_ticket_cost;
                           $profit_gross=number_format($receiveCount,2)-number_format($total_ticket_cost,2);
                           $issuedTotal=$issuedTotal+$profit_gross;
                            
                           $this->excel->getActiveSheet()->setCellValue('A'.$ser, $i);
                           $this->excel->getActiveSheet()->setCellValue('B'.$ser,date('F,d,Y',strtotime($row->issue_date)));
                           $this->excel->getActiveSheet()->setCellValue('C'.$ser,$fileNo);
                           $this->excel->getActiveSheet()->setCellValue('D'.$ser,$row->fullname);
                           $this->excel->getActiveSheet()->setCellValue('E'.$ser,$row->destination);
                           $this->excel->getActiveSheet()->setCellValue('F'.$ser,$row->supplier_ref);
                           $this->excel->getActiveSheet()->setCellValue('G'.$ser,$segmentCoun);
                           $this->excel->getActiveSheet()->setCellValue('H'.$ser,$receiveCount);
                           $this->excel->getActiveSheet()->setCellValue('I'.$ser,$payableSupplier);
                           $this->excel->getActiveSheet()->setCellValue('J'.$ser,$additionalCharges);
                           $this->excel->getActiveSheet()->setCellValue('K'.$ser,$total_ticket_cost);
                           $this->excel->getActiveSheet()->setCellValue('L'.$ser,$profit_gross);
                           $this->excel->getActiveSheet()->setCellValue('M'.$ser,idToName('admin','id',$row->booked_agent_id,'login_name'));
                            $ser++;
                            $i++;
                        }
                         $this->excel->getActiveSheet()->setCellValue('F'.$ser, 'Total');
                         $this->excel->getActiveSheet()->getStyle('F'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('G'.$ser,$total_segments); 
                         $this->excel->getActiveSheet()->getStyle('G'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('H'.$ser,$customersReceives);
                         $this->excel->getActiveSheet()->getStyle('H'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('I'.$ser,$totalPayableSullpier);
                         $this->excel->getActiveSheet()->getStyle('I'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('J'.$ser,$totalAdditionalCharges);
                         $this->excel->getActiveSheet()->getStyle('J'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('K'.$ser,$toCost_grand);
                         $this->excel->getActiveSheet()->getStyle('K'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('L'.$ser,$issuedTotal);
                         $this->excel->getActiveSheet()->getStyle('L'.$ser)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
 
                        $ser++;

                    }
                    $this->excel->getActiveSheet()->setCellValue('A'.$ser, 'Canceled Bookings');
                    $ser2=$ser+1;
   //                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                   $this->excel->getActiveSheet()->setCellValue('A'.$ser2, 'File Status');
                   $this->excel->getActiveSheet()->setCellValue('B'.$ser2, 'Cancel Date');
                   $this->excel->getActiveSheet()->setCellValue('C'.$ser2, 'File No');
                   $this->excel->getActiveSheet()->setCellValue('D'.$ser2, 'Customer Name');
                   $this->excel->getActiveSheet()->setCellValue('E'.$ser2, 'Destination');
                   $this->excel->getActiveSheet()->setCellValue('F'.$ser2, 'Pax');
                   $this->excel->getActiveSheet()->setCellValue('G'.$ser2, 'Rec`d from cust.');
                   $this->excel->getActiveSheet()->setCellValue('H'.$ser2, 'Refund to Customer');
                   $this->excel->getActiveSheet()->setCellValue('I'.$ser2, 'CHBK+PK Cost');
                   $this->excel->getActiveSheet()->setCellValue('J'.$ser2, 'Additional');
                   $this->excel->getActiveSheet()->setCellValue('K'.$ser2, 'Total');
                   $this->excel->getActiveSheet()->setCellValue('L'.$ser2, 'Profit');
                   $this->excel->getActiveSheet()->setCellValue('M'.$ser2, 'Agent');
                   $this->excel->getActiveSheet()->getStyle('A'.$ser2)->getFont()->setBold(true);
                   $this->excel->getActiveSheet()->getStyle('B'.$ser2)->getFont()->setBold(true);
                   $this->excel->getActiveSheet()->getStyle('C'.$ser2)->getFont()->setBold(true);
                   $this->excel->getActiveSheet()->getStyle('D'.$ser2)->getFont()->setBold(true);
                   $this->excel->getActiveSheet()->getStyle('E'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('F'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('G'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('H'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('I'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('J'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('K'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('L'.$ser2)->getFont()->setBold(true);            
                   $this->excel->getActiveSheet()->getStyle('M'.$ser2)->getFont()->setBold(true);
                   //merge cell A1 until C1
                    $this->excel->getActiveSheet()->mergeCells('A'.$ser.':M'.$ser.'');
                    //set aligment to center for that merged cell (A1 to C1)
                    $this->excel->getActiveSheet()->getStyle('A'.$ser)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //make the font become bold
//                    $this->excel->getActiveSheet()->getStyle('A'.$ser)->getFont()->setSize(16); 
//                    $this->excel->getActiveSheet()->getStyle('A'.$ser)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A'.$ser)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                    if(!empty($cancelData))
                    {
                        $j=1;
                       $total_segments_cancel=0;
                        $customersReceives_cancel=0;
                        $totalPayableSullpier_cancel=0;
                        $totalAdditionalCharges_cancel=0;
                        $toCost_grand_cancel=0;
                        $refendAmount_total=0;
                        $chargeBackAndPlenty_total=0;
                        foreach($cancelData as $canalObj)
                        {
                           $ser2++; 
                           $passgerCount_cancel=0;
                           $segmentCoun_cancel=0;
                           $receiveCount_cancel=0;
                           $payableSupplier_cancel=0;
                           $additionalCharges_cancel=0;
                           $total_ticket_cost_cancel=0;
                           $profit_gross_cancel=0;
                           $refendAmount=0;
                           $chargeBackAndPlenty=0;
                           
                           if($cancleObj->file_status==6)
                           {
                              $additionalCharges_cancel=ticketChargesAditionalChargeBackOnly($canalObj->id)+ticketCharges($canalObj->id); 
                           }
                           else
                           {
                               $additionalCharges_cancel=ticketChargesAditionalChargeBack($canalObj->id)+ticketCharges($canalObj->id);
                           }
                           $payableSupplier_cancel=ticketCost($canalObj->id);
                           $receiveCount_cancel=totalreceivedAmount($canalObj->id);
                           $passgerCount_cancel=countTotal('passanger_details',array('booking_id'=>$canalObj->id));
                           $segmentCoun_cancel=($canalObj->number_Of_segment*$passgerCount_cancel);
                           $refendAmount=refundSum($canalObj->id);
                           $chargeBackAndPlenty=chargebackPlenty($canalObj->id);
                           $refendAmount_total=$refendAmount_total+$refendAmount;
                           $total_segments_cancel=$total_segments_cancel+$passgerCount_cancel;
                           $customersReceives_cancel=$customersReceives_cancel+$receiveCount_cancel;
                           $totalPayableSullpier_cancel=$totalPayableSullpier_cancel+$payableSupplier_cancel;
                           $totalAdditionalCharges_cancel=$totalAdditionalCharges_cancel+$additionalCharges_cancel;
                           $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                           $toCost_grand_cancel=$toCost_grand_cancel+$total_ticket_cost_cancel;
                           $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                           $cancelTotal=$cancelTotal+$profit_gross_cancel;
                           $chargeBackAndPlenty_total=$chargeBackAndPlenty_total+$chargeBackAndPlenty;
                           $fileCanceled=idToName('company','id',$canalObj->company,'company_Code').'-'.$canalObj->id;
                            $fileStatus=fileStatus($canalObj->file_status);
                           $this->excel->getActiveSheet()->setCellValue('A'.$ser2, $fileStatus);
                           $this->excel->getActiveSheet()->setCellValue('B'.$ser2,$canalObj->cancel_date);
                           $this->excel->getActiveSheet()->setCellValue('C'.$ser2,$fileCanceled);
                           $this->excel->getActiveSheet()->setCellValue('D'.$ser2,$canalObj->fullname);
                           $this->excel->getActiveSheet()->setCellValue('E'.$ser2,$canalObj->destination);
                           $this->excel->getActiveSheet()->setCellValue('F'.$ser2,$passgerCount_cancel);
                           $this->excel->getActiveSheet()->setCellValue('G'.$ser2,$receiveCount_cancel);
                           $this->excel->getActiveSheet()->setCellValue('H'.$ser2,$refendAmount);
                           $this->excel->getActiveSheet()->setCellValue('I'.$ser2,$chargeBackAndPlenty);
                           $this->excel->getActiveSheet()->setCellValue('J'.$ser2,$additionalCharges_cancel);
                           $this->excel->getActiveSheet()->setCellValue('K'.$ser2,$total_ticket_cost_cancel);
                           $this->excel->getActiveSheet()->setCellValue('L'.$ser2,$profit_gross_cancel);
                           $this->excel->getActiveSheet()->setCellValue('M'.$ser2,idToName('admin','id',$canalObj->booked_agent_id,'login_name'));  
                           $j++;
                        }
                        $ser2++;
                         $this->excel->getActiveSheet()->setCellValue('E'.$ser2, 'Total');
                         $this->excel->getActiveSheet()->getStyle('E'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('F'.$ser2,$total_segments_cancel); 
                         $this->excel->getActiveSheet()->getStyle('F'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('G'.$ser2,$customersReceives_cancel);
                         $this->excel->getActiveSheet()->getStyle('G'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('H'.$ser2,$refendAmount_total);
                         $this->excel->getActiveSheet()->getStyle('H'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('I'.$ser2,$chargeBackAndPlenty_total);
                         $this->excel->getActiveSheet()->getStyle('I'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000'))));  
                         $this->excel->getActiveSheet()->setCellValue('J'.$ser2,$totalAdditionalCharges_cancel);
                         $this->excel->getActiveSheet()->getStyle('J'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('K'.$ser2,$toCost_grand_cancel);
                         $this->excel->getActiveSheet()->getStyle('K'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $this->excel->getActiveSheet()->setCellValue('L'.$ser2,$cancelTotal);
                         $this->excel->getActiveSheet()->getStyle('L'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ff0000')))); 
                         $ser2++;
                         $this->excel->getActiveSheet()->setCellValue('J'.$ser2, 'Grand Total');
                         $this->excel->getActiveSheet()->getStyle('J'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => '0b6623'))));
                         
                         $grandTotalFinal=$issuedTotal+$cancelTotal;
                         $this->excel->getActiveSheet()->setCellValue('L'.$ser2,$grandTotalFinal);
                         $this->excel->getActiveSheet()->getStyle('L'.$ser2)->applyFromArray(array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => '0b6623'))));  
                         
                    }
//                else
//                {
//                $this->excel->getActiveSheet()->mergeCells('A3:D3');
//                 $this->excel->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $exceldata[]='There is No Data';
//                $this->excel->getActiveSheet()->setCellValue('A3',$exceldata);
//           }
//                    $recortCondation
//                $filename='Sheet.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
               $objWriter->save('php://output'); 
//                return true;
    }
    public function grosProfitEarned()
    {
        $data['view']='report_gross_profit_earned_view';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $this->load->view('dashboard',$data);
    }
    public function netProfitEarned()
    {
//        $data['view']='report_net_profit_earned';
//        $data['pageTitle']='Reports';
//        $data['tab']='reports'; 
         $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->getNetProfitReport($fliterArray);
       echo $viewData;
//        $this->load->view('dashboard',$data);
    }
    public function getNetProfitReport()
    {
        $data['tab']='reports';
        $data['view']='report_net_profit_earned';
        $data['pageTitle']='Net Profit Reports';
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
//        $agentId=$param['agent'];
//        $startDate=$param['startDate'];
//        $endDate=$param['endDate'];
//        $brand=$param['brand'];
//        $supplier=$param['supplier'];
//        $gds=$param['gds'];
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition3.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'   " ;
              
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1'  ";
           // $qry3=" select * from payment where  ".$condition3." AND payment_nature='expense' AND pay_type='Dr' AND pay_to in('$ukExp') ";
            $qry3=" select p.* from payment as p JOIN expense_head as exp On p.pay_to=exp.expense_name   where ".$condition3." AND  exp.expense_type='uk' ";
//            $qry3=" select * from payment where  ".$condition3." AND payment_nature='expense' AND pay_type='Dr' ";
        }
        else if($loginFlag==3)
        {
            $company=$this->session->userdata('company');
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            $brand=$this->session->userdata('company');
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition3.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'   " ;
              
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' And a.company='$company'  ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1' And a.company='$company' ";
            //$qry3=" select * from payment where  ".$condition3." AND payment_nature='expense' AND pay_type='Dr' AND pay_to in('$ukExp') ";
            $qry3=" select p.* from payment as p JOIN expense_head as exp On p.pay_to=exp.expense_name   where ".$condition3." AND  exp.expense_type='uk' AND exp.brand='$brand' ";
            
        }
            $data['reportData']=$this->BaseModel->getQuery($qry);
            $data['reportDataCancelData']=$this->BaseModel->getQuery($qry2);
            $data['monthlyExpenses']=$this->BaseModel->getQuery($qry3);
	    $data['reportCondition']=$reportCondition;
        $this->load->view('dashboard',$data);
    }
    public function getNetProfitReportGetSheet()
    {
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1   || $loginFlag==2)
        {
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition3.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'   " ;
              
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1'  ";
//            $qry3=" select * from payment where  ".$condition3." AND payment_nature='expense' AND pay_type='Dr' ";
            $qry3=" select p.* from payment as p JOIN expense_head as exp On p.pay_to=exp.expense_name   where ".$condition3." AND  exp.expense_type='uk' ";
        }
         else if($loginFlag==3)
        {
            $company=$this->session->userdata('company');
            $condition='';
            $condition2='';
            $qry='';
            $qry2='';
            $brand=$this->session->userdata('company');
            if($agentId >0)
            {
                $condition.="  a.booked_agent_id='$agentId' AND  ";
                $condition2.="  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition2.="  a.cancel_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
              $condition3.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'   " ;
              
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
                 $condition2.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
                $condition2.=" a.company='$brand' AND ";
            }
            if(!empty($gds))
            {
                $condition.=" b.gds='$brand' AND ";
                $condition2.=" b.gds='$brand' AND ";
            }
             $condition.=' 1=1';
             $condition2.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.issue_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.airline,b.number_Of_segment,b.gds from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' And a.company='$company'  ";
            $qry2="select a.id,a.supplier_ref,a.flag,a.booking_date,a.cancel_date,a.booked_agent_id,a.supplier_name,a.company,a.booked_agent_id,a.booked_agent_id,a.canceled_stat,c.fullname,b.destination,b.number_Of_segment,b.gds,d.file_status from booking_details as a,flight_details as b,customer_contacts as c,ticket_cost as d   where a.id=c.booking_id AND a.id=b.booking_id  AND a.id=d.booking_id AND ".$condition2." AND a.canceled_stat='1' And a.company='$company' ";
           $qry3=" select p.* from payment as p JOIN expense_head as exp On p.pay_to=exp.expense_name   where ".$condition3." AND  exp.expense_type='uk' AND exp.brand='$brand' ";
        }
            $data['reportData']=$this->BaseModel->getQuery($qry);
            $data['reportDataCancelData']=$this->BaseModel->getQuery($qry2);
            $data['monthlyExpenses']=$this->BaseModel->getQuery($qry3);
            
            $filename='Net Profit Sheet '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
            $sheetTitleN='Gross Profit '.$startDate.' To '.$endDate; 
            $startda=date('d M y',strtotime($startDate));
            $endDa=date('d M y',strtotime($endDate));
            $finalTit=$startda." to ".$endDa;
            $titbook="Profit ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Net Profit Sheet');
                $this->excel->getActiveSheet()->setCellValue('A2', 'Issued Bookings:');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('P'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A4', 'Sr.#');
                $this->excel->getActiveSheet()->setCellValue('B4', 'Issue Date');
                $this->excel->getActiveSheet()->setCellValue('C4', 'File No.');
                $this->excel->getActiveSheet()->setCellValue('D4', 'Sup.Ref#');
                $this->excel->getActiveSheet()->setCellValue('E4', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('F4', 'Pax');
                $this->excel->getActiveSheet()->setCellValue('G4', 'GDS');
                $this->excel->getActiveSheet()->setCellValue('H4', 'Airline');
                $this->excel->getActiveSheet()->setCellValue('I4', 'Dest.');
                $this->excel->getActiveSheet()->setCellValue('J4', 'Segt.');
                $this->excel->getActiveSheet()->setCellValue('K4', 'Sale Price');
                $this->excel->getActiveSheet()->setCellValue('L3', idToName('company','id',$this->session->userdata('company'),'company_name').' Own Cost');
                $this->excel->getActiveSheet()->setCellValue('L4', 'Supplier');
                $this->excel->getActiveSheet()->setCellValue('M4', 'Additional');
                $this->excel->getActiveSheet()->setCellValue('N4', 'Total');
                $this->excel->getActiveSheet()->setCellValue('O4', 'Profit');
                $this->excel->getActiveSheet()->setCellValue('P4', 'Agent');

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H4')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N3')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('O4')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('P4')->getFont()->setBold(true);                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:P1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->mergeCells('A2:P2');
                $this->excel->getActiveSheet()->mergeCells('L3:N3');
                $this->excel->getActiveSheet()->mergeCells('A3:K3');
                $this->excel->getActiveSheet()->mergeCells('O3:P3');
                
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
                $this->excel->getActiveSheet()->getStyle('A2')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=5;		
                $serial=1;
                $total_segments=0;
                $customersReceives=0;
                $totalPayableSullpier=0;
                $totalAdditionalCharges=0;
                $toCost_grand=0;
                $issuedTotal=0;
                $totalPriceSale=0;
                $lastLine='';
                if(!empty($data['reportData']))
                {
                    foreach($data['reportData'] as $obj)
                    {
                        $passgerCount=0;
                        $segmentCoun=0;
                        $receiveCount=0;
                        $payableSupplier=0;
                        $additionalCharges=0;
                        $total_ticket_cost=0;
                        $salePrice=0;
                        $profit_gross=0;
                        $additionalCharges=(ticketCharges($obj->id)+ticketChargesAditional($obj->id));
                        $payableSupplier=ticketCost($obj->id);
                        //$receiveCount=sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj->id));
                        $receiveCount=paymentReceived($obj->id);
                        $passgerCount=countTotal('passanger_details',array('booking_id'=>$obj->id));
                        $segmentCoun=($obj->number_Of_segment*$passgerCount);
                        $total_segments=$total_segments+$segmentCoun;
                        $customersReceives=$customersReceives+$receiveCount;
                        $totalPayableSullpier=$totalPayableSullpier+$payableSupplier;
                        $totalAdditionalCharges=$totalAdditionalCharges+$additionalCharges;
                        $total_ticket_cost=($additionalCharges + $payableSupplier);
                        $toCost_grand=$toCost_grand+$total_ticket_cost;
                         $salePrice= salePrice($obj->id);
                        $totalPriceSale=$totalPriceSale+$salePrice;
                        $profit_gross=($salePrice-round($total_ticket_cost,2));
                        $issuedTotal=$issuedTotal+$profit_gross;
                        $passangerCount=countTotal('passanger_details',array('booking_id'=>$obj->id));
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                           $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                           $this->excel->getActiveSheet()->setCellValue('B'.$j,date('F,d,Y',  strtotime($obj->issue_date)));
                           $this->excel->getActiveSheet()->setCellValue('C'.$j,$fileNumber);
                           $this->excel->getActiveSheet()->setCellValue('D'.$j,$obj->supplier_ref);
                           $this->excel->getActiveSheet()->setCellValue('E'.$j,$obj->fullname);
                           $this->excel->getActiveSheet()->setCellValue('F'.$j,$passangerCount);
                           $this->excel->getActiveSheet()->setCellValue('G'.$j,$obj->gds);
                           $this->excel->getActiveSheet()->setCellValue('H'.$j,substr($obj->airline,0,2));
                           $this->excel->getActiveSheet()->setCellValue('I'.$j,substr($obj->destination,0,3));
                           $this->excel->getActiveSheet()->setCellValue('J'.$j,$segmentCoun);
                           $this->excel->getActiveSheet()->setCellValue('K'.$j,$salePrice);
                           $this->excel->getActiveSheet()->setCellValue('L'.$j,number_format($payableSupplier,2));
                           $this->excel->getActiveSheet()->setCellValue('M'.$j,number_format($additionalCharges,2));
                           $this->excel->getActiveSheet()->setCellValue('N'.$j,number_format($total_ticket_cost,2));
                           $this->excel->getActiveSheet()->setCellValue('O'.$j,number_format($profit_gross,2));
                           $this->excel->getActiveSheet()->setCellValue('P'.$j,idToName('admin','id',$obj->booked_agent_id,'login_name'));
                           $j++;
                           $serial++;
                    }
                    $lastLine=$j;     
                    $this->excel->getActiveSheet()->setCellValue('I'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('J'.$lastLine,$total_segments);
                    $this->excel->getActiveSheet()->setCellValue('K'.$lastLine,number_format($totalPriceSale,2));
                    $this->excel->getActiveSheet()->setCellValue('L'.$lastLine,number_format($totalPayableSullpier,2));
                    $this->excel->getActiveSheet()->setCellValue('M'.$lastLine,number_format($totalAdditionalCharges,2));
                    $this->excel->getActiveSheet()->setCellValue('N'.$lastLine,number_format($toCost_grand,2));
                    $this->excel->getActiveSheet()->setCellValue('O'.$lastLine,number_format($issuedTotal,2));                 
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('J'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('K'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('L'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('M'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('N'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('O'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine.':O'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
                $cancelLineTitle=$lastLine+1;
                $this->excel->getActiveSheet()->setCellValue('A'.$cancelLineTitle, 'Canceled Bookings:');
               
                $mergeHead=$cancelLineTitle+1;
                $cancelHead=$mergeHead+1;
                $this->excel->getActiveSheet()->getStyle('A'.$cancelLineTitle)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $this->excel->getActiveSheet()->getStyle('A'.$cancelLineTitle)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
                $this->excel->getActiveSheet()->mergeCells('A'.$cancelLineTitle.':P'.$cancelLineTitle);
                 for($col1 = ord('A'); $col1 <= ord('P'); $col1++)
                 { 
                    $this->excel->getActiveSheet()->getStyle(chr($col1))->getFont()->setSize(12);

                    $this->excel->getActiveSheet()->getStyle(chr($col1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A'.$cancelHead, 'Sr.#');
                $this->excel->getActiveSheet()->setCellValue('B'.$cancelHead, 'Cancel Date');
                $this->excel->getActiveSheet()->setCellValue('C'.$cancelHead, 'File No.');
                $this->excel->getActiveSheet()->setCellValue('D'.$cancelHead, 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('E'.$cancelHead, 'GDS');
                $this->excel->getActiveSheet()->setCellValue('F'.$cancelHead, 'Airline');
                $this->excel->getActiveSheet()->setCellValue('G'.$cancelHead, 'Supplier Name');
                $this->excel->getActiveSheet()->setCellValue('H'.$cancelHead, 'Dest.');
                $this->excel->getActiveSheet()->setCellValue('I'.$cancelHead, 'Pax');
                $this->excel->getActiveSheet()->setCellValue('J'.$cancelHead, 'Rcved. From Customer');
                $this->excel->getActiveSheet()->setCellValue('K'.$cancelHead, 'Rfd to cust.');
                $this->excel->getActiveSheet()->setCellValue('K'.$mergeHead, idToName('company','id',$this->session->userdata('company'),'company_name').' Own Cost');
                $this->excel->getActiveSheet()->setCellValue('L'.$cancelHead, 'CHBK+PK cost');
                $this->excel->getActiveSheet()->setCellValue('M'.$cancelHead, 'Additional.');
                $this->excel->getActiveSheet()->setCellValue('N'.$cancelHead, 'Total');
                $this->excel->getActiveSheet()->setCellValue('O'.$cancelHead, 'Profit');
                $this->excel->getActiveSheet()->setCellValue('P'.$cancelHead, 'Agent');

                $this->excel->getActiveSheet()->getStyle('A'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H'.$cancelHead)->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N'.$mergeHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('O'.$cancelHead)->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('P'.$cancelHead)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L'.$mergeHead)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->mergeCells('K'.$mergeHead.':N'.$mergeHead);
                $this->excel->getActiveSheet()->mergeCells('A'.$mergeHead.':J'.$mergeHead);
                $this->excel->getActiveSheet()->mergeCells('O'.$mergeHead.':P'.$mergeHead);
//                $canTi=$cancelHead+1;
//                $this->excel->getActiveSheet()->getStyle('A'.$canTi)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623'))));  
                $k=$cancelHead+1;
                
                $total_segments_cancel=0;
                $customersReceives_cancel=0;
                $totalPayableSullpier_cancel=0;
                $totalAdditionalCharges_cancel=0;
                $toCost_grand_cancel=0;
                $cancelTotal=0;
                $refendAmount_total=0;
                $chargeBackAndPlenty_total=0;
                if(!empty($data['reportDataCancelData']))
                {
                    $serial2=1;
                    foreach($data['reportDataCancelData'] as $obj2)
                    {
                        
                        $passgerCount_cancel=0;
                        $segmentCoun_cancel=0;
                        $receiveCount_cancel=0;
                        $payableSupplier_cancel=0;
                        $additionalCharges_cancel=0;
                        $total_ticket_cost_cancel=0;
                        $profit_gross_cancel=0;
                        $refendAmount=0;
                        $chargeBackAndPlenty=0;
                        
                         $additionalCharges_cancel=(ticketCharges($obj2->id)+ticketChargesAditional($obj2->id));
                        $payableSupplier_cancel=ticketCost($obj2->id);
                        $amountGotoCustomer=0;
//                        $amountGotoCustomer=sumOfAmount('payment','amount',array('pay_to'=>'Customer','pay_type'=>'Dr','booking_ref'=>$obj2->id));
                        $amountGotoCustomer=getQueryRes('select  sum(amount) as total  from payment  where booking_ref='.$obj2->id.' AND pay_type="Dr" AND pay_to="Customer" AND payment_nature!="expense" AND pay_by!="Profit & Loss on Cancellations-UK" ');
                        //$receiveCount_cancel=(sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi HSBC','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Bank Sufi Arro Money','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Ali Personal Barclays','pay_type'=>'Dr','booking_ref'=>$obj2->id)) +sumOfAmount('payment','amount',array('pay_to'=>'SUFI REVOLT','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Credit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj2->id))+ sumOfAmount('payment','amount',array('pay_to'=>'Debit Card Charge Global Travel','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'SUFI TRANSFERWISE','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Square Up card terminal SUFITRAVELS','pay_type'=>'Dr','booking_ref'=>$obj2->id)) +sumOfAmount('payment','amount',array('pay_to'=>'Card Charges Square Up card terminal','pay_type'=>'Dr','booking_ref'=>$obj2->id)) + sumOfAmount('payment','amount',array('pay_to'=>'Card Charge Bright Holiday','pay_type'=>'Dr','booking_ref'=>$obj2->id)));
                        $receiveCount_cancel=paymentReceived($obj2->id)+cardPaymentSum($obj2->id);
                        $passgerCount_cancel=countTotal('passanger_details',array('booking_id'=>$obj2->id));
                        $segmentCoun_cancel=($obj2->number_Of_segment*$passgerCount_cancel);
                        $refendAmount=(refundSum($obj2->id)+$amountGotoCustomer);
                        $chargeBackAndPlenty=chargebackPlenty($obj2->id);
                        $refendAmount_total=$refendAmount_total+$refendAmount;
                        $total_segments_cancel=$total_segments_cancel+$passgerCount_cancel;
                        $customersReceives_cancel=$customersReceives_cancel+$receiveCount_cancel;
                        $totalPayableSullpier_cancel=$totalPayableSullpier_cancel+$payableSupplier_cancel;
                        $totalAdditionalCharges_cancel=$totalAdditionalCharges_cancel+$additionalCharges_cancel;
                        $total_ticket_cost_cancel=($additionalCharges_cancel+$chargeBackAndPlenty+$refendAmount);
                        $toCost_grand_cancel=$toCost_grand_cancel+$total_ticket_cost_cancel;
                        $profit_gross_cancel=($receiveCount_cancel-$total_ticket_cost_cancel);
                        $cancelTotal=$cancelTotal+$profit_gross_cancel;
                        $chargeBackAndPlenty_total=$chargeBackAndPlenty_total+$chargeBackAndPlenty;
                        
                        $fileNumber2=idToName('company','id',$obj2->company,'company_Code')."-".$obj2->id;
                        $this->excel->getActiveSheet()->setCellValue('A'.$k, $serial2);
                        $this->excel->getActiveSheet()->setCellValue('B'.$k,date('F,d,Y',  strtotime($obj2->cancel_date)));
                        $this->excel->getActiveSheet()->setCellValue('C'.$k,$fileNumber2);
                        $this->excel->getActiveSheet()->setCellValue('D'.$k,$obj2->fullname);
                        $this->excel->getActiveSheet()->setCellValue('E'.$k,$obj2->gds);
                        $this->excel->getActiveSheet()->setCellValue('F'.$k,substr($obj2->airline,0,2));
                        $this->excel->getActiveSheet()->setCellValue('G'.$k,$obj2->supplier_name);
                        $this->excel->getActiveSheet()->setCellValue('H'.$k,substr($obj2->destination,0,3));
                        $this->excel->getActiveSheet()->setCellValue('I'.$k,$passgerCount_cancel);
                        $this->excel->getActiveSheet()->setCellValue('J'.$k,$receiveCount_cancel);
                        $this->excel->getActiveSheet()->setCellValue('K'.$k,$refendAmount);
                        $this->excel->getActiveSheet()->setCellValue('L'.$k,$chargeBackAndPlenty);
                        $this->excel->getActiveSheet()->setCellValue('M'.$k,$additionalCharges_cancel);
                        $this->excel->getActiveSheet()->setCellValue('N'.$k,$total_ticket_cost_cancel);
                        $this->excel->getActiveSheet()->setCellValue('O'.$k,$profit_gross_cancel);
                        $this->excel->getActiveSheet()->setCellValue('P'.$k,idToName('admin','id',$obj2->booked_agent_id,'login_name'));
                        $serial2++;
                        $k++;
                    }
                    $CancelLastLine=$k;     
                    $this->excel->getActiveSheet()->setCellValue('H'.$CancelLastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('I'.$CancelLastLine,$total_segments_cancel);
                    $this->excel->getActiveSheet()->setCellValue('J'.$CancelLastLine,$customersReceives_cancel);
                    $this->excel->getActiveSheet()->setCellValue('K'.$CancelLastLine,$refendAmount_total);
                    $this->excel->getActiveSheet()->setCellValue('L'.$CancelLastLine,$chargeBackAndPlenty_total);
                    $this->excel->getActiveSheet()->setCellValue('M'.$CancelLastLine,number_format($totalAdditionalCharges_cancel,2));
                    $this->excel->getActiveSheet()->setCellValue('N'.$CancelLastLine,number_format($toCost_grand_cancel,2));                 
                    $this->excel->getActiveSheet()->setCellValue('O'.$CancelLastLine,number_format($cancelTotal,2));                 
                    $this->excel->getActiveSheet()->getStyle('H'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('I'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('J'.$CancelLastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('K'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('L'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('M'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('N'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('O'.$CancelLastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('H'.$CancelLastLine.':O'.$CancelLastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                    
                    
                }
                else
                {
                    $CancelLastLine=$k;
                }
                $grandline=$CancelLastLine+1;
                $grossProfitShow=$issuedTotal+$cancelTotal;
                $this->excel->getActiveSheet()->setCellValue('M'.$grandline,'Gross Profit:');
                $this->excel->getActiveSheet()->setCellValue('O'.$grandline,number_format(($issuedTotal+$cancelTotal),2));
                $this->excel->getActiveSheet()->getStyle('M'.$grandline.':O'.$grandline)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '008000'))));
                $expeneLine=$grandline+1;
                $this->excel->getActiveSheet()->setCellValue('M'.$expeneLine,'	Less Expenditures:');
                $this->excel->getActiveSheet()->getStyle('M'.$expeneLine)->getFont()->setBold(true);
                $expenseTotal=0;
                if(!empty($data['monthlyExpenses']))
                {
                     
                     $expeneLineWrite=$expeneLine+2;
                    foreach($data['monthlyExpenses'] as $expense)
                    {
                      $expenseTotal=$expenseTotal+$expense->amount;  
                      $this->excel->getActiveSheet()->setCellValue('M'.$expeneLineWrite,$expense->pay_to);
                      $this->excel->getActiveSheet()->setCellValue('O'.$expeneLineWrite,'('.$expense->amount.')');
                      $expeneLineWrite++;
                    }
                }
                $styleArray = array(
            'borders' => array(
             'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THICK,
            'color' => array('argb' => 'FFFF0000'),
                  ),
                     ),
            );
                $expeneTotalLine=$expeneLineWrite+1;
                $this->excel->getActiveSheet()->setCellValue('M'.$expeneLineWrite,'Total');
                $this->excel->getActiveSheet()->getStyle('M'.$expeneLineWrite)->getFont()->setBold(true);
                //$this->excel->getActiveSheet()->getStyle('M'.$expeneTotalLine.':O'.$expeneTotalLine)->applyFromArray($styleArray);
               // $this->excel->getActiveSheet()->mergeCells('M'.$expeneLineWrite.':O'.$expeneLineWrite);
                $this->excel->getActiveSheet()->setCellValue('O'.$expeneLineWrite,'-'.number_format($expenseTotal,2));
                $this->excel->getActiveSheet()->getStyle('O'.$expeneLineWrite)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->setCellValue('M'.$expeneTotalLine,'Net Profit:');
                $netProfitShow=$grossProfitShow-$expenseTotal;
                $this->excel->getActiveSheet()->setCellValue('O'.$expeneTotalLine,number_format($netProfitShow,2));
                $this->excel->getActiveSheet()->getStyle('M'.$expeneTotalLine.':O'.$expeneTotalLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '008000'))));
                $payAbleDirectorLine=$expeneTotalLine+1;
                $driectorAmount=(($netProfitShow*10)/100);
                $payableToCallCenter=$netProfitShow-$driectorAmount;
                 $this->excel->getActiveSheet()->setCellValue('M'.$payAbleDirectorLine,'Payable to Director');
                 $this->excel->getActiveSheet()->setCellValue('O'.$payAbleDirectorLine,number_format($driectorAmount,2));
                 $this->excel->getActiveSheet()->getStyle('M'.$payAbleDirectorLine.':O'.$payAbleDirectorLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '008000'))));
                 $callCenterLine=$payAbleDirectorLine+1;
                 $this->excel->getActiveSheet()->setCellValue('M'.$callCenterLine,'Payable to Call Center');
                 $this->excel->getActiveSheet()->setCellValue('O'.$callCenterLine,number_format($payableToCallCenter,2));
                 $this->excel->getActiveSheet()->getStyle('M'.$callCenterLine.':O'.$callCenterLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '008000'))));
                 
                 
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
               $objWriter->save('php://output'); 
            
    }
    public function supplierDueBalance()
    {
        $data['view']='report_supplier_due_balance';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
       // $this->load->view('dashboard',$data);
         $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->getSupplierLeftBalance($fliterArray);
       echo $viewData;
    }
    public function getSupplierLeftBalance()
    {
        $data['view']='report_supplier_due_balance';
        $data['pageTitle']='Supplier Left Balance Reports';
        $data['tab']='reports'; 
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
//        $agentId=$param['agent'];
//        $startDate=$param['startDate'];
//        $endDate=$param['endDate'];
//        $brand=$param['brand'];
//        $supplier=$param['supplier'];
//        $gds=$param['gds'];
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        $data['supplierRemaingBalance']=$this->BaseModel->getQuery($qry);    
        $data['reportCondition']=$reportCondition;
        $this->load->view('dashboard',$data);
        
    }
    public function getSupplierLeftBalanceSheet()
    {
       
        $data['tab']='reports'; 
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        $data['supplierRemaingBalance']=$this->BaseModel->getQuery($qry);    
       
        $filename='Supplier Due Balance '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
        $sheetTitleN='Supplier Due Balance '.$startDate.' To '.$endDate; 
        $startda=date('d M y',strtotime($startDate));
        $endDa=date('d M y',strtotime($endDate));
        $finalTit=$startda." to ".$endDa;
        $titbook="Supplier ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Supplier Due Balance Sheet');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('H'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A2', 'Sr#');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Date');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Brand');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Booking Status');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Booking Ref No.');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Supplier');
                $this->excel->getActiveSheet()->setCellValue('G2', 'Supplier Name');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Balance Due');
                

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);            
                                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:H1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=3;		
                $serial=1;
                if(!empty($data['supplierRemaingBalance']))
                {
                    $totalLeftBalance=0.0;
                    foreach($data['supplierRemaingBalance'] as $obj)
                    {
                    $supplierReceived=0;
                    $encodeData=idencode($obj->id);
                    $ticketCost=0;
                    $additionalCharges=0;
                    $leftBalce=0;
                    $additionalCharges=(round(ticketCharges($obj->id),2)+round(ticketChargesAditional($obj->id),2));
                    $payableSupplier=round(ticketCost($obj->id),2);
                    $ticketCost=$payableSupplier;
                    $supplierReceived=round(supplierPayAmount($obj->id),2);
                    $leftBalce=round(($ticketCost-$supplierReceived),2);
                    $totalLeftBalance=($totalLeftBalance+$leftBalce);
                    if($leftBalce!=0)
                    {
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                        $url=base_url("BookingDetailBox/".$encodeData."/".idencode($obj->flag));
                        $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                        $this->excel->getActiveSheet()->setCellValue('B'.$j,date('F,d,Y', strtotime($obj->issue_date)));
                        $this->excel->getActiveSheet()->setCellValue('C'.$j,idToName('company','id',$obj->company,'company_name'));
                        $this->excel->getActiveSheet()->setCellValue('D'.$j,'Issued');
                        $this->excel->getActiveSheet()->setCellValue('E'.$j,$fileNumber);
                        $this->excel->getActiveSheet()->setCellValue('F'.$j,$obj->supplier_ref);
                        $this->excel->getActiveSheet()->setCellValue('G'.$j,$obj->supplier_name);
                        $this->excel->getActiveSheet()->setCellValue('H'.$j,$leftBalce);
                        $j++;
                        $serial++;
                    }
                  }
                    $lastLine=$j;
                    $showTotalChedAmont=$totalAmount;
                    $totalProde=$totalAmount-$refundedAmount;
                    
                    $this->excel->getActiveSheet()->setCellValue('G'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('H'.$lastLine, number_format($totalLeftBalance,2));
                    
                    
                    $this->excel->getActiveSheet()->getStyle('G'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('G'.$lastLine.':H'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
                
                
		header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
               $objWriter->save('php://output'); 
        
    }
    public function customerDueBalanceReport()
    {
        $data['view']='report_customer_due_balance';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
//        $this->load->view('dashboard',$data);
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->leftBalanceReport($fliterArray);
       echo $viewData;
    }
   public function leftBalanceReport($param=array())
    {
       $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            $brand=$this->session->userdata('company');
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' order by a.id asc ";
            
        }
        $data['customerRemaingBalance']=$this->BaseModel->getQuery($qry);
//        $data['view']='due_balabce_report_view';
        $data['view']='report_customer_due_balance';
        $data['reportCondition']=$reportCondition;
        $data['pageTitle']='Customer Due Balance';
        $data['tab']='reports'; 
        $this->load->view('dashboard',$data);
    }
   public function leftBalanceReportSheet()
    {
       $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            $brand=$this->session->userdata('company');
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' order by a.id asc ";
            
        }
        $data['customerRemaingBalance']=$this->BaseModel->getQuery($qry);
        $data['reportCondition']=$reportCondition;
        
        $filename='Customer Due Balance '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
        $sheetTitleN='Customer Due Balance '.$startDate.' To '.$endDate; 
        $startda=date('d M y',strtotime($startDate));
        $endDa=date('d M y',strtotime($endDate));
        $finalTit=$startda." to ".$endDa;
        $titbook="Global ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Customer Due Balance Sheet');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('J'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A2', 'Sr#');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Issue Date');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Agent Name');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Brand');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Booking Ref No.');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Supplier Ref.');
                $this->excel->getActiveSheet()->setCellValue('G2', 'PNR');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('I2', 'Balance Due');
                $this->excel->getActiveSheet()->setCellValue('J2', 'Profit');

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:J1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=3;		
                $serial=1;
                if(!empty($data['customerRemaingBalance']))
                {
                    foreach($data['customerRemaingBalance'] as $obj)
                    {
                    
                    $saleprice=0;
                    $amountRece=0;
                    $ticketCost=0;
                    $additionalCharges=0;
                    $leftBalce=0;
                    $additionalCharges=(round(ticketCharges($obj->id),2)+round(ticketChargesAditional($obj->id),2));
                    $payableSupplier=round(ticketCost($obj->id),2);
                    $ticketCost=($additionalCharges+$payableSupplier);
                    $saleprice=salePrice($obj->id);
                    $amountRece=customerPayAmount($obj->id);         
                    $encodeData=idencode($obj->id);
                    $leftBalce=($saleprice-$amountRece);
                        if($leftBalce >0)
                        {
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                        $url=base_url("BookingDetailBox/".$encodeData."/".idencode($obj->flag));
                        $totalLeftBalance=$totalLeftBalance+$leftBalce;
                           $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                           $this->excel->getActiveSheet()->setCellValue('B'.$j,date('F,d,Y',strtotime($obj->issue_date)));
                           $this->excel->getActiveSheet()->setCellValue('C'.$j,idToName('admin','id',$obj->booked_agent_id,'login_name'));
                           $this->excel->getActiveSheet()->setCellValue('D'.$j,idToName('company','id',$obj->company,'company_name'));
                           $this->excel->getActiveSheet()->setCellValue('E'.$j,$fileNumber);
                           $this->excel->getActiveSheet()->setCellValue('F'.$j,$obj->supplier_ref);
                           $this->excel->getActiveSheet()->setCellValue('G'.$j,$obj->pnr);
                           $this->excel->getActiveSheet()->setCellValue('H'.$j,$obj->fullname);
                           $this->excel->getActiveSheet()->setCellValue('I'.$j,$leftBalce);
                           $this->excel->getActiveSheet()->setCellValue('J'.$j,number_format(($saleprice-$ticketCost),2));
                         
                         
                           $j++;
                           $serial++;
                    }
                    $lastLine=$j;
                    $showTotalChedAmont=$totalAmount;
                    $totalProde=$totalAmount-$refundedAmount;
                    
                    $this->excel->getActiveSheet()->setCellValue('H'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('I'.$lastLine,number_format($totalLeftBalance,2));
                    
                    
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine)->getFont()->setBold(true);            
                    
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine.':I'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
               }
                
                
		header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
               $objWriter->save('php://output'); 
        
        
    }
    
    public function paypalReport()
    {
        $data['view']='report_paypal_received_pending_bookings';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $this->load->view('dashboard',$data);
    }
    public function globalCardReport()
    {
        $data['view']='report_global_card_charges';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
//        $this->load->view('dashboard',$data);
         $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->getGlobalCardReport($fliterArray);
       echo $viewData;
    }
    public function getGlobalCardReport()
    {
        
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';       
            $qry2='';     
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,
                a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline, 
                t.card_charges,t.booking_id ,p.pay_to,p.pay_by,p.pay_type,p.amount,p.description,p.pay_date from booking_details
                    as a,flight_details as b,customer_contacts as c ,ticket_cost as t ,payment as p 
                    where a.id=c.booking_id AND a.id=b.booking_id AND a.id=t.booking_id AND a.id=p.booking_ref AND (p.pay_type='Dr' OR (p.pay_type='Cr' AND p.pay_by='Customer' ))  AND (p.pay_to='Debit Card Charge Global Travel' Or p.pay_to='Credit Card Charge Global Travel')  AND ".$condition."  order by a.id asc ";
//            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,
//                a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline, 
//                t.card_charges,t.booking_id from booking_details
//                    as a,flight_details as b,customer_contacts as c ,ticket_cost as t ,payment as p 
//                    where a.id=c.booking_id AND a.id=b.booking_id AND a.id=t.booking_id AND a.id=p.booking_ref AND p.pay_type='Dr'  AND (p.pay_to='Card Charge Global Travel' Or p.pay_to='')  AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        $data['globlCardReport']=$this->BaseModel->getQuery($qry);
        $data['reportCondition']=$reportCondition;
        $data['view']='report_global_card_charges';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        
        $this->load->view('dashboard',$data);
    }
    public function getGlobalCardReportSheet()
    {
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
         if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';       
            $qry2='';     
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  p.pay_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,
                a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline, 
                t.card_charges,t.booking_id ,p.pay_to,p.pay_by,p.pay_type,p.amount,p.description,p.pay_date from booking_details
                    as a,flight_details as b,customer_contacts as c ,ticket_cost as t ,payment as p 
                    where a.id=c.booking_id AND a.id=b.booking_id AND a.id=t.booking_id AND a.id=p.booking_ref AND (p.pay_type='Dr' OR (p.pay_type='Cr' AND p.pay_by='Customer' ))  AND (p.pay_to='Debit Card Charge Global Travel' Or p.pay_to='Credit Card Charge Global Travel')  AND ".$condition."  order by a.id asc ";

        }
        $data['globlCardReport']=$this->BaseModel->getQuery($qry);
        $data['reportCondition']=$reportCondition;
        $filename='Global Card Charges '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
        $sheetTitleN='Global Card Charges '.$startDate.' To '.$endDate; 
        $startda=date('d M y',strtotime($startDate));
        $endDa=date('d M y',strtotime($endDate));
        $finalTit=$startda." to ".$endDa;
        $titbook="Global ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Global Card Charges Sheet');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('I'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A2', 'Sr#');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Date');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Booking Ref');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Trans. Head');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Note');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Type');
                $this->excel->getActiveSheet()->setCellValue('G2', 'Amount');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Charges');
                $this->excel->getActiveSheet()->setCellValue('I2', 'Receivable');

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:I1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=3;		
                $serial=1;
                if(!empty($data['globlCardReport']))
                {
                    foreach($data['globlCardReport'] as $obj)
                    {
                    
                    $transectionType='';
                    $charges=0.0;
                     $totalAmount=($totalAmount+$obj->amount);
                     $totalCharges=($totalCharges+$obj->card_charges);
                                   
                      $encodeData=idencode($obj->id);
                        if($obj->pay_type=='Cr'){
                           $refundedAmount=($refundedAmount+ $obj->amount);
                        }
                        else
                        {
                            $totalReceivable=($totalReceivable + ( ($obj->amount - $obj->card_charges)));
                        }
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                        $url=base_url("BookingDetailBox/".$encodeData."/".idencode($obj->flag));
                    if($obj->pay_type=='Dr'){ $transectionType='Receipt'; $charges=round(($obj->amount -$obj->card_charges)); } else{ $transectionType='Refund'; $charges='-'.round(($obj->amount -$obj->card_charges)); }
                           $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                           $this->excel->getActiveSheet()->setCellValue('B'.$j,$obj->pay_date);
                           $this->excel->getActiveSheet()->setCellValue('C'.$j,$fileNumber);
                          $this->excel->getActiveSheet()->getCellByColumnAndRow('C',$j)->getHyperlink()->setUrl($url);
                           $this->excel->getActiveSheet()->setCellValue('D'.$j,'Global Card Charges');
                           $this->excel->getActiveSheet()->setCellValue('E'.$j,$obj->description);
                           $this->excel->getActiveSheet()->setCellValue('F'.$j,$transectionType);
                           $this->excel->getActiveSheet()->setCellValue('G'.$j,$obj->amount);
                           $this->excel->getActiveSheet()->setCellValue('H'.$j,$obj->card_charges);
                           $this->excel->getActiveSheet()->setCellValue('I'.$j,$charges);
                         
                         
                           $j++;
                           $serial++;
                    }
                    $lastLine=$j;
                    $showTotalChedAmont=$totalAmount;
                    $totalProde=$totalAmount-$refundedAmount;
                    
                    $this->excel->getActiveSheet()->setCellValue('F'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('G'.$lastLine,'Amount-Refund=Receipt('.$showTotalChedAmont.'-'.$refundedAmount.')='.round(($totalAmount-$refundedAmount),2));
                    $this->excel->getActiveSheet()->setCellValue('H'.$lastLine,'Charges='.round($totalCharges,1));
                    $this->excel->getActiveSheet()->setCellValue('I'.$lastLine,'Receipt-Charges-Refund=Receivable('.$totalProde.'-'.$totalCharges.'-'.$refundedAmount.')='.round($totalProde-$totalCharges-$refundedAmount,2));
                    
                    $this->excel->getActiveSheet()->getStyle('F'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('G'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('I'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('F'.$lastLine.':I'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
                
                
		header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
               $objWriter->save('php://output'); 
        
    }
    public function gdsReport()
    {
        $data['view']='report_gds';
        $data['pageTitle']='Reports';
        $data['tab']='reports'; 
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentForReport=  $this->input->post('agentForReport');
        $gdsForReport=  $this->input->post('gdsForReport');
        $supplierForReport=  $this->input->post('supplierForReport');
        $fliterArray=array(
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'agent'=>$agentForReport,
            'brand'=>$brand,
            'supplier'=>$supplierForReport,
            'gds'=>$gdsForReport
            
        );
       $viewData= $this->getGdsReport($fliterArray);
       echo $viewData;
        //$this->load->view('dashboard',$data);
    }
    public function getGdsReport()
    {
        
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' order by a.id asc ";
            
        }
        $data['customerRemaingBalance']=$this->BaseModel->getQuery($qry);
        $data['view']='report_gds';
        $data['reportCondition']=$reportCondition;
        $data['pageTitle']='GDS Report';
        $data['tab']='reports'; 
        $this->load->view('dashboard',$data);
    }
    public function getGdsReportSheet()
    {
        
        $startDate=  $this->input->post('reportStartDate');
        $endDate=  $this->input->post('endDate');
        $brand=  $this->input->post('brandForReport');
        $agentId=  $this->input->post('agentForReport');
        $gds=  $this->input->post('gdsForReport');
        $supplier=  $this->input->post('supplierForReport');
         $reportCondition=  array(
            'agentId'=>$agentId,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'brand'=>$brand,
            'supplier'=>$supplier,
            'gds'=>$gds
        );
        $loginFlag=$this->session->userdata('flag');
        if($loginFlag==1 || $loginFlag==2)
        {
            $condition='';
            $qry='';
            $qry2='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
              $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate'  AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' AND " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
             $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id AND ".$condition." AND flag='2' order by a.id asc ";
           
        }
        else
        {
            $qry='';
            $qry2='';
            $condition='';
            if(!empty($agentId))
            {
                $condition."  a.booked_agent_id='$agentId' AND  ";
            }
            if(!empty($startDate) && !empty($endDate))
            {
               $condition.="  a.issue_date BETWEEN '$startDate'  AND  '$endDate' AND " ;
            }
            if(!empty($supplier))
            {
                 $condition.="  a.supplier_name='$supplier' " ;
            }
            if(!empty($brand))
            {
                $condition.=" a.company='$brand' AND ";
            }
            $condition.=' 1=1';
            $qry="select a.id,a.supplier_ref,a.flag,a.booking_date,a.booked_agent_id,a.issue_date,a.supplier_name,a.company,a.booked_agent_id,c.fullname,b.destination,b.pnr,b.number_Of_segment,b.gds,b.airline from booking_details as a,flight_details as b,customer_contacts as c   where a.id=c.booking_id AND a.id=b.booking_id  AND ".$condition." AND flag='2' order by a.id asc ";
            
        }
        $data['customerRemaingBalance']=$this->BaseModel->getQuery($qry);
        
        $filename='GDS Report '.$startDate.' To '.$endDate.'.xls'; //save our workbook as this file name
        $sheetTitleN='GDS Report '.$startDate.' To '.$endDate; 
        $startda=date('d M y',strtotime($startDate));
        $endDa=date('d M y',strtotime($endDate));
        $finalTit=$startda." to ".$endDa;
        $titbook="Global ".$finalTit;
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle($titbook);
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'GDS Report Sheet');
//                $this->excel->getActiveSheet()->setCellValue('C2', 'Attendance Sheet');
                  for($col = ord('A'); $col <= ord('N'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $this->excel->getActiveSheet()->setCellValue('A2', 'Sr#');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Issue Date');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Brand Name');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Booking Ref No');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('F2', 'GDS');
                $this->excel->getActiveSheet()->setCellValue('G2', 'Dest');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Airline');
                $this->excel->getActiveSheet()->setCellValue('I2', 'PNR');
                $this->excel->getActiveSheet()->setCellValue('J2', 'Pax');
                $this->excel->getActiveSheet()->setCellValue('K2', 'Seg');
                $this->excel->getActiveSheet()->setCellValue('L2', 'Total Seg');
                $this->excel->getActiveSheet()->setCellValue('M2', 'E-Ticket No');
                $this->excel->getActiveSheet()->setCellValue('N2', 'Ticket Cost');

                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('k2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('M2')->getFont()->setBold(true);                     
                $this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);                     
                           
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:N1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('0b6623'); 
//                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('6F6F6F'); 
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '0b6623')))); 
		$j=3;		
                $serial=1;
                if(!empty($data['customerRemaingBalance']))
                {
                    $totalLeftBalance=0;
                    $totalPax=0;
                    $totalSegment=0;
                    $perpassangerSeg=0;
                    foreach($data['customerRemaingBalance'] as $obj)
                    {
                    $additionalCharges=0;
                    $transectionType='';
                    $payableSupplier=0;
                    $ticketCost=0;
                    $additionalCharges=(round(ticketCharges($obj->id),2)+round(ticketChargesAditional($obj->id),2));
                    $payableSupplier=round(ticketCost($obj->id),2);
                    $ticketCost=($additionalCharges+$payableSupplier);
                     $totalLeftBalance=$totalLeftBalance+$ticketCost;
                   $passgerCount=countTotal('passanger_details',array('booking_id'=>$obj->id));
                   $sementCount=($obj->number_Of_segment*$passgerCount);
                   $totalSegment=$totalSegment+$sementCount;
                   $totalPax=$totalPax+$passgerCount;
                   $perpassangerSeg=$perpassangerSeg+$obj->number_Of_segment;
                        $fileNumber=idToName('company','id',$obj->company,'company_Code')."-".$obj->id;
                        $url=base_url("BookingDetailBox/".$encodeData."/".idencode($obj->flag));
                    if($obj->pay_type=='Dr'){ $transectionType='Receipt'; $charges=round(($obj->amount -$obj->card_charges)); } else{ $transectionType='Refund'; $charges='-'.round(($obj->amount -$obj->card_charges)); }
                           $this->excel->getActiveSheet()->setCellValue('A'.$j, $serial);
                           $this->excel->getActiveSheet()->setCellValue('B'.$j,$obj->issue_date);
                           $this->excel->getActiveSheet()->setCellValue('C'.$j,idToName('company','id',$obj->company,'company_name'));
                         // $this->excel->getActiveSheet()->getCellByColumnAndRow('C',$j)->getHyperlink()->setUrl($url);
                           $this->excel->getActiveSheet()->setCellValue('D'.$j,$fileNumber);
                           $this->excel->getActiveSheet()->setCellValue('E'.$j,$obj->fullname);
                           $this->excel->getActiveSheet()->setCellValue('F'.$j,$obj->gds);
                           $this->excel->getActiveSheet()->setCellValue('G'.$j,substr($obj->destination,0,3));
                           $this->excel->getActiveSheet()->setCellValue('H'.$j,substr($obj->airline,0,2));
                           $this->excel->getActiveSheet()->setCellValue('I'.$j,$obj->pnr);
                           $this->excel->getActiveSheet()->setCellValue('J'.$j,$passgerCount);
                           $this->excel->getActiveSheet()->setCellValue('K'.$j,$obj->number_Of_segment);
                           $this->excel->getActiveSheet()->setCellValue('L'.$j,($passgerCount*$obj->number_Of_segment));
                           $this->excel->getActiveSheet()->setCellValue('M'.$j,eTickets($obj->id));
                           $this->excel->getActiveSheet()->setCellValue('N'.$j,$ticketCost);
                         
                         
                           $j++;
                           $serial++;
                    }
                    $lastLine=$j;
//                    $showTotalChedAmont=$totalAmount;
//                    $totalProde=$totalAmount-$refundedAmount;
//                    
                    $this->excel->getActiveSheet()->setCellValue('H'.$lastLine,'Total');
                    $this->excel->getActiveSheet()->setCellValue('J'.$lastLine,$totalPax);
                    $this->excel->getActiveSheet()->setCellValue('K'.$lastLine,$perpassangerSeg);
                    $this->excel->getActiveSheet()->setCellValue('L'.$lastLine,$totalSegment);
                    $this->excel->getActiveSheet()->setCellValue('N'.$lastLine,$totalLeftBalance);
//                    $this->excel->getActiveSheet()->setCellValue('G'.$lastLine,'('.$showTotalChedAmont.'-'.$refundedAmount.')='.round(($totalAmount-$refundedAmount),2));
//                    $this->excel->getActiveSheet()->setCellValue('H'.$lastLine,round($totalCharges,1));
//                    $this->excel->getActiveSheet()->setCellValue('I'.$lastLine,'('.$totalProde.'-'.$totalCharges.'-'.$refundedAmount.')='.round($totalProde-$totalCharges-$refundedAmount,2));
//                    
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('J'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('K'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('L'.$lastLine)->getFont()->setBold(true);            
                    $this->excel->getActiveSheet()->getStyle('N'.$lastLine)->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('H'.$lastLine.':N'.$lastLine)->applyFromArray(array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => 'ff0000'))));
                }
                
                
		header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
               $objWriter->save('php://output'); 
        
    }
}