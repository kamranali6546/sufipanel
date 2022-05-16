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
     public function doSearch()
    {
        $searchValue        =   $this->input->post('search_param');
        $startDate          =   $this->input->post('startDate');
        $endDate            =   $this->input->post('endDate');
        $optionSelected     =   $this->input->post('optradio');
        $flag               =   $this->session->userdata('flag');
        $brand              =   $this->session->userdata('company');
        $loginId            =   $this->session->userdata('userId');
        if(!empty($optionSelected))
        {
            if($optionSelected=='booking_date')
            {
                if(!empty($startDate) && !empty($endDate))
                {
                    $startDate=date('Y-m-d',  strtotime($startDate));
                    $endDate=date('Y-m-d',  strtotime($endDate));
                    if($flag==1 || $flag==2)
                    {
                        $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.booking_date BETWEEN '$startDate' AND '$endDate' ";
                    }
                    else if($flag==3)
                    {
                        $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND a.booking_date BETWEEN '$startDate' AND '$endDate' ";
                    }
                    else
                    {
                         $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND a.booking_date BETWEEN '$startDate' AND '$endDate' ";
                    }
                  
                }
            }
            else if($optionSelected=='ticket_issue_date')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                 if($flag==1 || $flag==2)
                 {
                     $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.issue_date BETWEEN '$startDate' AND '$endDate' ";
                 }
                 else if($flag==3)
                 {
                     $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.booking_under_brand='$brand' AND a.issue_date BETWEEN '$startDate' AND '$endDate' ";
                 }
                 else
                 {
                     $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND a.issue_date BETWEEN '$startDate' AND '$endDate' ";
                 }
                  
            }
            else if($optionSelected=='travel_date')
            {
                 $startDate=date('Y-m-d',  strtotime($startDate));
                 $endDate=date('Y-m-d',  strtotime($endDate));
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND b.departure_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.booking_under_brand='$brand' AND  b.departure_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.booked_agent_id='$loginId' AND b.departure_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                 
            }
            else if($optionSelected=='cancel_date')
            {
                 $startDate=date('Y-m-d',  strtotime($startDate));
                 $endDate=date('Y-m-d',  strtotime($endDate));
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.canceled_stat='1' AND a.cancel_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.canceled_stat='1' AND a.booking_under_brand='$brand' AND  a.cancel_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.canceled_stat='1' AND a.booked_agent_id='$loginId' AND a.cancel_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                 
            }
            else if($optionSelected=='booking_ref')
            {
                 $number = preg_replace("/[^0-9]/", '', $searchValue);
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id='$number'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND a.id='$number' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  AND a.booked_agent_id='$loginId' AND a.id='$number'  ";
                  }
                 
            }
            else if($optionSelected=='passenger_surname')
            {
                 $number = $searchValue;
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.sur_name
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND d.sur_name like '$number%'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.sur_name
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND a.booking_under_brand='$brand' AND d.sur_name like '$number%' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.sur_name
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id  AND a.booked_agent_id='$loginId' AND d.sur_name like '$number%'  ";
                  }
                 
            }
            else if($optionSelected=='passenger_firstname')
            {
                 $number = $searchValue;
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.firstName
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND d.firstName like '$number%'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.firstName
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND a.booking_under_brand='$brand' AND d.firstName like '$number%' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,d.firstName
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id  AND a.booked_agent_id='$loginId' AND d.firstName like '$number%'  ";
                  }
                 
            }
            else if($optionSelected=='passenger_firstname')
            {
                 $number = $searchValue;
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  b.pnr like '$number%'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND b.pnr like '$number%' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND b.pnr like '$number%'  ";
                  }
                 
            }
            else if($optionSelected=='source_search')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                if($flag==1 || $flag==2)
                  {
                    if(!empty($startDate) && !empty($endDate))
                    {
                         $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.booking_date BETWEEN '$startDate' AND '$endDate' AND c.source_of_booking like '$searchValue%'  ";
                    }
                    else
                    {
                         $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  c.source_of_booking like '$searchValue%'  ";
                    }
                      
                  }
                  else if($flag==3)
                  {
                      if(!empty($startDate) && !empty($endDate))
                       {
                          $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND a.booking_date BETWEEN '$startDate' AND '$endDate' AND c.source_of_booking like '$searchValue%' ";
                       }
                       else
                        {
                           $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND c.source_of_booking like '$searchValue%' ";
                        }
                       
                  }
                  else
                  {
                      if(!empty($startDate) && !empty($endDate))
                      {
                           $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND a.booking_date BETWEEN '$startDate' AND '$endDate' AND c.source_of_booking like '$searchValue%'  ";
                      }
                      else
                      {
                           $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND c.source_of_booking like '$searchValue%'  ";
                      }
                      
                  }
            }
            
            else if($optionSelected=='phone_search')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  AND c.mobile like '$searchValue%'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND  c.mobile like '$searchValue%' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND  c.mobile like '$searchValue%'  ";
                  }
            }
            else if($optionSelected=='supplier_ref')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  AND a.supplier_ref like '$searchValue%'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND  a.supplier_ref like '$searchValue%' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND a.supplier_ref like '$searchValue%'  ";
                  }
            }
            else if($optionSelected=='airline')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  AND b.airline like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND  b.airline like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND b.airline like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate'  ";
                  }
            }
            else if($optionSelected=='gds')
            {
                $startDate=date('Y-m-d',  strtotime($startDate));
                $endDate=date('Y-m-d',  strtotime($endDate));
                
                  if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id  AND b.gds like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate'  ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booking_under_brand='$brand' AND  b.gds like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate' ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c 
            where a.id=b.booking_id and  a.id=c.booking_id AND  a.booked_agent_id='$loginId' AND b.gds like '$searchValue%' AND b.departure_date BETWEEN '$startDate' AND '$endDate'  ";
                  }
            }
             else if($optionSelected=='eticket')
            {
                if($flag==1 || $flag==2)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c ,passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id And a.id=d.booking_id  AND d.eticket like '$searchValue%'   ";
                  }
                  else if($flag==3)
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c, passanger_details as d
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND  a.booking_under_brand='$brand' AND  d.eticket like '$searchValue%'  ";
                  }
                  else
                  {
                       $qry="select a.id,a.booked_agent_id,a.file_status,a.company,a.booking_under_brand,a.canceled_stat,a.booking_date,a.cancel_date,a.supplier_ref,a.flag,a.issue_date,b.departure_date,
            b.pnrExpiryDate,b.fareExpiryDate,c.fullname,b.pnr
            from booking_details as a ,flight_details as b,customer_contacts as c,passanger_details as d 
            where a.id=b.booking_id and  a.id=c.booking_id AND a.id=d.booking_id AND  a.booked_agent_id='$loginId' AND d.eticket like '$searchValue%'  ";
                  }
            }
        }
        $data['bookingData']=$this->BaseModel->getQuery($qry);
       // print_r($_POST);
        $data['view']='search_result_view';
        $data['page']='table';
        $data['tab']='search';
        $data['pageTitle']='Search Result';
        $this->load->view('dashboard',$data);
        
    }
    
}