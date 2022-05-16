<?php class Ledger extends MY_Controller 
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
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
        $data['view']='ledgure_view';
        $data['tab']='ledgure';
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        $supplierHead=$this->input->post('supplierHead');
        if($opingDate!='' && $closingDate!='')
        {
            if(!empty($supplierHead))
            {
                if($supplierHead=='Global Travel')
                {
                    $qry=" Select * from payment where ( pay_to ='$supplierHead' OR pay_to ='Debit Card Charge Global Travel' OR pay_to ='Credit Card Charge Global Travel' ) AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                    $closeQry="Select * from payment where (pay_to ='$supplierHead' OR pay_to ='Debit Card Charge Global Travel' OR pay_to ='Credit Card Charge Global Travel' ) AND pay_date <='$closingBalanceEndDate' "; 
                }
                else
                {
                $qry=" Select * from payment where pay_to ='$supplierHead' AND pay_date BETWEEN '$opingDate' AND '$closingDate' ";
                $closeQry="Select * from payment where pay_to ='$supplierHead' AND pay_date <= '$closingBalanceEndDate' "; 
                }
            }
            else
            {
            $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
             $closeQry="Select * from payment where  AND pay_date <= '$closingBalanceEndDate' ";
            }
           $result=$this->BaseModel->getQuery($qry);
           $closeResult=$this->BaseModel->getQuery($closeQry);
          
        }
        else
        {
            $opingDate=date('Y-m-d');
            $closingDate=date('Y-m-d');
            if(!empty($supplierHead))
            {
               $qry=" Select * from payment where pay_to ='$supplierHead' AND pay_date BETWEEN '$opingDate' AND '$closingDate' "; 
            }
            else
            {
            $qry=" Select * from payment where pay_date BETWEEN '$opingDate' AND '$closingDate' ";
            }
           $result=$this->BaseModel->getQuery($qry);
        }
//         print_r($result);
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
        $data['supplierLedgur']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $data['SupHead']=$supplierHead;
        $this->load->view('dashboard',$data);
    }
   
    
}