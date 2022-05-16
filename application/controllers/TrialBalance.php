<?php class TrialBalance extends MY_Controller 
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
        $this->load->library('excel');
        date_default_timezone_set('Europe/London');
    }
    public function index()
    {
        $data['view']='trial_balance_view';
        $data['tab']='trialBalance';
//        if(!empty($this->input->post('dateFliter')))
//        {
//            $fliterDate=date('Y-m-d',strtotime($this->input->post('dateFliter')));
//        }
//        else
//        {
//            $fliterDate=date('Y-m-d');
//        }
//        if(!empty($fliterDate))
//        {
//         $qry=" Select * from payment where pay_date='$fliterDate' ";   
//        }
//        $result=$this->BaseModel->getQuery($qry);
//        
//        $dataArray=array(
//            'Assets'=>array(),
//            'Expanse'=>array(),
//            'Libilities'=>array(),
//            'Income'=>array()
//            );
//         $noreaptHead=array(
//             'account'=>array(),
//         );
//        foreach($result as $key=> $obj)
//        {
//            if($key==0)
//            {
//              $noreaptHead=array(
//             $obj->pay_to=>array(
//                 'amount'=>$obj->amount,
//                 'type'=>$obj->payment_nature
//                 )
//               );  
//            }
//            else
//            {
//                 if(array_key_exists($obj->pay_to, $noreaptHead))
//                {
//                    if($obj->pay_type=='Dr')
//                    {
//                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
//                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
//                    }
//                    else if($obj->pay_type=='Cr')
//                    {
//                        //$dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]-$obj->amount;
//                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
//                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
//                    }
//                }
//                else
//                {
//                    if($obj->pay_type=='Dr')
//                    {
//                        //$dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]+$obj->amount;
//                         $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
//                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
//                    }
//                    else if($obj->pay_type=='Cr')
//                    {
//                       // $dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]-$obj->amount;
//                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
//                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
//                    }
//                }
//            }
//           
//        }
//        foreach($noreaptHead  as $keyF=> $finalObj)
//        {
//            if($finalObj['type']=='bank')
//            {
//                $bType='';
//                $bType=idToName('bank','bank_name',$keyF,'bank_type');
//                if($bType=='Uk')
//                {
//                 $dataArray['Assets'][$keyF]=$finalObj['amount'];
//                 $dataArray['Assets']['total']=$dataArray['Assets']['total'] + $finalObj['amount'];
//                }
//           
//            }
//            else if($finalObj['type']=='customer')
//            {
//                $dataArray['Libilities'][$keyF]=$finalObj['amount'];
//                $dataArray['Libilities']['total']=$dataArray['Libilities']['total'] + $finalObj['amount'];  
//            }
//            else if($finalObj['type']=='supplier')
//            {
//                if($finalObj['amount'] >0)
//                {
//                    $dataArray['Assets'][$keyF]=$finalObj['amount'];
//                    $dataArray['Assets']['total']=$dataArray['Assets']['total'] + $finalObj['amount'];
//                }
//                else
//                {
//                     $dataArray['Libilities'][$keyF]=$finalObj['amount'];
//                    $dataArray['Libilities']['total']=$dataArray['Libilities']['total'] + $finalObj['amount'];
//                }
//            }
//            else if($finalObj['type']=='expense')
//            {
//                 $eType='';
//                $eType=idToName('expense_head','expense_name',$keyF,'expense_type');
//                if($eType=='uk')
//                {
//                 $dataArray['Expanse'][$keyF]=$finalObj['amount'];
//                 $dataArray['Expanse']['total']=$dataArray['Expanse']['total'] + $finalObj['amount'];
//                }
//            }
//        }
//        
//        $data['newTrialBalance']=$dataArray;
//        $data['trialBalance']=$result;
//        $data['fDate']=$fliterDate;
        
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        $fianalData=array();
        $bank=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $supplier=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $expenses=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $income=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        if(!empty($bank))
        {
            foreach($bank as $bObj)
            {
                $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='bank'  AND `pay_to`='".$bObj->bank_name."' ";
               //echo  $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='bank'  AND (`pay_to`='".$bObj->bank_name."' OR `pay_by`='".$bObj->bank_name."')";
                $bankBal=$this->BaseModel->getQuery($qry);
                if(!empty($bankBal))
                {
                  // $fianalData[][$bObj->bank_name][]=$bObj->bank_name; 
                   if($bankBal[0]->total >0)
                   {
                       $fianalData[$bObj->bank_name]['dr']=$bankBal[0]->total; 
                       $fianalData[$bObj->bank_name]['cr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                   }
                   else if(!empty ($bankBal[0]->total))
                    {
                       $fianalData[$bObj->bank_name]['cr']=abs($bankBal[0]->total); 
                       $fianalData[$bObj->bank_name]['dr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                    }
                    else
                    {
                       $fianalData[$bObj->bank_name]['cr']='-'; 
                       $fianalData[$bObj->bank_name]['dr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                    }
                   
                }
            }
        }
        if(!empty($supplier))
        {
            foreach($supplier as $supplir)
            {
                $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where `pay_to`='".$supplir->supplier_name."' ";
                $supplierBal=$this->BaseModel->getQuery($qry);
                if(!empty($supplierBal))
                {
                   if($supplierBal[0]->total >0)
                   {
                       $fianalData[$supplir->supplier_name]['dr']=$supplierBal[0]->total; 
                       $fianalData[$supplir->supplier_name]['cr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                   }
                   else if(!empty ($supplierBal[0]->total))
                    {
                       $fianalData[$supplir->supplier_name]['cr']=abs($supplierBal[0]->total); 
                       $fianalData[$supplir->supplier_name]['dr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                    }
                    else
                    {
                       $fianalData[$supplir->supplier_name]['cr']='-'; 
                       $fianalData[$supplir->supplier_name]['dr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                    }
                   
//                    if($supplir->supplier_name=='Customer')
//                    {
//                        if($supplierBal[0]->total >0)
//                        {
//                            $fianalData[$supplir->supplier_name]['dr']='-'; 
//                            $fianalData[$supplir->supplier_name]['cr']=$supplierBal[0]->total;
//                            $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
//                        }
//                        else if(!empty ($supplierBal[0]->total))
//                         {
//                            $fianalData[$supplir->supplier_name]['cr']=abs($supplierBal[0]->total); 
//                            $fianalData[$supplir->supplier_name]['dr']='-';
//                            $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
//                         }
//                    }
//                    else
//                    {
//                            if($supplierBal[0]->total >0)
//                         {
//                             $fianalData[$supplir->supplier_name]['dr']=$supplierBal[0]->total; 
//                             $fianalData[$supplir->supplier_name]['cr']='-';
//                             $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
//                         }
//                         else if(!empty ($supplierBal[0]->total))
//                          {
//                             $fianalData[$supplir->supplier_name]['cr']=abs($supplierBal[0]->total); 
//                             $fianalData[$supplir->supplier_name]['dr']='-';
//                             $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
//                          }
//                          else
//                          {
//                             $fianalData[$supplir->supplier_name]['cr']='-'; 
//                             $fianalData[$supplir->supplier_name]['dr']='-';
//                             $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
//                          }  
//                    }
                }
            }
        }
        if(!empty($expenses))
        {
           foreach($expenses as $exp)
           {
               $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='expense'  AND (`pay_to`='".$exp->expense_name."' OR `pay_by`='".$exp->expense_name."')";
                $expensesBal=$this->BaseModel->getQuery($qry);
                if(!empty($expensesBal))
                {
                    if($expensesBal[0]->total >0)
                    {
                       $fianalData[$exp->expense_name]['dr']=$expensesBal[0]->total; 
                       $fianalData[$exp->expense_name]['cr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name;
                    }
                    else if($expensesBal[0]->total >0)
                    {
                       $fianalData[$exp->expense_name]['cr']=abs($expensesBal[0]->total); 
                       $fianalData[$exp->expense_name]['dr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name;
                    }
                    else
                    {
                       $fianalData[$exp->expense_name]['cr']='-'; 
                       $fianalData[$exp->expense_name]['dr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name; 
                    }
                }
                
           } 
        }
        if(!empty($income))
        {
            foreach($income as $incom)
           {
               $qry="SELECT   sum(IF (pay_type='Cr',amount,0))- sum(IF (pay_type='Dr',amount,0)) as total FROM `payment` where  `payment_nature`='income'  AND `pay_to`='".$incom->head_name."' ";
                $incomeBal=$this->BaseModel->getQuery($qry);
                if(!empty($incomeBal))
                {
                    if($incomeBal[0]->total >0)
                    {
                       $fianalData[$incom->head_name]['dr']=$incomeBal[0]->total; 
                       $fianalData[$incom->head_name]['cr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name;
                    }
                    else if($expensesBal[0]->total >0)
                    {
                       $fianalData[$incom->head_name]['cr']=abs($incomeBal[0]->total); 
                       $fianalData[$incom->head_name]['dr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name;
                    }
                    else
                    {
                       $fianalData[$incom->head_name]['cr']='-'; 
                       $fianalData[$incom->head_name]['dr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name; 
                    }
                }
                
           }
        }
//        echo "<pre>";
//        print_r($fianalData);
//        echo "</pre>";
        if($opingDate!='' && $closingDate!='')
        {
            $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
            $closeQry="Select * from payment where   pay_date <= '$closingBalanceEndDate' ";
        }
        else
        {
            $opingDate=date('Y-m-d');
            $closingDate=date('Y-m-d');
            $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
           $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
            $closeQry="Select * from payment where  pay_date <= '$closingBalanceEndDate' ";
        }
        
         $result=$this->BaseModel->getQuery($qry);
         $closeResult=$this->BaseModel->getQuery($closeQry);
         $openingBalanceDr=0;
        $openingBalanceCr=0;
        foreach($closeResult as $objClose)
        {
            if($objClose->pay_type=='Dr')
            {
                $openingBalanceDr=$openingBalanceDr+$objClose->amount;
            }
            if($objClose->pay_type=='Cr')
            {
                $openingBalanceCr=$openingBalanceCr+$objClose->amount;
            }
        }
        $data['trialBalanceData']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['drOpen']=$openingBalanceDr;
        $data['crClose']=$openingBalanceCr;
        $data['trialBalan']=$fianalData;
        $this->load->view('dashboard',$data);
    }
    public function accountsFinal()
    {
       $data['view']='final_accounts_view';
       $data['tab']='accountsFinal';
       $this->load->view('dashboard',$data); 
    }
    public function trialBalancePakistan()
    {
       $data['view']='trial_balance_pakistan_view';
       $data['tab']='pkTrialBalance';
       if(!empty($this->input->post('dateFliter')) && !empty($this->input->post('dateFliterClose')))
        {
            $fliterDate=date('Y-m-d',strtotime($this->input->post('dateFliter')));
            $fliterDateClose=date('Y-m-d',strtotime($this->input->post('dateFliterClose')));
            
        }
        else
        {
            $fliterDate=date('Y-m-d');
            $fliterDateClose=date('Y-m-d');
        }
        if(!empty($fliterDate))
        {
         $qry=" Select * from payment where pay_date BETWEEN '$fliterDate' AND '$fliterDateClose' ";   
        }
        $result=$this->BaseModel->getQuery($qry);
        $fianalData=array();
        $supplier=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Pk'));
        $bank=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $expenses=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'local'));
        $income=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk'));
        
        if(!empty($bank))
        {
            foreach($bank as $bObj)
            {
                $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='bank'  AND `pay_to`='".$bObj->bank_name."' ";
               
                $bankBal=$this->BaseModel->getQuery($qry);
                if(!empty($bankBal))
                {
                   if($bankBal[0]->total >0)
                   {
                       $fianalData[$bObj->bank_name]['dr']=$bankBal[0]->total; 
                       $fianalData[$bObj->bank_name]['cr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                   }
                   else if(!empty ($bankBal[0]->total))
                    {
                       $fianalData[$bObj->bank_name]['cr']=abs($bankBal[0]->total); 
                       $fianalData[$bObj->bank_name]['dr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                    }
                    else
                    {
                       $fianalData[$bObj->bank_name]['cr']='-'; 
                       $fianalData[$bObj->bank_name]['dr']='-';
                       $fianalData[$bObj->bank_name]['head']=$bObj->bank_name;
                    }
                   
                }
            }
        }
        if(!empty($supplier))
        {
            foreach($supplier as $supplir)
            {
                $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where `pay_to`='".$supplir->supplier_name."' ";
                $supplierBal=$this->BaseModel->getQuery($qry);
                if(!empty($supplierBal))
                {
                   if($supplierBal[0]->total >0)
                   {
                       $fianalData[$supplir->supplier_name]['dr']=$supplierBal[0]->total; 
                       $fianalData[$supplir->supplier_name]['cr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                   }
                   else if(!empty ($supplierBal[0]->total))
                    {
                       $fianalData[$supplir->supplier_name]['cr']=abs($supplierBal[0]->total); 
                       $fianalData[$supplir->supplier_name]['dr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                    }
                    else
                    {
                       $fianalData[$supplir->supplier_name]['cr']='-'; 
                       $fianalData[$supplir->supplier_name]['dr']='-';
                       $fianalData[$supplir->supplier_name]['head']=$supplir->supplier_name;
                    }
                   
                }
            }
        }
        if(!empty($expenses))
        {
           foreach($expenses as $exp)
           {
               $qry="SELECT sum(IF (pay_type='Dr',amount,0)) - sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='expense'  AND (`pay_to`='".$exp->expense_name."' OR `pay_by`='".$exp->expense_name."')";
                $expensesBal=$this->BaseModel->getQuery($qry);
                if(!empty($expensesBal))
                {
                    if($expensesBal[0]->total >0)
                    {
                       $fianalData[$exp->expense_name]['dr']=$expensesBal[0]->total; 
                       $fianalData[$exp->expense_name]['cr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name;
                    }
                    else if($expensesBal[0]->total >0)
                    {
                       $fianalData[$exp->expense_name]['cr']=abs($expensesBal[0]->total); 
                       $fianalData[$exp->expense_name]['dr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name;
                    }
                    else
                    {
                       $fianalData[$exp->expense_name]['cr']='-'; 
                       $fianalData[$exp->expense_name]['dr']='-';
                       $fianalData[$exp->expense_name]['head']=$exp->expense_name; 
                    }
                }
                
           } 
        }
        if(!empty($income))
        {
            foreach($income as $incom)
           {
               $qry="SELECT  sum(IF (pay_type='Dr',amount,0))-sum(IF (pay_type='Cr',amount,0)) as total FROM `payment` where  `payment_nature`='income'  AND `pay_to`='".$incom->head_name."' ";
                $incomeBal=$this->BaseModel->getQuery($qry);
                if(!empty($incomeBal))
                {
                    if($incomeBal[0]->total >0)
                    {
                       $fianalData[$incom->head_name]['dr']=$incomeBal[0]->total; 
                       $fianalData[$incom->head_name]['cr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name;
                    }
                    else if($expensesBal[0]->total >0)
                    {
                       $fianalData[$incom->head_name]['cr']=abs($incomeBal[0]->total); 
                       $fianalData[$incom->head_name]['dr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name;
                    }
                    else
                    {
                       $fianalData[$incom->head_name]['cr']='-'; 
                       $fianalData[$incom->head_name]['dr']='-';
                       $fianalData[$incom->head_name]['head']=$incom->head_name; 
                    }
                }
                
           }
        }
        $data['pkTrialBalance']= $fianalData;
        $data['trialBalance']=$result;
        $data['fDate']=$fliterDate;
        $data['fDateClose']=$fliterDateClose;
       $this->load->view('dashboard',$data); 
    }
   
    
}