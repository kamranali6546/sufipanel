<?php class Corn extends CI_Controller 
{
/*
 * @author SHAHID Aslam
 */
 public function __construct()
    {
    parent::__construct();
        $this->load->model('BaseModel');
        $this->load->helper('common_helper','common');
         date_default_timezone_set('Europe/London');
    }
    public function index()
    {
       $ary="select * from admin where flag='2' and agent_status='1' and company='1' ";
       $agentResults= $this->BaseModel->getQuery($ary);
       $month=date('m');
       $year=date('Y');
       $day=date('d');
       $dateTotal=date('Y-m-d');
       $time=date('H:i:s');
       $dayName=date('D', strtotime($dateTotal));
      if($dayName!='Sun')
       {
          foreach($agentResults as $agentObj)
           {
              $checkEntry=$this->BaseModel->getWhereM('agent_attendance',array('agent_id'=>$agentObj->id,'checkinDay'=>$day,'checkinYear'=>$year,'checkinMonth'=>$month));
              if(!empty($checkEntry))
                  {
                    
                  }
              else
                {
                  $this->BaseModel->save('agent_attendance',array('agent_id'=>$agentObj->id,'checkinDayName'=>$dayName,'chekinTime'=>$time,'checkinDay'=>$day,'checkinMonth'=>$month,'checkinYear'=>$year,'attendanceStatus'=>'A','flag'=>1));
                }
                  
           }
       }
       else if($dayName=='Sun')
        {
            foreach($agentResults as $agentObj)
           {
              $this->BaseModel->save('agent_attendance',array('agent_id'=>$agentObj->id,'checkinDayName'=>$dayName,'checkinDay'=>$day,'checkinMonth'=>$month,'checkinYear'=>$year,'attendanceStatus'=>$dayName,'flag'=>1));
                  
           }
        }
    }
    
    
}