<?php
class DeleteFiles extends MY_Controller
{
    public function __constructr()
    {
        parent::construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        $data['view']='booking_delete_view';
        $data['page']='table';
        $data['tab']='deletefile';
        $data['pageTitle']='Delete Booking';
        $this->load->view('dashboard',$data);
        
    }
}
?>