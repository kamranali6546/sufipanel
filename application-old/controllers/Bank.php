<?php 
class Bank extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common'); 
    }
    public function index()
    {
        $data['view']='all_bank_view';
        $data['page']='table';
        $data['tab']='bank';
        $data['allBanks']=$this->BaseModel->record('bank');
        $this->load->view('dashboard',$data);
    }
    public function saveBank()
    {
        $bankName=$this->input->post('bankName');
        $bankType=$this->input->post('bankType');
        $bankBrand=$this->input->post('bankBrand');
        
        $date=date('Y-m-d');
        $respData=$this->BaseModel->save('bank',array('bank_name'=>$bankName,'bank_type'=>$bankType,'brand'=>$bankBrand,'added_date'=>$date,'flag'=>1));
        if($respData >0)
        {
            echo $respData;
        }
        else
        {
            echo 0;
        }
    }
    public function deleteBank()
    {
        $bankId=$this->input->post('bankId');
        $deleteresp=$this->BaseModel->del('bank',array('id'=>$bankId));
        if($deleteresp >0)
        {
            echo $deleteresp;
        }
        else{ echo 0; }
    }
}



?>