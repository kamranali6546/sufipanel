<?php class BookBank extends MY_Controller 
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
        //date_default_timezone_set('Europe/London');
    }
    public function index()
    {
        $data['view']='bank_book_pk_view';
        $data['tab']='pkBankBook';
        $opingDate=$this->input->post('openingDate');
        $closingDate=$this->input->post('closingDate');
        $data['supplierData']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['BankData']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        $data['ExpenseData']=$this->BaseModel->getWhereM('expense_head',array('flag'=>1));
        $data['bankHead']=$this->BaseModel->getWhereM('bank',array('flag'=>1));
        if(empty($opingDate))
        {
            $opingDate=date('Y-m-d');
        }
        if(empty($closingDate))
        {
           $closingDate=date('Y-m-d');
        }
        $closingBalanceEndDate=date('Y-m-d', strtotime('-1 day', strtotime($opingDate)));
        $closingendDay=date('d', strtotime('-1 day', strtotime($opingDate)));
        $dayClose=$closingendDay-1;
        $closingBalanceStartDate=date('Y-m-d', strtotime('-'.$dayClose.' day', strtotime($closingBalanceEndDate)));
        if($opingDate!='' && $closingDate!='')
        {
             $qry=" Select * from payment where pay_to='Local Bank' AND payment_nature='bank' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
             $closeQry="Select * from payment where pay_to='Local Bank' AND payment_nature='bank' AND pay_date <='$closingBalanceEndDate' order by pay_date ASC ";
        }
        else
        {
            $qry=" Select * from payment where pay_to='Local Bank' AND payment_nature='bank' AND  pay_date BETWEEN '$opingDate' AND '$closingDate' order by pay_date ASC ";
            $closeQry="Select * from payment where pay_to='Local Bank' AND payment_nature='bank' AND pay_date <='$closingBalanceEndDate' order by pay_date ASC ";
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
        $data['cashBook']=$result;
        $data['openning']=$opingDate;
        $data['closing']=$closingDate;
        $this->load->view('dashboard',$data);
    }
    
   
    
}