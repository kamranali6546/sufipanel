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
        if(!empty($this->input->post('dateFliter')))
        {
            $fliterDate=date('Y-m-d',strtotime($this->input->post('dateFliter')));
        }
        else
        {
            $fliterDate=date('Y-m-d');
        }
        if(!empty($fliterDate))
        {
         $qry=" Select * from payment where pay_date='$fliterDate' ";   
        }
        $result=$this->BaseModel->getQuery($qry);
        
         $dataArray=array(
            'Assets'=>array(),
            'Expanse'=>array(),
            'Libilities'=>array(),
            'Income'=>array()
            );
         $noreaptHead=array(
             'account'=>array(),
         );
        foreach($result as $key=> $obj)
        {
            if($key==0)
            {
              $noreaptHead=array(
             $obj->pay_to=>array(
                 'amount'=>$obj->amount,
                 'type'=>$obj->payment_nature
                 )
               );  
            }
            else
            {
                 if(array_key_exists($obj->pay_to, $noreaptHead))
                {
                    if($obj->pay_type=='Dr')
                    {
                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
                    }
                    else if($obj->pay_type=='Cr')
                    {
                        //$dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]-$obj->amount;
                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
                    }
                   // $dataArray['assets'][$obj->pay_to]=0;
                }
                else
                {
                    if($obj->pay_type=='Dr')
                    {
                        //$dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]+$obj->amount;
                         $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
                    }
                    else if($obj->pay_type=='Cr')
                    {
                       // $dataArray['assets'][$obj->pay_to]=$dataArray['assets'][$obj->pay_to]-$obj->amount;
                        $noreaptHead[$obj->pay_to]['amount']=$noreaptHead[$obj->pay_to]['amount']+$obj->amount;
                        $noreaptHead[$obj->pay_to]['type']=$obj->payment_nature;
                    }
                    //$dataArray['assets'][$obj->pay_to]=0;
                }
            }
           
        }
        foreach($noreaptHead  as $keyF=> $finalObj)
        {
            if($finalObj['type']=='bank')
            {
                $bType='';
                $bType=idToName('bank','bank_name',$keyF,'bank_type');
                if($bType=='Uk')
                {
                 $dataArray['Assets'][$keyF]=$finalObj['amount'];
                 $dataArray['Assets']['total']=$dataArray['Assets']['total'] + $finalObj['amount'];
                }
           
            }
            else if($finalObj['type']=='customer')
            {
                $dataArray['Libilities'][$keyF]=$finalObj['amount'];
                $dataArray['Libilities']['total']=$dataArray['Libilities']['total'] + $finalObj['amount'];
//                $dataArray=array(
//            'assets'=>array(),
//            'expanse'=>array(),
//            'libilities'=>array(),
//            'income'=>array()
//            );   
            }
            else if($finalObj['type']=='supplier')
            {
                if($finalObj['amount'] >0)
                {
                    $dataArray['Assets'][$keyF]=$finalObj['amount'];
                    $dataArray['Assets']['total']=$dataArray['Assets']['total'] + $finalObj['amount'];
                }
                else
                {
                     $dataArray['Libilities'][$keyF]=$finalObj['amount'];
                    $dataArray['Libilities']['total']=$dataArray['Libilities']['total'] + $finalObj['amount'];
                }
            }
            else if($finalObj['type']=='expense')
            {
                 $eType='';
                $eType=idToName('expense_head','expense_name',$keyF,'expense_type');
                if($eType=='uk')
                {
                 $dataArray['Expanse'][$keyF]=$finalObj['amount'];
                 $dataArray['Expanse']['total']=$dataArray['Expanse']['total'] + $finalObj['amount'];
                }
            }
        }
        $data['trialBalance']=$result;
        $data['fDate']=$fliterDate;
        $data['newTrialBalance']=$dataArray;
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
        $data['trialBalance']=$result;
        $data['fDate']=$fliterDate;
        $data['fDateClose']=$fliterDateClose;
       $this->load->view('dashboard',$data); 
    }
   
    
}