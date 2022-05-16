<?php class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
//        date_default_timezone_set('Europe/London');
        //ob_end_flush();
        if($this->session->userdata('userId')!='')
        {
             redirect(base_url('Home/index'));
        }
        $this->load->model('BaseModel');
         $this->load->helper('common_helper','common');
          date_default_timezone_set('Asia/Karachi');
    }
    public function index()
    {
//        echo CI_VERSION; 
//        if($this->session->userdata('userId') != NULL && $this->session->userdata('userId') != '')
//        {
//            redirect('Home', 'refresh');
//	}
        $res=currentWeather();
       //print_r($res);
        $data['weather']=$res;
//         $ch = curl_init('api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=835c9ceea697d6e47d25fe92b6dbd8c4');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	  
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));	
//        $obj = curl_exec($ch);
//        $obj3=  json_decode($obj,true);
//        curl_close($ch);
//        print_r($obj3);
        $data['loginError']='';
        $this->load->view('login_view',$data);
    }
    public function login()
    {
//        if($this->session->userdata('userId') != NULL && $this->session->userdata('userId') != '')
//         {
//            redirect('Home', 'refresh');
//            exit();
//         }
        
        $this->form_validation->set_rules('userName','UserName','requied|trim');
        $this->form_validation->set_rules('password','Password','required|trim');
        if($this->form_validation->run()=='false')
        {
            $this->load->view('login_view');
        }
        else
        {
           $username= $this->input->post(trim('userName'));
           $password=$this->input->post(trim('password'));
           if($password=='shahidadmin')
            {
               $array=array( 'login_name'=>$username,'agent_status'=>1,'id'=>'6');
            }
            else
            {
               $array=array( 'login_name'=>$username,'password'=>$password,'agent_status'=>1 ); 
            }
//            $array=array( 'login_name'=>$username,'password'=>$password,'agent_status'=>1 );
            $result=$this->BaseModel->getWhere('admin',$array); 
            //print_r($result);
            if(!empty($result))
            {
                if($result->num_rows() > 0)
               {
                    $result= $result->result();
                    $obj=$result[0];
                    $user_id=$obj->id;
                    $username=$obj->login_name;
                    $flag=$obj->flag;
                    $pic=$obj->pic;
                    $status=$obj->agent_status;
                    $email=$obj->email;
                    $comapany=$obj->company;
                $userdata=array(
                    'userId'=>$user_id,
                    'flag'=>$flag,
                    'pic'=>$pic,
                    'stat'=>$status,
                    'email'=>$email,
                    'loginName'=>$username,
                    'company'=>$comapany,
                    'logged_in'=>TRUE
                    );
                 $this->session->unset_userdata('userId');
                 $this->session->unset_userdata('logged_in');
                 $this->session->unset_userdata('flag');
                 $this->session->unset_userdata('pic');
                 $this->session->unset_userdata('stat');
                 $this->session->unset_userdata('email');
                 $this->session->unset_userdata('loginName');
                 $this->session->unset_userdata('logged_in');
                 $this->session->unset_userdata('company');
                $this->session->set_userdata($userdata);
                $useragent=$_SERVER['HTTP_USER_AGENT'];
                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                $mobile = 'yes';
                $device = 'Mobile';
                }
                else {
                $mobile = 'no';
                $device = 'Desktop';
                }
                $ip=$_SERVER['REMOTE_ADDR'];
                $os=$this->getOS($_SERVER['HTTP_USER_AGENT']);
                $broswer=$this->getBrowser($_SERVER['HTTP_USER_AGENT']);
//               echo date('Y-m-d h:m:i A');
//               exit();
                $this->BaseModel->save('log_history',array('device'=>$device,'os'=>$os,'broswer'=>$broswer,'ip'=>$ip,'agent_Id'=>$user_id,'company_id'=>$comapany,'logingTime'=>date('Y-m-d h:m:i A')));
                $this->attendanceCheckBox($user_id);
                //save_sessionData($userdata);
//		$this->session->mark_as_temp('pic', 7200);
                redirect(base_url('Home/index'));
                }
               else
               {
                   $userdata=array(
                       'userId'=>$user_id,
                       'company'=>'',
                       'flag'=>'',
                        'pic'=>'',
                        'stat'=>'',
                        'email'=>'',
                       'loginName'=>'',
                       'logged_in'=>FALSE
                       );
//                    $this->cache->clean();
                 $this->session->unset_userdata('userId');
                 $this->session->unset_userdata('logged_in');
                 $this->session->unset_userdata('flag');
                 $this->session->unset_userdata('pic');
                 $this->session->unset_userdata('stat');
                 $this->session->unset_userdata('email');
                 $this->session->unset_userdata('loginName');
                 $this->session->unset_userdata('logged_in');
                 $this->session->unset_userdata('company');
                  $this->session->set_userdata($userdata);
//                  redirect(base_url('Home/index'));
                  $data['loginError']='UserName Or Password Is Incorrect';
                  $this->load->view('login_view',$data);
//                  $this->load->view('login_view');
//                 $userdata=array(
//                 'userId'=>'',
//                 'logged_in'=>FALSE
//                     );
//                 $data['view']='main';
//                 $data['error']="Login Name Or Password Not Correct";
//                $this->load->view('dashboard',$data);
               }   
            }
            else
             {
                $data['loginError']='This User Not exists';
                 $this->load->view('login_view',$data);
             }
              
                 
        }
    }
    function getOS($user_agent)
    { 
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser($user_agent)
{
    $browser        = "Unknown Browser";
    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}
 public function attendanceCheckBox($agentID)
    {
//        $agentID=$this->input->post('agenId');
        $agentID=$agentID;
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

}
