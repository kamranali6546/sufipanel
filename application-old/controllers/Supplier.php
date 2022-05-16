<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
        //ob_end_flush();
        if($this->session->userdata('userId')==''){
            redirect("login");
        }
    }
    public function index()
    {
        $data['view']='supplier_view_all';
        $data['page']='table';
        $data['tab']='supplier';
        $data['pageTitle']='All Registered Suppliers';
         $qryGet2="Select * from suppliers where flag='1' Or flag=0 ";
         
       // $data['allSupplier']=$this->BaseModel->getWhereM('suppliers',array('flag'=>1));
        $data['allSupplier']=$this->BaseModel->getQuery($qryGet2);
        $this->load->view('dashboard',$data);
    }
    public function SaveSupplier()
    {
        $supplierName       = trim($this->input->post('supplierName'));
        $emailto            =  $this->input->post('supplierEmailTo');
        $emailcc            =  $this->input->post('supplierEmailcc');
        $banks              =  $this->input->post('supplierBanks');
        $supplierType       =  $this->input->post('supplierType');
        $supplierCountry    =  $this->input->post('supplierCountry');
        if($supplierName!='')
        {
            if($banks!='')
            {
                $restId=$this->BaseModel->save('suppliers',array('supplier_name'=>$supplierName,'to_email'=>$emailto,'cc_email'=>$emailcc,'flag'=>1,'type'=>$supplierType,'supplier_country'=>$supplierCountry,'BankId'=>$banks,'create_date'=>date('Y-m-d')));
            }
            else{
                $restId=$this->BaseModel->save('suppliers',array('supplier_name'=>$supplierName,'to_email'=>$emailto,'cc_email'=>$emailcc,'flag'=>1,'type'=>$supplierType,'supplier_country'=>$supplierCountry,'create_date'=>date('Y-m-d')));
            }
            
            if($restId >0)
                { 
//                foreach($banks as $key=> $bankItem)
//                {
//                    $this->BaseModel->save('supplierBank',array('supplierId'=>$restId,'BankId'=>$bankItem));
//                }
                echo $restId; 
                
                } else{ echo 0; }
        }
        else
        {
            echo 0;
        }
    }
    public function deleteSupplier()
    {
        $supplierId=$this->input->post('supplierId');
//        $this->BaseModel->del('supplierBank',array('supplierId'=>$supplierId));
        $resDeleted=$this->BaseModel->del('suppliers',array('id'=>$supplierId));
        if($resDeleted >0){ echo $resDeleted; } else{ echo 0; }
    }
    public function updateSupplier()
    {
        $supplierName=trim($this->input->post('supplierName'));
        $supplierId=$this->input->post('supplierId');
        $supplierBank=  $this->input->post('supplierBank');
        $mail_to=  $this->input->post('email_to');
        $mail_cc=  $this->input->post('email_cc');
        if(!empty($supplierName))
        {
            if($supplierBank!='')
            {
                $resp=$this->BaseModel->update('suppliers',array('supplier_name'=>$supplierName,'to_email'=>$mail_to,'BankId'=>$supplierBank,'cc_email'=>$mail_cc),array('id'=>$supplierId));
            }
            else
            {
                $resp=$this->BaseModel->update('suppliers',array('supplier_name'=>$supplierName,'to_email'=>$mail_to,'cc_email'=>$mail_cc),array('id'=>$supplierId));
            }
            if($resp >0){ echo $resp; } else{ echo 0; }
        }
        else
        {
           echo 0; 
        }
    }
}
?>