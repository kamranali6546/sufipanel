<?php class Expenditure extends MY_Controller 
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
        date_default_timezone_set('Europe/London');
    }
    public function index()
    {
        $data['view']='expendutire_view';
        $data['tab']='expense';
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
        $data['expenseHeads']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'uk'));
        if(!empty($this->input->post('opningDate')) && !empty($this->input->post('closingDate')))
        {
            $opingDate=$this->input->post('opningDate');
            $closingDate=$this->input->post('closingDate');
        }
        else
        {
            $opingDate=date('Y-m-01');
            $a_date = date('Y-m-d');
            $lastDay= date("t", strtotime($a_date));
            $lastDateOfMonth=date('Y-m-'.$lastDay);
            $closingDate=$lastDateOfMonth;
        }
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        $expenseFliter=$this->input->post('expenseFliter');
        $openingBalance=0;
        if($opingDate!='' && $closingDate!='')
        {
             if(!empty($expenseFliter) && $expenseFliter!='netExp')
             {
                  $qry=" Select * from payment where pay_to ='$expenseFliter' AND payment_nature='expense' AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                  $closeQry="Select * from payment where pay_to ='$expenseFliter' AND payment_nature='expense' AND pay_date <= '$closingBalanceEndDate' "; 
             }
             else if(!empty ($expenseFliter) && $expenseFliter=='netExp')
             {
                 $qry=" Select * from payment where   payment_nature='expense' AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                  $closeQry="Select * from payment where   payment_nature='expense' AND pay_date <= '$closingBalanceEndDate' "; 
             }
             else
             {
               $qry=" Select * from payment where   payment_nature='expense' AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
               $closeQry="Select * from payment where   payment_nature='expense' AND pay_date <= '$closingBalanceEndDate' ";   
             }
             $result=$this->BaseModel->getQuery($qry);
             $closeResult=$this->BaseModel->getQuery($closeQry);
             
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
        }
        else
        {
            
        }
        $data['ExpendatureResult']=$result;
        $data['openingBalance']=$openingBalance;
        $data['openingBalanceDate']=$closingBalanceEndDate;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['ExpendHead']=$expenseFliter;
        $this->load->view('dashboard',$data);
    }
    public function officeExpensePk()
    {
       $data['view']='office_expense_view';
       $data['tab']='officeExpensePk';
       $data['expenseHeads']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1,'expense_type'=>'pk'));
       $this->load->view('dashboard',$data); 
    }
    public function getIncome()
    {
       $data['view']='income-view';
       $data['tab']='income';
       $data['IncomeHead']=$this->BaseModel->record('income_head');
       $this->load->view('dashboard',$data); 
    }
   
    
}