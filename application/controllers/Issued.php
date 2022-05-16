<?php class Issued extends MY_Controller 
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
    public function index()
    {
        $data['view']='issued_booking_view';
        $data['page']='table';
        $data['tab']='issued'; 
        $data['pageTitle']='Issued Booking';
        $loginId=$this->session->userdata('userId');
        $brandFliter    =  $this->input->post('brand_fliter');
        $sortFliter     =  $this->input->post('sort_fliter');
      $brandFliterQ='';
      $sortOrder=" order by a.id asc  ";
      if(!empty($brandFliter))
      {
          $brandFliterQ.=" And a.booking_under_brand='$brandFliter' ";
      }
      if(!empty($sortFliter))
      {
          if($sortFliter=='b_date')
          {
            $sortOrder=" order by a.booking_date asc  "; 
          }
          else if($sortFliter=='t_date')
          {
              $sortOrder=" order by b.departure_date asc  "; 
          }
          else if($sortFliter=='b_no')
          {
            $sortOrder=" order by a.id asc  ";
          }
          else if($sortFliter=='c_name')
          {
            $sortOrder=" order by c.fullname asc  "; 
          }
          else if($sortFliter=='b_agent')
          {
            $sortOrder=" order by a.booked_agent_id asc  "; 
          }
      }
        $company=$this->session->userdata('company');
        if($this->session->userdata('flag')==1 && $company==1)
        {
        $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.flag='2' And a.cleared_stat!='1'  ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==2 && $company!=1)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.flag='2' And a.cleared_stat!='1'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        else if($this->session->userdata('flag')==3 && $company!=1)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.flag='2' and a.booking_under_brand='$company' And a.cleared_stat!='1'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        else if($this->session->userdata('flag')==5)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.flag='2' and a.booked_agent_id='$loginId' And a.cleared_stat!='1'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        $data['IssuedBookingData']=$this->BaseModel->getQuery($qry);
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['sortOrder']            = $sortFliter;
        $data['brandFliter']          = $brandFliter;   
        $this->load->view('dashboard',$data);
    }
    public function cleared()
    {
        $data['view']='issued_cleared_booking_view';
        $data['page']='table';
        $data['tab']='cleared'; 
        $data['pageTitle']='Issued Booking';
        $loginId=$this->session->userdata('userId');
        $brandFliter    =  $this->input->post('brand_fliter');
        $sortFliter     =  $this->input->post('sort_fliter');
      $brandFliterQ='';
      $sortOrder=" order by a.id asc  ";
      if(!empty($brandFliter))
      {
          $brandFliterQ.=" And a.booking_under_brand='$brandFliter' ";
      }
      if(!empty($sortFliter))
      {
          if($sortFliter=='b_date')
          {
            $sortOrder=" order by a.booking_date asc  "; 
          }
          else if($sortFliter=='t_date')
          {
              $sortOrder=" order by b.departure_date asc  "; 
          }
          else if($sortFliter=='b_no')
          {
            $sortOrder=" order by a.id asc  ";
          }
          else if($sortFliter=='c_name')
          {
            $sortOrder=" order by c.fullname asc  "; 
          }
          else if($sortFliter=='b_agent')
          {
            $sortOrder=" order by a.booked_agent_id asc  "; 
          }
      }
        
        if($this->session->userdata('flag')==1)
        {
        $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.flag='2' And a.cleared_stat='1'   ".$brandFliterQ." ".$sortOrder." ";
        }
        else if($this->session->userdata('flag')==2)
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.flag='2' And a.cleared_stat='1'  ".$brandFliterQ." ".$sortOrder." ";  
        }
        else if($this->session->userdata('flag')==3)
        {
           $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname  
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id and a.flag='2' And a.cleared_stat='1' And a.booking_under_brand='".$this->session->userdata('company')."' ".$brandFliterQ." ".$sortOrder." "; 
        }
        else
        {
            $qry="select a.id,a.booked_agent_id,a.company,a.booking_under_brand,a.booking_date,a.supplier_ref,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,b.returnDate,c.fullname   
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and a.id=c.booking_id and a.flag='2' and a.booked_agent_id='$loginId' And a.cleared_stat='1'  ".$brandFliterQ." ".$sortOrder." "; 
        }
        $data['IssuedBookingData']=$this->BaseModel->getQuery($qry);
        $data['copany']=$this->BaseModel->getWhereM('company',array('status'=>1));
        $data['sortOrder']            = $sortFliter;
        $data['brandFliter']          = $brandFliter;   
        $this->load->view('dashboard',$data);
    }
    
}