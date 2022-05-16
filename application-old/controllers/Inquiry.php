<?php class Inquiry extends MY_Controller 
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
    }
    public function index()
    {
        $data['view']='new_inquiry_view';
        $data['page']='table';
        $condition=array(
            'status'=>'1'
        );
        $data['records']=$this->BaseModel->getWhereM('inquiry',$condition);
        $this->load->view('dashboard',$data);
    }
    public function picked()
    {
        $data['view']='picked_view';
        $date=date('Y-m-d');
        //$orderby="id desc";
        $group_by="picke_date";
        $companyFliter      =  $this->input->post('companyFliter');
        $agentFliter        =  $this->input->post('agentFliter');
        $inquiryIdFliter    =  $this->input->post('inquiry');
        if(!empty($companyFliter) || !empty ($agentFliter) || !empty ($companyFliter))
        {
            $condition=" status='2' ";
            if(!empty($agentFliter))
            {
                $condition.=" AND  picked_by='$agentFliter'   ";
            }
            if(!empty($inquiryIdFliter))
            {
                 $condition.="  AND  id='$inquiryIdFliter'    ";
            }
            if(!empty($companyFliter))
            {
                $comFlitr=rtrim($companyFliter,'s');
                 $condition.=" AND  brand like '$comFlitr%' ";
            }
            $getQuery=" Select * from inquiry where ".$condition." group by picke_date order by id Desc ";
            $record=$this->BaseModel->getQuery($getQuery);
        }
//        else if(!empty ($agentFliter) && !empty ($companyFliter))
//        {
//            
//        }
//        else if(!empty ($companyFliter) && !empty ($inquiryIdFliter))
//        {
//            
//        }
//        else if(!empty ($companyFliter) && !empty ($inquiryIdFliter) && !empty ($agentFliter))
//        {
//            
//        }
        else
        {
            $record=$this->BaseModel->getWhereMOrder('inquiry',array('status'=>2),'id','desc',$group_by);
        }
        $agentDropdown=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'last_logout'=>NULL));
        $bradList=$this->BaseModel->getWhereM('company',array('status'=>1));
        $output="";
        if(!empty($record))
         {
            //print_r($record);
            foreach($record as $obj)
             {
                $totasl=0;
                $picked_count=0;
               $pick_ttt=$obj->picke_date;
                $edate=date('d-M-Y',strtotime($obj->enquiry_date)); 
                
                if(!empty($agentFliter))
                {
                   $agentts=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'last_logout'=>NULL,'id'=>$agentFliter)); 
                }
                else
                {
                   $agentts=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'last_logout'=>NULL));
                }
                $totasl=$this->BaseModel->count('inquiry',array('picke_date'=>$pick_ttt,'status'=>2));
             //$res2=$mysqli->query($qry2);
                $output.='<div class="panel panel-info" style="margin-bottom: 2px">
		<div class="panel-heading">
                    <h3 class="panel-title">'.$pick_ttt.'<span style="margin-right: 4%;float:right;">Tot Receive Inquiry='.$totasl.'</span></h3>                   
			<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down main"></i></span>
		</div>';
                if($pick_ttt==$date)
                   { 
                    $output.='<div class="panel-body">
                <span class=""></span>
                <table class="table-striped" width="100%">
                    <tr>
                        <th style="text-align:center;font-weight:bold;">Agent</th>
                        <th style="text-align:center;font-weight:bold;">Total Picked</th>
                        <th style="text-align:center;font-weight:bold;">Picked Inquiries</th>
                    </tr>
                    <tr>';
               
              foreach($agentts as $agent_obj)
                   {
                    $id=$agent_obj->id; 
                    $count=0;
                    $remaing=0;
                    
                    $dailyRecord=$this->BaseModel->getWhereM('inquiry',array('status'=>2,'picked_by'=>$id,'picke_date'=>$pick_ttt));
                   $count=$this->BaseModel->count('inquiry',array('picke_date'=>$pick_ttt,'picked_by'=>$id,'status'=>2));
//                    $qry3=" select  * from inquiry where status='2' and picked_by='$id' and picke_date ='$pick_ttt' ";
//                   $res3=$mysqli->query($qry3);
                   if($count>0){
                    $output.='<td style="font-weight:bold;text-align:center;">'.$agent_obj->full_name.'</td>';
                   $picked_count=$picked_count + $count;
                        $output.='<td style="text-align:center;font-weight:bold;">'.$count.'</td>
                        <td style="text-align:center;color:#0080ff;font-weight:bold;">';
                       $i=1;
                   foreach($dailyRecord as $dailyObj)
                   {
                       $id=$dailyObj->id;
                        if($this->session->userdata('userId')==$agent_obj->id || $this->session->userdata('flag')=='1')
                        {
                       if($i=='1')
                            {
                                $output.='<a target="_blank" href="'.base_url('pickedDetils/'.idencode($id)).'" style="color:#0080ff;">'.$id.'</a>';
                            }
                            else
                                {
                                $output.=',';
                                 $output.='<a target="_blank" href="'.base_url('pickedDetils/'.idencode($id)).'" style="color:#0080ff;">'.$id.'</a>';
                                }
                        }
                        else
                            {
                             if($i=='1')
							{
                                $output.=$id;
                            }
                            else
                                {
                                 $output.=',';
                                 $output.=$id;
                                }
                            }
                                $i++;
                   }
                       $output.='</td></tr>';   
                   } }
               $remaing=$totasl- $picked_count;
                   $output.='<tr>
                        <td colspan="3" style="border-bottom:  1px solid;"></td> 
                    </tr>
                    <tr style="border-top: thin dashed #333;">
                        <td></td>
                        <td style="text-align:center;font-weight:bold;">'.$picked_count.'</td>
                        <td style="text-align:center;font-weight:bold;">Total Pending ='.$remaing.'</td>
                    </tr>   
                </table>
            </div>';
                   }
                   else 
                    { 
 $output.='<div class="panel-body" style="display:none;">
                <span class=""></span>
                <table class="table-striped" width="100%">
                    <tr>
                        <th style="text-align:center;font-weight:bold;">Agent</th>
                        <th style="text-align:center;font-weight:bold;">Total Picked</th>
                        <th style="text-align:center;font-weight:bold;">Picked Inquiries</th>
                    </tr>
                    <tr>';
               $picked_count=0;
               foreach($agentts as $agent_obj2)
                   {
                   $id=$agent_obj2->id;
                    $dailyRecord=$this->BaseModel->getWhereM('inquiry',array('status'=>2,'picked_by'=>$id,'picke_date'=>$pick_ttt));
                   $count=$this->BaseModel->count('inquiry',array('picke_date'=>$pick_ttt,'status'=>2,'picked_by'=>$id));
                   if($count>0){
                   $output.='<td>'.$agent_obj2->full_name.'</td>';
                   $id=$agent_obj2->id;
                   $picked_count=$picked_count+$count;
                        $output.='<td style="text-align:center;font-weight:bold;">'.$count.'</td><td>';
                       $i=1;
                   foreach($dailyRecord as $dailyObj2)
                   {
                       $id=$dailyObj2->id;
                        if($this->session->userdata('userId')==$agent_obj2->id || $this->session->userdata('flag')=='1')
                        {
                       if($i=='1')
                           {
                               $output.='<a target="_blank" href="'.base_url('pickedDetils/'.idencode($dailyObj2->id)).'" style="color:#0080ff;">'.$dailyObj2->id.'</a>';
                           }
                            else
                                {
                                $output.=',';
                                 $output.='<a target="_blank" href="'.base_url('pickedDetils/'.idencode($dailyObj2->id)).'" style="color:#0080ff;">'.$dailyObj2->id.'</a>';
                                }
                        }
                        else
                            {
                             if($i=='1')
                           {
                                $output.=$dailyObj2->id;
                            }
                            else
                                {
                                $output.=',';
                                 $output.=$dailyObj2->id;
                                }
                            }
                                $i++;
                   }
                        $output.='</td></tr>'; 
                   }
                   }
               $remaing=$totasl - $picked_count;
                    $output.='<tr>
                        <td colspan="3" style="border-bottom:  1px solid;"></td> 
                    </tr>
                    <tr style="border-top: thin dashed #333;">
                        <td></td>
                        <td style="text-align:center;font-weight:bold;">'.$picked_count.'</td>
                        <td style="text-align:center;font-weight:bold;">Total Pending ='.$remaing.'</td>
                    </tr>   
                </table>
            </div>'; 
} 
	$output.='</div><br>';
             }
         }
         $data['output']=$output;
         $data['agentDropDown']=$agentDropdown;
         $data['companyList']=$bradList;
         $data['companyFliterApply']=$companyFliter;
         $data['agentFliterApply']=$agentFliter;
         $data['inquiryFliterApply']=$inquiryIdFliter;
        $this->load->view('dashboard',$data);
    }
    public function receicval_summary()
    {
        $data['view']='receival_inquiry_view';
        $startDate  =   $this->input->post('startDate');
        $endDate    =   $this->input->post('endDate');
        $dest       =   $this->input->post('dest');
        $date_start =   date('Y-m-d');
        $date_end   =   date('Y-m-d');
        $qry='';
        if(!empty($startDate) && !empty($endDate))
        {
           $qry=" Select id,enquiry_date,enqdate,reveicved_from,device,os,brand_code,destination,inquiry_regin from inquiry where enqdate BETWEEN '$startDate' AND '$endDate' "; 
        }
        else if(!empty ($dest))
        {
           $qry=" Select id,enquiry_date,enqdate,reveicved_from,device,os,brand_code,destination,inquiry_regin from inquiry where destination like '$dest%' "; 
        }
        else if(!empty($startDate) && !empty($endDate) && !empty ($dest))
        {
           $spredFliter= explode('-', $dest);
           $condition='';
           if(!empty($spredFliter[0]))
           {
               $condition.=" AND destination like '$spredFliter[0]%'";
           }
           if(!empty($spredFliter[1]))
           {
                $condition.=" Or destination like '$spredFliter[1]%'";
           }
            $qry=" Select id,enquiry_date,enqdate,reveicved_from,device,os,brand_code,destination,inquiry_regin from inquiry where enqdate BETWEEN '$startDate' AND '$endDate' $condition ";
        }
        else
        {
             $date_start =   date('Y-m-d');
             $date_end   =   date('Y-m-d');
             $startDate=$date_start;
             $endDate=$date_end;
             $qry=" Select id,enquiry_date,enqdate,reveicved_from,device,os,brand_code,destination,inquiry_regin from inquiry where enqdate BETWEEN '$startDate' AND '$endDate' "; 
        }
        $inquiryData=$this->BaseModel->getQuery($qry);
        $total_inquiry=count($inquiryData);
        foreach($inquiryData as $key => $obj)
        {
            $reqin=originInquiry($obj->inquiry_regin);
            $receivedFrom=$obj->device;
            $des=  explode('-',$obj->destination);
            if($key==0)
            {  
              $finalArray=array();
              $finalArray['orgin'][$reqin]=array();
              $finalArray['orgin'][$reqin]['distination'][$des]=1;
              $finalArray['orgin'][$reqin]['devices'][$receivedFrom]=1;
            }
            if(array_key_exists($reqin, $finalArray['orgin']))
            {
                if(array_key_exists($des[0], $finalArray['orgin'][$reqin]['distination']))
                {
                    $finalArray['orgin'][$reqin]['distination'][$des[0]]=$finalArray['orgin'][$reqin]['distination'][$des[0]]+1;
                }
                else
                {
                    $finalArray['orgin'][$reqin]['distination'][$des[0]]=1;
                }
                 if(!empty($receivedFrom))
                    {
                        if(array_key_exists($receivedFrom, $finalArray['orgin'][$reqin]['devices']))
                        {
                           $finalArray['orgin'][$reqin]['devices'][$receivedFrom]=$finalArray['orgin'][$reqin]['devices'][$receivedFrom]+1;
                        }
                        else
                        {
                           $finalArray['orgin'][$reqin]['devices'][$receivedFrom]=1;
                        }
                    }
            }
            else
            {
                if(array_key_exists($des[0], $finalArray['orgin'][$reqin]['distination']))
                {
                    $finalArray['orgin'][$reqin]['distination'][$des[0]]=$finalArray['orgin'][$reqin]['distination'][$des[0]]+1;
                }
                else
                {
                    $finalArray['orgin'][$reqin]['distination'][$des[0]]=1;
                }
                if(!empty($receivedFrom))
                    {
                        if(array_key_exists($receivedFrom, $finalArray['orgin'][$reqin]['devices']))
                        {
                           $finalArray['orgin'][$reqin]['devices'][$receivedFrom]=$finalArray['orgin'][$reqin]['devices'][$receivedFrom]+1;
                        }
                        else
                        {
                           $finalArray['orgin'][$reqin]['devices'][$receivedFrom]=1;
                        }
                    }
            }
            
        }
        $html='';
        if(!empty($finalArray))
        {
            $html.='<div class="row">';
            $html.=' <div class="col-md-12">';
            $html.=' <div style="margin:22px 0px 30px 0px;">';
            $html.=' <ul class="nav nav-tabs" style="background-color: #fff;border:1px solid #ccc;">';
            $tabDiv='';
            $first=0;
            $activeClass='';
            foreach($finalArray['orgin'] as $key2 => $obj2)
            {
                
                if($first==0)
                {
                    $activeClass=" in active";
                    $tabDiv.='<div class="tab-content">';
                }
                else
                {
                    $activeClass=" "; 
                }
                $totalTab=0;
                $bydsestination='<li><b>By Destination</b></li>';
                $bydevices='<li><b>By Device</b></li>';
                $frontTab='';
                $frntContent='';
               foreach($obj2['distination'] as $tot => $totaoObj)
               {
                   $totalTab=$totalTab+$totaoObj;
                   $bydsestination.='<li>'.$tot.' : <b>'.$totaoObj.'</b></li>';
               }
               foreach($obj2['devices'] as $tot2 => $totaoObj2)
               {
                   
                   $bydevices.='<li>'.$tot2.' : <b>'.$totaoObj2.'</b></li>';
               }
                $html.='<li class="'.$activeClass.'"><a data-toggle="tab" href="#'.$key2.'">'.$key2.':<b>'.$totalTab.'</b></a></li>';
                $tabDiv.='<div id="'.$key2.'" class="tab-pane fade '.$activeClass.'">';
                $tabDiv.='<br><ul class="tabsul">
                    '.$bydevices.'
                </ul>';
                $tabDiv.='<ul class="tabsul">
                    '.$bydsestination.'
                </ul>';
                $tabDiv.='</div>';
                $first=$first+1;
            }
            $tabDiv.='</div>';
            $html.=$tabDiv;
            $html.='</ul>';
            $html.='</div>';
            $html.=' </div>';
            $html.=' </div>'; 
        }
        $data['output']=$html;
        $data['dataOutput']=$finalArray['orgin'];
        $data['totalInquiry']=$total_inquiry;
        $data['frontTab']=$frontTab;
        $data['frntContent']=$frntContent;
        $data['fliterEnd']=$endDate;
        $data['fliterStart']=$startDate;
        $data['fliterDest']=$dest;
        $this->load->view('dashboard',$data);
    }
    public function pickedDetails()
    {
        $data['view']='picked_details_view';
        $ids=  $this->uri->segment(2);  
        $id=iddecode($ids);
        $data['pageTitle']='Picked Inguiry-'.$id;
        $data['record']=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
        $data['commentData']=$this->BaseModel->getWhereM('agent_comments',array('inquiry_id'=>$id));
        $this->load->view('dashboard',$data);
    }
    public function getCommentModel()
    {
        $id=  $this->input->post('inquiryId');
        $record=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
        $commentData=$this->BaseModel->getWhereM('agent_comments',array('inquiry_id'=>$id));
        if(!empty($record)){ $obj=$record[0]; }
        $commments='';
        if(!empty($commentData))
        {
                foreach($commentData as $comObj)
                {
                    $dateArray=  explode(' ', $comObj->remarks_time);
                    $dateTimeLog=date('d-M-y',  strtotime($dateArray[0])).'  '.date('h:m:i A',  strtotime($dateArray[1]));
                    $flagOfAgenComs=idToName('admin','id',$comObj->agent_id,'flag'); $classAdd=''; if($flagOfAgenComs==1 || $flagOfAgenComs==2){ $classAdd='adminClass'; } else{ $classAdd='agentClass'; }   
                $commments.="<label style='margin-left:1%;'><b class='".$classAdd."'>(". idToName('admin','id',$comObj->agent_id,'login_name') .")&nbsp;</b> <b> (".$dateTimeLog.") </b> ".$comObj->remakts."</label><br>";
                        
                }
        } 
        // $te='<button type="button" class="btn btn-danger btn-round" onclick="inquiryDelete('. $obj->id.')">Delete</button>
		//		<button type="button" class="btn btn-primary btn-round" onclick="inquiryAssignModal('.$obj->id.')" title="Assign To" data-toggle="tooltip">Assign To</button>';
         $footerContent='';
        if($this->session->userdata('flag')==1 ||$this->session->userdata('flag')==2)
        {
            $footerContent=' <div class="modal-footer">   
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>  ';
        }
        else
        {
           $footerContent=' <div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> </div>' ;
        }
        $ricevrIneD=  explode(' ', $obj->enquiry_date);
        $pickedInqD=  explode(' ', $obj->picked_time);
        $dateTimeInquiryReceived=date('d-M-y',  strtotime($ricevrIneD[0])).'  '.date('h:m:i A',  strtotime($ricevrIneD[1]));
        $dateTimeInquiryPicked=date('d-M-y',  strtotime($pickedInqD[0])).'  '.date('h:m:i A',  strtotime($pickedInqD[1]));
        $modalHtml=' <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Picked Inquiry Detail</h4>
			</div>
                        <div class="modal-body">
                            <div class="row colorr">
					<div class="col-md-12">
						<div class="">
                                                    <u><b>Customer Inquiry Details</b></u>
                                                    <table id="bsc"  class="table" width="100%">
                                                    <tr>
                                                        <th>Inquiry ID:</th>
                                                        <td>'.$obj->id.'</td>
                                                        <th>Time Received:</th>
                                                        <td>'.date('d-M-y h:m:i A',strtotime($obj->enquiry_date)).'</td>
                                                    </tr>
                                                        <tr>
                                                            <th>Picked BY:&nbsp;</th>
                                                            <td id="agnt">&nbsp;'.idToName('admin','id',$obj->picked_by,'login_name').'</td>
                                                            <th>Time Pick :&nbsp;</th>
                                                            <td>&nbsp;'.date('d-M-y h:m:i A',strtotime($obj->picked_time)).'</td>
                                                        </tr>
                                                    </table>
                                                    <br>
                                                    <div class="row">
                                                        <form method="post">  
                                                            <div class="col-md-8">
                                                                    <textarea style="margin-left: 1%;" rows="1" name="comments" required="" id="msgComment" class="form-control" placeholder="Comments"></textarea>
                                                                    <input type="hidden" id="inquiryIDFlowwUp" name="in_id" value="'.$obj->id.'" >
                                                            </div>
                                                            <div class="col-md-2 offset-2">
                                                                    <button style="margin-left: 7px;margin-top:5px;" type="button"  name="save" id="saveAgetComment" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="row">
                                                        <div id="commentsDiv" class="col-md-8 offset-4" style="margin-left:1%;">
                                                        '.$commments.'
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 style=""><u><b>Inquiry Detail</b></u></h5>
						<br>
						Flight Search <small>('.$obj->reveicved_from.')</small>
						<table class="table" width="100%">
                                                    <tr style="background: #ffeb3b75;">
                                                        <td colspan="4"><u><b>Flight Detail</b></u></td>
                                                    </tr>
                                                    <tr>
                                                            <td><b>Departure Airport</b></td>
                                                            <td>'.$obj->flight_from.'</td>
                                                            <td><b>Destination</b></td>
                                                            <td>'.$obj->destination.'</td> 
                                                    </tr>
                                                    <tr>
                                                        <td><b>Departure Date</b></td>
                                                        <td>'. $obj->departure_date.'</td>
                                                        <td><b>Return Date</b></td>
                                                        <td>'. $obj->return_date.'</td>
                                                    </tr>
                                                    <tr style="background: #ffeb3b75;">
                                                        <td colspan="4"><u><b>Contact Detail</b></u></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Name</b></td>
                                                        <td>'.$obj->name.'</td>
                                                        <td><b>Email</b></td>
                                                        <td>'.$obj->customer_email.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Phone #</b></td>
                                                        <td>'.$obj->customer_phone.'</td>
                                                        <td><b>Customer Instruction</b></td>
                                                        <td>'.$obj->customer_instr.'</td>
                                                    </tr>
                                                    <tr style="background: #ffeb3b75;">
                                                        <td colspan="4"><u><b>Preference</b></u></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Prefered Airline</b></td>
                                                        <td>'. $obj->prefered_airline.'</td>
                                                        <td><b>Ticket Type</b></td>
                                                        <td>'.$obj->ticket_type.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Ticket Class</b></td>
                                                        <td>'.$obj->ticket_class.'</td>
                                                        <td><b>Fare</b></td>
                                                        <td>'.$obj->fare.'</td>
                                                    </tr>
                                                    <tr style="background: #ffeb3b75;">
                                                        <td colspan="4"><u><b>Passenger Detail</b></u></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Adult</b></td>
                                                        <td>'.$obj->adult.'</td>
                                                        <td><b>Child</b></td>
                                                        <td>'.$obj->child.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Infant</b>&nbsp;</td>
                                                        <td>'.$obj->infaunt.'</td>
                                                        <td><b>Inquiry Status</b></td>
                                                        <td>'. $obj->status.'</td>
                                                    </tr>
						</table><br>
					</div> 
				</div>
			</div>                            
                        </div>
                        '.$footerContent.'';
       echo $modalHtml;   
    }

    public function flowupEditView()
    {
        $data['view']='flowup_edit_view';
        $ids=$this->uri->segment(2);  
        $id=iddecode($ids);
        $data['id']=$ids;
        $data['record']=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
        $commentQry=" SELECT * FROM `agent_comments` where agent_id='".$this->session->userdata('userId')."' and inquiry_id='$id' order by id desc limit 1 ";
        $data['lastComment']=  $this->BaseModel->getQuery($commentQry);
        $this->load->view('dashboard',$data);
    }
    public function flowupUpdate()
    {
        $this->form_validation->set_rules('depart_form','Departure From','required');
        $this->form_validation->set_rules('return_date','Return Date','required');
        $this->form_validation->set_rules('destination','Destination','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('departt_date','Departure Date','required');
        $this->form_validation->set_rules('cost_price','Cost Price','numeric');
        $this->form_validation->set_rules('sale_price','Sale Price','numeric');
        $this->form_validation->set_rules('contact_number','Contact Number','numeric|max_length[11]');
        $this->form_validation->set_rules('adult','Adult','numeric');
        $this->form_validation->set_rules('child','Child','numeric');
        $this->form_validation->set_rules('infant','Infant','numeric');
        $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
        $idsss=$this->input->post('id');
        $comentId=$this->input->post('commentId');
        $id=iddecode($idsss);
         if($this->form_validation->run()==false)
        {
            $data['view']='flowup_edit_view';
            $id=iddecode($idsss);
            $data['id']=$idsss;
            $data['record']=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
            $this->load->view('dashboard',$data);
        }
       else
       {
          $created_date=date('d-m-Y H:i:s');
          $picked_date=date('d-M-Y');
           $departed_form=$this->input->post('depart_form');
           $destination=$this->input->post('destination');
           $departed_date=date('Y-m-d',strtotime($this->input->post('departt_date')));
           $return_date=date('Y-m-d',strtotime($this->input->post('return_date')));
           $customer_mail=$this->input->post('email');
           $phone=$this->input->post('contact_number');
           $phone2=$this->input->post('contact_number2');
           $customer_name=$this->input->post('customer_name');
           $sale_price=$this->input->post('sale_price');
           $cost_price=$this->input->post('cost_price');
           $airline=$this->input->post('airline');
           $pnr=$this->input->post('pnr');
           $comments=$this->input->post('comments');
           $adult=$this->input->post('adult');
           $child=$this->input->post('child');
           $infant=$this->input->post('infant');
           $passanger=$this->input->post('passanger');
           $edate=date('Y-m-d');
          $dataArray=array(
             'flight_from'=>$departed_form,
             'destination'=>$destination,
             'departure_date'=>$departed_date,
             'return_date'=>$return_date,
              'customer_email'=>$customer_mail,
              'customer_phone'=>$phone.','.$phone2,
              'adult'=>$adult,
              'child'=>$child,
              'infaunt'=>$infant,
              'prefered_airline'=>$airline,
              'name'=>$customer_name,
              'cost_price'=>$cost_price,
              'sale_price'=>$sale_price,
              'pnr'=>$pnr,
              'number_of_passanger'=>$adult+$child+$infant,
              'ticket_type'=>  $this->input->post('ticket_type'),
              'ticket_class'=> $this->input->post('ticket_class')
//              'customer_instr'=>$comments
          );
          $res=$this->BaseModel->update('inquiry',$dataArray,array('id'=>$id));
          if(!empty($comentId) && $comentId >0)
           {
              $res2=$this->BaseModel->update('agent_comments',array('agent_id'=>$this->session->userdata('userId'),'remakts'=>$comments,'remarks_time'=>date('Y-m-d h:m:i'),'inquiry_id'=>$id),array('id'=>$comentId));
           }
           else
            {
               $res2=$this->BaseModel->save('agent_comments',array('agent_id'=>$this->session->userdata('userId'),'remakts'=>$comments,'remarks_time'=>date('Y-m-d h:m:i'),'inquiry_id'=>$id));
            }
          
          if($res >0 || $res2 >0)
           {
              redirect(site_url('Inquiry/followup'));
           }
           else
            {
               $data['view']='flowup_edit_view';
               $data['errormessage']="Data Not Saved Network error Please Try  Again";
                $id=iddecode($idsss);
                $data['id']=$idsss;
                $data['record']=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
                $this->load->view('dashboard',$data);
              
            }
       }
    }
    public function followup()
    {
        $data['view']='followup_view';
        $userId=$this->session->userdata('userId');
        $flag=$this->session->userdata('flag');
        $startDate=$this->input->post('startDate');
        $endDate=$this->input->post('endDate');
        $agentId=$this->input->post('agentId');
        $data['page']='table';
        $this->load->library('pagination');
         if($flag==1)
            {
                if(!empty($startDate) && !empty($endDate) && !empty($agentId) && $agentId >0)
                {
                    $resulCout=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$agentId.' AND  inquiry.enqdate BETWEEN "'.$startDate.'" AND  "'.$endDate .'"  order by iid desc ');
                    $total_row=count($resulCout);
                    $config = array();
                    $config["base_url"] = base_url()."inquiry/followup/";
                    $config["total_rows"] = $total_row;
                    $config["per_page"] = 200;
                    $config['use_page_numbers'] = TRUE;
                    $config['num_links'] = $total_row;
                    $config['cur_tag_open'] = '&nbsp;<a class="current">';
                    $config['cur_tag_close'] = '</a>';
                    $config['next_link'] = 'Next';
                    $config['prev_link'] = 'Previous';
                    $this->pagination->initialize($config);
                    if($this->uri->segment(3))
                    {
                        $page=(($this->uri->segment(3)-1)*$config["per_page"]);
                    }
                    else
                    {
                        $page=0;
                    }
                    //$page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1*$config["per_page"] : 0;
                    $data['result']=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.reveicved_from,inquiry.device,inquiry.os,inquiry.brand_code,inquiry.inquiry_regin,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$agentId.' AND  inquiry.enqdate BETWEEN "'.$startDate.'" AND  "'.$endDate .'"  order by iid desc  limit '.$config['per_page'].'  offset '.$page);
                }
                else
                {
                    $resulCout=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id  order by iid desc ');
                    $total_row=count($resulCout);
                    $config = array();
                    $config["base_url"] = base_url()."inquiry/followup/";
                    $config["total_rows"] = $total_row;
                    $config["per_page"] = 200;
                    $config['use_page_numbers'] = TRUE;
                    $config['num_links'] = $total_row;
                    $config['cur_tag_open'] = '&nbsp;<a class="current">';
                    $config['cur_tag_close'] = '</a>';
                    $config['next_link'] = 'Next';
                    $config['prev_link'] = 'Previous';
                    $this->pagination->initialize($config);
                    if($this->uri->segment(3))
                    {
                        $page=(($this->uri->segment(3)-1)*$config["per_page"]);
                    }
                    else
                    {
                        $page=0;
                    }
                    //$page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1*$config["per_page"] : 0;
                    $data['result']=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.reveicved_from,inquiry.device,inquiry.os,inquiry.brand_code,inquiry.inquiry_regin,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id order by iid desc limit '.$config['per_page'].'  offset '.$page);
                }
            }
        else
            {
             if(!empty($startDate) && !empty($endDate) && !empty($agentId) && $agentId >0)
                {
                    $resulCout=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$agentId.' AND  inquiry.enqdate BETWEEN "'.$startDate.'" AND  "'.$endDate .'"  order by iid desc');
                    $total_row=count($resulCout);
                    $config = array();
                    $config["base_url"] = base_url()."inquiry/followup/";
                    $config["total_rows"] = $total_row;
                    $config["per_page"] = 100;
                    $config['use_page_numbers'] = TRUE;
                    $config['num_links'] = $total_row;
                    $config['cur_tag_open'] = '&nbsp;<a class="current">';
                    $config['cur_tag_close'] = '</a>';
                    $config['next_link'] = 'Next';
                    $config['prev_link'] = 'Previous';
                    $this->pagination->initialize($config);
                    if($this->uri->segment(3))
                    {
                        $page=(($this->uri->segment(3)-1)*$config["per_page"]);
                    }
                    else
                    {
                        $page=0;
                    }
                   // $page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1*$config["per_page"] : 0;
                    $data['result']=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.reveicved_from,inquiry.device,inquiry.os,inquiry.brand_code,inquiry.inquiry_regin,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$agentId.' AND  inquiry.enqdate BETWEEN "'.$startDate.'" AND  "'.$endDate .'"  order by iid desc limit '.$config['per_page'].'  offset '.$page);
                } 
                else
                {
                    $resulCout=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$userId.' order by iid desc ');
                    $total_row=count($resulCout);
                    $config = array();
                    $config["base_url"] = base_url()."inquiry/followup/";
                    $config["total_rows"] = $total_row;
                    $config["per_page"] = 100;
                    $config['use_page_numbers'] = TRUE;
                    $config['num_links'] = $total_row;
                    $config['cur_tag_open'] = '&nbsp;<a class="current">';
                    $config['cur_tag_close'] = '</a>';
                    $config['next_link'] = 'Next';
                    $config['prev_link'] = 'Previous';
                    $this->pagination->initialize($config);
                    if($this->uri->segment(3))
                    {
                        $page=(($this->uri->segment(3)-1)*$config["per_page"]);
                    }
                    else
                    {
                        $page=0;
                    }
                   // $page = ($this->uri->segment(3)) ? $this->uri->segment(3)-1*$config["per_page"] : 0;
                   $data['result']=$this->BaseModel->getQuery('select inquiry.id as iid,inquiry.picked_by,inquiry.reveicved_from,inquiry.device,inquiry.os,inquiry.brand_code,inquiry.inquiry_regin,inquiry.picke_date,inquiry.picked_time,inquiry.flight_from,inquiry.departure_date,inquiry.return_date,inquiry.name,inquiry.prefered_airline,inquiry.ticket_type,inquiry.ticket_class,inquiry.fare,inquiry.adult,inquiry.child,inquiry.infaunt,inquiry.status,inquiry.enquiry_date,inquiry.customer_email,inquiry.destination,inquiry.customer_instr,inquiry.customer_phone,admin.id as aid,admin.login_name from inquiry LEFT JOIN admin  ON  inquiry.picked_by=admin.id where inquiry.picked_by='.$userId.' order by iid desc limit '.$config['per_page'].'  offset '.$page); 
                }
            }
       $result=$this->BaseModel->getWhereM('admin',array('agent_status'=>1,'flag'=>5));
        //$data['result']=$this->BaseModel->gettingJoin('inquiry','admin','left','inquiry.picked_by','admin.id');
       $data['agents']=$result;
         $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
       $data['fliterAgent']=$agentId;
        $this->load->view('dashboard',$data);
    }
    public function closed()
    {
        $data['view']='close_inquiry_view';
        $data['page']='table';
        // close status 3
         $condition=array(
            'status'=>'3'
        );
        $data['records']=$this->BaseModel->getWhereM('inquiry',$condition);
        $this->load->view('dashboard',$data);
    }
    public function emailBackup()
    {
        $data['view']='email_backup_view';
        $this->load->view('dashboard',$data);
    }
    public function converstion()
    {
      $data['view']='booking_converstion';
      $start_date1 =$this->input->post('startDate');
      $end_date1   =  $this->input->post('endDate');
      if(!empty($start_date1) && !empty($end_date1))
       {
          $start_date=$start_date1;
          $end_date=$end_date1;
       }
       else
       {
          $start_date=date('Y-m-01');
          $end_date=date('Y-m-d');
       }
     // if(isset($_POST['checkNow']))
     // {
//          $start_date =$this->input->post('startDate');
//          $end_date   =  $this->input->post('endDate');
          $data['startfliter']=$start_date;
          $data['endfliter']=$end_date;
                  
          $inq_date_st=date('Y-m-d',  strtotime($start_date));
          $inq_date_en=date('Y-m-d',  strtotime($end_date));
          $inq_date_st1=date('Y-m-d',  strtotime($start_date));
          $inq_date_en1=date('Y-m-d',  strtotime($end_date));
           $condition=" picke_date BETWEEN '$inq_date_st'  And  '$inq_date_en'  ";
           $condition2=" booking_date BETWEEN '$inq_date_st1' And '$inq_date_en1' ";
            $total_inquiry_picked=" select count(*) as tot,picked_by from inquiry where status='2' and  picked_by NOT IN ( 1,2,22,23,27,30 ) and  ".$condition." GROUP BY picked_by ";
            $booked_totalQry=" select count(*) as booked,booked_agent_id from booking_details where  booked_agent_id NOT in ( 1,2,22,23,27,30 )  AND ".$condition2." group by booked_agent_id ";
            
            $result=$this->BaseModel->getQuery($total_inquiry_picked);
           // echo $this->db->last_query();
            $booked_total=$this->BaseModel->getQuery($booked_totalQry);
//            print_r($result);
//            echo "now booking print";
//            print_r($booked_total);
            $responseArrar=array();
            $grandtotalPic=0;
            $grandtotalbook=0;
            $totalAgents=0;
            foreach ($result as $key=> $tota_pic_row)
            {
                $id_conver=$tota_pic_row->picked_by;
                $calculate_pic="select count(*) as total,picked_by from inquiry where status='2' and picked_by='$id_conver' and ".$condition."  group by picked_by";
                $calculate_book="select count(*) as book_total,booked_agent_id from booking_details where   booked_agent_id='$id_conver'   and  ".$condition2." group by booked_agent_id ";
                $percentage=0;
                $totalInquerAgent=0;
                $totalbookedAgent=0;
                $res1=$this->BaseModel->getQuery($calculate_pic);
                $res2=$this->BaseModel->getQuery($calculate_book);
                $obj1='';
                $obj2='';
                if(!empty($res1))
                {
                    $obj1=$res1[0];
                }
                if(!empty($res2))
                {
                   $obj2=$res2[0];
                }
                if(!empty($obj1))
                {
                    $grandtotalPic=$grandtotalPic+$obj1->total;
                }
                if(!empty($obj2))
                {
                    $grandtotalbook=$grandtotalbook+$obj2->book_total;
                }
                $percentage= ceil((($obj2->book_total *100) / $obj1->total));
                $totalInquerAgent=$obj1->total;
                $totalbookedAgent=$obj2->book_total;
                $agentIdRes=$id_conver;
                $totalAgents++;
                $responseArrar[$key]['agentId']=$agentIdRes;
                $responseArrar[$key]['totalInquery']=$totalInquerAgent;
                $responseArrar[$key]['totalbooking']=$totalbookedAgent;
                $responseArrar[$key]['percentage']=$percentage;
            }
           // print_r($responseArrar);
          $data['resp']=$responseArrar;
          $data['totalAgents']=$totalAgents;
          $data['grandTotalInquery']=$grandtotalPic;
          $data['grandTotalbooking']=$grandtotalbook;
     // }
      $this->load->view('dashboard',$data);  
    }
    public function newfollowup()
    {
        $data['view']="newFollowup_view";
        $this->load->view('dashboard',$data);
    }
    public function newFollowupSave()
    {
        $this->form_validation->set_rules('depart_form','Departure From','required');
        $this->form_validation->set_rules('return_date','Return Date','required');
        $this->form_validation->set_rules('destination','Destination','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('departt_date','Departure Date','required');
        $this->form_validation->set_rules('cost_price','Cost Price','numeric');
        $this->form_validation->set_rules('sale_price','Sale Price','numeric');
        $this->form_validation->set_rules('contact_number','Contact Number','numeric|max_length[11]');
        $this->form_validation->set_rules('adult','Adult','numeric');
//        $this->form_validation->set_rules('child','Child','numeric');
//        $this->form_validation->set_rules('infant','Infant','numeric');
        $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $mobile = 'yes';
        $eml_mobile = 'Mobile';
        $type = 'date';
        }
        else {
        $mobile = 'no';
        $type = 'text';
        $eml_mobile = 'Desktop';
        }
        if($this->form_validation->run()==false)
        {
            $data['view']="newFollowup_view";
            $this->load->view('dashboard',$data);
        }
       else
       {
          $created_date=date('d-m-Y H:i:s');
          $picked_date=date('Y-m-d');
           $departed_form=$this->input->post('depart_form');
           $destination=$this->input->post('destination');
           $departed_date=date('Y-m-d',strtotime($this->input->post('departt_date')));
           $return_date=date('Y-m-d',strtotime($this->input->post('return_date')));
           $customer_mail=$this->input->post('email');
           $phone=$this->input->post('contact_number');
           $phone2=$this->input->post('contact_number2');
           $customer_name=$this->input->post('customer_name');
           $sale_price=$this->input->post('sale_price');
           $cost_price=$this->input->post('cost_price');
           $airline=$this->input->post('airline');
           $pnr=$this->input->post('pnr');
           $comments=$this->input->post('comments');
           $adult=$this->input->post('adult');
           $child=$this->input->post('child');
           $infant=$this->input->post('infant');
           $passanger=$this->input->post('passanger');
           $edate=date('Y-m-d');
          $dataArray=array(
             'enquiry_date'=>$created_date,
              'enqdate'=>$edate,
              'reveicved_from'=>$eml_mobile,
             'flight_from'=>$departed_form,
             'destination'=>$destination,
             'departure_date'=>$departed_date,
             'return_date'=>$return_date,
              'customer_email'=>$customer_mail,
              'customer_phone'=>$phone.','.$phone2,
              'adult'=>$adult,
              'child'=>$child,
              'infaunt'=>$infant,
              'prefered_airline'=>$airline,
              'name'=>$customer_name,
              'status'=>'2',
              'picke_date'=>$picked_date,
              'picked_by'=>$this->session->userdata('userId'),
              'picked_time'=>$created_date,
              'cost_price'=>$cost_price,
              'sale_price'=>$sale_price,
              'pnr'=>$pnr,
              'number_of_passanger'=>$passanger,
              'customer_instr'=>$comments,
              'source'=>'created'
          );
          $res=$this->BaseModel->save('inquiry',$dataArray);
          if($res >0)
           {
              $this->BaseModel->save('agent_comments',array('agent_id'=>$this->session->userdata('userId'),'remakts'=>$comments,'inquiry_id'=>$res,'remarks_time'=>date('Y-m-d h:m:i')));
              redirect(base_url('Inquiry/followup'));
           }
           else
            {
               $data['view']="newFollowup_view";
               $data['errormessage']="Data Not Saved Network error Please Try  Again";
               $this->load->view('dashboard',$data);
            }
       }
    }
    public function followupdetails()
    {
       
        $data['view']='followup_detail_view';
        $ids=$this->uri->segment(2);  
        $id=iddecode($ids);
        $data['record']=$this->BaseModel->getWhereM('inquiry',array('id'=>$id));
        $this->load->view('dashboard',$data); 
    }
    public function otherDownloadView()
    {
        $data['view']='otherdoenload_view';
        $this->load->view('dashboard',$data);
    }
    public function otherDownloadSheet()
    {
        $startDate=$this->input->post('startDate');
        $endDate=$this->input->post('endDate');
        if(!empty($startDate))
          {
            $startDate=date('Y-m-d',strtotime($startDate));
            $sdate=date('M-d', strtotime($startDate));
          }
        if(!empty($endDate))
          {
            $endDate=date('Y-m-d',  strtotime($endDate));
            $eddd=date('M-d', strtotime($endDate));
          }
          
         $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Email Back up');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('G1', 'Email Back up');
                $this->excel->getActiveSheet()->setCellValue('A2', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Email');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Contact Number');
                $this->excel->getActiveSheet()->setCellValue('D2', 'Destination');
                $this->excel->getActiveSheet()->setCellValue('E2', 'From');
                $this->excel->getActiveSheet()->setCellValue('F2', 'Departure Date');
                $this->excel->getActiveSheet()->setCellValue('G2', 'Return Date');
                $this->excel->getActiveSheet()->setCellValue('H2', 'Adult');
                $this->excel->getActiveSheet()->setCellValue('I2', 'Child');
                $this->excel->getActiveSheet()->setCellValue('J2', 'Infant');
                $this->excel->getActiveSheet()->setCellValue('K2', 'Prefered Airline');
                $this->excel->getActiveSheet()->setCellValue('L2', 'Cost Price');
                $this->excel->getActiveSheet()->setCellValue('M2', 'Sale Price');
                $this->excel->getActiveSheet()->setCellValue('N2', 'PNR');
                $this->excel->getActiveSheet()->setCellValue('O2', 'Comment');
                $this->excel->getActiveSheet()->setCellValue('P2', 'Agent Name');
                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('M2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('O2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);               
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:F1');
                $this->excel->getActiveSheet()->mergeCells('G1:K1');
                $this->excel->getActiveSheet()->mergeCells('L1:O1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(20);
                $this->excel->getActiveSheet()->getStyle('G1')->getFill()->getStartColor()->setRGB('#fff000');
                for($col = ord('A'); $col <= ord('O'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $agentBase='';
                if($this->session->userdata('flag')==1 || $this->session->userdata('flag')==2)
                {
                    $agentBase=''; 
                }
                else
                {
                    $agentBase=$this->session->userdata('userId');
                }
                //retrive All Inquiry
                $condition="inquiry.picked_by";
                $condition1="admin.id";
                $select="name,customer_email,customer_phone,destination,flight_from,departure_date,return_date,adult,child,infaunt,prefered_airline,cost_price,sale_price,pnr,customer_instr,admin.login_name";
                $resultInquery=$this->BaseModel->getSheet($select,'inquiry','admin','left',$condition,$condition1,$startDate,$endDate,$agentBase);
                $exceldata="";
                $j=1;
               // print_r($resultInquery);
                if($resultInquery->num_rows() >0){
                foreach ($resultInquery->result_array() as $row){   
                $exceldata[] = $row;
                }
                }
                else
                    {
                    $this->excel->getActiveSheet()->mergeCells('A3:P3');
                    $this->excel->getActiveSheet()->getStyle('A3:P3')->getFill()->getStartColor()->setRGB('#fff000');
                    $exceldata[] = 'There is No Data';
                    }
               // print_r($exceldata);
               // exit();
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
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
    public function DeleteinquiryOther()
    {
        $data['view']='deleteOtherInquiry';
        $this->load->view('dashboard',$data); 
    }
    public function DeleteinquiryOtherGet()
    {
        $startDate=$this->input->post('startDate');
        $endDate=$this->input->post('endDate');
        $stdate=date('Y-m-d',strtotime($startDate));
         $edate=date('Y-m-d',strtotime($endDate));
        $qry=" select * from inquiry where picke_date BETWEEN '".$stdate."' AND  '".$edate."' ORDER by id DESC ";
        $result=$this->BaseModel->getQuery($qry);
        if(!empty($result))
        {
            $response="<table class='table table-striped table-bordered dataTable no-footer'></thead><tr><th><input  type='checkbox' name='delete' onchange='checkAll(this)'>Sr.#</th><th>Inquiry Id</th><th>inquiry Date</th><th>Email</th><th>Depart</th><th>Destination</th><th>Customer Name</th><th>Agent</th></tr></thead><tbody>";
            foreach($result as $key=>$obj)
            {
                $agent_name=idToName('admin','id',$obj->picked_by,'login_name');
                $id=$obj->id;
                $response.="<tr id='deleteRow$id'><td><input type='checkbox' name='del[]' value='$id' >".($key+1)."</td><td>".$id."</td><td>".date('Y-m-d',strtotime($obj->enquiry_date))."</td><td>".$obj->customer_email."</td><td>".$obj->flight_from."</td><td>".$obj->destination."</td><td>".$obj->name."</td><td>".$agent_name."</td></tr>"; 
            }
            $response.="</tbody></table>";
        }
        echo $response;
    }
    public function confirmDeleteinquiry()
    {
        $dataArray=$this->input->post('checkboxData');
        //print_r($dataArray);
        $resdata='';
        foreach($dataArray as $obj)
        {
            //echo $obj;
            $res=$this->BaseModel->del('inquiry',array('id'=>$obj));
            if($res >0)
                {
                    $resdata.=$obj.',';
                }
        }
        echo $resdata;
    }
}
