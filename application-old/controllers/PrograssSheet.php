<?php class PrograssSheet extends MY_Controller 
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
        $data['view']='progress_sheet_view';
        $data['tab']='progressSheet';
        $this->load->view('dashboard',$data);
    }
   
    
}