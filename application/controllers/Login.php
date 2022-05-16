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
           $array=array( 'login_name'=>$username,'password'=>$password,'agent_status'=>1 );
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
   


}
