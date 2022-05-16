<?php
   /*
 * @author SHAHID Aslam
 * @cell 03446613497
 */
class Income extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        
    }
    public function saveIncome()
    {
        $incomeHead=  $this->input->post('incomeHead');
        $headType=    $this->input->post('incomeType');
        $incomeBrand=  $this->input->post('incomeBrand');
        $res=$this->BaseModel->save('income_head',array('head_name'=>$incomeHead,'income_type'=>$headType,'flag'=>1,'brand'=>$incomeBrand));
        if($res >0){ echo $res; } else{ echo 0; }
    }
    public function delete()
    {
        $id=  $this->input->post('idIncome');
        $resp=$this->BaseModel->del('income_head',array('id'=>$id));
        if($resp>0)
        {
            echo $resp;
        }
        else { echo 0; }
        
    }
   public function ukOtherIncome()
    {
        $data['view']='uk_other_income_view';
        $data['tab']='UkOtherIncome';
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        $bankFliterName=  $this->input->post('income');
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Uk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        $data['bankHead']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Uk'));
        $data['IncomData']=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        if(empty($opingDate))
        {
            $opingDate=date('Y-m-d');
        }
        if(empty($closingDate))
        {
           $closingDate=date('Y-m-d');
        }
        if(!empty($bankFliterName)) 
        {
            $localbank=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk','head_name'=>$bankFliterName));
        }
        else
        {
            $localbank=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Uk'));
        } 
       // $localbank=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $localBankArray=array();
        $listdata='';
        if(!empty($localbank))
        {
            foreach($localbank as $key=> $loBank)
            {
                $localBankArray[]="$loBank->head_name";
                if($key==0)
                {
                    $listdata.="'$loBank->head_name'";
                }
                else
                {
                    $listdata.=",'$loBank->head_name'";
                }
                
            }
        }
       // $listdata=  implode(',', $localBankArray);
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        if($opingDate!='' && $closingDate!='')
        {
             $qry=" Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
             $closeQry="Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND pay_date <='$closingBalanceEndDate'  order by pay_date ASC ";
        }
        else
        {
            $qry=" Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
            $closeQry="Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND pay_date <='$closingBalanceEndDate' order by pay_date ASC ";
        }
        $result=$this->BaseModel->getQuery($qry);
        $closeResult=$this->BaseModel->getQuery($closeQry);
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
        $data['incomeBook']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['fliterBankName']=$bankFliterName;
        
        $this->load->view('dashboard',$data);
    }
    public function pkOtherIncome()
    {
        $data['view']='pk_other_income_view';
        $data['tab']='PkOtherIncome';
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        $bankFliterName=  $this->input->post('income');
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1,'supplier_country'=>'Pk'));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'local'));
        $data['bankHead']=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $data['IncomData']=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk'));
        if(empty($opingDate))
        {
            $opingDate=date('Y-m-d');
        }
        if(empty($closingDate))
        {
           $closingDate=date('Y-m-d');
        }
        if(!empty($bankFliterName)) 
        {
            $localbank=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk','head_name'=>$bankFliterName));
        }
        else
        {
            $localbank=$this->BaseModel->getWhereM('income_head',array('flag'=>1,'income_type'=>'Pk'));
        } 
       // $localbank=$this->BaseModel->getWhereM('bank',array('flag'=>1,'bank_type'=>'Pk'));
        $localBankArray=array();
        $listdata='';
        if(!empty($localbank))
        {
            foreach($localbank as $key=> $loBank)
            {
                $localBankArray[]="$loBank->head_name";
                if($key==0)
                {
                    $listdata.="'$loBank->head_name'";
                }
                else
                {
                    $listdata.=",'$loBank->head_name'";
                }
                
            }
        }
       // $listdata=  implode(',', $localBankArray);
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        if($opingDate!='' && $closingDate!='')
        {
             $qry=" Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
             $closeQry="Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND pay_date <='$closingBalanceEndDate'  order by pay_date ASC ";
        }
        else
        {
            $qry=" Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
            $closeQry="Select * from payment where pay_to IN (".$listdata.") AND payment_nature='income' AND pay_date <='$closingBalanceEndDate' order by pay_date ASC ";
        }
        $result=$this->BaseModel->getQuery($qry);
        $closeResult=$this->BaseModel->getQuery($closeQry);
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
        $data['incomeBook']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['fliterBankName']=$bankFliterName;
        
        $this->load->view('dashboard',$data);
    }
}
?>