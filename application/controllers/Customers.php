<?php class Customers extends MY_Controller 
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
    }
    public function activities()
    {
        $data['view']='customer_activities_view';
        $data['pageTitle']='Customers Activites';
        $data['tab']='activies';
        $this->load->view('dashboard',$data);
    }
    public function customerInform()
    {
        $data['view']='customer_updates_view';
        $data['pageTitle']='Customers Update';
        $data['tab']='updatecustomer';
        $this->load->view('dashboard',$data);
    }
}