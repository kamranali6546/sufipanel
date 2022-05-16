<?php error_reporting(0); 
class Country extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 *  @cell 03446613497
 */   
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
         if($this->session->userdata('userId')==''){
            redirect("login");
        }
    }
    public function index()
    {
        
    }
}
?>