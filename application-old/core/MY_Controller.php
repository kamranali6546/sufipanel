<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
public function __construct() {
        parent::__construct();
        $user_Data = $this->session->userdata();
        $this->load->library('session');
//        if($user_Data){
         if($user_Data['userId'] != "" && $user_Data['logged_in']==True){
//                $role = $user_Data['role'];
//          $set_session = array('validation' => true, 'role' => $role);
          //$this->session->set_userdata($set_session);
//          $this->user_id = $user_Data['user_id'];
//          date_default_timezone_set($user_Data['user_setting']['TimeZone']);
                
         }
         else{
          redirect("login");
         }
//        }
//        else{
//         redirect("login");
//        }
    }
    public function logout()
    {
//        unset($this->session->userdata('userId'));
//        unset($this->session->userdata('logged_in'));
       $this->session->unset_userdata('userId');
       $this->session->unset_userdata('logged_in');
       $this->session->unset_userdata('flag');
       $this->session->unset_userdata('pic');
       $this->session->unset_userdata('stat');
       $this->session->unset_userdata('email');
       $this->session->unset_userdata('loginName');
       $this->session->unset_userdata('logged_in');   
//        $this->session->unset_userdata($result);    
//        $this->session->sess_destroy();
        $this->session->sess_destroy();
         $this->cache->clean();
//        ob_end_flush();
        redirect('Login');
    }
}
?>