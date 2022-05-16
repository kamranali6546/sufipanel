<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SendMailTest extends CI_Controller {
    public function htmlmail(){
      $userEmail='shahidaslam448@gmail.com,m.bilalvictorious@outlook.com,jahangirumair@gmail.com,jahangirusama48@gmail.com';
        $subject='Test';
        $config = Array(       
            'mailtype' => 'html',
             'charset' => 'utf-8',
             'priority' => '1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
   
        $this->email->from('info@sufitravelandtours.co.uk', 'Sufi Travels ');
        $data = array(
             'userName'=> 'Sufi Travels'
                 );
        $this->email->to($userEmail);  // replace it with receiver mail id
    $this->email->subject($subject); // replace it with relevant subject
   
        $body = $this->load->view('template50.php',$data,TRUE);
    $this->email->message($body);  
        $this->email->send();
    }
       
}
?>