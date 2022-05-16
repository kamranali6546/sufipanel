<?php class Canceled extends MY_Controller 
{
/*
 * @author SHAHID Aslam
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
    }
    public function index()
    {
        $data['view']='cancel_booking_view';
        $data['page']='table';
        $data['tab']='cancel';
        $loginId=$this->session->userdata('userId');
         $data['pageTitle']='Canceled Booking';
        if($this->session->userdata('flag')==1)
        {
        $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_date,a.canceled_stat,a.cancel_date,a.flag,a.supplier_ref,b.departure_date,b.returnDate,c.fullname  
from booking_details as a ,flight_details as b,customer_contacts as c 
where a.id=b.booking_id and  a.id=c.booking_id and a.canceled_stat='1'  order by a.id asc ";
        }
        else
        {
            $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_date,a.flag,a.canceled_stat,a.cancel_date,a.supplier_ref,b.departure_date,b.returnDate,c.fullname   
from booking_details as a ,flight_details as b,customer_contacts as c 
where a.id=b.booking_id and a.id=c.booking_id and a.canceled_stat='1' and a.booked_agent_id='$loginId'  order by a.id asc "; 
        }
        $data['cancelledBooking']=$this->BaseModel->getQuery($qry);
        $this->load->view('dashboard',$data);
    }
    
}