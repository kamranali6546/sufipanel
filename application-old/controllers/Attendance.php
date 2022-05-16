<?php class Attendance extends MY_Controller 
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
        date_default_timezone_set('Asia/Karachi');
    }
    public function index()
    {
        $data['view']='attendance_view';
         $data['tab']='attendance';
        $flag=$this->session->userdata('flag');
        $agend=$this->session->userdata('userId');
        $month=date('m');
        $year=date('Y');
        if($flag==1)
            {
            $qry="select * from agent_attendance where checkinYear='$year' and checkinMonth='$month'";
            $agents=$this->BaseModel->getWhereM('admin',array('flag'=>5));
            }
        else
            {
                $qry="select * from agent_attendance where agent_id='$agend' and checkinYear='$year' and checkinMonth='$month' ";
                $agents=$this->BaseModel->getWhereM('admin',array('flag'=>2,'id'=>$agend));
            }
            $attendRecord= $this->BaseModel->getQuery($qry);
            //$agents=$this->BaseModel->getWhereM('admin',array('flag'=>2,'company'=>1));
            $yearC=date('Y');
            $yearlyLeavesArray=array();
            foreach($agents as $objAg)
            {
                $absentC=$this->BaseModel->count('agent_attendance',array('agent_id'=>$objAg->id,'checkinYear'=>$yearC,'attendanceStatus'=>'A'));
                $yearlyLeavesArray[]=array('idA'=>$objAg->id,'totalAbsent'=>$absentC);
//                $yearlyLeavesArray[]['idA']=$objAg->id;
//                $yearlyLeavesArray[]['totalAbsent']=$absentC; 
            }
            $data['agents']=$yearlyLeavesArray;
            $data['attendanceRecord']=$attendRecord;
            $data['filterAgents']=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>2,'company'=>1));
        $this->load->view('dashboard',$data);
    }
    public function attendanceCheckBox()
    {
        $agentID=$this->input->post('agenId');
        $month=date('m');
        $year=date('Y');
        $day=date('d');
        $dateTotal=date('Y-m-d');
        $time=date('H:i:s');
        $dayName=date('D', strtotime($dateTotal));
        $checkEntry=$this->BaseModel->getWhereM('agent_attendance',array('agent_id'=>$agentID,'checkinDay'=>$day,'checkinYear'=>$year,'checkinMonth'=>$month));
              if(!empty($checkEntry))
                  {
                    echo 0;
                  }
              else
                {
                  
                  $res=$this->BaseModel->save('agent_attendance',array('agent_id'=>$agentID,'checkinDayName'=>$dayName,'chekinTime'=>$time,'checkinDay'=>$day,'checkinMonth'=>$month,'checkinYear'=>$year,'attendanceStatus'=>'P','flag'=>1));
                  echo $res;
                }
    }
    public function checkOutTime()
    {
        $agentId=$this->input->post('agent');
        $month=date('m');
        $year=date('Y');
        $day=date('d');
        $dateTotal=date('Y-m-d');
        $time=date('H:i:s');
        $dayName=date('D', strtotime($dateTotal));
        $checkEntry=$this->BaseModel->getWhereM('agent_attendance',array('agent_id'=>$agentId,'checkinDay'=>$day,'checkinYear'=>$year,'checkinMonth'=>$month));
        if(!empty($checkEntry))
        {
              //print_r($checkEntry); 
              $obj=$checkEntry[0];
              if(!empty($obj->checkOutTime))
                  {
                    echo 0;
                  }
                  else
                  {
                    $updateRes=$this->BaseModel->update('agent_attendance',array('checkOutTime'=>$time,'checkoutDay'=>$day,'checkOutMonth'=>$month),array('id'=>$obj->id));
                    echo $updateRes;
                  }
        }
        else
        {
             //$res=$this->BaseModel->save('agent_attendance',array('agent_id'=>$agentID,'checkinDayName'=>$dayName,'chekinTime'=>$time,'checkinDay'=>$day,'checkinMonth'=>$month,'checkinYear'=>$year,'attendanceStatus'=>'P','flag'=>1));
             echo 0;
        }
    }
    public function exportAttendance()
    {
        $flag=$this->session->userdata('flag');
        $agenId=$this->session->userdata('userId');
        $date1=  explode(' ',$this->input->post('attendanceStartDate'));
        $date2=  explode(' ', $this->input->post('attendanceEndDate'));
        $start_data=  explode('-',$date1[0]);
        $end_date=explode('-',$date2[0]);
        $year_start=$start_data[0];
        $month_start=$start_data[1];
        $year_end=$end_date[0];
        $month_end=$end_date[1];
        $filename='';
        $sdate='';
        $eddd='';
        if($flag==1)
        {
            $agentList=$this->input->post('agentsList');
            if(!empty($agentList))
            {
                $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') and agent_id='$agentList' "; 
                $filename='Attendance Sheet For All Agent';
                $sdate=date('M',  strtotime($this->input->post('attendanceStartDate'))).' '.$start_data[2];
                $eddd=date('M',  strtotime($this->input->post('attendanceEndDate'))).' '.$end_date[2];
            }
            else
            {
                $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') order by agent_id desc "; 
                $filename='Attendance Sheet For All Agent';
                $sdate=date('M',  strtotime($this->input->post('attendanceStartDate'))).' '.$start_data[2];
                $eddd=date('M',  strtotime($this->input->post('attendanceEndDate'))).' '.$end_date[2];
            }
        }
        else
        {
          $qry="select * from agent_attendance where checkinYear in('$year_start','$year_end') and checkinMonth in('$month_start','$month_end') and agent_id='$agenId' "; 
          $filename=idToName('admin','id',$agenId,'login_name');
          $sdate=date('M',  strtotime($this->input->post('attendanceStartDate'))).' '.$start_data[2];
          $eddd=date('M',  strtotime($this->input->post('attendanceEndDate'))).' '.$end_date[2];
        }
       $AttendanceRecord= $this->BaseModel->qryArray($qry);
       $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Attendance Sheet');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('C1', 'Attendance Sheet');
                $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
                $this->excel->getActiveSheet()->setCellValue('B2', 'CheckIn Time');
                $this->excel->getActiveSheet()->setCellValue('C2', 'CheckOut Time');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Total Time Shift');
                $this->excel->getActiveSheet()->setCellValue('E2', 'Status');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Agent');
                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);            
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);            
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('C1:D1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);  
                for($col = ord('A'); $col <= ord('F'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
       if($AttendanceRecord->num_rows() >0)
       {
           $ser=3;
       foreach ($AttendanceRecord->result_array() as $row)
           {
           $timeDate1=$row['checkinYear'].'-'.$row['checkinMonth'].'-'.$row['checkinDay'].' '.$row['chekinTime'];
           $timeDate2='';
           if(!empty($row['checkOutTime']))
               {
                $timeDate2=$row['checkinYear'].'-'.$row['checkinMonth'].'-'.$row['checkinDay'].' '.$row['checkOutTime'];
               }
            $exceldata[]=$row['checkinYear'].'-'.$row['checkinDay'].'-'.$row['checkinMonth'];
            $exceldata[]=$row['chekinTime'];
            $exceldata[]=$row['checkOutTime'];
            $exceldata[]=timeDifferenceCalculate($timeDate1,$timeDate2);
            $exceldata[]=$row['attendanceStatus'];
            $exceldata[]=idToName('admin','id',$row['agent_id'],'login_name');
            if($row['attendanceStatus']=='Sun')
            {
              $this->excel->getActiveSheet()->setCellValue('A'.$ser, $row['checkinYear'].'-'.$row['checkinDay'].'-'.$row['checkinMonth']);
              $this->excel->getActiveSheet()->setCellValue('B'.$ser,$row['attendanceStatus']);
              $this->excel->getActiveSheet()->setCellValue('C'.$ser,$row['attendanceStatus']);
              $this->excel->getActiveSheet()->setCellValue('D'.$ser,$row['attendanceStatus']);
              $this->excel->getActiveSheet()->setCellValue('E'.$ser,$row['attendanceStatus']);
              $this->excel->getActiveSheet()->setCellValue('F'.$ser,idToName('admin','id',$row['agent_id'],'login_name'));  
            }
            else
            {
              $this->excel->getActiveSheet()->setCellValue('A'.$ser, $row['checkinYear'].'-'.$row['checkinDay'].'-'.$row['checkinMonth']);
              $this->excel->getActiveSheet()->setCellValue('B'.$ser,$row['chekinTime']);
              $this->excel->getActiveSheet()->setCellValue('C'.$ser,$row['checkOutTime']);
              $this->excel->getActiveSheet()->setCellValue('D'.$ser,timeDifferenceCalculate($timeDate1,$timeDate2));
              $this->excel->getActiveSheet()->setCellValue('E'.$ser,$row['attendanceStatus']);
              $this->excel->getActiveSheet()->setCellValue('F'.$ser,idToName('admin','id',$row['agent_id'],'login_name'));  
            }
            
            $ser++;
           }
       
       }
       else
           {
                $this->excel->getActiveSheet()->mergeCells('A3:D3');
                 $this->excel->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $exceldata[]='There is No Data';
                $this->excel->getActiveSheet()->fromArray($exceldata);
           }
       
       //$this->excel->getActiveSheet()->fromArray($exceldata);
//                $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                 
                $filename='Sheet'.$sdate.'To'.$eddd.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output'); 
        
    }
    
}