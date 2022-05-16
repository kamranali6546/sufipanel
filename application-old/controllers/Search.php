<?php class Search extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
        //date_default_timezone_set('Europe/London');
    }
    public function index()
    {
        $data['view']='search_booking_view';
        $this->load->view('dashboard',$data);
    }
    
}